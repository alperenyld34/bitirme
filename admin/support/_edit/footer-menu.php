<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Footer Menü Düzenle | <?=$ayar['site_baslik']?></title>
<?php
$footMenuCek = $db ->prepare("select * from footer_menu where id='$_GET[menu_id]' ");
$footMenuCek ->execute();
$foot = $footMenuCek->fetch(PDO::FETCH_ASSOC);
?>
<?php
if($footMenuCek->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=footermenu");
}
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-tag-multiple"></i> Footer Menü Düzenle</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=footermenu">Footer Menü</a></li>
                <li class="breadcrumb-item active">Footer Menü Düzenle</li>
            </ol>
        </div>
    </div>
</div>






<div class="row">
    <div class="col-lg-12">
        <div class="card">






            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/update/footer-menu.php" class="form-horizontal " method="post">

                    <input type="hidden" name="footer_id" value="<?=$foot['id']?>">

                    <h3 class="card-title">Footer Menü Düzenle <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span></h3>
                    <hr>
                    <div class="form-body">




                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="form-group col-md-5">
                                <label style="font-weight: 500" for="menuAd">Menü Adı</label><br><br>
                                <input type="text" class="form-control" name="baslik" required id="menuAd" value="<?=$foot['baslik']?>">
                            </div>

                            <div class="form-group col-md-5">
                                <label style="font-weight: 500" for="menuUrl">URL Adresi (http://www)</label><br><br>
                                <input type="text" class="form-control" name="url"  id="menuUrl" required placeholder=" http://" value="<?=$foot['url']?>">
                            </div>


                            <div class="form-group col-md-2">
                                <label style="font-weight: 500" for="menuSira">Sıra</label><br><br>
                                <input type="number" class="form-control" name="sira" required id="menuSira" value="<?=$foot['sira']?>">
                            </div>

                        </div>

                        <div class="row m-b-20" style="border-bottom:1px solid #EBEBEB">

                            <div class="form-group col-md-12">
                                <label style="font-weight: 500" for="ustKat">Menü Alanı</label><br><br>
                                <select name="yer" id="ustKat" class="form-control">
                                    <option value="0" <?php if ($foot['yer'] == 0) {?> selected <?php }?>>Kurumsal</option>
                                    <option value="1" <?php if ($foot['yer'] == 1) {?> selected <?php }?>>Bağlantılar</option>
                                </select>
                            </div>

                        </div>



                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">


                            <div class="form-group col-md-2">
                                <label class="control-label" for="yayin" style="margin-bottom: 13px; font-weight: 600">Yayın Durumu</label>
                                <br>
                                <input type='hidden' value='0' name='durum'>
                                <input type="checkbox" <?php if ($foot['durum'] == 1) {?> checked <?php }?> id="yayin" class="js-switch" data-color="#f62d51" name="durum" value="1" />
                            </div>



                        </div>





                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="footermenudegis">
                            <i class="fa fa-refresh fa-spin fa-fw"></i>
                            <span class="sr-only">Yükleniyor...</span> Güncelle
                        </button>
                    </div>

                </form>

            </div>





        </div>
    </div>
</div>

