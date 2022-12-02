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
    if (isset($_POST['urunmoduldegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE urunmodul_ayar SET
            divider=:divider,
			back_color=:back_color,
			padding=:padding,
			font_weight=:font_weight,
			tab_font_size=:tab_font_size,
			tab_back_color=:tab_back_color,	
            tab_text_color=:tab_text_color,
			tab_border_color=:tab_border_color,
			tab_border_radius=:tab_border_radius,			
			tab_act_text_color=:tab_act_text_color,
			tab_limit=:tab_limit,
			tab_urun_limit=:tab_urun_limit,
			spot_color=:spot_color,
			baslik_color=:baslik_color,
			width=:width,	
            star_rate=:star_rate,
			incele_button_back=:incele_button_back,
			incele_button_color=:incele_button_color,			
			populer=:populer,
			yeni=:yeni,
			urun_grup=:urun_grup,
			urun_grup_back=:urun_grup_back,
			urun_grup_textcolor=:urun_grup_textcolor,
			urun_grup_incele_back=:urun_grup_incele_back,	
            urun_grup_incelecolor=:urun_grup_incelecolor,
			urun_grup_border=:urun_grup_border,
			urun_grup_limit=:urun_grup_limit,				
			tags=:tags,
			meta_desc=:meta_desc,
			detay_altmenu_tip=:detay_altmenu_tip,
			detay_altmenu_bg=:detay_altmenu_bg,
			detay_altmenu_hover=:detay_altmenu_hover,
			detay_altmenu_border=:detay_altmenu_border,	
            detay_altmenu_textcolor=:detay_altmenu_textcolor,
			detay_altmenu_hovertextcolor=:detay_altmenu_hovertextcolor,
			detay_altmenu_megaborder=:detay_altmenu_megaborder,				  
			detay_altmenu_megashadow=:detay_altmenu_megashadow,
			detay_etiket=:detay_etiket,	
            detay_benzer_urun=:detay_benzer_urun,
			detay_arama=:detay_arama,
			detay_populer=:detay_populer
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'divider' => $_POST['divider'],
                'back_color' => $_POST['back_color'],
                'padding' => $_POST['padding'],
                'font_weight' => $_POST['font_weight'],
                'tab_font_size' => $_POST['tab_font_size'],
                'tab_back_color' => $_POST['tab_back_color'],
                'tab_text_color' => $_POST['tab_text_color'],
                'tab_border_color' => $_POST['tab_border_color'],
                'tab_border_radius' => $_POST['tab_border_radius'],
                'tab_act_text_color' => $_POST['tab_act_text_color'],
                'tab_limit' => $_POST['tab_limit'],
                'tab_urun_limit' => $_POST['tab_urun_limit'],
                'spot_color' => $_POST['spot_color'],
                'baslik_color' => $_POST['baslik_color'],
                'width' => $_POST['width'],
                'star_rate' => $_POST['star_rate'],
                'incele_button_back' => $_POST['incele_button_back'],
                'incele_button_color' => $_POST['incele_button_color'],
                'populer' => $_POST['populer'],
                'yeni' => $_POST['yeni'],
                'urun_grup' => $_POST['urun_grup'],
                'urun_grup_back' => $_POST['urun_grup_back'],
                'urun_grup_textcolor' => $_POST['urun_grup_textcolor'],
                'urun_grup_incele_back' => $_POST['urun_grup_incele_back'],
                'urun_grup_incelecolor' => $_POST['urun_grup_incelecolor'],
                'urun_grup_border' => $_POST['urun_grup_border'],
                'urun_grup_limit' => $_POST['urun_grup_limit'],
                'tags' => $_POST['tags'],
                'meta_desc' => $_POST['meta_desc'],
                'detay_altmenu_tip' => $_POST['detay_altmenu_tip'],
                'detay_altmenu_bg' => $_POST['detay_altmenu_bg'],
                'detay_altmenu_hover' => $_POST['detay_altmenu_hover'],
                'detay_altmenu_border' => $_POST['detay_altmenu_border'],
                'detay_altmenu_textcolor' => $_POST['detay_altmenu_textcolor'],
                'detay_altmenu_hovertextcolor' => $_POST['detay_altmenu_hovertextcolor'],
                'detay_altmenu_megaborder' => $_POST['detay_altmenu_megaborder'],
                'detay_altmenu_megashadow' => $_POST['detay_altmenu_megashadow'],
                'detay_etiket' => $_POST['detay_etiket'],
                'detay_benzer_urun' => $_POST['detay_benzer_urun'],
                'detay_arama' => $_POST['detay_arama'],
                'detay_populer' => $_POST['detay_populer']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=urunmodul&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=urunmodul&status=warning");
        }


    }

}

?>


