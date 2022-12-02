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
    if (isset($_POST['blogmoduldegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE blog_ayar SET
            divider=:divider,
			back_color=:back_color,
			padding=:padding,
			font_weight=:font_weight,
			box_bg_color=:box_bg_color,
			box_header_color=:box_header_color,
			box_spot_color=:box_spot_color,
			box_more_color=:box_more_color,	
			border_radius=:border_radius,
			blog_limit=:blog_limit,
			spot_color=:spot_color,
			baslik_color=:baslik_color,
			width=:width,	
			tags=:tags,
			meta_desc=:meta_desc
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'divider' => $_POST['divider'],
                'back_color' => $_POST['back_color'],
                'padding' => $_POST['padding'],
                'font_weight' => $_POST['font_weight'],
                'box_bg_color' => $_POST['box_bg_color'],
                'box_header_color' => $_POST['box_header_color'],
                'box_spot_color' => $_POST['box_spot_color'],
                'box_more_color' => $_POST['box_more_color'],
                'border_radius' => $_POST['border_radius'],
                'blog_limit' => $_POST['blog_limit'],
                'spot_color' => $_POST['spot_color'],
                'baslik_color' => $_POST['baslik_color'],
                'width' => $_POST['width'],
                'tags' => $_POST['tags'],
                'meta_desc' => $_POST['meta_desc']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=blogmodul&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=blogmodul&status=warning");
        }


    }

}

?>


