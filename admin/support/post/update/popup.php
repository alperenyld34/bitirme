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
    if (isset($_POST['popupdegis'])) {


        if ($_FILES['gorsel']["size"] > 0) {


            $dosyas = $_FILES["gorsel"];
            $kaynak = $_FILES["gorsel"]["tmp_name"];
            $dosya = $_FILES["gorsel"]["name"];
            $uzanti = explode(".", $_FILES['gorsel']['name']);
            $random = rand(0, 9999999999999);
            $random2 = rand(0, 999);
            $yeni_isim = $random . "-" . $random2 . "-" . $dosya;
            $hedef = "../../../../images/uploads/" . $yeni_isim;


            if ($dosyas['type'] == 'image/jpg' || $dosyas['type'] == 'image/jpeg' || $dosyas['type'] == 'image/png') {

                $gitti = move_uploaded_file($kaynak, $hedef);


                $kaydet = $db->prepare("UPDATE popup SET
            durum=:durum,
            tur=:tur,
            embed=:embed,
            ip_durum=:ip_durum,
            delay=:delay,
            url=:url,
            url_target=:url_target,
            padding=:padding,
            gorsel=:gorsel
            WHERE id='1'
        ");
                $ekle = $kaydet->execute(array(
                    'durum' => $_POST['durum'],
                    'tur' => $_POST['tur'],
                    'embed' => $_POST['embed'],
                    'ip_durum' => $_POST['ip_durum'],
                    'delay' => $_POST['delay'],
                    'url' => $_POST['url'],
                    'url_target' => $_POST['url_target'],
                    'padding' => $_POST['padding'],
                    'gorsel' => $yeni_isim
                ));
                if ($ekle) {

                    $resimsilunlink = $_POST['eski_gorsel'];
                    unlink("../../../../images/uploads/$resimsilunlink");
                    Header("location: ../../../pages.php?sayfa=popupmodul&status=success");

                } else {

                    Header("location: ../../../pages.php?sayfa=popupmodul&status=warning");

                }

            } else {
                Header("location: ../../../pages.php?sayfa=popupmodul&status=imgtype");
            }

        } else {


            $kaydet = $db->prepare("UPDATE popup SET
            durum=:durum,
            tur=:tur,
            embed=:embed,
            ip_durum=:ip_durum,
            delay=:delay,
            url=:url,
            url_target=:url_target,
            padding=:padding
            WHERE id='1'
        ");
            $ekle = $kaydet->execute(array(
                'durum' => $_POST['durum'],
                'tur' => $_POST['tur'],
                'embed' => $_POST['embed'],
                'ip_durum' => $_POST['ip_durum'],
                'delay' => $_POST['delay'],
                'url' => $_POST['url'],
                'url_target' => $_POST['url_target'],
                'padding' => $_POST['padding']
            ));
            if ($ekle) {

                Header("location: ../../../pages.php?sayfa=popupmodul&status=success");

            } else {

                Header("location: ../../../pages.php?sayfa=popupmodul&status=warning");

            }

        }


    }

}

?>


