<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Hakkımızda Sayfası | <?=$ayar['site_baslik']?></title>
<?php
$aboutPage = $db ->prepare("select * from about_page where dil='$_SESSION[dil]'   order by id desc limit 1 ");
$aboutPage ->execute();
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-file-document-box"></i> Hakkımızda Sayfası</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Hakkımızda Sayfası</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">

<div class="col-md-12" >
    <?php if ($aboutPage->rowCount()<=0) {?>
        <a role="button"  href="pages.php?sayfa=hakkimizdaekle" class="btn btn-info m-b-15" style="color:#FFF" ><i class="fa fa-plus-circle"></i> <?=$lang['baslik']?> İçin Ekle</a>
    <?php }?>
        <a role="button"  href="pages.php?sayfa=hakkimizdamodul" class="btn btn-dark m-b-15" style="color:#FFF" ><i class="fa fa-cog"></i> Modül Ayarları</a>
</div>


    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title m-b-25">Hakkımızda Sayfası <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span> </h3>

                <?php if ($aboutPage->rowCount() > 0) {?>

                <h6 class="card-subtitle">Kullandığınız tüm dillere göre ayrı ayrı ekleme yapmak zorundasınız. Düzenleme dilini değiştirmek için <span style="font-weight: 500">sağ en üst </span>köşedeki ikona tıklayabilirsiniz.</h6>

                <div class="table-responsive">
                    <table class="table table-striped">

                        <tbody style="border:1px solid #CCC" >

                        <?php foreach ($aboutPage as $about) { ?>
                        <tr  >

                            <td ><span style="font-weight: 600"><?=$lang['baslik']?></span> - Hakkımızda Sayfası</td>
                            <td style="border-left:1px solid #EBEBEB;" ><span style="font-weight: 600">
                                    <a target="_blank" href="<?=$ayar['site_url']?>kurumsal/<?=$about['seo_url']?>">
                                        <span class="btn btn-success"><i class="fa fa-link"></i> <?=$ayar['site_url']?>kurumsal/<?=$about['seo_url']?></span>
                                    </a>
                            </td>
                            <td class="text-nowrap" style="text-align: right">

                                <a  href="pages.php?sayfa=hakkimizda&sayfa_id=<?=$about['id']?>" class="btn btn-sm btn-info" style="color:#FFF"><i class="fa fa-pencil text-inverse"></i> Düzenle </a>

                                <a  onclick="deletebutton('<?=$about['id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>

                            </td>

                        </tr>
                       <?php }?>

                        </tbody>
                    </table>


                </div>
                <?php } else {?>
                <div class="alert alert-info" style="font-weight: 400">
                    Henüz <span style="font-weight: 600"><?=$lang['baslik']?></span> dilinde hakkımızda sayfası eklenmemiş! Kullandığınız dillere göre özel olarak eklemek için <span style="font-weight: 600">sağ en üst</span> köşedeki dil seçiminizin ardından yukarıdaki ekle butonuna tıklayınız
                </div>
                <?php }?>
            </div>
        </div>
    </div>




</div>




<script type="text/javascript">

    function deletebutton(aboutid){

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
                window.location.href = "support/post/delete/hakkimizda-sil.php?sayfa=success&id="+aboutid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>

<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=hakkimizdasayfa">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=hakkimizdasayfa">
<?php }?>

