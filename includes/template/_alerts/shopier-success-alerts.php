<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$page_header_setting = $db->prepare("select * from page_header where page_id='alert' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
    <title><?php echo ucwords_tr($diller['siparis-sonucu']) ?> | <?php echo $ayar['site_baslik']?></title>
    <meta name="description" content="<?php echo"$ayar[site_desc]" ?>">
    <meta name="keywords" content="<?php echo"$ayar[site_tags]" ?>">
    <meta name="news_keywords" content="<?php echo"$ayar[site_tags]" ?>">
    <meta name="author" content="<?php echo"$ayar[site_baslik]" ?>" />
    <meta itemprop="author" content="<?php echo"$ayar[site_baslik]" ?>" />
    <meta name="robots" content="index follow">
    <meta name="googlebot" content="index follow">
    <meta property="og:type" content="website" />

<?php include "includes/config/header_libs.php";?>

    </head>
    <body>

    <?php include 'includes/template/header.php'?>


    <!-- Page Header ====================== !-->
    <style>
        .page-headers-main{width:<?php if($pagehead['width']==1){?> 90%; <?php }else {?> 100% <?php }?> ;  padding:<?php echo $pagehead['padding'] ?>px 0 <?php echo $pagehead['padding'] ?>px 0 ; border:1px solid #<?php echo $pagehead['border_color'] ?>;

        <?php if($pagehead['shadow'] == 1 ) {?>

            -webkit-box-shadow: inset 0px 5px 10px -7px rgba(0,0,0,0.1);
            -moz-box-shadow: inset 0px 5px 10px -7px rgba(0,0,0,0.1);
            box-shadow: inset 0px 5px 10px -7px rgba(0,0,0,0.1);

        <?php } ?>

        <?php if($pagehead['tip'] == 0 ) {?>

            background:#<?php echo $pagehead['bg_color'] ?> ;

        <?php } ?>

        <?php if($pagehead['tip'] == 1 ) {?>

            background:url(images/uploads/<?php echo $pagehead['bg_image'] ?>) ;

            box-shadow: inset 5000px 0 0 0 rgba(0, 0, 0, 0.7); border-color: rgba(0, 0, 0, 1);

        <?php } ?>

        }
    </style>
    <style>
        input[type="text"]:disabled {
            background: #FFF;
        }
    </style>
    <div class="page-headers-main">
        <div class="page-headers-main-in">
            <div class="page-headers-main-left font-raleway font-18 font-small font-spacing" style="color:#<?php echo $pagehead['text_color'] ?>;">

                <?php echo ucwords_tr($diller['siparis-sonucu']) ?>

            </div><div class="page-headers-main-right font-raleway font-12 font-spacing">

                <span style="color:#<?php echo $pagehead['pasif_text_color'] ?>; padding-right: 15px;"><?php echo $diller['buradasiniz'] ?>:</span>
                <a href="index.html" style="color:#<?php echo $pagehead['text_color'] ?>;"><span style="padding-right: 15px; font-weight: 600"><?php echo $diller['anasayfa'] ?></span></a>
                <span style="color:#<?php echo $pagehead['pasif_text_color'] ?>; padding-right: 15px;">/</span>
                <span style="padding-right: 15px; color:#<?php echo $pagehead['text_color'] ?>;"><?php echo ucwords_tr($diller['siparis-sonucu']) ?></span>
            </div>
        </div>
    </div>
    <!-- Page Header ====================== !-->



    <!-- CONTENT AREA ============== !-->

    <div class="cart-page-main">



        <?php
        include_once 'includes/template/_pos/shopier/Shopier.php';

        $Api_Key= $odemeayar['shopier_key'];
        $Api_Secret= $odemeayar['shopier_secret'];

        $shopier = new Shopier($Api_Key, $Api_Secret);

        if ($shopier->verifyShopierSignature($_POST))  // eğer shopierin hash ile sisteminizdeki hash verify ise bu alan sadece 2 taraflı güvenlik içindir.
        {
            $order_id = $_POST['platform_order_id'];
            $random_nr = $_POST['random_nr'];
            $payment_id = $_POST['payment_id'];
            $status = $_POST['status'];


            $siparisCek = $db->prepare("select * from siparis where shopier_no='$order_id' ");
            $siparisCek->execute();
            $sipa = $siparisCek->fetch(PDO::FETCH_ASSOC);

            /* random'a göre sorgu ve siparişi durum 0 */
            $guncelle = $db->prepare("UPDATE siparis SET
            siparis_durum=:siparis_durum,
            shopier_sip_no=:shopier_sip_no
      WHERE shopier_no={$order_id}      
     ");
            $sonuc = $guncelle->execute(array(
                'siparis_durum' => '0',
                'shopier_sip_no' => $payment_id
            ));
            if($sonuc  ) {?>
                <?php
                //////////////////////////////////////////** E-Posta Bildirimi Açık *//////////////////////////////////////////
                if($ayar['smtp_durum']=='1') {

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
                    $smtp_alici_mail = $sipa['eposta'];


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
                    Siparişi Gönderen : <b>".$sipa['isim']." </b>
                </div>
                <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                    E-Posta Adresi : <a href='mailto:".$sipa['eposta']."' style='color:#17AD8B;'><b>".$sipa['eposta']."</b></a>
                </div>
                <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                    Telefon : <b>".$sipa['tel']."</b>
                </div>
                <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                    Sipariş Numarası : #<b>".$sipa['siparis_no']."</b>
                </div>
                <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                    Toplam Tutar : <b>".number_format($sipa['toplam_tutar'], 2)." ".$odemeayar['simge']."</b>
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
                    Sayın : <b>".$sipa['isim']."</b>,
                </div>
                <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                    Sipariş Numaranız : <b>".$sipa['siparis_no']."</b>
                </div>
                <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                    Ödeme Yönteminiz : <b>Kredi Kartı/Banka Kartı</b>
                </div>
                <div style='margin-left:20px; width:88%; font-size:13px; color:#595959; margin-bottom:8px;'>
                   Toplam Tutar : <b>".number_format($sipa['toplam_tutar'], 2)." ".$odemeayar['simge']."</b>
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



                    /////////////////////////////////////////** E-Posta Bildirimi Açık Ending *//////////////////////////////////////////
                } ?>
                <?php if($smsayar['durum'] == 1 && $smsayar['sms_firma'] == 1  ) {

                    /* İleti Merkezi */

                    $iletibaslik = $smsayar['iletimerkezi_baslik'];
                    $iletiuser = $smsayar['iletimerkezi_user'];
                    $iletipass = $smsayar['iletimerkezi_pass'];
                    $adminno = $smsayar['bildirim_numara'];
                    $musteritelno = $sipa['tel'];
                    $musteriname = $sipa['isim'];
                    $musterisiparisno = $sipa['siparis_no'];


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
   	        		 <text>Sayın $musteriname siparişiniz alınmıştır. Sipariş numaranız : $musterisiparisno .En kısa sürede siparişinizin durumuyla ilgili bilgi verilecektir. Bizi tercih ettiğiniz için teşekkür ederiz. $site_adi</text>
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

                    /* NetGSM */

                    $netgsmbaslik = $smsayar['netgsm_baslik'];
                    $netgsmuser = $smsayar['netgsm_user'];
                    $netgsmpass = $smsayar['netgsm_pass'];
                    $adminno = $smsayar['bildirim_numara'];
                    $musteritelno = $sipa['tel'];
                    $musteriname = $sipa['isim'];
                    $musterisiparisno = $sipa['siparis_no'];

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

                }  ?>
                <?php if($smsayar['durum'] == 1 && $smsayar['sms_firma'] == 3  ) {

                    // Ucuz SMS Gönder //

                    $ucuz_baslik = $smsayar['ucuzsms_baslik'];
                    $ucuz_user = $smsayar['ucuzsms_user'];
                    $ucuz_pass = $smsayar['ucuzsms_pass'];
                    $adminno = $smsayar['bildirim_numara'];
                    $musteritelno = $sipa['tel'];
                    $musteriname = $sipa['isim'];
                    $musterisiparisno = $sipa['siparis_no'];

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
                ?>
            <?php }
            /*  <========SON=========>>> random'a göre sorgu ve siparişi durum 0 SON */

            ?>

            <div class="orders-alerts-inside">

                <div class="order-alerts-head">

                    <div class="order-alerts-head-success">

                        <img src="images/success.png" alt="Sipariş Başarılı"><br>
                        <?=$diller['siparis-basarili']?>

                    </div>
                    <div class="order-alerts-head-order-id">

                        <?=$diller['siparis-numaraniz']?> : <strong>#<?php echo $sipa['siparis_no'] ?></strong>

                    </div>

                </div>


            </div>
        <?php } else {

            header('Location:'.$siteurl.'');

            exit;
        }
        ?>
    </div>

    <!-- CONTENT AREA ============== !-->






    <?php include 'includes/template/footer.php'?>
    </body>
    </html>
<?php include "includes/config/footer_libs.php";?>