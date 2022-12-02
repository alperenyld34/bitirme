<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<style>
    .rating {
        display: inline-block;
        position: relative;
height: 62px;
        font-size: 25px; overflow: hidden;
    }

    .rating label {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        cursor: pointer;
    }

    .rating label:last-child {
        position: static;
    }

    .rating label:nth-child(1) {
        z-index: 5;
    }

    .rating label:nth-child(2) {
        z-index: 4;
    }

    .rating label:nth-child(3) {
        z-index: 3;
    }

    .rating label:nth-child(4) {
        z-index: 2;
    }

    .rating label:nth-child(5) {
        z-index: 1;
    }

    .rating label input {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .rating label .icon {
        float: right;
        color: transparent;
    }

    .rating label:last-child .icon {
        color: #CCC;
    }

    .rating:not(:hover) label input:checked ~ .icon,
    .rating:hover label:hover input ~ .icon {
        color: #ffb400;
    }

    .rating label input:focus:not(:checked) ~ .icon:last-child {
        color: #000;
        text-shadow: 0 0 5px #09f;
    }
</style>
<?php
$uyelikAyar = $db->prepare("select * from uyeler_ayar where id=:id ");
$uyelikAyar->execute(array(
        'id' => '1'
    )
);
$uyeayar = $uyelikAyar->fetch(PDO::FETCH_ASSOC);
?>
<?php
$urunCek = $db->prepare("select * from urun where id='$_GET[urun_id]' and dil='$_SESSION[dil]'");
$urunCek->execute();
$row = $urunCek->fetch(PDO::FETCH_ASSOC);
?>
<?php
if($urunCek->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=urunler");
}
?>
<title>Ürün Düzenle | <?=$ayar['site_baslik']?></title>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="ti-dropbox"></i> Ürün Düzenle</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=urunler">Ürünler</a></li>
                <li class="breadcrumb-item active">Ürün Düzenle</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <div class="card-body p-b-0">
                    <h4 class="card-title">Ürün Düzenle</h4>
                    <h6 class="card-subtitle">Ürün Düzenlerken tablardaki alanlarıda doldurunuz</h6> </div>



                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist" style="font-family: 'Open Sans', Arial; font-weight: 500">
                    <li class="nav-item" > <a class="nav-link active" data-toggle="tab" href="#genel" role="tab" ><span class="hidden-sm-up"><i class="ti-settings"></i></span> <span class="hidden-xs-down" >Genel</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#diger" role="tab"><span class="hidden-sm-up"><i class="mdi mdi-information-outline"></i></span> <span class="hidden-xs-down">Diğer Bilgiler</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#ekstra" role="tab"><span class="hidden-sm-up"><i class="mdi mdi-plus"></i></span> <span class="hidden-xs-down">Ekstra</span></a> </li>
                </ul>
                <!-- Tab panes -->
                <form action="support/post/update/urunler.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="urun_id" value="<?=$row['id']?>">
                    <input type="hidden" name="eski_gorsel" value="<?=$row['gorsel']?>">


                <div class="tab-content">
                    <div class="tab-pane active" id="genel" role="tabpanel">
                        <div class="p-20">


                            <div class="row">
                                <div class="<?php if($uyeayar['durum'] =='1' ) {?>col-md-6<?php } else { ?>col-md-12<?php }?>">
                                    <div class="form-group">
                                        <label class="control-label" for="yayin" style="margin-bottom: 13px; font-weight: 600">Yayın Durumu</label>
                                        <br>
                                        <input type='hidden' value='0' name='durum'>
                                        <input type="checkbox" <?php if ($row['durum'] == 1) {?>checked<?php }?> id="yayin" class="js-switch" data-color="#f62d51" name="durum" value="1" />
                                    </div>
                                </div>
                                <?php if($uyeayar['durum'] =='1' ) {?>
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="control-label" for="durumYorum" style="margin-bottom: 13px; font-weight: 600">Bu Ürüne Yorum ve Değerlendirme Yapılabilir</label>
                                        <br>
                                        <input type='hidden' value='0' name='yorum_durum'>
                                        <input type="checkbox" <?php if ($row['yorum_durum'] == 1) {?>checked<?php }?> id="durumYorum" class="js-switch" data-color="#f62d51" name="yorum_durum" value="1" />
                                    </div> <?php //TODO ekleme var ?>
                                </div>
                                <?php } ?>
                            </div>

                            <div class="row">

                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="basLik">Ürün Adı</label>
                                        <br><br>
                                        <div class="input-group" >

                                            <input type="text" name="baslik" class="form-control" id="basLik" value="<?=$row['baslik']?>" required>


                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="urunKodu">Ürün Kodu <i data-toggle="tooltip" data-placement="top" title="Boş bırakırsanız otomatik oluşturulur" style="cursor: pointer;" class="fa fa-info-circle"></i></label>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" name="urun_kod" class="form-control" id="urunKodu" value="<?=$row['urun_kod']?>" >
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="basLik">Ürün Kategorisi</label>
                                        <br><br>
                                        <div class="input-group" >

                                            <select name="kat_id" required id="urunKat" class="form-control">
                                                <option value="">- Kategori Seçiniz</option>
                                                <?php
                                                $urunkategoriListele = $db->prepare("select * from urun_cat where durum='1' and dil='$_SESSION[dil]' and ust_id='0' order by sira asc");
                                                $urunkategoriListele->execute();
                                                while($kat = $urunkategoriListele->fetch(PDO::FETCH_ASSOC))
                                                {
                                                ?>
                                                    <option value="<?=$kat['id']?>" <?php if ($row['kat_id'] == $kat['id']) { ?>selected<?php }?> ><?=$kat['baslik']?></option>
                                                <?php
                                                $urunAltkat = $db->prepare("select * from urun_cat where durum='1' and dil='$_SESSION[dil]' and ust_id='$kat[id]' order by sira asc");
                                                $urunAltkat->execute();
                                                while($altkat = $urunAltkat->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    ?>
                                                    <option value="<?=$altkat['id']?>"  <?php if ($row['kat_id'] == $altkat['id']) { ?>selected<?php }?> >---- <?=$altkat['baslik']?></option>
                                                <?php }?>
                                                <?php }?>
                                            </select>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="marka">Ürün Markası</label>
                                        <br><br>
                                        <div class="input-group" >

                                            <select name="marka"  id="marka" class="form-control">
                                                <option value="0">Marka Olmasın</option>
                                                <?php
                                                $urunMarkaQuery = $db->prepare("select * from urun_marka where durum='1' order by sira asc ");
                                                $urunMarkaQuery->execute(); //todo ürün marka
                                                ?>
                                                <?php foreach ($urunMarkaQuery as $markaRow) {?>
                                                    <option <?php if($markaRow['baslik'] == $row['marka'] ) { ?>selected<?php }?> value="<?=$markaRow['baslik']?>"><?=$markaRow['baslik']?></option>
                                                <?php }?>
                                            </select>


                                        </div>
                                    </div>
                                </div>






                            </div>




                            <div class="row">

                                <div class="col-md-12 ">
                                    <div class="form-group col-md-12">
                                        <label style="font-weight: 500" for="spotArea"><i class="fa fa-sort"></i> Kısa Açıklama</label><br><br>
                                        <small class="form-control-feedback text-purple" style="font-size:13px"> Lütfen görünüm estetikliği açısından açıklamayı kısa bir şekilde yapınız. </small>
                                        <br><br>
                                        <textarea name="spot" id="spotArea" class="form-control" rows="2"><?=$row['spot']?></textarea>
                                    </div>
                                </div>

                            </div>



                            <div class="row">

                                <div class="col-md-12 ">
                                    <div class="form-group col-md-12">

                                        <label style="font-weight: 500" for="ustKat"><i class="fa fa-photo"></i> Ürün Kapak Görseli</label>
                                        <div style="width: 100%; height: auto; background-color: #F9F9F9; border:1px solid #EBEBEB; padding: 15px; 0 15px 0; text-align: center;  margin-top:8px;">
                                                <img src="../images/product/<?=$row['gorsel']?>" style="width: 200px; ">
                                            <br><br>
                                            <small class="form-control-feedback text-info" style="font-size:13px; font-weight: 400"> İdeal Ebat : 540x555</small>
                                        </div>
                                        <div class="input-group" style="margin-top: 8px">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="gorsel" >
                                                <label class="custom-file-label" for="inputGroupFile04">Seç</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6 ">
                                    <div class="form-group col-md-12">
                                        <label style="font-weight: 500" for="descpAlan">Meta Açıklaması</label><br><br>
                                        <textarea name="meta_desc" id="descpAlan" class="form-control" rows="2"><?=$row['meta_desc']?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group col-md-12">
                                        <label style="font-weight: 500" for="tagsAreas"><i class="fa fa-tags"></i> Etiketler</label><br><br>
                                        <small class="text-purple" style="font-size:13px;">Etiketi yazıp enter'a basın</small>
                                        <div style="width: 100%; height: 9px; overflow: hidden; padding: 0; margin: 0;"></div>

                                        <input type="text"  data-role="tagsinput" placeholder="Etiket Ekle" name="tags" value="<?=$row['tags']?>" />
                                    </div>
                                </div>



                                <div class="col-md-3 ">
                                    <div class="form-group" >
                                        <label style="font-weight: 500" for="basLik">Ürün Kalitesi</label><br><br>
                                        <?php if($uyeayar['durum'] == '1' ) {?>
                                            <small class="text-purple" style="font-size:13px;">Ürün yorumlara kapalı ise aşağıdaki yıldız sayısı görünür <?php //TODO üyelik aktif ise burayı kapatabilirsin ?></small>
                                        <?php }?>
                                        <br><br>
                                        <div class="input-group " style="text-align: center !important;" >

                                            <div class="rating">
                                                <label>
                                                    <input type="radio" name="star_rate" <?php if ($row['star_rate'] == 1) {?> checked <?php }?> value="1" />
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="star_rate" <?php if ($row['star_rate'] == 2) {?> checked <?php }?> value="2" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="star_rate" <?php if ($row['star_rate'] == 3) {?> checked <?php }?> value="3" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="star_rate" <?php if ($row['star_rate'] == 4) {?> checked <?php }?> value="4" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="star_rate" <?php if ($row['star_rate'] == 5) {?> checked <?php }?> value="5" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                            </div>

                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label style="font-weight: 500" for="mymce"><i class="fa fa-list"></i> Ürün Açıklaması (Detaylı)</label><br><br>
                                    <textarea name="icerik" id="mymce"   rows="6" ><?=$row['icerik']?></textarea>
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="tab-pane  p-20" id="diger" role="tabpanel">


                        <div class="row">


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="stokSayisi">Stok Sayısı</label><br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px"> 0 = Stok'ta yok</small>
                                    <br><br>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-shopping-basket"></i></span>
                                        </div>
                                        <input type="number" class="form-control" name="stok" id="stokSayisi" aria-describedby="basic-addon1" value="<?=$row['stok']?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="urunFiyat">Ürün Fiyatı</label><br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px"> Lütfen herhangi bir harf veya noktalama kullanmayın</small>
                                    <br><br>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><?=$odemeayar['simge']?></span>
                                        </div>
                                        <input type="text" value="<?=$row['fiyat']?>" class="form-control" name="fiyat" id="urunFiyat" aria-describedby="basic-addon1" placeholder="Örn : 1000" >
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-5 ">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="urunFiyatEski">Ürünün Eski Fiyatı</label><br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px"> Bu fiyat bilgilendirme amaçlıdır, alışverişlerde değeri yoktur</small>
                                    <br><br>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><?=$odemeayar['simge']?></span>
                                        </div>
                                        <input type="text" value="<?=$row['eski_fiyat']?>" class="form-control" name="eski_fiyat" id="urunFiyatEski" aria-describedby="basic-addon1" placeholder="Örn : 1000" >
                                    </div>
                                </div>
                            </div>

                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-weight: 500;" for="kdvDurum">KDV</label><br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px;"> Seçim sonrası KDV oranını belirtmeyi unutmayınız</small>
                                    <br><br>
                                    <input type='hidden' value='0' name='kdv'>
                                    <input type="checkbox" <?php if ($row['kdv'] == 1) { ?> checked <?php }?> id="kdvDurum" class="js-switch" data-color="#f62d51" name="kdv" value="1" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="kdvOran">KDV Oranı</label><br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">KDV durumu seçili ise bu alanı kullanın</small>
                                    <br><br>
                                    <input type="number" value="<?=$row['kdv_oran']?>" class="form-control" name="kdv_oran" id="kdvOran"placeholder="Örn: 2"  >
                                </div>
                            </div>
                        </div>



                        <?php
                        if($odemeayar['kargo_sistemi'] == 1) {
                        ?>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-weight: 500;" for="kargoDurum"><i class="fa fa-truck"></i> Kargo Durumu (ücretsiz / ücretli)</label><br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px;"> Seçim yapılmaz ise <strong>ücretsiz kargo</strong> ibaresi çıkar</small>
                                    <br><br>
                                    <input type='hidden' value='0' name='kargo'>
                                    <input type="checkbox" <?php if ($row['kargo'] == 1) { ?> checked <?php }?> id="kargoDurum" class="js-switch" data-color="#f62d51" name="kargo" value="1" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="kargoBedeli"><i class="fa fa-truck"></i> Kargo Bedeli</label><br><br>
                                    <small class="form-control-feedback text-purple" style="font-size:13px">Kargo durumu seçili ise bu alanı kullanın</small>
                                    <br><br>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><?=$odemeayar['simge']?></span>
                                        </div>
                                        <input type="number" value="<?=$row['kargo_ucret']?>" class="form-control" name="kargo_ucret" id="kargoBedeli"placeholder="Örn: 12" aria-describedby="basic-addon1"   >
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php }?>


                    </div>
                    <div class="tab-pane p-20" id="ekstra" role="tabpanel">



                        <div class="row">



                            <div class="form-group col-md-12">
                                <label style="font-weight: 500" for="embedKodu"><i class="fa fa-video-camera"></i> Ürün Videosu</label><br><br>
                                <small class="text-purple" style="font-size:13px;">Ürününüzün videosu var ise <strong>embed kodunu</strong> ekleyebilirsiniz. Sunucunuz iframe kodu eklenmesine izin vermiyor ise sorun oluşabilir</small>
                                <br><br>
                                <textarea name="embed"  id="embedKodu" class="form-control" rows="3" ><?=$row['embed']?></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label style="font-weight: 500" for="mymce">Ek Bilgi Alanı</label><br><br>
                                <small class="text-purple" style="font-size:13px;">Bu alanı ürününüzün ebatını veya diğer varyant seçeneklerini belirtmek için kullanabilirsiniz</small>
                                <br><br>
                                <textarea name="ek_bilgi" id="mymce2"   rows="4" ><?=$row['ek_bilgi']?></textarea>
                            </div>

                        </div>







                    </div>




                </div>

                    <div class="form-actions p-l-20">
                        <button type="submit" class="btn btn-success" name="urundegis">
                            <i class="fa fa-refresh fa-spin fa-fw"></i>
                            <span class="sr-only">Yükleniyor...</span> Güncelle
                        </button>
                    </div>

                </form>

            </div>







        </div>
    </div>
</div>

<script id="rendered-js">
    $(':radio').change(function () {
        console.log('New star rating: ' + this.value);
    });
    //# sourceURL=pen.js
</script>
<?php if($_GET['status']=='imgtype'){ ?>
    <body onload="sweetAlert('HATA!', 'Görsel dosyanız jpg, png veya gif türü dışında olamaz', 'warning');">
    </body>
<?php }?>