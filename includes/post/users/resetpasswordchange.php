<?php
if(isset($_POST['reset'])) {
    if($_POST['newpass']  ) {
        $sifre = md5($_POST['newpass']);
        /* Üye sorgula */
            $uyeCek = $db->prepare("select * from uyeler where id=:id ");
                $uyeCek->execute(array(
                    'id' => $_SESSION['uyeids']
                ));
                if($uyeCek->rowCount()>0  ) { 
                 /* Update işlemi */
                    $guncelle = $db->prepare("UPDATE uyeler SET
                            uyesifre=:uyesifre
                     WHERE id={$_SESSION['uyeids']}      
                    ");
                    $sonuc = $guncelle->execute(array(
                        'uyesifre' => $sifre,
                    ));
                    if($sonuc){
                        $_SESSION['cgpass'] = 'success';
                        header('Location:uye-girisi');
                        unset($_SESSION['uyeids']);
                        unset($_SESSION['epostareset']);
                    }else{
                    echo 'Veritabanı Hatası';
                    }
                 /* Update işlemi SON */
                }else{
                  header('Location:404');  
                }
        /* Üye sorgula SON */
    }else{
        $_SESSION['bos'] = 'bos';
        header('Location:password-reset?key='.$_SESSION['epostareset'].'');
    }
}
?>