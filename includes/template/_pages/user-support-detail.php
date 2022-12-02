<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if ($userSorgusu->rowCount() > 0 ) {
?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='uyeler' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
    <?php
    $current_page = 'destek';

    $destekno = $_GET['support_id'];

    $destekCek = $db->prepare("select * from uyeler_destek where user_id=:user_id and support_id=:support_id");
    $destekCek->execute(array(
            'user_id' => $userCek['id'],
             'support_id' => $destekno
    ));
    $destek = $destekCek->fetch(PDO::FETCH_ASSOC);
    
        $sonMesaj = $db->prepare("select * from uyeler_destek_mesaj where support_id=:support_id order by id desc");
            $sonMesaj->execute(array(
                    'support_id' => $destek['support_id']
            ));
            $msj = $sonMesaj->fetch(PDO::FETCH_ASSOC);


                $mesajlariCek = $db->prepare("select * from uyeler_destek_mesaj where support_id=:support_id order by id asc ");
                    $mesajlariCek->execute(array(
                        'support_id' => $destek['support_id']
                    ));

            if($destekCek->rowCount()<=0  ) { 
             header('Location:'.$siteurl.'404');
            }
    ?>
    <?php
    if(isset($_POST['messagesend'])) {

    $mesajicerik = trim(strip_tags($_POST['mesaj'])); ;
    
    if($mesajicerik) {
        $timestamp = date('Y-m-d G:i:s');
        $guncelle = $db->prepare("UPDATE uyeler_destek SET
                durum=:durum
         WHERE support_id={$destekno}      
        ");
        $guncelle->execute(array(
            'durum' => '1'
        ));
        $kaydet = $db->prepare("INSERT INTO uyeler_destek_mesaj SET
              mesaj=:mesaj,
              support_id=:support_id,
              tarih=:tarih,
              tip=:tip  
        ");
        $sonuc = $kaydet->execute(array(
            'mesaj' => $mesajicerik,
            'support_id' => $destekno,
            'tarih' => $timestamp,
            'tip' => '1'
        ));
        if($sonuc){
            $_SESSION['msj_success'] = 'success';

            if($ayar['smtp_durum'] == '1'  ) {
                /* E-posta Gönder */
                include 'includes/phpmailer/Exception.php';
                include 'includes/phpmailer/PHPMailer.php';
                include 'includes/phpmailer//SMTP.php';

                $isim = $userCek['isim'];
                $soyisim = $userCek['soyisim'];
                $sitemail = $ayar['site_mail'];
                $sitetel = $ayar['site_tel'];
                $siteadres = $ayar['adres_bilgisi'];
                $bildirimeposta = $ayar['smtp_bildirim_mail'];

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
                $mail->AddBCC($bildirimeposta, "");
                // Konu //
                $mail->Subject = "Destek Talebine Cevap Geldi";
                // Mesaj //
                $mail->isHTML();
                $mail->Body = '<div style="width: 100%; background-color: #f8f8f8;">
    <div style="width: 570px; margin: 0 auto; background-color: #FFFFFF; font-family: \'Open Sans\', Arial; font-size: 14px; color: #333;">
        <div id="Header" style="padding: 55px 45px 35px 45px; box-sizing: border-box; border-bottom: 1px solid #ebebeb;">
            <div style="width: 100%; height: auto; overflow: hidden; font-size:20px; font-weight: 700; color:#000; margin-bottom: 28px;">
                DESTEK TALEBİNE YENİ BİR CEVAP GELDİ
            </div>
            <div style="width: 100%; height: auto;  overflow: hidden;  font-weight: 600; margin-bottom: 25px;">
               Sayın site sahibi,
                <br>
                <span style="font-weight: 400;">
                    #'.$destekno.' numaralı destek talebine '.$isim.' '.$soyisim.' tarafından yeni bir mesaj gönderildi. Mesaj içeriğini görmek ve cevap yazmak için lütfen panelinize giriş yaptıktan sonra açık destek talepleri alanına gidin.
                </span>
                <div style="width:100%; border-left:20px solid #EBEBEB; border-top:1px solid #EBEBEB; border-right:1px solid #EBEBEB; border-bottom:1px solid #EBEBEB; box-sizing:border-box; padding:10px; font-weight:400; font-size:13px; margin-top:25px;">
				'.$mesajicerik.'
				</div>
            </div>
            <div style="width: 100%; height: auto;  overflow: hidden;">
                <a style="display: inline-block; width: auto; padding: 10px 25px; background-color: #ff0c29; font-size: 14px; font-weight: bold; color: #FFF; font-family: \'Open Sans\', Arial; text-decoration: none; " href="' .$siteurl. 'systemx/">
                 PANELE GİRİŞ YAPIN
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
                /* E-posta Gönder SON */

            }

        }else{
        echo 'Veritabanı Hatası';
        }
    }else{
        $_SESSION['msj_hata'] = 'hata';
    }
    }
    ?>
    <?php if (isset($_SESSION['msj_success'])) { ?>
        <div class="user_success_alert">
            <div class="user_success_alert_ic">
                <i class="fa fa-check"></i> <?=$diller['uyelik-destek-mesaj-basarili-yazisi']?>
            </div>
        </div>
        <meta http-equiv="refresh" content="2; URL=<?=$siteurl?>uyelik/destek-incele/<?=$destekno?>">
        <?php unset($_SESSION['msj_success']);?>
    <?php }?>
    <?php
    if (isset($_SESSION['msj_hata']) && $_SESSION['msj_hata'] == 'hata') {
        ?>
        <div class="user_success_alert">
            <div class="user_success_alert_ic_red">
                <i class="fa fa-times"></i> <?=$diller['uyelik-destek-mesaj-hat-yazisi']?>
            </div>
        </div>
        <meta http-equiv="refresh" content="2; URL=<?=$siteurl?>uyelik/destek-incele/<?=$destekno?>">
        <?php unset($_SESSION['msj_hata']);?>
    <?php }?>
<title><?php echo ucwords_tr($diller['uyepanel-destek']) ?> | <?php echo $ayar['site_baslik']?></title>
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

<!-- CONTENT AREA ============== !-->

<div class="users-page-main" >










    <div class="user-content-area">


        <?php include'includes/template/user-leftbar.php'; ?>

        <div class="user-right-content">

            <a href="uyelik/destek" class="btn btn-sm btn-dark"><i class="fa fa-arrow-left"></i> <?=$diller['uyelik-geridon-button-yazisi']?></a>
            <br><br>

            <div class="user-right-haed" style="" >
                <i class="ion-help-buoy"></i> <?=$diller['uyepanel-destek']?> <span style="font-size:14px">> #<?=$destek['support_id']?> <?=$diller['uyelik-destek-detay-baslik']?></span>
            </div>

            <div class="user-right-content-inside" style="display: block; margin-bottom: 0">

                <?php if($destek['durum'] == 0) { ?>
                    <div class="user-order-detail-status font-14" style="background-color: #19b355; color:#FFF">
                        <i class="fa fa-check"></i> <strong><?=$diller['uyelik-destek-durum']?></strong> : <span style="text-transform: uppercase"> <?=$diller['uyelik-destek-cevaplandi']?></span>
                    </div>
                <?php } ?>
                <?php if($destek['durum'] == 1) { ?>
                    <div class="user-order-detail-status font-14" style="background-color: #ff4443; color:#FFF">
                        <i class="fa fa-dot-circle-o"></i> <strong><?=$diller['uyelik-destek-durum']?></strong> : <span style="text-transform: uppercase"> <?=$diller['uyelik-destek-acik']?></span>
                    </div>
                <?php } ?>


            <div class="user-ticket-detail-main-info">
                <div class="user-ticket-detail-pi">
                    <label><?=$diller['uyelik-destek-olusturulma-tarih']?></label>
                    <br>
                    <?php echo date_tr('j F Y, H:i', ''.$destek['tarih'].''); ?>
                </div>
                <div class="user-ticket-detail-pi">
                    <label><?=$diller['uyelik-destek-son-tarih']?></label>
                    <br>
                    <?php echo date_tr('j F Y, H:i', ''.$msj['tarih'].''); ?>
                </div>
                <div class="user-ticket-detail-pi">
                    <label><?=$diller['uyelik-destek-no']?></label>
                    <br>
                    #<?=$destek['support_id']?>
                </div>
                <div class="user-ticket-detail-pi ticket-pi2">
                    <label><?=$diller['uyelik-destek-konu']?></label>
                    <br>
                    <?=$destek['konu']?>
                </div>
            </div>


                <div class="user-right-haed" style="margin-top: 20px;" >
                    <i class="fa fa-comments-o"></i> <?=$diller['uyelik-destek-mesajlar']?>
                </div>

        <!-- Modal Alanı !-->
                <style>
                    .modal-content{border-radius: 0 !important;
                        border:0 !important;
                        overflow: hidden !important;
                    }
                    .modal-backdrop {background-color:#000; opacity: 0.7!important;}
                    .modal-body .form-control{
                        -webkit-border-radius: 0;-moz-border-radius: 0;border-radius: 0;
                        font-family: 'Open Sans', Arial;
                        font-size: 14px;
                    }
                    .modal-body label{
                        font-family: 'Open Sans', Arial;
                        font-size: 14px;
                    }
                    .modal-title{font-size: 16px; font-weight: bold;}
                </style>
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#newMessage">
                    <i class="fa fa-plus-circle"></i> <?=$diller['uyelik-destek-yeni-mesaj-gonder']?>
                </button>
                <br>
                <!-- Modal -->
                <div class="modal fade" id="newMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle"><?=$diller['uyelik-destek-yeni-mesaj-gonder']?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="post">
                            <div class="modal-body">

                                    <label for="mesaj"><?=$diller['uyelik-destek-mesajiniz']?></label>
                                    <br>
                                    <textarea name="mesaj" id="mesaj" class="form-control" rows="3" required></textarea>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="messagesend" class="btn btn-primary"><?=$diller['uyelik-destek-mesaj-gonder']?></button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
        <!-- Modal Alanı SON !-->




                <!-- Mesajlar ALanı !-->

              <?php foreach ($mesajlariCek as $mesaj) {?>
                  <div <?php if($mesaj['tip'] == 1 ) { ?>class="user-ticket-message-div"<?php }?><?php if($mesaj['tip'] == 0  ) { ?>class="user-ticket-message-div2"<?php }?>>
                      <div class="user-ticket-message-name">
                         <?php if($mesaj['tip'] == 1  ) {?>
                             <span style="color:#6f51cc; font-weight: 600;">
                                        <?=$userCek['isim']?>  <?=$userCek['soyisim']?>
                                    </span>
                         <?php }?>
                          <?php if($mesaj['tip'] == 0  ) {?>
                              <span style="color:#cc6d53; font-weight: 600;">
                           <i class="fa fa-dot-circle-o"></i> <?=$diller['uyelik-destek-mesaj-destek-birimi']?>
                        </span>
                          <?php }?>
                          <br>
                          <span style="font-size: 12px;"><?php echo date_tr('j F Y, H:i', ''.$mesaj['tarih'].''); ?></span>
                      </div>
                      <div class="user-ticket-message-content">
                          <?=$mesaj['mesaj']?>
                      </div>
                  </div>
              <?php }?>

                

                <!-- Mesajlar ALanı SON !-->
            </div>






        </div>


    </div>
</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

<?php }else{
    header('Location:'.$siteurl.'404');
}
?>