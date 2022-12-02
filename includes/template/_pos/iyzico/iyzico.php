<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
require_once('IyzipayBootstrap.php');

IyzipayBootstrap::init();

class Config
{

    public static function options()
    {
        global $db;
        $statement = $db->prepare("select * from odeme_ayar where id='1'");
        $statement->execute();
        $setset = $statement->fetch(PDO::FETCH_ASSOC);

        $iyzico_api = $setset['iyzico_key'];
        $iyzico_secure = $setset['iyzico_secure'];


        $options = new \Iyzipay\Options();
        $options->setApiKey($iyzico_api);
        $options->setSecretKey($iyzico_secure);
        $options->setBaseUrl("https://api.iyzipay.com");
        return $options;
    }
}

if( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
    $ip = $_SERVER["HTTP_CLIENT_IP"];
} elseif( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
    $ip = $_SERVER["REMOTE_ADDR"];
}

$adsoyad = "".$_SESSION['siparis_isim']." ".$_SESSION['siparis_soyisim']."";
$user_name = $_SESSION['siparis_isim'];
$user_surname = $_SESSION['siparis_soyisim'];
$payment_amount	= $_SESSION['toplam_odenecek_tutar'];
$merchant_oid = "".$_SESSION['siparis_numarasi']."";
$user_emaill = $_SESSION['siparis_eposta'];
$user_address = $_SESSION['siparis_adres'];
$user_phone = $_SESSION['siparis_tel'];
$postakodu = $_SESSION['siparis_postakodu'];
$sehir = $_SESSION['siparis_sehir'];
$sehirilcesi = $_SESSION['siparis_ilce'];
$timestamp = date('Y-m-d G:i:s');

# create request class
$request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
$request->setLocale(\Iyzipay\Model\Locale::TR);
$request->setConversationId("$merchant_oid");
$request->setPrice($payment_amount);
$request->setPaidPrice($payment_amount);
$request->setCurrency(\Iyzipay\Model\Currency::TL);
$request->setBasketId("$merchant_oid");
$request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
$request->setCallbackUrl("".$siteurl."odeme-basarili?status=ordersuccess&orderID=".$_SESSION['siparis_numarasi']."");
$request->setEnabledInstallments(array(2, 3, 6, 9));


$buyer = new \Iyzipay\Model\Buyer();
$buyer->setId("$merchant_oid");
$buyer->setName("$user_name");
$buyer->setSurname("$user_surname");
$buyer->setGsmNumber("$user_phone");
$buyer->setEmail("$user_emaill");
$buyer->setIdentityNumber("-----");
$buyer->setLastLoginDate("$timestamp");
$buyer->setRegistrationDate("$timestamp");
$buyer->setRegistrationAddress("$user_address");
$buyer->setIp("$ip");
$buyer->setCity("$sehir");
$buyer->setCountry("Türkiye");
$buyer->setZipCode("$postakodu");
$request->setBuyer($buyer);

$shippingAddress = new \Iyzipay\Model\Address();
$shippingAddress->setContactName("$adsoyad");
$shippingAddress->setCity("$sehir");
$shippingAddress->setCountry("Türkiye");
$shippingAddress->setAddress("$user_address");
$shippingAddress->setZipCode("$postakodu");
$request->setShippingAddress($shippingAddress);

$billingAddress = new \Iyzipay\Model\Address();
$billingAddress->setContactName("$adsoyad");
$billingAddress->setCity("$sehir");
$billingAddress->setCountry("Türkiye");
$billingAddress->setAddress("$user_address");
$billingAddress->setZipCode("$postakodu");
$request->setBillingAddress($billingAddress);

$basketItems = array();
$firstBasketItem = new \Iyzipay\Model\BasketItem();
$firstBasketItem->setId("$merchant_oid");
$firstBasketItem->setName("$merchant_oid sipariş numaralı ürünler");
$firstBasketItem->setCategory1(".");
$firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
$firstBasketItem->setPrice($payment_amount);
$basketItems[0] = $firstBasketItem;
$request->setBasketItems($basketItems);


# make request
$checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($request, Config::options());

# print result
//print_r($checkoutFormInitialize);
//print_r($checkoutFormInitialize->getstatus());
print_r($checkoutFormInitialize->getErrorMessage());
print_r($checkoutFormInitialize->getCheckoutFormContent());
?>
<div  id="iyzipay-checkout-form" class="responsive"></div>