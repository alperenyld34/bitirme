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
    if (isset($_POST['sosyalekle'])) {

        $kaydet = $db->prepare("INSERT INTO sosyal SET
            baslik=:baslik,
            icon=:icon,
            sira=:sira,
            url=:url
        ");
        $ekle = $kaydet->execute(array(
            'baslik' => $_POST['baslik'],
            'icon' => $_POST['icon'],
            'sira' => $_POST['sira'],
            'url' => $_POST['url']
        ));
        if ($ekle) {

            Header("location: ../../../pages.php?sayfa=sosyalmedyalar&status=success");

        } else {

            Header("location: ../../../pages.php?sayfa=sosyalmedyalar&status=warning");

        }


    }

}

?>


