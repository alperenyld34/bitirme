<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
if ($userSorgusu->rowCount()>0){
    $adres_id = gets('address_id');

    $sil = $db->prepare("DELETE from uyeler_adres WHERE adres_id=:adres_id");
    $islem = $sil->execute(array(
        'adres_id' => $adres_id
    ));

    if ($islem) {
        header('Location: '.$siteurl.'uyelik/kayitli-adresler');
        $_SESSION['sil_success']='success';
    }else {
        echo 'veritabanı hatası';
    }
}