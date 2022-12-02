<?php
ob_start();
session_start();
include "../../../../includes/config/config.php";
date_default_timezone_set( 'Europe/Istanbul' );
$settings=$db->prepare("SELECT * from ayarlar where id='1'");
$settings->execute(array(0));
$ayar=$settings->fetch(PDO::FETCH_ASSOC);
$siteurl = $ayar['site_url'];

$smsayar=$db->prepare("SELECT * from sms where id='1'");
$smsayar->execute(array(0));
$sms=$smsayar->fetch(PDO::FETCH_ASSOC);

$kargoCek = $db->prepare("select * from kargo where id='$_GET[kargo_id]'");
$kargoCek ->execute();
$kargo = $kargoCek->fetch(PDO::FETCH_ASSOC);

$siparisUrunler = $db->prepare("select * from siparis_urunler where id='$kargo[siparis_urun_id]'");
$siparisUrunler ->execute();
$sipurun = $siparisUrunler->fetch(PDO::FETCH_ASSOC);

$siparisDetay = $db->prepare("select * from siparis where siparis_no='$sipurun[siparis_id]'");
$siparisDetay ->execute();
$sip = $siparisDetay->fetch(PDO::FETCH_ASSOC);

$anaUrunCek = $db->prepare("select * from urun where id='$sipurun[urun_id]'");
$anaUrunCek ->execute();
$anaUrun = $anaUrunCek->fetch(PDO::FETCH_ASSOC);

$siparisno = $sip["siparis_no"];
?>

<?php
if($kargoCek->rowCount() == 0 ) {
    header("Location:../../../pages.php?sayfa=siparisler");
}
?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once '../../secure_post.php';
if ($adminsorgusu->rowCount()===0) {
    header("Location: 404");
} else {
    if ($_GET['kargobildirim'] == 'success') {


        if ($ayar['smtp_durum'] == 1) {




            include '../../../../includes/phpmailer/Exception.php';
            include '../../../../includes/phpmailer/PHPMailer.php';
            include '../../../../includes/phpmailer/SMTP.php';

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
            $mail->CharSet  = "utf-8";
            if($ayar['smtp_protokol'] == 'tls' || $ayar['smtp_protokol'] == 'ssl') {
                $mail->SMTPSecure =$smtp_protokol;
            }

            // Gönderici //
            $mail->setFrom($smtp_mail, $site_adi);
            // Alıcı //
            $mail->AddBCC($sip['eposta'], "");
            // Konu //
            $mail->Subject = "Siparişiniz Kargoya Verildi";
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
            <p style='margin-left:20px; font-size:18px; color:#000;'>Siparişiniz Kargolandı!</p>
        </div>
        <div style='width:100%; height:auto; overflow:hidden; margin-bottom:10px; margin-top:17px; '>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#8C8C8C; '>
                Sayın <b>" . $sip['isim'] . "</b> , <b>#" . $sip['siparis_no'] . "</b> numaralı siparişinizdeki ürün veya ürünler kargoya verilmiştir.
            </div>
        </div>
        <div style='width:100%; height:auto; overflow:hidden; margin-top:17px; margin-bottom:17px;'>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                Kargo Firması : <b>" . $kargo['kargo_adi'] . "</b>
            </div>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                Takip Numarası : <b>" . $kargo['takip_no'] . "</b>
            </div>
            
            <div style='width: 90%; height: auto; overflow: hidden; padding: 10px 0 10px 0; margin: 0 auto; margin-top: 15px; border:1px solid #EBEBEB;'>
                <div style='width: 90%; height: auto; margin: 0 auto; overflow: hidden; font-size:13px;'>
                    <div style='width: 80px; height: 80px; overflow: hidden; display: inline-block; vertical-align: top; margin-right: 10px;'>
                    <img style='width:80px; height:80px;'  src='" . $siteadres . "images/product/" . $anaUrun['gorsel'] . "' >
                    </div><div style='width: 222px; height: auto; overflow: hidden; display: inline-block; vertical-align: top;'>
                    <strong>" . $sipurun['urun_baslik'] . "</strong>
                    <br>
                    <span style='color:#8C8C8C'>" . $sipurun['adet'] . " Adet</span>
                    <br>
                    <span style='color:#8C8C8C'>" . $sipurun['varyantlar'] . "</span>
                    </div>
                    
                </div>
            </div>
            
        </div>
        <div style='width:100%; height:auto; overflow:hidden; margin-bottom:25px;'>
            <div style='margin-left:20px; width:88%; font-size:15px; color:#666; font-weight: 500 '>
                " . $kargo['eposta_mesaj'] . "
            </div>
        </div>


    </div>
    <div style='background-color:#50E3C2; width:420px; height:auto; border:2px solid #50E3C2;  margin:0px auto; padding-top:15px; padding-bottom:15px; text-align:center; font-size:14px; font-weight:bold; color:#FFF; line-height:25px;'>
        " . $site_adi . "
    </div>
</div>

            ";

            if($mail->send()) {


               Header("location: ../../../pages.php?sayfa=kargo&siparis_id=$siparisno&status=bildirimok");


            } else {

                Header("location: ../../../pages.php?sayfa=kargo&siparis_id=$siparisno&status=bildirimok");

            }







        }


        if ($sms['durum'] == 1) {


            if ($sms['sms_firma'] == 1) {


                /* İleti Merkezi */

                $iletibaslik = $sms['iletimerkezi_baslik'];
                $iletiuser = $sms['iletimerkezi_user'];
                $iletipass = $sms['iletimerkezi_pass'];
                $numara = $sip['tel'];

                function sendRequest($site_name, $send_xml, $header_type)
                {

                    //die('SITENAME:'.$site_name.'SEND XML:'.$send_xml.'HEADER TYPE '.var_export($header_type,true));
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $site_name);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $send_xml);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header_type);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 120);

                    $result = curl_exec($ch);

                    return $result;
                }

                $username = $iletiuser;
                $password = $iletipass;
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
   	        		 <text>Sayın $sip[isim] , $sip[siparis_no] numaralı siparişinizdeki ürün veya ürünler kargoya verilmiştir.Kargo Firması : $kargo[kargo_adi] , Takip Numarası : $kargo[takip_no] . $kargo[sms_mesaj]</text>
   	        		 <receipents>
   	            		 <number>{$numara}</number>
   	        		 </receipents>
   	    		 </message>
   			 </order>
   		
   		 </request>

EOS;


                $result = sendRequest('http://api.iletimerkezi.com/v1/send-sms', $xml, array('Content-Type: text/xml'));
                Header("location: ../../../pages.php?sayfa=kargo&siparis_id=$siparisno&status=bildirimok");
                /* İleti Merkezi  Ending */


            }


            if ($sms['sms_firma'] == 2) {

                $mesajicerik = "Sayın " . $sip['isim'] . " , " . $sip['siparis_no'] . " numaralı siparişinizdeki ürün veya ürünler kargoya verilmiştir.Kargo Firması : " . $kargo['kargo_adi'] . " , Takip Numarası : " . $kargo['takip_no'] . " . " . $kargo['sms_mesaj'] . "   ";

                $numara = $sip['tel'];


                function sendsms($msg, $telno, $header, $username, $pass)
                {


                    $startdate = date('d.m.Y H:i');
                    $startdate = str_replace('.', '', $startdate);
                    $startdate = str_replace(':', '', $startdate);
                    $startdate = str_replace(' ', '', $startdate);

                    $stopdate = date('d.m.Y H:i', strtotime('+1 day'));
                    $stopdate = str_replace('.', '', $stopdate);
                    $stopdate = str_replace(':', '', $stopdate);
                    $stopdate = str_replace(' ', '', $stopdate);


                    $url = "http://api.netgsm.com.tr/bulkhttppost.asp?usercode=$username&password=$pass&gsmno=$telno&message=$msg&msgheader=$header&startdate=$startdate&stopdate=$stopdate";
                    //echo $url;

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//  curl_setopt($ch,CURLOPT_HEADER, false);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    return $output;

                }


                $usa = $sms['netgsm_user'];
                $paso = $sms['netgsm_pass'];

                $mesaj = $mesajicerik;
                $tel = $numara;
                $baslik = $sms['netgsm_baslik'];


                $mesaj = html_entity_decode($mesaj, ENT_COMPAT, "UTF-8");
                $mesaj = rawurlencode($mesaj);


                $baslik = html_entity_decode($baslik, ENT_COMPAT, "UTF-8");
                $baslik = rawurlencode($baslik);


                sendsms($mesaj, $tel, $baslik, $usa, $paso);

                Header("location: ../../../pages.php?sayfa=kargo&siparis_id=$siparisno&status=bildirimok");

            }


            if ($sms['sms_firma'] == 3) {

                $ucuz_baslik = $sms['ucuzsms_baslik'];
                $ucuz_user = $sms['ucuzsms_user'];
                $ucuz_pass = $sms['ucuzsms_pass'];
                $numara = $sip['tel'];

                $postUrl = "http://api.tescom.com.tr:8080/api/smspost/v1";

                $postData = "". "<sms>".
                    "<username>$ucuz_user</username>".
                    "<password>$ucuz_pass</password>".
                    "<header>$ucuz_baslik</header>".
                    "<validity>2880</validity>".
                    "<messages>".
                    "<mb><no>$numara</no><msg><![CDATA[Sayın $sip[isim] , $sip[siparis_no] numaralı siparişinizdeki ürün veya ürünler kargoya verilmiştir.Kargo Firması : $kargo[kargo_adi] , Takip Numarası : $kargo[takip_no] . $kargo[sms_mesaj]]]></msg></mb>".
                    "</messages>".
                    "</sms>";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $postUrl); curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_TIMEOUT, 5); curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml; charset=UTF-8"));

                $response = curl_exec($ch); curl_close($ch);

                Header("location: ../../../pages.php?sayfa=kargo&siparis_id=$siparisno&status=bildirimok");


            }








        }


    }
}
?>


