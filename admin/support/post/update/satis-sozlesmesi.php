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
    if (isset($_POST['sozlesmedegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE sozlesme SET
            icerik=:icerik
			WHERE id={$_POST['sozlesme_id']}"
        );
        $update = $ayarkaydet->execute(
            array(
                'icerik' => $_POST['icerik']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=satissozlesmesi&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=satissozlesmesi&status=warning");
        }


    }

}

?>


