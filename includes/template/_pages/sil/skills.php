<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$beceriSettings = $db->prepare("select * from beceri_ayar where id=:id");
$beceriSettings->execute(array(
        'id' => '1'
));
$skillset = $beceriSettings->fetch(PDO::FETCH_ASSOC);
?>
<?php
$beceriler = $db->prepare("select * from beceri where durum=:durum and dil=:dil order by sira asc");
$beceriler->execute(array(
        'durum' => '1',
        'dil' => $_SESSION['dil']
));
?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='skills' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<title><?php echo ucwords_tr($diller['beceri']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$skillset[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$skillset[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$skillset[tags]" ?>">
<meta name="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta itemprop="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta name="robots" content="index follow">
<meta name="googlebot" content="index follow">
<meta property="og:type" content="website" />

<?php include "includes/config/header_libs.php";?>
    <style>
        .progress-bar{
            background-color: #<?=$skillset['bar_sub_bg']?> !important;
        }
        .progress-bar > span{
            background: #<?=$skillset['bar_bg']?>;
        }
    </style>
</head>
<body>
<?php include 'includes/template/pre-loader.php'?>
<?php include 'includes/template/header.php'?>

<!-- CONTENT AREA ============== !-->

<div class="skill-page-main">



    <div class="skill-page-text-main">

        <div class="skill-page-baslik font-open-sans font-30 font-bold">

            <?php echo ucwords_tr($diller['beceri']) ?>

        </div>



        <div class="page-spot-quote font-open-sans font-17 font-small">

            <?php echo $diller['beceri-aciklamasi'] ?>

        </div>


        <div class="skill-page-content">

            <?php if ($beceriler->rowCount() >0) { ?>

                <?php foreach ($beceriler as $skill) { ?>
                    <div class="skill-box">
                        <div class="skill-box-ust font-spacing">
                            <strong><?php echo $skill['baslik'] ?></strong>
                            <span>%<?php echo $skill['oran'] ?></span>

                        </div>
                        <div class="skill-box-alt">
                            <div class="progress-bar">
                                <span data-percent="<?php echo $skill['oran'] ?>"></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            <?php } else { ?>



            <?php } ?>

        </div>

    </div>




</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>