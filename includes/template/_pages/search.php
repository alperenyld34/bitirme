<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='search' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
$productsayar = $db->prepare("select * from urunmodul_ayar where id=:id");
$productsayar->execute(array(
        'id' => '1'
));
$prodayar = $productsayar->fetch(PDO::FETCH_ASSOC);
?>
<?php
$durum = $_GET['hash'];
$s = $_GET['search'];
$arama_listele = $db ->prepare("select * from urun where (baslik LIKE '%".$s."%' or icerik LIKE '%".$s."%' or tags LIKE '%".$s."%' or spot LIKE '%".$s."%' or urun_kod LIKE '%".$s."%') and dil='$_SESSION[dil]'  ");
$arama_listele->execute();
?>
<title><?php echo ucwords_tr($diller['arama-sonuclari']) ?> | <?php echo $ayar['site_baslik']?></title>
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

        <div class="bank-page-baslik font-open-sans font-30 font-bold" style="margin-bottom: 50px;">

            <?php echo ucwords_tr($diller['arama-sonuclari']) ?>

        </div>


        <div style="width: 100%; text-align: center;">

            <?php

            if ($arama_listele->rowCount() > 0 && isset($durum)) {


            foreach ($arama_listele as $ara) {
                $pro_list_cat = $db->prepare("select * from urun_cat where id=:id and durum=:durum and dil=:dil order by id desc limit 1 ");
                $pro_list_cat->execute(array(
                        'id' => $ara['kat_id'],
                    'durum' => '1',
                    'dil' => $_SESSION['dil']
                ));
                $pro_cat = $pro_list_cat->fetch(PDO::FETCH_ASSOC);
                ?>




                <div class="product-main-box">
                    <div class="product-main-box-in">
                        <div class="product-main-box-img">

                            <img src="images/product/<?php echo $ara['gorsel'] ?>" alt="<?php echo $ara['baslik'] ?>">
                            <a href="urun/<?php echo $ara['id'] ?>/<?php echo seo($ara['baslik']) ?>"><div class="ovrly"></div></a>
                            <div class="buttons">
                                <a href="urun/<?php echo $ara['id'] ?>/<?php echo seo($ara['baslik']) ?>" class="text" style="color:#<?php echo $prodayar['incele_button_color']?>;"><i class="fa fa-search" style="color:#<?php echo $prodayar['incele_button_color']?>"></i> <?php echo $diller['incele'] ?></a>
                            </div>

                        </div>
                        <div class="product-main-box-baslik">
                            <div class="product-main-box-baslik-in">
                                <a href="urun/<?php echo $ara['id'] ?>/<?php echo seo($ara['baslik']) ?>"><?php echo $ara['baslik'] ?></a>
                            </div>
                        </div>
                        <div class="product-main-box-category">
                            <?php echo $pro_cat['baslik'] ?>
                        </div>
                        <div class="product-main-box-rate">

                            <?php if($ara['star_rate'] == 0){ ?>
                                <span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($ara['star_rate'] == 1){ ?>
                                <span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($ara['star_rate'] == 2){ ?>
                                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($ara['star_rate'] == 3){ ?>
                                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($ara['star_rate'] == 4){ ?>
                                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($ara['star_rate'] == 5){ ?>
                                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span>
                            <?php }?>

                        </div>
                        <div class="product-main-box-price">


                            <?php
                            if($ara['eski_fiyat']== null)
                            {
                            } else { ?>

                                <span style="font-size:15px; font-weight: 400; font-family: 'Open Sans', Arial; color:#999; display: inline-block; text-decoration: line-through;"><?php echo number_format($ara['eski_fiyat'], 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span></span>

                            <?php }?>


                            <?php
                            if($ara['fiyat']== null)
                            {
                            } else { ?>

                                <h1><?php echo number_format($ara['fiyat'], 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span></h1>

                            <?php }?>
                        </div>
                    </div>
                </div>



            <?php } ?>

            <?php
            } else {
               ?>
                <i class="fa fa-frown-o" style="font-size:32px"></i>
                <br><br>
                <?=$diller['arama-sonuc-bulunamadi']?>

            <?php
            }
            ?>

        </div>





    </div>






</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

