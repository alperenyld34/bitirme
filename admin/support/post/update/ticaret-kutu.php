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
    if (isset($_POST['kutudegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE ticaret_bilgi SET
            baslik=:baslik,
			icon=:icon,
			sira=:sira
			WHERE id={$_POST['kutu_id']}"
        );
        $update = $ayarkaydet->execute(
            array(
                'baslik' => $_POST['baslik'],
                'icon' => $_POST['icon'],
                'sira' => $_POST['sira']
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


