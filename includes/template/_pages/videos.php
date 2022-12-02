<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='video' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
$videosettings = $db->prepare("select * from video_ayar where id=:id");
$videosettings->execute(array(
        'id' => '1'
));
$videoset = $videosettings->fetch(PDO::FETCH_ASSOC);


$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from video where durum='1' and dil='$_SESSION[dil]' order by sira ASC");
$ToplamVeri = $Say->rowCount();
$Limit = 12;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$video_list = $db->query("select * from video where durum='1' and dil='$_SESSION[dil]' order by sira ASC limit $Goster,$Limit");
$VideoAl = $video_list->fetchAll(PDO::FETCH_ASSOC);
?>
<title><?php echo ucwords_tr($diller['video']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$videoset[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$videoset[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$videoset[tags]" ?>">
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

<div class="videogallery-page-main">



    <div class="videogallery-page-text-main">

        <div class="videogallery-page-baslik font-open-sans font-30 font-bold">

            <img src="images/video_page_icn.png" alt="Videos"> <?php echo ucwords_tr($diller['video']) ?>

        </div>



        <div class="page-spot-quote font-open-sans font-17 font-small">

            <?php echo $diller['video-aciklamasi'] ?>

        </div>

    </div>

        <div class="videogallery-page-content">


<?php foreach ($VideoAl as $video) {?><div class="video-gallery-home-box" data-appear-animation="fadeInUp" data-appear-animation-delay="<?php echo $num++ ?>00">

    <div class="video-gallery-home-box-img" >

        <a href="video/<?php echo $video['id']?>/<?php echo seo($video['baslik'])?>">
            <div class="video-gallery-home-box-overlay">
                <div class="video-gallery-home-box-overlay-table">
                    <div class="video-gallery-home-box-overlay-table-in">
                        <div class="video-gallery-box-play-web"></div>
                    </div>
                </div>
            </div>
        </a>

        <img src="images/videos/<?php echo $video['gorsel'] ?>" alt="<?php echo $video['baslik'] ?>">

    </div>

    <div class="video-gallery-home-box-text">

        <a href="video/<?php echo $video['id']?>/<?php echo seo($video['baslik'])?>" style="color:#000"><?php echo $video['baslik'] ?></a>

        <br><br>
        <a href="video/<?php echo $video['id']?>/<?php echo seo($video['baslik'])?>" class="btn btn-sm btn-<?php echo $videoset['button_bg'] ?>" role="button" aria-pressed="true">
            <i class="fa fa-video-camera" style="font-size:15px !important; margin-bottom: 0 !important;"></i>
            <?php echo $diller["videoyu-izle"] ?>
        </a>
    </div>

    </div><?php }?>







            <?php if ($video_list->rowCount() <= 0) { ?>

                <div class="video-gallery-home-box" data-appear-animation="fadeInUp" data-appear-animation-delay="<?php echo $num++ ?>00">

                    <div class="video-gallery-home-box-img" >

                            <div class="video-gallery-home-box-overlay">
                                <div class="video-gallery-home-box-overlay-table">
                                    <div class="video-gallery-home-box-overlay-table-in">
                                        <div class="video-gallery-box-play-web"></div>
                                    </div>
                                </div>
                            </div>

                        <img src="http://www.fpoimg.com/380x240" alt="NoImage">

                    </div>

                    <div class="video-gallery-home-box-text">

                       VİDEO EKLENMEMİŞ!

                    </div>

                </div>
            <?php } ?>


            <!---- Sayfalama Elementleri ================== !-->

            <?php if($Sayfa >= 1){?>
                <nav aria-label="Page navigation example" style="margin-top: 50px;">
                    <ul class="pagination pagination-sm justify-content-center">
            <?php } ?>

            <?php if($Sayfa > 1){?>

                <li class="page-item"><a class="page-link" href="video-galeri/1"><?=$diller['sayfalama-ilk']?></a></li>
                <li class="page-item"><a class="page-link" href="video-galeri/<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

            <?php } ?>
            <?php
            for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                if($i == $Sayfa){
                    echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="video-galeri/'.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';
                }else{
                    echo '
                    <li class="page-item"><a class="page-link" href="video-galeri/'.$i.'">'.$i.'</a></li>
                    ';
                }
            }
            }
            ?>

            <?php if($video_list->rowCount() <=0) { } else { ?>
            <?php if($Sayfa != $Sayfa_Sayisi){?>

                    <li class="page-item"><a class="page-link" href="video-galeri/<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                    <li class="page-item"><a class="page-link" href="video-galeri/<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


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

