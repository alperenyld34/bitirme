<?php
if(isset($_POST['userlogin'])){
    $epostaname = trim(strip_tags($_POST['emailadress']));
    $pass_sifre = md5($_POST['password']);


    if (filter_var($epostaname, FILTER_VALIDATE_EMAIL)){



    if ($epostaname && $pass_sifre) {


        $kullanicisor = $db->prepare("SELECT * from uyeler where eposta=:eposta and uyesifre=:uyesifre");
        $kullanicisor->execute(
            array(
                'eposta' => $epostaname,
                'uyesifre' => $pass_sifre
            )
        );

        $say = $kullanicisor->rowCount();

        if ($say > 0) {

            $_SESSION['user_email_address'] = $epostaname;
            $_SESSION['basarili_giris'] = 'success';
            header('Location:'.$_SESSION['urun_adres_kaydet'].'');

        }else {
            header('Location:uye-girisi');
            $sorun = '<strong>HATA!</strong> Giriş bilgileriniz yanlış!';
            $_SESSION['uyegiris_sorun'] = $sorun;
        }
    } else {
        header('Location:uye-girisi');
        $sorun = '<strong>HATA!</strong> Boş alan bırakamazsınız.';
        $_SESSION['uyegiris_sorun'] = $sorun;
    }

    }else {
        header('Location:uye-girisi');
        $sorun = '<strong>HATA!</strong> Geçerli bir e-posta adresi girin';
        $_SESSION['uyegiris_sorun'] = $sorun;
    }

    } else {
    header('Location:index.html');

}
?>

