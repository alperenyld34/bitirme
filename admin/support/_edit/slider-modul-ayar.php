<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Slider Modül Ayarları | <?=$ayar['site_baslik']?></title>
<?php
$bilgiCek = $db->prepare("select * from slider_ayar where id='1' ");
$bilgiCek->execute();
$row = $bilgiCek->fetch(PDO::FETCH_ASSOC);
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="ti-layout-slider"></i> Slider Modül Ayarları</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=sliderlar">Slider</a></li>
                <li class="breadcrumb-item active">Slider Modül Ayarları</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/update/slider-modul-ayar.php" class="form-horizontal form-bordered" method="post">

                    <h3 class="card-title">Slider Modül Ayarları</h3>
                    <hr>
                    <div class="form-body">




                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="smtpHost" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Slider Genişliği</label>
                            <div class="col-md-6">
                                <select name="width" class="form-control" >
                                    <option value="0" <?php if($row['width'] == 0 ) { ?> selected <?php }?>>Geniş</option>
                                    <option value="1" <?php if($row['width'] == 1 ) { ?> selected <?php }?>>Kutu</option>
                                </select>
                                <br><br>
                                <small class="form-control-feedback text-purple" style="font-size:13px">Geniş seçilirse %100, Kutu seçilirse %90 genişlk olur.</small>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="altslider" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Slider Font Tipi</label>
                            <div class="col-md-6">
                                <select name="font" class="form-control" >
                                    <option value="Raleway" <?php if($row['font'] == 'Raleway' ) { ?> selected <?php }?>>Raleway</option>
                                    <option value="Open Sans" <?php if($row['font'] == 'Open Sans' ) { ?> selected <?php }?>>Open Sans</option>
                                </select>
                                <br><br>
                                <small class="form-control-feedback text-purple" style="font-size:13px">Slider yazılarının font tipini seçebilirsiniz</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="altslider" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Slider Yükseklik Masaüstü</label>
                            <div class="col-md-6">
                                <select name="height" class="form-control" >
                                    <option value="0" <?php if($row['height'] == '0' ) { ?> selected <?php }?>>Uzun (Yükseklik : 800px)</option>
                                    <option value="1" <?php if($row['height'] == '1' ) { ?> selected <?php }?>>Normal (Yükseklik : 660px)</option>
                                </select>
                                <br><br>
                                <small class="form-control-feedback text-purple" style="font-size:13px">ideali normal'dir. Uzun : 800px , Normal : 660px'dir. Sadece masaüstü cihazlar için geçerlidir.</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="altslider" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Slider Yükseklik Mobil</label>
                            <div class="col-md-6">
                                <input type="number" name="mobil_height" value="<?=$row['mobil_height']?>" class="form-control" required min="150">
                                <br><br>
                                <small class="form-control-feedback text-purple" style="font-size:13px">İdeal : 400'dür. Mobil cihazlardaki slider yükseklik alanıdır. Px cinsinden değer giriniz.</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="altslider" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Orta Slider Genişliği</label>
                            <div class="col-md-6">
                                <select name="width_2" class="form-control" >
                                    <option value="0" <?php if($row['width_2'] == 0 ) { ?> selected <?php }?>>Geniş</option>
                                    <option value="1" <?php if($row['width_2'] == 1 ) { ?> selected <?php }?>>Kutu</option>
                                </select>
                                <br><br>
                                <small class="form-control-feedback text-purple" style="font-size:13px">Geniş seçilirse %100, Kutu seçilirse %90 genişlk olur.</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="asxxdasd" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600"></label>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success" name="sliderayar">
                                    <i class="fa fa-refresh fa-spin fa-fw"></i>
                                    <span class="sr-only">Yükleniyor...</span> Bilgileri Güncelle
                                </button>
                            </div>
                        </div>



                </form>


                    </div>



            </div>







        </div>
    </div>
</div>



<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'Güncelleme işleminiz gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=slidermodul">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=slidermodul">
<?php }?>
<?php if($_GET['status']=='imgtype'){ ?>
    <body onload="sweetAlert('HATA!', 'Görsel dosyanız jpg, png veya gif türü dışında olamaz', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=slidermodul">
<?php }?>

