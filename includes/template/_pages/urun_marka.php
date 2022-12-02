<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='products' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
//todo üyelik eklentisine eklenecek update dosyası için ürün box alanında star olayını farklı yapmayı unutma!!!!


$marmaCek = $db->prepare("select * from urun_marka where id=:id");
$marmaCek->execute(array(
        'id' => $_GET['id']
));
$markaRow = $marmaCek->fetch(PDO::FETCH_ASSOC);


$urunSergile = $db->prepare("select * from urun where marka=:marka and dil=:dil and durum=:durum ");
$urunSergile->execute(array(
     'marka' => $markaRow['baslik'],
    'dil' => $_SESSION['dil'],
    'durum' => '1'
));
$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from urun where durum='1' and dil='$_SESSION[dil]' and marka='$markaRow[baslik]' order by id DESC");
$ToplamVeri = $Say->rowCount();
$Limit = 15;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$listeleQuery = $db->query("select * from urun where durum='1' and dil='$_SESSION[dil]' and marka='$markaRow[baslik]' order by id DESC limit $Goster,$Limit");
$listeAl = $listeleQuery->fetchAll(PDO::FETCH_ASSOC);

$urunSayisi = $db->prepare("select * from urun where durum='1' and dil='$_SESSION[dil]' and marka='$markaRow[baslik]' ");
$urunSayisi->execute();
?>
<?php
$productsayar = $db->prepare("select * from urunmodul_ayar where id=:id");
$productsayar->execute(array(
        'id' => '1'
));
$prodayar = $productsayar->fetch(PDO::FETCH_ASSOC);
?>
<title><?=$markaRow['baslik']?> <?=$diller['marka-text-3']?> | <?php echo $ayar['site_baslik']?></title>
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



        <div class="urun-marka-header">
            <div class="urun-marka-header-2">
                <?=$markaRow['baslik']?> <?=$diller['marka-text-3']?>
            </div>
            <?php if($markaRow['gorsel'] == !null) {?>
                <div class="urun-marka-header-1">
                    <img src="images/uploads/<?=$markaRow['gorsel']?>" alt="" style="max-width: 200px">
                </div>
            <?php }?>

        </div>

        <div style="width: 100%; text-align: center;">



                <?php foreach ($listeAl as $ara) {
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

                <?php }?>


        </div>


        <?php if($urunSayisi->rowCount()>$Limit  ) {?>
        <!---- Sayfalama Elementleri ================== !-->

        <?php if($Sayfa >= 1){?>
        <nav aria-label="Page navigation example" style="margin-top: 50px;">
            <ul class="pagination pagination-sm justify-content-center">
                <?php } ?>

                <?php if($Sayfa > 1){?>

                    <li class="page-item"><a class="page-link" href="urun-marka/<?=$_GET['id']?>?page=1"><?=$diller['sayfalama-ilk']?></a></li>
                    <li class="page-item"><a class="page-link" href="urun-marka/<?=$_GET['id']?>?page=<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

                <?php } ?>
                <?php
                for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                    if($i == $Sayfa){
                        echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="urun-marka/'.$_GET['id'].'?page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';
                    }else{
                        echo '
                    <li class="page-item"><a class="page-link" href="urun-marka/'.$_GET['id'].'?page='.$i.'">'.$i.'</a></li>
                    ';
                    }
                }
                }
                ?>

                <?php if($listeleQuery->rowCount() <=0) { } else { ?>
                    <?php if($Sayfa != $Sayfa_Sayisi){?>

                        <li class="page-item"><a class="page-link" href="urun-marka/<?=$_GET['id']?>?page=<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                        <li class="page-item"><a class="page-link" href="urun-marka/<?=$_GET['id']?>?page=<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


                    <?php }} ?>

                <?php if($Sayfa >= 1){?>
            </ul>
        </nav>
    <?php } ?>
        <!---- Sayfalama Elementleri ================== !-->
        <?php }?>


    </div>






</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

