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
    if (isset($_POST['sozlesmeekle'])) {

        $kaydet = $db->prepare("INSERT INTO uyeler_sozlesme SET
        icerik=:icerik,
        dil=:dil,
        durum=:durum
        ");
        $ekle = $kaydet->execute(array(
            'icerik' => $_POST['icerik'],
            'dil' => $_POST['dil'],
            'durum' => '1'
        ));
        if ($ekle) {

            Header("location: ../../../pages.php?sayfa=uyeliksozlesmesi&status=success");

        } else {

            Header("location: ../../../pages.php?sayfa=uyeliksozlesmesi&status=warning");

        }

    }


}
?>


