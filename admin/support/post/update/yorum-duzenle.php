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
    if (isset($_POST['yorumdegis'])) {


        if ($_FILES['gorsel']["size"] > 0) {


            $dosyas = $_FILES["gorsel"];
            $kaynak = $_FILES["gorsel"]["tmp_name"];
            $dosya = $_FILES["gorsel"]["name"];
            $uzanti = explode(".", $_FILES['gorsel']['name']);
            $random = rand(0, 9999999999999);
            $random2 = rand(0, 999);
            $yeni_isim = $random . "-" . $random2 . "-" . $dosya;
            $hedef = "../../../../images/comments/" . $yeni_isim;


            if ($dosyas['type'] == 'image/jpg' || $dosyas['type'] == 'image/jpeg' || $dosyas['type'] == 'image/png') {

                $gitti = move_uploaded_file($kaynak, $hedef);


                $kaydet = $db->prepare("UPDATE yorum SET
            durum=:durum,
            isim=:isim,
            icerik=:icerik,
            star_rate=:star_rate,
            pozisyon=:pozisyon,
            tarih=:tarih,
            sira=:sira,
            gorsel=:gorsel
            WHERE id={$_POST['yorum_id']}
        ");
                $ekle = $kaydet->execute(array(
                    'durum' => $_POST['durum'],
                    'isim' => $_POST['isim'],
                    'icerik' => $_POST['icerik'],
                    'star_rate' => $_POST['star_rate'],
                    'pozisyon' => $_POST['pozisyon'],
                    'tarih' => $timestamp,
                    'sira' => $_POST['sira'],
                    'gorsel' => $yeni_isim
                ));
                if ($ekle) {

                    $resimsilunlink = $_POST['eski_gorsel'];
                    unlink("../../../../images/comments/$resimsilunlink");
                    Header("location: ../../../pages.php?sayfa=yorumlar&status=success");

                } else {

                    Header("location: ../../../pages.php?sayfa=yorumlar&status=warning");

                }

            } else {
                Header("location: ../../../pages.php?sayfa=yorum&yorum_id=$_POST[yorum_id]&status=imgtype");
            }

        } else {

            $kaydet = $db->prepare("UPDATE yorum SET
            durum=:durum,
            isim=:isim,
            icerik=:icerik,
            star_rate=:star_rate,
            pozisyon=:pozisyon,
            sira=:sira
            WHERE id={$_POST['yorum_id']}
        ");
            $ekle = $kaydet->execute(array(
                'durum' => $_POST['durum'],
                'isim' => $_POST['isim'],
                'icerik' => $_POST['icerik'],
                'star_rate' => $_POST['star_rate'],
                'pozisyon' => $_POST['pozisyon'],
                'sira' => $_POST['sira']
            ));
            if ($ekle) {

                Header("location: ../../../pages.php?sayfa=yorumlar&status=success");

            } else {

                Header("location: ../../../pages.php?sayfa=yorumlar&status=warning");

            }


        }


    }

}

?>


