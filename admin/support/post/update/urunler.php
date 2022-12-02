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
    if (isset($_POST['urundegis'])) {


        if ($_POST['urun_kod'] == !null) {

            $urunkodu = $_POST['urun_kod'];

        } else {

            function get_random_string($length = 7, $characters = "ABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789")
            {

                $return = "";
                $num_characters = strlen($characters) - 1;
                while (strlen($return) < $length) {
                    $return .= $characters[mt_rand(0, $num_characters)];
                }
                return $return;
            }

            $urunkodu = get_random_string();
        }


        if ($_FILES['gorsel']["size"] > 0) {

            $timestamp = date('Y-m-d G:i:s');

            $dosyas = $_FILES["gorsel"];
            $kaynak = $_FILES["gorsel"]["tmp_name"];
            $dosya = $_FILES["gorsel"]["name"];
            $uzanti = explode(".", $_FILES['gorsel']['name']);
            $random = rand(0, 9999999999999);
            $random2 = rand(0, 999);
            $yeni_isim = $random . "-" . $random2 . "-" . $dosya;
            $hedef = "../../../../images/product/" . $yeni_isim;


            if ($dosyas['type'] == 'image/jpg' || $dosyas['type'] == 'image/jpeg' || $dosyas['type'] == 'image/png') {

                $gitti = move_uploaded_file($kaynak, $hedef);


                $guncelle = $db->prepare("UPDATE urun SET
        urun_kod=:urun_kod,
        marka=:marka,
        baslik=:baslik,
        durum=:durum,
        kat_id=:kat_id,  
        spot=:spot,
        icerik=:icerik,
        gorsel=:gorsel,
        meta_desc=:meta_desc,
        tags=:tags,  
        star_rate=:star_rate,
        stok=:stok,
        fiyat=:fiyat,
        eski_fiyat=:eski_fiyat,
        kdv=:kdv,  
        kdv_oran=:kdv_oran,
        kargo=:kargo,
        kargo_ucret=:kargo_ucret,
        yorum_durum=:yorum_durum,
        embed=:embed,
        ek_bilgi=:ek_bilgi
        WHERE id={$_POST['urun_id']}
        ");
                $guncellenmis = $guncelle->execute(array(
                    'urun_kod' => $urunkodu,
                    'marka' => $_POST['marka'],
                    'baslik' => $_POST['baslik'],
                    'durum' => $_POST['durum'],
                    'kat_id' => $_POST['kat_id'],
                    'spot' => $_POST['spot'],
                    'icerik' => $_POST['icerik'],
                    'gorsel' => $yeni_isim,
                    'meta_desc' => $_POST['meta_desc'],
                    'tags' => $_POST['tags'],
                    'star_rate' => $_POST['star_rate'],
                    'stok' => $_POST['stok'],
                    'fiyat' => $_POST['fiyat'],
                    'eski_fiyat' => $_POST['eski_fiyat'],
                    'kdv' => $_POST['kdv'],
                    'kdv_oran' => $_POST['kdv_oran'],
                    'kargo' => $_POST['kargo'],
                    'kargo_ucret' => $_POST['kargo_ucret'],
                    'yorum_durum' => $_POST['yorum_durum'],
                    'embed' => $_POST['embed'],
                    'ek_bilgi' => $_POST['ek_bilgi']
                ));
                if ($guncellenmis) {


                    $resimsilunlink = $_POST['eski_gorsel'];
                    unlink("../../../../images/product/$resimsilunlink");
                    Header("location: ../../../pages.php?sayfa=urunler&status=success");

                } else {

                    Header("location: ../../../pages.php?sayfa=urunler&status=warning");

                }

            } else {
                Header("location: ../../../pages.php?sayfa=urun&urun_id=$_POST[urun_id]&status=imgtype");
            }

        } else {


            $guncelle = $db->prepare("UPDATE urun SET
        urun_kod=:urun_kod,
        marka=:marka,
        baslik=:baslik,
        durum=:durum,
        kat_id=:kat_id,  
        spot=:spot,
        icerik=:icerik,
        meta_desc=:meta_desc,
        tags=:tags,  
        star_rate=:star_rate,
        stok=:stok,
        fiyat=:fiyat,
        eski_fiyat=:eski_fiyat,
        kdv=:kdv,  
        kdv_oran=:kdv_oran,
        kargo=:kargo,
        kargo_ucret=:kargo_ucret,
        yorum_durum=:yorum_durum,
        embed=:embed,
        ek_bilgi=:ek_bilgi
        WHERE id={$_POST['urun_id']}
        ");
            $guncellenmis = $guncelle->execute(array(
                'urun_kod' => $urunkodu,
                'marka' => $_POST['marka'],
                'baslik' => $_POST['baslik'],
                'durum' => $_POST['durum'],
                'kat_id' => $_POST['kat_id'],
                'spot' => $_POST['spot'],
                'icerik' => $_POST['icerik'],
                'meta_desc' => $_POST['meta_desc'],
                'tags' => $_POST['tags'],
                'star_rate' => $_POST['star_rate'],
                'stok' => $_POST['stok'],
                'fiyat' => $_POST['fiyat'],
                'eski_fiyat' => $_POST['eski_fiyat'],
                'kdv' => $_POST['kdv'],
                'kdv_oran' => $_POST['kdv_oran'],
                'kargo' => $_POST['kargo'],
                'kargo_ucret' => $_POST['kargo_ucret'],
                'yorum_durum' => $_POST['yorum_durum'],
                'embed' => $_POST['embed'],
                'ek_bilgi' => $_POST['ek_bilgi']
            ));
            if ($guncellenmis) {

                Header("location: ../../../pages.php?sayfa=urunler&status=success");

            } else {

                Header("location: ../../../pages.php?sayfa=urunler&status=warning");

            }


        }


    }

}

?>


