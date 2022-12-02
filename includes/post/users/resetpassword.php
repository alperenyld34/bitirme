<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['reset'])) {

    $eposta = trim(strip_tags($_POST['emailadress']));
    if($eposta ) {
        if(filter_var($eposta, FILTER_VALIDATE_EMAIL)){
/* Bu mail adresi üyelerde var mı kontrolü  */
            $uyeler = $db->prepare("select * from uyeler where eposta=:eposta ");
                $uyeler->execute(array(
                    'eposta' => $eposta
                ));
                $uye = $uyeler->fetch(PDO::FETCH_ASSOC);
                $isim = $uye['isim'];
                $soyisim = $uye['soyisim'];
                $sitemail = $ayar['site_mail'];
                $sitetel = $ayar['site_tel'];
                $siteadres = $ayar['adres_bilgisi'];
                if($uyeler->rowCount() >0  ) {

                    /* İşlemler Burada */

                    $randomkey = md5(session_id());
                    $_SESSION['epostareset'] = $randomkey;
                    $_SESSION['uyeids'] = $uye['id'];
                            /* Mail Gönder */
                    include 'includes/phpmailer/Exception.php';
                    include 'includes/phpmailer/PHPMailer.php';
                    include 'includes/phpmailer/SMTP.php';
                    // Siteye Bildirim Gönder //
                    $smtp_protokol = $ayar["smtp_protokol"];
                    $smtp_host = $ayar["smtp_host"];
                    $smtp_mail = $ayar["smtp_mail"];
                    $smtp_port = $ayar["smtp_port"];
                    $smtp_pass = $ayar["smtp_pass"];
                    $smtp_alici_mail = $uye['eposta'];


                    $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->SMTPDebug = 0;
                    $mail->SMTPAuth = true;
                    $mail->Host = $smtp_host;
                    $mail->Username = $smtp_mail;
                    $mail->Password = $smtp_pass;
                    $mail->Port = $smtp_port;
                    $mail->CharSet  = "utf-8";
                    if($ayar['smtp_protokol'] == 'tls' || $ayar['smtp_protokol'] == 'ssl') {
                        $mail->SMTPSecure =$smtp_protokol;
                    }
                    // Gönderici //
                    $mail->setFrom($smtp_mail, $site_adi);
                    // Alıcı //
                    $mail->AddBCC($smtp_alici_mail, "");
                    // Konu //
                    $mail->Subject = "Şifrenizi Sıfırlayın";
                    // Mesaj //
                    $mail->isHTML();
                    $mail->Body = '<div style="width: 100%; background-color: #f8f8f8;">
    <div style="width: 570px; margin: 0 auto; background-color: #FFFFFF; font-family: \'Open Sans\', Arial; font-size: 14px; color: #333;">
        <div id="Header" style="padding: 55px 45px 35px 45px; box-sizing: border-box; border-bottom: 1px solid #ebebeb;">
            <div style="width: 100%; height: auto; overflow: hidden; font-size:20px; font-weight: 700; color:#000; margin-bottom: 28px;">
                YENİ ŞİFRE BELİRLEME
            </div>
            <div style="width: 100%; height: auto;  overflow: hidden;  font-weight: 600; margin-bottom: 25px;">
               Sayın '.$isim.' '.$soyisim.',
                <br>
                <span style="font-weight: 400;">
                    Şifrenizi yeniden oluşturmak için aşağıdaki linke tıklayınız.
                </span>
            </div>
            <div style="width: 100%; height: auto;  overflow: hidden;">
                <a style="display: inline-block; width: auto; padding: 10px 25px; background-color: #ff0c29; font-size: 14px; font-weight: bold; color: #FFF; font-family: \'Open Sans\', Arial; text-decoration: none; " href="' .$siteurl. 'password-reset?key=' .$randomkey. '">
                ŞİFRENİZİ DEĞİŞTİRİN
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

                    if($mail->send()) {

                        header("location: ".$siteurl."sifremi-unuttum");
                        $_SESSION['successpost'] = 'suc';

                    } else {

                        header("location: ".$siteurl."sifremi-unuttum");
                        $_SESSION['successpost'] ='problem';

                    }
                    /* Mail Gönder SON */


           /* İşlemler Burada SON */
                }else{
                    $_SESSION['hata'] = 'epostayok';
                    header('Location:'.$siteurl.'sifremi-unuttum');
                }
        }else{
            $_SESSION['hata'] = 'hata';
            header('Location:'.$siteurl.'sifremi-unuttum');
        }
    }else{
        header('Location:404');
    }
}
?>