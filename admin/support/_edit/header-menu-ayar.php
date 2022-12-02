<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<title>Header Ayarları | <?=$ayar['site_baslik']?></title>
<?php
$headerAyar = $db->prepare("select * from header_ayar where id='1' ");
$headerAyar->execute();
$head = $headerAyar->fetch(PDO::FETCH_ASSOC);
?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="ti-menu"></i> Header Ayarları</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Header Ayarları</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <div class="card-body p-b-0">
                    <h3 class="card-title">Header Ayarları</h3>
                    <h6 class="card-subtitle">Header ve Top Header ayarlarını sekmelerden seçim yaparak yapabilirsiniz</h6> </div>



                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab m-b-20" role="tablist" style="font-family: 'Open Sans', Arial; font-weight: 500">
                    <li class="nav-item" > <a class="nav-link active" data-toggle="tab" href="#head" role="tab" ><span class="hidden-sm-up"></span> <span class="hidden-xs-down" >Header Ayarları</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tophead" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Top Header Ayarları</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#fixedheader" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Sabit Header Ayarları</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#mega" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Mega Menü</span></a> </li>
                </ul>
                <!-- Tab panes -->



                <div class="tab-content">
                    <div class="tab-pane active" id="head" role="tabpanel">
                        <div class="p-20">

                            <form action="support/post/update/header-menu-ayar.php" class="form-horizontal form-bordered" method="post">


                            <div class="row">


                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500">Header Modül Genişliği</label>
                                        <br><br>
                                        <div class="input-group" >
                                            <select name="header_width" class="form-control" >
                                                <option value="0" <?php if($head['header_width'] == 0 ) { ?> selected <?php }?>>Geniş</option>
                                                <option value="1" <?php if($head['header_width'] == 1 ) { ?> selected <?php }?>>Kutu</option>
                                            </select>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500">Header Menu Font Kalınlık</label>
                                        <br><br>
                                        
                                        <div class="input-group" >
                                            <select name="font_weight" class="form-control" >
                                                <option value="light" <?php if($head['font_weight'] == 'light' ) { ?> selected <?php }?>>Light</option>
                                                <option value="normal" <?php if($head['font_weight'] == 'normal' ) { ?> selected <?php }?>>Normal</option>
                                                <option value="medium" <?php if($head['font_weight'] == 'medium' ) { ?> selected <?php }?>>Medium</option>
                                                <option value="bold" <?php if($head['font_weight'] == 'bold' ) { ?> selected <?php }?>>Bold</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">

                                        <label style="font-weight: 500" for="sizeSec">Header Menu Font Size</label>

                                        <br><br>

                                     

                                        <div class="input-group" >
                                            <input type="text" class="form-control" name="font_size" value="<?=$head['font_size']?>" id="sizeSec">
                                        </div>

                                    </div>
                                </div>



                            </div>


                            <div class="row m-b-40">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label" for="aramaBut" style="margin-bottom: 28px; font-weight: 600">Arama Butonu</label>
                                        <br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px"> Header alanındaki arama ikonu</small>
                                        <br><br>
                                        <input type='hidden' value='0' name='arama_button'>
                                        <input type="checkbox" <?php if($head['arama_button'] == 1){?>checked<?php }?> class="js-switch" id="aramaBut" data-color="#f62d51" name="arama_button" value="1" />

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label" for="dilSecc" style="margin-bottom: 28px; font-weight: 600">Dil Seçimi</label>
                                        <br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px"> Ziyaretçilerin dil seçimi yaptığı alan</small>
                                        <br><br>
                                        <input type='hidden' value='0' name='dil_secim'>
                                        <input type="checkbox" <?php if($head['dil_secim'] == 1){?>checked<?php }?> class="js-switch" id="dilSecc" data-color="#f62d51" name="dil_secim" value="1" />

                                    </div>
                                </div>

                                <div class="col-md-4 ">
                                    <div class="form-group">

                                        <label style="font-weight: 500" for="headLimit">Header Menu Sayı Limiti</label>

                                        <br><br>

                                        <br><br>

                                        <div class="input-group" >
                                            <input type="number" class="form-control " name="header_limit" value="<?=$head['header_limit']?>" id="headLimit" required min=1 oninput="validity.valid||(value='');">
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <h3><i class="mdi mdi-palette"></i> Renk Ayarları</h3>
                            <hr>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">

                                        <label style="font-weight: 500" for="headBgs">Header Alanı Arkaplan Rengi </label>

                                        <br><br>

                                        <small class="form-control-feedback text-purple" style="font-size:13px">Menülerin, logonun ve diğer butonların olduğu zemin rengi</small>

                                        <br><br>

                                        <div class="input-group" >
                                            <input type="text" class="form-control jscolor" name="header_menu_bg" value="<?=$head['header_menu_bg']?>" id="headBgs">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">

                                        <label style="font-weight: 500" for="bgColorHover">Menu Kutusu Arkaplan Hover Rengi </label>

                                        <br><br>

                                        <small class="form-control-feedback text-purple" style="font-size:13px">Mouse ile üstüne geldiğinizdeki arkaplan rengi </small>

                                        <br><br>

                                        <div class="input-group" >
                                            <input type="text" class="form-control jscolor" name="menu_hover_color" value="<?=$head['menu_hover_color']?>" id="bgColorHover">
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">

                                        <label style="font-weight: 500" for="textColors">Menu Yazı Rengi </label>

                                        <br><br>

                                        <small class="form-control-feedback text-purple" style="font-size:13px">İdeal Seçim : 000000 -> Siyah</small>

                                        <br><br>

                                        <div class="input-group" >
                                            <input type="text" class="form-control jscolor" name="menu_text_color" value="<?=$head['menu_text_color']?>" id="textColors">
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">

                                        <label style="font-weight: 500" for="textHoverColors">Menu Yazı Hover Rengi </label>

                                        <br><br>

                                        <small class="form-control-feedback text-purple" style="font-size:13px">Menü üstüne geldiğinizdeki yazının rengi</small>

                                        <br><br>

                                        <div class="input-group" >
                                            <input type="text" class="form-control jscolor" name="menu_text_hover_color" value="<?=$head['menu_text_hover_color']?>" id="textHoverColors">
                                        </div>

                                    </div>
                                </div>

                            </div>


                                <div class="row">

                                    <div class="col-md-3 ">
                                        <div class="form-group">

                                            <label style="font-weight: 500" for="searchColor">Arama İkonu Rengi [ Header 1 ve 2 İçin]</label>

                                            <br><br>

                                            <small class="form-control-feedback text-purple" style="font-size:13px">Header alanındaki Arama İkonunun Rengi</small>

                                            <br><br>

                                            <div class="input-group" >
                                                <input type="text" class="form-control jscolor" name="arama_button_bg" value="<?=$head['arama_button_bg']?>" id="searchColor">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-3 ">
                                        <div class="form-group">

                                            <label style="font-weight: 500" for="borderLangColor">Dil Seçim Çerçeve Rengi [ Header 1 ve 2 İçin]</label>

                                            <br><br>

                                            <small class="form-control-feedback text-purple" style="font-size:13px">Header Dil Seçimi Alanındaki Kutunun Çerçeve (Border) Rengi</small>

                                            <br><br>

                                            <div class="input-group" >
                                                <input type="text" class="form-control jscolor" name="dil_border" value="<?=$head['dil_border']?>" id="borderLangColor">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">

                                            <label style="font-weight: 500" for="mobilBg">Mobil Header Arkaplan Rengi</label>

                                            <br><br>

                                            <small class="form-control-feedback text-purple" style="font-size:13px">Mobilden girildiğinde görünen header arkaplanı </small>

                                            <br><br>

                                            <div class="input-group" >
                                                <input type="text" class="form-control jscolor" name="mobil_bg" value="<?=$head['mobil_bg']?>" id="mobilBg">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-3 ">
                                        <div class="form-group">

                                            <label style="font-weight: 500" for="mobilBar">Mobil Header Menü Bar Rengi</label>

                                            <br><br>

                                            <small class="form-control-feedback text-purple" style="font-size:13px">Mobilden görünen alt alta 3 çizginin renk seçimi</small>

                                            <br><br>

                                            <div class="input-group" >
                                                <input type="text" class="form-control jscolor" name="mobil_bar_color" value="<?=$head['mobil_bar_color']?>" id="mobilBar">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6 ">
                                        <div class="form-group">

                                            <label style="font-weight: 500" >Üyelik İkonu </label>

                                            <br><br>

                                            <small class="form-control-feedback text-purple" style="font-size:13px">Header alanındaki üye giriş ve üyelik simgesini seçebilirsiniz</small>

                                            <br><br>

                                            <div class="input-group" >
                                                <select name="uyelik_icon" class="selectpicker col-md-12 p-l-0 p-r-0" data-style="form-control btn-secondary" id="iconSec">
                                                    <option value="fa fa-user-o" <?php if($head['uyelik_icon'] == 'fa fa-user-o'){?>selected<?php }?>>İkon - 1</option>
                                                    <option value="fa fa-user" <?php if($head['uyelik_icon'] == 'fa fa-user'){?>selected<?php }?>>İkon - 2</option>
                                                    <option value="fa fa-user-circle-o" <?php if($head['uyelik_icon'] == 'fa fa-user-circle-o'){?>selected<?php }?>>İkon - 3</option>
                                                    <option value="ion-person" <?php if($head['uyelik_icon'] == 'ion-person'){?>selected<?php }?>>İkon - 4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 ">
                                        <div class="form-group">

                                            <label style="font-weight: 500" for="uyelikiconolor">Üyelik İkon ve Yazı Rengi </label>

                                            <br><br>

                                            <small class="form-control-feedback text-purple" style="font-size:13px">Header alanındaki simge ve yazı rengi seçimi. Header için en aşağıdan ayarlayın</small>

                                            <br><br>

                                            <div class="input-group" >
                                                <input type="text" class="form-control jscolor" name="uyelik_icon_color" value="<?=$head['uyelik_icon_color']?>" id="uyelikiconolor">
                                            </div>

                                        </div>
                                    </div>
                                </div>


                              


                                <h3><i class="mdi mdi-palette"></i> Header Ayarları</h3>
                                <hr>

                                <div class="row">

                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label style="font-weight: 500" for="h2Bg">HEADER Menu Zemin Rengi [Mobil İçinde Geçerli]</label>
                                            <br><br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px">Header için menülerin altındaki zemin rengi. Ayrıca mobil içinde geçerlidir</small>
                                            <br><br>
                                            <div class="input-group" >
                                                <input type="text" class="form-control jscolor" name="menu_bg" value="<?=$head['menu_bg']?>" id="h2Bg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label style="font-weight: 500" for="bgBorderh2">HEADER Üst Kenarlık Rengi</label>
                                            <br><br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px">Header için menü ile logo arasındaki çizgi rengi</small>
                                            <br><br>
                                            <div class="input-group" >
                                                <input type="text" class="form-control jscolor" name="header2_menu_border" value="<?=$head['header2_menu_border']?>" id="bgBorderh2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label style="font-weight: 500" for="searchH2bg">HEADER Arama Alanı Kenarlık ve Button Rengi</label>
                                            <br><br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px">Header için arama alanına ait kenarlık ve arama butonu arkaplan rengi</small>
                                            <br><br>
                                            <div class="input-group" >
                                                <input type="text" class="form-control jscolor" name="arama_button_color" value="<?=$head['arama_button_color']?>" id="searchH2bg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label style="font-weight: 500">HEADER Üyelik Alanı Arkaplan Rengi</label>
                                            <br><br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px">Üyelik simgesi alanının arkaplan rengi</small>
                                            <br>  <br>
                                            <div class="input-group" >
                                                <select name="header2_uyelik_bg" id="adssc" class="form-control">
                                                    <option <?php if ($head['header2_uyelik_bg'] == 'warning') {?> selected <?php }?> value="warning">Sarı</option>
                                                    <option <?php if ($head['header2_uyelik_bg'] == 'info') {?> selected <?php }?> value="info">Mavi</option>
                                                    <option <?php if ($head['header2_uyelik_bg'] == 'danger') {?> selected <?php }?> value="danger">Kırmızı</option>
                                                    <option <?php if ($head['header2_uyelik_bg'] == 'success') {?> selected <?php }?> value="success">Yeşil</option>
                                                    <option <?php if ($head['header2_uyelik_bg'] == 'primary') {?> selected <?php }?> value="primary">Koyu Mavi</option>
                                                    <option <?php if ($head['header2_uyelik_bg'] == 'secondary') {?> selected <?php }?> value="secondary">Gri</option>
                                                    <option <?php if ($head['header2_uyelik_bg'] == 'light') {?> selected <?php }?> value="light">Açık Gri</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label style="font-weight: 500">HEADER Sepet Alanı Arkaplan Rengi</label>
                                            <br><br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px">Sepet gösteriminin arkaplan rengi</small>
                                            <br>  <br>
                                            <div class="input-group" >
                                                <select name="header2_cart_bg" id="adssc" class="form-control">
                                                    <option <?php if ($head['header2_cart_bg'] == 'warning') {?> selected <?php }?> value="warning">Sarı</option>
                                                    <option <?php if ($head['header2_cart_bg'] == 'info') {?> selected <?php }?> value="info">Mavi</option>
                                                    <option <?php if ($head['header2_cart_bg'] == 'danger') {?> selected <?php }?> value="danger">Kırmızı</option>
                                                    <option <?php if ($head['header2_cart_bg'] == 'success') {?> selected <?php }?> value="success">Yeşil</option>
                                                    <option <?php if ($head['header2_cart_bg'] == 'primary') {?> selected <?php }?> value="primary">Koyu Mavi</option>
                                                    <option <?php if ($head['header2_cart_bg'] == 'secondary') {?> selected <?php }?> value="secondary">Gri</option>
                                                    <option <?php if ($head['header2_cart_bg'] == 'light') {?> selected <?php }?> value="light">Açık Gri</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label style="font-weight: 500">HEADER Menü Hizası</label>
                                            <br><br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px">Sola hizalı veya ortalı olarak gösterim sağlayabilirsiniz</small>
                                            <br>  <br>
                                            <div class="input-group" >
                                                <select name="menu_align" id="adssc" class="form-control">
                                                    <option <?php if ($head['menu_align'] == '0') {?> selected <?php }?> value="0">Sola Hizalı</option>
                                                    <option <?php if ($head['menu_align'] == '1') {?> selected <?php }?> value="1">Ortalı</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label style="font-weight: 500" for="h2Height">HEADER Yükseklik Değeri</label>
                                            <br><br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px">NOT: değerin sonuna <strong>px</strong> ekleyin.<strong>İdeal 50px'dir.</strong> </small>
                                            <br><br>
                                            <div class="input-group" >
                                                <input type="text" class="form-control" name="header2_menu_height" value="<?=$head['header2_menu_height']?>" id="h2Height">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label style="font-weight: 500" for="spacePx">HEADER Alt Boşluk Değeri</label>
                                            <br><br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px">Menü bitimi ile bileşenler arasında boşluk oluşturabilirsiniz.İdeal : 0'dır. Diğer rakamlar için sonuna px ekleyin</strong> </small>
                                            <br><br>
                                            <div class="input-group" >
                                                <input type="text" class="form-control" name="header2_bottom_margin" value="<?=$head['header2_bottom_margin']?>" id="spacePx">
                                            </div>
                                        </div>
                                    </div>

                                </div>




                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" name="headerdegis">
                                        <i class="fa fa-refresh fa-spin fa-fw"></i>
                                        <span class="sr-only">Yükleniyor...</span> Header Güncelle
                                    </button>
                                </div>




                        </form>
                        </div>

                    </div>
                    <div class="tab-pane" id="tophead" role="tabpanel">
                        <div class="p-20">

                            <form action="support/post/update/header-topmenu-ayar.php" class="form-horizontal form-bordered" method="post">



                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label" for="topHeadDurum" style="margin-bottom: 6px; font-weight: 600">Top Header Durumu</label>
                                            <br><br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px"> Aktif veya Pasif hale getirebilirsiniz. Önerilen aktif olmasıdır</small>
                                            <br><br>
                                            <input type='hidden' value='0' name='durum'>
                                            <input type="checkbox" <?php if($head['durum'] == 1){?>checked<?php }?> class="js-switch" id="topHeadDurum" data-color="#f62d51" name="durum" value="1" />

                                        </div>
                                    </div>

                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label style="font-weight: 500">Top Header Modül Genişliği</label>
                                            <br><br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px">Geniş seçilirse %100, Kutu seçilirse %90 genişlk olur.</small>
                                            <br><br>
                                            <div class="input-group" >

                                                <select name="topheader_width" class="form-control" >
                                                    <option value="0" <?php if($head['topheader_width'] == 0 ) { ?> selected <?php }?>>Geniş</option>
                                                    <option value="1" <?php if($head['topheader_width'] == 1 ) { ?> selected <?php }?>>Kutu</option>
                                                </select>

                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label style="font-weight: 500">Font Seçimi</label>
                                            <br><br>

                                            <small class="form-control-feedback text-purple" style="font-size:13px">Open sans ve Raleway fontları bulunmaktadır.</small>
                                            <br>  <br>
                                            <div class="input-group" >

                                                <select name="font" class="form-control" >
                                                    <option value="raleway" <?php if($head['font'] == 'raleway' ) { ?> selected <?php }?>>Raleway</option>
                                                    <option value="open-sans" <?php if($head['font'] == 'open-sans' ) { ?> selected <?php }?>>Open Sans</option>

                                                </select>

                                            </div>


                                        </div>
                                    </div>

                                    <div class="col-md-3 ">
                                        <div class="form-group">

                                            <label style="font-weight: 500" for="sizeSec">Padding Değeri</label>

                                            <br><br>

                                            <small class="form-control-feedback text-purple" style="font-size:13px">Yukarıdan ve aşağıdan aralık bırakabilirsiniz.</small>

                                            <br><br>

                                            <div class="input-group" >
                                                <input type="number" class="form-control" name="padding" value="<?=$head['padding']?>" id="sizeSec">
                                            </div>

                                        </div>
                                    </div>



                                </div>


                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">

                                            <label style="font-weight: 500" for="topHeadBGColor">Top Header Arkaplan Rengi</label>

                                            <br><br>

                                            <small class="form-control-feedback text-purple" style="font-size:13px">En üst alanın arkaplan rengi </small>

                                            <br><br>

                                            <div class="input-group" >
                                                <input type="text" class="form-control jscolor" name="back_color" value="<?=$head['back_color']?>" id="topHeadBGColor">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">

                                            <label style="font-weight: 500" for="topHeadYazicolor">Top Header Yazı Rengi</label>

                                            <br><br>

                                            <small class="form-control-feedback text-purple" style="font-size:13px">En üst alandaki yazıların rengi </small>

                                            <br><br>

                                            <div class="input-group" >
                                                <input type="text" class="form-control jscolor" name="text_color" value="<?=$head['text_color']?>" id="topHeadYazicolor">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-3 ">
                                        <div class="form-group">

                                            <label style="font-weight: 500" for="topHeadBorders">Top Header Alt Border Rengi</label>

                                            <br><br>

                                            <small class="form-control-feedback text-purple" style="font-size:13px">En üst alanın alt köşelik rengi </small>

                                            <br><br>

                                            <div class="input-group" >
                                                <input type="text" class="form-control jscolor" name="border_color" value="<?=$head['border_color']?>" id="topHeadBorders">
                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">

                                        <label style="font-weight: 500" for="iconColors">İkon Renkleri</label>

                                            <br><br>

                                            <small class="form-control-feedback text-purple" style="font-size:13px">Sosyal ve diğer icon renkleri</small>

                                            <br><br>

                                            <div class="input-group" >
                                                <input type="text" class="form-control jscolor" name="icon_color" value="<?=$head['icon_color']?>" id="iconColors">
                                            </div>

                                        </div>
                                    </div>


                                </div>



                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="topSocial" style="margin-bottom: 13px; font-weight: 600">Sosyal Bağlantılar</label>
                                            <br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px"> Sosyal bağlantılarınızı aktif-pasif yapabilirsiniz</small>
                                            <br><br>
                                            <input type='hidden' value='0' name='sosyal'>
                                            <input type="checkbox" <?php if($head['sosyal'] == 1){?>checked<?php }?> class="js-switch" id="topSocial" data-color="#f62d51" name="sosyal" value="1" />

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="topTel1" style="margin-bottom: 13px; font-weight: 600">Telefon Numarası</label>
                                            <br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px"> Telefon numaranızı aktif-pasif yapabilirsiniz</small>
                                            <br><br>
                                            <input type='hidden' value='0' name='tel'>
                                            <input type="checkbox" <?php if($head['tel'] == 1){?>checked<?php }?> class="js-switch" id="topTel1" data-color="#f62d51" name="tel" value="1" />

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="topGSM" style="margin-bottom: 13px; font-weight: 600">GSM Numarası</label>
                                            <br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px"> GSM Numaranızı aktif-pasif yapabilirsiniz</small>
                                            <br><br>
                                            <input type='hidden' value='0' name='tel_2'>
                                            <input type="checkbox" <?php if($head['tel_2'] == 1){?>checked<?php }?> class="js-switch" id="topGSM" data-color="#f62d51" name="tel_2" value="1" />

                                        </div>
                                    </div>

                                </div>



                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="topEmail" style="margin-bottom: 13px; font-weight: 600">E-Posta</label>
                                            <br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px"> E-Posta görünümünüzü aktif-pasif yapabilirsiniz</small>
                                            <br><br>
                                            <input type='hidden' value='0' name='mail'>
                                            <input type="checkbox" <?php if($head['mail'] == 1){?>checked<?php }?> class="js-switch" id="topEmail" data-color="#f62d51" name="mail" value="1" />

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="topWZ" style="margin-bottom: 13px; font-weight: 600">WhatsApp</label>
                                            <br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px"> WhatsApp görünümünüzü aktif-pasif yapabilirsiniz</small>
                                            <br><br>
                                            <input type='hidden' value='0' name='whatsapp'>
                                            <input type="checkbox" <?php if($head['whatsapp'] == 1){?>checked<?php }?> class="js-switch" id="topWZ" data-color="#f62d51" name="whatsapp" value="1" />

                                        </div>
                                    </div>



                                </div>




                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="teklif_formu" style="margin-bottom: 13px; font-weight: 600">Teklif Formu Butonu</label>
                                            <br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px"> Teklif formunu içeren butonun aktif-pasif durumu</small>
                                            <br><br>
                                            <input type='hidden' value='0' name='teklif_button'>
                                            <input type="checkbox" <?php if($head['teklif_button'] == 1){?>checked<?php }?> class="js-switch" id="teklif_formu" data-color="#f62d51" name="teklif_button" value="1" />
                                            <?php //TODO burası var ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight: 500" for="buttonBgColor">Teklif Button Arkaplan Rengi</label>
                                            <br><br>
                                            <div class="input-group" >
                                                <select name="teklif_button_bg" id="buttonBgColor" class="form-control">
                                                    <option <?php if ($head['teklif_button_bg'] == 'warning') {?> selected <?php }?> value="warning">Sarı</option>
                                                    <option <?php if ($head['teklif_button_bg'] == 'info') {?> selected <?php }?> value="info">Mavi</option>
                                                    <option <?php if ($head['teklif_button_bg'] == 'danger') {?> selected <?php }?> value="danger">Kırmızı</option>
                                                    <option <?php if ($head['teklif_button_bg'] == 'success') {?> selected <?php }?> value="success">Yeşil</option>
                                                    <option <?php if ($head['teklif_button_bg'] == 'primary') {?> selected <?php }?> value="primary">Koyu Mavi</option>
                                                    <option <?php if ($head['teklif_button_bg'] == 'secondary') {?> selected <?php }?> value="secondary">Gri</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="siparis_takip_button" style="margin-bottom: 13px; font-weight: 600">Sipariş Takip Butonu</label>
                                            <br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px"> Sipariş takip butonunun aktif-pasif durumu</small>
                                            <br><br>
                                            <input type='hidden' value='0' name='siparis_takip_button'>
                                            <input type="checkbox" <?php if($head['siparis_takip_button'] == 1){?>checked<?php }?> class="js-switch" id="siparis_takip_button" data-color="#f62d51" name="siparis_takip_button" value="1" />

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight: 500" for="buttonBgColor">Sipariş Takip Button Arkaplan Rengi</label>
                                            <br><br>
                                            <div class="input-group" >
                                                <select name="siparis_takip_button_bg" id="buttonBgColor" class="form-control">
                                                    <option <?php if ($head['siparis_takip_button_bg'] == 'warning') {?> selected <?php }?> value="warning">Sarı</option>
                                                    <option <?php if ($head['siparis_takip_button_bg'] == 'info') {?> selected <?php }?> value="info">Mavi</option>
                                                    <option <?php if ($head['siparis_takip_button_bg'] == 'danger') {?> selected <?php }?> value="danger">Kırmızı</option>
                                                    <option <?php if ($head['siparis_takip_button_bg'] == 'success') {?> selected <?php }?> value="success">Yeşil</option>
                                                    <option <?php if ($head['siparis_takip_button_bg'] == 'primary') {?> selected <?php }?> value="primary">Koyu Mavi</option>
                                                    <option <?php if ($head['siparis_takip_button_bg'] == 'secondary') {?> selected <?php }?> value="secondary">Gri</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" name="topheaderdegis">
                                        <i class="fa fa-refresh fa-spin fa-fw"></i>
                                        <span class="sr-only">Yükleniyor...</span> Top Header Güncelle
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                    <div class="tab-pane" id="mega" role="tabpanel">




                            <div class="form-body form-horizontal form-bordered m-t-40">

                                <div class="alert alert-info text-center" style="font-weight: 500">

                                    Mega menü sadece ürünler modülüne ait olan bir açılır menü sistemidir. Mega menü seçili olan menüye eklediğiniz alt menüler görüntülenmez.

                                </div>
                                <br><br>


                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3" for="siteAd" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Mega Menü Başlık</label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" value="<?=$diller['mega-menu-baslik']?>" disabled>
                                        <br><br>
                                        <small class="text-success" style="font-size:13px">Bu yazıyı dil ayarlarınızdaki düzenleme alanının 7.satırından değiştirebilirsiniz</small>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3" for="siteSlogan" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Mega Menü İçerik</label>
                                    <div class="col-md-6">
                                        <textarea rows="2" class="form-control" disabled><?=$diller['mega-menu-icerik']?></textarea>
                                        <br><br>
                                        <small class="text-success" style="font-size:13px">Bu yazıyı dil ayarlarınızdaki düzenleme alanının 8.satırından değiştirebilirsiniz</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3" for="siteAdresiURL" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Mega Menü Button</label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" value="<?=$diller['mega-menu-button']?>" disabled>
                                        <br><br>
                                        <small class="text-success" style="font-size:13px">Bu yazıyı dil ayarlarınızdaki düzenleme alanının 9.satırından değiştirebilirsiniz</small>
                                    </div>
                                </div>



                                <div class="form-group row">

                                    <label class="control-label text-right col-md-3" for="" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Mega Menu Arkaplan Görseli</label>
                                    <div class="col-md-3">
                                        <form action="support/post/update/header-mega-gorsel.php"  method="post" enctype="multipart/form-data">

                                        <div style="width: 100%; height: auto; background-color: #F9F9F9; border:1px solid #EBEBEB; padding: 15px; 0 15px 0; text-align: center;  margin-top:8px;">
                                            <img src="../images/firsat/<?=$head['mega_gorsel']?>" alt="" style="max-width: 220px;">
                                        </div>

                                            <input type="hidden" name="eski_mega_gorsel" value="<?=$head['mega_gorsel']?>" >

                                            <div class="input-group" style="margin-top: 8px">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="mega_gorsel" required>
                                                    <label class="custom-file-label" for="inputGroupFile04">Seç</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-info" name="megaresim">
                                                        <i class="fa fa-refresh fa-spin fa-fw"></i>
                                                        <span class="sr-only">Yükleniyor...</span> Güncelle
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>


                            </div>







                    </div>

                    <!-- Sabit Header !-->
                    <div class="tab-pane" id="fixedheader" role="tabpanel">

                        <form action="support/post/update/sabit-header.php" class="form-horizontal form-bordered" method="post">

                            <?php
                            $fixedPrint = $db->prepare("select * from sabit_header where id=:id ");
                            $fixedPrint->execute(array(
                                'id' => '1',
                            ));
                            $fix = $fixedPrint->fetch(PDO::FETCH_ASSOC);
                            ?>


                            <div class="form-body form-horizontal form-bordered m-t-40">



                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3" for="yayinDurum" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600">Sabit Header</label>
                                    <div class="col-md-6">
                                        <input type='hidden' value='0' name='durum'>
                                        <input type="checkbox" <?php if($fix['durum'] == 1){?>checked<?php }?> id="yayinDurum" class="js-switch" data-color="#f62d51" name="durum" value="1" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3" for="arkaplan" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Sabit Header Arkaplan Rengi</label>
                                    <div class="col-md-6">
                                        <input type="text" name="arkaplan" value="<?=$fix['arkaplan']?>" class="form-control jscolor" >
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">Sabit kalan üsteki alanın arkaplan rengidir</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3" for="shadowArea" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600">Alt Gölgelendirme</label>
                                    <div class="col-md-6">
                                        <input type='hidden' value='0' name='shadow'>
                                        <input type="checkbox" <?php if($fix['shadow'] == 1){?>checked<?php }?> id="shadowArea" class="js-switch" data-color="#f62d51" name="shadow" value="1" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3" for="altslider" style="margin-top: 9px;  margin-bottom: 10px; font-weight: 600">Üst ve Alt Boşluk Değeri</label>
                                    <div class="col-md-6">
                                        <input type="number" name="padding" value="<?=$fix['padding']?>" class="form-control" >
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px">İdeal : 15</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3" for="asxxdasd" style="margin-top: 7px; margin-bottom: 10px; font-weight: 600"></label>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success" name="sabitheader">
                                            <i class="fa fa-refresh fa-spin fa-fw"></i>
                                            <span class="sr-only">Yükleniyor...</span> Bilgileri Güncelle
                                        </button>
                                    </div>
                                </div>


                            </div>
                    </div>
                    <!-- Sabit Header SON !-->

                </div>





            </div>







        </div>
    </div>
</div>



<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'Güncelleme işleminiz gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=headermenuayar">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=headermenuayar">
<?php }?>
<?php if($_GET['status']=='imgtype'){ ?>
    <body onload="sweetAlert('HATA!', 'Görsel dosyanız jpg, png veya gif türü dışında olamaz', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=headermenuayar">
<?php }?>


