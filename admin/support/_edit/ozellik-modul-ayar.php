<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$modulAyar = $db->prepare("select * from ozellik_ayar where id='1'");
$modulAyar->execute();
$row = $modulAyar->fetch(PDO::FETCH_ASSOC);
?>

<title>Özellikler Modül Ayarları | <?=$ayar['site_baslik']?></title>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="ti-bookmark"></i> Özellikler Modül Ayarları</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=ozellikler">Özellikler Modülü</a></li>
                <li class="breadcrumb-item active">Özellikler Modül Ayarları</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <div class="card-body p-b-0">
                    <h4 class="card-title">Özellikler Modül Ayarları</h4>
                    <h6 class="card-subtitle">Özellikler Modül Ayarları genel olarak anasayfadaki ürün modülünün görünüm ayarlarını içermektedir</h6> </div>



                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist" style="font-family: 'Open Sans', Arial; font-weight: 500; margin-bottom: 30px;">
                    <li class="nav-item" > <a class="nav-link active" data-toggle="tab" href="#genel" role="tab" ><span class="hidden-sm-up"><i class="ti-settings"></i></span> <span class="hidden-xs-down" >Genel</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#meta" role="tab"><span class="hidden-sm-up"><i class="mdi mdi-search-web"></i></span> <span class="hidden-xs-down">SEO-Meta Ayarları</span></a> </li>
                </ul>
                <!-- Tab panes -->
                <form action="support/post/update/ozellik-modul-ayar.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">




                <div class="tab-content">
                    <div class="tab-pane active" id="genel" role="tabpanel">
                        <div class="p-20">




                            <div class="row" style="margin-bottom: 25px;  ">


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="modulBaslik">Modül Başlığı</label>
                                        <br><br>
                                        <small class="text-success" style="font-size:13px">Bu yazıyı dil ayarlarınızdaki düzenleme alanının <strong>39.satırından</strong> değiştirebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" class="form-control" disabled value="<?=$diller['ozellik']?>" id="modulBaslik">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="modulSpot">Modül Açıklaması</label>
                                        <br><br>
                                        <small class="text-success" style="font-size:13px">Bu yazıyı dil ayarlarınızdaki düzenleme alanının <strong>40.satırından</strong> değiştirebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <textarea  id="modulSpot" rows="1" class="form-control" disabled><?=$diller['ozellik-aciklamasi']?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="modulSpot">Tümü Yazısı</label>
                                        <br><br>
                                        <small class="text-success" style="font-size:13px"><strong>41.satırından</strong> değiştirebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <textarea  id="modulSpot" rows="1" class="form-control" disabled><?=$diller['ozellik-tumu']?></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>



                            <div class="row" style="margin-bottom: 25px;  ">


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="widthDegeri">Modül Genişliği</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Geniş seçilirse %100, Kutu seçilirse %90 genişlk olur.</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <select name="width" class="form-control" id="widthDegeri">
                                                <option value="0" <?php if($row['width'] == 0 ) { ?> selected <?php }?>>Geniş</option>
                                                <option value="1" <?php if($row['width'] == 1 ) { ?> selected <?php }?>>Kutu</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="sizeSec">Padding Değeri</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Yukarıdan ve aşağıdan boşluk veya aralık bırakabilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="number" class="form-control" required name="padding" value="<?=$row['padding']?>" id="sizeSec">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="baslikClor">Başlık Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Modül başlığınızın rengini kendinize göre seçebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" class="form-control jscolor" name="baslik_color" value="<?=$row['baslik_color']?>" id="baslikClor">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="spotColor">Açıklama Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Modül açıklamanızın rengini kendinize göre seçebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" class="form-control jscolor" name="spot_color" value="<?=$row['spot_color']?>" id="spotColor">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="arkaplanRengi">Modül Arkaplan Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Modül arkaplan rengini kendinize göre seçebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" class="form-control jscolor" name="back_color" value="<?=$row['back_color']?>" id="arkaplanRengi">
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="OzLimit">Özellik Sayısı Limiti (Anasayfa)</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Anasayfa özellikler modülünüzdeki listelenecek özellik sayısı</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="number" class="form-control " name="ozellik_limit" value="<?=$row['ozellik_limit']?>" id="OzLimit" required min=1 oninput="validity.valid||(value='');">
                                        </div>
                                    </div>
                                </div>


                            </div>


                            <h4 style="font-weight: 500"><i class="mdi mdi-palette"></i> Modül Görünümü</h4>

                            <hr>

                            <div class="row" >

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="KutuBg">Başlık ve Spot alanının Arkaplan Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Anasayfadaki özellikler alanının başlık-spot arkaplan rengi</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" class="form-control jscolor" name="head_color" value="<?=$row['head_color']?>" id="KutuBg">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="KutuBaslik">Özellik Kutusu İkon Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Özelliklerin ikon rengi</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" class="form-control jscolor" name="icon_color" value="<?=$row['icon_color']?>" id="KutuBaslik">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="kutuSpotColor">Özellik Kutusu İkon Arkaplan Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Özelliklerin ikon arkaplan rengi</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" class="form-control jscolor" name="icon_back_color" value="<?=$row['icon_back_color']?>" id="kutuSpotColor">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="borderRad">Özellik Kutusu İkon Border Radius</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Özelliklerin ikon arkaplan Köşe Ovalliği</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="number" class="form-control " name="icon_border_radius" value="<?=$row['icon_border_radius']?>" id="borderRad" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="boxTxtColr">Özellik Kutusu Başlık Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Özelliklerin başlık yazı rengi</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" class="form-control jscolor" name="box_head_color" value="<?=$row['box_head_color']?>" id="boxTxtColr">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="boxTxtColrspot">Özellik Kutusu Açıklama Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Özelliklerin Açıklama yazı rengi</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" class="form-control jscolor" name="box_spot_color" value="<?=$row['box_spot_color']?>" id="boxTxtColrspot">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="font-weight: 500; margin-bottom: 7px;" for="iconSec">Tümünü Göster Butonu (Anasayfa)</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Pasif bırakırsanız anasayfada tümünü göster butonu çıkmaz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type='hidden' value='0' name='ozellik_button'>
                                            <input type="checkbox" <?php if ($row['ozellik_button'] == 1) { ?> checked <?php }?> id="iconSec" class="js-switch" data-color="#f62d51" name="ozellik_button" value="1" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="buttonBgColor">Button Arkaplan Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Tümünü göster yazısının olduğu butonun arkaplan rengini seçebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <select name="button_bg" id="buttonBgColor" class="form-control">
                                                <option <?php if ($row['button_bg'] == 'warning') {?> selected <?php }?> value="warning">Sarı</option>
                                                <option <?php if ($row['button_bg'] == 'info') {?> selected <?php }?> value="info">Mavi</option>
                                                <option <?php if ($row['button_bg'] == 'danger') {?> selected <?php }?> value="danger">Kırmızı</option>
                                                <option <?php if ($row['button_bg'] == 'success') {?> selected <?php }?> value="success">Yeşil</option>
                                                <option <?php if ($row['button_bg'] == 'primary') {?> selected <?php }?> value="primary">Koyu Mavi</option>
                                                <option <?php if ($row['button_bg'] == 'secondary') {?> selected <?php }?> value="secondary">Gri</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            </div>



                        </div>
                    </div>






                    <div class="tab-pane p-20" id="meta" role="tabpanel">


                        <div class="row">

                            <div class="form-group col-md-12">
                                <label style="font-weight: 500" for="metaDesc"><i class="fa fa-hashtag"></i> Meta - Açıklaması</label><br><br>
                                <small class="text-purple" style="font-size:13px;">Sadece <strong>blog yazıları</strong> sayfası için geçerlidir. Blog detay sayfalarının meta ayarları yeni blog ekleme sayfasından eklenmelidir</small>
                                <br><br>
                                <textarea name="meta_desc"  id="metaDesc" class="form-control" rows="3" ><?=$row['meta_desc']?></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label style="font-weight: 500" for="metaTags"><i class="fa fa-tags"></i> Meta - Etiketler</label><br><br>
                                <small class="text-purple" style="font-size:13px;">Sadece <strong>blog yazıları</strong> sayfası için geçerlidir. Blog detay sayfalarının meta ayarları yeni blog ekleme sayfasından eklenmelidir</small>
                                <br><br>
                                <input type="text"  data-role="tagsinput" id="metaTags" placeholder="Etiket Ekle" name="tags" value="<?=$row['tags']?>" />
                            </div>

                        </div>


                    </div>


                </div>

                    <div class="form-actions p-l-20">
                        <button type="submit" class="btn btn-success" name="ozellikmoduldegis">
                            <i class="fa fa-refresh fa-spin fa-fw"></i>
                            <span class="sr-only">Yükleniyor...</span>
                            Tüm Ayarları Güncelle
                        </button>
                    </div>

                </form>

            </div>







        </div>
    </div>
</div>


<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=ozellikmodul">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=ozellikmodul">
<?php }?>