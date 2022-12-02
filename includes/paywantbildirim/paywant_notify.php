<?php include "../config/config.php";
$odemesettings=$db->prepare("SELECT * from odeme_ayar where id='1'");
$odemesettings->execute(array(0));
$odemeayar=$odemesettings->fetch(PDO::FETCH_ASSOC);
$settings=$db->prepare("SELECT * from ayarlar where id='1'");
$settings->execute(array(0));
$ayar=$settings->fetch(PDO::FETCH_ASSOC);
$smssettings=$db->prepare("SELECT * from sms where id='1'");
$smssettings->execute(array(0));
$smsayar=$smssettings->fetch(PDO::FETCH_ASSOC);

$paywant_key = $odemeayar["paywant_key"];
$paywant_secret = $odemeayar["paywant_secret"];
?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
	date_default_timezone_set('Europe/Istanbul');

	$apiKey		= $paywant_key;
	$apiSecret 	= $paywant_secret;

	/***********************************************************************************************
	/// UYARI UYARI UYARI UYARI UYARI UYARI UYARI UYARI UYARI UYARI UYARI UYARI UYARI UYARI UYARI
	/// BU KODLAR ÖRNEK AMAÇLIDIR. GÜVENLİK ZAAFİYETİ DOĞURABİLİR!
	/// POST ile gelen verileri güvenli bir şekilde veritabanına aktarmanızı öneririz.
	/// Aşağıdaki örnekteki kullanımı güvenlik filtrelerinden geçirmeden kullanmanız durumunda SQL Injection zaafiyetine sebep olabilirsiniz.
	/// Lütfen bu değerleri bozulmayacak şekilde filtreleyerek süzünüz.
	/// Aksi durumda 3. kişilerin bu adrese ulaşarak sisteminize zarar verebileceğini unutmayınız.
	************************************************************************************************/
	if($_POST){

	  $SiparisID = $_POST["SiparisID"];
	  $ExtraData= $_POST["ExtraData"];
	  $UserID= $_POST["UserID"];
	  $ReturnData= $_POST["ReturnData"];
	  $Status= $_POST["Status"];
	  $OdemeKanali= $_POST["OdemeKanali"];
	  $OdemeTutari= $_POST["OdemeTutari"];
	  $NetKazanc= $_POST["NetKazanc"];
	  $Hash= $_POST["Hash"];

	   if($SiparisID == "" || $ExtraData == "" || $UserID == "" || $ReturnData == "" || $Status == "" || $OdemeKanali == "" || $OdemeTutari == "" || $NetKazanc == "" || $Hash == "")
	   {
		  echo "eksik veri";
		  exit();
	   }


	$hashKontrol = base64_encode(hash_hmac('sha256',"$SiparisID|$ExtraData|$UserID|$ReturnData|$Status|$OdemeKanali|$OdemeTutari|$NetKazanc".$apiKey,$apiSecret,true));
	  if($Hash != $hashKontrol)
	   exit("hash hatali");



        $siparisiGuncelle = $db->prepare("UPDATE siparis SET siparis_durum = '0' WHERE siparis_no='$ExtraData'  ");
        $siparisiGuncelle->execute();

        $timestamp = date('Y-m-d G:i:s');

        $siparisTarih = $db->prepare("UPDATE siparis SET siparis_tarih = '$timestamp' WHERE siparis_no='$ExtraData'  ");
        $siparisTarih->execute();

        $siparisCek = $db->prepare("select * from siparis where siparis_no='$ExtraData' ");
        $siparisCek->rowCount();
        $rows = $siparisCek->fetch(PDO::FETCH_ASSOC);


        // Mail Gönder //
if($ayar['smtp_durum']==1) {

    include '../phpmailer/Exception.php';
    include '../phpmailer/PHPMailer.php';
    include '../phpmailer/SMTP.php';


    $siteadres = $ayar['site_url'];
    $sitelogo = $ayar['site_logo'];
    $site_adi = $ayar["site_baslik"];
    $smtp_protokol = $ayar["smtp_protokol"];
    $smtp_host = $ayar["smtp_host"];
    $smtp_mail = $ayar["smtp_mail"];
    $smtp_port = $ayar["smtp_port"];
    $smtp_pass = $ayar["smtp_pass"];
    $smtp_bildirim_mail = $ayar["smtp_bildirim_mail"];
    $smtp_alici_mail = $row["eposta"];


    // Siteye bildirim gönder //
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
    $mail->Subject = "Yeni Bir Siparişiniz Var!";
    // Mesaj //
    $mail->isHTML();
    $mail->Body = "
        <div style='width:100%; background-color:#F6F4F5; padding-top:35px; padding-bottom:35px;'>
	<div style='background-color:#FFF; width:420px; height:auto; border:2px solid #50E3C2;  margin:0px auto;'>
		<div style='width:100%; overflow:hidden; height:auto;'>
		<div style='width:100%; height:73px; overflow:hidden; border-bottom:1px solid #EBEBEB; display:table; '><div style='display:table-cell; vertical-align:middle;'>
				<div style='width:30%; height:auto;display:inline-block; vertical-align:middle;'><img src='".$siteadres."images/logo/".$sitelogo."' style='margin-left:20px; height:28px; '></div><div style='width:70%; display:inline-block; vertical-align:middle; height:auto; text-align:right; font-size:12px;  '>
					<a href='mailto:".$smtp_mail."' style='color:#707070; text-decoration:none; padding-right:20px;'>".$smtp_mail."</a>
				</div>
		</div>
		</div>
		</div>
		<div style='width:100%; overflow:hidden; padding-bottom:0px; padding-top:0px; border-bottom:1px solid #EBEBEB;  '>
			<p style='margin-left:20px; font-size:18px; color:#000;'>Yeni Bir Sipariş Var!</p>
		</div>
		<div style='width:100%; height:auto; overflow:hidden; margin-top:17px; margin-bottom:17px;'>
			<div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
			Siparişi Gönderen : <b>".$rows['isim']."</b>
			</div>
			<div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
			E-Posta Adresi : <a href='mailto:".$rows['eposta']."' style='color:#17AD8B;'><b>".$rows['eposta']."</b></a>
			</div>		
			<div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
			Telefon : <b>".$rows['tel']."</b>
			</div>	
			<div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
			Sipariş Numarası : #<b>".$rows['siparis_no']."</b>
			</div>		
			<div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
			Toplam Tutar : <b>".number_format($rows['toplam_tutar'], 2)." TL</b>
			</div>					
		    <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
			Ödeme Yöntemi : <b>Kredi Kartı/Banka Kartı</b>
			</div>				
		</div>
		<div style='width:100%; height:auto; overflow:hidden; margin-bottom:25px;'>
			<div style='margin-left:20px; width:88%; font-size:13px; color:#8C8C8C; '>
			Siparişi görmek için lütfen yönetim panelinize giriş yapın ve siparişler bölümüne girin.
			</div>			
		</div>
		<div style='width:100%; height:auto; overflow:hidden; margin-bottom:30px;'>
			<div style='margin-left:20px; width:88%; font-size:13px; color:#8C8C8C; '>
			<a href='".$siteadres."systemx/' style='color:#17AD8B; '>Yönetim Paneline Git</a>
			</div>			
		</div>

		
	</div>
	<div style='background-color:#50E3C2; width:420px; height:auto; border:2px solid #50E3C2;  margin:0px auto; padding-top:15px; padding-bottom:15px; text-align:center; font-size:14px; font-weight:bold; color:#FFF; line-height:25px;'>
	".$site_adi."
	</div>
</div>
        
        ";

    if($mail->send())
    {} else {}

    // Siteye bildirim gönder Ending /////////////////





    // Alıcıya Mail Gönder //
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
    $mail->Subject = "Siparişiniz Oluşturuldu";
    // Mesaj //
    $mail->isHTML();
    $mail->Body = "
  <div style='width:100%; background-color:#F6F4F5; padding-top:35px; padding-bottom:35px;'>
	<div style='background-color:#FFF; width:420px; height:auto; border:2px solid #50E3C2;  margin:0px auto;'>
		<div style='width:100%; overflow:hidden; height:auto;'>
		<div style='width:100%; height:73px; overflow:hidden; border-bottom:1px solid #EBEBEB; display:table; '><div style='display:table-cell; vertical-align:middle;'>
				<div style='width:30%; height:auto;display:inline-block; vertical-align:middle;'><img src='".$siteadres."images/logo/".$sitelogo."' style='margin-left:20px; height:28px; '></div><div style='width:70%; display:inline-block; vertical-align:middle; height:auto; text-align:right; font-size:12px;  '>
					<a href='mailto:".$smtp_mail."' style='color:#707070; text-decoration:none; padding-right:20px;'>".$smtp_mail."</a>
				</div>
		</div>
		</div>
		</div>
		<div style='width:100%; overflow:hidden; padding-bottom:0px; padding-top:0px; border-bottom:1px solid #EBEBEB;  '>
			<p style='margin-left:20px; font-size:18px; color:#000;'>Siparişiniz Bize Ulaştı!</p>
		</div>
		<div style='width:100%; height:auto; overflow:hidden; margin-top:17px; margin-bottom:17px;'>
			<div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
			Sayın : <b>".$rows['isim']."</b>,
			</div>	
			<div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
			Sipariş Numaranız : <b>".$rows['siparis_no']."</b>
			</div>	
			<div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
			Ödeme Yönteminiz : <b>Kredi Kartı/Banka Kartı</b>
			</div>	
			<div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
			Kartınızdan Çekilen Tutar : <b>".number_format($rows['toplam_tutar'], 2)." TL</b>
			</div>					
		</div>
	    <div style='width:100%; height:auto; overflow:hidden; margin-bottom:25px;'>
			<div style='margin-left:20px; width:88%; font-size:13px; color:#8C8C8C; '>
			Siparişiniz sistemimize ulaşmıştır.  <br>
			<strong>
			Siparişinizin onaylanmasının ardından satın aldığınız ürün veya ürünler en kısa sürede kargolanacaktır. İlginiz için teşekkür ederiz.
            </strong>
			</div>			
		</div>
		
	</div>
	<div style='background-color:#50E3C2; width:420px; height:auto; border:2px solid #50E3C2;  margin:0px auto; padding-top:15px; padding-bottom:15px; text-align:center; font-size:14px; font-weight:bold; color:#FFF; line-height:25px;'>
	".$site_adi."
	</div>
</div>
        ";

    if($mail->send())
    {} else {}
    // Alıcıya Mail Gönder /////////////////////////



}
        // Mail Gönder Ending //



        // SMS GÖNDER ///////////////////////////////////////////////////////////////////////
        if($smsayar['durum'] == 1 && $smsayar['sms_firma'] == 1  ) {

            /* İleti Merkezi */

            $iletibaslik = $smsayar['iletimerkezi_baslik'];
            $iletiuser = $smsayar['iletimerkezi_user'];
            $iletipass = $smsayar['iletimerkezi_pass'];
            $adminno = $smsayar['bildirim_numara'];
            $musteritelno = $rows['tel'];
            $musteriname = $rows['isim'];
            $musterisiparisno = $rows['siparis_no'];


            function sendRequest($site_name,$send_xml,$header_type) {

                //die('SITENAME:'.$site_name.'SEND XML:'.$send_xml.'HEADER TYPE '.var_export($header_type,true));
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$site_name);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$send_xml);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch, CURLOPT_HTTPHEADER,$header_type);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_TIMEOUT, 120);

                $result = curl_exec($ch);

                return $result;
            }

            $username   = $iletiuser;
            $password   = $iletipass;
            $orgin_name = $iletibaslik;

            $xml = <<<EOS
   		 <request>
   			 <authentication>
   				 <username>{$username}</username>
   				 <password>{$password}</password>
   			 </authentication>

   			 <order>
   	    		 <sender>{$orgin_name}</sender>
   	    		 <sendDateTime>01/05/2013 18:00</sendDateTime>
   	    		 <message>
   	        		 <text>Yeni bir siparişiniz var. Lütfen yönetim panelinize giriş yapınız. $site_adi</text>
   	        		 <receipents>
   	            		 <number>$adminno</number>
   	        		 </receipents>
   	    		 </message>
   	    		 	 <message>
   	        		 <text>Sayın $musteriname  siparişiniz alınmıştır. Sipariş numaranız : $musterisiparisno .En kısa sürede siparişinizin durumuyla ilgili bilgi verilecektir. Bizi tercih ettiğiniz için teşekkür ederiz. $site_adi</text>
   	        		 <receipents>
   	            		 <number>$musteritelno</number>
   	        		 </receipents>
   	    		 </message>
   			 </order>
   		
   		 </request>

EOS;


            $result = sendRequest('http://api.iletimerkezi.com/v1/send-sms',$xml,array('Content-Type: text/xml'));

            /* İleti Merkezi  Ending */


        }




        if($smsayar['durum'] == 1 && $smsayar['sms_firma'] == 2  ) {

            /* NetGSM */

            $netgsmbaslik = $smsayar['netgsm_baslik'];
            $netgsmuser = $smsayar['netgsm_user'];
            $netgsmpass = $smsayar['netgsm_pass'];
            $adminno = $smsayar['bildirim_numara'];
            $musteritelno = $rows['tel'];
            $musteriname = $rows['isim'];
            $musterisiparisno = $rows['siparis_no'];

            function XMLPOST($PostAddress,$xmlData)
            {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$PostAddress);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
                $result = curl_exec($ch);
                return $result;
            }
            $xml='<?xml version="1.0" encoding="UTF-8"?>
<mainbody>
<header>
<company></company>
<usercode>'.$netgsmuser.'</usercode>
<password>'.$netgsmpass.'</password>
<startdate></startdate>
<stopdate></stopdate>
<type>n:n</type>
<msgheader>'.$netgsmbaslik.'</msgheader>
</header>
<body> 	
<mp><msg><![CDATA[Yeni bir siparişiniz var. Lütfen yönetim panelinize giriş yapınız. '.$site_adi.' ]]></msg><no>'.$adminno.'</no></mp> 	
<mp><msg><![CDATA[Sayın '.$musteriname.' siparişiniz alınmıştır. Sipariş numaranız : '.$musterisiparisno.' .En kısa sürede siparişinizin durumuyla ilgili bilgi verilecektir. Bizi tercih ettiğiniz için teşekkür ederiz. '.$site_adi.' ]]></msg><no>'.$musteritelno.'</no></mp>
</body>
</mainbody>';
            $gelen=XMLPOST('http://api.netgsm.com.tr/xmlbulkhttppost.asp',$xml);

            /* NetGSM Ending */

        }








        if($smsayar['durum'] == 1 && $smsayar['sms_firma'] == 3  ) {

            // Ucuz SMS Gönder //

            $ucuz_baslik = $smsayar['ucuzsms_baslik'];
            $ucuz_user = $smsayar['ucuzsms_user'];
            $ucuz_pass = $smsayar['ucuzsms_pass'];
            $adminno = $smsayar['bildirim_numara'];
            $musteritelno = $rows['tel'];
            $musteriname = $rows['isim'];
            $musterisiparisno = $rows['siparis_no'];

            $postUrl = "http://api.tescom.com.tr:8080/api/smspost/v1";

            $postData = "". "<sms>".
                "<username>$ucuz_user</username>".
                "<password>$ucuz_pass</password>".
                "<header>$ucuz_baslik</header>".
                "<validity>2880</validity>".
                "<messages>".
                "<mb><no>$adminno</no><msg><![CDATA[Yeni bir siparisiniz var. Lütfen yönetim panelinize girerek siparisi inceleyin. $site_adi]]></msg></mb>".
                "<mb><no>$musteritelno</no><msg><![CDATA[Sayın $musteriname siparişiniz alınmıştır. Sipariş numaranız : $musterisiparisno .En kısa sürede siparişinizin durumuyla ilgili bilgi verilecektir. Bizi tercih ettiğiniz için teşekkür ederiz. $site_adi]]></msg></mb>".
                "</messages>".
                "</sms>";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $postUrl); curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5); curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml; charset=UTF-8"));

            $response = curl_exec($ch); curl_close($ch);

            // Ucuz SMS Gönder Ending //

        }


        // SMS GÖNDER ENDING //





	}else
		exit("post yok");
