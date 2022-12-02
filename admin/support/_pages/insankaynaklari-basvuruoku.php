<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Başvuru Detayı | <?=$ayar['site_baslik']?></title>
<?php
$mesajdetay = $db ->prepare("select * from insan_kaynaklari where id='$_GET[id]' ");
$mesajdetay ->execute();
$mesajoku = $mesajdetay->fetch(PDO::FETCH_ASSOC);

$mesajDurum = $db->prepare("UPDATE insan_kaynaklari SET durum = 0 WHERE id='$_GET[id]'  ");
$mesajDurum->execute();
?>
<?php
if($mesajdetay->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=insankaynaklari");
}
?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-account"></i> Başvuru Detayı</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=insankaynaklari">İnsan Kaynakları</a></li>
                <li class="breadcrumb-item active">Başvuru Detayı</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">





    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form class="form-bordered">

                <h3 class="card-title">Başvuru Detayı</h3>
                <hr>

                <div style="border-bottom:1px solid #EBEBEB; margin-bottom:20px">
                    <a href="pages.php?sayfa=insankaynaklari" class="btn btn-success">Geri Dön</a>
                    <br><br>
                </div>

                <div class="row" style="font-family: 'Open Sans', Arial; font-size:15px;">

                    <div class="col-md-3">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Gönderen</label><br>

                            <?=$mesajoku['isim']?>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Gönderilme Tarihi</label><br>

                            <?php echo date_tr('j F Y, H:i, l ', ''.$mesajoku['tarih'].''); ?>

                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Telefon Numarası</label><br>

                            <?=$mesajoku['telno']?>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">E-Posta Adresi</label><br>

                            <?=$mesajoku['mailadresi']?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">İl/İlçe</label><br>

                            <?=$mesajoku['il']?> / <?=$mesajoku['ilce']?>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Doğum Tarihi</label><br>

                            <?=$mesajoku['d_tarih']?>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Cinsiyet</label><br>

                            <?=$mesajoku['cinsiyet']?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Medeni Durum</label><br>

                            <?=$mesajoku['medeni']?>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Askerlik Durumu</label><br>

                            <?=$mesajoku['askerlik']?>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Ehliyet</label><br>

                            <?=$mesajoku['ehliyet']?>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Kan Gurubu</label><br>

                            <?=$mesajoku['kangrubu']?>

                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Eğitim Durumu</label><br>

                            <?=$mesajoku['egitim']?>

                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Yabancı Dil Durumu</label><br>

                            <?=$mesajoku['yabancidil']?>

                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Önceki Çalışma Deneyimleri</label><br>

                            <?=$mesajoku['tecrube']?>

                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Hakkında Bilgi ve Referansları  </label><br>

                            <?=$mesajoku['kisabilgi']?>

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

