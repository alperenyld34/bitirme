<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Ürünler | <?=$ayar['site_baslik']?></title>
<?php
$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from urun where dil='$_SESSION[dil]' order by id DESC");
$ToplamVeri = $Say->rowCount();
$Limit = 50;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$ara = $_GET['search'];
$listele_tablo = $db->query("select * from urun where (baslik like '%$ara%' or urun_kod like '%$ara%') and dil='$_SESSION[dil]' order by id DESC limit $Goster,$Limit");
$tabloAl = $listele_tablo->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="ti-dropbox"></i> Ürünler</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Ürünler</li>
            </ol>
        </div>
    </div>
</div>

<form action="support/post/multi-delete/urunleri-sil.php" method="post">
<div class="row">




    <div class="col-md-12" style="text-align: left" >


        <a role="button" href="pages.php?sayfa=urunekle" class="btn btn-info m-b-15" style="color:#FFF" ><i class="fa fa-plus-circle"></i> Ürün Ekle</a>
        <a role="button"  class="btn btn-purple m-b-15" href="pages.php?sayfa=urunkategorileri" style="color:#FFF"><i class="mdi mdi-arrange-bring-forward"></i> Ürün Kategorileri</a>

         <a role="button"  class="btn btn-dark m-b-15" href="pages.php?sayfa=urunmodul" style="color:#FFF"><i class="fa fa-cog"></i> Ürün Modül Ayarları</a>


        <button type="submit"  class="btn btn-danger m-b-15" style="color:#FFF"><i class="fa fa-trash"></i> Seçilenleri Sil</button>

    </div>

    <div class="col-12">
        <div class="card" >
            <div class="card-body bg-secondary" >

                <h3 class="card-title m-b-25">Ürünler [<?=$listele_tablo->rowCount()?> Ürün]  <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span></h3>
                <h6 class="card-subtitle">Bu alanda ürünlerinizi ve ürünlerinizin belirlenen özellikleri görüntülenmektedir. Arama yapmak için sayfanın altına gidiniz.</h6>

            </div>

        </div>
    </div>


    <div class="col-12" >
        <div class="card"  style="margin-bottom: 0 !important;">
            <div class="card-body" style="padding: 15px !important;">


                <?php if ($listele_tablo->rowCount() > 0) {?>
                <div class="table-responsive"  >
                    <table class="table table-bordered table-striped" style="font-family: 'Open Sans', Arial; margin-bottom: 0 !important;" >
                        <thead>
                        <tr>
                            <th width="1%" style="border-top: 0 !important; border-bottom: 0 !important; border-left:0 !important;">

                                <div class="form-checkbox" style="overflow: hidden; height: 24px;">
                                    <input type="checkbox" class="selectall" id="hepsiniSecCheckBox" />
                                    <label for="hepsiniSecCheckBox"></label>
                                </div>

                            </th>
                            <th style="text-align: center; border-top: 0 !important; border-bottom: 0 !important;" width="110">KAPAK</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important;"></th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important;" width="300">BAŞLIK</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center" width="200">KATEGORİ</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center">ÜRÜN KODU</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center ">STOK</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center ">FİYAT</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center ">HİT</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: left ">EKLENME TARİHİ</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center">VARYANT</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center">DURUM</th>
                            <th class="text-nowrap" width="180" style="text-align: center; border-top: 0 !important; border-bottom: 0 !important; border-right: 0 !important;">#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($tabloAl as $row) {    ?>
                        <tr>
                            <td style="border-left:0 !important;">
                                <div class="form-checkbox">
                                <input type="checkbox" name='sil[]' id="checkSec-<?=$row['id']?>" value="<?=$row['id']?>" class="individual">
                                <label for="checkSec-<?=$row['id']?>"></label>
                                </div>
                            </td>

                            <td style="text-align: center">

                                <img src="../images/product/<?=$row['gorsel']?>" style="width: 65px; border:1px solid #EBEBEB">
                                
                            </td>

                            <td style="font-weight: 400">
                                <a href="pages.php?sayfa=urunfoto&urun_id=<?=$row['id']?>" role="button" class="btn btn-primary text-white btn-sm"><i class="fa fa-image"></i> GALERİ</a>
                            </td>

                            <td style="font-weight: 400">
                                <?=$row['baslik']?>
                            </td>

                            <td style="font-weight: 400; text-align: center">
                                <?php
                                $kat_goster = $db->prepare("select * from urun_cat where id='$row[kat_id]'");
                                $kat_goster->execute();
                                $kat = $kat_goster->fetch(PDO::FETCH_ASSOC);

                                $kat_goster_ust = $db->prepare("select * from urun_cat where id='$kat[ust_id]'");
                                $kat_goster_ust->execute();
                                $ustkat = $kat_goster_ust->fetch(PDO::FETCH_ASSOC);
                                ?>

                                <span style="font-size:13px;">
                                <strong> </i><?=$ustkat['baslik']?></strong> <i class="fa fa-caret-right"></i> <?=$kat['baslik']?>
                                </span>

                            </td>

                            <td style="font-weight: 500;text-align: center">
                            <?=$row['urun_kod']?>
                            </td>

                            <td style="font-weight: 400; text-align: center">
                              <?php if ($row['stok'] > 0) {?>
                              <span class="badge badge-info text-white" style="font-size:13px;"><?=$row['stok']?> Adet</span>
                              <?php } else {?>
                                  <span class="badge badge-danger" style="font-size:13px;">0</span>
                              <?php }?>
                            </td>

                            <td style="font-weight: 400; text-align: center">
                                <?php
                                if($row['fiyat'] == !null || $row['fiyat'] == !'0') {
                                ?>
                                 <?php echo number_format($row['fiyat'], 2); ?> <?=$odemeayar['simge']?>
                                 <?php } else {?>
                                 Fiyat Eklenmemiş!
                                 <?php }?>
                            </td>

                            <td style="font-weight: 400; text-align: center">
                                <?=$row['hit']?>
                            </td>

                            <td style="font-weight: 400; text-align: left; font-size:13px;">
                                <?php echo date_tr('j F Y, H:i', ''.$row['tarih'].''); ?>
                            </td>

                            <td style="font-weight: 400">
                                <a href="pages.php?sayfa=varyantlar&urun_id=<?=$row['id']?>" role="button" class="btn btn-primary text-white btn-sm">VARYANTLAR</a>
                            </td>

                            <td style="font-weight: 400; text-align: center">
                                <?php
                                if($row['durum'] == 1) {
                                    ?>
                                    <span class="btn btn-success btn-sm"><i class="fa fa-check"></i> Aktif</span>
                                <?php } ?>
                                <?php
                                if($row['durum'] == 0) {
                                    ?>
                                    <span class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Pasif</span>
                                <?php } ?>
                            </td>

                            <td class="text-nowrap" style="text-align: center; border-right: 0 !important;">
                                <a  href="pages.php?sayfa=urun&urun_id=<?=$row['id']?>" class="btn btn-sm btn-info" style="color:#FFF"><i class="fa fa-pencil text-inverse"></i> Düzenle </a>
                                <a  onclick="deletebutton('<?=$row['id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>
                            </td>

                        </tr>


                       <?php }?>



                        </tbody>
                    </table>




                </div>






                    <!---- Sayfalama Elementleri ================== !-->
                    <?php if($Sayfa >= 1){?>
                        <nav aria-label="Page navigation example" style="margin-top:20px;">
                        <ul class="pagination">
                    <?php } ?>

                    <?php if($Sayfa > 1){?>

                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=urunler&page="><?=$diller['sayfalama-ilk']?></a></li>
                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=urunler&page=<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

                    <?php } ?>
                    <?php
                    for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                        if($i == $Sayfa){

                            echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="pages.php?sayfa=urunler&page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';

                        }else{
                            echo '
                    <li class="page-item"><a class="page-link" href="pages.php?sayfa=urunler&page='.$i.'">'.$i.'</a></li>
                    ';
                        }
                    }
                    }
                    ?>

                    <?php if($listele_tablo->rowCount() <=0) { } else { ?>
                        <?php if($Sayfa != $Sayfa_Sayisi){?>

                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=urunler&page=<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=urunler&page=<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


                        <?php }} ?>

                    <?php if($Sayfa >= 1){?>
                        </ul>
                        </nav>
                    <?php } ?>
                    <!---- Sayfalama Elementleri ================== !-->




                <?php } else {?>
                <div class="alert alert-info" style="font-weight: 400">
                   Ürün Bulunamadı
                    <?php if(isset($_GET['search'])) {?>
                        <a href="pages.php?sayfa=urunler">Geri Dön</a>
                    <?php }?>
                </div>
                <?php }?>

            </div>
        </div>


    </div>




</div>
</form>

<!-- ARAMA !-->
<?php
if ($listele_tablo->rowCount()>0) {
?>
<div class="col-md-12 p-l-0 p-r-0" style="border-top: 1px solid #EBEBEB">
<div class="card p-l-5 p-b-15 p-t-20 bg-secondary">

    <form method="get" action="pages.php?" >
        <div class="form-row align-items-center">

            <div class="col-auto">
                <input type="hidden" class="form-control mb-2" id="inlineFormInput" name="sayfa" value="urunler">
            </div>

            <div class="col-auto">
                <input type="text" class="form-control mb-2" id="inlineFormInput" required name="search" placeholder="Ürün kodu veya başlık">
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Ara</button>
            </div>
        </div>
    </form>

</div>
</div>
<?php } ?>
<!-- ARAMA !-->


<script type="text/javascript">

    function deletebutton(urunid){

        swal({
            title: "Silmek İstediğinize Emin Misiniz?",
            text: "Seçtiğiniz içerik kalıcı olarak silinecektir",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sil",
            cancelButtonText: "İptal",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {
                window.location.href = "support/post/delete/urun-sil.php?urun=success&id="+urunid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>




<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urunler">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urunler">
<?php }?>
<?php if($_GET['status']=='nocheck'){ ?>
    <body onload="sweetAlert('Sorun Var!', 'Hiç seçim yapılmamış!', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urunler">
<?php }?>
