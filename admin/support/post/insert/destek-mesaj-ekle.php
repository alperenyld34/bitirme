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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include_once '../../secure_post.php';
if ($adminsorgusu->rowCount()===0) {
    header("Location: 404");
} else {


if ( isset( $_POST[ 'msjgonder' ] ) ) {

$uye = $_POST['uye_id'];
$supportid = $_POST['support_id'];
$id = $_POST['normal_id'];
$mesaj =  trim(strip_tags($_POST['mesaj']));

    $uyesorgu = $db->prepare("select * from uyeler where id=:id ");
        $uyesorgu->execute(array(
            'id' => $uye
        ));
        $uyecek = $uyesorgu->fetch(PDO::FETCH_ASSOC);
        $mailadresi = $uyecek['eposta'];
        $isim = $uyecek['isim'];
        $soyisim = $uyecek['soyisim'];
        $sitemail = $ayar['site_mail'];
        $sitetel = $ayar['site_tel'];
        $siteadres = $ayar['adres_bilgisi'];
if($mesaj ) {

    $timestamp = date('Y-m-d G:i:s');
    /* mesajı gönder */
    $kaydet = $db->prepare("INSERT INTO uyeler_destek_mesaj SET
            support_id=:support_id,
            tip=:tip,
            mesaj=:mesaj,
            tarih=:tarih
    ");
    $sonuc = $kaydet->execute(array(
            'support_id' => $supportid,
        'tip' => '0',
        'mesaj' => $mesaj,
        'tarih' => $timestamp
    ));
    if($sonuc){
        header('Location:../../../pages.php?sayfa=talepincele&talep_id='.$id.'&status=success');
        /* desteğin durumunu 0 yap */
                $guncelle = $db->prepare("UPDATE uyeler_destek SET
                        durum=:durum
                 WHERE support_id={$supportid}      
                ");
                $sonuc = $guncelle->execute(array(
                    'durum' => '0',
                ));
        /* desteğin durumunu 0 yap SON */


        if($ayar['smtp_durum'] == '1' ) {

        /* Mail seçili ise kullanıcıya mail gönder */
                if($_POST['eposta'] == '1'  ) {
                    include '../../../../includes/phpmailer/Exception.php';
                    include '../../../../includes/phpmailer/PHPMailer.php';
                    include '../../../../includes/phpmailer//SMTP.php';

                    $site_adi = $ayar["site_baslik"];
                    $smtp_protokol = $ayar["smtp_protokol"];
                    $smtp_host = $ayar["smtp_host"];
                    $smtp_mail = $ayar["smtp_mail"];
                    $smtp_port = $ayar["smtp_port"];
                    $smtp_pass = $ayar["smtp_pass"];

                    $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->SMTPDebug = 0;
                    $mail->SMTPAuth = true;
                    $mail->Host = $smtp_host;
                    $mail->Username = $smtp_mail;
                    $mail->Password = $smtp_pass;
                    $mail->Port = $smtp_port;
                    $mail->CharSet  = "UTF-8";
                    if($ayar['smtp_protokol'] == 'tls' || $ayar['smtp_protokol'] == 'ssl') {
                        $mail->SMTPSecure =$smtp_protokol;
                    }

                    // Gönderici //
                    $mail->setFrom($smtp_mail, $site_adi);
                    // Alıcı //
                    $mail->AddBCC($mailadresi, "");
                    // Konu //
                    $mail->Subject = "Destek Talebiniz Cevaplandı";
                    // Mesaj //
                    $mail->isHTML();
                    $mail->Body = '<div style="width: 100%; background-color: #f8f8f8;">
    <div style="width: 570px; margin: 0 auto; background-color: #FFFFFF; font-family: \'Open Sans\', Arial; font-size: 14px; color: #333;">
        <div id="Header" style="padding: 55px 45px 35px 45px; box-sizing: border-box; border-bottom: 1px solid #ebebeb;">
            <div style="width: 100%; height: auto; overflow: hidden; font-size:20px; font-weight: 700; color:#000; margin-bottom: 28px;">
                DESTEK TALEBİNİZ CEVAPLANDI
            </div>
            <div style="width: 100%; height: auto;  overflow: hidden;  font-weight: 600; margin-bottom: 25px;">
               Sayın '.$isim.' '.$soyisim.',
                <br>
                <span style="font-weight: 400;">
                    #'.$supportid.' numaralı destek talebiniz destek birimimiz tarafından cevaplanmıştır. Lütfen mesaj içeriğini görebilmek için üye girişi yapın
                </span>
                <div style="width:100%; border-left:20px solid #EBEBEB; border-top:1px solid #EBEBEB; border-right:1px solid #EBEBEB; border-bottom:1px solid #EBEBEB; box-sizing:border-box; padding:10px; font-weight:400; font-size:13px; margin-top:25px;">
				'.$mesaj.'
				</div>
            </div>
            <div style="width: 100%; height: auto;  overflow: hidden;">
                <a style="display: inline-block; width: auto; padding: 10px 25px; background-color: #ff0c29; font-size: 14px; font-weight: bold; color: #FFF; font-family: \'Open Sans\', Arial; text-decoration: none; " href="' .$siteurl. 'uye-girisi">
                 GİRİŞ YAPIN
                </a>
            </div>
        </div>
        <div id="Footer" style="padding: 35px 45px; font-family: \'Open Sans\', Arial; font-size: 13px; color: #afafaf;">
            ' .$sitetel. '
            <br>
            <a href="' .$sitemail. '" style="text-decoration: none; color: #afafaf;">' .$sitemail. '</a>
            <br>
            ' .$siteadres. '
            <br>
            <a href="' .$siteurl. '" style="text-decoration: none; color: #afafaf; font-weight: bold;">' .$siteurl. '</a>
        </div>
    </div>
</div>';

                    if($mail->send()) {} else { }
                }
        /* Mail seçili ise kullanıcıya mail gönder SON */
        }


    }else{
    echo 'Veritabanı Hatası';
    }
    /* mesajı gönder SON */
}else{
    header('Location:../../../pages.php?sayfa=talepincele&talep_id='.$id.'&status=warning');
}
}else{
    header('Location:404');
}
}
?>


