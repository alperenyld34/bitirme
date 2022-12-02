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
    if (isset($_POST['topheaderdegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE header_ayar SET
            durum=:durum,
			topheader_width=:topheader_width,
			font=:font,
			padding=:padding,
			back_color=:back_color,
			text_color=:text_color,	
            border_color=:border_color,
			icon_color=:icon_color,
			sosyal=:sosyal,
			tel=:tel,
			tel_2=:tel_2,
			mail=:mail,
			teklif_button=:teklif_button,
			siparis_takip_button=:siparis_takip_button,
			teklif_button_bg=:teklif_button_bg,
			siparis_takip_button_bg=:siparis_takip_button_bg,
			whatsapp=:whatsapp
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'durum' => $_POST['durum'],
                'topheader_width' => $_POST['topheader_width'],
                'font' => $_POST['font'],
                'padding' => $_POST['padding'],
                'back_color' => $_POST['back_color'],
                'text_color' => $_POST['text_color'],
                'border_color' => $_POST['border_color'],
                'icon_color' => $_POST['icon_color'],
                'sosyal' => $_POST['sosyal'],
                'tel' => $_POST['tel'],
                'tel_2' => $_POST['tel_2'],
                'mail' => $_POST['mail'],
                'teklif_button' => $_POST['teklif_button'],
                'siparis_takip_button' => $_POST['siparis_takip_button'],
                'teklif_button_bg' => $_POST['teklif_button_bg'],
                'siparis_takip_button_bg' => $_POST['siparis_takip_button_bg'],
                'whatsapp' => $_POST['whatsapp']
            )
        ); //TODO EKLEME VAR

        if ($update) {

            Header("location: ../../../pages.php?sayfa=headermenuayar&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=headermenuayar&status=warning");
        }


    }

}

?>


