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
    if (isset($_POST['hakkimizdamoduldegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE about_ayar SET
            baslik_color=:baslik_color,
            divider=:divider,
			back_color=:back_color,
			padding=:padding,
			font_weight=:font_weight,
			width=:width,	
			text_color=:text_color,
			button_bg=:button_bg,
			tags=:tags,
			meta_desc=:meta_desc
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'baslik_color' => $_POST['baslik_color'],
                'divider' => $_POST['divider'],
                'back_color' => $_POST['back_color'],
                'padding' => $_POST['padding'],
                'font_weight' => $_POST['font_weight'],
                'width' => $_POST['width'],
                'text_color' => $_POST['text_color'],
                'button_bg' => $_POST['button_bg'],
                'tags' => $_POST['tags'],
                'meta_desc' => $_POST['meta_desc']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=hakkimizdamodul&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=hakkimizdamodul&status=warning");
        }


    }

}

?>


