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
    if (isset($_POST['loaderdegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE loader SET
			back_color=:back_color,
			durum=:durum,
			delay=:delay	
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'back_color' => $_POST['back_color'],
                'durum' => $_POST['durum'],
                'delay' => $_POST['delay']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=loaderayar&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=loaderayar&status=warning");
        }


    }

}

?>


