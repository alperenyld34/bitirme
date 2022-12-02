<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$veriCek = $db->prepare("select * from htmlsayfa where id='$_GET[sayfa_id]'");
$veriCek->execute();
$row = $veriCek->fetch(PDO::FETCH_ASSOC);
?>
<?php
if($veriCek->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=sayfalar");
}
?>

    <title>HTML Sayfa Düzenle | <?=$ayar['site_baslik']?></title>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor"><i class="ti-files"></i> HTML Sayfa Düzenle</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                    <li class="breadcrumb-item"><a href="pages.php?sayfa=sayfalar">HTML Sayfalar</a></li>
                    <li class="breadcrumb-item active">HTML Sayfa Düzenle</li>
                </ol>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">




                <div class="card-body" style="font-family: 'Open Sans', Arial; padding: 0.25em;">

                    <div class="card-body p-b-0">
                        <h3 class="card-title">HTML Sayfa Düzenle <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span></h3>

                        <hr>

                        <!-- Nav tabs -->

                        <!-- Tab panes -->
                        <form action="support/post/update/sayfa-duzenle.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="sayfa_id" value="<?=$row['id']?>">

                            <div class="tab-content">
                                <div class="tab-pane active" id="genel" role="tabpanel">
                                    <div>



                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label" for="yayin" style="margin-bottom: 13px; font-weight: 600">Durum</label>
                                                    <br>
                                                    <input type='hidden' value='0' name='durum'>
                                                    <input type="checkbox" <?php if ($row['durum'] == 1) { ?>checked<?php }?> id="yayin" class="js-switch" data-color="#f62d51" name="durum" value="1" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-7 ">
                                                <div class="form-group">
                                                    <label style="font-weight: 500" for="basLik">Sayfa Başlığı</label>
                                                    <br><br>
                                                    <div class="input-group" >
                                                        <input type="text" name="baslik" class="form-control" id="basLik" required value="<?=$row['baslik']?>" >
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label style="font-weight: 500" for="seoURL">SEO URL</label>
                                                    <br><br>
                                                    <div class="input-group" >
                                                        <input type="text" name="seo_url" class="form-control" id="seoURL" required placeholder="Örn : deneme-sayfa-adi" value="<?=$row['seo_url']?>">
                                                    </div>
                                                </div>
                                            </div>


                                        </div>


                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label style="font-weight: 500" for="mymce"><i class="fa fa-list"></i> Sayfa İçeriği </label><br><br>
                                                <textarea name="icerik" id="mymce"   rows="6" ><?=$row['icerik']?></textarea>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label style="font-weight: 500" for="descpAlan">Meta Açıklaması</label><br><br>
                                                <textarea name="meta_desc" id="descpAlan" class="form-control" rows="2"><?=$row['meta_desc']?></textarea>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label style="font-weight: 500" for="tagsAreas">Etiketler</label><br><br>
                                                <input type="text"  data-role="tagsinput" placeholder="Etiket Ekle" name="tags" value="<?=$row['tags']?>" />
                                            </div>
                                        </div>



                                    </div>
                                </div>


                            </div>
                    </div>

                    <div class="form-actions p-l-20 p-b-20">
                        <button type="submit" class="btn btn-success" name="sayfadegis">
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