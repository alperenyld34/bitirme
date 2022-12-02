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
    if (isset($_POST['yorummoduldegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE yorum_ayar SET
            baslik_color=:baslik_color,
			spot_color=:spot_color,
            divider=:divider,
			back_color=:back_color,
			padding=:padding,
			font_weight=:font_weight,
			yorum_limit=:yorum_limit,
			star_color=:star_color,
			box_isim_color=:box_isim_color,
			width=:width,	
			tags=:tags,
			meta_desc=:meta_desc,	
			box_pozisyon_color=:box_pozisyon_color,
			box_icerik_color=:box_icerik_color
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
                'yorum_limit' => $_POST['yorum_limit'],
                'star_color' => $_POST['star_color'],
                'box_isim_color' => $_POST['box_isim_color'],
                'width' => $_POST['width'],
                'tags' => $_POST['tags'],
                'meta_desc' => $_POST['meta_desc'],
                'box_pozisyon_color' => $_POST['box_pozisyon_color'],
                'box_icerik_color' => $_POST['box_icerik_color']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=yorummodul&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=yorummodul&status=warning");
        }


    }

}

?>


