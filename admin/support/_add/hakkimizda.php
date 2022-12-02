<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$veriCek = $db->prepare("select * from about_page where dil='$_SESSION[dil]' order by id desc limit 1");
$veriCek->execute();
$row = $veriCek->fetch(PDO::FETCH_ASSOC);

$galeriCek = $db->prepare("select * from galeri_kat where dil='$_SESSION[dil]' and durum='1' order by sira asc");
$galeriCek->execute();
?>

<?php
if($veriCek->rowCount() > 0 ) {
    header("Location:pages.php?sayfa=hakkimizdasayfa");
}
?>
    <title>Hakkımızda Sayfası Ekle | <?=$ayar['site_baslik']?></title>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor"><i class="mdi mdi-file-document-box"></i> Hakkımızda Sayfası</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                    <li class="breadcrumb-item"><a href="pages.php?sayfa=hakkimizdasayfa">Hakkımızda Sayfası</a></li>
                    <li class="breadcrumb-item active">Hakkımızda Sayfası Ekle</li>
                </ol>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">




                <div class="card-body" style="font-family: 'Open Sans', Arial; padding: 0.25em;">

                    <div class="card-body p-b-0">
                        <h3 class="card-title">Hakkımızda Sayfası <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span></h3>

                        <hr>

                        <!-- Nav tabs -->

                        <!-- Tab panes -->
                        <form action="support/post/insert/hakkimizda.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="dil" value="<?=$_SESSION['dil']?>">

                            <div class="tab-content">
                                <div class="tab-pane active" id="genel" role="tabpanel">
                                    <div>



                                        <div class="row">

                                            <div class="col-md-7 ">
                                                <div class="form-group">
                                                    <label style="font-weight: 500" for="basLik">Sayfa Başlığı</label>
                                                    <br><br>
                                                    <div class="input-group" >
                                                        <input type="text" name="baslik" class="form-control" id="basLik" required >
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label style="font-weight: 500" for="seoURL">SEO URL</label>
                                                    <br><br>
                                                    <div class="input-group" >
                                                        <input type="text" name="seo_url" class="form-control" id="seoURL" required placeholder="Örn : hakkimizda-sayfasi">
                                                    </div>
                                                </div>
                                            </div>


                                        </div>




                                        <div class="row">

                                            <div class="col-md-12 p-l-0 ">
                                                <div class="form-group col-md-12">
                                                    <label style="font-weight: 500" for="spotArea"><i class="fa fa-sort"></i> Hakkımızda Kısa Açıklama </label><br><br>
                                                    <small class="form-control-feedback text-purple" style="font-size:13px"> Footer alanında ve anasayfa modül alanı için gereklidir. </small>
                                                    <br><br>
                                                    <textarea name="spot" id="spotArea" class="form-control" rows="4" required></textarea>
                                                </div>
                                            </div>

                                        </div>





                                        <div class="row">

                                            <div class="col-md-4 ">
                                                <div class="form-group">
                                                    <label class="control-label" for="sayac" style="margin-bottom: 13px; font-weight: 600">Sayaç Göster</label>
                                                    <br>
                                                    <input type='hidden' value='0' name='counter'>
                                                    <input type="checkbox" checked id="sayac" class="js-switch" data-color="#f62d51" name="counter" value="1" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 ">
                                                <div class="form-group">
                                                    <label class="control-label" for="beceri" style="margin-bottom: 13px; font-weight: 600"><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="left" title="Renk ayarlarını beceriler sayfasından yapınız"></i> Becerileri Göster</label>
                                                    <br>
                                                    <input type='hidden' value='0' name='beceri'>
                                                    <input type="checkbox" checked id="beceri" class="js-switch" data-color="#f62d51" name="beceri" value="1" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 ">
                                                <div class="form-group">
                                                    <label class="control-label" for="beceri" style="margin-bottom: 13px; font-weight: 600">Galeri Seçimi</label>
                                                    <br>
                                                    <select name="galeri_id" class="selectpicker col-md-12 p-l-0 p-r-0" data-style="form-control btn-secondary">
                                                        <option value="">-- Seçmeden Devam Et --</option>
                                                        <?php foreach ($galeriCek as $galeri) {?>
                                                            <option  value="<?=$galeri['id']?>"><?=$galeri['baslik']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="countBG" style="margin-bottom: 13px; font-weight: 600">Sayaç Alanı Arkaplan Rengi</label>
                                                    <br>
                                                    <input type="text"  id="countBG" class="form-control jscolor" name="counter_bgcolor" value="333333" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="countTxt" style="margin-bottom: 13px; font-weight: 600">Sayaç Yazılarının Rengi</label>
                                                    <br>
                                                    <input type="text"  id="countTxt" class="form-control jscolor" name="counter_textcolor" value="FFFFFF" />
                                                </div>
                                            </div>

                                        </div>



                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label style="font-weight: 500" for="mymce"><i class="fa fa-list"></i> Hakkımızda Yazısı Tümü </label><br><br>
                                                <textarea name="icerik" id="mymce"   rows="6" ></textarea>
                                            </div>
                                        </div>




                                    </div>
                                </div>


                            </div>
                    </div>

                    <div class="form-actions p-l-20 p-b-20">
                        <button type="submit" class="btn btn-success" name="hakkimizdaekle">
                            <i class="fa fa-save "></i>
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