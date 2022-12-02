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
    if (isset($_POST['sorudegis'])) {


        $kaydet = $db->prepare("UPDATE sss SET
            soru=:soru,
            cevap=:cevap,
            sira=:sira,
            anasayfa=:anasayfa,
            durum=:durum
            WHERE id={$_POST['soru_id']}
        ");
        $ekle = $kaydet->execute(array(
            'soru' => $_POST['soru'],
            'cevap' => $_POST['cevap'],
            'sira' => $_POST['sira'],
            'anasayfa' => $_POST['anasayfa'],
            'durum' => $_POST['durum']
        ));
        if ($ekle) {

            Header("location: ../../../pages.php?sayfa=sorular&status=success");

        } else {

            Header("location: ../../../pages.php?sayfa=sorular&status=warning");

        }


    }


}
?>


