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
$siparisDurumu = $db->prepare("select * from siparis where id='$_GET[siparis_id]'");
$siparisDurumu ->execute();
$siparis = $siparisDurumu->fetch(PDO::FETCH_ASSOC);
?>
<?php
include_once '../../secure_post.php';
if ($adminsorgusu->rowCount()===0) {
    header("Location: 404");
} else {
if ($_GET['current'] == 'success') {

if ($siparis['siparis_durum'] == 6) {

    Header("location: ../../../pages.php?sayfa=siparis&siparis_id=$_GET[siparis_id]&status=times");

}else {

    Header("location: ../../../pages.php?sayfa=siparis&siparis_id=$_GET[siparis_id]&status=success");
}


}
?>




<?php

    if (isset($_POST['siparisdurumdegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE siparis SET
        siparis_durum=:siparis_durum
			WHERE id={$_POST['siparis_id']}"
        );
        $update = $ayarkaydet->execute(
            array(
                'siparis_durum' => $_POST['siparis_durum']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=siparis&siparis_id=$_POST[siparis_id]&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=siparis&siparis_id=$_POST[siparis_id]&status=warning");
        }


    }
}
?>


