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
    if (isset($_POST['icondegis'])) {

        if ($_FILES['icon']["size"] > 0) {
            $dosyas = $_FILES["icon"];
            $kaynak = $_FILES["icon"]["tmp_name"];
            $dosya = $_FILES["icon"]["name"];
            $uzanti = explode(".", $_FILES['icon']['name']);
            $random = rand(0, 9999999999999);
            $random2 = rand(0, 999);
            $yeni_isim = $random . "-" . $random2 . "-" . $dosya;
            $hedef = "../../../../images/loader/" . $yeni_isim;


            if ($dosyas['type'] == 'image/jpg' || $dosyas['type'] == 'image/jpeg' || $dosyas['type'] == 'image/png' || $dosyas['type'] == 'image/svg+xml') {

                $gitti = move_uploaded_file($kaynak, $hedef);

                $ayarkaydet = $db->prepare(
                    "UPDATE loader SET
			icon=:icon	
			WHERE id='1'"
                );
                $update = $ayarkaydet->execute(
                    array(
                        'icon' => $yeni_isim
                    )
                );

                if ($update) {

                    $resimsilunlink = $_POST['eski_gorsel'];
                    unlink("../../../../images/loader/$resimsilunlink");

                    Header("location: ../../../pages.php?sayfa=loaderayar&status=success");
                } else {

                    Header("location: ../../../pages.php?sayfa=loaderayar&status=warning");
                }


            } else {

                Header("location: ../../../pages.php?sayfa=loaderayar&status=imgtype");
            }


        }

    }
}
?>


