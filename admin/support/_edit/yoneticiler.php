<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Yönetici Düzenle | <?=$ayar['site_baslik']?></title>
<?php
$yonetici_kontrol = $db->prepare("select * from yonetici where user_adi='$_SESSION[admin_username]' ");
$yonetici_kontrol->execute();
$yon = $yonetici_kontrol->fetch(PDO::FETCH_ASSOC);

$yonetici_kontrol2 = $db->prepare("select * from yonetici where id='$_GET[yonetici_id]'");
$yonetici_kontrol2->execute();
$yonet = $yonetici_kontrol2->fetch(PDO::FETCH_ASSOC);

?>
<?php
if($yonetici_kontrol2->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=yonetici");
}
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-account-edit"></i> Yönetici Düzenle </h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=yonetici">Yöneticiler</a></li>
                <li class="breadcrumb-item active">Yönetici Düzenle </li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">




        <div class="card">
            <?php if ($_GET['yonetici_id'] == $yon['id'] ) {?>
            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/update/yoneticiler.php" class="form-horizontal form-bordered" method="post"  enctype="multipart/form-data">

                    <input type="hidden" name="yonetici_id" value="<?=$yonet['id']?>">

                    <h3 class="card-title">Yönetici Düzenle </h3>
                    <hr>
                    <div class="form-body">





                        <div class="form-body form-horizontal form-bordered m-t-40">



                            <div class="form-group row">
                                <label class="control-label text-right col-md-3" for="siteAd" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Kullanıcı Adı</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="kullaniciadi" value="<?=$yonet['user_adi']?>" required id="siteAd" aria-describedby="basic-addon1" >
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3" for="siteSlogan"   style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Şifre</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-6">
                                        <a href="pages.php?sayfa=sifredegistir">
                                        <label class="control-label text-right badge-secondary p-10"   style=" font-weight: 600; cursor: pointer;">
                                            <i class="fa fa-lock"></i> Şifrenizi değiştirmek için tıklayın
                                        </label>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3" for="siteAdresiURL" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">İsim Soyisim</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="isim" value="<?=$yonet['isim']?>"required >
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="control-label text-right col-md-3" for="" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Profil Fotoğrafı</label>
                                <div class="col-md-6">
                                        <div style="width: 100%; height: auto; background-color: #F9F9F9; border:1px solid #EBEBEB; padding: 15px; 0 15px 0; text-align: center;  margin-top:8px;">
                                            <?php
                                            if ($yonet['foto'] == !null)
                                            {
                                            ?>
                                                <img src="../assets/images/users/<?=$yonet['foto']?>" style="width: 50px; height: 50px; border-radius: 100%;">
                                            <?php } else { ?>
                                            <img src="support/images/user_default.png" style="width: 50px; height: 50px; border-radius: 100%;">
                                            <?php }?>
                                            <br><br>
                                            <small class="form-control-feedback text-info" style="font-size:13px; font-weight: 400"> Ebat : 50x50</small>
                                        </div>
                                        <div class="input-group" style="margin-top: 8px">
                                            <div class="custom-file">
                                                <input type="hidden" name="eski_foto" value="<?=$yonet['foto']?>">
                                                <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="foto" >
                                                <label class="custom-file-label" for="inputGroupFile04">Seç</label>
                                            </div>
                                        </div>
                                </div>
                            </div>


                        </div>




                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="yoneticidegis">
                            <i class="fa fa-refresh fa-spin fa-fw"></i>
                            <span class="sr-only">Yükleniyor...</span> Güncelle
                        </button>
                    </div>



                </form>

            </div>
            <?php } else {?>
            <div style="width: 100%; height: auto; padding: 20px 0 20px 0; font-size:18px; font-weight: 400; text-align: center; ">
               <h2 style="font-weight: bold">HATA!</h2>

                <span>Sayın <strong><?=$yon['isim']?></strong>, sadece kendi profilinizi düzenleyebilirsiniz</span>
                <br><br>
                <a href="pages.php?sayfa=yonetici" class="btn btn-primary">Geri Dön</a>
            </div>
            <?php }?>

        </div>

    </div>
</div>
<?php if($_GET['status']=='imgtype'){ ?>
    <body onload="sweetAlert('HATA!', 'Görsel dosyanız jpg, png veya gif türü dışında olamaz', 'warning');">
    </body>
<?php }?>




