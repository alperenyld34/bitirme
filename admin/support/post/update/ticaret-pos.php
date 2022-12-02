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
    if (isset($_POST['posayar'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE odeme_ayar SET
            pos_tur=:pos_tur,
			paytr_id=:paytr_id,
			paytr_key=:paytr_key,
			paytr_salt=:paytr_salt,
			iyzico_key=:iyzico_key,
			iyzico_secure=:iyzico_secure,	
            shopier_key=:shopier_key,
			shopier_secret=:shopier_secret,
			paywant_key=:paywant_key,
			paywant_secret=:paywant_secret,
			paywant_odeme_tur=:paywant_odeme_tur,
			payu_merchant=:payu_merchant,
			payu_secret=:payu_secret
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'pos_tur' => $_POST['pos_tur'],
                'paytr_id' => $_POST['paytr_id'],
                'paytr_key' => $_POST['paytr_key'],
                'paytr_salt' => $_POST['paytr_salt'],
                'iyzico_key' => $_POST['iyzico_key'],
                'iyzico_secure' => $_POST['iyzico_secure'],
                'shopier_key' => $_POST['shopier_key'],
                'shopier_secret' => $_POST['shopier_secret'],
                'paywant_key' => $_POST['paywant_key'],
                'paywant_secret' => $_POST['paywant_secret'],
                'paywant_odeme_tur' => $_POST['paywant_odeme_tur'],
                'payu_merchant' => $_POST['payu_merchant'],
                'payu_secret' => $_POST['payu_secret']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=posayar&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=posayar&status=warning");
        }


    }

}

?>


