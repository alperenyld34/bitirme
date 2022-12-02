<?php

session_start();
include "../../../includes/config/config.php";
date_default_timezone_set( 'Europe/Istanbul' );
?>
<?php

    $user_adi = $_POST['user'];
    $pass_sifre = md5($_POST['password']);

    if ($user_adi && $pass_sifre) {


        $kullanicisor = $db->prepare("SELECT * from yonetici where user_adi=:user_adi and pass_sifre=:pass_sifre");
        $kullanicisor->execute(
            array(
                'user_adi' => $user_adi,
                'pass_sifre' => $pass_sifre
            )
        );

        $say = $kullanicisor->rowCount();

        if ($say > 0) {

            $_SESSION['admin_username'] = $user_adi;

?>
            <div class="progress m-t-30">
                <div class="progress-bar bg-success wow animated progress-animated" style="width: 100%; height:6px;" role="progressbar"> </div>
            </div>
            <div style="width: 100%; height: auto; padding: 10px 0 10px 0; background-color: #00c292; color:#FFF; text-align: center;">
                <i class="fa fa-check"></i>
                Başarıyla Giriş Yapıldı.

            </div>
            <meta id="refresh" http-equiv="refresh" content="3; url=index.php" />

  <?php   } else { ?>


<div style="width: 100%; height: auto; padding: 10px 0 10px 0; background-color: #e46a76; color:#FFF; text-align: center;">
    <i class="fa fa-exclamation-circle"></i>
    Girilen Bilgilerde Hata Var!

</div>

<?php
        }
    }

?>
