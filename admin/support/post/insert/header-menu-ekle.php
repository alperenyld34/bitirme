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
    if (isset($_POST['headermenuekle'])) {

        $kaydet = $db->prepare("INSERT INTO header_menu SET
        baslik=:baslik,
        url=:url,
        dil=:dil,
        sira=:sira,
        ust_id=:ust_id,
        mega_durum=:mega_durum,
        durum=:durum
        ");
        $ekle = $kaydet->execute(array(
            'baslik' => $_POST['baslik'],
            'url' => $_POST['url'],
            'dil' => $_POST['dil'],
            'sira' => $_POST['sira'],
            'ust_id' => $_POST['ust_id'],
            'mega_durum' => $_POST['mega_durum'],
            'durum' => $_POST['durum']
        ));
        if ($ekle) {

            Header("location: ../../../pages.php?sayfa=headermenu&status=success");

        } else {

            Header("location: ../../../pages.php?sayfa=headermenu&status=warning");

        }

    }


}
?>


