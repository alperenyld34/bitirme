<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Şifre Değişikliği | <?=$ayar['site_baslik']?></title>
<?php
$yonetici_kontrol2 = $db->prepare("select * from yonetici where user_adi='$_SESSION[admin_username]'");
$yonetici_kontrol2->execute();
$yonet = $yonetici_kontrol2->fetch(PDO::FETCH_ASSOC);

?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-key"></i>  Şifre Değişikliği </h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=yonetici">Yöneticiler</a></li>
                <li class="breadcrumb-item active">Şifre Değişikliği </li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">




        <div class="card">

            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/update/yoneticiler-sifre-degis.php" class="form-horizontal form-bordered" method="post"  enctype="multipart/form-data">

                    <input type="hidden" name="yonetici_id" value="<?=$yonet['id']?>">

                    <h3 class="card-title">Şifre Değişikliği </h3>
                    <hr>
                    <div class="form-body">


                        <div class="form-body form-horizontal form-bordered m-t-40">


                            <div class="form-group row">
                                <label class="control-label text-right col-md-3" for="newPass" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Yeni Şifreniz</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" name="sifre" required id="newPass" aria-describedby="basic-addon1" >
                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="sifredegis">
                            <i class="fa fa-refresh fa-spin fa-fw"></i>
                            <span class="sr-only">Yükleniyor...</span> Güncelle
                        </button>
                    </div>



                </form>

            </div>


        </div>

    </div>
</div>



<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('Şifre Değişti!', 'Devam edebilmek için tekrar giriş yapınız.', 'success');">
    </body>
    <meta http-equiv="refresh" content="3; URL=logout.php">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=yonetici">
<?php }?>


