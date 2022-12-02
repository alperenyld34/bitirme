<?php include 'support/session.php'; ?>
<?php
$last_product = $db->prepare("select * from urun where dil='$_SESSION[dil]'  order by id desc limit 6");
$last_product->execute();

$product_cat = $db->prepare("select * from urun_cat where dil='$_SESSION[dil]' and anasayfa_grup='1' order by sira asc");
$product_cat->execute();

$servicess = $db->prepare("select * from hizmet where dil='$_SESSION[dil]' and durum='1' order by sira asc limit 6");
$servicess->execute();

$blogs = $db->prepare("select * from blog where dil='$_SESSION[dil]' order by id desc limit 10");
$blogs->execute();

$sipariss22 = $db->prepare("select * from siparis where NOT siparis_durum='99' order by id desc");
$sipariss22->execute();

$urunsayisi = $db->prepare("select * from urun where dil='$_SESSION[dil]' ");
$urunsayisi->execute();

$blogsayisi = $db->prepare("select * from blog where dil='$_SESSION[dil]' ");
$blogsayisi->execute();

$projesayisi = $db->prepare("select * from proje where dil='$_SESSION[dil]' ");
$projesayisi->execute();
?>
<?php	$bugun=date("d"); // bugünün tarihi
$ay=date("m"); // bu ay
$yil=date("Y"); // bu yıl
$onlineSuresi=time()-2*60*60; // iki dakika aktif olmazsa onlineden düşecek
$ip=$_SERVER['REMOTE_ADDR']; // ziyaretçinin ip si
$bugunGiris = $db->prepare("select * from hit where ip='$ip' and gun='$bugun' and ay='$ay' and yil='$yil'");
$bugunGiris->execute();
if($bugunGiris!=0){ // yani bugün girilmişse

    $allsana=$db->prepare("SELECT * FROM `hit` WHERE  `ip`='".$ip."' AND `gun`='".$bugun."'");
    $allsana->execute();
    $al = $allsana->fetch(PDO::FETCH_ASSOC);


}else{ // griş yapılmamışsa kaydettirelim

}
// online kişi sayısı: tekil ve çoğul
$online=$db->prepare("SELECT * FROM hit WHERE simdi>='$onlineSuresi'")->rowCount(); // onlnie kişilerimiz
// çoğul hitler

// çoğul hitler
$bugunFor = $db->prepare("SELECT SUM(sayac) FROM hit WHERE gun='$bugun' AND ay='$ay' AND yil='$yil' ORDER BY id desc");
$bugunFor->execute();
$bugunx = $bugunFor->fetch(PDO::FETCH_ASSOC);
$bugun_cogul=$bugunx['SUM(sayac)']; // bugün çoğul

$dunFor = $db->prepare("SELECT SUM(sayac) FROM hit WHERE gun='".($bugun-1)."' AND ay='$ay' AND yil='$yil' ORDER BY id desc");
$dunFor->execute();
$dunx = $dunFor->fetch(PDO::FETCH_ASSOC);
$dun_cogul=$dunx['SUM(sayac)']; // dün Çoğul

$ayFor = $db->prepare("SELECT SUM(sayac) FROM hit WHERE ay='$ay' AND yil='$yil' ORDER BY id desc");
$ayFor->execute();
$ayx = $ayFor->fetch(PDO::FETCH_ASSOC);
$buay_cogul=$ayx['SUM(sayac)']; // dün Çoğul

$toplamFor = $db->prepare("SELECT SUM(sayac) FROM hit WHERE ay='$ay' AND yil='$yil' ORDER BY id desc");
$toplamFor->execute();
$toplamx = $toplamFor->fetch(PDO::FETCH_ASSOC);
$toplam_cogul=$toplamx['SUM(sayac)']; // dün Çoğul

// tekil hitler
$buguntekilcek=$db->prepare("SELECT * FROM hit WHERE gun='$bugun' AND ay='$ay' AND yil='$yil'");
$buguntekilcek->execute();
$bugun_tekil = $buguntekilcek->rowCount();


$buaytekikcek=$db->prepare("SELECT * FROM hit WHERE  ay='$ay' AND yil='$yil'");
$buaytekikcek->execute();
$buay_tekil = $buaytekikcek->rowCount();

$toplamtekilcek=$db->prepare("SELECT * FROM hit ");
$toplamtekilcek->execute();
$toplam_tekil = $toplamtekilcek->rowCount();

?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Gösterge Paneli | <?=$ayar['site_baslik']?></title>


    <?php include 'support/panel_header_libs.php'?>


</head>

<body class="skin-default fixed-layout">


<div id="main-wrapper">

    <?php include "support/panel_parts/panel_topbar.php";?>

    <?php include "support/panel_parts/panel_leftbar.php";?>

    <div class="page-wrapper">

        <div class="container-fluid">

            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor"><i class="icon-speedometer"></i> Gösterge Paneli</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                            <li class="breadcrumb-item active">Gösterge Paneli</li>
                        </ol>
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="card" style="background: linear-gradient(45deg, #635bd6, #f742aa) !important;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div>
                                            <h3><i class="icon-handbag text-secondary"></i></h3>
                                            <p class="text-secondary">TOPLAM SİPARİŞ</p>
                                        </div>
                                        <div class="ml-auto">
                                            <h2 class="counter text-secondary"><?=$sipariss22->rowCount()?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="col-lg-3 col-md-6">
                    <div class="card" style="background: linear-gradient(45deg, #45c0ba, #76c880) !important;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div>
                                            <h3><i class="icon-social-dropbox text-secondary"></i></h3>
                                            <p class="text-secondary">TOPLAM ÜRÜN</p>
                                        </div>
                                        <div class="ml-auto">
                                            <h2 class="counter text-secondary"><?php echo $urunsayisi->rowCount() ?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    

                <div class="col-lg-3 col-md-6">
                    <div class="card" style="background: linear-gradient(45deg, #705be1, #52d8c6) !important;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div>
                                            <h3><i class="icon-pencil text-secondary"></i></h3>
                                            <p class="text-secondary">TOPLAM BLOG YAZISI</p>
                                        </div>
                                        <div class="ml-auto">
                                            <h2 class="counter text-secondary"><?php echo $blogsayisi->rowCount() ?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Son Blog Yazıları
                                <a href="pages.php?sayfa=bloglar">
                                <span class="text-muted pull-right" style="font-size:13px; padding-top: 4px">
                                TÜMÜ
                                </span>
                                </a>
                            </h5>
                        </div>
                        <div class="card-body bg-light" style="border-bottom: 1px solid #dee2e6;">
                            <div class="row">
                                <div class="col-6">
                                    <a href="pages.php?sayfa=blogekle" role="button" class="btn btn-success"><i class="mdi mdi-plus"></i> YENİ BLOG EKLE</a>
                                </div>
                                <div class="col-6 align-self-center display-6 text-right">
                                    <h6 class="text-muted">Sol butondan yeni blog ekleyebilirsiniz</h6></div>
                            </div>
                        </div>
                   
                        <div class="comment-widgets" <?php if($blogs->rowCount()>3) {?>id="slimtest2" style="height: 528px;"<?php }?>>
                        
                            <?php foreach ($blogs as $blog) {?>
                            <div class="d-flex no-block comment-row">
                                <div class="p-2"><img src="../images/blog/<?=$blog['gorsel']?>" alt="user" width="80" height="55"></div>
                                <div class="comment-text w-100">
                                    <h5 class="font-medium"><?=$blog['baslik']?></h5>
                                    <p class="m-b-10 text-muted"><?=$blog['spot']?></p>
                                    <div class="comment-footer">
                                        <span class="text-muted pull-right"><?php echo date_tr('j F Y, l ', ''.$blog['tarih'].''); ?></span>

                                        <?php if($blog['anasayfa'] == 1) {?>
                                        <span class="badge badge-pill badge-success"><i class="fa fa-home"></i> Anasayfa Onaylı</span>
                                        <?php } else {?>
                                            <span class="badge badge-pill badge-dark"><i class="fa fa-times"></i> Anasayfa Onaysız</span>
                                        <?php }?>

                                        <?php if($blog['durum'] == 1) {?>
                                            <span class="badge badge-pill badge-info"><i class="fa fa-check"></i> Yayında</span>
                                        <?php } else {?>
                                            <span class="badge badge-pill badge-danger"><i class="fa fa-times"></i> Yayında Değil</span>
                                        <?php }?>

                                        <span class="action-icons">
                                                    <a href="pages.php?sayfa=blog&blog_id=<?=$blog['id']?>"><i class="ti-pencil-alt"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            <?php
                            if($blogs->rowCount()<=0) {
                                ?>

                                <div style="width: 100%; padding: 30px 0 10px 0; text-align: center">
                                    <h4>Henüz blog yazısı eklenmemiş!</h4>
                                </div>


                            <?php }?>
                         

                        </div>
                    </div>
                </div>
               
                <div class="col-lg-6 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div>
                                    <h5 class="card-title">Son Eklenen Ürünler</h5>
                                </div>
                                <div class="ml-auto">
                                    <a href="pages.php?sayfa=urunler">
                                <span class="text-muted pull-right" style="font-size:13px; padding-top: 4px; font-weight: 500">
                                TÜMÜ
                                </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-light"  <?php  if($last_product->rowCount()<=0) {  ?>style="border-bottom: 1px solid #dee2e6;" <?php }?>>
                            <div class="row">
                                <div class="col-6">
                                    <a href="pages.php?sayfa=urunekle" role="button" class="btn btn-success"><i class="mdi mdi-plus"></i> YENİ ÜRÜN EKLE</a>
                                  </div>
                                <div class="col-6 align-self-center display-6 text-right">
                                    <h6 class="text-muted">Sol butondan yeni ürün ekleyebilirsiniz</h6></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <?php
                            if($last_product->rowCount()>0) {
                            ?>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>ÜRÜN ADI</th>
                                    <th>KATEGORİ</th>
                                    <th>ÜRÜN KODU</th>
                                    <th>FİYAT</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($last_product as $urun) {
                                    $baslik = $urun['baslik'];

                                    $sql_kategori = $db->prepare("select * from urun_cat where id='$urun[kat_id]' and durum='1' and dil='$_SESSION[dil]' order by id desc limit 1");
                                    $sql_kategori->execute();
                                    $urun_cat = $sql_kategori->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                <tr>
                                    <td class="text-center">

                                        <img src="../images/product/<?=$urun['gorsel']?>" alt="ürün" width="50" height="45">

                                    </td>
                                    <td class="txt-oflo">

                                <h6>
                                        <?php
                                        $baslik = strip_tags($baslik);
                                        if (strlen($baslik) > 35) {

                                            $stringCut = substr($baslik, 0, 35);
                                            $endPoint = strrpos($stringCut, ' ');

                                            $baslik = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $baslik .= '...';
                                        }
                                        echo $baslik;
                                        ?>
                                </h6>


                                        <span class="action-icons">
                                                    <a href="pages.php?sayfa=urun&urun_id=<?=$urun['id']?>"><i class="ti-pencil-alt" style="color:red"></i></a>
                                        </span>

                                    </td>
                                    <td><div class="btn btn-sm btn-secondary"><?=$urun_cat['baslik']?></div></td>
                                    <td class="txt-oflo"><?=$urun['urun_kod']?></td>
                                    <td><span class="text-dark" style="font-weight: 600"><?php echo number_format($urun['fiyat'], 2); ?> TL</span></td>
                                </tr>
                                <?php }?>





                                </tbody>
                            </table>
                            <?php }?>
                            <?php
                            if($last_product->rowCount()<=0) {
                                ?>

                                <div style="width: 100%; padding: 30px 0 20px 0; text-align: center">
                                    <h4>Henüz Ürün eklenmemiş!</h4>
                                </div>


                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>















            <?php
            $siparisler = $db->prepare("select * from siparis WHERE NOT siparis_durum='99' order by id desc limit 10");
            $siparisler->execute();
            ?>




            <!-- ============================================================== -->
            <!-- Review -->
            <!-- ============================================================== -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Son Siparişler</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Sipariş Numarası</th>
                                    <th>İsim</th>
                                    <th>Sipariş Türü</th>
                                    <th>Sipariş Tarihi</th>
                                    <th>Tutar</th>
                                    <th class="text-left">Sipariş Durumu</th>
                                    <th class="text-center"></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($siparisler as $siparis) {
                                    ?>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="link"> #<?=$siparis['siparis_no']?></a></td>
                                        <td><?=$siparis['isim']?></td>
                                        <td>

                                            <?php if ($siparis['odeme_tip'] == 1) { ?>
                                                <i class="ti-credit-card"></i> Kredi Kartı
                                            <?php } ?>


                                            <?php if ($siparis['odeme_tip'] == 2) { ?>
                                                <i class="mdi mdi-bank"></i> Havale/EFT
                                            <?php } ?>


                                            <?php if ($siparis['odeme_tip'] == 3) { ?>
                                                <i class="icon-basket"></i> Normal Sipariş
                                            <?php } ?>

                                        </td>
                                        <td><span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo date_tr('j F Y, H:i, l ', ''.$siparis['siparis_tarih'].''); ?></span></td>
                                        <td><strong><?php echo number_format($siparis['toplam_tutar'], 2); ?> TL</strong></td>
                                        <td class="text-left">

                                            <?php if($siparis['siparis_durum'] == 0) { ?>
                                                <div class="label label-table label-danger" style=" font-size:13px">YENİ SİPARİŞ</div>
                                            <?php } ?>

                                            <?php if($siparis['siparis_durum'] == 1) { ?>
                                                <div class="label label-table label-warning" style=" font-size:13px"><i class="fa fa-spinner"></i> ÖDEME BEKLENİYOR</div>
                                            <?php } ?>

                                            <?php if($siparis['siparis_durum'] == 2) { ?>
                                                <div class="label label-table label-info" style=" font-size:13px"><i class="mdi mdi-dots-vertical"></i> HAZIRLANIYOR</div>
                                            <?php } ?>

                                            <?php if($siparis['siparis_durum'] == 3) { ?>
                                                <div class="label label-table label-danger" style="background-color: #333; color:#FFF;  font-size:13px"><i class="mdi mdi-search-web"></i> TEDARİK EDİLİYOR</div>
                                            <?php } ?>

                                            <?php if($siparis['siparis_durum'] == 4) { ?>
                                                <div class="label label-table" style="background-color: #FFF; border:1px solid #EBEBEB; color:#000; font-size:13px"><i class="mdi mdi-truck"></i> KARGOLANDI</div>
                                            <?php } ?>

                                            <?php if($siparis['siparis_durum'] == 5) { ?>
                                                <div class="label label-table label-success" style=" font-size:13px"><i class="mdi mdi-check"></i> TAMAMLANDI</div>
                                            <?php } ?>

                                            <?php if($siparis['siparis_durum'] == 6) { ?>
                                                <div class="label label-table label-danger" style="background-color: orangered; font-size:13px"><i class="mdi mdi-close"></i> İPTAL EDİLDİ</div>
                                            <?php } ?>

                                        </td>
                                        <td class="text-center">
                                            <a role="button" class="btn btn-warning btn-sm" href="pages.php?sayfa=siparis&siparis_id=<?=$siparis['id']?>">
                                                <i class="fa fa-eye"></i> SİPARİŞİ İNCELE</a>
                                        </td>
                                    </tr>
                                <?php }?>
                                <?php if ($siparisler->rowCount() <= 0) {?>
                                <tr>
                                    <td>Sipariş Bulunamadı !</td>
                                    <td></td>
                                    <td>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-left">

                                    </td>
                                    <td class="text-center">
                                    </td>
                                </tr>
                                <?php }?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>



















            <div class="row">
                <!-- Column -->
                <div class="col-lg-4">


                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Anasayfa Ürün Grupları
                                <a href="pages.php?sayfa=urunkategorileri">
                                <span class="text-muted pull-right" style="font-size:13px; padding-top: 4px">
                                TÜMÜ
                                </span>
                                </a>
                            </h5>

                        </div>
                        <div class="card-body bg-light"  <?php  if($product_cat->rowCount()<=0) {  ?>style="border-bottom: 1px solid #dee2e6;" <?php }?>>
                            <div class="row">
                                <div class="col-6">
                                    <a href="pages.php?sayfa=urungrupsiralamasi" role="button" class="btn btn-success"><i class="fa fa-list-ol"></i> SIRALAMAYI YÖNET</a>
                                </div>
                                <div class="col-6 align-self-center display-6 text-right">
                                    <h6 class="text-muted">Sol butondan grup sıralamasını yönetebilirsiniz</h6></div>
                            </div>
                        </div>
                        <div class="comment-widgets" <?php if($product_cat->rowCount()>5) {?>id="slimtest1" style="margin-bottom: 19px; height: 440px; overflow: hidden"<?php }?>>


                            <?php foreach ($product_cat as $urunkat) {   ?>
                                <div class="d-flex no-block comment-row" style="padding: 5px">
                                    <div class="p-2"><span ><img src="../images/product-category/<?=$urunkat['gorsel']?>" alt="Kategori" width="80" height="50"></span></div>
                                    <div class="comment-text w-100">
                                        <h5 class="font-medium"><?=$urunkat['baslik']?></h5>
                                        <div class="comment-footer">
                                        <span class="text-muted pull-right">

                                            <?php
                                            if ($urunkat['ust_id'] == 0) {
                                                ?>
                                                <span class="badge badge-pill badge-danger">Ana Kategori</span>
                                            <?php } else {?>
                                                <span class="badge badge-pill badge-secondary">Alt Kategori</span>
                                            <?php }?>
                                        </span>
                                            <?php
                                            if ($urunkat['durum'] == 1) {
                                                ?>
                                                <span class="badge badge-pill badge-info">AKTİF</span>
                                            <?php } else {?>
                                                <span class="badge badge-pill badge-danger">PASİF</span>
                                            <?php }?>

                                            <span class="action-icons">
                                                    <a href="pages.php?sayfa=urunkategori&kategori_id=<?=$urunkat['id']?>"><i class="ti-pencil-alt"></i></a>

                                                </span>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                            <?php
                            if($product_cat->rowCount()<=0) {
                                ?>

                                <div style="width: 100%; padding: 30px 0 20px 0; text-align: center">
                                    <h4>Henüz eklenmemiş!</h4>
                                </div>


                            <?php }?>

                        </div>
                    </div>

                </div>
               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "support/panel_parts/panel_rightbar.php"; ?>
        </div>

    </div>

    <footer class="footer">
        Yönetim Paneli   -  <?=$ayar['site_baslik']?>
    </footer>

</div>


<?php include 'support/panel_footer_libs.php';?>

</body>

</html>

<?php






?>