<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>İletişim Ayarları | <?=$ayar['site_baslik']?></title>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-email"></i> İletişim Ayarları</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">İletişim Ayarları</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">






            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/update/ayar-iletisim.php" class="form-horizontal form-bordered" method="post">

                    <h3 class="card-title">İletişim Ayarları</h3>
                    <hr>
                    <div class="form-body">



                      <div class="row">

                          <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="siteMail">Site Mail Adresi</label><br><br>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="site_mail" id="siteMail" aria-describedby="basic-addon1" value="<?=$ayar['site_mail']?>">
                                    </div>



                                </div>
                          </div>

                                <div class="form-group col-md-6">
                                    <label style="font-weight: 500" for="siteTel">Site Telefon Numarası</label><br><br>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="site_tel" id="siteTel" aria-describedby="basic-addon1" value="<?=$ayar['site_tel']?>">
                                    </div>

                                </div>



                                <div class="form-group col-md-6">
                                    <label style="font-weight: 500" for="siteGSM">Site GSM Numarası</label><br><br>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-mobile"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="site_gsm" id="siteGSM" aria-describedby="basic-addon1" value="<?=$ayar['site_gsm']?>">
                                    </div>



                                </div>



                                <div class="form-group col-md-6">
                                    <label style="font-weight: 500" for="siteWHT">Site WhatsApp Numarası</label><br><br>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-whatsapp"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="site_whatsapp" id="siteWHT" aria-describedby="basic-addon1" value="<?=$ayar['site_whatsapp']?>">
                                    </div>

                                    <small class="form-control-feedback text-success" style="font-size:13px"><i class="fa fa-info-circle"></i> Sorunsuzca çalışması için "90" ile başlayın. ÖRN : 905554446699</small>


                                </div>



                          <div class="form-group col-md-6">
                              <label style="font-weight: 500" for="adressBilgi">Adres Bilgisi</label><br><br>

                              <textarea name="adres_bilgisi" id="addresBilgi" class="form-control" rows="4" ><?=$ayar['adres_bilgisi']?></textarea>

                          </div>



                          <div class="form-group col-md-6">
                              <label style="font-weight: 500" for="mapsKodu">Google Maps Kodu</label><br><br>

                              <textarea name="site_maps_kodu" id="mapsKodu" class="form-control bg-dark" rows="4" style="color:#FFF" ><?=$ayar['site_maps_kodu']?></textarea>

                              <small class="form-control-feedback text-danger" style="font-size:13px"><i class="fa fa-info-circle"></i> Sunucunuz iframe kodunu kabul etmiyorsa kayıt esnasında problem çıkabilir.</small>

                          </div>


                          <div class="form-group col-md-12">
                              <label style="font-weight: 500" for="workHour">Çalışma Saatleri</label><br><br>

                              <textarea name="site_workhour" id="workHour" class="form-control textarea_editor"  rows="6" ><?=$ayar['site_workhour']?></textarea>

                          </div>


    

                    </div>


                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="iletisimdegis">
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
    <body onload="sweetAlert('İşlem Başarılı', 'Güncelleme işleminiz gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=iletisimayar">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=iletisimayar">
<?php }?>


