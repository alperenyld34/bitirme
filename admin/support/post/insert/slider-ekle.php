<?php
ob_start();
session_start();
include "../../../../includes/config/config.php";
date_default_timezone_set( 'Europe/Istanbul' );
$settings=$db->prepare("SELECT * from ayarlar where id='1'");
$settings->execute(array(0));
$ayar=$settings->fetch(PDO::FETCH_ASSOC);
$siteurl = $ayar['site_url'];
?>


<?php
include_once '../../secure_post.php';
if ($adminsorgusu->rowCount()===0) {
    header("Location: 404");
} else {
    if (isset($_POST['sliderekle'])) {


        if ($_FILES['gorsel']["size"] > 0) {


            $dosyas = $_FILES["gorsel"];
            $kaynak = $_FILES["gorsel"]["tmp_name"];
            $dosya = $_FILES["gorsel"]["name"];
            $uzanti = explode(".", $_FILES['gorsel']['name']);
            $random = rand(0,(int) 9999999999999);
            $random2 = rand(0,(int) 999);
            $yeni_isim = $random . "-" . $random2 . "-" . $dosya;
            $hedef = "../../../../images/slider/" . $yeni_isim;


            if ($dosyas['type'] == 'image/jpg' || $dosyas['type'] == 'image/jpeg' || $dosyas['type'] == 'image/png') {

                $gitti = move_uploaded_file($kaynak, $hedef);


                $kaydet = $db->prepare("INSERT INTO slider SET
        baslik=:baslik,
        spot=:spot,
        dil=:dil,
        durum=:durum,
        text_status=:text_status,
        button_text=:button_text,
        dark_bg=:dark_bg,
        sira=:sira,
        area=:area,
        url=:url,
        baslik_animation=:baslik_animation,
        spot_animation=:spot_animation,
        button_animation=:button_animation,     
        text_bg=:text_bg,
        button_bg=:button_bg,
        button_text_color=:button_text_color,
           tur=:tur,
        gorsel=:gorsel
        ");
                $ekle = $kaydet->execute(array(
                    'baslik' => $_POST['baslik'],
                    'spot' => $_POST['spot'],
                    'dil' => $_POST['dil'],
                    'durum' => $_POST['durum'],
                    'text_status' => $_POST['text_status'],
                    'button_text' => $_POST['button_text'],
                    'dark_bg' => $_POST['dark_bg'],
                    'sira' => $_POST['sira'],
                    'area' => $_POST['area'],
                    'url' => $_POST['url'],
                    'baslik_animation' => $_POST['baslik_animation'],
                    'spot_animation' => $_POST['spot_animation'],
                    'button_animation' => $_POST['button_animation'],
                    'text_bg' => $_POST['text_bg'],
                    'button_bg' => $_POST['button_bg'],
                    'button_text_color' => $_POST['button_text_color'],
                    'tur' => 1,
                    'gorsel' => $yeni_isim
                ));
                if ($ekle) {

                    Header("location: ../../../pages.php?sayfa=sliderlar&status=success");

                } else {

                    Header("location: ../../../pages.php?sayfa=sliderlar&status=warning");

                }

            } else {
                Header("location: ../../../pages.php?sayfa=sliderekle&status=imgtype");
            }

        }


    }


}
?>


