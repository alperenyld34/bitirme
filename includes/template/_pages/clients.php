<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='marka' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);

$markasettings = $db->prepare("select * from marka_ayar where id=:id");
$markasettings->execute(array(
        'id' => '1'
));
$markaset = $markasettings->fetch(PDO::FETCH_ASSOC);

$num = 1;
$marka_liste = $db->prepare("select * from marka where durum=:durum order by sira asc");
$marka_liste->execute(array(
        'durum' => '1'
));
?>
<title><?php echo ucwords_tr($diller['marka']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$markaset[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$markaset[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$markaset[tags]" ?>">
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

<div class="markalar-page-main">



    <div class="markalar-page-text-main">

        <div class="markalar-page-baslik font-open-sans font-30 font-bold">

            <?php echo ucwords_tr($diller['marka']) ?>

        </div>



        <div class="page-spot-quote font-open-sans font-17 font-small">

            <?php echo $diller['marka-aciklamasi'] ?>

        </div>

        <div class="markalar-page-content">




            <?php if ($marka_liste->rowCount() > 0 ) { ?>

                <?php foreach ($marka_liste as $marka) { ?>
                    <div class="markalar-page-box">

                            <?php if($marka['url']== null) {} else { ?>

                            <a href="<?php echo $marka['url'] ?>" target="_blank">

                                <div class="markalar-page-ovrly"><i class="fa fa-link"></i></div>

                            <?php } ?>

                            <img src="images/clients/<?php echo $marka['gorsel'] ?>" alt="<?php echo $marka['baslik'] ?>">

                            <?php if($marka['url']== null) {} else { ?>

                            </a>
                            <?php } ?>

                    </div>
                <?php } ?>

            <?php } else { ?>

                <div class="markalar-page-box">
                    <img src="https://via.placeholder.com/220x150?text=No+Image" alt="NoImage">
                    <br><br>
                    Marka Eklenmemiş!
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

