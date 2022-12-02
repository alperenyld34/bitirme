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
    if (isset($_POST['sabitheader'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE sabit_header SET
shadow=:shadow,
padding=:padding,
arkaplan=:arkaplan,
durum=:durum
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'shadow' => $_POST['shadow'],
                'padding' => $_POST['padding'],
                'arkaplan' => $_POST['arkaplan'],
                'durum' => $_POST['durum']
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


