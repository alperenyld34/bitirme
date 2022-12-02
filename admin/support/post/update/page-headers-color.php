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
    if (isset($_POST['pageheadcolor'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE page_header SET
            bg_color=:bg_color
			WHERE id={$_POST['page_id']}"
        );
        $update = $ayarkaydet->execute(
            array(
                'bg_color' => $_POST['bg_color']
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


