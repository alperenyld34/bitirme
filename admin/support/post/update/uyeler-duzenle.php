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
    if (isset($_POST['uyedegis'])) {


        if($_POST['uyesifre'] == null  ) { 

            $guncelle = $db->prepare("UPDATE uyeler SET
                    isim=:isim,
                    soyisim=:soyisim,
                    eposta=:eposta,
                    telefon=:telefon,
                    tcno=:tcno,
                    cinsiyet=:cinsiyet
             WHERE id={$_POST['uye_id']}      
            ");
            $sonuc = $guncelle->execute(array(
                    'isim' => $_POST['isim'],
                'soyisim' => $_POST['soyisim'],
                'eposta' => $_POST['eposta'],
                'telefon' => $_POST['telefon'],
                'tcno' => $_POST['tcno'],
                'cinsiyet' => $_POST['cinsiyet']
            ));
            if($sonuc){
                header("location: ../../../pages.php?sayfa=uyeler&status=success");
            }else{
                Header("location: ../../../pages.php?sayfa=cookies&status=warning");
            }
        }

        if($_POST['uyesifre'] == !null  ) {
            $guncelle = $db->prepare("UPDATE uyeler SET
                    isim=:isim,
                    soyisim=:soyisim,
                    eposta=:eposta,
                    telefon=:telefon,
                    tcno=:tcno,
                    cinsiyet=:cinsiyet,
                    uyesifre=:uyesifre
             WHERE id={$_POST['uye_id']}      
            ");
            $sonuc = $guncelle->execute(array(
                'isim' => $_POST['isim'],
                'soyisim' => $_POST['soyisim'],
                'eposta' => $_POST['eposta'],
                'telefon' => $_POST['telefon'],
                'tcno' => $_POST['tcno'],
                'cinsiyet' => $_POST['cinsiyet'],
                'uyesifre' => md5($_POST['uyesifre'])
            ));
            if($sonuc){
                header("location: ../../../pages.php?sayfa=uyeler&status=success");
            }else{
                Header("location: ../../../pages.php?sayfa=cookies&status=warning");
            }
        }
    }else{
        header('Location:404');
    }
}

?>


