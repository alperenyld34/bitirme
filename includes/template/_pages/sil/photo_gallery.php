<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='foto' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
$photogallerysettings = $db->prepare("select * from galeri_ayar where id=:id");
$photogallerysettings->execute(array(
    'id' => '1'
));
$photoset = $photogallerysettings->fetch(PDO::FETCH_ASSOC);
?>
<?php
$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from galeri_kat where durum='1' and dil='$_SESSION[dil]' order by sira ASC");
$ToplamVeri = $Say->rowCount();
$Limit = 12;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$galeri_liste = $db->query("select * from galeri_kat where durum='1' and dil='$_SESSION[dil]' order by sira ASC limit $Goster,$Limit");
$GaleriAl = $galeri_liste->fetchAll(PDO::FETCH_ASSOC);
?>
<title><?php echo ucwords_tr($diller['foto-galeri']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$photoset[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$photoset[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$photoset[tags]" ?>">
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

<div class="photogallery-page-main">



    <div class="photogallery-page-text-main">

        <div class="photogallery-page-baslik font-open-sans font-30 font-bold">

            <img src="images/gallery_icn.png" alt="Galeri"> <?php echo ucwords_tr($diller['foto-galeri']) ?>

        </div>



        <div class="page-spot-quote font-open-sans font-17 font-small">

            <?php echo $diller['foto-galeri-aciklamasi'] ?>

        </div>

        <div class="photogallery-page-content">


<?php foreach ($GaleriAl as $galeri) {?>
            <div class="photogallery-box">
                <div class="photogallery-box-img">
                    <a href="galeri/<?=$galeri['id']?>/<?=seo($galeri['baslik'])?>">
                    <div class="photogallery-ovrly">
                        <i class="fa fa-search-plus"></i>
                    </div>

                    <img src="images/gallery/<?=$galeri['gorsel']?>" alt="<?=$galeri['baslik']?>">
                    </a>
                </div>
                <div class="photogallery-box-txt font-open-sans font-16 font-bold">
                    <a href="galeri/<?=$galeri['id']?>/<?=seo($galeri['baslik'])?>">
                        <?=$galeri['baslik']?>
                    </a>
                </div>
            </div>
<?php }?>





            <?php if ($galeri_liste->rowCount() <= 0) { ?>


            <?php } ?>


            <!---- Sayfalama Elementleri ================== !-->

            <?php if($Sayfa >= 1){?>
                <nav aria-label="Page navigation example" style="margin-top: 50px;">
                    <ul class="pagination pagination-sm justify-content-center">
            <?php } ?>

            <?php if($Sayfa > 1){?>

                <li class="page-item"><a class="page-link" href="foto-galeri/1"><?=$diller['sayfalama-ilk']?></a></li>
                <li class="page-item"><a class="page-link" href="foto-galeri/<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

            <?php } ?>
            <?php
            for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                if($i == $Sayfa){
                    echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="foto-galeri/'.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';
                }else{
                    echo '
                    <li class="page-item"><a class="page-link" href="foto-galeri/'.$i.'">'.$i.'</a></li>
                    ';
                }
            }
            }
            ?>

            <?php if($galeri_liste->rowCount() <=0) { } else { ?>
            <?php if($Sayfa != $Sayfa_Sayisi){?>

                    <li class="page-item"><a class="page-link" href="foto-galeri/<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                    <li class="page-item"><a class="page-link" href="foto-galeri/<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


            <?php }} ?>

          <?php if($Sayfa >= 1){?>
                    </ul>
                </nav>
          <?php } ?>
            <!---- Sayfalama Elementleri ================== !-->








        </div>

    </div>






</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

