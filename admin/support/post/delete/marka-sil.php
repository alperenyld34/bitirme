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
    if ($_GET['marka'] == "success") {

        $gorselSil = $db->prepare("select * from marka where id='$_GET[id]'");
        $gorselSil->execute();
        while ($row = $gorselSil->fetch(PDO::FETCH_ASSOC)) {
            $gorseladres = $row['gorsel'];

            unlink("../../../../images/clients/$gorseladres");
        }

        $sil = $db->prepare("DELETE from marka where id=:id");
        $kontrol = $sil->execute(
            array(
                'id' => $_GET['id']
            )
        );

        if ($kontrol) {


            Header("location: ../../../pages.php?sayfa=markalar&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=markalar&status=warning");
        }
    }
}
?>