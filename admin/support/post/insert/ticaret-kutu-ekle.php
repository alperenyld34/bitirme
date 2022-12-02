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
    if (isset($_POST['kutukaydet'])) {

        $kaydet = $db->prepare("INSERT INTO ticaret_bilgi SET
        baslik=:baslik,
        icon=:icon,
        sira=:sira,
        dil=:dil
        ");
        $ekle = $kaydet->execute(array(
            'baslik' => $_POST['baslik'],
            'icon' => $_POST['icon'],
            'sira' => $_POST['sira'],
            'dil' => $_POST['dil']
        ));
        if ($ekle) {

            Header("location: ../../../pages.php?sayfa=bilgikutulari&status=success");

        } else {

            Header("location: ../../../pages.php?sayfa=bilgikutulari&status=warning");

        }

    }

}

?>


