<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Mesaj Detayı| <?=$ayar['site_baslik']?></title>
<?php
$mesajdetay = $db ->prepare("select * from mesaj where id='$_GET[mesaj_id]' order by id desc");
$mesajdetay ->execute();
$mesajoku = $mesajdetay->fetch(PDO::FETCH_ASSOC);

$mesajDurum = $db->prepare("UPDATE mesaj SET durum = 0 WHERE id='$_GET[mesaj_id]'  ");
$mesajDurum->execute();
?>
<?php
if($mesajdetay->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=mesajlar");
}
?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-email"></i> Mesaj Detayı</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=mesajlar">Gelen Kutusu</a></li>
                <li class="breadcrumb-item active">Mesaj Detayı</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">





    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form class="form-bordered">

                <h3 class="card-title">Mesaj Detayı</h3>
                <hr>

                <div style="border-bottom:1px solid #EBEBEB; margin-bottom:20px">
                    <a href="pages.php?sayfa=mesajlar" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                    <br><br>
                </div>

                <div class="row" style="font-family: 'Open Sans', Arial; font-size:15px;">

                    <div class="col-md-6">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Gönderen</label><br>

                            <?=$mesajoku['isim']?>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Gönderilme Tarihi</label><br>

                            <?php echo date_tr('j F Y, H:i, l ', ''.$mesajoku['tarih'].''); ?>

                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Telefon Numarası</label><br>

                            <?=$mesajoku['telno']?>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">E-Posta Adresi</label><br>

                            <?=$mesajoku['eposta']?>

                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group" style="font-weight: 400">
                            <label style="font-weight: 500" for="basLik">Mesaj</label><br>

                            <?=$mesajoku['mesaj']?>

                        </div>
                    </div>


                </div>
                    <a href="pages.php?sayfa=tekilmailgonder&mail=<?=$mesajoku['eposta']?>" class="btn btn-danger"><i class="fa fa-reply-all"></i> Cevap Yaz</a>


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

