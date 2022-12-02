<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Tema Ayarları | <?=$ayar['site_baslik']?></title>
<?php
$footerayar=$db->prepare("select * from footer_ayar where id='1' order by id");
$footerayar->execute();
$footer = $footerayar->fetch(PDO::FETCH_ASSOC);
?>


<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="ti-palette"></i> Tema Ayarları</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Tema Ayarları</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">


                    <h3 class="card-title">Tema Ayarları</h3>
                    <hr>
                    <div class="form-body">




                        <div class="row p-t-20" style="border-bottom:1px solid #EBEBEB">


                                <div class="col-md-3">
                                    <form action="support/post/update/logo-site.php"  method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label" for="siteLogo" style="margin-bottom: 13px; font-weight: 600">Header Logo</label>
                                        <br>
                                        <small class="form-control-feedback text-info"> Max genişlik : 220px</small>
                                        <div style="width: 100%; height: auto; background-color: #F9F9F9; border:1px solid #EBEBEB; padding: 15px; 0 15px 0; text-align: center; margin-top:8px;">
                                            <img src="../images/logo/<?=$ayar['site_logo']?>" alt="" style="max-width: 220px;">
                                        </div>

                                        <input type="hidden" name="eski_logo" value="<?=$ayar['site_logo']?>" >



                                        <div class="input-group" style="margin-top: 8px">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile04" lang="es" aria-describedby="inputGroupFileAddon04" name="site_logo" required>
                                                <label class="custom-file-label" for="inputGroupFile04">Seç</label>
                                            </div>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-info" name="sitelogodegis">
                                                    <i class="fa fa-refresh fa-spin fa-fw"></i>
                                                    <span class="sr-only">Yükleniyor...</span> Güncelle
                                                </button>
                                            </div>
                                        </div>



                                    </div>
                                    </form>
                                </div>
                            <style>

                            </style>

                            <div class="col-md-3">
                                <form action="support/post/update/logo-mobil.php"  method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label" style="margin-bottom: 13px; font-weight: 600">Mobil - Responsive Logo</label>
                                        <br>
                                        <small class="form-control-feedback text-info"> Max genişlik : 150px</small>
                                        <div style="width: 100%; height: auto; background-color: #F9F9F9; border:1px solid #EBEBEB; padding: 15px; 0 15px 0; text-align: center;  margin-top:8px;">
                                            <img src="../images/logo/<?=$ayar['site_mobil_logo']?>" alt="" style="max-width: 220px;">
                                        </div>

                                        <input type="hidden" name="eski_mobil_logo" value="<?=$ayar['site_mobil_logo']?>" >

                                        <div class="input-group" style="margin-top: 8px">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="site_mobil_logo" required>
                                                <label class="custom-file-label" for="inputGroupFile04">Seç</label>
                                            </div>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-info" name="mobillogodegis">
                                                    <i class="fa fa-refresh fa-spin fa-fw"></i>
                                                    <span class="sr-only">Yükleniyor...</span> Güncelle
                                                </button>
                                            </div>
                                        </div>




                                    </div>
                                </form>
                            </div>


                            <div class="col-md-3">
                                <form action="support/post/update/logo-footer.php"  method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label" style="margin-bottom: 13px; font-weight: 600">Footer Logo</label>
                                    <br>
                                    <small class="form-control-feedback text-info"> Max genişlik : 220px</small>
                                    <div style="width: 100%; height: auto; <?php if($footer['tip'] == 0) {?>background-color: #333;<?php } else {?> background-color: #F8F8F8;<?php }?> border:1px solid #EBEBEB; padding: 15px; 0 15px 0; text-align: center;  margin-top:8px;">
                                        <img src="../images/logo/<?=$ayar['site_footer_logo']?>" alt="" style="max-width: 220px;">
                                    </div>

                                    <input type="hidden" name="eski_footer_logo" value="<?=$ayar['site_footer_logo']?>" >


                                    <div class="input-group" style="margin-top: 8px">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="site_footer_logo" required>
                                            <label class="custom-file-label" for="inputGroupFile04">Seç</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-info" name="footerlogodegis">
                                                <i class="fa fa-refresh fa-spin fa-fw"></i>
                                                <span class="sr-only">Yükleniyor...</span> Güncelle
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                </form>
                            </div>




                            <div class="col-md-3">
                                <form action="support/post/update/favicon.php"  method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label" style="margin-bottom: 13px; font-weight: 600">Favicon</label>
                                    <br>
                                    <small class="form-control-feedback text-info"> İdeal Ebat : 32x32  -  PNG veya .ico türü olmalıdır</small>
                                    <div style="width: 100%; height: auto; background-color: #FFF; border:1px solid #EBEBEB; padding: 15px; 0 15px 0; text-align: center;  margin-top:8px;">
                                        <img src="../images/<?=$ayar['site_favicon']?>" alt="" style="max-width: 32px;">
                                    </div>

                                    <input type="hidden" name="eski_favicon" value="<?=$ayar['site_favicon']?>" >



                                    <div class="input-group" style="margin-top: 8px">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile11" aria-describedby="inputGroupFileAddon04" name="site_favicon"required>
                                            <label class="custom-file-label" for="inputGroupFile11" >Seç</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-danger" name="favicondegis" >
                                                <i class="fa fa-refresh fa-spin fa-fw"></i>
                                                <span class="sr-only">Yükleniyor...</span> Güncelle
                                            </button>
                                        </div>
                                    </div>



                                </div>
                                </form>
                            </div>


                        </div>


                        <form action="support/post/update/ayar-tema.php" class="form-horizontal" method="post">


                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" style="margin-bottom: 13px; font-weight: 600">Captcha Sistemi</label>
                                    <br>
                                    <small class="form-control-feedback text-danger" style="font-size:13px"> Güvenlik kodu <strong>iletişim,insan kaynakları ve sipariş formunda</strong> kullanılmaktadır</small>
                                    <br><br>
                                    <input type='hidden' value='0' name='site_captcha'>
                                    <input type="checkbox" <?php if($ayar['site_captcha'] == 1){?>checked<?php }?> class="js-switch" data-color="#f62d51" name="site_captcha" value="1" />

                                </div>
                            </div>


                        </div>

                            <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="totopDurum" style="margin-bottom: 13px; font-weight: 600">Yukarı Çık Butonu</label>
                                        <br>
                                        <small class="form-control-feedback text-danger" style="font-size:13px"> Scroll aşağı indikçe sağ altta çıkar</small>
                                        <br><br>
                                        <input type='hidden' value='0' name='totop'>
                                        <input type="checkbox" <?php if($ayar['totop'] == 1){?>checked<?php }?> class="js-switch" data-color="#f62d51" id="totopDurum" name="totop" value="1" />

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="totopBottom" style="margin-bottom: 13px; font-weight: 600">Yukarı Çık Buton Bottom Margin</label>
                                        <br>
                                        <small class="form-control-feedback text-danger" style="font-size:13px"> Aşağıdan boşluk değeri. İdeal : 30 / Sağ altta Canlı destek modülü  var ise değeri arttırabilirsiniz</small>
                                        <br><br>
                                        <input type="number" class="form-control"  id="totopBottom" name="totop_bottom" value="<?=$ayar['totop_bottom']?>" />

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="totopBg" style="margin-bottom: 13px; font-weight: 600">Yukarı Çık Buton Arkaplan</label>
                                        <br>
                                        <small class="form-control-feedback text-danger" style="font-size:13px"> Arkaplan rengini seçebilirsiniz</small>
                                        <br><br>
                                        <input type="text" class="form-control jscolor"  id="totopBg" name="totop_bg" value="<?=$ayar['totop_bg']?>" />

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="totopBgiCon" style="margin-bottom: 13px; font-weight: 600">Yukarı Çık Buton İkon Rengi</label>
                                        <br>
                                        <small class="form-control-feedback text-danger" style="font-size:13px"> İkon rengini seçebilirsiniz</small>
                                        <br><br>
                                        <input type="text" class="form-control jscolor"  id="totopBgiCon" name="totop_icon" value="<?=$ayar['totop_icon']?>" />

                                    </div>
                                </div>

                            </div>

                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" style="margin-bottom: 13px; font-weight: 600">Site Arkaplan Rengi</label>
                                    <br>

                                    <input class="jscolor form-control" value="<?=$ayar['site_bg_color']?>" name="site_bg_color">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" style="margin-bottom: 13px; font-weight: 600">Carousel Sayfalama Rengi</label>
                                    <br>

                                    <input class="jscolor form-control" value="<?=$ayar['dots_color']?>" name="dots_color">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" style="margin-bottom: 13px; font-weight: 600">Telif Yazısı</label>
                                    <br>

                                    <input class="form-control" type="text" value="<?=$ayar['copyright_1']?>" name="copyright_1">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" style="margin-bottom: 13px; font-weight: 600">Telif Yazısı Altı</label>
                                    <br>

                                    <textarea name="copyright_2" class="form-control"  rows="3"><?=$ayar['copyright_2']?></textarea>

                                </div>
                            </div>

                        </div>




                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="temaayardegis">
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
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=temaayar">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=temaayar">
<?php }?>
<?php if($_GET['status']=='imgtype'){ ?>
    <body onload="sweetAlert('HATA!', 'Görsel dosyanız jpg, png veya gif türü dışında olamaz', 'warning');">
    </body>
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=temaayar">
<?php }?>
<?php if($_GET['status']=='favtype'){ ?>
    <body onload="sweetAlert('HATA!', 'Favicon dosya türü PNG veya .ico olmalıdır', 'warning');">
    </body>
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=temaayar">
<?php }?>

