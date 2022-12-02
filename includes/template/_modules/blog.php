<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$blogsettings = $db->prepare("select * from blog_ayar where id='1'");
$blogsettings->execute();
$blogsett = $blogsettings->fetch(PDO::FETCH_ASSOC);
$bloglimit = $blogsett["blog_limit"];
?>
<?php
$num = 1;
$blogliste = $db->prepare("select * from blog where durum='1' and dil='$_SESSION[dil]' and anasayfa='1' order by id desc limit $bloglimit");
$blogliste->execute();
?>
<style>
    .blog-home-main-div{width:<?php if($blogsett['width']==1){?> 90%; <?php }else {?> 100% <?php }?> ; height: auto; overflow: hidden; background-color: #<?php echo $blogsett['back_color'] ?>; padding: <?php echo $blogsett['padding'] ?>px 0 <?php echo $blogsett['padding'] ?>px 0; }
    .blog-box{background: #<?php echo $blogsett['box_bg_color']?>}
    .blog-box-in-spot{color:#<?php echo $blogsett['box_spot_color']?>}
    .blog-box-in-readmore a{color:#<?php echo $blogsett['box_more_color']?>}
    .blog-box-in img{border-radius: <?php echo $blogsett['border_radius'] ?>px}
</style>


<div class="blog-home-main-div">

    <div class="modules-header-main">
        <div class="modules-header-main-head" style="background:url(images/<?php echo $blogsett['divider'] ?>.png) no-repeat center bottom;">
            <div class="modules-header-main-baslik font-open-sans font-<?php echo $blogsett['font_weight'] ?> font-spacing" style="color:#<?php echo $blogsett['baslik_color'] ?>">
                <?php echo $diller['blog']?>
            </div>
            <div class="modules-header-main-spot font-raleway font-light" style="color:#<?php echo $blogsett['spot_color'] ?>; letter-spacing: 0.07em">
                <?php echo $diller['blog-aciklamasi']?>
            </div>
        </div>
    </div>

    <div class="blog-home-main-div-inside counters">

        <?php if ($blogliste->rowCount() >0) { ?>

       <?php foreach ($blogliste as $blog) { ?>
        <div class="blog-box" data-appear-animation="fadeInUp" data-appear-animation-delay="<?php echo $num++ ?>00">
            
            <div class="blog-box-in">
                <a href="blog/<?php echo seo($blog['id'])?>/<?php echo seo($blog['baslik']) ?>">
                <img src="images/blog/<?php echo $blog['gorsel'] ?>" alt="<?php echo $blog['baslik'] ?>">
                </a>
                <div class="blog-box-in-header">
                    <a href="blog/<?php echo seo($blog['id'])?>/<?php echo seo($blog['baslik']) ?>" style="color:#<?php echo $blogsett['box_header_color']?>">
                    <?php echo $blog['baslik'] ?>
                    </a>
                </div>
                <?php if($blog['spot'] == !null) {?>
                    <div class="blog-box-in-spot" style="color:#666">
                        <?php echo $blog['spot'] ?>
                    </div>
                <?php }?>
                <div class="blog-box-in-readmore">
                    <a href="blog/<?php echo seo($blog['id'])?>/<?php echo seo($blog['baslik']) ?>">
                        <?php echo $diller['blog-devamini-oku']?> <i class="fa fa-long-arrow-right"></i>
                    </a>
                </div>
            </div>
            
        </div>
        <?php } ?>

        <?php } else { ?>

            <div class="blog-box" data-appear-animation="fadeInUp" data-appear-animation-delay="300">

                <div class="blog-box-in">
                        <img src="http://www.fpoimg.com/865x460" alt="No-Image">
                    <div class="blog-box-in-header">
                            Blog Eklenmemiş!
                    </div>
                    <div class="blog-box-in-spot">
                        Mevcut bir blog eklenmemiş ya da anasayfa seçilmemiş! Panelinizden yeni bir blog ekleyebilirsiniz.
                    </div>

                </div>

            </div>

        <?php } ?>



    </div>
</div>
