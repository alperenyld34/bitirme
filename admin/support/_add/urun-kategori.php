<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Yeni Ürün Kategorisi Ekle | <?=$ayar['site_baslik']?></title>
<?php
$ustkategori = $db->prepare("select * from urun_cat where durum='1' and dil='$_SESSION[dil]' and ust_id='0' order by sira");
$ustkategori->execute();
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-arrange-bring-forward"></i> Yeni Ürün Kategorisi Ekle</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=urunkategorileri">Ürün Kategorileri</a></li>
                <li class="breadcrumb-item active">Yeni Ürün Kategorisi Ekle</li>
            </ol>
        </div>
    </div>
</div>






<div class="row">
    <div class="col-lg-12">
        <div class="card">






            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/insert/urun-kategori-ekle.php" class="form-horizontal " method="post" enctype="multipart/form-data">

                    <input type="hidden" name="dil" value="<?=$_SESSION['dil']?>">

                    <h3 class="card-title">Yeni Ürün Kategorisi Ekle <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span></h3>
                    <hr>
                    <div class="form-body">




                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="form-group col-md-5">
                                <label style="font-weight: 500" for="menuAd">Kategori Adı</label><br><br>
                                <input type="text" class="form-control" name="baslik" required id="menuAd">
                            </div>

                            <div class="form-group col-md-5">
                                <label style="font-weight: 500" for="menuUrl">İkon</label><br><br>
                                <select class="form-control awesome-select" name="icon" id="icons">
                                    <option value="" > İkonsuz</option>
                                    <?php include 'support/panel_parts/icon.php'?>
                                </select>
                            </div>


                            <div class="form-group col-md-2">
                                <label style="font-weight: 500" for="menuSira">Sıra</label><br><br>
                                <input type="number" class="form-control" name="sira"  id="menuSira"  min=1 oninput="validity.valid||(value='');" required value="<?=$ustkategori->rowCount()+1;?>">
                            </div>

                        </div>

                        <div class="row m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="form-group col-md-12">
                                <label style="font-weight: 500" for="ustKat">Üst Kategori Seçimi</label><br><br>
                                <select name="ust_id" id="ustKat" class="form-control">
                                    <option value="0">Ana Kategori</option>
                                    <?php foreach ($ustkategori as $ustcat) {?>
                                        <option value="<?=$ustcat['id']?>"><?=$ustcat['baslik']?></option>
                                    <?php }?>
                                </select>
                            </div>

                        </div>




                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">


                            <div class="form-group col-md-4">
                                <label class="control-label" for="yayin" style="margin-bottom: 13px; font-weight: 600">Yayın Durumu</label>
                                <br><br>
                                <small class="form-control-feedback text-purple" style="font-size:13px"> Pasif yaparsanız kullanılamaz</small>
                                <br><br>
                                <input type='hidden' value='0' name='durum'>
                                <input type="checkbox" checked id="yayin" class="js-switch" data-color="#f62d51" name="durum" value="1" />
                            </div>

                            <div class="form-group col-md-4">
                                <label class="control-label" for="anaSayfa" style="margin-bottom: 13px; font-weight: 600">Anasayfa Tab Alanı</label>
                                <br><br>
                                <small class="form-control-feedback text-purple" style="font-size:13px"> Sadece ana kategoriler içindir. Tab limitini modül ayarlarından değiştirebilirsiniz</small>
                                <br><br>
                                <input type='hidden' value='0' name='anasayfa'>
                                <input type="checkbox"  id="anaSayfa" class="js-switch" data-color="#f62d51" name="anasayfa" value="1" />
                            </div>

                            <div class="form-group col-md-4">
                                <label class="control-label" for="homeGruplar" style="margin-bottom: 13px; font-weight: 600">Anasayfa Ürün Grupları</label>
                                <br><br>
                                <small class="form-control-feedback text-purple" style="font-size:13px">  Seçili ise kapak görseli ekleyiniz.</small>
                                <br><br>
                                <input type='hidden' value='0' name='anasayfa_grup'>
                                <input type="checkbox"  id="homeGruplar" class="js-switch" data-color="#f62d51" name="anasayfa_grup" value="1" />
                            </div>



                        </div>



                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="form-group col-md-12">

                                <label style="font-weight: 500" for="ustKat">Kategori Kapak Görseli</label>
                                <br><br>
                                <small class="form-control-feedback text-purple" style="font-size:13px"> İdeal Ebat : 500x280</small>
                                <div class="input-group" style="margin-top: 8px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="gorsel" >
                                        <label class="custom-file-label" for="inputGroupFile04">Seç</label>
                                    </div>
                                </div>

                            </div>

                        </div>





                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">


                            <div class="form-group col-md-6">
                                <label style="font-weight: 500" for="descpAlan">Meta Açıklaması</label><br><br>
                                <textarea name="meta_desc" id="descpAlan" class="form-control" rows="2"></textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label style="font-weight: 500" for="tagsAreas">Etiketler</label><br><br>
                                <input type="text"  data-role="tagsinput" placeholder="Etiket Ekle" name="tags" />
                            </div>


                        </div>



                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="urunkatekle">
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
