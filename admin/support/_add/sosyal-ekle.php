<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Yeni Sosyal Medya Hesabı Ekle | <?=$ayar['site_baslik']?></title>
<?php
$Siralama = $db->prepare("select * from sosyal ");
$Siralama->execute();


?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-share-variant"></i> Yeni Sosyal Medya Hesabı Ekle</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=sosyalmedyalar">Sosyal Medya Hesapları</a></li>
                <li class="breadcrumb-item active">Yeni Sosyal Medya Hesabı Ekle</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/insert/sosyal-ekle.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">

                    <h3 class="card-title">Yeni Sosyal Medya Hesabı Ekle</h3>
                    <hr>
                    <div class="form-body">


                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="siraArea" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Sırası</label>
                            <div class="col-md-1">
                                <input type="number" name="sira" required class="form-control" id="siraArea" value="<?=$Siralama->rowCount()+1;?>"  min=1 oninput="validity.valid||(value='');">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="katAdi" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Sosyal Medya Adı</label>
                            <div class="col-md-6">
                                <input type="text" name="baslik" required class="form-control" id="katAdi">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="iconn" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">İkon</label>
                            <div class="col-md-6">
                                <select class="selectpicker col-md-12 p-l-0 p-r-0 awesome-select" data-style="form-control btn-secondary" name="icon" >
                                    <?php include 'support/panel_parts/icon.php'?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="ozlspot" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Hesap URL</label>
                            <div class="col-md-6">
                                <input type="text" name="url" required class="form-control" id="ozlspot" placeholder="http://">
                            </div>
                        </div>


                        <div class="form-actions">
                            <button type="submit" class="btn btn-success" name="sosyalekle">
                                <i class="fa fa-save"></i>
                                Kaydet
                            </button>
                        </div>



                </form>

                    </div>



            </div>







        </div>
    </div>
</div>
