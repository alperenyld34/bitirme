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
    if (isset($_POST['ticariayar'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE odeme_ayar SET
            simge=:simge,
			sepet_sistemi=:sepet_sistemi,
			wp_siparis=:wp_siparis,
			stok_durum=:stok_durum,
			stok_gorunum=:stok_gorunum,
			normal_siparis=:normal_siparis,	
            kredi_kart=:kredi_kart,
			eft=:eft,
			button_bg=:button_bg,
			button_text_color=:button_text_color,
			kargo_sistemi=:kargo_sistemi,
			kargo_limit=:kargo_limit,
			cart_color=:cart_color,	
			cart_count_bg=:cart_count_bg,	
			cart_count_color=:cart_count_color,	
			sepet_step=:sepet_step,	
			kargo_limit=:kargo_limit,
			cart_icon=:cart_icon,
			kargolimit_product=:kargolimit_product,	
			kargolimit_header=:kargolimit_header,	
			kargolimit_bg_1=:kargolimit_bg_1,	
			kargolimit_bg_2=:kargolimit_bg_2,	
			kargolimit_font=:kargolimit_font,	
			kargolimit_width=:kargolimit_width,
			kargolimit_text_color=:kargolimit_text_color
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'simge' => $_POST['simge'],
                'sepet_sistemi' => $_POST['sepet_sistemi'],
                'wp_siparis' => $_POST['wp_siparis'],
                'stok_durum' => $_POST['stok_durum'],
                'stok_gorunum' => $_POST['stok_gorunum'],
                'normal_siparis' => $_POST['normal_siparis'],
                'kredi_kart' => $_POST['kredi_kart'],
                'eft' => $_POST['eft'],
                'button_bg' => $_POST['button_bg'],
                'button_text_color' => $_POST['button_text_color'],
                'kargo_sistemi' => $_POST['kargo_sistemi'],
                'kargo_limit' => $_POST['kargo_limit'],
                'cart_color' => $_POST['cart_color'],
                'cart_count_bg' => $_POST['cart_count_bg'],
                'cart_count_color' => $_POST['cart_count_color'],
                'sepet_step' => $_POST['sepet_step'],
                'cart_icon' => $_POST['cart_icon'],
                'kargolimit_product' => $_POST['kargolimit_product'],
                'kargolimit_header' => $_POST['kargolimit_header'],
                'kargolimit_bg_1' => $_POST['kargolimit_bg_1'],
                'kargolimit_bg_2' => $_POST['kargolimit_bg_2'],
                'kargolimit_font' => $_POST['kargolimit_font'],
                'kargolimit_width' => $_POST['kargolimit_width'],
                'kargolimit_text_color' => $_POST['kargolimit_text_color']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=ticariayar&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=ticariayar&status=warning");
        }


    }


}
?>


