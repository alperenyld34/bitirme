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
    if (isset($_POST['sil'])) {


        $silinecekler = implode(', ', $_POST['sil']);


        $sorgu = $db->prepare('DELETE FROM `uyeler` WHERE `id` IN (' . $silinecekler . ')');
        $sorgu->execute();

        if ($sorgu) {
            Header("location: ../../../pages.php?sayfa=uyeler&status=success");
        } else {
            Header("location: ../../../pages.php?sayfa=uyeler&status=warning");
        }

    } else {
        Header("location: ../../../pages.php?sayfa=uyeler&status=nocheck");
    }
}
?>