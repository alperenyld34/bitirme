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


if ( $_GET[ 'uye' ] == "success" )
{
    ////////////////////////////////////////////
    /* Adresileri sil */
            
        $silmeislem = $db->prepare("DELETE from uyeler_adres WHERE uye_id=:uye_id");
        $silmeislems = $silmeislem->execute(array(
           'uye_id' => $_GET['id']
        ));

    /* Adresileri sil SON */


/////////////////////////////////////////////////    
/* Destek Mesajları Sil */
    $silmeislem2 = $db->prepare("DELETE from uyeler_destek WHERE user_id=:user_id");
    $silmeislem2s = $silmeislem2->execute(array(
        'user_id' => $_GET['id']
    ));
/* Destek Mesajları Sil SON */
////////////////////////////////////////////
    $sil     = $db->prepare( "DELETE from uyeler where id=:id" );
    $kontrol = $sil->execute(
        array(
            'id' => $_GET[ 'id' ]
        )
    );

    if ( $kontrol )
    {

        Header("location: ../../../pages.php?sayfa=uyeler&status=success");
    }
    else
    {

        Header( "location: ../../../pages.php?sayfa=uyeler&status=warning" );
    }
}


}
?>