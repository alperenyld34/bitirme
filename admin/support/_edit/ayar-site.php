<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Site Ayarları | <?=$ayar['site_baslik']?></title>


<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="ti-settings"></i> Site Ayarları</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Site Ayarları</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/update/ayar-site.php" class="form-horizontal form-bordered" method="post">

                    <h3 class="card-title">Site Ayarları</h3>
                    <hr>
                    <div class="form-body">

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="siteAd" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Site Başlık</label>
                            <div class="col-md-6">
                                <input type="text" id="siteAd" class="form-control" required name="site_baslik" value="<?=$ayar['site_baslik']?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="siteSlogan" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Site Slogan</label>
                            <div class="col-md-6">
                                <input type="text" id="siteSlogan"  class="form-control" required name="site_slogan" value="<?=$ayar['site_slogan']?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="siteAdresiURL" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600"><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="left" title="Site urlnizin sonuna / mutlaka ekleyin"></i> Site URL</label>
                            <div class="col-md-6">
                                <input type="text" id="siteAdresiURL"  class="form-control" required name="site_url" value="<?=$ayar['site_url']?>">
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="siteAdresiURL" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Kısa Site Açıklaması</label>
                            <div class="col-md-6">
                            <textarea name="site_desc" class="form-control"><?=$ayar['site_desc']?></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="siteayardegis">
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
    <meta http-equiv="refresh" content="2; URL=index.php">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="2; URL=index.php">
<?php }?>


