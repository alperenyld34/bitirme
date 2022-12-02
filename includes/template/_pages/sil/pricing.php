<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='pricing' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);

?>
<?php
$pricingayar = $db->prepare("select * from pricing_ayar where id=:id");
$pricingayar->execute(array(
        'id' => '1'
));
$pric = $pricingayar->fetch(PDO::FETCH_ASSOC);
?>
<?php
$num = 1;
$pricing_liste = $db->prepare("select * from pricing where durum=:durum and dil=:dil order by sira asc ");
$pricing_liste->execute(array(
    'durum' => '1',
    'dil' => $_SESSION['dil']
));
?>
<title><?php echo ucwords_tr($diller['pricing-table']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$pric[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$pric[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$pric[tags]" ?>">
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

<div class="pricing-page-main">



    <div class="pricing-page-text-main">

        <div class="pricing-page-baslik font-open-sans font-30 font-bold">

            <?php echo ucwords_tr($diller['pricing-table']) ?>

        </div>



        <div class="page-spot-quote font-open-sans font-17 font-small">

            <?php echo $diller['pricing-aciklamasi'] ?>

        </div>

        <div class="pricing-page-content">



            <?php if ($pricing_liste->rowCount() > 0) { ?>

                <?php foreach ( $pricing_liste as $pricing) { ?>

                    <div class="pricing-box" data-appear-animation="fadeInUp" data-appear-animation-delay="<?php echo $num++ ?>00" <?php if($pricing['tavsiye'] ==1) {?> style="border:3px solid #<?php echo $pric['tavsiye_color'] ?>; border-radius: 4px 4px 0 0;" <?php } ?>>

                        <?php if($pricing['tavsiye'] ==1) {?>

                            <div class="pricing-tavsiye-board" style="background: #<?php echo $pric['tavsiye_color'] ?>; color:#<?php echo $pric['tavsiye_text_color'] ?>">
                                <?php echo $diller['pricing-tavsiye'] ?>
                            </div>

                        <?php } ?>


                        <div class="pricing-box-icon">
                            <i class="fa <?php echo $pricing['icon'] ?>" style="color:#<?php echo $pric['icon_color'] ?>"></i>
                        </div>
                        <div class="pricing-box-head <?php echo $pric['text_size'] ?> <?php echo $pric['text_weight'] ?>" style="color:#<?php echo $pric['text_color'] ?>; <?php if($pricing['fiyat'] == null) { ?>border-bottom:1px solid #EBEBEB<?php }?> ">
                            <?php echo $pricing['baslik'] ?>
                        </div>
                        <?php if($pricing['fiyat'] == !null) { ?>
                        <div class="pricing-box-price">
                            <span class="pricing-price-span"><?php echo $pricing['fiyat'] ?> <?php echo $odemeayar['simge'] ?></span>
                            <span class="pricing-price-date-span"><?php echo $pricing['odeme_date'] ?></span>
                        </div>
                        <?php }?>
                        <?php
                        $pricing_ozellikler = $db->prepare("select * from pricing_ozellik where pr_id='$pricing[id]' and dil='$_SESSION[dil]' order by sira asc ");
                        $pricing_ozellikler->execute();
                        while($prozellik = $pricing_ozellikler->fetch(PDO::FETCH_ASSOC))
                        {
                            ?>

                            <div class="pricing-box-ozellik">
                                <span style="color:#<?php echo $pric['ozellik_color'] ?>"><?php echo $prozellik['baslik'] ?></span>
                            </div>

                        <?php }?>

                        <?php
                        if($pricing['url']==null){

                        } else {
                            ?>
                            <div class="pricing-box-button">

                                <a href="<?php echo $pricing['url'] ?>">
                                    <div class="pricing-box-button-button font-light"
                                         style="
                                         <?php if($pricing['tavsiye'] ==1) {?>
                             color:#<?php echo $pric['tavsiye_text_color'] ?>; background: #<?php echo $pric['tavsiye_color'] ?>
                             <?php } else {?>
                             color:#<?php echo $pric['button_text_color'] ?>; background: #<?php echo $pric['button_bg'] ?>
                             <?php }?>
                                                 ">
                                        <?php echo $diller['pricing-button-yazisi']; ?>
                                    </div>
                                </a>

                            </div>
                        <?php } ?>


                    </div>

                <?php }?>

            <?php } else { ?>

                <div class="pricing-box" data-appear-animation="fadeInUp" data-appear-animation-delay="300" style="padding: 50px">

                    <strong> HİÇ TABLO EKLENMEMİŞ!</strong>
                    <br> <br>
                    <span class="font-13 font-small font-open-sans" style="color:#666; ">Panelinizden yeni tablolar oluşturabilirsiniz</span>

                </div>

            <?php } ?>



        </div>

    </div>






</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

