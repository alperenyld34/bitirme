<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$paytr_id = $odemeayar["paytr_id"];
$paytr_key = $odemeayar["paytr_key"];
$paytr_salt = $odemeayar["paytr_salt"];


$merchant_id 	= $paytr_id;
$merchant_key 	= $paytr_key;
$merchant_salt	= $paytr_salt;

$email = $_SESSION['siparis_eposta'];

$payment_amount	= $_SESSION['toplam_odenecek_tutar']*100; //9.99 için 9.99 * 100 = 999 gönderilmelidir.

$merchant_oid = "".$_SESSION['siparis_numarasi']."";

$user_name = "".$_SESSION['siparis_isim']." ".$_SESSION['siparis_soyisim']."";

$user_address = $_SESSION['siparis_adres'];

$user_phone = $_SESSION['siparis_tel'];

$merchant_ok_url = "".$siteurl."odeme-basarili?status=ordersuccess&orderID=".$_SESSION['siparis_numarasi']."";

$merchant_fail_url = "$siteurl/404";

$user_basket = base64_encode(json_encode(array(
    array("".$_SESSION['siparis_numarasi']." numaralı siparisteki ürünler", "".$_SESSION['toplam_odenecek_tutar']."", 1), // 1. ürün (Ürün Ad - Birim Fiyat - Adet )
)));

############################################################################################


if( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
    $ip = $_SERVER["HTTP_CLIENT_IP"];
} elseif( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
    $ip = $_SERVER["REMOTE_ADDR"];
}

## !!! Eğer bu örnek kodu sunucuda değil local makinanızda çalıştırıyorsanız
## buraya dış ip adresinizi (https://www.whatismyip.com/) yazmalısınız. Aksi halde geçersiz paytr_token hatası alırsınız.
$user_ip=$ip;

$timeout_limit = "30";

$debug_on = 1;


$test_mode = 0;

$no_installment	= 0;

$max_installment = 0;

$currency = "TL";


$hash_str = $merchant_id .$user_ip .$merchant_oid .$email .$payment_amount .$user_basket.$no_installment.$max_installment.$currency.$test_mode;
$paytr_token=base64_encode(hash_hmac('sha256',$hash_str.$merchant_salt,$merchant_key,true));
$post_vals=array(
    'merchant_id'=>$merchant_id,
    'user_ip'=>$user_ip,
    'merchant_oid'=>$merchant_oid,
    'email'=>$email,
    'payment_amount'=>$payment_amount,
    'paytr_token'=>$paytr_token,
    'user_basket'=>$user_basket,
    'debug_on'=>$debug_on,
    'no_installment'=>$no_installment,
    'max_installment'=>$max_installment,
    'user_name'=>$user_name,
    'user_address'=>$user_address,
    'user_phone'=>$user_phone,
    'merchant_ok_url'=>$merchant_ok_url,
    'merchant_fail_url'=>$merchant_fail_url,
    'timeout_limit'=>$timeout_limit,
    'currency'=>$currency,
    'test_mode'=>$test_mode
);

$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/get-token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1) ;
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);
$result = @curl_exec($ch);

if(curl_errno($ch))
    die("PAYTR IFRAME connection error. err:".curl_error($ch));

curl_close($ch);

$result=json_decode($result,1);

if($result['status']=='success')
    $token=$result['token'];
else
    die("PAYTR IFRAME failed. reason:".$result['reason']);
#########################################################################

?>

<script src="https://www.paytr.com/js/iframeResizer.min.js"></script>
<iframe src="https://www.paytr.com/odeme/guvenli/<?php echo $token;?>" id="paytriframe" frameborder="0" scrolling="no" style="width: 100%;"></iframe>
<script>iFrameResize({},'#paytriframe');</script>
