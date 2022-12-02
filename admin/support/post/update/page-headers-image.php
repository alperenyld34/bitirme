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
    if (isset($_POST['pagegorseldegis'])) {

        if ($_FILES['bg_image']["size"] > 0) {
            $dosyas = $_FILES["bg_image"];
            $kaynak = $_FILES["bg_image"]["tmp_name"];
            $dosya = $_FILES["bg_image"]["name"];
            $uzanti = explode(".", $_FILES['bg_image']['name']);
            $random = rand(0, 9999999999999);
            $random2 = rand(0, 999);
            $yeni_isim = $random . "-" . $random2 . "-" . $dosya;
            $hedef = "../../../../images/uploads/" . $yeni_isim;


            if ($dosyas['type'] == 'image/jpg' || $dosyas['type'] == 'image/jpeg' || $dosyas['type'] == 'image/png') {

                $gitti = move_uploaded_file($kaynak, $hedef);

                $ayarkaydet = $db->prepare(
                    "UPDATE page_header SET
			bg_image=:bg_image	
			WHERE id={$_POST['page_id']}"
                );
                $update = $ayarkaydet->execute(
                    array(
                        'bg_image' => $yeni_isim
                    )
                );

                if ($update) {

                    $resimsilunlink = $_POST['eski_bg'];
                    unlink("../../../../images/uploads/$resimsilunlink");

                    Header("location: ../../../pages.php?sayfa=pagehead&page_id=$_POST[page_id]&status=success");
                } else {

                    Header("location: ../../../pages.php?sayfa=pagehead&page_id=$_POST[page_id]&status=warning");
                }


            } else {

                Header("location: ../../../pages.php?sayfa=pagehead&page_id=$_POST[page_id]&status=imgtype");
            }


        }

    }
}
?>


