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
    if (isset($_POST['favicondegis'])) {

        if ($_FILES['site_favicon']["size"] > 0) {
            $dosyas = $_FILES["site_favicon"];
            $kaynak = $_FILES["site_favicon"]["tmp_name"];
            $dosya = $_FILES["site_favicon"]["name"];
            $uzanti = explode(".", $_FILES['site_favicon']['name']);
            $random = rand(0, 9999999999999);
            $random2 = rand(0, 999);
            $yeni_isim = "favicon.ico";
            $hedef = "../../../../images/" . $yeni_isim;


            if ($dosyas['type'] == 'image/x-icon' || $dosyas['type'] == 'image/png') {

                $gitti = move_uploaded_file($kaynak, $hedef);

                $ayarkaydet = $db->prepare(
                    "UPDATE ayarlar SET
			site_favicon=:site_favicon	
			WHERE id='1'"
                );
                $update = $ayarkaydet->execute(
                    array(
                        'site_favicon' => $yeni_isim
                    )
                );

                if ($update) {

                    $resimsilunlink = $_POST['eski_favicon'];
                    unlink("../../../../images/$resimsilunlink");

                    Header("location: ../../../pages.php?sayfa=temaayar&status=success");
                } else {

                    Header("location: ../../../pages.php?sayfa=temaayar&status=warning");
                }


            } else {

                Header("location: ../../../pages.php?sayfa=temaayar&status=favtype");
            }


        }

    }
}
?>


