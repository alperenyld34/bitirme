<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Sipariş Detayı | <?=$ayar['site_baslik']?></title>
<?php
$siparisDetay = $db->prepare("select * from siparis where id='$_GET[siparis_id]'");
$siparisDetay->execute();
$row = $siparisDetay->fetch(PDO::FETCH_ASSOC);
?>
<?php
$urunleriCek = $db->prepare("select * from siparis_urunler where siparis_id='$row[siparis_no]'");
$urunleriCek->execute();
$sayi = 1;
?>
<?php
    $uyelik = $db->prepare("select * from uyeler_ayar where id=:id ");
        $uyelik->execute(array(
                'id' => '1'
        ));
        $uyeayar = $uyelik->fetch(PDO::FETCH_ASSOC);

$uyeCek = $db->prepare("select * from uyeler where id=:id ");
$uyeCek->execute(array(
    'id' => $row['user_id']
));
$uye = $uyeCek->fetch(PDO::FETCH_ASSOC);
?>
<?php
if($siparisDetay->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=siparisler");
}
?>
<style>
    select {
        background: #FFF !important;
        color:#000 !important;
    }


    select * {
        background:#FFF;
        color:#000;
    }


</style>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="icon-handbag"></i> Sipariş Detayı</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=siparisler">Siparişler</a></li>
                <li class="breadcrumb-item active">Sipariş Detayı</li>
            </ol>
        </div>
    </div>
</div>

<div class="row" style="font-family: 'Open Sans', Arial">
    <div class="col-md-12">
        <?php
        if($row['odeme_tip'] == 1 || $row['odeme_tip'] == 2) {
            ?>
            <div class="card-body m-b-15 bg-warning" style="border-bottom:1px solid #EBEBEB">
                <div class="row">
                    <div class="col-md-12" style="margin-bottom:0 !important;">
                        <a href="pages.php?sayfa=siparisler" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                        <a href="pages.php?sayfa=kargo&siparis_id=<?=$row['siparis_no']?>" class="btn btn-dark text-white"><i class="fa fa-truck"></i> Kargo Bilgisi Gir</a>
                    </div>
                </div>
            </div>
        <?php }?>

        <div class="card-body m-b-15 bg-secondary" style="border-bottom:1px solid #EBEBEB">
            <form action="support/post/update/siparis-durum.php" method="post">
                <input type="hidden" name="siparis_id" value="<?=$row['id']?>">
                <div class="row">

                    <div class="col-md-3 m-t-5 m-b-5">
                        <select name="siparis_durum" id="sipDurum" class="form-control" >
                            <option value="0"  <?php if($row['siparis_durum'] == 0) { ?> selected <?php }?>>Yeni Sipariş</option>
                            <option value="1" <?php if($row['siparis_durum'] == 1) { ?> selected <?php }?>>Ödeme Bekleniyor</option>
                            <option value="2" <?php if($row['siparis_durum'] == 2) { ?> selected <?php }?>>Hazırlanıyor</option>
                            <option value="3" <?php if($row['siparis_durum'] == 3) { ?> selected <?php }?>>Tedarik Ediliyor</option>
                            <option value="4"<?php if($row['siparis_durum'] == 4) { ?> selected <?php }?>>Kargolandı</option>
                            <option value="5"<?php if($row['siparis_durum'] == 5) { ?> selected <?php }?>>Tamamlandı</option>
                            <option value="6"<?php if($row['siparis_durum'] == 6) { ?> selected <?php }?>>İptal Edildi</option>
                        </select>
                    </div>

                    <div class="col-md-2 m-t-5 m-b-5">
                        <button class="btn btn-success" name="siparisdurumdegis" type="submit" >
                            <i class="fa fa-refresh fa-spin fa-fw"></i>
                            <span class="sr-only">Yükleniyor...</span>
                            GÜNCELLE
                        </button>
                    </div>

                </div>
            </form>
        </div>
        <div class="card card-body printableArea" >

            <div class="card-body text-white" style="background: linear-gradient(to right, #4568dc, #b06ab3);" >

                <h3 class="card-title text-right" style="margin-bottom: 0 !important; ">
                    Sipariş Numarası <span style="font-weight: 500">#<?=$row['siparis_no']?></span>
                </h3>

            </div>

            <div class="card-body m-b-15 bg-secondary text-right" style="border-bottom:1px solid #EBEBEB;">

                <img src="../images/logo/<?=$ayar['site_logo']?>" alt="" style="width: 100px">
                <hr>
                <h6><b><?=$ayar['site_baslik']?></b> - <?=$ayar['site_slogan']?></h6>
                <h6><?=$ayar['site_tel']?> / <?=$ayar['site_mail']?></h6>
                <h6>Bugünün Tarihi : <?=date("Y-m-d H:i:s");?></h6>
                
            </div>



            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="pull-left bg-secondary p-20" style="border:1px dashed #EBEBEB">
                        <address>
                            <p><h4 style="font-weight: 600"><b>Sipariş Detayları</b></h4></p>
                            <hr>
                            <?php if($uyeayar['durum'] == '1' ) {?>
                                <?php if($uyeCek->rowCount() > 0  ) {?>
                                    <a href="pages.php?sayfa=uye&uye_id=<?=$uye['id']?>" target="_blank">
                                        <p style="font-weight: bold; background: #19b355; color: #fff; padding: 3px 5px; box-sizing: border-box">
                                            <i class="fa fa-user-o"></i> Üyelik Bilgilerini Gör <i style="float: right; margin-top: 2px; margin-right: 5px;" class="fa fa-arrow-right"></i>
                                        </p>
                                    </a>
                                <?php }else { ?>
                                    <p style="font-weight: bold; background: #f82647; color: #fff; text-align: center; padding: 3px 5px; box-sizing: border-box">
                                       Sitede Üye Değil
                                    </p>
                                <?php }?>
                            <?php }?>
                            <p ><h6><span style="font-weight:400; font-family: 'Open Sans', Arial">Sipariş Sahibi : <strong><?=$row['isim']?></strong></span></h6></p>
                            <p ><h6><span style="font-weight:400; font-family: 'Open Sans', Arial">Telefon Numarası  : <strong><?=$row['tel']?></strong></span></h6></p>
                            <p ><h6><span style="font-weight:400; font-family: 'Open Sans', Arial">E-Posta Adresi  : <strong><?=$row['eposta']?></strong></span></h6></p>
                            <p ><h6><span style="font-weight:400; font-family: 'Open Sans', Arial">Ödeme Yöntemi : <strong>

                                        <?php
                                        if($row['odeme_tip'] == 1) {
                                        ?>
                                        Kredi Kartı
                                        <?php }?>
                                        <?php
                                        if($row['odeme_tip'] == 2) {
                                            ?>
                                            Havale/EFT
                                        <?php }?>
                                        <?php
                                        if($row['odeme_tip'] == 3) {
                                            ?>
                                            Normal Sipariş
                                        <?php }?>
                                    </strong></span></h6></p>
                            <p><h6><span style="font-weight:400; font-family: 'Open Sans', Arial">Sipariş Numarası  : <strong>#<?=$row['siparis_no']?></strong></span></h6></p>
                            <?php if($row['shopier_sip_no'] == !null  ) {?>
                                <p><h6><span style="font-weight:400; font-family: 'Open Sans', Arial">Shopier Sipariş Numarası  : <strong>#<?=$row['shopier_sip_no']?></strong></span></h6></p>
                            <?php }?>
                        </address>
                    </div>

                    <div class="pull-right text-right p-20" style="border:1px dashed #EBEBEB">
                        <address>
                            <p><h5><span style="font-weight: 600">Sipariş Adresi</span><i class="fa fa-map-marker" style="margin-left: 10px;"></i></h5></p>
                            <p ><h6><span style="font-weight:400; font-family: 'Open Sans', Arial" <strong><?=$row['adres']?></strong></span></h6></p>
                            <p ><h6><span style="font-weight:400; font-family: 'Open Sans', Arial" <strong><?=$row['sehir']?> <span style="font-weight: 500">: İlçe/Şehir</span></strong></span></h6></p>
                            <p ><h6><span style="font-weight:400; font-family: 'Open Sans', Arial" <strong><?=$row['postakodu']?> <span style="font-weight: 500">: Posta Kodu</span></strong></span></h6></p>
                            <hr>
                            <p><h5><span style="font-weight: 600">Fatura Adresi</span><i class="fa fa-map-marker" style="margin-left: 10px;"></i></h5></p>
                            <p ><h6><span style="font-weight:400; font-family: 'Open Sans', Arial" <strong><?=$row['adres_fatura']?></strong></span></h6></p>
                            <hr>
                            <p><h5><span style="font-weight: 600">Sipariş Tarihi</span> <i class="fa fa-clock-o" style="margin-left: 10px;"></i></h5></p>
                            <p ><h6><span style="font-weight:400; font-family: 'Open Sans', Arial" <strong><?php echo date_tr('j F Y, H:i', ''.$row['siparis_tarih'].''); ?></strong></span></h6></p>

                        </address>

                    </div>
                </div>

                <?php
                if($row['odeme_tip'] == 1 || $row['odeme_tip'] == 2) {
                ?>


                <div class="col-md-12 m-t-40">
                    <hr>
                    <h3 style="font-weight: 500"><i class="mdi mdi-cart" style="margin-right: 10px"></i>Sipariş Edilen Ürünler <span style="font-size:18px; font-weight: 400">(<?=$urunleriCek->rowCount()?>)</span></h3>

                    <div class="table-responsive m-t-20" style="clear: both;">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center" width="95"></th>
                                <th class="text-left">ÜRÜN ADI</th>
                                <th class="text-left">ÜRÜN SEÇENEKLERİ</th>
                                <th class="text-center">BİRİM FİYAT</th>
                                <th class="text-center">ADET</th>
                                <th class="text-center">TOPLAM FİYAT</th>

                                <th class="text-center">TOPLAM KDV</th>

                                <th class="text-center">KARGO TUTAR</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($urunleriCek as $urun) {

                                $toplam_kdv = $urun['kdv_tutar'] * $urun['adet'];

                                $toplamtutar = $urun['adet'] * $urun['tutar'] ;

                                $asilurun = $db->prepare("select * from urun where id='$urun[urun_id]'");
                                $asilurun ->execute();
                                $asil = $asilurun ->fetch(PDO::FETCH_ASSOC);
                                ?>
                            <tr>
                                <td class="text-center"><?=$sayi++?></td>
                                <td class="text-center">
                                    <a href="<?=$ayar['site_url']?>urun/<?=$asil['id']?>/<?=seo($asil['baslik'])?>" target="_blank">
                                    <img src="../images/product/<?=$asil['gorsel']?>" width="80" >
                                    </a>
                                </td>
                                <td class="text-left" style="font-family: 'Open Sans', Arial; font-weight: 400">
                                    <a href="<?=$ayar['site_url']?>urun/<?=$asil['id']?>/<?=seo($asil['baslik'])?>" target="_blank" class="text-dark">
                                    <i class="fa fa-external-link"></i> <?=$urun['urun_baslik']?>
                                    </a>
                                </td>
                                <td class="text-left" style="font-family: 'Open Sans', Arial; font-weight: 400">
                                    <?php
                                    if($urun['varyantlar'] == !null) {
                                    $metin = $urun['varyantlar'];
                                    $sonuc = str_replace(',', '<span style="padding-left:5px; padding-right: 5px;">-</span>', $metin);
                                    ?>
                                    <span style="font-weight: 600"><?=$sonuc?></span>
                                    <?php } else {
                                    ?>
                                    Seçenek Eklenmemiş
                                    <?php }?>
                                </td>
                                <td class="text-center" style="font-family: 'Open Sans', Arial; font-weight: 600"><?php echo number_format($urun['tutar'], 2); ?> <?=$odemeayar['simge']?></td>
                                <td class="text-center" style="font-family: 'Open Sans', Arial; font-weight: 400"><?=$urun['adet']?></td>
                                <td class="text-center" style="font-family: 'Open Sans', Arial; font-weight: 600"><?php echo number_format($toplamtutar, 2); ?> <?=$odemeayar['simge']?></td>
                                <td class="text-center" style="font-family: 'Open Sans', Arial; font-weight: 400">
                                    <?php if ($urun['kdv_tutar'] == !null) {?>
                                    <strong><?php echo number_format($toplam_kdv, 2); ?> <?=$odemeayar['simge']?></strong>
                                    <br>
                                    <span style="font-size:12px;">(<?=$urun['adet']?> X <?php echo number_format($urun['kdv_tutar'], 2); ?> <?=$odemeayar['simge']?>)</span>
                                    <?php } else {?>
                                    KDV Yok
                                    <?php }?>
                                </td>

                                    <td class="text-center" style="font-family: 'Open Sans', Arial; font-weight: 600"><?php echo number_format($urun['kargo_tutar'], 2); ?> <?=$odemeayar['simge']?></td>


                            </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } else {?>

                    <div class="col-md-12 m-t-40">
                        <hr>
                        <h3 style="font-weight: 500"><i class="mdi mdi-cart" style="margin-right: 10px"></i>Sipariş Edilen Ürün</span></h3>

                        <div class="table-responsive m-t-20" style="clear: both;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center" width="95"></th>
                                    <th class="text-left">ÜRÜN ADI</th>


                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $siparisurunCek = $db->prepare("select * from urun where id='$row[siparis_id]'");
                                    $siparisurunCek ->execute();

                                foreach ($siparisurunCek as $normal) {
                                    ?>
                                    <tr>

                                        <td class="text-center">
                                            <a href="<?=$ayar['site_url']?>urun/<?=$normal['id']?>/<?=seo($normal['baslik'])?>" target="_blank">
                                                <img src="../images/product/<?=$normal['gorsel']?>" width="80" >
                                            </a>
                                        </td>
                                        <td class="text-left" style="font-family: 'Open Sans', Arial; font-weight: 400">
                                            <a href="<?=$ayar['site_url']?>urun/<?=$normal['id']?>/<?=seo($normal['baslik'])?>" target="_blank" class="text-dark">
                                                <i class="fa fa-external-link"></i> <?=$normal['baslik']?>
                                                <?php if($normal['fiyat'] == !null) {?>
                                                <hr>
                                                Ürün Fiyatı : <b><?php echo number_format($normal['fiyat'], 2); ?> <?=$odemeayar['simge']?></b>
                                                <?php }?>
                                            </a>
                                        </td>


                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                <?php }?>
                <div class="col-md-12">



                    <?php
                    if($row['odeme_tip'] == 1 || $row['odeme_tip'] == 2) {
                    ?>

                        <div class="col-md-auto bg-secondary float-right text-right" style="width: 300px !important; padding: 15px; border:1px solid #EBEBEB">
                            <h6 style="font-family: 'Open Sans', Arial; font-weight: 400">Ara Toplam : <span style="font-weight: 500"><?php echo number_format($row['ara_tutar'], 2); ?> <?=$odemeayar['simge']?></span></h6>
                            <hr>
                            <?php if ($row['kdv_tutar'] == !null) {?>
                            <h6 style="font-family: 'Open Sans', Arial; font-weight: 400">KDV Toplam : <span style="font-weight: 500"><?php echo number_format($row['kdv_tutar'], 2); ?> <?=$odemeayar['simge']?></span></h6>
                            <hr>
                            <?php }?>
                            <h6  style="font-family: 'Open Sans', Arial; font-weight: 400">Kargo Ücreti : <span style="font-weight: 500"><?php echo number_format($row['kargo_tutar'], 2); ?> <?=$odemeayar['simge']?></span></h6>
                            <hr>
                            <h4 style="font-family: 'Open Sans', Arial; font-weight: 400">Toplam Tutar : <span style="font-weight: 500"><?php echo number_format($row['toplam_tutar'], 2); ?> <?=$odemeayar['simge']?></span></h4>
                        </div>

                    <div class="clearfix"></div>
                    <hr>
                    <?php }?>

                    <?php if ($row['notlar'] == !null) {?>
                        <div class="card-body m-b-15 m-t-15 bg-secondary" style="border:1px solid #EBEBEB" >
                            <h4 style="font-weight: 500">Müşteri Notu :</h4>
                            <span style="font-family: 'Open Sans', Arial; font-weight: 400; font-size:14px"><?=$row['notlar']?></span>
                        </div>
                    <?php }?>

                    <div class="text-right">

                        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Siparişi Yazdır</span> </button>
                    </div>
                </div>
            </div>
        </div>



        <?php
        if($row['odeme_tip'] == 1 || $row['odeme_tip'] == 2) {
        ?>
        <?php
        if($odemeayar['kargo_limit'] > 0) {
        ?>
        <div class="alert alert-info text-right" style="font-size:14px; font-family: 'Open Sans', Arial; font-weight: 400">
           <i class="fa fa-info-circle"></i> Kargo limiti ayarınız aktiftir. <strong><?php echo number_format($odemeayar['kargo_limit'], 2); ?> <?=$odemeayar['simge']?></strong> ve üzeri alışverişlerde kargo ücretsizdir.
        </div>
        <?php }?>
        <?php }?>


    </div>
</div>





<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=siparis&siparis_id=<?=$_GET['siparis_id']?>">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=siparis&siparis_id=<?=$_GET['siparis_id']?>">
<?php }?>
<?php if($_GET['status']=='times'){ ?>
    <body onload="sweetAlert('Sipariş İptal Edildi!', 'Sipariş iptal edildiği için lütfen siparişteki ürünlerin stok adetini tekrar artırınız', 'warning');">
    </body>
<?php }?>
