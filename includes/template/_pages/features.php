<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='ozellik' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
$ozelliksettings = $db->prepare("select * from ozellik_ayar where id=:id");
$ozelliksettings->execute(array(
        'id' => '1'
));
$ozellikset = $ozelliksettings->fetch(PDO::FETCH_ASSOC);

$num = 1;
$ozellik_listele = $db->prepare("select * from ozellik where durum=:durum and dil=:dil order by sira asc");
$ozellik_listele->execute(array(
        'durum' => '1',
        'dil' => $_SESSION['dil']
));
?>
<title><?php echo ucwords_tr($diller['ozellik']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$ozellikset[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$ozellikset[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$ozellikset[tags]" ?>">
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

<div class="features-page-main">



    <div class="features-page-text-main">

        <div class="features-page-baslik font-open-sans font-30 font-bold">

            <?php echo ucwords_tr($diller['ozellik']) ?>

        </div>



        <div class="page-spot-quote font-open-sans font-17 font-small">

            <?php echo $diller['ozellik-aciklamasi'] ?>

        </div>

        <div class="features-page-content ">

            <?php if ($ozellik_listele->rowCount() > 0) { ?>

                <?php foreach ($ozellik_listele as $oz) { ?>

                    <div class="features-box" data-appear-animation="fadeInUp" data-appear-animation-delay="<?php echo $num++ ?>00" >
                        <div class="features-box-icon" style="background: #<?php echo $ozellikset['icon_back_color']?>; border-radius: <?php echo $ozellikset['icon_border_radius']?>px;">
                            <div class="features-box-icon-table">
                                <div class="features-box-icon-table-ic">
                                    <i class="fa <?php echo $oz['icon']?>" style="color:#<?php echo $ozellikset['icon_color']?>;" ></i>
                                </div>
                            </div>
                        </div><div class="features-box-text">
                            <div class="features-box-text-head" style="color:#000">
                                <?php echo $oz['baslik']?>
                            </div>
                            <div class="features-box-text-spot" style="color:#666">
                                <?php echo $oz['spot']?>
                            </div>
                        </div>
                    </div>

                <?php }?>

            <?php } else { ?>

                <div class="features-box" data-appear-animation="fadeInUp" data-appear-animation-delay="300" >
                    <div class="features-box-icon" style="background: #000; border-radius: 60px;">
                        <div class="features-box-icon-table">
                            <div class="features-box-icon-table-ic">
                                <i class="fa fa-exclamation-circle" style="color:#FFF;" ></i>
                            </div>
                        </div>
                    </div><div class="features-box-text">
                        <div class="features-box-text-head" style="color:#000">
                            Özellik Eklenmemiş!
                        </div>
                        <div class="features-box-text-spot" style="color:#666">
                            Panelden yeni özellikler ekleyebilirsiniz
                        </div>
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

