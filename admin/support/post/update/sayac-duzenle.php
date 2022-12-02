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
    if (isset($_POST['sayacdegis'])) {

        $kaydet = $db->prepare("UPDATE sayac SET
        baslik=:baslik,
        count=:count,
        icon=:icon,
        plus=:plus,
        sira=:sira,
        durum=:durum
        WHERE id={$_POST['sayac_id']}
        ");
        $ekle = $kaydet->execute(array(
            'baslik' => $_POST['baslik'],
            'count' => $_POST['count'],
            'icon' => $_POST['icon'],
            'plus' => $_POST['plus'],
            'sira' => $_POST['sira'],
            'durum' => $_POST['durum']
        ));
        if ($ekle) {

            Header("location: ../../../pages.php?sayfa=sayaclar&status=success");

        } else {

            Header("location: ../../../pages.php?sayfa=sayaclar&status=warning");

        }

    }


}
?>


