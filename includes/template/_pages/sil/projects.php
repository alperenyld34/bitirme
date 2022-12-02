<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='proje' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);

$projesettings = $db->prepare("select * from proje_ayar where id=:id");
$projesettings->execute(
        array(
                'id' => '1'
        )
);
$proset = $projesettings->fetch(PDO::FETCH_ASSOC);

$proje_cat_list = $db->prepare("select * from proje_kat where durum=:durum and dil=:dil order by sira asc");
$proje_cat_list->execute(array(
        'durum' => '1',
        'dil' => $_SESSION['dil']
));
?>
<title><?php echo ucwords_tr($diller['proje']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$proset[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$proset[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$proset[tags]" ?>">
<meta name="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta itemprop="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta name="robots" content="index follow">
<meta name="googlebot" content="index follow">
<meta property="og:type" content="website" />

<?php include "includes/config/header_libs.php";?>
<link rel="stylesheet" href="assets/css/filter-isotope/isotope.css">
</head>
<body>
<?php include 'includes/template/pre-loader.php'?>
<?php include 'includes/template/header.php'?>

<!-- CONTENT AREA ============== !-->

<div class="projects-page-main">



    <div class="projects-page-text-main">

        <div class="projects-page-baslik font-open-sans font-30 font-bold">

            <?php echo ucwords_tr($diller['proje']) ?>

        </div>



        <div class="page-spot-quote font-open-sans font-17 font-small">

            <?php echo $diller['proje-aciklamasi'] ?>

        </div>

        <div class="projects-page-content">





            <div class="button-group filters-button-group">

                <button class="filter-button is-checked" data-filter="*"><?php echo $diller['proje-tumu']; ?></button>

                <?php foreach ($proje_cat_list as $prokat) {?>
                    <button class="filter-button" data-filter=".<?php echo $prokat['id'] ?>"><?php echo $prokat['baslik'] ?></button>
                <?php } ?>

            </div>


            <div class="filter-project-grid">


                <?php

                $sql_projeler = $db->prepare("select * from proje where durum=:durum and dil=:dil order by id desc");
                $sql_projeler->execute(array(
                        'durum' => '1',
                    'dil' => $_SESSION['dil']
                ));
                while($proje = $sql_projeler->fetch(PDO::FETCH_ASSOC))
                {

                    ?>


                    <div class="project-item <?php echo $proje['kat_id'] ?>" >
                        <div class="project-item-img">

                            <?php if($proset['detay_url'] == 1) {?>
                            <a href="proje/<?php echo $proje['id']?>/<?php echo seo($proje['baslik']) ?>" >
                                <?php }?>
                                <img src="images/projects/<?php echo $proje['gorsel'] ?>" alt="<?php echo $proje['baslik'] ?>">
                                <?php if($proset['detay_url'] == 1) {?>
                            </a>
                        <?php }?>
                        </div>
                        <div class="project-item-text">
                            <?php if($proset['detay_url'] == 1) {?>
                            <a href="proje/<?php echo $proje['id']?>/<?php echo seo($proje['baslik']) ?>" style="color:#<?php echo $proset['pro_text_color'] ?>;">
                                <?php }?>
                                <?php echo $proje['baslik'] ?>
                                <?php if($proset['detay_url'] == 1) {?>
                            </a>
                        <?php }?>
                        </div>
                    </div>

                <?php }?>




            </div>




        </div>

    </div>






</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

