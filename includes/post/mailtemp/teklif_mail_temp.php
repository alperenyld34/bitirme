<?php //TODO Burada var
// Siteye Bildirim ////////////////
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
$smtp_bildirim_mail = $ayar["smtp_bildirim_mail"];
$smtp_alici_mail = $eposta;

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
$mail->AddBCC($smtp_bildirim_mail, "");
// Konu //
$mail->Subject = "Yeni Bir Teklif Talebi Var!";
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
            <p style='margin-left:20px; font-size:18px; color:#000;'>Yeni Bir Teklif Talebi Var</p>
        </div>
        <div style='width:100%; height:auto; overflow:hidden; margin-top:17px; margin-bottom:17px;'>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                Talebi Gönderen : <b>" . $isim . "</b>
            </div>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                E-Posta Adresi : <a href='mailto:" . $eposta . "' style='color:#17AD8B;'><b>" . $eposta . "</b></a>
            </div>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                Telefon : <b>" . $tel . "</b>
            </div>
        </div>
        <div style='width:100%; height:auto; overflow:hidden; margin-bottom:25px;'>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#8C8C8C; '>
                Teklif talebini görmek için lütfen panelinize giriş yapınız.
            </div>
        </div>
        <div style='width:100%; height:auto; overflow:hidden; margin-bottom:30px;'>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#8C8C8C; '>
                <a href='" . $siteadres . "systemx/' style='color:#17AD8B; '>Yönetim Paneline Git</a>
            </div>
        </div>


    </div>
    <div style='background-color:#50E3C2; width:420px; height:auto; border:2px solid #50E3C2;  margin:0px auto; padding-top:15px; padding-bottom:15px; text-align:center; font-size:14px; font-weight:bold; color:#FFF; line-height:25px;'>
        " . $site_adi . "
    </div>
</div>
                          
                          ";

if($mail->send()) {
} else {
}

// Siteye Bildirim Ending //////////////////////////////////////////////






// Müşteriye Bildirim //

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
$mail->Subject = "Teklif Talebiniz Bize Ulaştı";
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
			<p style='margin-left:20px; font-size:18px; color:#000;'>Teklif Talebiniz Bize Ulaştı</p>
		</div>
		<div style='width:100%; height:auto; overflow:hidden; margin-top:17px; margin-bottom:17px;'>
			<div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
			Sayın <b>" . $isim . "</b>,
			</div>
		</div>
			<div style='width:100%; height:auto; overflow:hidden; margin-bottom:25px;'>
			<div style='margin-left:20px; width:88%; font-size:13px; color:#8C8C8C; '>
			Teklif talebiniz ekibimize ulaşmıştır. En kısa sürede iletişim bilgileriniz dahilinde tarafınıza dönüş sağlanacaktır
			</div>
		</div>

	</div>
	<div style='background-color:#50E3C2; width:420px; height:auto; border:2px solid #50E3C2;  margin:0px auto; padding-top:15px; padding-bottom:15px; text-align:center; font-size:14px; font-weight:bold; color:#FFF; line-height:25px;'>
	" . $site_adi . "
	</div>
</div>
                          ";

if($mail->send()) { } else { }



// Müşteriye Bildirim Ending ////////////////////////////////////////////////////////////////////////////////////////

?>