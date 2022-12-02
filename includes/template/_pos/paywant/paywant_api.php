<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
if( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
    $ip = $_SERVER["HTTP_CLIENT_IP"];
} elseif( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
    $ip = $_SERVER["REMOTE_ADDR"];
}

$paywant_api = $odemeayar["paywant_key"];
$paywant_secret = $odemeayar["paywant_secret"];
$odemeturleri = $odemeayar["paywant_odeme_tur"];

$apiKey		= $paywant_api;	// api anahtarı
$apiSecret 	= $paywant_secret;					// api gizli anahtarı
$userID		= $_SESSION['paywant_userid'];							// kullanıcı id
$userEmail	= $_SESSION['siparis_eposta'];		// kullanıcı e-mail adresi
$returnData	= $_SESSION['siparis_eposta']; 						// sipariş kodu
$userIPAdresi = $ip;					// kullanıcının ip adresi

$hashOlustur = base64_encode(hash_hmac('sha256',"$returnData|$userEmail|$userID".$apiKey,$apiSecret,true));

$productData = array(
    "name" =>  "Sepet No :" .$_SESSION['siparis_numarasi'], // Ürün adı
    "amount" => $_SESSION['toplam_odenecek_tutar']*100, 				// Ürün fiyatı, 10 TL : 1000
    "extraData" => $_SESSION['siparis_numarasi'],				// Notify sayfasına iletilecek ekstra veri
    "paymentChannel" => $odemeturleri,	// Bu ödeme için kullanılacak ödeme kanalları
    "commissionType" => 1			// Komisyon tipi, 1: Yansıt, 2: Üstlen
);

$postData = array(
    'apiKey' => $apiKey,
    'hash' => $hashOlustur,
    'returnData'=> $returnData,
    'userEmail' => $userEmail,
    'userIPAddress' => $userIPAdresi,
    'userID' => $userID,
    'proApi' => true,
    'productData' => $productData
);

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.paywant.com/gateway.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS =>  http_build_query($postData),
));

$response = curl_exec($curl);
$err = curl_error($curl);

if ($err)
    echo "cURL Error #:" . $err;
else{
    $jsonDecode = json_decode($response,false);
    if($jsonDecode->Status == 100){
        $jsonDecode->Message = str_replace("http://","https://",$jsonDecode->Message);

        // Ortak odeme sayfasina yonlendir
    }else
        echo $response;
}

curl_close($curl);
?>
<iframe seamless="seamless" style="display:block; width: 100%; height:100vh;" frameborder="0" scrolling='yes' src="<?php echo $jsonDecode->Message?>" id='odemeFrame'></iframe>


<?php
foreach($_SESSION["shopping_cart"] as $keys => $values)
{
    unset($_SESSION["shopping_cart"][$keys]);
}
?>
<?php unset($_SESSION['siparis_numarasi']); ?>
<?php unset($_SESSION['siparis_isim']); ?>
<?php unset($_SESSION['siparis_soyisim']); ?>
<?php unset($_SESSION['siparis_eposta']); ?>
<?php unset($_SESSION['siparis_tel']); ?>
<?php unset($_SESSION['siparis_sehir']); ?>
<?php unset($_SESSION['siparis_ilce']); ?>
<?php unset($_SESSION['siparis_adres']); ?>
<?php unset($_SESSION['toplam_odenecek_tutar']); ?>
<?php unset($_SESSION['siparis_postakodu']); ?>
<?php unset($_SESSION['ara_tutar']); ?>
<?php unset($_SESSION['kdv_tutar']); ?>
<?php unset($_SESSION['kargo_tutar']); ?>
<?php unset($_SESSION['shopping_cart']); ?>
<?php unset($_SESSION['basket_items']); ?>
<?php unset($_SESSION['siparis_fatura_adres']); ?>
<?php unset($_SESSION['paywant_userid']); ?>
<?php unset($_SESSION['paywant-userid']); ?>
<?php
if (isset($_SESSION['siparis_not'])) {

    unset($_SESSION['siparis_not']);

}
?>