<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$seo_url = $_GET['id'];
$aboutAyarCek = $db->prepare("select * from about_ayar where id=:id");
$aboutAyarCek->execute(array(
        'id' => '1'
));
$aboutset = $aboutAyarCek->fetch(PDO::FETCH_ASSOC);

$aboutliste = $db->prepare("select * from about_page where seo_url=:seo_url and dil=:dil order by id ");
$aboutliste->execute(array(
        'seo_url' => $seo_url,
    'dil' => $_SESSION['dil']
));
$about = $aboutliste->fetch(PDO::FETCH_ASSOC);
?>
<?php
$countersettings = $db->prepare("select * from sayac_ayar where id=:id");
$countersettings->execute(array(
        'id' => '1'
));
$countsett = $countersettings->fetch(PDO::FETCH_ASSOC);
?>
<?php
$counters1 = $db->prepare("select * from sayac where durum=:durum and dil=:dil order by sira asc");
$counters1->execute(array(
    'durum' => '1',
    'dil' => $_SESSION['dil']
));
$sayi = 2;
?>
<?php
$counter_counts = $db->prepare("select * from sayac where durum='1' and dil='$_SESSION[dil]'");
$counter_counts->execute();
?>
<?php
$beceriler = $db->prepare("select * from beceri where durum=:durum and dil=:dil order by sira asc");
$beceriler->execute(array(
    'durum' => '1',
    'dil' => $_SESSION['dil']
));
$beceriSettings = $db->prepare("select * from beceri_ayar where id=:id");
$beceriSettings->execute(array(
    'id' => '1'
));
$skillset = $beceriSettings->fetch(PDO::FETCH_ASSOC);
?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='hakkimizda' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php if ($about['seo_url'] == $_GET['id']) { ?>
<title><?php echo $about['baslik'] ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$aboutset[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$aboutset[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$aboutset[tags]" ?>">
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

        .about-counter-div{background: #<?php echo $about['counter_bgcolor'] ?>}
    </style>
</head>
<body>
<?php include 'includes/template/header.php'?>



<!-- CONTENT AREA ============== !-->

<div class="about-page-main">



    <div class="about-page-text-main">

        <div class="about-page-baslik"><?php echo $about['baslik'] ?></div>
        <div class="about-page-content">
            <?php
            $icerik  = $about['icerik'];
            $eski   = "../images";
            $yeni   = "images";
            $icerik = str_replace($eski, $yeni, $icerik);
            ?>
            <?=$icerik?>
        </div>

    </div>





<?php if($about['counter'] == 1) { ?>
<div class="about-counter-div">


    <div class="counter-home-main-div-inside counters">


        <?php if($counter_counts->rowCount() > 0) { ?>

            <?php foreach ($counters1 as $count1){ ?>

                <div class="counter-box" style="color:#<?php echo $about['counter_textcolor'] ?>;" data-appear-animation="fadeInUp" data-appear-animation-delay="<?=$sayi++;?>00" >
                    <?php if ($countsett['icon'] == 1) {?>
                        <i class="fa <?php echo $count1['icon'] ?>"></i><br>
                    <?php }?>
                    <span data-to="<?php echo $count1['count'] ?>" <?php if($count1['plus'] == 1) { ?>data-append="+"<?php }?> >0</span><br>
                    <label><?php echo $count1['baslik'] ?></label>
                </div>

            <?php }?>

        <?php } else { ?>

            <div class="counter-box" style="color:#000>;" data-appear-animation="fadeInUp" data-appear-animation-delay="300" >


                <span data-to="0" >0</span><br>
                <label><strong>Counter Eklenmemiş !</strong></label>
                <br>
                <span style="font-size:13px !important;">Lütfen yeni bir sayaç kutusu ekleyiniz</span>
            </div>

        <?php }?>


    </div>



</div>
    <?php }?>


    <?php if($about['beceri'] == 1) { ?>
    <div class="about-page-skill-div">

        <div class="about-page-skill-left">

                <div class="about-page-skill-baslik">

                <?php echo $diller['beceri'] ?>

                </div>
                <div class="about-page-skill-content">

                    <?php echo $diller['beceri-aciklamasi'] ?>

                </div>

        </div><div class="about-page-skill-right">


<?php foreach ($beceriler as $beceri) {

?>

            <div class="skill-box">
                <div class="skill-box-ust font-spacing">
                    <strong><?php echo $beceri['baslik'] ?></strong>
                    <span>%<?php echo $beceri['oran'] ?></span>

                </div>
                <div class="skill-box-alt">
                    <div class="progress-bar">
                        <span data-percent="<?php echo $beceri['oran'] ?>"></span>
                    </div>
                </div>
            </div>

<?php } ?>



        </div>

    </div>
    <?php } ?>



    <?php if ($about['galeri_id'] == 0) {} else {?>
        <div class="about-page-images-slider">

            <div class="swiper-container" >
                <div class="swiper-wrapper">


                    <?php
                    $galeri_id_liste = $db ->prepare("select * from galeri_resim where kat_id='$about[galeri_id]' order by sira asc");
                    $galeri_id_liste->execute();
                    while ($galeri = $galeri_id_liste->fetch(PDO::FETCH_ASSOC)){
                        ?>

                        <div class="swiper-slide" >
                            <img src="images/gallery/<?php echo $galeri['gorsel'] ?>">
                        </div>

                    <?php } ?>

                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

                <div class="swiper-pagination"></div>

            </div>

        </div>
    <?php } ?>


</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>






<?php  } else { ?>
<script type='text/javascript'> document.location = 'index.php'; </script>
<?php }  ?>
