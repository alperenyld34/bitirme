<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Yeni Hesap Bilgisi Ekle | <?=$ayar['site_baslik']?></title>
<?php
$Siralama = $db->prepare("select * from banka where durum='1' ");
$Siralama->execute();
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-bank"></i> Yeni Hesap Bilgisi Ekle</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=bankalar">Banka Hesap Numaraları</a></li>
                <li class="breadcrumb-item active">Yeni Hesap Bilgisi Ekle</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/insert/banka-ekle.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">


                    <h3 class="card-title">Yeni Hesap Bilgisi Ekle</h3>
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
                            <label class="control-label text-right col-md-3" for="katAdi" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Banka Adı</label>
                            <div class="col-md-6">
                                <input type="text" name="banka_adi" required class="form-control" id="katAdi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="hesapSahibi" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Hesap Sahibi</label>
                            <div class="col-md-6">
                                <input type="text" name="hesap_sahibi" required class="form-control" id="hesapSahibi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="ibanNo" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">IBAN Numarası</label>
                            <div class="col-md-6">
                                <input type="text" name="iban" class="form-control" id="ibanNo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="subeNo" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Şube Numarası</label>
                            <div class="col-md-6">
                                <input type="text" name="sube" class="form-control" id="subeNo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="hespNo" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Hesap Numarası</label>
                            <div class="col-md-6">
                                <input type="number" name="hesap_no" class="form-control" id="hespNo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="tavSiye" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600">Banka Logosu</label>
                            <div class="col-md-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="gorsel" required >
                                    <label class="custom-file-label" for="inputGroupFile04">Seç</label>
                                </div>
                            </div>
                        </div>



                        <div class="form-actions">
                            <button type="submit" class="btn btn-success" name="bankaekle">
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