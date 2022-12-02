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
    if (isset($_POST['headerdegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE header_ayar SET
            header_width=:header_width,
            header_limit=:header_limit,
			font_weight=:font_weight,
			font_size=:font_size,
			arama_button=:arama_button,
			dil_secim=:dil_secim,
			menu_hover_color=:menu_hover_color,	
            menu_text_color=:menu_text_color,
			menu_text_hover_color=:menu_text_hover_color,
			mobil_bg=:mobil_bg,
			mobil_bar_color=:mobil_bar_color,
			header_menu_bg=:header_menu_bg,	
            arama_button_bg=:arama_button_bg,
			dil_border=:dil_border,
			header_tip=:header_tip,
			menu_bg=:menu_bg,
			menu_align=:menu_align,
			arama_button_color=:arama_button_color,
			header2_cart_bg=:header2_cart_bg,	
            header2_menu_border=:header2_menu_border,
            header2_bottom_margin=:header2_bottom_margin,
			header2_menu_height=:header2_menu_height,
			uyelik_icon=:uyelik_icon,
			uyelik_icon_color=:uyelik_icon_color,
			header2_uyelik_bg=:header2_uyelik_bg
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'header_width' => $_POST['header_width'],
                'header_limit' => $_POST['header_limit'],
                'font_weight' => $_POST['font_weight'],
                'font_size' => $_POST['font_size'],
                'arama_button' => $_POST['arama_button'],
                'dil_secim' => $_POST['dil_secim'],
                'menu_hover_color' => $_POST['menu_hover_color'],
                'menu_text_color' => $_POST['menu_text_color'],
                'menu_text_hover_color' => $_POST['menu_text_hover_color'],
                'mobil_bg' => $_POST['mobil_bg'],
                'mobil_bar_color' => $_POST['mobil_bar_color'],
                'header_menu_bg' => $_POST['header_menu_bg'],
                'arama_button_bg' => $_POST['arama_button_bg'],
                'dil_border' => $_POST['dil_border'],
                'header_tip' => $_POST['header_tip'],
                'menu_bg' => $_POST['menu_bg'],
                'menu_align' => $_POST['menu_align'],
                'arama_button_color' => $_POST['arama_button_color'],
                'header2_cart_bg' => $_POST['header2_cart_bg'],
                'header2_menu_border' => $_POST['header2_menu_border'],
                'header2_bottom_margin' => $_POST['header2_bottom_margin'],
                'header2_menu_height' => $_POST['header2_menu_height'],
                'uyelik_icon' => $_POST['uyelik_icon'],
                'uyelik_icon_color' => $_POST['uyelik_icon_color'],
                'header2_uyelik_bg' => $_POST['header2_uyelik_bg']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=headermenuayar&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=headermenuayar&status=warning");
        }


    }

}

?>


