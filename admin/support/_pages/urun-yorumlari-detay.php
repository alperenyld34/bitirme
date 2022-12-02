<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Ürün Yorumu| <?=$ayar['site_baslik']?></title>
<?php
$yorumDetay = $db ->prepare("select * from urun_yorum where id='$_GET[yorum_id]' order by id desc");
$yorumDetay ->execute();
$yorum = $yorumDetay->fetch(PDO::FETCH_ASSOC);

$uyeyiCek = $db->prepare("select * from uyeler where id=:id ");
$uyeyiCek->execute(array(
    'id' => $yorum['uye_id']
));
$uye = $uyeyiCek->fetch(PDO::FETCH_ASSOC);

    $urunCekCek = $db->prepare("select * from urun where id=:id ");
        $urunCekCek->execute(array(
                'id' => $yorum['urun_id']
        ));
        $urun = $urunCekCek->fetch(PDO::FETCH_ASSOC);
?>
<?php if($_GET['do'] == 'active'  ) { //TODO BU SAYFA DA EKLENDİ?>
    <?php
    $updateComment = $db->prepare("UPDATE urun_yorum SET onay = 1 WHERE id=:id  ");
    $updateComment->execute(array(
        'id' => $_GET['yorum_id']
    ));
    ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=onaybekleyenyorumlar">
<?php }?>
<?php
if($yorumDetay->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=onaybekleyenyorumlar");
}
?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-email"></i> Ürün Yorumu</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=urunler">Ürünler</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=onaybekleyenyorumlar">Onay Bekleyen Yorumlar</a></li>
                <li class="breadcrumb-item active">Ürün Yorumu Detayları</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">





    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form class="form-bordered">

                <h3 class="card-title">Ürün Yorumu Detayları</h3>
                <hr>

                <div style="border-bottom:1px solid #EBEBEB; margin-bottom:20px">
                    <?php if($yorum['onay'] == '0' ) {?>
                        <a href="pages.php?sayfa=onaybekleyenyorumlar" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                    <?php }?>
                    <?php if($yorum['onay'] == '1' ) {?>
                        <a href="pages.php?sayfa=onayliyorumlar" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                    <?php }?>
                    <?php if($yorum['onay'] == '0'  ) {?>
                        <a href="pages.php?sayfa=urunyorumu&yorum_id=<?=$yorum['id']?>&do=active" class="btn btn-success"><i class="fa fa-check"></i> Yorumu Onayla</a>
                    <?php }?>
                    <br><br>
                </div>

                <div class="row" style="font-family: 'Open Sans', Arial; font-size:15px;">
                    <div class="col-md-6">
                        <div class="form-group" style="font-weight: 400;font-size: 18px;">
                            <label style="font-weight: 500" for="basLik">Ürün Bağlantısı</label><br>

                            <?php if($urunCekCek->rowCount()>0  ) {?>
                                <a href="<?=$ayar['site_url']?>urun/<?=$urun['id']?>/<?=seo($urun['baslik'])?>" target="_blank" style="color: #000;">
                                    <i class="fa fa-external-link"></i>
                                    <?=$urun['baslik']?>
                                </a>
                            <?php }?>
                 

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="font-weight: 400;font-size: 18px;">
                            <label style="font-weight: 500" for="basLik">Durumu</label><br>

                            <?php if($yorum['onay'] =='0' ) {?>
                            <div class="btn btn-sm btn-warning"><i class="fa fa-spinner fa-spin fa-fw"></i>
                            <span class="sr-only">Loading...</span> Onay Bekliyor</div>
                            <?php }?>

                            <?php if($yorum['onay'] =='1' ) {?>
                            <div class="btn btn-sm btn-success">
                            <i class="fa fa-check"></i> Onaylandı
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="font-weight: 400;font-size: 18px;">
                            <label style="font-weight: 500" for="basLik">Yorumu Yapan Üye</label><br>

                            <a href="pages.php?sayfa=uye&uye_id=<?=$uye['id']?>" target="_blank">
                                <i class="fa fa-user"></i> <?=$uye['isim']?> <?=$uye['soyisim']?>
                            </a>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" style="font-weight: 400;font-size: 18px;">
                            <label style="font-weight: 500" for="basLik">Gönderilme Tarihi</label><br>

                            <?php echo date_tr('j F Y, H:i, l ', ''.$yorum['tarih'].''); ?>

                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group" style="font-weight: 400; font-size: 18px;">
                            <label style="font-weight: 500" for="basLik">Değerlendirme Puanı</label><br>

                            <?php if($yorum['yildiz'] == 0){ ?>
                                <span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($yorum['yildiz'] == 1){ ?>
                                <span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($yorum['yildiz'] == 2){ ?>
                                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($yorum['yildiz'] == 3){ ?>
                                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($yorum['yildiz'] == 4){ ?>
                                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($yorum['yildiz'] == 5){ ?>
                                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span>
                            <?php }?>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" style="font-weight: 400;font-size: 18px;">
                            <label style="font-weight: 500" for="basLik">Yorum Başlığı</label><br>

                            <?=$yorum['baslik']?>

                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group" style="font-weight: 400;font-size: 18px;">
                            <label style="font-weight: 500" for="basLik">Yorum İçeriği</label><br>

                            <?=$yorum['yorum']?>

                        </div>
                    </div>


                </div>


                </form>

            </div>
        </div>
    </div>




</div>




<script type="text/javascript">

    function deletebutton(mesajid){

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
                window.location.href = "support/post/delete/mesaj-sil.php?mesaj=success&id="+mesajid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>

<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=mesajlar">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=mesajlar">
<?php }?>

