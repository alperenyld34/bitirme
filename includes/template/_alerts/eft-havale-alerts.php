<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='alert' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<title><?php echo ucwords_tr($diller['siparis-sonucu']) ?> | <?php echo $ayar['site_baslik']?></title>
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
</style>
<div class="page-headers-main">
    <div class="page-headers-main-in">
        <div class="page-headers-main-left font-raleway font-18 font-small font-spacing" style="color:#<?php echo $pagehead['text_color'] ?>;">

            <?php echo ucwords_tr($diller['siparis-sonucu']) ?>

        </div><div class="page-headers-main-right font-raleway font-12 font-spacing">

            <span style="color:#<?php echo $pagehead[pasif_text_color] ?>; padding-right: 15px;"><?php echo $diller['buradasiniz'] ?>:</span>
            <a href="index.html" style="color:#<?php echo $pagehead['text_color'] ?>;"><span style="padding-right: 15px; font-weight: 600"><?php echo $diller['anasayfa'] ?></span></a>
            <span style="color:#<?php echo $pagehead['pasif_text_color'] ?>; padding-right: 15px;">/</span>
            <span style="padding-right: 15px; color:#<?php echo $pagehead['text_color'] ?>;"><?php echo ucwords_tr($diller['siparis-sonucu']) ?></span>
        </div>
    </div>
</div>
<!-- Page Header ====================== !-->



<!-- CONTENT AREA ============== !-->

<div class="cart-page-main">

    <?php
    if ($_GET['status'] == "success" && isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"]) == !0 && isset($_SESSION['siparis_numarasi']))
    {
    ?>

    <div class="orders-alerts-inside">

        <div class="order-alerts-head">

            <div class="order-alerts-head-success">

                <img src="images/success.png" alt="Sipariş Başarılı"><br>
                <?=$diller['siparis-basarili']?>

            </div>
            <div class="order-alerts-head-order-id">

                <?=$diller['siparis-numaraniz']?> : <strong>#<?php echo $_SESSION['siparis_numarasi'] ?></strong>

            </div>

        </div>
        <div class="order-alerts-desc">

            <div class="order-alerts-desc-text">

                <?=$diller['eft-havale-basarili-aciklamasi']?>

            </div>
            <div class="order-alerts-desc-text">

                <strong style="font-size:18px"><?=$diller['odenecek-tutar']?> : <?php echo number_format($_SESSION['toplam_odenecek_tutar'], 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span></strong>

            </div>
            <div class="order-alerts-desc-text">

                <a href="hesap-numaralarimiz" target="_blank" role="button" class="btn btn-danger"><?=$diller['banka-hesap-numaralarimiz']?></a>

            </div>

        </div>


    </div>

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
        <?php unset($_SESSION['siparis_fatura_adres']); ?>
        <?php unset($_SESSION['basket_items']); ?>
        <?php
        if (isset($_SESSION['siparis_not'])) {

            unset($_SESSION['siparis_not']);

        }
        ?>


    <?php } else {


        header('Location:'.$siteurl.'');

        exit;

    } ?>



</div>

<!-- CONTENT AREA ============== !-->






<?php include 'includes/template/footer.php'?>
</body>
</html>
<?php include "includes/config/footer_libs.php";?>
