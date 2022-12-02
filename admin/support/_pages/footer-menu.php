<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Footer Menu | <?=$ayar['site_baslik']?></title>
<?php
$footerMenuList = $db ->prepare("select * from footer_menu where dil='$_SESSION[dil]' order by sira asc ");
$footerMenuList ->execute();

$kurumsalListe = $db ->prepare("select * from footer_menu where dil='$_SESSION[dil]' and yer='0' order by sira asc ");
$kurumsalListe ->execute();

$baglantiListe = $db ->prepare("select * from footer_menu where dil='$_SESSION[dil]' and yer='1' order by sira asc ");
$baglantiListe ->execute();
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-tag-multiple"></i> Footer Menu</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Footer Menu</li>
            </ol>
        </div>
    </div>
</div>

<form action="support/post/multi-delete/footer-menuleri-sil.php" method="post">
<div class="row">

    <div class="col-md-12" >

        <a role="button"  href="pages.php?sayfa=footermenuekle" class="btn btn-info m-b-15" style="color:#FFF" ><i class="fa fa-plus-circle"></i> Yeni Ekle</a>


        <a role="button"  class="btn btn-dark m-b-15" href="pages.php?sayfa=footermenuayar" style="color:#FFF"><i class="fa fa-cog"></i> Modül Ayarları</a>



        <button type="submit"  class="btn btn-danger m-b-15" style="color:#FFF"><i class="fa fa-trash"></i> Seçilenleri Sil</button>

    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body bg-secondary" >

                <h3 class="card-title m-b-25">Footer Menü Listesi <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span> </h3>
                <h6 class="card-subtitle">Footer menü alanına dilediğiniz kadar menü ekleyebilirsiniz</h6>

            </div>

        </div>
    </div>


    <div class="col-12" >
        <div class="card"style="">
            <div class="card-body" style="padding: 15px !important;">


                <?php if ($footerMenuList->rowCount() > 0) {?>


                <div class="table-responsive"  >
                    <table class="table table-bordered " style="font-family: 'Open Sans', Arial; margin-bottom: 0 !important;" >
                        <thead>
                        <tr>
                            <th width="1%" style="border-top: 0 !important; border-bottom: 0 !important; border-left:0 !important;">

                                <div class="form-checkbox" style="overflow: hidden; height: 24px;">
                                    <input type="checkbox" class="selectall" id="hepsiniSecCheckBox" />
                                    <label for="hepsiniSecCheckBox"></label>
                                </div>

                            </th>
                            <th style="text-align: center; border-top: 0 !important; border-bottom: 0 !important;" width="80">SIRA</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important;">MENU ADI</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important;">URL</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center">YER</th>
                            <th style="text-align: center; border-top: 0 !important; border-bottom: 0 !important;">DURUM</th>
                            <th class="text-nowrap" width="180" style="text-align: center; border-top: 0 !important; border-bottom: 0 !important; border-right: 0 !important;">#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($kurumsalListe as $menu) {
                            $menuUrl = $menu['url'];
                        ?>
                        <tr>
                            <td style="border-left:0 !important;">
                                <div class="form-checkbox">
                                <input type="checkbox" name='sil[]' id="checkSec-<?=$menu['id']?>" value="<?=$menu['id']?>" class="individual">
                                <label for="checkSec-<?=$menu['id']?>"></label>
                                </div>
                            </td>

                            <td style="text-align: center"><span class="btn btn-sm btn-dark"><?=$menu['sira']?></span></td>

                            <td style="font-weight: 400">
                                <?=$menu['baslik']?>
                            </td>

                            <td style="font-weight: 500; font-size:13px">

                                <?php if ($menu['url'] == !null) { ?>


                                    <a href="<?=$menu['url']?>" target="_blank" class="text-dark"><i class="fa fa-external-link"></i>

                                        <?php
                                        $menuUrl = strip_tags($menuUrl);
                                        if (strlen($menuUrl) > 55) {

                                            $stringCut = substr($menuUrl, 0, 55);
                                            $endPoint = strrpos($stringCut, ' ');

                                            $menuUrl = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $menuUrl .= '...';
                                        }
                                        echo $menuUrl;
                                        ?>

                                    </a>

                                 <?php }?>

                            </td>

                            <td style="text-align: center">
                                 <?php
                                if($menu['yer'] == 0) {
                                    ?>
                                    <span class="btn btn-purple btn-sm text-secondary">KURUMSAL</span>
                                <?php } ?>
                            </td>

                            <td style="text-align: center">
                                <?php
                                if($menu['durum'] == 1) {
                                    ?>
                                    <span class="btn btn-success btn-sm"><i class="fa fa-check"></i> Aktif</span>
                                <?php } ?>
                                <?php
                                if($menu['durum'] == 0) {
                                    ?>
                                    <span class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Pasif</span>
                                <?php } ?>
                            </td>

                            <td class="text-nowrap" style="text-align: center; border-right: 0 !important;">
                                <a  href="pages.php?sayfa=footmenu&menu_id=<?=$menu['id']?>" class="btn btn-sm btn-info" style="color:#FFF"><i class="fa fa-pencil text-inverse"></i> Düzenle </a>
                                <a  onclick="deletebutton('<?=$menu['id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>
                            </td>

                        </tr>


                       <?php }?>

                        <?php foreach ($baglantiListe as $bag) {
                            $bagURL = $bag['url'];
                            ?>
                            <tr style="background-color: #fafafa">
                                <td style="border-left:0 !important;">
                                    <div class="form-checkbox">
                                        <input type="checkbox" name='sil[]' id="checkSec-<?=$bag['id']?>" value="<?=$bag['id']?>" class="individual">
                                        <label for="checkSec-<?=$bag['id']?>"></label>
                                    </div>
                                </td>

                                <td style="text-align: center"><span class="btn btn-sm btn-primary"><?=$bag['sira']?></span></td>

                                <td style="font-weight: 400">
                                    <?=$bag['baslik']?>
                                </td>

                                <td style="font-weight: 500;  font-size:13px">

                                    <?php if ($bag['url'] == !null) { ?>


                                        <a href="<?=$bag['url']?>" target="_blank"><i class="fa fa-external-link"></i>

                                            <?php
                                            $bagURL = strip_tags($bagURL);
                                            if (strlen($bagURL) > 55) {

                                                $stringCut = substr($bagURL, 0, 55);
                                                $endPoint = strrpos($stringCut, ' ');

                                                $bagURL = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                $bagURL .= '...';
                                            }
                                            echo $bagURL;
                                            ?>

                                        </a>

                                    <?php }?>

                                </td>

                                <td style="text-align: center">
                                    <?php
                                    if($bag['yer'] == 1) {
                                        ?>
                                        <span class="btn btn-primary btn-sm text-secondary">BAĞLANTILAR</span>
                                    <?php } ?>
                                </td>

                                <td style="text-align: center">
                                    <?php
                                    if($bag['durum'] == 1) {
                                        ?>
                                        <span class="btn btn-success btn-sm"><i class="fa fa-check"></i> Aktif</span>
                                    <?php } ?>
                                    <?php
                                    if($bag['durum'] == 0) {
                                        ?>
                                        <span class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Pasif</span>
                                    <?php } ?>
                                </td>

                                <td class="text-nowrap" style="text-align: center; border-right: 0 !important;">
                                    <a  href="pages.php?sayfa=footmenu&menu_id=<?=$bag['id']?>" class="btn btn-sm btn-info" style="color:#FFF"><i class="fa fa-pencil text-inverse"></i> Düzenle </a>
                                    <a  onclick="deletebutton('<?=$bag['id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>
                                </td>

                            </tr>


                        <?php }?>

                        </tbody>
                    </table>


                </div>
                <?php } else {?>
                <div class="alert alert-info" style="font-weight: 400">
                    Henüz Footer Menu Eklenmemiş!
                </div>
                <?php }?>
            </div>
        </div>
    </div>




</div>
</form>




<script type="text/javascript">

    function deletebutton(menuid){

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
                window.location.href = "support/post/delete/footer-menu-sil.php?menusil=success&id="+menuid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>

<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=footermenu">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=footermenu">
<?php }?>
<?php if($_GET['status']=='nocheck'){ ?>
    <body onload="sweetAlert('Sorun Var!', 'Hiç seçim yapılmamış!', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=footermenu">
<?php }?>
