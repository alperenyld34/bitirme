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
    if (isset($_POST['pageheaddegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE page_header SET
            width=:width,
			tip=:tip,
			padding=:padding,
			text_color=:text_color,
			pasif_text_color=:pasif_text_color,
			border_color=:border_color,	
            shadow=:shadow
			WHERE id={$_POST['page_id']}"
        );
        $update = $ayarkaydet->execute(
            array(
                'width' => $_POST['width'],
                'tip' => $_POST['tip'],
                'padding' => $_POST['padding'],
                'text_color' => $_POST['text_color'],
                'pasif_text_color' => $_POST['pasif_text_color'],
                'border_color' => $_POST['border_color'],
                'shadow' => $_POST['shadow']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=pagehead&page_id=$_POST[page_id]&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=pagehead&page_id=$_POST[page_id]&status=warning");
        }


    }

}

?>


