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
    if (isset($_POST['bankadegis'])) {


        if ($_FILES['gorsel']["size"] > 0) {


            $dosyas = $_FILES["gorsel"];
            $kaynak = $_FILES["gorsel"]["tmp_name"];
            $dosya = $_FILES["gorsel"]["name"];
            $uzanti = explode(".", $_FILES['gorsel']['name']);
            $random = rand(0, 9999999999999);
            $random2 = rand(0, 999);
            $yeni_isim = $random . "-" . $random2 . "-" . $dosya;
            $hedef = "../../../../images/banka/" . $yeni_isim;


            if ($dosyas['type'] == 'image/jpg' || $dosyas['type'] == 'image/jpeg' || $dosyas['type'] == 'image/png') {

                $gitti = move_uploaded_file($kaynak, $hedef);


                $kaydet = $db->prepare("UPDATE banka SET
            durum=:durum,
            banka_adi=:banka_adi,
            hesap_sahibi=:hesap_sahibi,
            sube=:sube,
            hesap_no=:hesap_no,
            iban=:iban,
            sira=:sira,
            gorsel=:gorsel
            WHERE id={$_POST['banka_id']}
        ");
                $ekle = $kaydet->execute(array(
                    'durum' => $_POST['durum'],
                    'banka_adi' => $_POST['banka_adi'],
                    'hesap_sahibi' => $_POST['hesap_sahibi'],
                    'sube' => $_POST['sube'],
                    'hesap_no' => $_POST['hesap_no'],
                    'iban' => $_POST['iban'],
                    'sira' => $_POST['sira'],
                    'gorsel' => $yeni_isim
                ));
                if ($ekle) {

                    $gorseladres = $_POST['eski_gorsel'];
                    unlink("../../../../images/banka/$gorseladres");

                    Header("location: ../../../pages.php?sayfa=bankalar&status=success");

                } else {

                    Header("location: ../../../pages.php?sayfa=bankalar&status=warning");

                }

            } else {
                Header("location: ../../../pages.php?sayfa=banka&banka_id=$_POST[banka_id]&status=imgtype");
            }

        } else {


            $kaydet = $db->prepare("UPDATE banka SET
            durum=:durum,
            banka_adi=:banka_adi,
            hesap_sahibi=:hesap_sahibi,
            sube=:sube,
            hesap_no=:hesap_no,
            iban=:iban,
            sira=:sira
            WHERE id={$_POST['banka_id']}
        ");
            $ekle = $kaydet->execute(array(
                'durum' => $_POST['durum'],
                'banka_adi' => $_POST['banka_adi'],
                'hesap_sahibi' => $_POST['hesap_sahibi'],
                'sube' => $_POST['sube'],
                'hesap_no' => $_POST['hesap_no'],
                'iban' => $_POST['iban'],
                'sira' => $_POST['sira']
            ));
            if ($ekle) {

                Header("location: ../../../pages.php?sayfa=bankalar&status=success");

            } else {

                Header("location: ../../../pages.php?sayfa=bankalar&status=warning");

            }


        }


    }


}
?>


