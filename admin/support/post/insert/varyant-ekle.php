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
    if (isset($_POST['varyantekle'])) {

        $kaydet = $db->prepare("INSERT INTO varyant SET
            baslik=:baslik,
            tur=:tur,
            sira=:sira,
            urun_id=:urun_id
        ");
        $ekle = $kaydet->execute(array(
            'baslik' => $_POST['baslik'],
            'tur' => $_POST['tur'],
            'sira' => $_POST['sira'],
            'urun_id' => $_POST['urun_id']
        ));
        if ($ekle) {

            Header("location: ../../../pages.php?sayfa=varyantlar&urun_id=$_POST[urun_id]&status=success");

        } else {

            Header("location: ../../../pages.php?sayfa=varyantlar&urun_id=$_POST[urun_id]&status=warning");

        }


    }

}

?>


