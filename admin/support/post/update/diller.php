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
    if (isset($_POST['dildegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE dil SET
            baslik=:baslik,
			kisa_ad=:kisa_ad,
			flag=:flag,
			sira=:sira,
			icerik=:icerik,
			varsayilan=:varsayilan
			WHERE id={$_POST['dil_id']}"
        );
        $update = $ayarkaydet->execute(
            array(
                'baslik' => $_POST['baslik'],
                'kisa_ad' => $_POST['kisa_ad'],
                'flag' => $_POST['flag'],
                'sira' => $_POST['sira'],
                'icerik' => $_POST['icerik'],
                'varsayilan' => $_POST['varsayilan']
            )
        );

        if ($update) {

            $uploads_dir = '/../../../../includes/lang/';
            $dosya = $_POST["kisa_ad"];
            $uzanti = ".php";
            $icerik = $_POST['icerik'];

            $dosya = fopen(__DIR__ . "$uploads_dir$_POST[kisa_ad]$uzanti", "w");
            $yaz = fwrite($dosya, $icerik);

            Header("location: ../../../pages.php?sayfa=diller&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=diller&status=warning");
        }


    }


}
?>


