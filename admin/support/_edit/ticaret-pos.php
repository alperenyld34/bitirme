<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Sanal POS Ayarları | <?=$ayar['site_baslik']?></title>
<?php
$odemeayarlari = $db ->prepare("select * from odeme_ayar where id='1' ");
$odemeayarlari ->execute();
$odeme = $odemeayarlari->fetch(PDO::FETCH_ASSOC);
?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-cart"></i> Sanal POS Ayarları</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Ticaret Ayarları</a></li>
                <li class="breadcrumb-item active">Sanal POS Ayarları</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <div class="card-body p-b-0">
                    <h4 class="card-title">Sanal POS Ayarları</h4>
                    <h6 class="card-subtitle">Aşağıdaki sekmelerden kullandığınız POS firmasının API ayarlarını yapabilirsiniz</h6> </div>



                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist" style="font-family: 'Open Sans', Arial; font-weight: 500">
                    <li class="nav-item" > <a class="nav-link active" data-toggle="tab" href="#ayar" role="tab" ><span class="hidden-sm-up"><i class="ti-settings"></i></span> <span class="hidden-xs-down" >Genel Ayarlar</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#paytr" role="tab"><span class="hidden-sm-up"><i class="ti-credit-card"></i></span> <span class="hidden-xs-down">PayTR</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#shopier" role="tab"><span class="hidden-sm-up"><i class="ti-credit-card"></i></span> <span class="hidden-xs-down">Shopier</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#iyzico" role="tab"><span class="hidden-sm-up"><i class="ti-credit-card"></i></span> <span class="hidden-xs-down">Iyzico</span></a> </li>
                    <li class="nav-item"> <a class="nav-link  " data-toggle="tab" href="#paywant" role="tab"><span class="hidden-sm-up"><i class="ti-credit-card"></i></span> <span class="hidden-xs-down">Paywant</span></a> </li>
                </ul>
                <!-- Tab panes -->
                <form action="support/post/update/ticaret-pos.php" class="form-horizontal form-bordered" method="post">



                <div class="tab-content">
                    <div class="tab-pane active" id="ayar" role="tabpanel">
                        <div class="p-20">




                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500">POS Firması Seçimi</label>
                                        <br><br>
                                        <div class="input-group" >

                                            <select name="pos_tur" class="form-control" >
                                                <option value="0" <?php if($odeme['pos_tur'] == 0 ) { ?> selected <?php }?>>PayTR</option>
                                                <option value="1" <?php if($odeme['pos_tur'] == 1 ) { ?> selected <?php }?>>Iyzico</option>
                                                <option value="2" <?php if($odeme['pos_tur'] == 2 ) { ?> selected <?php }?>>Shopier</option>
                                                <option value="4" <?php if($odeme['pos_tur'] == 4 ) { ?> selected <?php }?>>Paywant</option>
                                            </select>



                                        </div>
                                        <br>
                                        <small class="form-control-feedback text-info" style="font-size:13px">Lütfen firma seçiminin ardından yukarıdaki sekmelerden sanal pos firmasını seçerek API ayarlarını eksiksiz yapınız.</small>

                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                    <div class="tab-pane  p-20" id="paytr" role="tabpanel">

                        <img src="support/images/paytr.png" alt="">
                        <br><br>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="paytrMerchantID">PayTR - Merchant ID</label><br><br>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="paytr_id" id="paytrMerchantID" aria-describedby="basic-addon1" value="<?=$odeme['paytr_id']?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="paytrMerchantKey">PayTR - Merchant Key</label><br><br>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-key"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="paytr_key" id="paytrMerchantKey" aria-describedby="basic-addon1" value="<?=$odeme['paytr_key']?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="paytrMerchantSalt">PayTR - Merchant Salt</label><br><br>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-key"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="paytr_salt" id="paytrMerchantSalt" aria-describedby="basic-addon1" value="<?=$odeme['paytr_salt']?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="paytrBildirimUrl">PayTR Bildirim URL</label><br><br>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-link"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="paytrBildirimUrl" aria-describedby="basic-addon1" value="<?=$ayar['site_url']?>includes/paytrbildirim/bildirim.php" readonly>
                                    </div>

                                    <small>Yukarıdaki bildirim adresini PayTR panelinizin ayarlar kısmındaki bildirim url alanına ekleyiniz</small>

                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane p-20" id="iyzico" role="tabpanel">



                        <img src="support/images/iyzico.png" alt="">
                        <br><br>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="iyzico1">İyzico API Key</label><br><br>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-key"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="iyzico_key" id="iyzico1" aria-describedby="basic-addon1" value="<?=$odeme['iyzico_key']?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="iyzico2">İyzico Güvenlik Anahtarı</label><br><br>



                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-key"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="iyzico_secure" id="iyzico2" aria-describedby="basic-addon1" value="<?=$odeme['iyzico_secure']?>">
                                    </div>

                                </div>
                            </div>
                        </div>





                    </div>
                    <div class="tab-pane p-20" id="shopier" role="tabpanel">



                        <img src="support/images/shopier.png" alt="">
                        <br><br>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="shopier1">Shopier API KEY</label><br><br>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-key"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="shopier_key" id="shopier1" aria-describedby="basic-addon1" value="<?=$odeme['shopier_key']?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="iyzico2">Shopier API Secret</label><br><br>



                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-key"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="shopier_secret" id="iyzico2" aria-describedby="basic-addon1" value="<?=$odeme['shopier_secret']?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="shopGeriDon">Shopier Geri Dönüş URL</label><br><br>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-link"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="shopGeriDon" aria-describedby="basic-addon1" value="<?=$ayar['site_url']?>pages.php?sayfa=shopiersuccess" readonly>
                                    </div>

                                    <small>Yukarıdaki linki shopier panelinize giriş yaptıktan sonra Özelleştirmeler> API Erişimi alanındaki Geri dönüş URL (1) alanına ekleyin</small>

                                </div>
                            </div>
                        </div>




                    </div>


                    <div class="tab-pane p-20" id="payu" role="tabpanel">



                        <img src="support/images/payu.png" alt="">
                        <br><br>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="payu1">Payu Merchant</label><br><br>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-key"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="payu_merchant" id="payu1" aria-describedby="basic-addon1" value="<?=$odeme['payu_merchant']?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="payu2">Payu Secret</label><br><br>



                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-key"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="payu_secret" id="payu2" aria-describedby="basic-addon1" value="<?=$odeme['payu_secret']?>">
                                    </div>

                                </div>
                            </div>
                        </div>




                    </div>


                    <div class="tab-pane p-20" id="paywant" role="tabpanel">



                        <img src="support/images/paywant.png" alt="">
                        <br><br>


                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label style="font-weight: 500">Paywant Ödeme Türleri</label>
                                    <br><br>
                                    <div class="input-group" >

                                        <select name="paywant_odeme_tur" class="selectpicker col-md-12 p-l-0 p-r-0" data-style="form-control btn-secondary"  >
                                            <option value="1,2,3" <?php if($odeme['paywant_odeme_tur'] == '1,2,3' ) { ?> selected <?php }?>>Tümü</option>
                                            <option value="2" <?php if($odeme['paywant_odeme_tur'] == '2' ) { ?> selected <?php }?>>Sadece Kredi Kartı</option>
                                            <option value="1" <?php if($odeme['paywant_odeme_tur'] == '1' ) { ?> selected <?php }?>>Sadece Mobil Ödeme (Her Operatörün Limiti Vardır. Az tutarlı Ödemeler İçin Uygundur)</option>
                                            <option value="3" <?php if($odeme['paywant_odeme_tur'] == '3' ) { ?> selected <?php }?>>Sadece Havale/EFT</option>
                                        </select>



                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="paywant1">Paywant Api Key</label><br><br>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-key"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="paywant_key" id="paywant1" aria-describedby="basic-addon1" value="<?=$odeme['paywant_key']?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="paywant2">Paywant Secret</label><br><br>



                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-key"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="paywant_secret" id="paywant2" aria-describedby="basic-addon1" value="<?=$odeme['paywant_secret']?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="paytrBildirimUrl">API Geri Dönüş Adresi</label><br><br>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-link"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="paytrBildirimUrl" aria-describedby="basic-addon1" value="<?=$ayar['site_url']?>includes/paywantbildirim/paywant_notify.php" readonly>
                                    </div>

                                    <small>Yukarıdaki geri dönüş adresini Paywant panelinizin "mağaza düzenle" kısmındaki API Geri Dönüş Adresi alanına ekleyiniz</small>

                                </div>
                            </div>
                        </div>

                        <div class="alert alert-warning" style="font-family: 'Open Sans', Arial; font-weight:500">
                            <b>ÖNEMLİ UYARI ! </b>Paywant üzerinden maximum 900 TL ödeme alabilirsiniz. Yani bu ödeme modülü firması küçük çaptaki tutarlar için idealdir. Eğer ki firmanızın ürünleri bu tutarı aşabilecek kapasitede ise kesinlikle bu ödeme modülünü kullanmamalısınız. Çünkü müşterinizin sepetindeki ürünlerin toplamı 901 TL olsun ödeme sayfasında hata ile karşılaşacaktır.
                        </div>


                    </div>



                </div>

                    <div class="form-actions p-l-20">
                        <button type="submit" class="btn btn-success" name="posayar">
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
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=posayar">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=posayar">
<?php }?>


