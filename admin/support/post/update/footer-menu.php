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
    if (isset($_POST['footermenudegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE footer_menu SET
        baslik=:baslik,
        url=:url,
        sira=:sira,
        yer=:yer,
        durum=:durum
			WHERE id={$_POST['footer_id']}"
        );
        $update = $ayarkaydet->execute(
            array(
                'baslik' => $_POST['baslik'],
                'url' => $_POST['url'],
                'sira' => $_POST['sira'],
                'yer' => $_POST['yer'],
                'durum' => $_POST['durum']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=footermenu&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=footermenu&status=warning");
        }


    }

}

?>


