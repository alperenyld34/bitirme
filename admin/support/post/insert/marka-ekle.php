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
    if (isset($_POST['markaekle'])) {


        if ($_FILES['gorsel']["size"] > 0) {


            $dosyas = $_FILES["gorsel"];
            $kaynak = $_FILES["gorsel"]["tmp_name"];
            $dosya = $_FILES["gorsel"]["name"];
            $uzanti = explode(".", $_FILES[gorsel][name]);
            $random = rand(0, 9999999999999);
            $random2 = rand(0, 999);
            $yeni_isim = $random . "-" . $random2 . "-" . $dosya;
            $hedef = "../../../../images/clients/" . $yeni_isim;


            if ($dosyas['type'] == 'image/jpg' || $dosyas['type'] == 'image/jpeg' || $dosyas['type'] == 'image/png') {

                $gitti = move_uploaded_file($kaynak, $hedef);


                $kaydet = $db->prepare("INSERT INTO marka SET
            durum=:durum,
            baslik=:baslik,
            sira=:sira,
            url=:url,
            gorsel=:gorsel
        ");
                $ekle = $kaydet->execute(array(
                    'durum' => $_POST['durum'],
                    'baslik' => $_POST['baslik'],
                    'sira' => $_POST['sira'],
                    'url' => $_POST['url'],
                    'gorsel' => $yeni_isim
                ));
                if ($ekle) {

                    Header("location: ../../../pages.php?sayfa=markalar&status=success");

                } else {

                    Header("location: ../../../pages.php?sayfa=markalar&status=warning");

                }

            } else {
                Header("location: ../../../pages.php?sayfa=markaekle&status=imgtype");
            }

        }


    }


}
?>


