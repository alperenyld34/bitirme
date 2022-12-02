<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Ticaret Bilgi Kutuları | <?=$ayar['site_baslik']?></title>
<?php
$ticaretbilgikutular = $db ->prepare("select * from ticaret_bilgi where dil='$_SESSION[dil]'  order by sira asc limit 11 ");
$ticaretbilgikutular ->execute();
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-tab"></i> Ticaret Bilgi Kutuları</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Ticaret Ayarları</a></li>
                <li class="breadcrumb-item active">Ticaret Bilgi Kutuları</li>
            </ol>
        </div>
    </div>
</div>

<form action="support/post/multi-delete/kutulari-sil.php" method="post">
<div class="row">

    <div class="col-md-12" >

        <?php if ($ticaretbilgikutular->rowCount() < 4 ) {?>
        <a role="button"   alt="default" data-toggle="modal" data-target="#yeniekle" class="btn btn-info m-b-15" style="color:#FFF" ><i class="fa fa-plus-circle"></i> Yeni Ekle</a>
        <?php }?>


        <a role="button"  class="btn btn-dark m-b-15" alt="default" data-toggle="modal" data-target="#kutuayar" style="color:#FFF"><i class="fa fa-cog"></i> Ayarlar</a>



        <button type="submit"  class="btn btn-danger m-b-15" style="color:#FFF"><i class="fa fa-trash"></i> Seçilenleri Sil</button>




    </div>



    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title m-b-25">Bilgi Kutuları <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span> </h3>

                <?php if ($ticaretbilgikutular->rowCount() > 0) {?>

                <h6 class="card-subtitle">En fazla 4 adet eklenebilir. Hangi sayfalarda görünmesini belirlemek için <strong>ayarlar</strong> alanını kullanın</h6>
                <?php if ($ticaretbilgikutular->rowCount() >= 4 ) {?>
                <div class="alert alert-sm alert-danger" style="margin-top: 20px; margin-bottom: 30px; font-weight: 400"><i class="fa fa-exclamation-circle"></i> Maximum ekleme sayısına (4) ulaşılmış! Eğer yeni eklemek istiyorsanız mevcutlardan silmeniz gerekmektedir.</div>
                <?php }?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th width="1%">

                                <div class="form-checkbox" style="overflow: hidden; height: 24px;">
                                    <input type="checkbox" class="selectall" id="hepsiniSecCheckBox" />
                                    <label for="hepsiniSecCheckBox"></label>
                                </div>

                            </th>
                            <th style="text-align: center">SIRA</th>
                            <th>YAZI</th>
                            <th style="text-align: center">ICON</th>
                            <th class="text-nowrap" style="text-align: right">#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($ticaretbilgikutular as $kutu) { ?>
                        <tr>
                            <td>

                                <div class="form-checkbox">
                                <input type="checkbox" name='sil[]' id="checkSec-<?=$kutu['id']?>" value="<?=$kutu['id']?>" class="individual">
                                <label for="checkSec-<?=$kutu['id']?>"></label>


                                </div>

                            </td>
                            <td style="text-align: center"><span class="btn btn-sm btn-dark"><?=$kutu['sira']?></span></td>
                            <td><?=$kutu['baslik']?></td>
                            <td style="text-align: center">
                                <i class="fa <?=$kutu['icon']?>" style="font-size:24px"></i>
                            </td>


                            <td class="text-nowrap" style="text-align: right">

                                <a  href="pages.php?sayfa=kutu&kutu_id=<?=$kutu['id']?>" class="btn btn-sm btn-info" style="color:#FFF"><i class="fa fa-pencil text-inverse"></i> Düzenle </a>

                                <a  onclick="deletebutton('<?=$kutu['id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>

                            </td>



                        </tr>
                       <?php }?>

                        </tbody>
                    </table>


                </div>
                <?php } else {?>
                <div class="alert alert-info" style="font-weight: 400">
                    Henüz bilgi kutusu eklenmemiş! Yeni eklemek için üstteki butonu kullanabilirsiniz.
                </div>
                <?php }?>
            </div>
        </div>
    </div>




</div>
</form>

<!-- AYAR MODAL-->
<div id="kutuayar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <form method="post" action="support/post/update/ticaret-kutu-ayar.php">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bilgi Kutuları Ayarları</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
               <span style="font-weight: 500">Görüntülenecek Sayfalar</span>
                <hr>

        <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-weight: 500" for="boxHome">Anasayfa'da Göster</label><br><br>

                        <div class="input-group mb-3">

                            <input type='hidden' value='0' name='ticaret_text_home'>
                            <input type="checkbox" <?php if($ayar['ticaret_text_home'] == 1){?>checked<?php }?> id="boxHome" class="js-switch" data-color="#f62d51" name="ticaret_text_home" value="1" />

                        </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-weight: 500" for="boxProduct">Ürün Detaylarında</label><br><br>

                        <div class="input-group mb-3">

                            <input type='hidden' value='0' name='ticaret_text_urun'>
                            <input type="checkbox" <?php if($ayar['ticaret_text_urun'] == 1){?>checked<?php }?> id="boxProduct" class="js-switch" data-color="#f62d51" name="ticaret_text_urun" value="1" />

                        </div>

                    </div>
                </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label style="font-weight: 500" for="boxCart">Sepet Sayfasında</label><br><br>

                    <div class="input-group mb-3">

                        <input type='hidden' value='0' name='ticaret_text_sepet'>
                        <input type="checkbox" <?php if($ayar['ticaret_text_sepet'] == 1){?>checked<?php }?> id="boxCart" class="js-switch" data-color="#f62d51" name="ticaret_text_sepet" value="1" />

                    </div>

                </div>
            </div>



        </div>

                <hr>
                <span style="font-weight: 500">Tema Ayarları</span>
                <hr>


                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="bgColors" style="margin-bottom: 13px; font-weight: 600">Kutuların Arkaplan Rengi</label>
                            <br>

                            <input class="jscolor form-control" value="<?=$ayar['ticaret_text_back']?>" id="bgColors" name="ticaret_text_back">

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="bgBorders" style="margin-bottom: 13px; font-weight: 600">Kutuların Border Rengi</label>
                            <br>

                            <input class="jscolor form-control" value="<?=$ayar['ticaret_text_border']?>" id="bgBorders" name="ticaret_text_border">

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="bgTextColors" style="margin-bottom: 13px; font-weight: 600">Kutu Yazı Rengi</label>
                            <br>

                            <input class="jscolor form-control" value="<?=$ayar['ticaret_text_color']?>" id="bgTextColors" name="ticaret_text_color">

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="bgIconsColors" style="margin-bottom: 13px; font-weight: 600">Kutu Icon Rengi</label>
                            <br>

                            <input class="jscolor form-control" value="<?=$ayar['ticaret_text_icon']?>" id="bgIconsColors" name="ticaret_text_icon" style="z-index: 999999">

                        </div>
                    </div>



                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">İptal</button>
                <button type="submit" name="kutuayardegis" class="btn btn-info waves-effect waves-light">
                    <i class="fa fa-refresh fa-spin fa-fw"></i>
                    <span class="sr-only">Yükleniyor...</span>Güncelle

                </button>
            </div>
        </div>
    </div>
    </form>
</div>
<!-- /.AYAR MODAL -->


<?php if ($ticaretbilgikutular->rowCount() < 4) {?>
<!-- YENİ EKLE MODAL-->
<div id="yeniekle" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <form method="post" action="support/post/insert/ticaret-kutu-ekle.php">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Yeni Kutu Ekle</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>



                <div class="modal-body">

                    <div class="row">

                    <div class="form-group col-md-12">
                        <label for="baslikKutu" class="control-label">KUTU YAZISI :</label>
                        <input type="text" class="form-control" id="baslikKutu" name="baslik" required  >
                    </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-md-6">

                            <label for="icons" class="control-label">ICON :</label>

                            <select class="form-control awesome-select" name="icon" id="icons">
                                <?php include 'support/panel_parts/icon.php'?>
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="siraKutu" class="control-label">SIRA :</label>
                            <input type="number" class="form-control" id="siraKutu" name="sira" required value="<?=$ticaretbilgikutular->rowCount()+1?>" >
                        </div>

                    </div>

                    <input type="hidden"  name="dil" value="<?=$_SESSION['dil']?>" >

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">İptal</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light" name="kutukaydet"><i class="fa fa-save"></i> Kaydet</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.YENİ EKLE MODAL -->
<?php }?>



<script type="text/javascript">

    function deletebutton(kutuid){

        swal({
            title: "Silmek İstediğinize Emin Misiniz?",
            text: "Seçtiğiniz içerik kalıcı olarak silinecektir",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sil",
            cancelButtonText: "İptal",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {
                window.location.href = "support/post/delete/kutu-sil.php?kutusil=success&id="+kutuid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>

<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=bilgikutulari">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=bilgikutulari">
<?php }?>
<?php if($_GET['status']=='nocheck'){ ?>
    <body onload="sweetAlert('Sorun Var!', 'Hiç seçim yapılmamış!', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=bilgikutulari">
<?php }?>
