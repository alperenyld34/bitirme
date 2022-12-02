<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php

$timestamp = date('Y-m-d G:i:s');

$kaydet=$db->prepare("INSERT INTO siparis SET
        ara_tutar=:ara_tutar,
        kdv_tutar=:kdv_tutar,
        kargo_tutar=:kargo_tutar,
        toplam_tutar=:toplam_tutar,
        isim=:isim,
        tel=:tel,
        eposta=:eposta,
        adres=:adres,
        adres_fatura=:adres_fatura,
        sehir=:sehir,
        postakodu=:postakodu,
        notlar=:notlar,
        odeme_tip=:odeme_tip,
        siparis_no=:siparis_no,
        user_id=:user_id,
        siparis_durum=:siparis_durum,
        siparis_tarih=:siparis_tarih
        ");
$ekle=$kaydet->execute(array(
    'ara_tutar'   => $_SESSION['ara_tutar'],
    'kdv_tutar'   => $_SESSION['kdv_tutar'],
    'kargo_tutar'   => $_SESSION['kargo_tutar'],
    'toplam_tutar'   => $_SESSION['toplam_odenecek_tutar'],
    'isim'   => $_SESSION['siparis_isim']." ".$_SESSION['siparis_soyisim'],
    'tel'  => $_SESSION['siparis_tel'],
    'eposta'   => $_SESSION['siparis_eposta'],
    'adres'  => $_SESSION['siparis_adres'],
    'adres_fatura' => $_SESSION['siparis_fatura_adres'],
    'sehir'   => $_SESSION['siparis_ilce']." / ". $_SESSION['siparis_sehir'],
    'postakodu'  => $_SESSION['siparis_postakodu'],
    'notlar'   => $_SESSION['siparis_not'],
    'odeme_tip'   => 1,
    'siparis_no'  => $_SESSION['siparis_numarasi'],
    'user_id' => $userCek['id'],
    'siparis_durum' => 99,
    'siparis_tarih' => $timestamp
));
if ($ekle) {


///////////////////////////////////////////** Sepetteki Ürünleri Veritabanına Aktar *//////////////////////////////////////////
    if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"])> 0) {

        foreach($_SESSION["shopping_cart"] as $product) {


            $siparisurunkaydet=$db->prepare("INSERT INTO siparis_urunler SET
        urun_id=:urun_id,
        siparis_id=:siparis_id,
        urun_baslik=:urun_baslik,
        adet=:adet,
        varyantlar=:varyantlar,
        tutar=:tutar,
        kdv_tutar=:kdv_tutar,
        kargo_tutar=:kargo_tutar
        ");
            $siparisurunekle=$siparisurunkaydet->execute(array(
                'urun_id'   => $product['item_id'],
                'siparis_id'   => $_SESSION['siparis_numarasi'],
                'urun_baslik'   => $product['item_name'],
                'adet'   => $product['item_quantity'],
                'varyantlar'   => $product['var'],
                'tutar'   => $product['item_fiyat'],
                'kdv_tutar'   => $product['item_kdv_tutar'],
                'kargo_tutar'   => $product['item_kargo_tutar']
            ));
            if ($siparisurunekle) {

            }

        }

    }
 } else {

    echo'Mysql Table Warning!';
}

?>




