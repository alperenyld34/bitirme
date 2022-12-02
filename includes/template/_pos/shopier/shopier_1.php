<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
include_once 'Shopier.php';

$Api_Key= $odemeayar['shopier_key'];
$Api_Secret= $odemeayar['shopier_secret'];

$firstname=htmlspecialchars($_SESSION['siparis_isim']);
$lastname=htmlspecialchars($_SESSION['siparis_soyisim']);
$email=htmlspecialchars($_SESSION['siparis_eposta']);
$phone=htmlspecialchars($_SESSION['siparis_tel']);
$address=htmlspecialchars($_SESSION['siparis_adres']);
$city=htmlspecialchars($_SESSION['siparis_sehir']);
$price=htmlspecialchars($_SESSION['toplam_odenecek_tutar']);
$postacode=htmlspecialchars($_SESSION['siparis_postakodu']);
$country=htmlspecialchars('Turkiye');


$shopier = new Shopier($Api_Key, $Api_Secret);
$shopier->setBuyer([
    'id' => 52,
    'first_name' => $firstname, 'last_name' => $lastname, 'email' => $email, 'phone' => $phone]);
$shopier->setOrderBilling([
    'billing_address' => $address,
    'billing_city' => $city,
    'billing_country' => $country,
    'billing_postcode' => $postacode,
]);
$shopier->setOrderShipping([
    'shipping_address' => $address,
    'shipping_city' => $city,
    'shipping_country' => $country,
    'shipping_postcode' => $postacode,
]);

die($shopier->run(time(), $price, ''.$ayar['site_url'].'pages.php?sayfa=shopiersuccess'));





?>
