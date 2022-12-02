<?php
ob_start();
session_start();
include "../config/config.php";
date_default_timezone_set( 'Europe/Istanbul' );
$settings=$db->prepare("SELECT * from ayarlar where id='1'");
$settings->execute(array(0));
$ayar=$settings->fetch(PDO::FETCH_ASSOC);
$siteurl = $ayar['site_url'];
?>
<?php
if (isset($_POST['ebultengonder'])) {

    if($_POST['eposta'])
    {

    $timestamp = date('Y-m-d G:i:s');

    $kaydet = $db->prepare("INSERT INTO ebulten SET
        eposta=:eposta
        ");
    $ekle = $kaydet->execute(array(
        'eposta' => trim(strip_tags($_POST['eposta']))
    ));
    if ($ekle) {

        header("location: ".$siteurl."index.html?status=bulten");

    } else {

        header("location: ".$siteurl."index.html?status=warning");
    }
}else {

        $ebultenArray = array(
            "status" => "error"
        );
        $_SESSION["ebulten_array"] = $ebultenArray;

        header("location: ".$siteurl."");

    }

}
?>