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
    if (isset($_POST['ozellikmoduldegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE ozellik_ayar SET
            baslik_color=:baslik_color,
			spot_color=:spot_color,
			back_color=:back_color,
			padding=:padding,
			ozellik_limit=:ozellik_limit,
			width=:width,	
			tags=:tags,
			meta_desc=:meta_desc,
			head_color=:head_color,
			icon_color=:icon_color,
			icon_border_radius=:icon_border_radius,
			icon_back_color=:icon_back_color,
			box_head_color=:box_head_color,
			box_spot_color=:box_spot_color,	
			ozellik_button=:ozellik_button,
			button_bg=:button_bg
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'baslik_color' => $_POST['baslik_color'],
                'spot_color' => $_POST['spot_color'],
                'back_color' => $_POST['back_color'],
                'padding' => $_POST['padding'],
                'ozellik_limit' => $_POST['ozellik_limit'],
                'width' => $_POST['width'],
                'tags' => $_POST['tags'],
                'meta_desc' => $_POST['meta_desc'],
                'head_color' => $_POST['head_color'],
                'icon_color' => $_POST['icon_color'],
                'icon_border_radius' => $_POST['icon_border_radius'],
                'icon_back_color' => $_POST['icon_back_color'],
                'box_head_color' => $_POST['box_head_color'],
                'box_spot_color' => $_POST['box_spot_color'],
                'ozellik_button' => $_POST['ozellik_button'],
                'button_bg' => $_POST['button_bg'],
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=ozellikmodul&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=ozellikmodul&status=warning");
        }


    }

}

?>


