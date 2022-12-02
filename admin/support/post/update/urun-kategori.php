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
    if (isset($_POST['urunkatdegis'])) {


        if ($_FILES['gorsel']["size"] > 0) {


            $dosyas = $_FILES["gorsel"];
            $kaynak = $_FILES["gorsel"]["tmp_name"];
            $dosya = $_FILES["gorsel"]["name"];
            $uzanti = explode(".", $_FILES['gorsel']['name']);
            $random = rand(0, 9999999999999);
            $random2 = rand(0, 999);
            $yeni_isim = $random . "-" . $random2 . "-" . $dosya;
            $hedef = "../../../../images/product-category/" . $yeni_isim;


            if ($dosyas['type'] == 'image/jpg' || $dosyas['type'] == 'image/jpeg' || $dosyas['type'] == 'image/png') {

                $gitti = move_uploaded_file($kaynak, $hedef);


                $kaydet = $db->prepare("UPDATE urun_cat SET
        baslik=:baslik,
        icon=:icon,
        sira=:sira,  
        ust_id=:ust_id,
        durum=:durum,
        anasayfa=:anasayfa,  
        anasayfa_grup=:anasayfa_grup,
        meta_desc=:meta_desc,
        tags=:tags,
        gorsel=:gorsel
        WHERE id={$_POST['kat_id']}
        ");
                $ekle = $kaydet->execute(array(
                    'baslik' => $_POST['baslik'],
                    'icon' => $_POST['icon'],
                    'sira' => $_POST['sira'],
                    'ust_id' => $_POST['ust_id'],
                    'durum' => $_POST['durum'],
                    'anasayfa' => $_POST['anasayfa'],
                    'anasayfa_grup' => $_POST['anasayfa_grup'],
                    'meta_desc' => $_POST['meta_desc'],
                    'tags' => $_POST['tags'],
                    'gorsel' => $yeni_isim
                ));
                if ($ekle) {

                    $resimsilunlink = $_POST['eski_gorsel'];
                    unlink("../../../../images/product-category/$resimsilunlink");
                    Header("location: ../../../pages.php?sayfa=urunkategorileri&status=success");

                } else {

                    Header("location: ../../../pages.php?sayfa=urunkategorileri&status=warning");

                }

            } else {
                Header("location: ../../../pages.php?sayfa=urunkategori&kategori_id=$_POST[kat_id]&status=imgtype");
            }

        } else {


            $kaydet = $db->prepare("UPDATE urun_cat SET
        baslik=:baslik,
        icon=:icon,
        sira=:sira,  
        ust_id=:ust_id,
        durum=:durum,
        anasayfa=:anasayfa,  
        anasayfa_grup=:anasayfa_grup,
        meta_desc=:meta_desc,
        tags=:tags
        WHERE id={$_POST['kat_id']}
        ");
            $ekle = $kaydet->execute(array(
                'baslik' => $_POST['baslik'],
                'icon' => $_POST['icon'],
                'sira' => $_POST['sira'],
                'ust_id' => $_POST['ust_id'],
                'durum' => $_POST['durum'],
                'anasayfa' => $_POST['anasayfa'],
                'anasayfa_grup' => $_POST['anasayfa_grup'],
                'meta_desc' => $_POST['meta_desc'],
                'tags' => $_POST['tags']
            ));
            if ($ekle) {

                Header("location: ../../../pages.php?sayfa=urunkategorileri&status=success");

            } else {

                Header("location: ../../../pages.php?sayfa=urunkategorileri&status=warning");

            }


        }


    }

}

?>


