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
    if ($_GET['siparis'] == "success") {

        $siparisUrunSil = $db->prepare("select * from siparis_urunler where siparis_id='$_GET[siparis_no]'");
        $siparisUrunSil->execute();
        while ($row = $siparisUrunSil->fetch(PDO::FETCH_ASSOC)) {
            $sil = $db->prepare("DELETE from siparis_urunler where id=:id");
            $kontrol = $sil->execute(
                array(
                    'id' => $row['id']
                )
            );
        }

        $sil = $db->prepare("DELETE from siparis where id=:id");
        $kontrol = $sil->execute(
            array(
                'id' => $_GET['id']
            )
        );

        if ($kontrol) {

            Header("location: ../../../pages.php?sayfa=siparisler&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=siparisler&status=warning");
        }
    }
}
?>