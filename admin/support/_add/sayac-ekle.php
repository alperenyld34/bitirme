<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Yeni Sayaç Bilgisi Ekle | <?=$ayar['site_baslik']?></title>
<?php
$Siralama = $db->prepare("select * from sayac where durum='1' and dil='$_SESSION[dil]' ");
$Siralama->execute();


$CountAyarCek = $db->prepare("select * from sayac_ayar where id='1'");
$CountAyarCek->execute();
$sayacayar = $CountAyarCek->fetch(PDO::FETCH_ASSOC);
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-format-list-numbers"></i> Yeni Sayaç Bilgisi Ekle</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=sayaclar">Sayaç Yönetimi</a></li>
                <li class="breadcrumb-item active">Yeni Sayaç Bilgisi Ekle</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/insert/sayac-ekle.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="dil" value="<?=$_SESSION['dil']?>">

                    <h3 class="card-title">Yeni Sayaç Bilgisi Ekle <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span></h3>
                    <hr>
                    <div class="form-body">


                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="yayinDurum" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600">Yayın Durumu</label>
                            <div class="col-md-6">
                                <input type='hidden' value='0' name='durum'>
                                <input type="checkbox" checked id="yayinDurum" class="js-switch" data-color="#f62d51" name="durum" value="1" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="siraArea" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Sırası</label>
                            <div class="col-md-1">
                                <input type="number" name="sira" required class="form-control" id="siraArea" value="<?=$Siralama->rowCount()+1;?>"  min=1 oninput="validity.valid||(value='');">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="katAdi" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Başlık</label>
                            <div class="col-md-6">
                                <input type="text" name="baslik" required class="form-control" id="katAdi">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="countArea" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Sayı</label>
                            <div class="col-md-2">
                                <input type="number" name="count" required class="form-control" id="countArea" placeholder="50"   min=1 oninput="validity.valid||(value='');">
                            </div>
                        </div>

                        <?php if($sayacayar['icon'] == 1) {?>
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="iconn" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">İkon</label>
                            <div class="col-md-6">
                                <select class="selectpicker col-md-12 p-l-0 p-r-0 awesome-select" data-style="form-control btn-secondary" name="icon" >
                                    <?php include 'support/panel_parts/icon.php'?>
                                </select>
                            </div>
                        </div>
                        <?php } else {?>
                            <input type="hidden" name="icon" value="">
                        <?php }?>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="plsDurum" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600">Sayı Sonuna "+" Ekle</label>
                            <div class="col-md-6">
                                <input type='hidden' value='0' name='plus'>
                                <input type="checkbox"  id="plsDurum" class="js-switch" data-color="#f62d51" name="plus" value="1" />
                            </div>
                        </div>

                        <?php if($sayacayar['icon'] == 0) {?>
                        <div class="alert alert-danger" style="font-size:14px; font-family: 'Open Sans', Arial; font-weight: 500">
                            <i class="fa fa-info-circle"></i> İkon alanınız modül ayarlarında kapalı olduğu için ikon ekleyemezsiniz! Eğer ayarlardan aktif ederseniz ikon seçimi açılacaktır.
                        </div><br>
                        <?php }?>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-success" name="sayacekle">
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

<?php if($_GET['status']=='imgtype'){ ?>
    <body onload="sweetAlert('HATA!', 'Görsel dosyanız jpg, png veya gif türü dışında olamaz', 'warning');">
    </body>
<?php }?>