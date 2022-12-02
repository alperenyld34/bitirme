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
    if (isset($_POST['yoneticiekle'])) {

        $guvenli_sifre = md5($_POST['sifre']);


        if ($_FILES['foto']["size"] > 0) {


            $dosyas = $_FILES["foto"];
            $kaynak = $_FILES["foto"]["tmp_name"];
            $dosya = $_FILES["foto"]["name"];
            $uzanti = explode(".", $_FILES[foto][name]);
            $random = rand(0, 9999999999999);
            $random2 = rand(0, 999);
            $yeni_isim = $random . "-" . $random2 . "-" . $dosya;
            $hedef = "../../../../assets/images/users/" . $yeni_isim;


            if ($dosyas['type'] == 'image/jpg' || $dosyas['type'] == 'image/jpeg' || $dosyas['type'] == 'image/png') {

                $gitti = move_uploaded_file($kaynak, $hedef);


                $kaydet = $db->prepare("INSERT INTO yonetici SET
        user_adi=:user_adi,
        pass_sifre=:pass_sifre,
        isim=:isim,
        foto=:foto
        ");
                $ekle = $kaydet->execute(array(
                    'user_adi' => $_POST['kullaniciadi'],
                    'pass_sifre' => $guvenli_sifre,
                    'isim' => $_POST['isim'],
                    'foto' => $yeni_isim
                ));
                if ($ekle) {

                    Header("location: ../../../pages.php?sayfa=yonetici&status=success");

                } else {

                    Header("location: ../../../pages.php?sayfa=yonetici&status=warning");

                }

            } else {
                Header("location: ../../../pages.php?sayfa=yoneticiekle&status=imgtype");
            }

        } else {


            $kaydet = $db->prepare("INSERT INTO yonetici SET
        user_adi=:user_adi,
        pass_sifre=:pass_sifre,
        isim=:isim,
        foto=:foto
        ");
            $ekle = $kaydet->execute(array(
                'user_adi' => $_POST['kullaniciadi'],
                'pass_sifre' => $guvenli_sifre,
                'isim' => $_POST['isim'],
                'foto' => $_POST['foto']
            ));
            if ($ekle) {

                Header("location: ../../../pages.php?sayfa=yonetici&status=success");

            } else {

                Header("location: ../../../pages.php?sayfa=yonetici&status=warning");

            }


        }


    }


}
?>


