<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Yeni Yönetici Ekle | <?=$ayar['site_baslik']?></title>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-account-edit"></i><i class="mdi mdi-plus"></i> Yeni Yönetici Ekle </h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=yonetici">Yöneticiler</a></li>
                <li class="breadcrumb-item active">Yeni Yönetici Ekle </li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">




        <div class="card">

            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/insert/yonetici-ekle.php" class="form-horizontal form-bordered" method="post"  enctype="multipart/form-data">


                    <h3 class="card-title">Yeni Yönetici Ekle </h3>
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
                                        <input type="text" class="form-control" name="kullaniciadi" required id="siteAd" aria-describedby="basic-addon1" >
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3" for="siteSlogan" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Şifre</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" name="sifre" required id="siteSlogan" aria-describedby="basic-addon1" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3" for="siteAdresiURL" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">İsim Soyisim</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="isim" required >
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="control-label text-right col-md-3" for="" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Profil Fotoğrafı</label>
                                <div class="col-md-6">
                                        <div style="width: 100%; height: auto; background-color: #F9F9F9; border:1px solid #EBEBEB; padding: 15px; 0 15px 0; text-align: center;  margin-top:8px;">
                                            <img src="support/images/user_default.png" style="width: 50px; height: 50px; border-radius: 100%;">
                                            <br><br>
                                            <small class="form-control-feedback text-info" style="font-size:13px; font-weight: 400"> Ebat : 50x50</small>
                                        </div>
                                        <div class="input-group" style="margin-top: 8px">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="foto" >
                                                <label class="custom-file-label" for="inputGroupFile04">Seç</label>
                                            </div>
                                        </div>
                                </div>
                            </div>


                        </div>


                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="yoneticiekle">
                            <i class="fa fa-save"></i>
                           Kaydet
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>
<?php if($_GET['status']=='imgtype'){ ?>
    <body onload="sweetAlert('HATA!', 'Görsel dosyanız jpg, png veya gif türü dışında olamaz', 'warning');">
    </body>
<?php }?>




