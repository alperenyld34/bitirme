<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Ticari Ayarlar | <?=$ayar['site_baslik']?></title>
<?php
$odemeayarlari = $db ->prepare("select * from odeme_ayar where id='1' ");
$odemeayarlari ->execute();
$odeme = $odemeayarlari->fetch(PDO::FETCH_ASSOC);
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-cart"></i> Ticari Ayarlar </h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Ticaret Ayarları</a></li>
                <li class="breadcrumb-item active">Ticari Ayarlar </li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">






            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/update/ticaret-ayar.php" class="form-horizontal " method="post">

                    <h3 class="card-title">Ticari Ayarlar </h3>
                    <hr>
                    <div class="form-body">



                      <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">


                          <div class="col-md-3">
                              <div class="form-group">
                                  <label style="font-weight: 500" for="sepetSistemi">Sepet Sistemi</label><br><br>

                                  <div class="input-group mb-3">

                                      <input type='hidden' value='0' name='sepet_sistemi'>
                                      <input type="checkbox" <?php if($odeme['sepet_sistemi'] == 1){?>checked<?php }?> id="sepetSistemi" class="js-switch" data-color="#f62d51" name="sepet_sistemi" value="1" />

                                  </div>

                              </div>
                          </div>


                          <div class="col-md-3">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="kkart">Kredi Kartı Sistemi</label><br><br>

                                    <div class="input-group mb-3">

                                        <input type='hidden' value='0' name='kredi_kart'>
                                        <input type="checkbox" <?php if($odeme['kredi_kart'] == 1){?>checked<?php }?> id="kkart" class="js-switch" data-color="#f62d51" name="kredi_kart" value="1" />

                                    </div>



                                </div>
                          </div>


                          <div class="col-md-3">
                              <div class="form-group">
                                  <label style="font-weight: 500" for="havale">Havale/EFT Sistemi</label><br><br>

                                  <div class="input-group mb-3">

                                      <input type='hidden' value='0' name='eft'>
                                      <input type="checkbox" <?php if($odeme['eft'] == 1){?>checked<?php }?> id="havale" class="js-switch" data-color="#f62d51" name="eft" value="1" />

                                  </div>

                              </div>
                          </div>


                          <div class="col-md-3">
                              <div class="form-group">
                                  <label style="font-weight: 500" for="normalSiparis">Normal Sipariş Sistemi</label><br><br>

                                  <div class="input-group mb-3">

                                      <input type='hidden' value='0' name='normal_siparis'>
                                      <input type="checkbox" <?php if($odeme['normal_siparis'] == 1){?>checked<?php }?> id="normalSiparis" class="js-switch" data-color="#f62d51" name="normal_siparis" value="1" />

                                  </div>

                              </div>
                          </div>



                    </div>




                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="whtspSiparis">WhatsApp Sipariş Sistemi</label><br><br>

                                    <div class="input-group mb-3">

                                        <input type='hidden' value='0' name='wp_siparis'>
                                        <input type="checkbox" <?php if($odeme['wp_siparis'] == 1){?>checked<?php }?> id="whtspSiparis" class="js-switch" data-color="#f62d51" name="wp_siparis" value="1" />

                                    </div>

                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="simgePara">Para Birimi Simgesi</label><br><br>

                                    <div class="input-group mb-3">

                                        <div style="width: 50px">
                                        <input type='text' value='<?=$odeme['simge']?>' name='simge' class="form-control" id="simgePara" maxlength="3">
                                        </div>

                                    </div>

                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="stokGoster">Stok Gösterimi(Ürün Detay)</label><br><br>

                                    <div class="input-group mb-3">

                                        <input type='hidden' value='0' name='stok_durum'>
                                        <input type="checkbox" <?php if($odeme['stok_durum'] == 1){?>checked<?php }?> id="stokGoster" class="js-switch" data-color="#f62d51" name="stok_durum" value="1" />

                                    </div>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="stokAdet">Stok Adet Gösterimi(Ürün Detay)</label><br><br>

                                    <div class="input-group mb-3">

                                        <input type='hidden' value='0' name='stok_gorunum'>
                                        <input type="checkbox" <?php if($odeme['stok_gorunum'] == 1){?>checked<?php }?> id="stokAdet" class="js-switch" data-color="#f62d51" name="stok_gorunum" value="1" />

                                    </div>

                                </div>
                            </div>



                        </div>



                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="kargoSistem">Kargo Ücreti Sistemi</label><br><br>

                                    <div class="input-group mb-3">

                                        <input type='hidden' value='0' name='kargo_sistemi'>
                                        <input type="checkbox" <?php if($odeme['kargo_sistemi'] == 1){?>checked<?php }?> id="kargoSistem" class="js-switch" data-color="#f62d51" name="kargo_sistemi" value="1" />

                                    </div>

                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="kargoLimit">Ücretsiz Kargo Limiti</label><br><br>

                                    <div class="input-group mb-3">


                                       <div>
                                           <small class="form-control-feedback text-info" style="font-size:13px"><i class="fa fa-info-circle"></i> Boş bırakır veya 0 yazarsanız otomatik devre dışı kalır.</small>
                                       </div>

                                        <div>
                                        <input type='number' value='<?=$odeme['kargo_limit']?>' name='kargo_limit' class="form-control" id="kargoLimit" style="margin-bottom: 10px; margin-top: 10px"/>
                                        </div>

                                        <div>
                                        <small class="form-control-feedback text-muted" style="font-size:13px"><i class="fa fa-info-circle"></i> Sadece sayı kullanın.Virgül veya nokta koymayın. Sepetteki toplam tutar limiti geçerse kargo ücretsiz olur</small>
                                        </div>


                                    </div>

                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="adimGorunum">Sepet Sayfası Step Gösterimi</label><br><br>

                                    <div class="input-group mb-3">

                                        <input type='hidden' value='0' name='sepet_step'>
                                        <input type="checkbox" <?php if($odeme['sepet_step'] == 1){?>checked<?php }?> id="adimGorunum" class="js-switch" data-color="#f62d51" name="sepet_step" value="1" />

                                    </div>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="iconSec">Sepet İkonu</label><br><br>

                                    <div class="input-group mb-3">
                                        <select name="cart_icon" class="selectpicker col-md-12 p-l-0 p-r-0" data-style="form-control btn-secondary" id="iconSec">
                                            <option value="ion-bag" <?php if($odeme['cart_icon'] == 'ion-bag'){?>selected<?php }?>>İkon - 1</option>
                                            <option value="ion-android-cart" <?php if($odeme['cart_icon'] == 'ion-android-cart'){?>selected<?php }?>>İkon - 2</option>
                                            <option value="fa fa-shopping-basket" <?php if($odeme['cart_icon'] == 'fa fa-shopping-basket'){?>selected<?php }?>>İkon - 3</option>
                                            <option value="fa fa-shopping-bag" <?php if($odeme['cart_icon'] == 'fa fa-shopping-bag'){?>selected<?php }?>>İkon - 4</option>
                                            <option value="fa fa-shopping-cart" <?php if($odeme['cart_icon'] == 'fa fa-shopping-cart'){?>selected<?php }?>>İkon - 5</option>
                                        </select>
                                    </div>

                                </div>
                            </div>


                        </div>



                        <h4 class="box-title m-t-40">Tema Ayarları</h4>
                        <hr>

                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="buttonBG" style="margin-bottom: 13px; font-weight: 600">Sepete Ekle Button Arkaplanı</label>
                                <br>

                                <input class="jscolor form-control" value="<?=$odeme['button_bg']?>" id="buttonBG" name="button_bg">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="buttonText" style="margin-bottom: 13px; font-weight: 600">Button Yazı Rengi</label>
                                <br>

                                <input class="jscolor form-control" value="<?=$odeme['button_text_color']?>" id="buttonText" name="button_text_color">

                            </div>
                        </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="cartIcon" style="margin-bottom: 13px; font-weight: 600">Sepet İkonu Rengi [ Header Tip 1 ve Mobil İçin ]</label>
                                    <br>

                                    <input class="jscolor form-control" value="<?=$odeme['cart_color']?>" id="cartIcon" name="cart_color">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="cartCountColor" style="margin-bottom: 13px; font-weight: 600">Sepet Adet Arkaplan Rengi [ Header 1, 2 ve Mobil ]</label>
                                    <br>

                                    <input class="jscolor form-control" value="<?=$odeme['cart_count_bg']?>" id="cartCountColor" name="cart_count_bg">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="cartCountColorText" style="margin-bottom: 13px; font-weight: 600">Sepet Adet Rakam Rengi [ Header 1, 2 ve Mobil ]</label>
                                    <br>

                                    <input class="jscolor form-control" value="<?=$odeme['cart_count_color']?>" id="cartCountColorText" name="cart_count_color">

                                </div>
                            </div>
                        </div>





                        <h4 class="box-title m-t-40">Kargo Limiti Gösterim Ayarları</h4>
                        <hr>
                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="headeUst">Sitenin Üstü Gösterimi</label><br><br>

                                    <div class="input-group mb-3">

                                        <input type='hidden' value='0' name='kargolimit_header'>
                                        <input type="checkbox" <?php if($odeme['kargolimit_header'] == 1){?>checked<?php }?> id="headeUst" class="js-switch" data-color="#f62d51" name="kargolimit_header" value="1" />

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="productGoster">Ürünler Sayfası Gösterimi</label><br><br>

                                    <div class="input-group mb-3">

                                        <input type='hidden' value='0' name='kargolimit_product'>
                                        <input type="checkbox" <?php if($odeme['kargolimit_product'] == 1){?>checked<?php }?> id="productGoster" class="js-switch" data-color="#f62d51" name="kargolimit_product" value="1" />

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="coorbg1" style="margin-bottom: 13px; font-weight: 600">Çizgisel Arkaplan 1.Renk</label>
                                    <br>

                                    <input class="jscolor form-control" value="<?=$odeme['kargolimit_bg_1']?>" id="coorbg1" name="kargolimit_bg_1">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="coorbg2" style="margin-bottom: 13px; font-weight: 600">Çizgisel Arkaplan 2.Renk</label>
                                    <br>

                                    <input class="jscolor form-control" value="<?=$odeme['kargolimit_bg_2']?>" id="coorbg2" name="kargolimit_bg_2">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="textBgsi" style="margin-bottom: 13px; font-weight: 600">Kargo Limiti Yazı Rengi</label>
                                    <br>

                                    <input class="jscolor form-control" value="<?=$odeme['kargolimit_text_color']?>" id="textBgsi" name="kargolimit_text_color">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="widthDegeri">Site Üstü Gösterim Genişliği</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Geniş seçilirse %100, Kutu seçilirse %90 genişlk olur.</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <select name="kargolimit_width" class="form-control" id="widthDegeri">
                                            <option value="0" <?php if($odeme['kargolimit_width'] == 0 ) { ?> selected <?php }?>>Geniş</option>
                                            <option value="1" <?php if($odeme['kargolimit_width'] == 1 ) { ?> selected <?php }?>>Kutu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="widthDegeri">Kargo Limiti Yazısı Font Seçimi</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Yazıların font tipini seçebilirsiniz.</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <select name="kargolimit_font" class="form-control" >
                                            <option value="raleway" <?php if($row['kargolimit_font'] == 'raleway' ) { ?> selected <?php }?>>Raleway</option>
                                            <option value="open-sans" <?php if($row['kargolimit_font'] == 'open-sans' ) { ?> selected <?php }?>>Open Sans</option>
                                        </select>
                                    </div>
                                </div>
                            </div>





                        </div>



                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="ticariayar">
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
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=ticariayar">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=ticariayar">
<?php }?>


