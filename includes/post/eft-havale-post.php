<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$timestamp = date('Y-m-d G:i:s');


$kaydet=$db->prepare("INSERT INTO siparis SET
        ara_tutar=:ara_tutar,
        kdv_tutar=:kdv_tutar,
        kargo_tutar=:kargo_tutar,
        toplam_tutar=:toplam_tutar,
        isim=:isim,
        tel=:tel,
        eposta=:eposta,
        adres=:adres,
        sehir=:sehir,
        postakodu=:postakodu,
        notlar=:notlar,
        odeme_tip=:odeme_tip,
        siparis_no=:siparis_no,
        siparis_durum=:siparis_durum,
        siparis_tarih=:siparis_tarih,
        user_id=:user_id
        ");
$ekle=$kaydet->execute(array(
    'ara_tutar'   => $_SESSION['ara_tutar'],
    'kdv_tutar'   => $_SESSION['kdv_tutar'],
    'kargo_tutar'   => $_SESSION['kargo_tutar'],
    'toplam_tutar'   => $_SESSION['toplam_odenecek_tutar'],
    'isim'   => $_SESSION['siparis_isim']." ".$_SESSION['siparis_soyisim'],
    'tel'  => $_SESSION['siparis_tel'],
    'eposta'   => $_SESSION['siparis_eposta'],
    'adres'  => $_SESSION['siparis_adres'],
    'sehir'   => $_SESSION['siparis_ilce']." / ". $_SESSION['siparis_sehir'],
    'postakodu'  => $_SESSION['siparis_postakodu'],
    'notlar'   => $_SESSION['siparis_not'],
    'odeme_tip'   => 2,
    'siparis_no'  => $_SESSION['siparis_numarasi'],
    'siparis_durum' => 0,
    'siparis_tarih' => $timestamp,
    'user_id' => $userCek['id']
));
if ($ekle) {


///////////////////////////////////////////** Sepetteki Ürünleri Veritabanına Aktar *//////////////////////////////////////////
    if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"])> 0) {

        foreach($_SESSION["shopping_cart"] as $product) {


            $siparisurunkaydet=$db->prepare("INSERT INTO siparis_urunler SET
        urun_id=:urun_id,
        siparis_id=:siparis_id,
        urun_baslik=:urun_baslik,
        adet=:adet,
        varyantlar=:varyantlar,
        tutar=:tutar,
        kdv_tutar=:kdv_tutar,
        kargo_tutar=:kargo_tutar
        ");
            $siparisurunekle=$siparisurunkaydet->execute(array(
                'urun_id'   => $product['item_id'],
                'siparis_id'   => $_SESSION['siparis_numarasi'],
                'urun_baslik'   => $product['item_name'],
                'adet'   => $product['item_quantity'],
                'varyantlar'   => $product['var'],
                'tutar'   => $product['item_fiyat'],
                'kdv_tutar'   => $product['item_kdv_tutar'],
                'kargo_tutar'   => $product['item_kargo_tutar']
            ));

        }

    }
    //////** Sepetteki Ürünleri Veritabanına Aktar END *///////




//////////////////** Sepetteki Ürünlerin adetini düşür *//////////////////////////////////////////////////////////////////////////////////////////////////
    if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"])> 0) {

        foreach ($_SESSION["shopping_cart"] as $urunsler) {
            $adetnedir = $urunsler['item_quantity'];
            $urunidnedir = $urunsler['item_id'];

            $urun_adet_artir = $db->prepare("UPDATE urun SET stok = stok-$adetnedir WHERE id='$urunidnedir'  ");
            $urun_adet_artir->execute();
        }

    }
    //////** Sepetteki Ürünlerin adetini düşür  END *///////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//////////////////////////////////////////** E-Posta Bildirimi Açık *//////////////////////////////////////////
    if($ayar['smtp_durum']==1) {

        include 'includes/phpmailer/Exception.php';
        include 'includes/phpmailer/PHPMailer.php';
        include 'includes/phpmailer/SMTP.php';




        // Siteye Bildirim Gönder //
        $siteadres = $ayar['site_url'];
        $sitelogo = $ayar['site_logo'];
        $site_adi = $ayar["site_baslik"];
        $smtp_protokol = $ayar["smtp_protokol"];
        $smtp_host = $ayar["smtp_host"];
        $smtp_mail = $ayar["smtp_mail"];
        $smtp_port = $ayar["smtp_port"];
        $smtp_pass = $ayar["smtp_pass"];
        $smtp_bildirim_mail = $ayar["smtp_bildirim_mail"];
        $smtp_alici_mail = $_SESSION["siparis_eposta"];


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
        $mail->Subject = "Yeni Bir Sipariş Var!";
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
                Sipariş Numarası : #<b>".$_SESSION['siparis_numarasi']."</b>
            </div>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                Siparişi Gönderen : <b>".$_SESSION['siparis_isim']." ".$_SESSION['siparis_soyisim']."</b>
            </div>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                E-Posta Adresi : <a href='mailto:".$_SESSION['siparis_eposta']."' style='color:#17AD8B;'><b>".$_SESSION['siparis_eposta']."</b></a>
            </div>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                Telefon : <b>".$_SESSION['siparis_tel']."</b>
            </div>
           <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                Ödeme Yöntemi : <b>Havale/EFT</b>
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

        if($mail->send()) {

            header("location: ".$siteurl."siparis-basarili?status=success");

        } else {

            header("location: ".$siteurl."siparis-basarili?status=success");

        }


        // Siteye Bildirim Gönder Ending /////////////////////



        // Alıcıya Bildirim Gönder //
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
        $mail->Subject = "Siparişiniz Bize Ulaştı";
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
                Sayın <b>".$_SESSION['siparis_isim']." ".$_SESSION['siparis_soyisim']."</b>,
            </div>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                Sipariş Numaranız : <b>".$_SESSION['siparis_numarasi']."</b>
            </div>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                Ödeme Yönteminiz : <b>Havale/EFT</b>
            </div>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                Ödenecek Tutar : <b>".number_format($_SESSION['toplam_odenecek_tutar'], 2)." TL</b>
            </div>
        </div>
        <div style='width:100%; height:auto; overflow:hidden; margin-bottom:25px;'>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#8C8C8C; '>
                Siparişiniz sistemimize ulaşmıştır.  <br>
                <strong>
                    Lütfen siparişinizin tamamlanması için ödemeniz gereken tutarı eksiksiz olarak banka hesap numaralarımızdan birisine gönderiniz ve bize bilgi veriniz.
                </strong>
            </div>
        </div>
        <div style='width:100%; height:auto; overflow:hidden; margin-bottom:30px;'>
            <div style='margin-left:20px; width:88%; font-size:13px; color:#8C8C8C; '>
                <a href='".$siteadres."hesap-numaralarimiz' style='color:#17AD8B; '>HESAP NUMARALARIMIZ</a>
            </div>
        </div>

    </div>
    <div style='background-color:#50E3C2; width:420px; height:auto; border:2px solid #50E3C2;  margin:0px auto; padding-top:15px; padding-bottom:15px; text-align:center; font-size:14px; font-weight:bold; color:#FFF; line-height:25px;'>
        ".$site_adi."
    </div>
</div>

                ";

        if($mail->send()) {

        } else {

        }
        // Alıcıya Bildirim Gönder Ending //////////////////////////






    }    else   { ////////////////////////////////////** E-Posta Bildirimi KAPALI *///////////////////////////////////////////////////////////////////

        header("location: ".$siteurl."siparis-basarili?status=success");

    }
    $odenecektutartoplam = $_SESSION['toplam_odenecek_tutar'];
    ?>




    <!--- SMS Sistemi ====================================================================
=============================================================================================================================================================================================!-->
    <?php if($smsayar['durum'] == 1 && $smsayar['sms_firma'] == 1  ) {



        /* İleti Merkezi */

        $iletibaslik = $smsayar['iletimerkezi_baslik'];
        $iletiuser = $smsayar['iletimerkezi_user'];
        $iletipass = $smsayar['iletimerkezi_pass'];
        $adminno = $smsayar['bildirim_numara'];
        $musteritelno = $_SESSION['siparis_tel'];
        $musteriname = $_SESSION['siparis_isim'];
        $musterisurname = $_SESSION['siparis_soyisim'];
        $musterisiparisno = $_SESSION['siparis_numarasi'];


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
   	        		 <text>Yeni bir Havale/EFT ödeme yöntemi olan siparişiniz var. Lütfen yönetim panelinize giriş yapınız. $site_adi</text>
   	        		 <receipents>
   	            		 <number>$adminno</number>
   	        		 </receipents>
   	    		 </message>
   	    		 	 <message>
   	        		 <text>Sayın $musteriname $musterisurname siparişiniz alınmıştır. Sipariş numaranız : $musterisiparisno , ödenecek tutar : $odenecektutartoplam TL .Ödeme türünüz Havale/EFT olduğu için lütfen ödemeniz gereken tutarı eksiksiz olarak hesap numaralarımızdan birisine göndererek bize bilgi veriniz. Bizi tercih ettiğiniz için teşekkür ederiz. $site_adi</text>
   	        		 <receipents>
   	            		 <number>$musteritelno</number>
   	        		 </receipents>
   	    		 </message>
   			 </order>
   		
   		 </request>

EOS;


        $result = sendRequest('http://api.iletimerkezi.com/v1/send-sms',$xml,array('Content-Type: text/xml'));

        /* İleti Merkezi  Ending */



    }?>




    <?php if($smsayar['durum'] == 1 && $smsayar['sms_firma'] == 2  ) {

        $netgsmbaslik = $smsayar['netgsm_baslik'];
        $netgsmuser = $smsayar['netgsm_user'];
        $netgsmpass = $smsayar['netgsm_pass'];
        $adminno = $smsayar['bildirim_numara'];
        $musteritelno = $_SESSION['siparis_tel'];
        $musteriname = $_SESSION['siparis_isim'];
        $musterisurname = $_SESSION['siparis_soyisim'];
        $musterisiparisno = $_SESSION['siparis_numarasi'];

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
<mp><msg><![CDATA[Yeni bir Havale/EFT ödeme yöntemi olan siparişiniz var. Lütfen yönetim panelinize giriş yapınız. '.$site_adi.' ]]></msg><no>'.$adminno.'</no></mp> 	
<mp><msg><![CDATA[Sayın '.$musteriname.' '.$musterisurname.' siparişiniz alınmıştır. Sipariş numaranız : '.$musterisiparisno.' , ödenecek tutar : '.$odenecektutartoplam.' TL .Ödeme türünüz Havale/EFT olduğu için lütfen ödemeniz gereken tutarı eksiksiz olarak hesap numaralarımızdan birisine göndererek bize bilgi veriniz. Bizi tercih ettiğiniz için teşekkür ederiz. '.$site_adi.' ]]></msg><no>'.$musteritelno.'</no></mp>
</body>
</mainbody>';
        $gelen=XMLPOST('http://api.netgsm.com.tr/xmlbulkhttppost.asp',$xml);


    }

    ?>


    <?php if($smsayar['durum'] == 1 && $smsayar['sms_firma'] == 3  ) {



        // UcuzSmsGönder //
        $ucuz_baslik = $smsayar['ucuzsms_baslik'];
        $ucuz_user = $smsayar['ucuzsms_user'];
        $ucuz_pass = $smsayar['ucuzsms_pass'];
        $adminno = $smsayar['bildirim_numara'];
        $musteritelno = $_SESSION['siparis_tel'];
        $musteriname = $_SESSION['siparis_isim'];
        $musterisurname = $_SESSION['siparis_soyisim'];
        $musterisiparisno = $_SESSION['siparis_numarasi'];

        $postUrl = "http://api.tescom.com.tr:8080/api/smspost/v1";

        $postData = "". "<sms>".
            "<username>$ucuz_user</username>".
            "<password>$ucuz_pass</password>".
            "<header>$ucuz_baslik</header>".
            "<validity>2880</validity>".
            "<messages>".
            "<mb><no>$adminno</no><msg><![CDATA[Yeni bir Havale/EFT ödeme yöntemi olan siparişiniz var. Lütfen yönetim panelinize giriş yapınız. $site_adi]]></msg></mb>".
            "<mb><no>$musteritelno</no><msg><![CDATA[Sayın $musteriname $musterisurname siparişiniz alınmıştır. Sipariş numaranız : $musterisiparisno , ödenecek tutar : $odenecektutartoplam TL .Ödeme türünüz Havale/EFT olduğu için lütfen ödemeniz gereken tutarı eksiksiz olarak hesap numaralarımızdan birisine göndererek bize bilgi veriniz. Bizi tercih ettiğiniz için teşekkür ederiz. $site_adi]]></msg></mb>".
            "</messages>".
            "</sms>";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $postUrl); curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml; charset=UTF-8"));

        $response = curl_exec($ch); curl_close($ch);





    } ?>

    <!--- SMS Sistemi SON =========================================================================================================================
    ========================================================================================================================================!-->







<?php } else {

    echo'Mysql Table Warning!';
}



?>