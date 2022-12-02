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

    $Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
    $Say = $db->query("select * from uyeler_destek where user_id='$userCek[id]' order by id DESC");
    $ToplamVeri = $Say->rowCount();
    $Limit = 20;
    $Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
    $Goster = $Sayfa * $Limit - $Limit;
    $GorunenSayfa = 5;
    $listele_tablo = $db->query("select * from uyeler_destek where user_id='$userCek[id]' order by id DESC limit $Goster,$Limit");
    $tabloAl = $listele_tablo->fetchAll(PDO::FETCH_ASSOC);
            
    ?>
    <?php
    if (isset($_POST['messagesend'])) {

        $konu = trim(strip_tags($_POST['konu']));
        $mesajicerik = trim(strip_tags($_POST['mesaj']));
        $ticketid = rand(0,(int) 99999999);
        $userid = $userCek['id'] ;

        if($konu && $mesajicerik  ) {

            $timestamp = date('Y-m-d G:i:s');

            /* destek olustur */
            $kaydet = $db->prepare("INSERT INTO uyeler_destek SET
                konu=:konu,
                tarih=:tarih,
                user_id=:user_id,
                support_id=:support_id,
                durum=:durum    
            ");
            $sonuc = $kaydet->execute(array(
                    'konu' => $konu,
                'tarih' => $timestamp,
                'user_id' => $userid,
                'support_id' => $ticketid,
                'durum' => '1',
            ));
            if($sonuc){

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
                $mailadresi = $userCek['eposta'];
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
                $mail->AddBCC($mailadresi, "");
                // Konu //
                $mail->Subject = "Destek Talebiniz Alındı";
                // Mesaj //
                $mail->isHTML();
                $mail->Body = '<div style="width: 100%; background-color: #f8f8f8;">
    <div style="width: 570px; margin: 0 auto; background-color: #FFFFFF; font-family: \'Open Sans\', Arial; font-size: 14px; color: #333;">
        <div id="Header" style="padding: 55px 45px 35px 45px; box-sizing: border-box; border-bottom: 1px solid #ebebeb;">
            <div style="width: 100%; height: auto; overflow: hidden; font-size:20px; font-weight: 700; color:#000; margin-bottom: 28px;">
                DESTEK TALEBİNİZ TARAFIMIZA ULAŞTI
            </div>
            <div style="width: 100%; height: auto;  overflow: hidden;  font-weight: 600; margin-bottom: 25px;">
               Sayın '.$isim.' '.$soyisim.',
                <br>
                <span style="font-weight: 400;">
                    #'.$ticketid.' numaralı destek talebiniz destek birimimize ulaşmıştır. En kısa sürede incelenip cevaplanacaktır. 
                </span>
               <div style="width:100%; border-left:20px solid #EBEBEB; border-top:1px solid #EBEBEB; border-right:1px solid #EBEBEB; border-bottom:1px solid #EBEBEB; box-sizing:border-box; padding:10px; font-weight:400; font-size:13px; margin-top:25px;">
				<span style="font-weight: 600;">'.$konu.'</span>
				<br>
				'.$mesajicerik.'
				</div>
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
                $mail->Subject = "Yeni Destek Talebi Var";
                // Mesaj //
                $mail->isHTML();
                $mail->Body = '<div style="width: 100%; background-color: #f8f8f8;">
    <div style="width: 570px; margin: 0 auto; background-color: #FFFFFF; font-family: \'Open Sans\', Arial; font-size: 14px; color: #333;">
        <div id="Header" style="padding: 55px 45px 35px 45px; box-sizing: border-box; border-bottom: 1px solid #ebebeb;">
            <div style="width: 100%; height: auto; overflow: hidden; font-size:20px; font-weight: 700; color:#000; margin-bottom: 28px;">
                YENİ BİR DESTEK TALEBİ VAR
            </div>
            <div style="width: 100%; height: auto;  overflow: hidden;  font-weight: 600; margin-bottom: 25px;">
               Sayın site sahibi,
                <br>
                <span style="font-weight: 400;">
                    #'.$ticketid.' numaralı yeni bir destek talebiniz var. Talebi incelemek için sitenizin yönetim paneline giriş yaptıktan sonra açık destek talepleri sayfasına gidin ve talebe cevap verin.
                </span>
                <div style="width:100%; border-left:20px solid #EBEBEB; border-top:1px solid #EBEBEB; border-right:1px solid #EBEBEB; border-bottom:1px solid #EBEBEB; box-sizing:border-box; padding:10px; font-weight:400; font-size:13px; margin-top:25px;">
				<span style="font-weight: 600;">'.$konu.'</span>
				<br>
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

                $_SESSION['success_msj']  = 'success' ;

            }else{
            echo 'Veritabanı Hatası';
            }
            /* destek olustur SON */////////////////////////////////////////

            /* Destek Mesajını ekle */
            $msgkaydet = $db->prepare("INSERT INTO uyeler_destek_mesaj SET
                    mesaj=:mesaj,
                    tarih=:tarih,
                    support_id=:support_id,
                    tip=:tip
            ");
            $msgkaydet->execute(array(
                'mesaj' => $mesajicerik,
                'tarih' => $timestamp,
                'support_id' => $ticketid,
                'tip' => '1'
            ));
            /* Destek Mesajını ekle SON */



        }else{
            $_SESSION['msj_hata'] = 'hata';
        }
    }
    ?>
    <?php if (isset($_SESSION['success_msj'])) { ?>
        <div class="user_success_alert">
            <div class="user_success_alert_ic">
                <i class="fa fa-check"></i> <?=$diller['uyelik-destek-mesaj-basarili-yazisi']?>
            </div>
        </div>
        <meta http-equiv="refresh" content="2; URL=<?=$siteurl?>uyelik/destek">
        <?php unset($_SESSION['success_msj']);?>
    <?php }?>
    <?php
    if (isset($_SESSION['msj_hata']) && $_SESSION['msj_hata'] == 'hata') {
        ?>
        <div class="user_success_alert">
            <div class="user_success_alert_ic_red">
                <i class="fa fa-times"></i> <?=$diller['uyelik-destek-mesaj-hat-yazisi']?>
            </div>
        </div>
        <meta http-equiv="refresh" content="2; URL=<?=$siteurl?>uyelik/destek">
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


            <div class="user-right-haed" >
                <i class="ion-help-buoy"></i> <?=$diller['uyepanel-destek']?>
            </div>

            <!-- Modal Alanı !-->
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#newMessage">
                <i class="fa fa-plus-circle"></i> <?=$diller['uyelik-destek-yeni']?>
            </button>
            <br><br>
            <!-- Modal -->
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
            <div class="modal fade" id="newMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle"><?=$diller['uyelik-destek-yeni']?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">

                                <label for="konu"><?=$diller['uyelik-destek-konu']?></label><br>
                                <input type="text" name="konu" id="konu" required class="form-control">
                                <br>
                                <label for="mesaj"><?=$diller['uyelik-destek-mesajiniz']?></label>
                                <br>
                                <textarea name="mesaj" id="mesaj" class="form-control" rows="3" required placeholder="<?=$diller['uyelik-destek-siparisno-uyari']?>"></textarea>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="messagesend" class="btn btn-primary"><?=$diller['uyelik-destek-mesaj-gonder']?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Alanı SON !-->


  <?php if($listele_tablo->rowCount() <= 0  ) {?>
      <div class="alert alert-warning font-open-sans font-13">
          <?=$diller['uyelik-destek-mesaj-yok']?>
      </div>
  <?php }?>


<?php foreach ($tabloAl as $destek) {
        $mesajCek = $db->prepare("select * from uyeler_destek_mesaj where support_id=:support_id order by id desc");
            $mesajCek->execute(array(
                    'support_id' => $destek['support_id']
            ));
            $mesaj = $mesajCek->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="user-ticket-div">
        <div class="user-ticket-div-inbox">
            <div class="user-ticket-div-inbox-di1">
                <i class="fa fa-clock-o"></i> <?=$diller['uyelik-destek-olusturulma-tarih']?>
            </div>
            <div class="user-ticket-div-inbox-di2">
               <?php echo date_tr('j F Y, H:i', ''.$destek['tarih'].''); ?>
            </div>
        </div>
        <div class="user-ticket-div-inbox">
            <div class="user-ticket-div-inbox-di1">
                <i class="fa fa-clock-o"></i> <?=$diller['uyelik-destek-son-tarih']?>
            </div>
            <div class="user-ticket-div-inbox-di2">
                <?php echo date_tr('j F Y, H:i', ''.$mesaj['tarih'].''); ?>
            </div>
        </div>
        <div class="user-ticket-div-inbox user-ticket-mins">
            <div class="user-ticket-div-inbox-di1">
                <?=$diller['uyelik-destek-no']?>
            </div>
            <div class="user-ticket-div-inbox-di2">
                #<?=$destek['support_id']?>
            </div>
        </div>
        <div class="user-ticket-div-inbox">
            <div class="user-ticket-div-inbox-di1">
                <?=$diller['uyelik-destek-konu']?>
            </div>
            <div class="user-ticket-div-inbox-di2">
                <?=$destek['konu']?>
            </div>
        </div>
        <div class="user-ticket-div-inbox user-ticket-mins">
            <div class="user-ticket-div-inbox-di1">
                <?=$diller['uyelik-destek-durum']?>
            </div>
            <div class="user-ticket-div-inbox-di2">
                <?php if($destek['durum'] == 0  ) {?>
                    <div class="user-order-item-delivery" style="background-color: #19b355; color:#FFF"><i class="fa fa-check"></i> <?=$diller['uyelik-destek-cevaplandi']?></div>
                <?php }?>
                <?php if($destek['durum'] == 1  ) {?>
                    <div class="user-order-item-delivery" style="background-color: #ff4443; color:#FFF"><i class="fa fa-dot-circle-o"></i> <?=$diller['uyelik-destek-acik']?></div>
                <?php }?>
            </div>
        </div>
        <div class="user-ticket-div-inbox" style="display: flex; align-items: center; justify-content: center; padding: 5px 0">
            <a href="uyelik/destek-incele/<?=$destek['support_id']?>" class="btn btn-dark btn-sm font-open-sans font-13 font-medium"><i class="fa fa-angle-right"></i> <?=$diller['uyelik-destek-incele']?></a>
        </div>
    </div>
<?php }?>


            <!---- Sayfalama Elementleri ================== !-->
            <?php if($Sayfa >= 1){?>
            <nav aria-label="Page navigation example" style="margin-top:20px;">
                <ul class="pagination pagination-sm justify-content-end">
                    <?php } ?>

                    <?php if($Sayfa > 1){?>

                        <li class="page-item"><a class="page-link" href="uyelik/destek"><?=$diller['sayfalama-ilk']?></a></li>
                        <li class="page-item"><a class="page-link" href="uyelik/destek/<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

                    <?php } ?>
                    <?php
                    for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                        if($i == $Sayfa){

                            echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="uyelik/destek/'.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';

                        }else{
                            echo '
                    <li class="page-item"><a class="page-link" href="uyelik/destek/'.$i.'">'.$i.'</a></li>
                    ';
                        }
                    }
                    }
                    ?>

                    <?php if($listele_tablo->rowCount() <=0) { } else { ?>
                        <?php if($Sayfa != $Sayfa_Sayisi){?>

                            <li class="page-item"><a class="page-link" href="uyelik/destek/<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                            <li class="page-item"><a class="page-link" href="uyelik/destek/<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


                        <?php }} ?>

                    <?php if($Sayfa >= 1){?>
                </ul>
            </nav>
        <?php } ?>
            <!---- Sayfalama Elementleri ================== !-->



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