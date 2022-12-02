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
    if ($_GET['modul'] == 'pasif') {

        $ayarkaydet = $db->prepare(
            "UPDATE moduller SET
        durum=:durum
			WHERE id={$_GET['modul_id']}"
        );
        $update = $ayarkaydet->execute(
            array(
                'durum' => 0
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=modulsiralama&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=modulsiralama&status=warning");
        }


    }

    if ($_GET['modul'] == 'aktif') {

        $ayarkaydet = $db->prepare(
            "UPDATE moduller SET
        durum=:durum
			WHERE id={$_GET['modul_id']}"
        );
        $update = $ayarkaydet->execute(
            array(
                'durum' => 1
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=modulsiralama&status=success2");
        } else {

            Header("location: ../../../pages.php?sayfa=modulsiralama&status=warning");
        }


    }
}
?>


