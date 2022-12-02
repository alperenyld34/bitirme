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
    if (isset($_POST['ayardegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE uyeler_ayar SET
            durum=:durum,
            sms_ekle=:sms_ekle,
            eposta_ekle=:eposta_ekle,
            siparisler_alani=:siparisler_alani,
            destek_alani=:destek_alani,
            yorumlar_alani=:yorumlar_alani,
            adres_alani=:adres_alani
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'durum' => $_POST['durum'],
                'sms_ekle' => $_POST['sms_ekle'],
                'eposta_ekle' => $_POST['eposta_ekle'],
                'siparisler_alani' => $_POST['siparisler_alani'],
                'destek_alani' => $_POST['destek_alani'],
                'yorumlar_alani' => $_POST['yorumlar_alani'],
                'adres_alani' => $_POST['adres_alani']
            )
        );

        //TODO burada ekleme var - yorumlar_alani sütunu eklendi
        if ($update) {

            Header("location: ../../../pages.php?sayfa=uyeayar&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=uyeayar&status=warning");
        }


    }

}

?>


