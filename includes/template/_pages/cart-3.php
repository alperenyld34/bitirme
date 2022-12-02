<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php //** Cart Calc */
include "includes/func/calc.php";
?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='cart' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"])> 0 && isset($_SESSION['siparis_numarasi'])) {
?>
<?php if($uyeayar['durum']=='1' ) {?>
<?php if($userSorgusu->rowCount() > 0 ) {?>
        <?php
        $addressSorgu = $db->prepare("select * from uyeler_adres where uye_id=:uye_id ");
        $addressSorgu->execute(array(
            'uye_id' => $userCek['id']
        ));
        if($addressSorgu->rowCount()>0) {
            ?>
<?php
    if($odemeayar['pos_tur'] == 2)
    {
?>
<?php include_once 'includes/template/_pos/shopier/shopier_1.php'; ?>
<?php } else { ?>
<title><?php echo ucwords_tr($diller['odeme-bilgileri']) ?> | <?php echo $ayar['site_baslik']?></title>
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
                    <span style="font-weight: 400"><?=$diller['teslimat-ve-odeme']?></span><br><br>
                    <div style="clear: both"></div>
                    <div class="step-line step-line-active"></div><div class="step-num step-num-active">2</div><div class="step-line step-line-active"></div>
                </div><div class="step-box">
                    <span ><?=$diller['odeme-bilgileri']?></span><br><br>
                    <div style="clear: both"></div>
                    <div class="step-line step-line-active"></div><div class="step-num step-num-active">3</div><div class="step-line step-line-none"></div>
                </div>


            </div>
            <!-- STEP-STEP ============================== !-->
        <?php }?>


    <div class="purchase-main">


        <?php
        if($odemeayar['pos_tur'] == 0)
        {
        ?>

        <?php include 'includes/template/_pos/paytr/paytr.php'; ?>

        <?php } ?>


        <?php
        if($odemeayar['pos_tur'] == 1)
        {
        ?>
        <div class="iyzico-form-areas">
         <?php include 'includes/template/_pos/iyzico/iyzico.php'; ?>
        </div>
        <?php } ?>



        <?php
        if($odemeayar['pos_tur'] == 4)
        {
            ?>


            <div class="iyzico-form-areas">
                    <?php include 'includes/template/_pos/paywant/paywant_api.php'; ?>
                </div>


        <?php } ?>



    </div>


</div>

<!-- CONTENT AREA ============== !-->






<?php include 'includes/template/footer.php'?>
</body>
</html>
<?php include "includes/config/footer_libs.php";?>
    <?php }?>
        <?php } else {
            header('Location:'.$siteurl.'404');
        }?>
        <?php } else {
            header('Location:'.$siteurl.'404');
        }?>
    <?php }?>

    <?php
    /* ÜYELİKSİZ */
    if($uyeayar['durum']=='0') {?>
        <?php
        if($odemeayar['pos_tur'] == 2)
        {
            ?>
            <?php include_once 'includes/template/_pos/shopier/shopier_1.php'; ?>
        <?php } else { ?>
            <title><?php echo ucwords_tr($diller['odeme-bilgileri']) ?> | <?php echo $ayar['site_baslik']?></title>
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

                        <?php echo ucwords_tr($diller['odeme-bilgileri']) ?>

                    </div><div class="page-headers-main-right font-raleway font-12 font-spacing">

                        <span style="color:#<?php echo $pagehead['pasif_text_color'] ?>; padding-right: 15px;"><?php echo $diller['buradasiniz'] ?>:</span>
                        <a href="index.html" style="color:#<?php echo $pagehead['text_color'] ?>;"><span style="padding-right: 15px; font-weight: 600"><?php echo $diller['anasayfa'] ?></span></a>
                        <span style="color:#<?php echo $pagehead['pasif_text_color'] ?>; padding-right: 15px;">/</span>
                        <span style="padding-right: 15px; color:#<?php echo $pagehead['text_color'] ?>;"><?php echo ucwords_tr($diller['odeme-bilgileri']) ?></span>
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
                            <span style="font-weight: 400"><?=$diller['teslimat-ve-odeme']?></span><br><br>
                            <div style="clear: both"></div>
                            <div class="step-line step-line-active"></div><div class="step-num step-num-active">2</div><div class="step-line step-line-active"></div>
                        </div><div class="step-box">
                            <span ><?=$diller['odeme-bilgileri']?></span><br><br>
                            <div style="clear: both"></div>
                            <div class="step-line step-line-active"></div><div class="step-num step-num-active">3</div><div class="step-line step-line-none"></div>
                        </div>


                    </div>
                    <!-- STEP-STEP ============================== !-->
                <?php }?>


                <div class="purchase-main">


                    <?php
                    if($odemeayar['pos_tur'] == 0)
                    {
                        ?>

                        <?php include 'includes/template/_pos/paytr/paytr.php'; ?>

                    <?php } ?>


                    <?php
                    if($odemeayar['pos_tur'] == 1)
                    {
                        ?>
                        <div class="iyzico-form-areas">
                            <?php include 'includes/template/_pos/iyzico/iyzico.php'; ?>
                        </div>
                    <?php } ?>



                    <?php
                    if($odemeayar['pos_tur'] == 4)
                    {
                        ?>


                        <div class="iyzico-form-areas">
                            <?php include 'includes/template/_pos/paywant/paywant_api.php'; ?>
                        </div>


                    <?php } ?>



                </div>


            </div>

            <!-- CONTENT AREA ============== !-->






            <?php include 'includes/template/footer.php'?>
            </body>
            </html>
            <?php include "includes/config/footer_libs.php";?>
        <?php }?>
    <?php }?>

<?php } else {

    header('Location:'.$siteurl.'');

    exit;

}?>

