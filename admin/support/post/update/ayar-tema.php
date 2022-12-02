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
    if (isset($_POST['temaayardegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE ayarlar SET
			site_captcha=:site_captcha,
			site_bg_color=:site_bg_color,
			copyright_1=:copyright_1,
			copyright_2=:copyright_2,
			totop=:totop,
			totop_bg=:totop_bg,
			totop_bottom=:totop_bottom,
			totop_icon=:totop_icon,
			dots_color=:dots_color	
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'site_captcha' => $_POST['site_captcha'],
                'site_bg_color' => $_POST['site_bg_color'],
                'copyright_1' => $_POST['copyright_1'],
                'copyright_2' => $_POST['copyright_2'],
                'totop' => $_POST['totop'],
                'totop_bg' => $_POST['totop_bg'],
                'totop_bottom' => $_POST['totop_bottom'],
                'totop_icon' => $_POST['totop_icon'],
                'dots_color' => $_POST['dots_color']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=temaayar&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=temaayar&status=warning");
        }


    }


}
?>


