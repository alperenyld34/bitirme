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
    if (isset($_POST['koddegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE ayarlar SET
            analytics_code=:analytics_code,
			yandex_code=:yandex_code,
			canli_destek_kodu=:canli_destek_kodu
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'analytics_code' => $_POST['analytics_code'],
                'yandex_code' => $_POST['yandex_code'],
                'canli_destek_kodu' => $_POST['canli_destek_kodu']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=kodekle&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=kodekle&status=warning");
        }


    }

}

?>


