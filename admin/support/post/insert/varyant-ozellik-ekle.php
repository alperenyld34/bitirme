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

        $kaydet = $db->prepare("INSERT INTO varyant_oz SET
            ozellik=:ozellik,
            varyant_id=:varyant_id,
            sira=:sira
        ");
        $ekle = $kaydet->execute(array(
            'ozellik' => $_POST['ozellik'],
            'varyant_id' => $_POST['varyant_id'],
            'sira' => $_POST['sira']
        ));
        if ($ekle) {

            Header("location: ../../../pages.php?sayfa=varyantozellikleri&varyant_id=$_POST[varyant_id]&status=success");

        } else {

            Header("location: ../../../pages.php?sayfa=varyantozellikleri&varyant_id=$_POST[varyant_id]&status=warning");

        }


    }

}

?>


