<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='bank' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
$banka_liste = $db->prepare("select * from banka where durum=:durum order by sira asc");
$banka_liste->execute(array(
        'durum' => '1'
));
?>
<title><?php echo ucwords_tr($diller['banka-hesap']) ?> | <?php echo $ayar['site_baslik']?></title>
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

<div class="bank-page-main">



    <div class="bank-page-text-main">

        <div class="bank-page-baslik font-open-sans font-30 font-bold">

            <?php echo ucwords_tr($diller['banka-hesap']) ?>

        </div>



        <div class="page-spot-quote font-open-sans font-17 font-small">

            <?php echo $diller['banka-hesap-aciklamasi']?>

        </div>

        <div class="bank-page-content " >




            <?php foreach ($banka_liste as $banka) { ?><div class="bank-no-box">
                <div class="bank-no-box-img">
                    <img src="images/banka/<?=$banka['gorsel']?>" alt="<?=$banka['banka_adi']?>">
                </div>
                <div class="bank-no-box-txt font-open-sans font-14">
                    <strong><?php echo $diller['banka-adi'] ?> :</strong> <?=$banka['banka_adi']?>
                </div>
                <div class="bank-no-box-txt font-open-sans font-14">
                    <strong><?php echo $diller['banka-hesap-sahibi'] ?> :</strong> <?=$banka['hesap_sahibi']?>
                </div>
                <?php if($banka['sube'] == !null) {?>
                <div class="bank-no-box-txt font-open-sans font-14">
                    <strong><?php echo $diller['banka-sube'] ?> :</strong> <?=$banka['sube']?>
                </div>
                <?php }?>
                <?php if($banka['hesap_no'] == !null) {?>
                <div class="bank-no-box-txt font-open-sans font-14">
                    <strong><?php echo $diller['banka-hesap-no'] ?> :</strong> <?=$banka['hesap_no']?>
                </div>
                <?php }?>
                <?php if($banka['iban'] == !null) {?>
                <div class="bank-no-box-txt font-open-sans font-14">
                    <strong><?php echo $diller['banka-iban'] ?> :</strong> <?=$banka['iban']?>
                </div>
                <?php }?>
            </div><?php } ?>

            <?php if ($banka_liste->rowCount() === 0) { ?>

                <div class="alert alert-primary">
                    Henüz banka hesabı eklenmemiş!
                </div>

        <?php }?>


        </div>

    </div>






</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

