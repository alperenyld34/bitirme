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

            Header("location: siparis-durum-iptal.php?current=success&siparis_id=$_POST[siparis_id]");
        } else {

            Header("location: ../../../pages.php?sayfa=siparis&siparis_id=$_POST[siparis_id]&status=warning");
        }


    }
}
?>


