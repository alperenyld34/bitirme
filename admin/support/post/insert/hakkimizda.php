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
    if (isset($_POST['hakkimizdaekle'])) {

        $kaydet = $db->prepare("INSERT INTO about_page SET
        baslik=:baslik,
        seo_url=:seo_url,
        icerik=:icerik,
        spot=:spot,
        galeri_id=:galeri_id,
        counter=:counter,
        beceri=:beceri,
        counter_bgcolor=:counter_bgcolor,
        counter_textcolor=:counter_textcolor,
        dil=:dil
        ");
        $ekle = $kaydet->execute(array(
            'baslik' => $_POST['baslik'],
            'seo_url' => $_POST['seo_url'],
            'icerik' => $_POST['icerik'],
            'spot' => $_POST['spot'],
            'galeri_id' => $_POST['galeri_id'],
            'counter' => $_POST['counter'],
            'beceri' => $_POST['beceri'],
            'counter_bgcolor' => $_POST['counter_bgcolor'],
            'counter_textcolor' => $_POST['counter_textcolor'],
            'dil' => $_POST['dil']
        ));
        if ($ekle) {

            Header("location: ../../../pages.php?sayfa=hakkimizdasayfa&status=success");

        } else {

            Header("location: ../../../pages.php?sayfa=hakkimizdasayfa&status=warning");

        }

    }


}
?>


