<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
ob_start(); //TODO BURADA VAR
session_start();
date_default_timezone_set( 'Europe/Istanbul' );
$settings=$db->prepare("SELECT * from ayarlar where id='1'");
$settings->execute(array(0));
$ayar=$settings->fetch(PDO::FETCH_ASSOC);
$siteurl = $ayar['site_url'];
$site_adi = $ayar['site_baslik'];
?>
<?php

if (isset($_POST['offerbutton'])) {

$isim = $_POST['ad_soyad'];
$eposta = $_POST['eposta'];
$tel = $_POST['telefon'];
$konu = $_POST['teklif_konu'];
$firma_bilgi = $_POST['firma_bilgileri'];
$icerik = $_POST['icerik'];
$timestamp = date('Y-m-d G:i:s');

    if($ayar['site_captcha'] == 1) {
        if ($_POST['secure_code'] == $_SESSION['secure_code']) {
            if ($_FILES['dosya']["size"] > 0) {
                if($isim && $eposta && $tel && $konu && $firma_bilgi && $icerik  ) {
                    if (filter_var($eposta, FILTER_VALIDATE_EMAIL)){
                        $random = rand(0, 9999999999999);
                        $random2 = rand(0, 999);
                        $kaynak = $_FILES["dosya"]["tmp_name"];
                        $dosyas = $_FILES["dosya"];
                        $dosya = $_FILES["dosya"]["name"];
                        $filename = trim(addslashes($_FILES['dosya']['name']));
                        $filename = str_replace(' ', '_', $filename);
                        $filename = str_replace('ş', 's', $filename);
                        $filename = str_replace('Ş', 's', $filename);
                        $filename = str_replace('ğ', 'g', $filename);
                        $filename = str_replace('Ğ', 'g', $filename);
                        $filename = str_replace('ü', 'u', $filename);
                        $filename = str_replace('Ü', 'u', $filename);
                        $filename = str_replace('ç', 'c', $filename);
                        $filename = str_replace('Ç', 'c', $filename);
                        $filename = str_replace('ö', 'o', $filename);
                        $filename = str_replace('Ö', 'o', $filename);
                        $filename = str_replace('İ', 'i', $filename);
                        $filename = preg_replace('/\s+/', '_', $filename);
                        $yeni_isim = $random . "-" . $random2 . "-" .$filename;
                        $hedef = "images/uploads/" . $yeni_isim;
                        if ($dosyas['type'] == 'image/jpg' || $dosyas['type'] == 'image/jpeg' || $dosyas['type'] == 'image/png' || $dosyas['type'] == 'image/gif' || $dosyas['type'] == 'application/pdf' || $dosyas['type'] == 'application/msword' ) {
                            $gitti = move_uploaded_file($kaynak, $hedef);
                            $kaydet = $db->prepare("INSERT INTO teklif_form SET
                         ad_soyad=:ad_soyad,
                         eposta=:eposta,
                         telefon=:telefon,
                         teklif_konu=:teklif_konu,
                         firma_bilgileri=:firma_bilgileri,
                         icerik=:icerik,
                         dosya=:dosya,
                         tarih=:tarih,
                         durum=:durum       
                        ");
                            $sonuc = $kaydet->execute(array(
                                'ad_soyad' => $isim,
                                'eposta' => $eposta,
                                'telefon' => $tel,
                                'teklif_konu' => $konu,
                                'firma_bilgileri' => $firma_bilgi,
                                'icerik' => $icerik,
                                'dosya' => $yeni_isim,
                                'tarih' => $timestamp,
                                'durum' => '1'
                            ));
                            if($sonuc){
                                $_SESSION['teklif_sonuc'] = 'success';
                               if($ayar['smtp_durum'] == '1'){
                                   include 'includes/post/mailtemp/teklif_mail_temp.php';
                               }
                                header('Location:'.$siteurl.'teklif-formu');
                            }else{
                                echo 'Veritabanı Hatası';
                            }
                        }else{
                            $_SESSION['teklif_sonuc'] = 'dosyatip';
                            header('Location:'.$siteurl.'teklif-formu');
                        }
                    }else{
                        $_SESSION['teklif_sonuc'] = 'eposta';
                        header('Location:'.$siteurl.'teklif-formu');
                    }
                }else{
                    $_SESSION['teklif_sonuc'] = 'bos';
                    header('Location:'.$siteurl.'teklif-formu');
                }
            }else{
                if($isim && $eposta && $tel && $konu && $firma_bilgi && $icerik  ) {
                    if (filter_var($eposta, FILTER_VALIDATE_EMAIL)){
                        $kaydet = $db->prepare("INSERT INTO teklif_form SET
                         ad_soyad=:ad_soyad,
                         eposta=:eposta,
                         telefon=:telefon,
                         teklif_konu=:teklif_konu,
                         firma_bilgileri=:firma_bilgileri,
                         icerik=:icerik,
                         tarih=:tarih,
                         durum=:durum       
                        ");
                        $sonuc = $kaydet->execute(array(
                            'ad_soyad' => $isim,
                            'eposta' => $eposta,
                            'telefon' => $tel,
                            'teklif_konu' => $konu,
                            'firma_bilgileri' => $firma_bilgi,
                            'icerik' => $icerik,
                            'tarih' => $timestamp,
                            'durum' => '1'
                        ));
                        if($sonuc){
                            $_SESSION['teklif_sonuc'] = 'success';
                            if($ayar['smtp_durum'] == '1'){
                                include 'includes/post/mailtemp/teklif_mail_temp.php';
                            }
                            header('Location:'.$siteurl.'teklif-formu');
                        }else{
                        echo 'Veritabanı Hatası';
                        }
                    }else{
                        $_SESSION['teklif_sonuc'] = 'eposta';
                        header('Location:'.$siteurl.'teklif-formu');
                    }
                }else{
                    $_SESSION['teklif_sonuc'] = 'bos';
                    header('Location:'.$siteurl.'teklif-formu');
                }
            }
        }else{
            $_SESSION['teklif_sonuc'] = 'secure';
            header('Location:'.$siteurl.'teklif-formu');
            unset($_SESSION['secure_code']);
        }
    }

    if($ayar['site_captcha'] == 0 || $ayar['site_captcha'] == null ) {
        if ($_FILES['dosya']["size"] > 0) {
            if ($isim && $eposta && $tel && $konu && $firma_bilgi && $icerik) {
                if (filter_var($eposta, FILTER_VALIDATE_EMAIL)){
                    $random = rand(0, 9999999999999);
                    $random2 = rand(0, 999);
                    $kaynak = $_FILES["dosya"]["tmp_name"];
                    $dosyas = $_FILES["dosya"];
                    $dosya = $_FILES["dosya"]["name"];
                    $filename = trim(addslashes($_FILES['dosya']['name']));
                    $filename = str_replace(' ', '_', $filename);
                    $filename = str_replace('ş', 's', $filename);
                    $filename = str_replace('Ş', 's', $filename);
                    $filename = str_replace('ğ', 'g', $filename);
                    $filename = str_replace('Ğ', 'g', $filename);
                    $filename = str_replace('ü', 'u', $filename);
                    $filename = str_replace('Ü', 'u', $filename);
                    $filename = str_replace('ç', 'c', $filename);
                    $filename = str_replace('Ç', 'c', $filename);
                    $filename = str_replace('ö', 'o', $filename);
                    $filename = str_replace('Ö', 'o', $filename);
                    $filename = str_replace('İ', 'i', $filename);
                    $filename = preg_replace('/\s+/', '_', $filename);
                    $yeni_isim = $random . "-" . $random2 . "-" .$filename;
                    $hedef = "images/uploads/" . $yeni_isim;
                    if ($dosyas['type'] == 'image/jpg' || $dosyas['type'] == 'image/jpeg' || $dosyas['type'] == 'image/png' || $dosyas['type'] == 'image/gif' || $dosyas['type'] == 'application/pdf' || $dosyas['type'] == 'application/msword' ) {
                        $gitti = move_uploaded_file($kaynak, $hedef);
                        $kaydet = $db->prepare("INSERT INTO teklif_form SET
                         ad_soyad=:ad_soyad,
                         eposta=:eposta,
                         telefon=:telefon,
                         teklif_konu=:teklif_konu,
                         firma_bilgileri=:firma_bilgileri,
                         icerik=:icerik,
                         dosya=:dosya,
                         tarih=:tarih,
                         durum=:durum       
                        ");
                        $sonuc = $kaydet->execute(array(
                            'ad_soyad' => $isim,
                            'eposta' => $eposta,
                            'telefon' => $tel,
                            'teklif_konu' => $konu,
                            'firma_bilgileri' => $firma_bilgi,
                            'icerik' => $icerik,
                            'dosya' => $yeni_isim,
                            'tarih' => $timestamp,
                            'durum' => '1'
                        ));
                        if($sonuc){
                            $_SESSION['teklif_sonuc'] = 'success';
                            if($ayar['smtp_durum'] == '1'){
                                include 'includes/post/mailtemp/teklif_mail_temp.php';
                            }
                            header('Location:'.$siteurl.'teklif-formu');
                        }else{
                            echo 'Veritabanı Hatası';
                        }
                    }else{
                        $_SESSION['teklif_sonuc'] = 'dosyatip';
                        header('Location:'.$siteurl.'teklif-formu');
                    }
                }else{
                    $_SESSION['teklif_sonuc'] = 'eposta';
                    header('Location:'.$siteurl.'teklif-formu');
                }
            }else{
                $_SESSION['teklif_sonuc'] = 'bos';
                header('Location:'.$siteurl.'teklif-formu');
            }
        }else{
            if ($isim && $eposta && $tel && $konu && $firma_bilgi && $icerik) {
                if (filter_var($eposta, FILTER_VALIDATE_EMAIL)){
                    $kaydet = $db->prepare("INSERT INTO teklif_form SET
                         ad_soyad=:ad_soyad,
                         eposta=:eposta,
                         telefon=:telefon,
                         teklif_konu=:teklif_konu,
                         firma_bilgileri=:firma_bilgileri,
                         icerik=:icerik,
                         tarih=:tarih,
                         durum=:durum       
                        ");
                    $sonuc = $kaydet->execute(array(
                        'ad_soyad' => $isim,
                        'eposta' => $eposta,
                        'telefon' => $tel,
                        'teklif_konu' => $konu,
                        'firma_bilgileri' => $firma_bilgi,
                        'icerik' => $icerik,
                        'tarih' => $timestamp,
                        'durum' => '1'
                    ));
                    if($sonuc){
                        $_SESSION['teklif_sonuc'] = 'success';
                        if($ayar['smtp_durum'] == '1'){
                            include 'includes/post/mailtemp/teklif_mail_temp.php';
                        }
                        header('Location:'.$siteurl.'teklif-formu');
                    }else{
                        echo 'Veritabanı Hatası';
                    }
                }else{
                    $_SESSION['teklif_sonuc'] = 'eposta';
                    header('Location:'.$siteurl.'teklif-formu');
                }
            }else{
                $_SESSION['teklif_sonuc'] = 'bos';
                header('Location:'.$siteurl.'teklif-formu');
            }
        }
    }
}
?>