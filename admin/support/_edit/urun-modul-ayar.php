<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$urunModulayar = $db->prepare("select * from urunmodul_ayar where id='1'");
$urunModulayar->execute();
$row = $urunModulayar->fetch(PDO::FETCH_ASSOC);
?>

<title>Ürün Modül Ayarları | <?=$ayar['site_baslik']?></title>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="ti-dropbox"></i> Ürün Modül Ayarları</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=urunler">Ürünler</a></li>
                <li class="breadcrumb-item active">Ürün Modül Ayarları</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <div class="card-body p-b-0">
                    <h4 class="card-title">Ürün Modül Ayarları</h4>
                    <h6 class="card-subtitle">Ürün modül ayarları genel olarak anasayfadaki ürün modülünün görünüm ayarlarını içermektedir</h6> </div>



                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist" style="font-family: 'Open Sans', Arial; font-weight: 500; margin-bottom: 30px;">
                    <li class="nav-item" > <a class="nav-link active" data-toggle="tab" href="#genel" role="tab" ><span class="hidden-sm-up"><i class="ti-settings"></i></span> <span class="hidden-xs-down" >Genel</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tabayar" role="tab"><span class="hidden-sm-up"><i class="mdi mdi-tab"></i></span> <span class="hidden-xs-down">Tab Ayarı</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#urungrup" role="tab"><span class="hidden-sm-up"><i class="mdi mdi-animation"></i></span> <span class="hidden-xs-down">Ürün Grup Ayarı</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#meta" role="tab"><span class="hidden-sm-up"><i class="mdi mdi-search-web"></i></span> <span class="hidden-xs-down">SEO-Meta Ayarları</span></a> </li>
                </ul>
                <!-- Tab panes -->
                <form action="support/post/update/urun-modul-ayar.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">




                <div class="tab-content">
                    <div class="tab-pane active" id="genel" role="tabpanel">
                        <div class="p-20">




                            <div class="row" style="margin-bottom: 25px;  ">


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="modulBaslik">Modül Başlığı</label>
                                        <br><br>
                                        <small class="text-success" style="font-size:13px">Bu yazıyı dil ayarlarınızdaki düzenleme alanının <strong>19.satırından</strong> değiştirebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" class="form-control" disabled value="<?=$diller['urunlerimiz']?>" id="modulBaslik">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="modulSpot">Modül Açıklaması</label>
                                        <br><br>
                                        <small class="text-success" style="font-size:13px">Bu yazıyı dil ayarlarınızdaki düzenleme alanının <strong>20.satırından</strong> değiştirebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <textarea  id="modulSpot" rows="1" class="form-control" disabled><?=$diller['urunlerimiz-aciklamasi']?></textarea>
                                        </div>
                                    </div>
                                </div>


                            </div>



                            <div class="row" style="margin-bottom: 25px;  ">


                                <div class="col-md-2 ">
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


                                <div class="col-md-2 ">
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

                                <div class="col-md-2 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="fontWe">Başlık Font Kalınlığı</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Modül başlığınızın yazı kalınlığını belirleyebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <select class="form-control" name="font_weight" id="fontWe">
                                                <option value="exlight" <?php if($row['font_weight'] == 'exlight' ) { ?> selected <?php }?>>Ekstra İnce</option>
                                                <option value="light" <?php if($row['font_weight'] == 'light' ) { ?> selected <?php }?> >İnce</option>
                                                <option value="small" <?php if($row['font_weight'] == 'small' ) { ?> selected <?php }?> >Normal</option>
                                                <option value="medium" <?php if($row['font_weight'] == 'medium' ) { ?> selected <?php }?> >Orta</option>
                                                <option value="bold" <?php if($row['font_weight'] == 'bold' ) { ?> selected <?php }?> >Kalın</option>
                                                <option value="exbold" <?php if($row['font_weight'] == 'exbold' ) { ?> selected <?php }?> >Ekstra Kalın</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="dividerSec">Divider Seçimi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Başlık ve açıklama altındaki ayıraç simgesi.</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <select name="divider" class="form-control" id="dividerSec">
                                                <option value="divider" <?php if($row['divider'] == 'divider' ) { ?> selected <?php }?>>Koyu Renk</option>
                                                <option value="divider_2" <?php if($row['divider'] == 'divider_2' ) { ?> selected <?php }?>>Açık Renk</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 ">
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

                                <div class="col-md-2 ">
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


                                <div class="col-md-2 ">
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

                                <div class="col-md-2 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="İnceleTextt">İncele Buton Yazısı</label>
                                        <br><br>
                                        <small class="form-control-feedback text-success" style="font-size:13px">Dil ayarlarınızın <strong>21.satırından</strong> değiştirebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" class="form-control "value="<?=$diller['incele']?>" id="İnceleTextt" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="inceleBg">İncele Buton Arkaplan</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">İncele butonunun arkaplan rengini seçebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" class="form-control jscolor" name="incele_button_back" value="<?=$row['incele_button_back']?>" id="inceleBg">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="inceleTextbg">İncele Buton Yazı Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">İncele butonunun yazı rengini seçebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" class="form-control jscolor" name="incele_button_color" value="<?=$row['incele_button_color']?>" id="inceleTextbg">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="starraTeGoster">Ürün Kalitesi Yıldız Görünümü</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Pasifleştirirseniz yıldız sayısı görünmez</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type='hidden' value='0' name='star_rate'>
                                            <input type="checkbox" <?php if ($row['star_rate'] == 1) { ?> checked <?php }?> id="starraTeGoster" class="js-switch" data-color="#f62d51" name="star_rate" value="1" />
                                        </div>
                                    </div>
                                </div>


                            </div>


                            <h4 style="font-weight: 500"><i class="fa fa-cog"></i> Ürün Detay Ayarları</h4>

                            <hr>

                            <div class="row" style="margin-bottom: 25px;  ">

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="etiketGoster">Ürün Detay Etiket Gösterimi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Pasifleştirirseniz etiketler görünmez</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type='hidden' value='0' name='detay_etiket'>
                                            <input type="checkbox" <?php if ($row['detay_etiket'] == 1) { ?> checked <?php }?> id="etiketGoster" class="js-switch" data-color="#f62d51" name="detay_etiket" value="1" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="detayBenzerUrunler">Ürün Detay Benzer Ürünler</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Pasifleştirirseniz benzer ürünler görünmez</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type='hidden' value='0' name='detay_benzer_urun'>
                                            <input type="checkbox" <?php if ($row['detay_benzer_urun'] == 1) { ?> checked <?php }?> id="detayBenzerUrunler" class="js-switch" data-color="#f62d51" name="detay_benzer_urun" value="1" />
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <h4 style="font-weight: 500"><i class="fa fa-cog"></i> Ürünler Sayfası</h4>

                            <hr>

                            <div class="row" style="  ">

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="aramaGorunum">Arama Butonu</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Pasifleştirirseniz arama yapılmaz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type='hidden' value='0' name='detay_arama'>
                                            <input type="checkbox" <?php if ($row['detay_arama'] == 1) { ?> checked <?php }?> id="aramaGorunum" class="js-switch" data-color="#f62d51" name="detay_arama" value="1" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="populerGorunum">Popüler Ürünler Görünümü</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Pasifleştirirseniz sol taraftaki populer ürünler görünmez</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type='hidden' value='0' name='detay_populer'>
                                            <input type="checkbox" <?php if ($row['detay_populer'] == 1) { ?> checked <?php }?> id="populerGorunum" class="js-switch" data-color="#f62d51" name="detay_populer" value="1" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="katTip">Açılır Kategori Menü Tipi (Masaüstü) <i data-toggle="tooltip" data-placement="top" title="Sadece masaüstü(PC) içindir" style="cursor: pointer" class="fa fa-info-circle"></i></label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Alt kategoriniz var ise görüntülenebilir</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <select name="detay_altmenu_tip" class="form-control" id="katTip">
                                                <option value="0" <?php if($row['detay_altmenu_tip'] == 0 ) { ?> selected <?php }?>>Standart</option>
                                                <option value="1" <?php if($row['detay_altmenu_tip'] == 1 ) { ?> selected <?php }?>>Kapak Görselli</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="katColorBg">Ürün Kategori Arkaplan Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Kendinize göre seçim yapabilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type='text' value='<?=$row['detay_altmenu_bg']?>' id="katColorBg" class="form-control jscolor" name='detay_altmenu_bg'>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="katHovercolor">Ürün Kategori Hover Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Mouse ile üstüne geldiğinizdeki renk</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type='text' value='<?=$row['detay_altmenu_hover']?>' id="katHovercolor" class="form-control jscolor" name='detay_altmenu_hover'>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="katBordercolor">Ürün Kategori Border Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Kategori alanınızdaki kenarlık rengini seçebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type='text' value='<?=$row['detay_altmenu_border']?>' id="katBordercolor" class="form-control jscolor" name='detay_altmenu_border'>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="katTextColor">Ürün Kategori Yazı Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Kategori isimlerinizin rengini seçebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type='text' value='<?=$row['detay_altmenu_textcolor']?>' id="katTextColor" class="form-control jscolor" name='detay_altmenu_textcolor'>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="katTextHovercolor">Ürün Kategori Yazı Hover Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Kategori isimlerinizin hover rengini seçebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type='text' value='<?=$row['detay_altmenu_hovertextcolor']?>' id="katTextHovercolor" class="form-control jscolor" name='detay_altmenu_hovertextcolor'>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="subcatBorder">Ürün Açılır Menü Border Rengi</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Açılan kategorilerin kenarlık rengini seçebilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type='text' value='<?=$row['detay_altmenu_megaborder']?>' id="subcatBorder" class="form-control jscolor" name='detay_altmenu_megaborder'>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="subCatShadow">Ürün Açılır Menü Gölgelendirme</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Açılan kategori menüsünün gölgeli olmasını sağlayabilirsiniz</small>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type='hidden' value='0' name='detay_altmenu_megashadow'>
                                            <input type="checkbox" <?php if ($row['detay_altmenu_megashadow'] == 1) { ?> checked <?php }?> id="subCatShadow" class="js-switch" data-color="#f62d51" name="detay_altmenu_megashadow" value="1" />
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>
                    </div>
                    <div class="tab-pane  p-20" id="tabayar" role="tabpanel">


                        <div class="row" style="margin-bottom: 25px;  ">

                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="tabYeniler">Yeni Ürünler Gösterimi</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">1 sıradaki tab yeni eklenen ürünlerdir</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type='hidden' value='0' name='yeni'>
                                        <input type="checkbox" <?php if ($row['yeni'] == 1) { ?> checked <?php }?> id="tabYeniler" class="js-switch" data-color="#f62d51" name="yeni" value="1" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="tabPopuler">Popüler Ürünler Gösterimi</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">2 sıradaki tab popüler ürünlerdir</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type='hidden' value='0' name='populer'>
                                        <input type="checkbox" <?php if ($row['populer'] == 1) { ?> checked <?php }?> id="tabPopuler" class="js-switch" data-color="#f62d51" name="populer" value="1" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="tabTextSize">Tab Başlık Yazı Büyüklüğü</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Estektikliği bozmayın ve sayı sonuna px ekleyin</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type="text" class="form-control" name="tab_font_size" value="<?=$row['tab_font_size']?>" id="tabTextSize" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="tabLimit">Tab Limiti</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Tab sayısını belirleyebilirsiniz. Max 5 veya 6 önerilir</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type="number" class="form-control" name="tab_limit" value="<?=$row['tab_limit']?>" id="tabLimit" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="tabLimiturun">Tab Ürünleri Limiti</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Tab kategorilerine ait ürün sayılarının limitini belirleyebilirsiniz</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type="number" class="form-control" name="tab_urun_limit" value="<?=$row['tab_urun_limit']?>" id="tabLimiturun" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="tabBorderRadius">Tab Border Radius</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Tab Kenarlığının ovalliğini ayarlayabilirsiniz</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type="number" class="form-control" name="tab_border_radius" value="<?=$row['tab_border_radius']?>" id="tabBorderRadius" required>
                                    </div>
                                </div>
                            </div>


                        </div>


                        <h4 style="font-weight: 500"><i class="mdi mdi-palette"></i> Tab Renk Ayarları</h4>

                        <hr>

                        <div class="row" style="margin-bottom: 25px;  ">

                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="tabBG">Aktif Tab Arkaplan Rengi</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Seçili tab arkaplan rengini ayarlayabilirsiniz</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type="text" class="form-control jscolor" name="tab_back_color" value="<?=$row['tab_back_color']?>" id="tabBG" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="activeTabBG">Aktif Tab Yazı Rengi</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Seçili olan tab yazı rengini seçebilirsiniz</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type="text" class="form-control jscolor" name="tab_act_text_color" value="<?=$row['tab_act_text_color']?>" id="activeTabBG" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="tabTextColor">Tab Yazı Rengi</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Tabların yazı rengini ayarlayabilirsiniz</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type="text" class="form-control jscolor" name="tab_text_color" value="<?=$row['tab_text_color']?>" id="tabTextColor" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="tabBorderColor">Tab Border Rengi</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Tabların kenarlık rengini ayarlayabilirsiniz</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type="text" class="form-control jscolor" name="tab_border_color" value="<?=$row['tab_border_color']?>" id="tabBorderColor" required>
                                    </div>
                                </div>
                            </div>



                        </div>


                        </div>
                    <div class="tab-pane p-20" id="urungrup" role="tabpanel">



                        <div class="row" style="margin-bottom: 25px;  ">

                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="urunGruplar">Ürün Grupları</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Ürün Gruplarının aktif-pasif durumu</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type='hidden' value='0' name='urun_grup'>
                                        <input type="checkbox" <?php if ($row['urun_grup'] == 1) { ?> checked <?php }?> id="urunGruplar" class="js-switch" data-color="#f62d51" name="urun_grup" value="1" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="urunGrupCatBg">Kategori Arkaplan Rengi</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Ürün gruplarındaki kategori isimlerinin arkaplan rengi</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type="text" class="form-control jscolor" name="urun_grup_back" value="<?=$row['urun_grup_back']?>" id="urunGrupCatBg" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="urunGrupTextcolor">Kategori Yazı Rengi</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Ürün gruplarındaki kategori isimlerinin yazı rengi</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type="text" class="form-control jscolor" name="urun_grup_textcolor" value="<?=$row['urun_grup_textcolor']?>" id="urunGrupTextcolor" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="urunlereGitButon">Ürünlere Git Butonu</label>
                                    <br><br>
                                    <small class="text-success" style="font-size:13px">Bu yazıyı dil ayarlarınızdaki düzenleme alanının <strong>25.satırından</strong> değiştirebilirsiniz</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type="text" class="form-control" disabled value="<?=$diller['urunlere-git']?>" id="urunlereGitButon">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="urungrupİncele">Ürünlere Git Arkaplan Rengi</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Ürün gruplarındaki ürünlere git yazısının arkaplan rengi</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type="text" class="form-control jscolor" name="urun_grup_incele_back" value="<?=$row['urun_grup_incele_back']?>" id="urungrupİncele" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="urungrupİnceleText">Ürünlere Git Yazı Rengi</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Ürün gruplarındaki ürünlere git yazısının yazı rengi</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type="text" class="form-control jscolor" name="urun_grup_incelecolor" value="<?=$row['urun_grup_incelecolor']?>" id="urungrupİnceleText" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="urungrupBordersRengi">Ürün Grupları Kutu Border Rengi</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Ürün grup kutularının kenarlık rengini belirleyebilirsiniz</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type="text" class="form-control jscolor" name="urun_grup_border" value="<?=$row['urun_grup_border']?>" id="urungrupBordersRengi" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="urungrupLimit">Ürün Grupları Sayısı</label>
                                    <br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Kaç tane ürün grubunun görünmesini istiyorsanız belirtebilirsiniz</small>
                                    <br><br>
                                    <div class="input-group" >
                                        <input type="number" class="form-control" name="urun_grup_limit" value="<?=$row['urun_grup_limit']?>" id="urungrupLimit" required>
                                    </div>
                                </div>
                            </div>




                        </div>







                    </div>




                    <div class="tab-pane p-20" id="meta" role="tabpanel">


                        <div class="row" style="margin-bottom: 25px;  ">

                            <div class="form-group col-md-12">
                                <label style="font-weight: 500" for="metaDesc"><i class="fa fa-hashtag"></i> Meta - Açıklaması</label><br><br>
                                <small class="text-purple" style="font-size:13px;">Sadece <strong>ürünlerimiz</strong> sayfası için geçerlidir. Ürün detay sayfalarının meta ayarları yeni ürün ekleme sayfasından eklenmelidir.</small>
                                <br><br>
                                <textarea name="meta_desc"  id="metaDesc" class="form-control" rows="3" ><?=$row['meta_desc']?></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label style="font-weight: 500" for="metaTags"><i class="fa fa-tags"></i> Meta - Etiketler</label><br><br>
                                <small class="text-purple" style="font-size:13px;">Sadece <strong>ürünlerimiz</strong> sayfası için geçerlidir. Ürün detay sayfalarının meta ayarları yeni ürün ekleme sayfasından eklenmelidir.</small>
                                <br><br>
                                <input type="text"  data-role="tagsinput" id="metaTags" placeholder="Etiket Ekle" name="tags" value="<?=$row['tags']?>" />
                            </div>

                        </div>


                    </div>


                </div>

                    <div class="form-actions p-l-20">
                        <button type="submit" class="btn btn-success" name="urunmoduldegis">
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
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=urunmodul">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="2; URL=pages.php?sayfa=urunmodul">
<?php }?>