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
    if (isset($_POST['cookiesdegis'])) {


        $kaydet = $db->prepare("UPDATE cerez_ayar SET
            spot=:spot,
            link=:link,
            link_text=:link_text,
            button_text=:button_text,
            button_bg=:button_bg,
            button_text_color=:button_text_color,
            bg_color=:bg_color,
            bg_text_color=:bg_text_color,
            durum=:durum
            WHERE id={$_POST['cook_id']}
        ");
        $ekle = $kaydet->execute(array(
            'spot' => $_POST['spot'],
            'link' => $_POST['link'],
            'link_text' => $_POST['link_text'],
            'button_text' => $_POST['button_text'],
            'button_bg' => $_POST['button_bg'],
            'button_text_color' => $_POST['button_text_color'],
            'bg_color' => $_POST['bg_color'],
            'bg_text_color' => $_POST['bg_text_color'],
            'durum' => $_POST['durum']
        ));
        if ($ekle) {

            Header("location: ../../../pages.php?sayfa=cookies&status=success");

        } else {

            Header("location: ../../../pages.php?sayfa=cookies&status=warning");

        }


    }

}

?>


