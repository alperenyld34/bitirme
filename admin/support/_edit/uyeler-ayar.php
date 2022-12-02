<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Üyelik Ayarları | <?=$ayar['site_baslik']?></title>
<?php
$degerCek = $db->prepare("select * from uyeler_ayar where id='1' order by id desc limit 1 ");
$degerCek->execute();
$row = $degerCek->fetch(PDO::FETCH_ASSOC);
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-account-multiple"></i> Üyelik Ayarları</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Üyelik Ayarları</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/update/uyeler-ayar.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="beceri_id" value="<?=$row['id']?>">

                    <h3 class="card-title">Üyelik Ayarları</h3>
                    <hr>
                    <div class="form-body">


                                <div class="alert alert-primary" style="font-size: 14px; font-family: 'Open Sans', Arial; font-weight: 500; margin-bottom: 35px;">
                                    Header alanındaki üyelik ikonu ve renk ayarları için <a href="pages.php?sayfa=headermenuayar">header ayarları</a> sayfasına gidiniz. Üyelik sistemi pasif ise header alanında ikon görünmeyecektir
                                </div>
          

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="yayinDurum" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600">Üyelik Sistemi</label>
                            <div class="col-md-6">
                                <input type='hidden' value='0' name='durum'>
                                <input type="checkbox" <?php if($row['durum'] == 1){?>checked<?php }?> id="yayinDurum" class="js-switch" data-color="#f62d51" name="durum" value="1" />
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="sms_ekle" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600">Üye Olanların Telefon Numarasını
                                <br> SMS Rehberine Ekle</label>
                            <div class="col-md-6">
                                <input type='hidden' value='0' name='sms_ekle'>
                                <input type="checkbox" <?php if($row['sms_ekle'] == 1){?>checked<?php }?> id="sms_ekle" class="js-switch" data-color="#f62d51" name="sms_ekle" value="1" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="eposta_ekle" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600">Üye Olanların E-Posta Adresini
                                <br>E-Bülten Listesine Ekle</label>
                            <div class="col-md-6">
                                <input type='hidden' value='0' name='eposta_ekle'>
                                <input type="checkbox" <?php if($row['eposta_ekle'] == 1){?>checked<?php }?> id="eposta_ekle" class="js-switch" data-color="#f62d51" name="eposta_ekle" value="1" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="adres_alani" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600">Üye Paneli - Adres Ekleme Sayfası</label>
                            <div class="col-md-6">
                                <input type='hidden' value='0' name='adres_alani'>
                                <input type="checkbox" <?php if($row['adres_alani'] == 1){?>checked<?php }?> id="adres_alani" class="js-switch" data-color="#f62d51" name="adres_alani" value="1" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="destek_alani" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600">Üye Paneli - Destek Mesajları Sayfası</label>
                            <div class="col-md-6">
                                <input type='hidden' value='0' name='destek_alani'>
                                <input type="checkbox" <?php if($row['destek_alani'] == 1){?>checked<?php }?> id="destek_alani" class="js-switch" data-color="#f62d51" name="destek_alani" value="1" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="siparisler_alani" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600">Üye Paneli - Siparişler Sayfası</label>
                            <div class="col-md-6">
                                <input type='hidden' value='0' name='siparisler_alani'>
                                <input type="checkbox" <?php if($row['siparisler_alani'] == 1){?>checked<?php }?> id="siparisler_alani" class="js-switch" data-color="#f62d51" name="siparisler_alani" value="1" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="yorumlar_alani" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600">Üye Paneli - Üyenin Ürün Yorumları Sayfası</label>
                            <div class="col-md-6">
                                <input type='hidden' value='0' name='yorumlar_alani'>
                                <input type="checkbox" <?php if($row['yorumlar_alani'] == 1){?>checked<?php }?> id="yorumlar_alani" class="js-switch" data-color="#f62d51" name="yorumlar_alani" value="1" />
                            </div>
                        </div>
                        <?php //TODO Burada ekleme var ?>
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="asda" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600"></label>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success" name="ayardegis">
                                    <i class="fa fa-refresh fa-spin fa-fw"></i>
                                    <span class="sr-only">Yükleniyor...</span> Ayarları Güncelle
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
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=uyeayar">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=uyeayar">
<?php }?>