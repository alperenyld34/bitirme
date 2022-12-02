<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Header Menu | <?=$ayar['site_baslik']?></title>
<?php
$headerMenuList = $db ->prepare("select * from header_menu where dil='$_SESSION[dil]' and ust_id='0' order by sira asc ");
$headerMenuList ->execute();
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-menu"></i> Header Menu</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Header Menu</li>
            </ol>
        </div>
    </div>
</div>

<form action="support/post/multi-delete/header-menuleri-sil.php" method="post">
<div class="row">

    <div class="col-md-12" >

        <a role="button"  href="pages.php?sayfa=headermenuekle" class="btn btn-info m-b-15" style="color:#FFF" ><i class="fa fa-plus-circle"></i> Yeni Ekle</a>


        <a role="button"  class="btn btn-dark m-b-15" href="pages.php?sayfa=headermenuayar" style="color:#FFF"><i class="fa fa-cog"></i> Modül Ayarları</a>



        <button type="submit"  class="btn btn-danger m-b-15" style="color:#FFF"><i class="fa fa-trash"></i> Seçilenleri Sil</button>

    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body bg-secondary" >

                <h3 class="card-title m-b-25">Header Menü Listesi <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span> </h3>
                <h6 class="card-subtitle">Header alanına dilediğiniz gibi menü ekleyebilirsiniz</h6>

            </div>

        </div>
    </div>


    <div class="col-12" >
        <div class="card"style="">
            <div class="card-body" style="padding: 15px !important;">


                <?php if ($headerMenuList->rowCount() > 0) {?>


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
                            <th style="text-align: center; border-top: 0 !important; border-bottom: 0 !important;">DURUM</th>
                            <th class="text-nowrap" width="180" style="text-align: center; border-top: 0 !important; border-bottom: 0 !important; border-right: 0 !important;">#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($headerMenuList as $menu) {
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
                                <?php
                                if($menu['mega_durum'] == 1) {
                                ?>
                                <span class="badge badge-danger" style="margin-left: 10px;">MEGA MENU</span>
                                <?php }?>
                            </td>

                            <td style="font-weight: 500">

                                <?php if ($menu['url'] == !null) { ?>


                                    <a href="<?=$menu['url']?>" target="_blank"><i class="fa fa-external-link"></i>

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
                                <a  href="pages.php?sayfa=headmenu&menu_id=<?=$menu['id']?>" class="btn btn-sm btn-info" style="color:#FFF"><i class="fa fa-pencil text-inverse"></i> Düzenle </a>
                                <a  onclick="deletebutton('<?=$menu['id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>
                            </td>

                        </tr>
                            <?php
                            $AltMenuCek = $db->prepare("select * from header_menu where ust_id='$menu[id]' and dil='$_SESSION[dil]' order by sira asc");
                            $AltMenuCek->execute();
                            ?>
                                <?php foreach ($AltMenuCek as $altmenu) {
                                $urlAltmenu=$altmenu['url'];
                                    ?>
                                <tr style="background-color: #fafafa; ">
                                    <td style=" border-left:0 !important;">
                                        <div class="form-checkbox">
                                            <input type="checkbox" name='sil[]' id="checkSec-<?=$altmenu['id']?>" value="<?=$altmenu['id']?>" class="individual">
                                            <label for="checkSec-<?=$altmenu['id']?>"></label>
                                        </div>
                                    </td>

                                    <td style="text-align: center"><span class="btn btn-sm btn-primary" style="font-style: italic; margin-left: 15px;"><?=$altmenu['sira']?></span></td>

                                    <td style="font-weight: 400; font-size:13px;"><i class="fa fa-caret-right" style="margin-left: 15px;"></i> <?=$altmenu['baslik']?></td>

                                    <td style="font-weight: 500">

                                        <?php if ($altmenu['url'] == !null) { ?>

                                            <a href="<?=$altmenu['url']?>" target="_blank" class="text-dark" style="font-size:13px;"><i class="fa fa-external-link"></i>

                                                <?php
                                                $urlAltmenu = strip_tags($urlAltmenu);
                                                if (strlen($urlAltmenu) > 55) {

                                                    $stringCut = substr($urlAltmenu, 0, 55);
                                                    $endPoint = strrpos($stringCut, ' ');

                                                    $urlAltmenu = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                    $urlAltmenu .= '...';
                                                }
                                                echo $urlAltmenu;
                                                ?>

                                            </a>

                                        <?php }?>

                                    </td>

                                    <td style="text-align: center; ">
                                        <?php
                                        if($altmenu['durum'] == 1) {
                                            ?>
                                            <span class="btn btn-success btn-sm"><i class="fa fa-check"></i> Aktif</span>
                                        <?php } ?>
                                        <?php
                                        if($altmenu['durum'] == 0) {
                                            ?>
                                            <span class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Pasif</span>
                                        <?php } ?>
                                    </td>

                                    <td class="text-nowrap" style="text-align: center; border-right: 0 !important; ">
                                        <a  href="pages.php?sayfa=headmenu&menu_id=<?=$altmenu['id']?>" class="btn btn-sm btn-info" style="color:#FFF"><i class="fa fa-pencil text-inverse"></i> Düzenle </a>
                                        <a  onclick="deletebutton('<?=$altmenu['id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>
                                    </td>

                                </tr>

                                <?php
                                $AltAltMenuCek = $db->prepare("select * from header_menu where ust_id='$altmenu[id]' and dil='$_SESSION[dil]' order by sira asc");
                                $AltAltMenuCek->execute();
                                ?>
                                <?php foreach ($AltAltMenuCek as $altmenu2) {
                                    $UrlAltAltMenu=$altmenu2['url'];
                                    ?>
                                    <tr style="background-color: #f1f1f1; ">
                                        <td style=" border-left:0 !important;">
                                            <div class="form-checkbox">
                                                <input type="checkbox" name='sil[]' id="checkSec-<?=$altmenu2['id']?>" value="<?=$altmenu2['id']?>" class="individual">
                                                <label for="checkSec-<?=$altmenu2['id']?>"></label>
                                            </div>
                                        </td>

                                        <td style="text-align: center"><span class="btn btn-sm btn-info" style="font-style: italic; margin-left: 30px;"><?=$altmenu2['sira']?></span></td>

                                        <td style="font-weight: 400; font-size:13px;"><i class="fa fa-long-arrow-right" style="margin-left: 30px;"></i> <?=$altmenu2['baslik']?></td>

                                        <td style="font-weight: 500">

                                            <?php if ($altmenu2['url'] == !null) { ?>


                                                <a href="<?=$altmenu2['url']?>" target="_blank" class="text-dark" style="font-size:13px;"><i class="fa fa-external-link"></i>

                                                    <?php
                                                    $UrlAltAltMenu = strip_tags($UrlAltAltMenu);
                                                    if (strlen($UrlAltAltMenu) > 55) {

                                                        $stringCut = substr($UrlAltAltMenu, 0, 55);
                                                        $endPoint = strrpos($stringCut, ' ');

                                                        $UrlAltAltMenu = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                        $UrlAltAltMenu .= '...';
                                                    }
                                                    echo $UrlAltAltMenu;
                                                    ?>

                                                </a>

                                            <?php }?>

                                        </td>

                                        <td style="text-align: center; ">
                                            <?php
                                            if($altmenu2['durum'] == 1) {
                                                ?>
                                                <span class="btn btn-success btn-sm"><i class="fa fa-check"></i> Aktif</span>
                                            <?php } ?>
                                            <?php
                                            if($altmenu2['durum'] == 0) {
                                                ?>
                                                <span class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Pasif</span>
                                            <?php } ?>
                                        </td>

                                        <td class="text-nowrap" style="text-align: center; border-right: 0 !important;">
                                            <a  href="pages.php?sayfa=headmenu&menu_id=<?=$altmenu2['id']?>" class="btn btn-sm btn-info" style="color:#FFF"><i class="fa fa-pencil text-inverse"></i> Düzenle </a>
                                            <a  onclick="deletebutton('<?=$altmenu2['id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>
                                        </td>

                                    </tr>
                                <?php }?>

                            <?php }?>



                       <?php }?>

                        </tbody>
                    </table>


                </div>
                <?php } else {?>
                <div class="alert alert-info" style="font-weight: 400">
                    Henüz Menu Eklenmemiş!
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
                window.location.href = "support/post/delete/header-menu-sil.php?menusil=success&id="+menuid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>

<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=headermenu">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=headermenu">
<?php }?>
<?php if($_GET['status']=='nocheck'){ ?>
    <body onload="sweetAlert('Sorun Var!', 'Hiç seçim yapılmamış!', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=headermenu">
<?php }?>
