<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Yeni Header Menü Ekle | <?=$ayar['site_baslik']?></title>
<?php
$headMenuCount = $db ->prepare("select * from header_menu where dil='$_SESSION[dil]' and ust_id='0' and durum='1' order by sira asc ");
$headMenuCount ->execute();
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="ti-menu"></i> Yeni Header Menü Ekle</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=headermenu">Header Menü</a></li>
                <li class="breadcrumb-item active">Yeni Header Menü Ekle</li>
            </ol>
        </div>
    </div>
</div>




    <a role="button"  alt="default" data-toggle="modal" data-target="#linklistesi" class="btn btn-purple m-b-15" style="color:#FFF" ><i class="fa fa-link"></i> Modül Link Listesi</a>

<!-- LİNK LİSTE MODAL-->
<div id="linklistesi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Site Modüllerinin Link Listesi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-header text-center" style="background-color: #F8F8F8; font-family: 'Open Sans', Arial; font-weight: 400">
                   Yeni menü eklerken aşağıdaki sayfalardan birini ekleyecekseniz eğer linki kopyalayın ve yeni ekleme alanındaki URL alanına yapıştırın.
                </div>


                <div class="modal-body">

                    <div class="row" >

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>Ürünler :</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>urunler</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>Projeler :</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>projeler</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>Hizmetler :</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>hizmetler</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>Markalar :</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>markalar</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>Blog :</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>blog</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>Foto Galeri :</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>foto-galeri</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>Video Galeri :</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>video-galeri</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>İletişim :</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>iletisim</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>Sepet :</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>sepet</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>Belgeler :</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>belgeler</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>İnsan Kaynakları :</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>insan-kaynaklari</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>Ekibimiz :</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>ekibimiz</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>Pricing Table :</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>paketler</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>Özellik Modulü :</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>ozellikler</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>E-Katalog :</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>e-katalog</span>
                            </span>
                        </div>


                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>Hesap Numaraları:</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>hesap-numaralarimiz</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>Beceriler:</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>uzmanliklarimiz</span>
                            </span>
                        </div>

                        <div class="form-group col-md-12" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 400;">
                            <span style="background-color: #F8F8F8; border:1px solid #EBEBEB; padding: 5px 10px 5px 10px">
                            <strong>Sık Sorulanlar:</strong><span class="text-primary"> <i class="fa fa-external-link" style="margin-left: 10px;"></i> <?=$ayar['site_url']?>sss</span>
                            </span>
                        </div>


                </div>


              </div>




                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
</div>
<!-- LİNK LİSTE MODAL-->



<div class="row">
    <div class="col-lg-12">
        <div class="card">






            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/insert/header-menu-ekle.php" class="form-horizontal " method="post">

                    <input type="hidden" name="dil" value="<?=$_SESSION['dil']?>">

                    <h3 class="card-title">Yeni Header Menü Ekle <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span></h3>
                    <hr>
                    <div class="form-body">




                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="form-group col-md-5">
                                <label style="font-weight: 500" for="menuAd">Menü Adı</label><br><br>
                                <input type="text" class="form-control" name="baslik" required id="menuAd">
                            </div>

                            <div class="form-group col-md-5">
                                <label style="font-weight: 500" for="menuUrl">URL Adresi (http://www)</label><br><br>
                                <input type="text" class="form-control" name="url"  id="menuUrl" placeholder=" Alt Kategorisi olacak ise boş bırakınız">
                            </div>


                            <div class="form-group col-md-2">
                                <label style="font-weight: 500" for="menuSira">Sıra</label><br><br>
                                <input type="number" class="form-control" name="sira" required id="menuSira" value="<?=$headMenuCount->rowCount()+1?>" required min=1 oninput="validity.valid||(value='');">
                            </div>

                        </div>

                        <div class="row m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="form-group col-md-12">
                                <label style="font-weight: 500" for="ustKat">Üst Kategori Seçimi</label><br><br>
                                <select name="ust_id" id="ustKat" class="form-control">
                                    <option value="0">Ana Kategori</option>
                                    <?php foreach ($headMenuCount as $menu) {?>
                                    <option value="<?=$menu['id']?>"><?=$menu['baslik']?></option>
                                        <?php
                                        $altkatmenu = $db->prepare("select * from header_menu where ust_id='$menu[id]' order by sira asc");
                                        $altkatmenu->execute();

                                        foreach ($altkatmenu as $altmenu) {?>
                                            <option value="<?=$altmenu['id']?>">--- <?=$altmenu['baslik']?></option>
                                        <?php }?>
                                    <?php }?>
                                </select>
                            </div>




                        </div>

                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="form-group col-md-8">
                                <label class="control-label" for="mega" style="margin-bottom: 13px; font-weight: 600">Mega Menü</label>
                                <br>
                                <small class="form-control-feedback text-danger" style="font-size:13px">
                                    Mega menü sadece ürünler modülüne ait bir açılır menü sistemidir. Bu nedenle ürünler harici menüleriniz için pasifleştiriniz.
                                    <br>
                                    Ayrıca sadece "Ana Kategori"lerde çalışır.
                                </small>
                                <br><br>
                                <input type='hidden' value='0' name='mega_durum'>
                                <input type="checkbox"  id="mega" class="js-switch" data-color="#f62d51" name="mega_durum" value="1" />
                            </div>

                            <div class="form-group col-md-2">
                                <label class="control-label" for="yayin" style="margin-bottom: 13px; font-weight: 600">Yayın Durumu</label>
                                <br>
                                <input type='hidden' value='0' name='durum'>
                                <input type="checkbox" checked id="yayin" class="js-switch" data-color="#f62d51" name="durum" value="1" />
                            </div>



                        </div>





                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="headermenuekle">
                            <i class="fa fa-save"></i>
                            Kaydet
                        </button>
                    </div>

                </form>

            </div>





        </div>
    </div>
</div>

