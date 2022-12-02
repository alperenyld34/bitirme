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
    if (isset($_POST['kargoekle'])) {

        $kaydet = $db->prepare("INSERT INTO kargo SET
        siparis_urun_id=:siparis_urun_id,
         kargo_adi=:kargo_adi,
        takip_no=:takip_no,
        sms_mesaj=:sms_mesaj,
        eposta_mesaj=:eposta_mesaj
        ");
        $ekle = $kaydet->execute(array(
            'siparis_urun_id' => $_POST['urun_id'],
            'kargo_adi' => $_POST['kargo_adi'],
            'takip_no' => $_POST['takip_no'],
            'sms_mesaj' => $_POST['sms_mesaj'],
            'eposta_mesaj' => $_POST['eposta_mesaj']
        ));
        if ($ekle) {

            Header("location: ../../../pages.php?sayfa=kargo&siparis_id=$_POST[siparis_id]&status=success");

        } else {

            Header("location: ../../../pages.php?sayfa=kargo&siparis_id=$_POST[siparis_id]&status=warning");

        }

    }

}

?>


