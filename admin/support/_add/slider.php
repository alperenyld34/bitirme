<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$slider = $db->prepare("select * from slider where tur='1' and durum='1'");
$slider->execute();
?>
<title>Yeni Slider Ekle | <?=$ayar['site_baslik']?></title>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="ti-layout-slider "></i> Yeni Slider Ekle</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=sliderlar">Slider</a></li>
                <li class="breadcrumb-item active">Yeni Slider Ekle</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <div class="card-body p-b-0">
                    <h4 class="card-title">Yeni Slider Ekle <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span></h4>

                <hr>

                <!-- Nav tabs -->

                <!-- Tab panes -->
                <form action="support/post/insert/slider-ekle.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="dil" value="<?=$_SESSION['dil']?>">


                <div class="tab-content">
                    <div class="tab-pane active" id="genel" role="tabpanel">
                        <div class="p-20">


                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label class="control-label" for="yayin" style="margin-bottom: 13px; font-weight: 600">Yayın Durumu</label>
                                        <br>
                                        <input type='hidden' value='0' name='durum'>
                                        <input type="checkbox" checked id="yayin" class="js-switch" data-color="#f62d51" name="durum" value="1" />
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label class="control-label" for="slidYazi" style="margin-bottom: 13px; font-weight: 600">Slider Yazıları <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="left" title="Seçim yapılmazsa başlık ve spot görünmez"></i></label>
                                        <br>
                                        <input type='hidden' value='0' name='text_status'>
                                        <input type="checkbox" checked id="slidYazi" class="js-switch" data-color="#f62d51" name="text_status" value="1" />
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label class="control-label" for="bgkarartma" style="margin-bottom: 13px; font-weight: 600">Arkaplan Karartma <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="left" title="Seçilirse arkaplan kararır, başlık ve spot netleşir"></i></label>
                                        <br>
                                        <input type='hidden' value='0' name='dark_bg'>
                                        <input type="checkbox"  id="bgkarartma" class="js-switch" data-color="#f62d51" name="dark_bg" value="1" />
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label class="control-label" for="sirasiSlider" style="margin-bottom: 8px; font-weight: 600">Slider Sırası</label>
                                        <br>
                                        <input type="number"  id="sirasiSlider"  name="sira" value="<?=$slider->rowCount()+1;?>" required class="form-control" min=1 oninput="validity.valid||(value='');"/>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="basLik">Slider Başlığı</label>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" name="baslik" class="form-control" id="basLik" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 ">
                                    <div class="form-group">
                                        <label class="control-label" for="yaziAlani" style="margin-bottom: 21px; font-weight: 600">Başlık ve Açıklama Hizası</label>
                                        <br>
                                        <select name="area" id="yaziAlani" class="form-control">
                                            <option value="left">Sola Hizalı</option>
                                            <option value="center">Ortalı</option>
                                            <option value="right">Sağa Hizalı</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="linkArea"><i class="fa fa-external-link-square"></i> Link ( http:// )</label>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" name="url" class="form-control" id="linkArea" placeholder="Boş bırakırsanız buton çıkmaz" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="butonText">Link Button Yazısı</label>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" name="button_text" class="form-control" id="butonText" placeholder="Örn : DETAYLI BİLGİ">
                                        </div>
                                    </div>
                                </div>


                            </div>




                            <div class="row">

                                <div class="col-md-12 ">
                                    <div class="form-group col-md-12">
                                        <label style="font-weight: 500" for="spotArea"><i class="fa fa-sort"></i> Kısa Açıklama (Spot)</label><br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px"> Lütfen görünüm estetikliği açısından açıklamayı çok kısa bir şekilde yapınız. </small>
                                        <br><br>
                                        <textarea name="spot" id="spotArea" class="form-control" rows="2"></textarea>
                                    </div>
                                </div>

                            </div>



                            <div class="row">

                                <div class="col-md-12 ">
                                    <div class="form-group col-md-12">

                                        <label style="font-weight: 500" for="ustKat"><i class="fa fa-photo"></i> Slider Görseli</label>
                                        <br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px"> İdeal Ebat : 1920x660 veya 1920x800</small>
                                        <div class="input-group" style="margin-top: 8px">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="gorsel" required >
                                                <label class="custom-file-label" for="inputGroupFile04">Seç</label>
                                            </div>
                                        </div>


                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label class="control-label" for="baslikAni" style="margin-bottom: 21px; font-weight: 600">Başlık Animasyonu</label>
                                        <br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px"> Ekrana geliş animasyonudur </small>
                                        <br><br>
                                        <select name="baslik_animation" id="baslikAni" class="form-control">
                                            <option value="fade-up">Fade-Up</option>
                                            <option value="fade-down">Fade-Down</option>
                                            <option value="fade-right">Fade-Right</option>
                                            <option value="fade-left">Fade-Left</option>

                                            <option value="flip-left">Flip Left</option>
                                            <option value="flip-right">Flip Right</option>
                                            <option value="flip-up">Flip Up</option>
                                            <option value="flip-down">Flip Down</option>

                                            <option value="zoom-in">Zoom-In</option>
                                            <option value="zoom-out">Zoom-Out</option>
                                            <option value="zoom-in-down">Zoom-In-Down</option>
                                            <option value="zoom-in-left">Zoom-In-Left</option>
                                            <option value="zoom-in-right">Zoom-In-Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label class="control-label" for="spotAni" style="margin-bottom: 21px; font-weight: 600">Spot(Açıklama) Animasyonu</label>
                                        <br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px"> Ekrana geliş animasyonudur </small>
                                        <br><br>
                                        <select name="spot_animation" id="spotAni" class="form-control">
                                            <option value="fade-up">Fade-Up</option>
                                            <option value="fade-down">Fade-Down</option>
                                            <option value="fade-right">Fade-Right</option>
                                            <option value="fade-left">Fade-Left</option>

                                            <option value="flip-left">Flip Left</option>
                                            <option value="flip-right">Flip Right</option>
                                            <option value="flip-up">Flip Up</option>
                                            <option value="flip-down">Flip Down</option>

                                            <option value="zoom-in">Zoom-In</option>
                                            <option value="zoom-out">Zoom-Out</option>
                                            <option value="zoom-in-down">Zoom-In-Down</option>
                                            <option value="zoom-in-left">Zoom-In-Left</option>
                                            <option value="zoom-in-right">Zoom-In-Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label class="control-label" for="buttonAni" style="margin-bottom: 21px; font-weight: 600">Buton Animasyonu</label>
                                        <br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px"> Ekrana geliş animasyonudur </small>
                                        <br><br>
                                        <select name="button_animation" id="buttonAni" class="form-control">
                                            <option value="fade-up">Fade-Up</option>
                                            <option value="fade-down">Fade-Down</option>
                                            <option value="fade-right">Fade-Right</option>
                                            <option value="fade-left">Fade-Left</option>

                                            <option value="flip-left">Flip Left</option>
                                            <option value="flip-right">Flip Right</option>
                                            <option value="flip-up">Flip Up</option>
                                            <option value="flip-down">Flip Down</option>

                                            <option value="zoom-in">Zoom-In</option>
                                            <option value="zoom-out">Zoom-Out</option>
                                            <option value="zoom-in-down">Zoom-In-Down</option>
                                            <option value="zoom-in-left">Zoom-In-Left</option>
                                            <option value="zoom-in-right">Zoom-In-Right</option>
                                        </select>
                                    </div>
                                </div>

                            </div>


                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="baslikcolor">Başlık ve Spot Rengi</label>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" name="text_bg" class="form-control jscolor" id="baslikcolor" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="buttonBgColor">Buton Arkaplan Rengi</label>
                                        <br><br>
                                        <div class="input-group" >
                                            <select name="button_bg" id="buttonBgColor" class="form-control">
                                                <option value="warning">Sarı</option>
                                                <option value="info">Mavi</option>
                                                <option value="danger">Kırmızı</option>
                                                <option value="success">Yeşil</option>
                                                <option value="primary">Koyu Mavi</option>
                                                <option value="secondary">Gri</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="buttonTxtColor">Buton Yazı Rengi</label>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" name="button_text_color" class="form-control jscolor" id="buttonTxtColor" >
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>


</div>
                </div>

                    <div class="form-actions p-l-20">
                        <button type="submit" class="btn btn-success" name="sliderekle">
                            <i class="fa fa-save"></i>
                            Kaydet
                        </button>
                    </div>

                </form>

            </div>







        </div>
    </div>
</div>

<?php if($_GET['status']=='imgtype'){ ?>
    <body onload="sweetAlert('HATA!', 'Görsel dosyanız jpg, png veya gif türü dışında olamaz', 'warning');">
    </body>
<?php }?>