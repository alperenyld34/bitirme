<?php
ob_start();
session_start();
include "../../../../includes/config/config.php";
date_default_timezone_set( 'Europe/Istanbul' );
$settings=$db->prepare("SELECT * from ayarlar where id='1'");
$settings->execute(array(0));
$ayar=$settings->fetch(PDO::FETCH_ASSOC);
$siteurl = $ayar['site_url'];
?>


<?php
include_once '../../secure_post.php';
if ($adminsorgusu->rowCount()===0) {
    header("Location: 404");
} else {
    if (isset($_POST['markamoduldegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE marka_ayar SET
            baslik_color=:baslik_color,
			spot_color=:spot_color,
            divider=:divider,
			back_color=:back_color,
			padding=:padding,
			font_weight=:font_weight,
			marka_limit=:marka_limit,
			width=:width,	
			tags=:tags,
			meta_desc=:meta_desc
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'baslik_color' => $_POST['baslik_color'],
                'spot_color' => $_POST['spot_color'],
                'divider' => $_POST['divider'],
                'back_color' => $_POST['back_color'],
                'padding' => $_POST['padding'],
                'font_weight' => $_POST['font_weight'],
                'marka_limit' => $_POST['marka_limit'],
                'width' => $_POST['width'],
                'tags' => $_POST['tags'],
                'meta_desc' => $_POST['meta_desc']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=markamodul&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=markamodul&status=warning");
        }


    }


}
?>


