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
    if (isset($_POST['kutuayardegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE ayarlar SET
            ticaret_text_home=:ticaret_text_home,
			ticaret_text_urun=:ticaret_text_urun,
			ticaret_text_sepet=:ticaret_text_sepet,
			ticaret_text_color=:ticaret_text_color,
			ticaret_text_icon=:ticaret_text_icon,
			ticaret_text_border=:ticaret_text_border,	
            ticaret_text_back=:ticaret_text_back
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'ticaret_text_home' => $_POST['ticaret_text_home'],
                'ticaret_text_urun' => $_POST['ticaret_text_urun'],
                'ticaret_text_sepet' => $_POST['ticaret_text_sepet'],
                'ticaret_text_color' => $_POST['ticaret_text_color'],
                'ticaret_text_icon' => $_POST['ticaret_text_icon'],
                'ticaret_text_border' => $_POST['ticaret_text_border'],
                'ticaret_text_back' => $_POST['ticaret_text_back']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=bilgikutulari&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=bilgikutulari&status=warning");
        }


    }

}

?>


