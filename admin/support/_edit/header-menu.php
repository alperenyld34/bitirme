<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Header Menü Düzenle | <?=$ayar['site_baslik']?></title>
<?php
$menuCek = $db ->prepare("select * from header_menu where id='$_GET[menu_id]' ");
$menuCek ->execute();
$menu = $menuCek->fetch(PDO::FETCH_ASSOC);

$headMenuCount = $db ->prepare("select * from header_menu where dil='$_SESSION[dil]' and ust_id='0' order by sira asc ");
$headMenuCount ->execute();
?>
<?php
if($menuCek->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=headermenu");
}
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="ti-menu"></i> Header Menü Düzenle</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=headermenu">Header Menü</a></li>
                <li class="breadcrumb-item active">Header Menü Düzenle</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">






            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/update/header-menu.php" class="form-horizontal " method="post">

                    <input type="hidden" name="header_id" value="<?=$menu['id']?>">

                    <h3 class="card-title">Header Menü Düzenle <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span></h3>
                    <hr>
                    <div class="form-body">




                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="form-group col-md-5">
                                <label style="font-weight: 500" for="menuAd">Menü Adı</label><br><br>
                                <input type="text" class="form-control" name="baslik" required id="menuAd" value="<?=$menu['baslik']?>">
                            </div>

                            <div class="form-group col-md-5">
                                <label style="font-weight: 500" for="menuUrl">URL Adresi (http://www)</label><br><br>
                                <input type="text" class="form-control" name="url"  id="menuUrl" placeholder=" Alt Kategorisi olacak ise boş bırakınız" value="<?=$menu['url']?>">
                            </div>


                            <div class="form-group col-md-2">
                                <label style="font-weight: 500" for="menuSira">Sıra</label><br><br>
                                <input type="number" class="form-control" name="sira" required id="menuSira" value="<?=$menu['sira']?>">
                            </div>

                        </div>

                        <div class="row m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="form-group col-md-12">
                                <label style="font-weight: 500" for="ustKat">Üst Kategori Seçimi</label><br><br>
                                <select name="ust_id" id="ustKat" class="form-control">
                                    <option value="0" <?php if ($menu['ust_id'] == 0) {?> selected <?php }?>>Ana Kategori</option>
                                    <?php foreach ($headMenuCount as $menu_ust) {?>
                                    <option value="<?=$menu_ust['id']?>" <?php if ($menu['ust_id'] == $menu_ust['id']) {?> selected <?php }?> ><?=$menu_ust['baslik']?></option>
                                        <?php
                                        $altkatmenu = $db->prepare("select * from header_menu where ust_id='$menu_ust[id]' order by sira asc");
                                        $altkatmenu->execute();

                                        foreach ($altkatmenu as $altmenu) {?>
                                            <option value="<?=$altmenu['id']?>" <?php if ($menu['ust_id'] == $altmenu['id']) {?> selected <?php }?>>--- <?=$altmenu['baslik']?></option>
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
                                <input type="checkbox"  id="mega" class="js-switch" <?php if($menu['mega_durum'] == 1){?>checked<?php }?> data-color="#f62d51" name="mega_durum" value="1" />
                            </div>

                            <div class="form-group col-md-2">
                                <label class="control-label" for="yayin" style="margin-bottom: 13px; font-weight: 600">Yayın Durumu</label>
                                <br>
                                <input type='hidden' value='0' name='durum'>
                                <input type="checkbox"  id="yayin" class="js-switch"  <?php if($menu['durum'] == 1){?>checked<?php }?> data-color="#f62d51" name="durum" value="1" />
                            </div>



                        </div>





                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="headermenudegis">
                            <i class="fa fa-refresh fa-spin fa-fw"></i>
                            <span class="sr-only">Yükleniyor...</span> Güncelle
                        </button>
                    </div>

                </form>

            </div>





        </div>
    </div>
</div>

