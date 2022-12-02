<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='cart' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php //** Cart Calc */
include "includes/func/calc.php";
?>
<?php
if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"])> 0) {
?>
<?php
$sozlesme_cek = $db->prepare("select * from sozlesme where dil=:dil order by id desc limit 1");
$sozlesme_cek->execute(array(
        'dil' => $_SESSION['dil']
));
$sozlesme = $sozlesme_cek->fetch(PDO::FETCH_ASSOC);
?>
<?php if($uyeayar['durum']=='1' ) {?>
<?php if($userSorgusu->rowCount() > 0 ) {?>
            <?php
                $userAddress = $db->prepare("select * from uyeler_adres where uye_id=:uye_id order by id asc");
                $userAddress->execute(array(
                       'uye_id' => $userCek['id'],
               ));
            $userAddress2 = $db->prepare("select * from uyeler_adres where uye_id=:uye_id order by id asc ");
            $userAddress2->execute(array(
                'uye_id' => $userCek['id'],
            ));
            $userAddress3 = $db->prepare("select * from uyeler_adres where uye_id=:uye_id order by id asc");
            $userAddress3->execute(array(
                'uye_id' => $userCek['id'],
            ));
            $adresCek = $userAddress3->fetch(PDO::FETCH_ASSOC);
            ?>
            <?php
            if (isset($_POST['addaddress'])) {

                $rand_id = rand(0,(int) 99999999);

                $baslik = trim(strip_tags($_POST['baslik']));
                $sehir = trim(strip_tags($_POST['sehir']));
                $ilce = trim(strip_tags($_POST['ilce']));
                $postakodu = trim(strip_tags($_POST['posta_kodu']));
                $adres = trim(strip_tags($_POST['adres']));
                $adres_fatura = trim(strip_tags($_POST['adres_fatura']));

                if ($baslik && $sehir && $ilce && $postakodu && $adres && $adres_fatura){

                    $adreskaydet = $db->prepare("insert into uyeler_adres set 
            baslik=:baslik,
            sehir=:sehir,
            ilce=:ilce,
            posta_kodu=:posta_kodu,
            adres=:adres,
            fatura_adres=:fatura_adres,
            uye_id=:uye_id,
            adres_id=:adres_id
            ");
                    $sonuc= $adreskaydet->execute(array(
                        'baslik' => $baslik,
                        'sehir' => $sehir,
                        'ilce' => $ilce,
                        'posta_kodu' => $postakodu,
                        'adres' => $adres,
                        'fatura_adres' => $adres_fatura,
                        'uye_id' => $userCek['id'],
                        'adres_id' => $rand_id
                    ));
                    if ($sonuc) {

                        header('Location:'.$siteurl.'teslimat');

                    }else{
                        echo 'Veritabanı hatası ';
                    }
                }else{
                    header('Location:'.$siteurl.'teslimat');
                }
            }
            ?>
<title><?php echo ucwords_tr($diller['teslimat-ve-odeme']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$ayar[site_desc]" ?>">
<meta name="keywords" content="<?php echo"$ayar[site_tags]" ?>">
<meta name="news_keywords" content="<?php echo"$ayar[site_tags]" ?>">
<meta name="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta itemprop="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta name="robots" content="index follow">
<meta name="googlebot" content="index follow">
<meta property="og:type" content="website" />

<?php include "includes/config/header_libs.php";?>

</head>
<body>
<?php include 'includes/template/header.php'?>




<!-- CONTENT AREA ============== !-->

<div class="cart-page-main">



        <?php if ($odemeayar['sepet_step'] == 1 ){ ?>
            <!-- STEP-STEP ============================== !-->
            <div class="step-div-main">


                <div class="step-box">
                    <span style="font-weight: 400"><?=$diller['sepetiniz']?></span><br><br>
                    <div style="clear: both"></div>
                    <div class="step-line step-line-none"></div><div class="step-num step-num-active"> 1 </div><div class="step-line step-line-active"></div>
                </div><div class="step-box">
                    <span ><?=$diller['teslimat-ve-odeme']?></span><br><br>
                    <div style="clear: both"></div>
                    <div class="step-line step-line-active"></div><div class="step-num step-num-active">2</div><div class="step-line step-line-active"></div>
                </div><div class="step-box">
                    <span style="font-weight: 400"><?=$diller['odeme-bilgileri']?></span><br><br>
                    <div style="clear: both"></div>
                    <div class="step-line"></div><div class="step-num">3</div><div class="step-line step-line-none"></div>
                </div>


            </div>
            <!-- STEP-STEP ============================== !-->
        <?php }?>


<div class="delivery-main">
    <?php if($userAddress->rowCount() > 0  ) {?>
    <form action="purchasepost" method="post"  >
    <?php }?>
    <div class="delivery-left-div">

        <?php if($userAddress->rowCount() > 0  ) {?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="adres">Kayıtlı Adresinizi Seçin</label>
                    <select name="adres" class="form-control" id="size_select" required>
                        <?php foreach ($userAddress as $adres ) {?>
                            <option value="<?=$adres['adres_id']?>"><?=$adres['baslik']?></option>
                        <?php }?>
                    </select>
                </div>
                <?php foreach ($userAddress2 as $adres2 ) {?>
                    <div  id="<?=$adres2['adres_id']?>" class="size_chart" style="width: 100%; padding: 25px; font-family: 'Open Sans', Arial; font-size: 13px; border: 1px solid #ebebeb;  box-sizing: border-box; margin: 0 5px 20px 5px;">
                        <div class="userdelivery-address-show">
                            <span style="font-weight: 700; text-transform: uppercase;"><?=$diller['uyelik-siparis-adres']?></span>
                            <br>
                            <?=$adres2['adres']?>
                            <br>
                            <?=$adres2['posta_kodu']?> / <?=$adres2['ilce']?> / <?=$adres2['sehir']?>
                        </div>
                        <div class="userdelivery-address-show" style="margin-top: 15px; border-bottom: 0; padding-bottom: 0;">
                            <span style="font-weight: 700; text-transform: uppercase;"><?=$diller['uyelik-siparis-fatura-adres']?></span>
                            <br>
                            <?=$adres2['fatura_adres']?>
                        </div>
                    </div>
                <?php }?>
                <div class="form-group col-md-12">
                    <label for="textareaSiparisNot"><?=$diller['odeme-not']?> <span style="color:#666">(OPSIYONEL)</span></label>
                    <textarea class="form-control" id="textareaSiparisNot" rows="3"  name="notlar" ></textarea>
                </div>
            </div>
            <script id="rendered-js">
                $(document).ready(function () {
                    $(".size_chart").hide();
                    $("#<?=$adresCek['adres_id']?>").show();
                    $("#size_select").change(function () {
                        $('.size_chart').hide();
                        $('#' + $(this).val()).show();
                    });
                });
            </script>
        <?php } else { ?>
        <div class="userdelivery-not-address">
            <div class="userdelivery-not-address-icon">
                <i class="fa fa-exclamation-circle"></i>
            </div>
            <div class="userdelivery-not-address-text">
                <span style="font-size: 22px; font-weight: 700;"><?=$diller['uyelik-siparis-uyari-yazisi']?></span>
                <br><br>
                <span>
                    <?=$diller['uyelik-adres-yok']?>
                </span>
                <br><br>
                <a  data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-map-marker"></i> <?=$diller['uyelik-adres-ekle']?>
                </a>
            </div>

        </div>
            <!-- Modal Address Adding !-->
            <style>
                .modal-content{border-radius: 0 !important;
                    border:0 !important;
                    overflow: hidden !important;
                }
                .modal-backdrop {background-color:#000; opacity: 0.7!important;}
            </style>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="userlogin-modal-head" style="border-bottom: 1px solid #ebebeb;">
                            <a style="cursor: pointer" class="close" data-dismiss="modal" aria-label="Close"><div class="userlogin-modal-closepanel">
                                    <i class="fa fa-times"></i>
                                </div>
                            </a>
                            <div class="userlogin-modal-head-text1" >
                                <?=$diller['uyelik-adres-ekle']?>
                            </div>
                        </div>
                        <div class="userlogin-modal-content-area">
                            <div class="user-right-form-area" style="width: 100%">
                                <form method="post" action="">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="baslik"><?=$diller['uyelik-adres-basligi']?></label>
                                            <input type="text" name="baslik" class="form-control" id="baslik"  required>
                                        </div>
                                    </div>
                                    <div class="form-row">

                                        <div class="form-group col-md-4">
                                            <label for="sehir"><?=$diller['uyelik-adres-sehir']?></label>
                                            <select name="sehir"  class="form-control" id="sehir" required>
                                                <option value="Adana">Adana</option>
                                                <option value="Adıyaman">Adıyaman</option>
                                                <option value="Afyonkarahisar">Afyonkarahisar</option>
                                                <option value="Ağrı">Ağrı</option>
                                                <option value="Amasya">Amasya</option>
                                                <option value="Ankara">Ankara</option>
                                                <option value="Antalya">Antalya</option>
                                                <option value="Artvin">Artvin</option>
                                                <option value="Aydın">Aydın</option>
                                                <option value="Balıkesir">Balıkesir</option>
                                                <option value="Bilecik">Bilecik</option>
                                                <option value="Bingöl">Bingöl</option>
                                                <option value="Bitlis">Bitlis</option>
                                                <option value="Bolu">Bolu</option>
                                                <option value="Burdur">Burdur</option>
                                                <option value="Bursa">Bursa</option>
                                                <option value="Çanakkale">Çanakkale</option>
                                                <option value="Çankırı">Çankırı</option>
                                                <option value="Çorum">Çorum</option>
                                                <option value="Denizli">Denizli</option>
                                                <option value="Diyarbakır">Diyarbakır</option>
                                                <option value="Edirne">Edirne</option>
                                                <option value="Elazığ">Elazığ</option>
                                                <option value="Erzincan">Erzincan</option>
                                                <option value="Erzurum">Erzurum</option>
                                                <option value="Eskişehir">Eskişehir</option>
                                                <option value="Gaziantep">Gaziantep</option>
                                                <option value="Giresun">Giresun</option>
                                                <option value="Gümüşhane">Gümüşhane</option>
                                                <option value="Hakkâri">Hakkâri</option>
                                                <option value="Hatay">Hatay</option>
                                                <option value="Isparta">Isparta</option>
                                                <option value="Mersin">Mersin</option>
                                                <option value="İstanbul">İstanbul</option>
                                                <option value="İzmir">İzmir</option>
                                                <option value="Kars">Kars</option>
                                                <option value="Kastamonu">Kastamonu</option>
                                                <option value="Kayseri">Kayseri</option>
                                                <option value="Kırklareli">Kırklareli</option>
                                                <option value="Kırşehir">Kırşehir</option>
                                                <option value="Kocaeli">Kocaeli</option>
                                                <option value="Konya">Konya</option>
                                                <option value="Kütahya">Kütahya</option>
                                                <option value="Malatya">Malatya</option>
                                                <option value="Manisa">Manisa</option>
                                                <option value="Kahramanmaraş">Kahramanmaraş</option>
                                                <option value="Mardin">Mardin</option>
                                                <option value="Muğla">Muğla</option>
                                                <option value="Muş">Muş</option>
                                                <option value="Nevşehir">Nevşehir</option>
                                                <option value="Niğde">Niğde</option>
                                                <option value="Ordu">Ordu</option>
                                                <option value="Rize">Rize</option>
                                                <option value="Sakarya">Sakarya</option>
                                                <option value="Samsun">Samsun</option>
                                                <option value="Siirt">Siirt</option>
                                                <option value="Sinop">Sinop</option>
                                                <option value="Sivas">Sivas</option>
                                                <option value="Tekirdağ">Tekirdağ</option>
                                                <option value="Tokat">Tokat</option>
                                                <option value="Trabzon">Trabzon</option>
                                                <option value="Tunceli">Tunceli</option>
                                                <option value="Şanlıurfa">Şanlıurfa</option>
                                                <option value="Uşak">Uşak</option>
                                                <option value="Van">Van</option>
                                                <option value="Yozgat">Yozgat</option>
                                                <option value="Zonguldak">Zonguldak</option>
                                                <option value="Aksaray">Aksaray</option>
                                                <option value="Bayburt">Bayburt</option>
                                                <option value="Karaman">Karaman</option>
                                                <option value="Kırıkkale">Kırıkkale</option>
                                                <option value="Batman">Batman</option>
                                                <option value="Şırnak">Şırnak</option>
                                                <option value="Bartın">Bartın</option>
                                                <option value="Ardahan">Ardahan</option>
                                                <option value="Iğdır">Iğdır</option>
                                                <option value="Yalova">Yalova</option>
                                                <option value="Karabük">Karabük</option>
                                                <option value="Kilis">Kilis</option>
                                                <option value="Osmaniye">Osmaniye</option>
                                                <option value="Düzce">Düzce</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="ilce"><?=$diller['uyelik-adres-ilce']?></label>
                                            <input type="text" name="ilce" class="form-control" id="ilce"  required>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="posta_kodu"><?=$diller['uyelik-adres-postakodu']?></label>
                                            <input type="text" name="posta_kodu" class="form-control" id="posta_kodu"  required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="adres"><?=$diller['uyelik-adres-adres']?></label>
                                            <textarea name="adres" id="adres" class="form-control" required rows="3"></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="adres_fatura"><?=$diller['uyelik-adres-adres-fatura']?></label>
                                            <textarea name="adres_fatura" id="adres_fatura"  class="form-control" required rows="3"></textarea>
                                        </div>
                                    </div>

                                    <button  name="addaddress" class="btn btn-primary"><i class="fa fa-send"></i> <?=$diller['uyelik-adres-ekle-button']?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Address Adding SON !-->
        <?php }?>



    </div><div class="delivery-right-div">

        <div class="delivery-right-inside">

            <div class="delivery-right-st-head">

                <?=$diller['odeme-yontemi-secin']?>

            </div>


            <?php if($odemeayar['eft'] == 1 || $odemeayar['kredi_kart'] == 1) { ?>
            <div class="delivery-right-purchase-div">

                <?php if ($odemeayar['kredi_kart'] == 1) {?>
                <div class="custom-control custom-radio">
                    <input type="radio" id="radioCreditCard" name="purchase_type" value="1" class="custom-control-input" <?php if ($odemeayar['kredi_kart'] == 1) {?> checked <?php }?> >
                    <label class="custom-control-label font-18" for="radioCreditCard"  style="text-transform: none; padding-left: 10px; padding-top: 5px;  line-height: 12px ">

                        <i class="fa fa-credit-card"></i>

                        <?=$diller['odeme-tur-kredi-karti']?>

                        <br><br>

                        <span style="font-size:13px; font-weight: normal">

                            <?=$diller['odeme-tur-kredi-karti-aciklamasi']?>

                        </span>

                    </label>
                </div>
                <?php }?>

                <?php if($odemeayar['eft'] == 1 & $odemeayar['kredi_kart'] == 1) { ?>
                <br><br>
                <?php }?>

                <?php if ($odemeayar['eft'] == 1) {?>
                <div class="custom-control custom-radio">
                    <input type="radio" id="radioEFTHAVALE"  name="purchase_type" value="2" class="custom-control-input" <?php if ($odemeayar['kredi_kart'] == 1) {?><?php } else {?> checked <?php } ?>>
                    <label class="custom-control-label font-18" for="radioEFTHAVALE" style="text-transform: none; padding-left: 10px; padding-top: 5px;  line-height: 15px ">

                        <i class="fa fa-exchange"></i>

                        <?=$diller['odeme-tur-havale']?>

                        <br><br>

                        <span style="font-size:13px; font-weight: normal; ">

                           <?=$diller['odeme-tur-havale-aciklamasi']?>

                        </span>

                    </label>
                </div>
                <?php }?>

            </div>
        <?php } else { ?>

                <div class="alert alert-warning">
                    <strong>UYARI! Ödeme Yöntemleri Pasif Durumda</strong>
                    <br>
                    Sayın site yetkilileri; Lüten sisteminizdeki ödeme yöntemlerinden en az birini aktif duruma getirin.
                </div>

            <?php } ?>

            <div class="delivery-right-st-head">

                <?=$diller['siparis-detaylari']?>

            </div>

            <div class="delivery-right-order-detail-div">





                <div class="cart-right-div-price-box">

                    <div class="cart-right-div-price-box-left font-medium">

                        <?=$diller['ara-toplam']?>

                    </div><div class="cart-right-div-price-box-right">

                        <?php echo number_format($aratoplam, 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span>

                    </div>

                </div><textarea name="pd_items" style="display: none" >
                    <?php if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"])> 0) { foreach($_SESSION["shopping_cart"] as $product) { $uruncek = $db ->prepare("select * from urun where id='$product[item_id]' order by id desc limit 1");  $uruncek->execute();  $urun = $uruncek->fetch(PDO::FETCH_ASSOC); ?>(ÜRÜN : <?=$urun[baslik]?>, BİRİM FİYAT : <?php echo number_format($urun[fiyat], 2); ?> TL , ADET : <?=$product[item_quantity]?>) <br><?php }} ?>
                </textarea>



                <?php if($kdvtoplam >0) {?>

                    <div class="cart-right-div-price-box">

                        <div class="cart-right-div-price-box-left font-medium">

                            <?=$diller['kdv']?>

                        </div><div class="cart-right-div-price-box-right">

                            <?php echo number_format($kdvtoplam, 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span>

                        </div>

                    </div>
                <?php }?>


                <?php if($kargotoplam >0 && $odemeayar['kargo_sistemi'] == 1 ) {?>
                    <div class="cart-right-div-price-box">

                        <div class="cart-right-div-price-box-left font-medium">

                            <?=$diller['kargo-bedeli']?>

                        </div><div class="cart-right-div-price-box-right">

                            <?php echo number_format($kargotoplam, 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span>

                        </div>

                    </div>
                <?php }?>


                <div class="cart-right-div-price-box" style="border-bottom:1px solid #EBEBEB;">

                    <div class="cart-right-div-price-box-left font-medium">

                        <?=$diller['sepet-toplam-1']?>

                    </div><div class="cart-right-div-price-box-right font-18">

                        <?php echo number_format($odenecektoplam, 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span>

                    </div>

                </div>



            </div>


            <div class="delivery-right-satis-sozlesmesi-div">

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" checked required>
                    <label class="custom-control-label" for="customCheck1" style="text-transform: none; padding-left: 10px; padding-top: 5px;  line-height: 15px; cursor: pointer; ">

                        <a data-toggle="modal" data-target="#modalSatisSozlesmesi" role="button" style="color:#000; text-decoration: underline">
                        <?=$diller['mesafeli-satis-sozlesmesi-onay']?>
                        </a>

                    </label>
                </div>

            </div>



            <div class="delivery-right-button-div">

                <button type="submit" name="purchase"  >
                    <?=$diller['odemeye-gec']?>
                </button>

            </div>





        </div>

    </div>

</div>
            <?php if($userAddress->rowCount() > 0  ) {?>
            </form>
            <?php }?>



    <!-- TİCARET BİLGİLENDİRME ALANI ========================== !-->
    <?php
    $commerceinfo = $db->prepare("select * from ticaret_bilgi where dil=:dil order by sira asc limit 4");
    $commerceinfo->execute(array(
            'dil' => $_SESSION['dil']
    ));
    ?>
    <?php
    if($ayar['ticaret_text_sepet'] == 1)
    {
        ?>
        <style>
            .ticaret-bilgilendirme-box{border-color:#<?php echo $ayar['ticaret_text_border'] ?>}
        </style>
        <?php if($commerceinfo->rowCount() > 0) { ?>
        <div class="ticaret-bilgilendirme-main-div" style="border:1px solid #<?php echo $ayar['ticaret_text_border'] ?>; background-color: #<?php echo $ayar['ticaret_text_back'] ?>">

            <?php foreach ($commerceinfo as $tic){ ?>
                <div class="ticaret-bilgilendirme-box"style="border-right: 1px solid #<?php echo $ayar['ticaret_text_border'] ?>">
                    <div class="ticaret-bilgilendirme-box-i" style="color:#<?php echo $ayar['ticaret_text_icon']?>">
                        <i class="fa <?php echo $tic['icon']?>"></i>
                    </div>
                    <div class="ticaret-bilgilendirme-box-text font-open-sans font-14 font-light" style="color:#<?php echo $ayar['ticaret_text_color']?>" >
                        <?php echo $tic['baslik']?>
                    </div>
                </div>
            <?php }?>

        </div>
    <?php } else {?>

        <div class="ticaret-bilgilendirme-main-div" style="border:1px solid #000; background-color: #333">
            <div class="ticaret-bilgilendirme-box" style="color:#FFF;">

                <span class="font-16 font-bold font-open-sans">HENÜZ TİCARET BİLGİ KUTULARI EKLENMEMİŞ</span>
                <br>
                <span class="font-14 font-small font-open-sans">Lütfen yeni ticaret bilgi kutuları ekleyerek ziyaretçilerinizi bilgilendirme şansını yakalayın</span>
            </div>
        </div>

    <?php }?>
    <?php }?>

    <!-- TİCARET BİLGİLENDİRME ALANI ========================== !-->




</div>

<!-- CONTENT AREA ============== !-->


<!-- Modal -->
<div class="modal fade" id="modalSatisSozlesmesi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><?=$diller['mesafeli-satis-sozlesmesi']?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-family: 'Open Sans', Arial; font-size:14px;">
                <?=$sozlesme['icerik']?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=$diller['modal-kapat']?></button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<?php if(isset($_SESSION['teslimatArea']) && $_SESSION['teslimatArea']['status'] == 'error'){ ?>
    <body onload="sweetAlert('<?= $diller['post-hata']?>', '<?= $diller['form-eksik-alan']?>', 'warning');"></body>
    <meta http-equiv="refresh" content="3; URL=teslimat">
    <?php unset($_SESSION['teslimatArea']); ?>
<?php }?>

<?php include 'includes/template/footer.php'?>
</body>
</html>
<?php include "includes/config/footer_libs.php";?>
<?php } else {
            header('Location:'.$siteurl.'404');
}?>
<?php }?>
<?php
/* Üyeliksiz Site İçin Teslimat Sayfası */
if($uyeayar['durum'] == '0') {
?>
    <title><?php echo ucwords_tr($diller['teslimat-ve-odeme']) ?> | <?php echo $ayar['site_baslik']?></title>
    <meta name="description" content="<?php echo"$ayar[site_desc]" ?>">
    <meta name="keywords" content="<?php echo"$ayar[site_tags]" ?>">
    <meta name="news_keywords" content="<?php echo"$ayar[site_tags]" ?>">
    <meta name="author" content="<?php echo"$ayar[site_baslik]" ?>" />
    <meta itemprop="author" content="<?php echo"$ayar[site_baslik]" ?>" />
    <meta name="robots" content="index follow">
    <meta name="googlebot" content="index follow">
    <meta property="og:type" content="website" />

    <?php include "includes/config/header_libs.php";?>

    </head>
    <body>
    <?php include 'includes/template/header.php'?>


    <!-- Page Header ====================== !-->
    <style>
        .page-headers-main{width:<?php if($pagehead['width']==1){?> 90%; <?php }else {?> 100% <?php }?> ;  padding:<?php echo $pagehead['padding'] ?>px 0 <?php echo $pagehead['padding'] ?>px 0 ; border:1px solid #<?php echo $pagehead['border_color'] ?>;

        <?php if($pagehead['shadow'] == 1 ) {?>

            -webkit-box-shadow: inset 0px 5px 10px -7px rgba(0,0,0,0.1);
            -moz-box-shadow: inset 0px 5px 10px -7px rgba(0,0,0,0.1);
            box-shadow: inset 0px 5px 10px -7px rgba(0,0,0,0.1);

        <?php } ?>

        <?php if($pagehead['tip'] == 0 ) {?>

            background:#<?php echo $pagehead['bg_color'] ?> ;

        <?php } ?>

        <?php if($pagehead['tip'] == 1 ) {?>

            background:url(images/uploads/<?php echo $pagehead['bg_image'] ?>) ;

            box-shadow: inset 5000px 0 0 0 rgba(0, 0, 0, 0.7); border-color: rgba(0, 0, 0, 1);

        <?php } ?>

        }
    </style>
    <style>
        input[type="text"]:disabled {
            background: #FFF;
        }
        .form-control {
            border-radius: 0;
            background-color: #fcfcfc;
        }
        label{

            font-family: 'Open Sans', Arial; font-size:13px; font-weight: 600;
            text-transform: uppercase;
        }
    </style>
    <div class="page-headers-main">
        <div class="page-headers-main-in">
            <div class="page-headers-main-left font-raleway font-18 font-small font-spacing" style="color:#<?php echo $pagehead['text_color'] ?>;">

                <i class="fa fa-truck"></i>
                <?php echo ucwords_tr($diller['teslimat-ve-odeme']) ?>

            </div><div class="page-headers-main-right font-raleway font-12 font-spacing">

                <span style="color:#<?php echo $pagehead['pasif_text_color'] ?>; padding-right: 15px;"><?php echo $diller['buradasiniz'] ?>:</span>
                <a href="index.html" style="color:#<?php echo $pagehead['text_color'] ?>;"><span style="padding-right: 15px; font-weight: 600"><?php echo $diller['anasayfa'] ?></span></a>
                <span style="color:#<?php echo $pagehead['pasif_text_color'] ?>; padding-right: 15px;">/</span>
                <span style="padding-right: 15px; color:#<?php echo $pagehead['text_color'] ?>;"><?php echo ucwords_tr($diller['teslimat-ve-odeme']) ?></span>
            </div>
        </div>
    </div>
    <!-- Page Header ====================== !-->



    <!-- CONTENT AREA ============== !-->

    <div class="cart-page-main">



        <?php if ($odemeayar['sepet_step'] == 1 ){ ?>
            <!-- STEP-STEP ============================== !-->
            <div class="step-div-main">


                <div class="step-box">
                    <span style="font-weight: 400"><?=$diller['sepetiniz']?></span><br><br>
                    <div style="clear: both"></div>
                    <div class="step-line step-line-none"></div><div class="step-num step-num-active"> 1 </div><div class="step-line step-line-active"></div>
                </div><div class="step-box">
                    <span ><?=$diller['teslimat-ve-odeme']?></span><br><br>
                    <div style="clear: both"></div>
                    <div class="step-line step-line-active"></div><div class="step-num step-num-active">2</div><div class="step-line step-line-active"></div>
                </div><div class="step-box">
                    <span style="font-weight: 400"><?=$diller['odeme-bilgileri']?></span><br><br>
                    <div style="clear: both"></div>
                    <div class="step-line"></div><div class="step-num">3</div><div class="step-line step-line-none"></div>
                </div>


            </div>
            <!-- STEP-STEP ============================== !-->
        <?php }?>


        <div class="delivery-main">

            <form action="purchasepost" method="post"  >


                <div class="delivery-left-div">


                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="inputnName"><?=$diller['odeme-isim']?> <span style="color:#666">*</span></label>
                            <input type="text" name="isim" class="form-control" id="inputnName" required  >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputDate"><?=$diller['odeme-soyisim']?> <span style="color:#666">*</span></label>
                            <input type="text" name="soyisim" class="form-control"  id="inputDate"  required >
                        </div>


                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-12 ">
                            <label for="inputPhone"><?=$diller['odeme-tel']?> <span style="color:#666">*</span></label>
                            <div class="input-group mb-2 mr-sm-2">

                                <input type="number" name="tel" class="form-control" id="inputPhone" required  >
                            </div>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-12 ">
                            <label for="inputPosta"><?=$diller['odeme-eposta']?> <span style="color:#666">*</span></label>
                            <div class="input-group mb-2 mr-sm-2">

                                <input type="email" name="eposta" class="form-control" id="inputPosta" required  >
                            </div>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="selectSehirSec"><?=$diller['odeme-sehir']?> <span style="color:#666">*</span></label>
                            <select name="sehir"  class="form-control" id="selectSehirSec" required>
                                <option value="">Seçin...</option>

                                <option value="Adana">Adana</option>
                                <option value="Adıyaman">Adıyaman</option>
                                <option value="Afyonkarahisar">Afyonkarahisar</option>
                                <option value="Ağrı">Ağrı</option>
                                <option value="Amasya">Amasya</option>
                                <option value="Ankara">Ankara</option>
                                <option value="Antalya">Antalya</option>
                                <option value="Artvin">Artvin</option>
                                <option value="Aydın">Aydın</option>
                                <option value="Balıkesir">Balıkesir</option>
                                <option value="Bilecik">Bilecik</option>
                                <option value="Bingöl">Bingöl</option>
                                <option value="Bitlis">Bitlis</option>
                                <option value="Bolu">Bolu</option>
                                <option value="Burdur">Burdur</option>
                                <option value="Bursa">Bursa</option>
                                <option value="Çanakkale">Çanakkale</option>
                                <option value="Çankırı">Çankırı</option>
                                <option value="Çorum">Çorum</option>
                                <option value="Denizli">Denizli</option>
                                <option value="Diyarbakır">Diyarbakır</option>
                                <option value="Edirne">Edirne</option>
                                <option value="Elazığ">Elazığ</option>
                                <option value="Erzincan">Erzincan</option>
                                <option value="Erzurum">Erzurum</option>
                                <option value="Eskişehir">Eskişehir</option>
                                <option value="Gaziantep">Gaziantep</option>
                                <option value="Giresun">Giresun</option>
                                <option value="Gümüşhane">Gümüşhane</option>
                                <option value="Hakkâri">Hakkâri</option>
                                <option value="Hatay">Hatay</option>
                                <option value="Isparta">Isparta</option>
                                <option value="Mersin">Mersin</option>
                                <option value="İstanbul">İstanbul</option>
                                <option value="İzmir">İzmir</option>
                                <option value="Kars">Kars</option>
                                <option value="Kastamonu">Kastamonu</option>
                                <option value="Kayseri">Kayseri</option>
                                <option value="Kırklareli">Kırklareli</option>
                                <option value="Kırşehir">Kırşehir</option>
                                <option value="Kocaeli">Kocaeli</option>
                                <option value="Konya">Konya</option>
                                <option value="Kütahya">Kütahya</option>
                                <option value="Malatya">Malatya</option>
                                <option value="Manisa">Manisa</option>
                                <option value="Kahramanmaraş">Kahramanmaraş</option>
                                <option value="Mardin">Mardin</option>
                                <option value="Muğla">Muğla</option>
                                <option value="Muş">Muş</option>
                                <option value="Nevşehir">Nevşehir</option>
                                <option value="Niğde">Niğde</option>
                                <option value="Ordu">Ordu</option>
                                <option value="Rize">Rize</option>
                                <option value="Sakarya">Sakarya</option>
                                <option value="Samsun">Samsun</option>
                                <option value="Siirt">Siirt</option>
                                <option value="Sinop">Sinop</option>
                                <option value="Sivas">Sivas</option>
                                <option value="Tekirdağ">Tekirdağ</option>
                                <option value="Tokat">Tokat</option>
                                <option value="Trabzon">Trabzon</option>
                                <option value="Tunceli">Tunceli</option>
                                <option value="Şanlıurfa">Şanlıurfa</option>
                                <option value="Uşak">Uşak</option>
                                <option value="Van">Van</option>
                                <option value="Yozgat">Yozgat</option>
                                <option value="Zonguldak">Zonguldak</option>
                                <option value="Aksaray">Aksaray</option>
                                <option value="Bayburt">Bayburt</option>
                                <option value="Karaman">Karaman</option>
                                <option value="Kırıkkale">Kırıkkale</option>
                                <option value="Batman">Batman</option>
                                <option value="Şırnak">Şırnak</option>
                                <option value="Bartın">Bartın</option>
                                <option value="Ardahan">Ardahan</option>
                                <option value="Iğdır">Iğdır</option>
                                <option value="Yalova">Yalova</option>
                                <option value="Karabük">Karabük</option>
                                <option value="Kilis">Kilis</option>
                                <option value="Osmaniye">Osmaniye</option>
                                <option value="Düzce">Düzce</option>
                            </select>
                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="inputIlce"><?=$diller['odeme-ilce']?> <span style="color:#666">*</span></label>
                            <input type="text" name="ilce" class="form-control" id="inputIlce" required  >
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="inputPoscaCode"><?=$diller['odeme-postakodu']?> <span style="color:#666">*</span></label>
                            <input type="text" name="postakodu" class="form-control" id="inputPoscaCode" required  >
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="textareaSiparisadres"><?=$diller['odeme-adres']?> <span style="color:#666">*</span></label>
                            <textarea class="form-control" id="textareaSiparisadres" rows="3"  name="adres" required></textarea>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="adres_fatura"><?=$diller['uyelik-siparis-fatura-adres']?> <span style="color:#666">*</span></label>
                            <textarea class="form-control" id="adres_fatura" rows="3"  name="adres_fatura" required></textarea>
                        </div>

                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="textareaSiparisNot"><?=$diller['odeme-not']?> <span style="color:#666">(OPSIYONEL)</span></label>
                            <textarea class="form-control" id="textareaSiparisNot" rows="3"  name="notlar" ></textarea>
                        </div>

                    </div>



                </div><div class="delivery-right-div">

                    <div class="delivery-right-inside">

                        <div class="delivery-right-st-head">

                            <?=$diller['odeme-yontemi-secin']?>

                        </div>


                        <?php if($odemeayar['eft'] == 1 || $odemeayar['kredi_kart'] == 1) { ?>
                            <div class="delivery-right-purchase-div">

                                <?php if ($odemeayar['kredi_kart'] == 1) {?>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="radioCreditCard" name="purchase_type" value="1" class="custom-control-input" <?php if ($odemeayar['kredi_kart'] == 1) {?> checked <?php }?> >
                                        <label class="custom-control-label font-18" for="radioCreditCard"  style="text-transform: none; padding-left: 10px; padding-top: 5px;  line-height: 12px ">

                                            <i class="fa fa-credit-card"></i>

                                            <?=$diller['odeme-tur-kredi-karti']?>

                                            <br><br>

                                            <span style="font-size:13px; font-weight: normal">

                            <?=$diller['odeme-tur-kredi-karti-aciklamasi']?>

                        </span>

                                        </label>
                                    </div>
                                <?php }?>

                                <?php if($odemeayar['eft'] == 1 & $odemeayar['kredi_kart'] == 1) { ?>
                                    <br><br>
                                <?php }?>

                                <?php if ($odemeayar['eft'] == 1) {?>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="radioEFTHAVALE"  name="purchase_type" value="2" class="custom-control-input" <?php if ($odemeayar['kredi_kart'] == 1) {?><?php } else {?> checked <?php } ?>>
                                        <label class="custom-control-label font-18" for="radioEFTHAVALE" style="text-transform: none; padding-left: 10px; padding-top: 5px;  line-height: 15px ">

                                            <i class="fa fa-exchange"></i>

                                            <?=$diller['odeme-tur-havale']?>

                                            <br><br>

                                            <span style="font-size:13px; font-weight: normal; ">

                           <?=$diller['odeme-tur-havale-aciklamasi']?>

                        </span>

                                        </label>
                                    </div>
                                <?php }?>

                            </div>
                        <?php } else { ?>

                            <div class="alert alert-warning">
                                <strong>UYARI! Ödeme Yöntemleri Pasif Durumda</strong>
                                <br>
                                Sayın site yetkilileri; Lüten sisteminizdeki ödeme yöntemlerinden en az birini aktif duruma getirin.
                            </div>

                        <?php } ?>

                        <div class="delivery-right-st-head">

                            <?=$diller['siparis-detaylari']?>

                        </div>

                        <div class="delivery-right-order-detail-div">





                            <div class="cart-right-div-price-box">

                                <div class="cart-right-div-price-box-left font-medium">

                                    <?=$diller['ara-toplam']?>

                                </div><div class="cart-right-div-price-box-right">

                                    <?php echo number_format($aratoplam, 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span>

                                </div>

                            </div><textarea name="pd_items" style="display: none" >
                    <?php if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"])> 0) { foreach($_SESSION["shopping_cart"] as $product) { $uruncek = $db ->prepare("select * from urun where id='$product[item_id]' order by id desc limit 1");  $uruncek->execute();  $urun = $uruncek->fetch(PDO::FETCH_ASSOC); ?>(ÜRÜN : <?=$urun[baslik]?>, BİRİM FİYAT : <?php echo number_format($urun[fiyat], 2); ?> TL , ADET : <?=$product[item_quantity]?>) <br><?php }} ?>
                </textarea>



                            <?php if($kdvtoplam >0) {?>

                                <div class="cart-right-div-price-box">

                                    <div class="cart-right-div-price-box-left font-medium">

                                        <?=$diller['kdv']?>

                                    </div><div class="cart-right-div-price-box-right">

                                        <?php echo number_format($kdvtoplam, 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span>

                                    </div>

                                </div>
                            <?php }?>


                            <?php if($kargotoplam >0 && $odemeayar['kargo_sistemi'] == 1 ) {?>
                                <div class="cart-right-div-price-box">

                                    <div class="cart-right-div-price-box-left font-medium">

                                        <?=$diller['kargo-bedeli']?>

                                    </div><div class="cart-right-div-price-box-right">

                                        <?php echo number_format($kargotoplam, 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span>

                                    </div>

                                </div>
                            <?php }?>


                            <div class="cart-right-div-price-box" style="border-bottom:1px solid #EBEBEB;">

                                <div class="cart-right-div-price-box-left font-medium">

                                    <?=$diller['sepet-toplam-1']?>

                                </div><div class="cart-right-div-price-box-right font-18">

                                    <?php echo number_format($odenecektoplam, 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span>

                                </div>

                            </div>



                        </div>


                        <div class="delivery-right-satis-sozlesmesi-div">

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" checked required>
                                <label class="custom-control-label" for="customCheck1" style="text-transform: none; padding-left: 10px; padding-top: 5px;  line-height: 15px; cursor: pointer; ">

                                    <a data-toggle="modal" data-target="#modalSatisSozlesmesi" role="button" style="color:#000; text-decoration: underline">
                                        <?=$diller['mesafeli-satis-sozlesmesi-onay']?>
                                    </a>

                                </label>
                            </div>

                        </div>



                        <div class="delivery-right-button-div">

                            <button type="submit" name="purchase"  >
                                <?=$diller['odemeye-gec']?>
                            </button>

                        </div>





                    </div>

                </div>

        </div>

        </form>




        <!-- TİCARET BİLGİLENDİRME ALANI ========================== !-->
        <?php
        $commerceinfo = $db->prepare("select * from ticaret_bilgi where dil=:dil order by sira asc limit 4");
        $commerceinfo->execute(array(
            'dil' => $_SESSION['dil']
        ));
        ?>
        <?php
        if($ayar['ticaret_text_sepet'] == 1)
        {
            ?>
            <style>
                .ticaret-bilgilendirme-box{border-color:#<?php echo $ayar['ticaret_text_border'] ?>}
            </style>
            <?php if($commerceinfo->rowCount() > 0) { ?>
            <div class="ticaret-bilgilendirme-main-div" style="border:1px solid #<?php echo $ayar['ticaret_text_border'] ?>; background-color: #<?php echo $ayar['ticaret_text_back'] ?>">

                <?php foreach ($commerceinfo as $tic){ ?>
                    <div class="ticaret-bilgilendirme-box"style="border-right: 1px solid #<?php echo $ayar['ticaret_text_border'] ?>">
                        <div class="ticaret-bilgilendirme-box-i" style="color:#<?php echo $ayar['ticaret_text_icon']?>">
                            <i class="fa <?php echo $tic['icon']?>"></i>
                        </div>
                        <div class="ticaret-bilgilendirme-box-text font-open-sans font-14 font-light" style="color:#<?php echo $ayar['ticaret_text_color']?>" >
                            <?php echo $tic['baslik']?>
                        </div>
                    </div>
                <?php }?>

            </div>
        <?php } else {?>

            <div class="ticaret-bilgilendirme-main-div" style="border:1px solid #000; background-color: #333">
                <div class="ticaret-bilgilendirme-box" style="color:#FFF;">

                    <span class="font-16 font-bold font-open-sans">HENÜZ TİCARET BİLGİ KUTULARI EKLENMEMİŞ</span>
                    <br>
                    <span class="font-14 font-small font-open-sans">Lütfen yeni ticaret bilgi kutuları ekleyerek ziyaretçilerinizi bilgilendirme şansını yakalayın</span>
                </div>
            </div>

        <?php }?>
        <?php }?>

        <!-- TİCARET BİLGİLENDİRME ALANI ========================== !-->




    </div>

    <!-- CONTENT AREA ============== !-->


    <!-- Modal -->
    <div class="modal fade" id="modalSatisSozlesmesi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><?=$diller['mesafeli-satis-sozlesmesi']?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Open Sans', Arial; font-size:14px;">
                    <?=$sozlesme['icerik']?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=$diller['modal-kapat']?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <?php if(isset($_SESSION['teslimatArea']) && $_SESSION['teslimatArea']['status'] == 'error'){ ?>
        <body onload="sweetAlert('<?= $diller['post-hata']?>', '<?= $diller['form-eksik-alan']?>', 'warning');"></body>
        <meta http-equiv="refresh" content="3; URL=teslimat">
        <?php unset($_SESSION['teslimatArea']); ?>
    <?php }?>
    <?php if(isset($_SESSION['eposta_hata']) && $_SESSION['eposta_hata'] == 'wrong'){ ?>
        <body onload="sweetAlert('<?= $diller['post-hata']?>', '<?= $diller['uyelik-gecersiz-eposta']?>', 'warning');"></body>
        <meta http-equiv="refresh" content="3; URL=teslimat">
        <?php unset($_SESSION['eposta_hata']); ?>
    <?php }?>
    <?php include 'includes/template/footer.php'?>
    </body>
    </html>
    <?php include "includes/config/footer_libs.php";?>
<?php } /* Üyeliksiz Site İçin Teslimat Sayfası SON */ ?>
<?php } else {

    header('Location:'.$siteurl.'');

    exit;
} ?>