<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?><?php
$yorumsettings = $db->prepare("select * from yorum_ayar where id='1'");
$yorumsettings->execute();
$yorumset = $yorumsettings->fetch(PDO::FETCH_ASSOC);
$yorumlimit = $yorumset["yorum_limit"];

?>
<?php
$num = 1;
$yorum_listele = $db->prepare("select * from yorum where durum='1' and dil='$_SESSION[dil]' order by sira asc limit $yorumlimit");
$yorum_listele->execute();
?>
<style>
    .comments-home-main-div{width:<?php if($yorumset['width']==1){?> 90%; <?php }else {?> 100% <?php }?> ; height: auto; overflow: hidden; background-color: #<?php echo $yorumset['back_color'] ?>; padding: <?php echo $yorumset['padding'] ?>px 0 <?php echo $yorumset['padding'] ?>px 0; }

    .owl-dots button{outline: none !important;  margin-top: 50px !important;}

    .owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot span {
        width: 15px;    height: 6px;    margin: 5px 4px;    background: rgba(0,0,0,0.2);    display: block;    -webkit-backface-visibility: visible;    transition: all .2s ease;    border-radius: 30px;
    }
    .owl-dot.active span {   width: 30px !important; background:#<?php echo $ayar['dots_color'] ?> !important;}
</style>


<div class="comments-home-main-div">

    <div class="modules-header-main">
        <div class="modules-header-main-head" style="background:url(images/<?php echo $yorumset['divider'] ?>.png) no-repeat center bottom;">
            <div class="modules-header-main-baslik font-open-sans font-<?php echo $yorumset['font_weight'] ?> font-spacing" style="color:#<?php echo $yorumset['baslik_color'] ?>">
                <?php echo $diller['yorum']?>
            </div>
            <div class="modules-header-main-spot font-raleway font-light" style="color:#<?php echo $yorumset['spot_color'] ?>; letter-spacing: 0.07em">
                <?php echo $diller['yorum-aciklamasi']?>
            </div>
        </div>
    </div>

    <div class="comments-home-main-div-inside counters">





        <div class="comments-owl owl-theme" >


            <?php if ($yorum_listele->rowCount() > 0 ) { ?>

            <?php foreach ($yorum_listele as $yorum)  {     ?>
                <div class="comment-box" >
                    <div class="comments-box-inside">
                        <div class="comments-box-quote" style="color:#<?php echo $yorumset['box_isim_color'] ?>">
                            <i class="fa fa-quote-left" ></i>
                        </div>
                        <div class="comments-box-stars">


                            <?php if($yorum['star_rate'] == 0){ ?>
                                <span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($yorum['star_rate'] == 1){ ?>
                                <span style="color:#<?php echo $yorumset['star_color']?>">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($yorum['star_rate'] == 2){ ?>
                                <span style="color:#<?php echo $yorumset['star_color']?>">★</span><span style="color:#<?php echo $yorumset['star_color']?>">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($yorum['star_rate'] == 3){ ?>
                                <span style="color:#<?php echo $yorumset['star_color']?>">★</span><span style="color:#<?php echo $yorumset['star_color']?>">★</span><span style="color:#<?php echo $yorumset['star_color']?>">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($yorum['star_rate'] == 4){ ?>
                                <span style="color:#<?php echo $yorumset['star_color']?>">★</span><span style="color:#<?php echo $yorumset['star_color']?>">★</span><span style="color:#<?php echo $yorumset['star_color']?>">★</span><span style="color:#<?php echo $yorumset['star_color']?>">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($yorum['star_rate'] == 5){ ?>
                                <span style="color:#<?php echo $yorumset['star_color']?>">★</span><span style="color:#<?php echo $yorumset['star_color']?>">★</span><span style="color:#<?php echo $yorumset['star_color']?>">★</span><span style="color:#<?php echo $yorumset['star_color']?>">★</span><span style="color:#<?php echo $yorumset['star_color']?>">★</span>
                            <?php }?>




                        </div>
                        <div class="comments-box-comment font-15 font-open-sans" style="color:#<?php echo $yorumset['box_icerik_color'] ?>">
                            <?php echo $yorum['icerik'] ?>
                        </div>
                        <div class="comments-box-img">
                            <?php
                            if($yorum['gorsel']== "no-image")
                            {
                            ?>
                                <img src="images/comments/yorum.jpg" alt="<?php echo $yorum['isim'] ?>">
                            <?php } else { ?>
                                <img src="images/comments/<?php echo $yorum['gorsel'] ?>" alt="<?php echo $yorum['isim'] ?>">
                            <?php }?>

                        </div>
                        <div class="comments-box-name font-16 font-open-sans font-bold" style="color:#<?php echo $yorumset['box_isim_color'] ?>">
                            <?php echo $yorum['isim'] ?>
                        </div>
                        <div class="comments-box-position font-14 font-medium font-open-sans" style="color:#<?php echo $yorumset['box_pozisyon_color'] ?>">
                            <?php echo $yorum['pozisyon'] ?>
                        </div>
                    </div>
                </div>
            <?php }?>

            <?php } else { ?>

                <div class="comment-box" >
                    <div class="comments-box-inside">
                        <div class="comments-box-quote" style="color:#000">
                            <i class="fa fa-quote-left" ></i>
                        </div>

                        <div class="comments-box-comment font-15 font-open-sans" style="color:#000">
                            Henüz müşteri yorumu eklenmemiş! Panelinizden ekleyebilirsiniz
                        </div>
                        <div class="comments-box-img">

                                <img src="images/comments/yorum.jpg" alt="NoImage">


                        </div>
                        <div class="comments-box-name font-16 font-open-sans font-bold" style="color:#000>">
                            İsim Alanı
                        </div>
                        <div class="comments-box-position font-14 font-medium font-open-sans" style="color:#666">
                           Meslek Alanı
                        </div>
                    </div>
                </div>


            <?php } ?>

        </div>


        <script>
            $(document).ready(function() {
                var owl = $('.comments-owl');
                owl.owlCarousel({
                    margin: 50,
                    nav: false,
                    dots:true,
                    navText: ["<img src='images/arrowleft.png'>","<img src='images/arrowright.png'>"],
                    navClass:['product_prev','product_next'],
                    responsiveClass:true,
                    loop: true,
                    autoplayHoverPause: true,
                    autoplay:true,
                    autoplayTimeout:5000,
                    responsive: {
                        0: {
                            items: 1
                        },

                        400: {
                            items: 1
                        },
                        415: {
                            items: 2
                        },
                        800: {
                            items: 2
                        },

         <?php
        if($yorum_listele->rowCount()>=3) {
        ?>
                        1000: {
                            items: 3
                        },
                        1100: {
                            items: 3
                        },
                        1600: {
                            items: 3
                        },
                        1920: {
                            items: 3
         <?php } else {?>
                        1000: {
                            items: <?=$yorum_listele->rowCount()?>
                        },
                            1100: {
                                items: <?=$yorum_listele->rowCount()?>
                            },
                            1600: {
                                items: <?=$yorum_listele->rowCount()?>
                            },
                            1920: {
                                items: <?=$yorum_listele->rowCount()?>
       <?php }?>

                        }
                    }
                })
            })
        </script>


    </div>
</div>
