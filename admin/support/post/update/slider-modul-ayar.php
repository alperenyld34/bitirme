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
    if (isset($_POST['sliderayar'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE slider_ayar SET
            width=:width,
			width_2=:width_2,
			height=:height,
			mobil_height=:mobil_height,
			font=:font
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'width' => $_POST['width'],
                'width_2' => $_POST['width_2'],
                'height' => $_POST['height'],
                'mobil_height' => $_POST['mobil_height'],
                'font' => $_POST['font']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=slidermodul&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=slidermodul&status=warning");
        }


    }


}
?>


