<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$seo_url = $_GET['id'];
$htmlsayfa = $db->prepare("select * from htmlsayfa where seo_url=:seo_url and dil=:dil and durum=:durum order by id ");
$htmlsayfa->execute(array(
        'seo_url' => $seo_url,
    'dil' => $_SESSION['dil'],
    'durum' => '1'
));
$sayfa = $htmlsayfa->fetch(PDO::FETCH_ASSOC);
?>

<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='htmlsayfa' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>

<?php if ($sayfa['seo_url'] == $_GET['id'] ) { ?>
<title><?php echo $sayfa['baslik'] ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$sayfa[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$sayfa[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$sayfa[tags]" ?>">
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

<div class="html-page-main">



    <div class="html-page-text-main">

        <div class="html-page-baslik font-open-sans font-30 font-bold"><?php echo $sayfa['baslik'] ?></div>
        <div class="html-page-content font-open-sans font-16 font-small">
            <?php
            $icerik  = $sayfa['icerik'];
            $eski   = "../images";
            $yeni   = "images";
            $icerik = str_replace($eski, $yeni, $icerik);
            ?>
            <?=$icerik?>
        </div>

    </div>






</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>






<?php  } else { ?>
<script type='text/javascript'> document.location = 'index.php'; </script>
<?php }  ?>
