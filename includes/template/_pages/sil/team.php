<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='ekip' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
$ekipsettings = $db->prepare("select * from ekip_ayar where id=:id");
$ekipsettings->execute(array(
    'id' => '1'
));
$ekipset = $ekipsettings->fetch(PDO::FETCH_ASSOC);

$num = 1;
$ekip_listele = $db->prepare("select * from ekip where durum=:durum and dil=:dil order by sira asc ");
$ekip_listele->execute(array(
    'durum' => '1',
    'dil' => $_SESSION['dil']
));
?>

<title><?php echo ucwords_tr($diller['ekip']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$ekipset[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$ekipset[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$ekipset[tags]" ?>">
<meta name="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta itemprop="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta name="robots" content="index follow">
<meta name="googlebot" content="index follow">
<meta property="og:type" content="website" />

<?php include "includes/config/header_libs.php";?>

</head>
<body>
<?php include 'includes/template/pre-loader.php'?>
<?php include 'includes/template/header.php'?>

<!-- CONTENT AREA ============== !-->

<div class="team-page-main">



    <div class="team-page-text-main">

        <div class="team-page-baslik font-open-sans font-30 font-bold">

            <?php echo ucwords_tr($diller['ekip']) ?>

        </div>

        <div class="page-quote font-open-sans font-15">

            <?php echo $diller['ekip-aciklamasi'] ?>

        </div>

        <div class="team-page-content ">



            <?php if ($ekip_listele->rowCount() > 0 ) { ?>

                <?php foreach ($ekip_listele as $ekip) { ?>
                    <div class="ekip-box" data-appear-animation="fadeInUp" data-appear-animation-delay="<?php echo $num++ ?>00">
                        <div class="ekip-box-img">
                            <img src="images/team/<?php echo $ekip['gorsel'] ?>" alt="<?php echo $ekip['isim'] ?>">
                        </div>
                        <div class="ekip-box-name">
                            <?php echo $ekip['isim'] ?>
                        </div>
                        <div class="ekip-box-position">
                            <?php echo $ekip['pozisyon'] ?>
                        </div>
                        <div class="ekip-box-mail-phone">
                            <?php if($ekip['mail'] == null) { } else {?>
                                <p><?php echo $ekip['mail'] ?></p>
                            <?php }?>
                            <?php if($ekip['tel'] == null) { } else {?>
                                <p><?php echo $ekip['tel'] ?></p>
                            <?php }?>
                        </div>
                        <div class="ekip-social-area">


                            <?php
                            $ekip_sosyal = $db->prepare("select * from ekip_sosyal where ekip_id='$ekip[id]' order by sira asc");
                            $ekip_sosyal->execute();
                            while($sos = $ekip_sosyal->fetch(PDO::FETCH_ASSOC))
                            {
                                ?><a href="<?php echo $sos['url'] ?>" target="_blank"><i class="fa <?php echo $sos['icon'] ?>" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="<?php echo $sos['baslik'] ?>"></i></a><?php }?>



                        </div>
                    </div>
                <?php }?>

            <?php } else { ?>

                <div class="ekip-box" data-appear-animation="fadeInUp" data-appear-animation-delay="300">
                    <div class="ekip-box-img">
                        <img src="http://www.fpoimg.com/250x256" alt="NoImage">
                    </div>
                    <div class="ekip-box-name">
                        Ekip Eklenmemiş!
                    </div>
                    <div class="ekip-box-position" style="width: 80%; margin: 0 auto;">
                        Lütfen firmanızdaki ekibinizle ilgili eklemeler yapınız.
                    </div>

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

