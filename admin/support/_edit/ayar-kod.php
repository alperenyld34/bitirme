<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Kod Ekleme Alanı| <?=$ayar['site_baslik']?></title>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-code-braces"></i> Ekstra Kod Ekleme Alanı</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Ekstra Kod Ekleme Alanı</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">






            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/update/ayar-kod.php" class="form-horizontal form-bordered" method="post">

                    <h3 class="card-title">Ekstra Kod Ekleme Alanı</h3>
                    <hr>
                    <div class="form-body">



                      <div class="row">





                          <div class="form-group col-md-12">
                              

                              <textarea name="canli_destek_kodu" id="CanliDestek" class="form-control bg-dark" rows="12" style="color:#FFF" ><?=$ayar['canli_destek_kodu']?></textarea>

                             


                              </div>

                          </div>



                      </div>


                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="koddegis">
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
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=kodekle">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=kodekle">
<?php }?>


