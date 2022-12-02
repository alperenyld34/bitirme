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
    if (isset($_POST['sayacmoduldegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE sayac_ayar SET
			back_color=:back_color,
			padding=:padding,
			width=:width,
			box_bg_color=:box_bg_color,	
			box_text_color=:box_text_color,	
			box_border_color=:box_border_color,
			icon=:icon
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'back_color' => $_POST['back_color'],
                'padding' => $_POST['padding'],
                'width' => $_POST['width'],
                'box_bg_color' => $_POST['box_bg_color'],
                'box_text_color' => $_POST['box_text_color'],
                'box_border_color' => $_POST['box_border_color'],
                'icon' => $_POST['icon']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=sayacmodul&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=sayacmodul&status=warning");
        }


    }

}

?>


