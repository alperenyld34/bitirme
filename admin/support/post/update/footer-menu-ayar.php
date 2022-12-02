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
    if (isset($_POST['footerdegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE footer_ayar SET
            tip=:tip,
			width=:width,
			gorsel_onay=:gorsel_onay
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'tip' => $_POST['tip'],
                'width' => $_POST['width'],
                'gorsel_onay' => $_POST['gorsel_onay']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=footermenuayar&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=footermenuayar&status=warning");
        }


    }

}

?>


