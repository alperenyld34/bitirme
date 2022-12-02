<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='blog' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
$blogsettings = $db->prepare("select * from blog_ayar where id=:id");
$blogsettings->execute(array(
        'id' => '1'
));
$blogsett = $blogsettings->fetch(PDO::FETCH_ASSOC);
$num = 1;
?>
<?php
$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from blog where durum='1' and dil='$_SESSION[dil]' order by id DESC");
$ToplamVeri = $Say->rowCount();
$Limit = 12;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$Blog_listele = $db->query("select * from blog where durum='1' and dil='$_SESSION[dil]' order by id DESC limit $Goster,$Limit");
$BlogAl = $Blog_listele->fetchAll(PDO::FETCH_ASSOC);
?>
<title><?php echo ucwords_tr($diller['blog']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$blogset[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$blogset[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$blogset[tags]" ?>">
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

<div class="blog-page-main">



    <div class="blog-page-text-main">

        <div class="blog-page-baslik font-open-sans font-30 font-bold">

            <?php echo ucwords_tr($diller['blog']) ?>

        </div>



        <div class="page-spot-quote font-open-sans font-17 font-small">

            <?php echo $diller['blog-aciklamasi'] ?>

        </div>

        <div class="blog-page-content">


            <?php if ($Blog_listele->rowCount() > 0) { ?>



                <?php foreach($BlogAl as $blog){?>
                    <div class="blog-box" data-appear-animation="fadeInUp" data-appear-animation-delay="<?php echo $num++ ?>00">

                        <div class="blog-box-in">
                            <a href="blog/<?php echo seo($blog['id'])?>/<?php echo seo($blog['baslik']) ?>">
                                <img src="images/blog/<?php echo $blog['gorsel'] ?>" alt="<?php echo $blog['baslik'] ?>">
                            </a>
                            <div class="blog-box-in-header">
                                <a href="blog/<?php echo seo($blog['id'])?>/<?php echo seo($blog['baslik']) ?>" style="color:#000">
                                    <?php echo $blog['baslik'] ?>
                                </a>
                            </div>
                            <?php if($blog['spot'] == !null) {?>
                            <div class="blog-box-in-spot" style="color:#666">
                                <?php echo $blog['spot'] ?>
                            </div>
                            <?php }?>
                            <div class="blog-box-in-readmore">
                                <a href="blog/<?php echo seo($blog['id'])?>/<?php echo seo($blog['baslik']) ?>" style="color:tomato">
                                    <?php echo $diller['blog-devamini-oku']?> <i class="fa fa-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                <?php } ?>




            <!---- Sayfalama Elementleri ================== !-->

            <?php if($Sayfa >= 1){?>
                <nav aria-label="Page navigation example" style="margin-top: 50px;">
                    <ul class="pagination pagination-sm justify-content-center">
            <?php } ?>

            <?php if($Sayfa > 1){?>

                <li class="page-item"><a class="page-link" href="bloglar/1"><?=$diller['sayfalama-ilk']?></a></li>
                <li class="page-item"><a class="page-link" href="bloglar/<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

            <?php } ?>
            <?php
            for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                if($i == $Sayfa){
                    echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="bloglar/'.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';
                }else{
                    echo '
                    <li class="page-item"><a class="page-link" href="bloglar/'.$i.'">'.$i.'</a></li>
                    ';
                }
            }
            }
            ?>

            <?php if($Blog_listele->rowCount() <=0) { } else { ?>
            <?php if($Sayfa != $Sayfa_Sayisi){?>

                    <li class="page-item"><a class="page-link" href="bloglar/<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                    <li class="page-item"><a class="page-link" href="bloglar/<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


            <?php }} ?>

          <?php if($Sayfa >= 1){?>
                    </ul>
                </nav>
          <?php } ?>
            <!---- Sayfalama Elementleri ================== !-->


            <?php } else { ?>

                <div class="blog-box" data-appear-animation="fadeInUp" data-appear-animation-delay="300">

                    <div class="blog-box-in">
                        <img src="http://www.fpoimg.com/865x460" alt="No-Image">
                        <div class="blog-box-in-header">
                            Blog Eklenmemiş!
                        </div>
                        <div class="blog-box-in-spot">
                            Mevcut bir blog eklenmemiş! Panelinizden yeni bir blog ekleyebilirsiniz.
                        </div>

                    </div>

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

