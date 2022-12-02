<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='katalog' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from katalog where dil='$_SESSION[dil]' order by id DESC");
$ToplamVeri = $Say->rowCount();
$Limit = 9;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$Katalog_Liste = $db->query("select * from katalog where dil='$_SESSION[dil]' order by id DESC limit $Goster,$Limit");
$KatalogAl = $Katalog_Liste->fetchAll(PDO::FETCH_ASSOC);
?>
<title><?php echo ucwords_tr($diller['katalog']) ?> | <?php echo $ayar['site_baslik']?></title>
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

<div class="catalog-page-main">



    <div class="catalog-page-baslik">
        <div class="catalog-page-baslik-head font-open-sans font-24 font-bold">
            <?php echo ucwords_tr($diller['katalog']) ?>
        </div>
        <div class="catalog-page-baslik-head font-open-sans font-14">
            <?php echo $diller['katalog-aciklamasi'] ?>
        </div>
        <div class="catalog-page-baslik-img">
            <img src="images/e-catalog.png" alt="E-Katalog">
        </div>


    </div><div class="catalog-page-content">

        <?php foreach($KatalogAl as $katalog){?><div class="catalog-box">


            <div class="catalog-box-img">
                <img src="images/catalog/<?=$katalog['gorsel']?>" alt="<?=$katalog['baslik']?>">
            </div>

            <div class="catalog-box-txt font-open-sans font-18 font-medium">
                <?=$katalog['baslik']?>
            </div>

            <div style="clear: both"></div>
            
            <a href="assets/uploads/<?=$katalog['url']?>" style="color: #FFF;" target="_blank">
            <div class="catalog-box-button">
                <i class="fa fa-download"></i>
            </div>
            </a>
                
        </div><?php } ?>


        <?php if ($Katalog_Liste->rowCount() <= 0) { ?>
            <div class="catalog-box">


                <div class="catalog-box-img">
                    <img src="http://www.fpoimg.com/244x233" alt="NoImage">
                </div>

                <div class="catalog-box-txt font-open-sans font-18 font-medium">
                    Katalog Eklenmemiş!
                </div>

                <div class="catalog-box-button">
                    <i class="fa fa-ban"></i>
                </div>

            </div>
        <?php } ?>




        <!---- Sayfalama Elementleri ================== !-->

        <?php if($Sayfa >= 1){?>
        <nav aria-label="Page navigation example" style="margin-top: 50px; margin-left: 20px;">
            <ul class="pagination pagination-sm">
                <?php } ?>

                <?php if($Sayfa > 1){?>

                    <li class="page-item"><a class="page-link" href="e-katalog/1"><?=$diller['sayfalama-ilk']?></a></li>
                    <li class="page-item"><a class="page-link" href="e-katalog/<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

                <?php } ?>
                <?php
                for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                    if($i == $Sayfa){
                        echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="e-katalog/'.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';
                    }else{
                        echo '
                    <li class="page-item"><a class="page-link" href="e-katalog/'.$i.'">'.$i.'</a></li>
                    ';
                    }
                }
                }
                ?>

                <?php if($Katalog_Liste->rowCount() <=0) { } else { ?>
                    <?php if($Sayfa != $Sayfa_Sayisi){?>

                        <li class="page-item"><a class="page-link" href="e-katalog/<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                        <li class="page-item"><a class="page-link" href="e-katalog/<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


                    <?php }} ?>

                <?php if($Sayfa >= 1){?>
            </ul>
        </nav>
    <?php } ?>
        <!---- Sayfalama Elementleri ================== !-->






    </div>



</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

