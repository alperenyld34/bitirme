<?php
if(isset($_POST['addcomment'])) {

    $yildiz = strip_tags(trim($_POST['star_rate']));
    $urun_id = $_SESSION['urun_id_kaydet'];
    $baslik = trim(strip_tags($_POST['baslik']));
    $isim= $userCek['isim'];
    $soyisim= $userCek['soyisim'];
    $yorum = trim(strip_tags($_POST['yorum']));
    $tarih = $timestamp = date('Y-m-d G:i:s');
    $uye_id = $userCek['id'];
    
    
    if($_POST['gizli'] == '1' || $_POST['gizli'] == '0' ) {
     $gizli = trim(strip_tags($_POST['gizli']));
    }else{
        $gizli = '1';
    }

    if($_POST['gizli'] == null  ) {
        $gizli = '1';
    }

    if($yildiz && $baslik && $yorum) {
        $kaydet = $db->prepare("INSERT INTO urun_yorum SET
        uye_id=:uye_id,
        yildiz=:yildiz,
        urun_id=:urun_id,
        gizli=:gizli,
        onay=:onay,
        tarih=:tarih,
        baslik=:baslik,
        isim=:isim,
        soyisim=:soyisim,
        yorum=:yorum
");
        $sonuc = $kaydet->execute(array(
            'uye_id' => $uye_id,
            'yildiz' => $yildiz,
            'urun_id' => $urun_id,
            'gizli' => $gizli,
            'onay' => '0',
            'tarih' => $tarih,
            'baslik' => $baslik,
            'isim' => $isim,
            'soyisim' => $soyisim,
            'yorum' => $yorum
        ));
        if($sonuc){
            $_SESSION['yorum_eklendi'] = 'success';
            header('Location:'.$_SESSION['urun_adres_kaydet'].'');
        }else{
            echo 'Veritabanı Hatası';
        }
    }else{
        $_SESSION['yorum_eklendi'] = 'empty';
        header('Location:'.$_SESSION['urun_adres_kaydet'].'');
    }
} else {
  header('Location:index.php');
}
?>