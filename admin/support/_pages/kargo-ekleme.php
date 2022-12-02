<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Kargo Bilgisi Ekleme | <?=$ayar['site_baslik']?></title>
<?php
$siparisDetay = $db->prepare("select * from siparis where siparis_no='$_GET[siparis_id]'");
$siparisDetay->execute();
$row = $siparisDetay->fetch(PDO::FETCH_ASSOC);
?>
<?php
$urunleriCek = $db->prepare("select * from siparis_urunler where siparis_id='$row[siparis_no]'");
$urunleriCek->execute();
$sayi = 1;

$smsDurum = $db->prepare("select * from sms where id='1'");
$smsDurum->execute();
$sms = $smsDurum->fetch(PDO::FETCH_ASSOC);
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
        <h4 class="text-themecolor"><i class="fa fa-truck"></i> Kargo Bilgisi Ekleme</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=siparisler">Siparişler</a></li>
                <li class="breadcrumb-item active">Kargo Bilgisi Ekleme</li>
            </ol>
        </div>
    </div>
</div>

<div class="row" style="font-family: 'Open Sans', Arial">
    <div class="col-md-12">
        <a href="pages.php?sayfa=siparisler" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        <br><br>
        <?php if ($row['odeme_tip'] == 2 || $row['odeme_tip'] == 1) { ?>
        <div class="card card-body printableArea" >



            <div class="card-body text-white" style="background: linear-gradient(to right, #4568dc, #b06ab3);" >

                <h3 class="card-title text-left" style="margin-bottom: 0 !important; ">
                    Sipariş Numarası <span style="font-weight: 500">#<?=$row['siparis_no']?></span>
                </h3>

            </div>



            <div class="row m-t-20">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body bg-secondary" >

                            <form class="form-bordered">

                                <h3 class="card-title">Sipariş Detayları</h3>
                                <hr>


                                <div class="row" style="font-family: 'Open Sans', Arial; font-size:15px;">


                                    <div class="col-md-3">
                                        <div class="form-group" style="font-weight: 400">
                                            <label style="font-weight: 500" for="basLik">Sipariş Durumu</label><br>

                                            <?php
                                            if ($row['siparis_durum'] == 0) {
                                                ?>
                                                Yeni Sipariş
                                            <?php }?>
                                            <?php
                                            if ($row['siparis_durum'] == 1) {
                                                ?>
                                               Ödeme Bekleniyor
                                            <?php }?>
                                            <?php
                                            if ($row['siparis_durum'] == 2) {
                                                ?>
                                                Hazırlanıyor
                                            <?php }?>

                                            <?php
                                            if ($row['siparis_durum'] == 3) {
                                                ?>
                                               Tedarik Ediliyor
                                            <?php }?>

                                            <?php
                                            if ($row['siparis_durum'] == 4) {
                                                ?>
                                                Kargolandı
                                            <?php }?>

                                            <?php
                                            if ($row['siparis_durum'] == 5) {
                                                ?>
                                                Tamamlandı
                                            <?php }?>
                                            <?php
                                            if ($row['siparis_durum'] == 6) {
                                                ?>
                                                <i class="fa fa-times-circle-o"></i> İptal Edildi
                                            <?php }?>

                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group" style="font-weight: 400">
                                            <label style="font-weight: 500" for="basLik">Ödeme Tipi</label><br>

                                            <?php
                                            if ($row['odeme_tip'] == 2) {
                                            ?>
                                            Havale/EFT
                                            <?php }?>
                                            <?php
                                            if ($row['odeme_tip'] == 1) {
                                                ?>
                                                Kredi Kartı
                                            <?php }?>


                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group" style="font-weight: 400">
                                            <label style="font-weight: 500" for="basLik">Sipariş Numarası</label><br>

                                            #<?=$row['siparis_no']?>

                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="form-group" style="font-weight: 400">
                                            <label style="font-weight: 500" for="basLik">Sipariş Sahibi</label><br>

                                            <?=$row['isim']?>

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group" style="font-weight: 400">
                                            <label style="font-weight: 500" for="basLik">Sipariş Tarihi</label><br>

                                            <?php echo date_tr('j F Y, H:i, l ', ''.$row['siparis_tarih'].''); ?>

                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group" style="font-weight: 400">
                                            <label style="font-weight: 500" for="basLik">Telefon Numarası</label><br>

                                            <?=$row['tel']?>

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group" style="font-weight: 400">
                                            <label style="font-weight: 500" for="basLik">E-Posta Adresi</label><br>

                                            <?=$row['eposta']?>

                                        </div>
                                    </div>




                                    <div class="col-md-6">
                                        <div class="form-group" style="font-weight: 400">
                                            <label style="font-weight: 500" for="basLik">Sipariş Notu</label><br>

                                            <?php
                                            if ($row['notlar'] == !null) {
                                                ?>
                                               <?=$row['notlar']?>
                                            <?php } else {?>
                                            Not Eklenmemiş
                                            <?php }?>

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group" style="font-weight: 400">
                                            <label style="font-weight: 500" for="basLik">Sipariş Adresi</label><br>

                                            <?=$row['adres']?>

                                            - <strong><?=$row['sehir']?></strong> -

                                            Posta Kodu : <strong><?=$row['postakodu']?></strong>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="font-weight: 400">
                                            <label style="font-weight: 500" for="basLik">Fatura Adresi</label><br>

                                            <?=$row['adres_fatura']?>

                                        </div>
                                    </div>


                                </div>


                            </form>

                        </div>
                    </div>
                </div>

            </div>

            <div style="font-size:15px; font-weight: 500" class="alert alert-danger">
                <i class="fa fa-info-circle"></i> Kargo bilgisi girdikten sonra müşteriyi bilgilendirmek için kargo bilgisi girilmiş ürünlerin altında çıkan <strong>"Bildirim Gönder"</strong> butonuna tıklayınız.
            </div>
            <div style="font-size:15px; font-weight: 500" class="alert alert-info">
                <i class="fa fa-info-circle"></i> Bildirimlerin gönderilmesi için SMTP veya SMS sistemlerinizden en az birisinin aktif ve sorunsuzca çalışıyor olması gerekmektedir.
            </div>
            <div class="row m-t-20">



                <div class="col-md-12">
                    <h4 style="font-weight: 500"><i class="mdi mdi-cart" style="margin-right: 10px"></i>Sipariş Edilen Ürünler <span style="font-size:18px; font-weight: 400">(<?=$urunleriCek->rowCount()?>)</span></h4>
                    <hr>

                    <div class="row ">

                        <?php foreach ($urunleriCek as $urun) {

                        $asilurun = $db->prepare("select * from urun where id='$urun[urun_id]'");
                        $asilurun ->execute();
                        $asil = $asilurun ->fetch(PDO::FETCH_ASSOC);

                            $kargodurum = $db->prepare("select * from kargo where siparis_urun_id='$urun[id]'");
                            $kargodurum ->execute();
                            $kargo = $kargodurum ->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="card m-10" style="width: 18rem; border:1px solid #EBEBEB">
                            <center><img class="card-img-top m-t-10" src="../images/product/<?=$asil['gorsel']?>" style="width: 150px !important;" ></center>
                            <div class="card-body m-t-10" style="border-top:1px solid #EBEBEB">
                                <h5 class="card-title"><?=$asil['baslik']?></h5>
                                <?php if($urun['varyantlar'] == !null) {
                                    $metin = $urun['varyantlar'];
                                    $sonuc = str_replace(',', '<span style="padding-left:5px; padding-right: 5px;">-</span>', $metin);
                                    ?>
                                <hr>
                                <p class="card-text" style="font-weight: 400">Ürün Seçenekleri : <br>
                                    <span style="font-size:13px; font-weight: 600;"><?=$sonuc?></span>
                                </p>
                                <?php }?>
                                <hr>
                                <p class="card-text" style="font-weight: 400">Adet : <b><?=$urun['adet']?></b></p>
                                <hr>
                                <p class="card-text" style="font-weight: 400">Ürün Kodu : <b><?=$asil['urun_kod']?></b></p>

                                <?php
                                if ($kargodurum->rowCount() == !null) {
                                ?>
                                    <hr>
                                <p class="card-text" style="font-weight: 400">Kargo Firması : <b><?=$kargo['kargo_adi']?></b></p>
                                <hr>
                                <p class="card-text" style="font-weight: 400">Takip No : <b><?=$kargo['takip_no']?></b></p>
                                <?php }?>
                                <?php
                                if ($kargodurum->rowCount() == null) {
                                ?>
                                    <hr>
                                 <a href="pages.php?sayfa=kargoekle&sip_urun_id=<?=$urun['id']?>" class="btn btn-primary "><i class="fa fa-truck"></i> Kargo Bilgisi Ekle</a>

                                <?php } else {?>
                                    <hr>
                                <a href="pages.php?sayfa=kargoduzenle&kargo_id=<?=$kargo['id']?>" class="btn btn-danger "><i class="fa fa-paint-brush"></i> Kargo Bilgisini Düzenle</a>

                                <?php }?>
                                <?php
                                if ($kargodurum->rowCount() == !null ) {
                                ?>
                                        <?php if ($ayar['smtp_durum'] == 1 || $sms['durum'] == 1) {?>
                                        <hr>
                                <a href="support/post/insert/kargo-bildirim-gonder.php?kargobildirim=success&kargo_id=<?=$kargo['id']?>" class="btn btn-success"><i class="fa fa-send"></i> Müşteriye Bildirim Gönder</a>
                                        <?php }?>
                                <?php }?>
                            </div>
                        </div>

                        <?php }?>


                    </div>

                </div>

            </div>


        </div>

        <?php } else {?>

            <div class="alert alert-danger" style="font-size:15px; font-weight: 500">
                <i class="fa fa-exclamation-circle"></i> Normal siparişler için kargo modülü kullanılamaz! Kredi kartı veya Havale/EFT seçenekleriyle sepet üzerinden satın alınan ürünler için geçerlidir.
            </div>

        <?php }?>



    </div>
</div>





<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'Seçtiğiniz ürüne kargo bilgisi eklenmiştir. Bildirim Gönder butonuna tıklayarak bilgi gönderebilirsiniz', 'success');">
    </body>
<?php }?>
<?php if( $_GET['status']=='bildirimok'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'SMS veya SMTP Ayarlarınız hatasız ise bildirim gönderilmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="4; URL=pages.php?sayfa=kargo&siparis_id=<?=$_GET['siparis_id']?>">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=kargo&siparis_id=<?=$_GET['siparis_id']?>">
<?php }?>
