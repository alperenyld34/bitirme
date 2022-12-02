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
    if (isset($_POST['sayfaekle'])) {

        $kaydet = $db->prepare("INSERT INTO htmlsayfa SET
        baslik=:baslik,
        seo_url=:seo_url,
        icerik=:icerik,
        meta_desc=:meta_desc,
        tags=:tags,
        durum=:durum,
        dil=:dil
        ");
        $ekle = $kaydet->execute(array(
            'baslik' => $_POST['baslik'],
            'seo_url' => $_POST['seo_url'],
            'icerik' => $_POST['icerik'],
            'meta_desc' => $_POST['meta_desc'],
            'tags' => $_POST['tags'],
            'durum' => $_POST['durum'],
            'dil' => $_POST['dil']
        ));
        if ($ekle) {

            Header("location: ../../../pages.php?sayfa=sayfalar&status=success");

        } else {

            Header("location: ../../../pages.php?sayfa=sayfalar&status=warning");

        }

    }


}
?>


