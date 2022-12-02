<?php
$settings=$db->prepare("SELECT * from ayarlar where id='1'");
$settings->execute(array(0));
$ayar=$settings->fetch(PDO::FETCH_ASSOC);
$siteurl = $ayar['site_url'];
?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['usersave'])){


if($ayar['site_captcha'] == 1) {
    if($_POST['secure_code']==$_SESSION['secure_code']){

        $isim = trim(strip_tags($_POST['namearea']));
        $soyisim = trim(strip_tags($_POST['surnamearea']));
        $telefon = trim(strip_tags($_POST['phonearea']));
        $eposta = trim(strip_tags($_POST['emailarea']));
        $sifre1 = md5($_POST['password']);
        $sifre2 = md5($_POST['passwordverify']);
        $tc = trim(strip_tags($_POST['tcnumber']));
        $cinsiyet = trim(strip_tags($_POST['cinsiyet']));

        if( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }
        $timestamp = date('Y-m-d G:i:s');

        if ($isim && $soyisim && $telefon && $eposta && $sifre1 && $sifre1 && $sifre2){
            /* E-Posta Geçerliliği Kontrolü */
            if (filter_var($eposta, FILTER_VALIDATE_EMAIL)){
                /* Eposta Benzerliği Kontrolü */
                $uyeleriKontrol = $db->prepare("select * from uyeler where eposta=:eposta");
                $uyeleriKontrol->execute(array(
                    'eposta' => $eposta
                ));
                if ($uyeleriKontrol->rowCount()>0) {
                    $_SESSION['uyelik_sorun'] = '<strong>HATA!</strong> Bu E-Posta Adresi Sistemde Kayıtlıdır';
                    header('Location:uyelik');
                }else{
                    /* Şifre Kontrolü  */
                    if ($sifre1 == $sifre2) {
                        /* Üye kayıt DB Insert İşlemi */
                        $kaydet = $db->prepare("INSERT INTO uyeler SET
                        isim=:isim,
                        soyisim=:soyisim,
                        telefon=:telefon,
                        eposta=:eposta,
                        tcno=:tcno,
                        cinsiyet=:cinsiyet,
                        uyesifre=:uyesifre,
                        ip=:ip,
                        tarih=:tarih
                        ");
                        $ekle = $kaydet->execute(array(
                            'isim' => $isim,
                            'soyisim' => $soyisim,
                            'telefon' => $telefon,
                            'eposta' => $eposta,
                            'tcno' => $tc,
                            'cinsiyet' => $cinsiyet,
                            'uyesifre' => $sifre1,
                            'ip' => $ip,
                            'tarih' => $timestamp
                        ));
                        if ($ekle) {
                            
                            /* E-postayı E-Bültene Ekle */
                            if($uyeayar['eposta_ekle'] == '1' ) { 
                             $ebulteneekle = $db->prepare("INSERT INTO ebulten SET
                                  eposta=:eposta   
                             ");
                             $ebulteneekle->execute(array(
                                 'eposta' => $eposta
                             ));
                            }
                            /* E-postayı E-Bültene Ekle SON */

                            /* Numarayı SMS Rehberine Ekle */
                            if($uyeayar['sms_ekle'] == '1' ) {
                                $smsekle = $db->prepare("INSERT INTO sms_numaralar SET
                                  isim=:isim,
                                  gsm=:gsm   
                             ");
                                $smsekle->execute(array(
                                    'isim' => $isim." ".$soyisim,
                                    'gsm' => $telefon,
                                ));
                            }
                            /* Numarayı SMS Rehberine Ekle SON */


                            if ($ayar['smtp_durum'] == 1) {
                                /* E-Posta ile Bilgilendirme Servisi */
                                include 'includes/phpmailer/Exception.php';
                                include 'includes/phpmailer/PHPMailer.php';
                                include 'includes/phpmailer/SMTP.php';
                                $siteadres = $ayar['site_url'];
                                $sitelogo = $ayar['site_logo'];
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
                                $mail->CharSet = "utf-8";
                                if ($ayar['smtp_protokol'] == 'tls' || $ayar['smtp_protokol'] == 'ssl') {
                                    $mail->SMTPSecure = $smtp_protokol;
                                }

                                // Gönderici //
                                $mail->setFrom($smtp_mail, $site_adi);
                                // Alıcı //
                                $mail->AddBCC($eposta, "");
                                // Konu //
                                $mail->Subject = "Yeni Üyelik Oluşturuldu";
                                // Mesaj //
                                $mail->isHTML();
                                $mail->Body = "

<div style='width:100%; background-color:#F6F4F5; padding-top:35px; padding-bottom:35px;'>
    <div style='background-color:#FFF; width:420px; height:auto; border:2px solid #50E3C2;  margin:0px auto;'>
        <div style='width:100%; overflow:hidden; height:auto;'>
            <div style='width:100%; height:73px; overflow:hidden; border-bottom:1px solid #EBEBEB; display:table; '><div style='display:table-cell; vertical-align:middle;'>
                    <div style='width:30%; height:auto;display:inline-block; vertical-align:middle;'><img src='" . $siteadres . "images/logo/" . $sitelogo . "' style='margin-left:20px; height:28px; '></div><div style='width:70%; display:inline-block; vertical-align:middle; height:auto; text-align:right; font-size:12px;  '>
                        <a href='mailto:" . $smtp_mail . "' style='color:#707070; text-decoration:none; padding-right:20px;'>" . $smtp_mail . "</a>
                    </div>
                </div>
            </div>
        </div>
        <div style='width:100%; overflow:hidden; padding-bottom:0px; padding-top:0px; border-bottom:1px solid #EBEBEB;  '>
            <p style='margin-left:20px; font-size:18px; color:#000;'>Üyeliğiniz Başarıyla Oluşturuldu</p>
        </div>
        <div style='width:100%; height:auto; overflow:hidden; margin-top:17px; margin-bottom:17px;'>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                Sayın <b>" . $isim. " " . $soyisim. "</b>,
            </div>
        </div>
        <div style='width:100%; height:auto; overflow:hidden; margin-bottom:25px;'>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#8C8C8C; '>
                Sitemize kaydınız başarılı bir şekilde oluşturulmuştur. Hesabınızla ilgili bilgi ve değişiklikler için lütfen sitemize giriş yapınız.
                <br><br>
                Üye olduğunuz için teşekkür ederiz.
            </div>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#8C8C8C; margin-top:20px; '>
            <a href='" . $siteadres . "uye-girisi' style='color:#000; text-decoration: underline'>Üye Girişi Yapmak İçin Tıklayın</a>
            </div>
        </div>

    </div>
    <div style='background-color:#50E3C2; width:420px; height:auto; border:2px solid #50E3C2;  margin:0px auto; padding-top:15px; padding-bottom:15px; text-align:center; font-size:14px; font-weight:bold; color:#FFF; line-height:25px;'>
        " . $site_adi . "
    </div>
</div>
                          
                          ";

                                if ($mail->send()) {
                                } else {
                                }
                                /* E-Posta ile Bilgilendirme Servisi Son */
                            }







                            $_SESSION['uyelik_basarili'] = 'success';
                            $_SESSION['user_email_address'] = $eposta;
                            header("location: ".$siteurl."index.html");
                        } else {
                            header("location: ".$siteurl."uyelik");
                        }
                        /* Üye Kayıt son */
                    }else {
                        header('Location:uyelik');
                        $sorun = '<strong>HATA!</strong> Girdiğiniz şifreler birbirinden farklı!';
                        $_SESSION['uyelik_sorun'] = $sorun;
                    }
                    /* Şifre Kontrolü  */
                }
                /* Eposta Benzerliği Kontrolü Son */
            }else{
                header('Location:uyelik');
                $sorun = '<strong>HATA!</strong> Lütfen geçerli bir e-posta adresi girin';
                $_SESSION['uyelik_sorun'] = $sorun;
            }
            /* E-Posta Geçerliliği Kontrolü Son */
        }else{
            header('Location:uyelik');
            $sorun = '<strong>HATA!</strong> * işaretli tüm alanları doldurmalısınız';
            $_SESSION['uyelik_sorun'] = $sorun;
        }



        unset($_SESSION['secure_code']);
    }else{
        $_SESSION['uyelik_sorun'] = '<strong>HATA!</strong> Güvenlik kodunu yanlış girdiniz';
        header('Location:uyelik');
        unset($_SESSION['secure_code']);
    }


}



if($ayar['site_captcha'] == 0 || $ayar['site_captcha'] == null ) {


    $isim = trim(strip_tags($_POST['namearea']));
    $soyisim = trim(strip_tags($_POST['surnamearea']));
    $telefon = trim(strip_tags($_POST['phonearea']));
    $eposta = trim(strip_tags($_POST['emailarea']));
    $sifre1 = md5($_POST['password']);
    $sifre2 = md5($_POST['passwordverify']);
    $tc = trim(strip_tags($_POST['tcnumber']));
    $cinsiyet = trim(strip_tags($_POST['cinsiyet']));

    if( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }
    $timestamp = date('Y-m-d G:i:s');

    if ($isim && $soyisim && $telefon && $eposta && $sifre1 && $sifre1 && $sifre2){
        /* E-Posta Geçerliliği Kontrolü */
        if (filter_var($eposta, FILTER_VALIDATE_EMAIL)){
            /* Eposta Benzerliği Kontrolü */
            $uyeleriKontrol = $db->prepare("select * from uyeler where eposta=:eposta");
            $uyeleriKontrol->execute(array(
                'eposta' => $eposta
            ));
            if ($uyeleriKontrol->rowCount()>0) {
                $_SESSION['uyelik_sorun'] = '<strong>HATA!</strong> Bu E-Posta Adresi Sistemde Kayıtlıdır';
                header('Location:uyelik');
            }else{
                /* Şifre Kontrolü  */
                if ($sifre1 == $sifre2) {
                    /* Üye kayıt DB Insert İşlemi */
                    $kaydet = $db->prepare("INSERT INTO uyeler SET
                        isim=:isim,
                        soyisim=:soyisim,
                        telefon=:telefon,
                        eposta=:eposta,
                        tcno=:tcno,
                        cinsiyet=:cinsiyet,
                        uyesifre=:uyesifre,
                        ip=:ip,
                        tarih=:tarih
                        ");
                    $ekle = $kaydet->execute(array(
                        'isim' => $isim,
                        'soyisim' => $soyisim,
                        'telefon' => $telefon,
                        'eposta' => $eposta,
                        'tcno' => $tc,
                        'cinsiyet' => $cinsiyet,
                        'uyesifre' => $sifre1,
                        'ip' => $ip,
                        'tarih' => $timestamp
                    ));
                    if ($ekle) {



                        /* E-postayı E-Bültene Ekle */
                        if($uyeayar['eposta_ekle'] == '1' ) {
                            $ebulteneekle = $db->prepare("INSERT INTO ebulten SET
                                  eposta=:eposta   
                             ");
                            $ebulteneekle->execute(array(
                                'eposta' => $eposta
                            ));
                        }
                        /* E-postayı E-Bültene Ekle SON */

                        /* Numarayı SMS Rehberine Ekle */
                        if($uyeayar['sms_ekle'] == '1' ) {
                            $smsekle = $db->prepare("INSERT INTO sms_numaralar SET
                                  isim=:isim,
                                  gsm=:gsm  
                             ");
                            $smsekle->execute(array(
                                'isim' => $isim." ".$soyisim,
                                'gsm' => $telefon,
                            ));
                        }
                        /* Numarayı SMS Rehberine Ekle SON */




                        if ($ayar['smtp_durum'] == 1) {
                            /* E-Posta ile Bilgilendirme Servisi */
                            include 'includes/phpmailer/Exception.php';
                            include 'includes/phpmailer/PHPMailer.php';
                            include 'includes/phpmailer/SMTP.php';
                            $siteadres = $ayar['site_url'];
                            $sitelogo = $ayar['site_logo'];
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
                            $mail->CharSet = "utf-8";
                            if ($ayar['smtp_protokol'] == 'tls' || $ayar['smtp_protokol'] == 'ssl') {
                                $mail->SMTPSecure = $smtp_protokol;
                            }

                            // Gönderici //
                            $mail->setFrom($smtp_mail, $site_adi);
                            // Alıcı //
                            $mail->AddBCC($eposta, "");
                            // Konu //
                            $mail->Subject = "Yeni Üyelik Oluşturuldu";
                            // Mesaj //
                            $mail->isHTML();
                            $mail->Body = "

<div style='width:100%; background-color:#F6F4F5; padding-top:35px; padding-bottom:35px;'>
    <div style='background-color:#FFF; width:420px; height:auto; border:2px solid #50E3C2;  margin:0px auto;'>
        <div style='width:100%; overflow:hidden; height:auto;'>
            <div style='width:100%; height:73px; overflow:hidden; border-bottom:1px solid #EBEBEB; display:table; '><div style='display:table-cell; vertical-align:middle;'>
                    <div style='width:30%; height:auto;display:inline-block; vertical-align:middle;'><img src='" . $siteadres . "images/logo/" . $sitelogo . "' style='margin-left:20px; height:28px; '></div><div style='width:70%; display:inline-block; vertical-align:middle; height:auto; text-align:right; font-size:12px;  '>
                        <a href='mailto:" . $smtp_mail . "' style='color:#707070; text-decoration:none; padding-right:20px;'>" . $smtp_mail . "</a>
                    </div>
                </div>
            </div>
        </div>
        <div style='width:100%; overflow:hidden; padding-bottom:0px; padding-top:0px; border-bottom:1px solid #EBEBEB;  '>
            <p style='margin-left:20px; font-size:18px; color:#000;'>Üyeliğiniz Başarıyla Oluştruldu</p>
        </div>
        <div style='width:100%; height:auto; overflow:hidden; margin-top:17px; margin-bottom:17px;'>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                Sayın <b>" . $isim. " " . $soyisim. "</b>,
            </div>
        </div>
        <div style='width:100%; height:auto; overflow:hidden; margin-bottom:25px;'>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#8C8C8C; '>
                Sitemize kaydınız başarılı bir şekilde oluşturulmuştur. Hesabınızla ilgili bilgi ve değişiklikler için lütfen sitemize giriş yapınız.
                <br><br>
                Üye olduğunuz için teşekkür ederiz.
            </div>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#8C8C8C; margin-top:20px; '>
            <a href='" . $siteadres . "uye-girisi' style='color:#000; text-decoration: underline'>Üye Girişi Yapmak İçin Tıklayın</a>
            </div>
        </div>

    </div>
    <div style='background-color:#50E3C2; width:420px; height:auto; border:2px solid #50E3C2;  margin:0px auto; padding-top:15px; padding-bottom:15px; text-align:center; font-size:14px; font-weight:bold; color:#FFF; line-height:25px;'>
        " . $site_adi . "
    </div>
</div>
                          
                          ";

                            if ($mail->send()) {
                            } else {
                            }
                            /* E-Posta ile Bilgilendirme Servisi Son */
                        }






                        $_SESSION['uyelik_basarili'] = 'success';
                        $_SESSION['user_email_address'] = $eposta;
                        header("location: ".$siteurl."index.html");
                    } else {
                        header("location: ".$siteurl."uyelik");
                    }
                    /* Üye Kayıt son */
                }else {
                    header('Location:uyelik');
                    $sorun = '<strong>HATA!</strong> Girdiğiniz şifreler birbirinden farklı!';
                    $_SESSION['uyelik_sorun'] = $sorun;
                }
                /* Şifre Kontrolü  */
            }
            /* Eposta Benzerliği Kontrolü Son */
        }else{
            header('Location:uyelik');
            $sorun = '<strong>HATA!</strong> Lütfen geçerli bir e-posta adresi girin';
            $_SESSION['uyelik_sorun'] = $sorun;
        }
        /* E-Posta Geçerliliği Kontrolü Son */
    }else{
        header('Location:uyelik');
        $sorun = '<strong>HATA!</strong> * işaretli tüm alanları doldurmalısınız';
        $_SESSION['uyelik_sorun'] = $sorun;
    }

}





} else {
    header('Location:index.html');
}
?>

