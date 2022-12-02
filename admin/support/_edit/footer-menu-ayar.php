<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Footer Ayarları | <?=$ayar['site_baslik']?></title>
<?php
$footerCek = $db->prepare("select * from footer_ayar where id='1' ");
$footerCek->execute();
$footer = $footerCek->fetch(PDO::FETCH_ASSOC);
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-tag-multiple"></i> Footer Ayarları</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Footer Ayarları</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/update/footer-menu-ayar.php" class="form-horizontal form-bordered" method="post">

                    <h3 class="card-title">Footer Ayarları</h3>
                    <hr>
                    <div class="form-body">




                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="smtpMail" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Footer Tema</label>
                            <div class="col-md-6">
                                <select name="tip" class="form-control">
                                    <option value="0" <?php if($footer['tip'] == 0) {?> selected <?php }?> >Dark</option>
                                    <option value="1" <?php if($footer['tip'] == 1) {?> selected <?php }?>  >Light</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="smtpHost" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Footer Genişliği</label>
                            <div class="col-md-6">
                                <select name="width" class="form-control" >
                                    <option value="0" <?php if($footer['width'] == 0 ) { ?> selected <?php }?>>Geniş</option>
                                    <option value="1" <?php if($footer['width'] == 1 ) { ?> selected <?php }?>>Kutu</option>
                                </select>
                                <br><br>
                                <small class="form-control-feedback text-purple" style="font-size:13px">Geniş seçilirse %100, Kutu seçilirse %90 genişlk olur.</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="gorselOnay" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600">Footer Görsel Alan</label>
                            <div class="col-md-6">
                                <input type='hidden' value='0' name='gorsel_onay'>
                                <input type="checkbox" <?php if($footer['gorsel_onay'] == 1){?>checked<?php }?> id="gorselOnay" class="js-switch" data-color="#f62d51" name="gorsel_onay" value="1" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="asxxdasd" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600"></label>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success" name="footerdegis">
                                    <i class="fa fa-refresh fa-spin fa-fw"></i>
                                    <span class="sr-only">Yükleniyor...</span> Bilgileri Güncelle
                                </button>
                            </div>
                        </div>



                </form>




                        <div class="form-group row">

                            <label class="control-label text-right col-md-3" for="" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Footer Görsel Seçimi</label>
                            <div class="col-md-3">
                                <form action="support/post/update/footer-gorsel.php"  method="post" enctype="multipart/form-data">

                                    <div style="width: 100%; height: auto;
                                    <?php if($footer['tip'] == 0) {?> background-color: #000; <?php }?>
                                    <?php if($footer['tip'] == 1) {?> background-color: #F9F9F9; <?php }?>
                                     border:1px solid #EBEBEB; padding: 15px; 0 15px 0; text-align: center;  margin-top:8px;">
                                        <img src="../images/uploads/<?=$footer['gorsel']?>" alt="" style="max-width: 220px;">
                                    </div>

                                    <input type="hidden" name="eski_footer_gorsel" value="<?=$footer['gorsel']?>" >

                                    <div class="input-group" style="margin-top: 8px">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="gorsel" required>
                                            <label class="custom-file-label" for="inputGroupFile04">Seç</label>
                                        </div>
                                        <div class="input-group-append" style="margin-bottom: 20px;">
                                            <button type="submit" class="btn btn-info" name="footergorselyukle">
                                                <i class="fa fa-refresh fa-spin fa-fw"></i>
                                                <span class="sr-only">Yükleniyor...</span> Güncelle
                                            </button>
                                        </div>

                                        <small class="form-control-feedback text-purple" style="font-size:13px">İdeal Ebat: 380x30 - Footer sağ alt köşede bulunan alan içindir. </small>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>



            </div>







        </div>
    </div>
</div>



<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'Güncelleme işleminiz gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=footermenuayar">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=footermenuayar">
<?php }?>
<?php if($_GET['status']=='imgtype'){ ?>
    <body onload="sweetAlert('HATA!', 'Görsel dosyanız jpg, png veya gif türü dışında olamaz', 'warning');">
    </body>
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=footermenuayar">
<?php }?>

