<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Ürün Kategorisi Düzenle | <?=$ayar['site_baslik']?></title>
<?php
$urunKatCek = $db ->prepare("select * from urun_cat where id='$_GET[kategori_id]' and dil='$_SESSION[dil]'");
$urunKatCek->execute();
$kat = $urunKatCek->fetch(PDO::FETCH_ASSOC);

$ustkategori = $db->prepare("select * from urun_cat where durum='1' and dil='$_SESSION[dil]' and ust_id='0' order by sira");
$ustkategori->execute();
?>
<?php
if($urunKatCek->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=urunkategorileri");
}
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-arrange-bring-forward"></i> Ürün Kategorisi Düzenle</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=urunkategorileri">Ürün Kategorileri</a></li>
                <li class="breadcrumb-item active">Ürün Kategorisi Düzenle</li>
            </ol>
        </div>
    </div>
</div>






<div class="row">
    <div class="col-lg-12">
        <div class="card">






            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/update/urun-kategori.php" class="form-horizontal " method="post" enctype="multipart/form-data">

                    <input type="hidden" name="kat_id" value="<?=$kat['id']?>">

                    <h3 class="card-title">Ürün Kategorisi Düzenle <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span></h3>
                    <hr>
                    <div class="form-body">




                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="form-group col-md-5">
                                <label style="font-weight: 500" for="menuAd">Kategori Adı</label><br><br>
                                <input type="text" class="form-control" name="baslik" required id="menuAd" value="<?=$kat['baslik']?>">
                            </div>

                            <div class="form-group col-md-5">
                                <label style="font-weight: 500" for="menuUrl">İkon</label><br><br>
                                <select class="form-control awesome-select" name="icon" id="icons">
                                    <option value="" > İkonsuz</option>
                                    <?php if ($kat['icon'] == null) { ?>

                                    <?php } else {?>
                                        <option value="<?=$kat['icon']?>" selected  > <?=$kat['icon']?></option>
                                    <?php }?>
                                    <?php include 'support/panel_parts/icon.php'?>
                                </select>
                            </div>


                            <div class="form-group col-md-2">
                                <label style="font-weight: 500" for="menuSira">Sıra</label><br><br>
                                <input type="number" class="form-control" name="sira" required id="menuSira" value="<?=$kat['sira']?>">
                            </div>

                        </div>

                        <div class="row m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="form-group col-md-12">
                                <label style="font-weight: 500" for="ustKat">Üst Kategori Seçimi</label><br><br>
                                <select name="ust_id" id="ustKat" class="form-control">
                                    <option value="0" <?php if ($kat['ust_id'] == 0) { ?> selected <?php }?>  >Ana Kategori</option>
                                    <?php foreach ($ustkategori as $ustcat) {?>
                                        <option value="<?=$ustcat['id']?>" <?php if ($kat['ust_id'] == $ustcat['id']) { ?> selected <?php }?>><?=$ustcat['baslik']?></option>
                                    <?php }?>
                                </select>
                            </div>

                        </div>




                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">


                            <div class="form-group col-md-4">
                                <label class="control-label" for="drumNedir" style="margin-bottom: 13px; font-weight: 600">Yayın Durumu</label>
                                <br><br>
                                <small class="form-control-feedback text-purple" style="font-size:13px"> Pasif yaparsanız kullanılamaz</small>
                                <br><br>
                                <input type='hidden' value='0' name='durum'>
                                <input type="checkbox" <?php if ($kat['durum'] == 1) { ?> checked <?php }?> id="drumNedir" class="js-switch" data-color="#f62d51" name="durum" value="1" />
                            </div>

                            <div class="form-group col-md-4">
                                <label class="control-label" for="anaSayfa" style="margin-bottom: 13px; font-weight: 600">Anasayfa Tab Alanı</label>
                                <br><br>
                                <small class="form-control-feedback text-purple" style="font-size:13px"> Sadece ana kategoriler içindir. Tab limitini modül ayarlarından değiştirebilirsiniz</small>
                                <br><br>
                                <input type='hidden' value='0' name='anasayfa'>
                                <input type="checkbox"  <?php if ($kat['ust_id'] == 0) { ?> checked <?php }?> id="anaSayfa" class="js-switch" data-color="#f62d51" name="anasayfa" value="1" />
                            </div>

                            <div class="form-group col-md-4">
                                <label class="control-label" for="homeGruplar" style="margin-bottom: 13px; font-weight: 600">Anasayfa Ürün Grupları</label>
                                <br><br>
                                <small class="form-control-feedback text-purple" style="font-size:13px"> Seçili ise kapak görseli ekleyiniz.</small>
                                <br><br>
                                <input type='hidden' value='0' name='anasayfa_grup'>
                                <input type="checkbox" <?php if ($kat['anasayfa_grup'] == 1) { ?> checked <?php }?> id="homeGruplar" class="js-switch" data-color="#f62d51" name="anasayfa_grup" value="1" />
                            </div>



                        </div>



                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="form-group col-md-12">
                                <input type="hidden" name="eski_gorsel" value="<?=$kat['gorsel']?>">
                                <label style="font-weight: 500" for="ustKat">Kategori Kapak Görseli</label>

                                <div style="width: 100%; height: auto; background-color: #F9F9F9; border:1px solid #EBEBEB; padding: 15px; 0 15px 0; text-align: center;  margin-top:8px;">
                                    <?php
                                    if ($kat['gorsel'] == !null)
                                    {
                                        ?>
                                        <img src="../images/product-category/<?=$kat['gorsel']?>" style="width: 280px; height: 160px;">
                                    <?php } else { ?>
                                        Kapak Görseli Eklenmemiş
                                    <?php }?>
                                    <br><br>
                                    <small class="form-control-feedback text-info" style="font-size:13px; font-weight: 400"> İdeal Ebat : 500x280</small>
                                </div>
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
                                <textarea name="meta_desc" id="descpAlan" class="form-control" rows="2"><?=$kat['meta_desc']?></textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label style="font-weight: 500" for="tagsAreas">Etiketler</label><br><br>
                                <input type="text"  data-role="tagsinput" placeholder="Etiket Ekle" name="tags" value="<?=$kat['tags']?>"/>
                            </div>


                        </div>



                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="urunkatdegis">
                            <i class="fa fa-refresh fa-spin fa-fw"></i>
                            <span class="sr-only">Yükleniyor...</span> Güncelle
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
