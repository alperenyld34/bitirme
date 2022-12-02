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
    if (isset($_POST['iletisimdegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE ayarlar SET
            site_mail=:site_mail,
			site_tel=:site_tel,
			site_gsm=:site_gsm,
			site_whatsapp=:site_whatsapp,
			adres_bilgisi=:adres_bilgisi,
			site_maps_kodu=:site_maps_kodu,		
			site_workhour=:site_workhour
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'site_mail' => $_POST['site_mail'],
                'site_tel' => $_POST['site_tel'],
                'site_gsm' => $_POST['site_gsm'],
                'site_whatsapp' => $_POST['site_whatsapp'],
                'adres_bilgisi' => $_POST['adres_bilgisi'],
                'site_maps_kodu' => $_POST['site_maps_kodu'],
                'site_workhour' => $_POST['site_workhour']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=iletisimayar&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=iletisimayar&status=warning");
        }


    }

}

?>


