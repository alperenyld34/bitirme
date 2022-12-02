<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$sliderayar = $db->prepare("select * from slider_ayar where id='1'");
$sliderayar ->execute();
$slidayar = $sliderayar->fetch(PDO::FETCH_ASSOC);
?>
<?php
$slider = $db->prepare("select * from slider where dil='$_SESSION[dil]' and durum='1' and tur='1' order by sira asc");
$slider->execute();

?>


<style>
    .swiper-container {
        width: <?php if($slidayar['width']==1){?> 90%; <?php }else {?> 100% <?php }?>; margin: 0px auto;
        height: <?php if($slidayar['height']==1){?> 660px; <?php }else {?> 800px <?php }?>;
    }
    .swiper-slide {
        text-align: center;
        font-size: 18px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        align-items: center;

        background-size: 200% 100% !important;

    }
    .swiper-pagination-bullet-active {background: #FFF; width: 12px; height: 12px;}
    .swiper-pagination-bullet { width: 12px; height: 12px;}

    /* iphone 5s ==========================================
    *****************************************************************************/
    @media screen and (max-width:321px) and (min-width:0px) {
        .swiper-container {
            width: 100% !important; margin: 0px auto;
            height: <?=$slidayar['mobil_height']?>px !important;
        }

    }
    /*** iphone X - S5 vs ==========================================
    *****************************************************************************/
    @media screen and (max-width:410px) and (min-width:321px) {
        .swiper-container {
            width: 100% !important; margin: 0px auto;
            height: <?=$slidayar['mobil_height']?>px !important;
        }

    }
    /* Pixel 2 - iphone plus ==========================================
    *****************************************************************************/
    @media screen and (max-width:767px) and (min-width:410px) {
        .swiper-container {
            width: 100% !important; margin: 0px auto;
            height: <?=$slidayar['mobil_height']?>px !important;
        }
    }
    /* Ipad Pro*/
    @media screen and (max-width:1100px) and (min-width:1023px) {
        .swiper-container {
            height: <?php if($slidayar['height']==1){?> 500px;
        <?php }else {?> 660px <?php }?>;
        }
    }

    @media screen and (max-width:1023px) and (min-width:767px) {
        /* Ipad */
        .swiper-container {
            height: <?php if($slidayar['height']==1){?> 430px;
        <?php }else {?> 600px <?php }?>;
        }
    }

    /* RESPONSIVE ENDING ==========================================
    *****************************************************************************/
    @media screen and (max-width:1440px) and (min-width:1101px) {
        .swiper-container{ height: <?php if($slidayar['height']==1){?> 520px; <?php }else {?> 680px <?php }?>; }
    }
    @media screen and (max-width:1600px) and (min-width:1441px) {
        .swiper-container{ height: <?php if($slidayar['height']==1){?> 550px; <?php }else {?> 750px <?php }?>; }
    }
    @media screen and (max-width:1680px) and (min-width:1601px) {
        .swiper-container{ height: <?php if($slidayar['height']==1){?> 580px; <?php }else {?> 750px <?php }?>; }
    }



    .slider-font-type-baslik{ font-family: '<?php echo $slidayar['font'] ?>', sans-serif; font-size:47px; font-weight: 800;line-height: normal; letter-spacing: 0.04em; margin-bottom: 20px; }
    .slider-font-type-spot{ font-family: '<?php echo $slidayar['font'] ?>', sans-serif; font-size:20px; font-weight: 500;line-height: normal; letter-spacing: 0.01em; margin-bottom: 20px; }
    .slider-button-type{font-size:14px; font-family: '<?php echo $slidayar['font'] ?>', sans-serif; font-weight:800; letter-spacing: 0.05em ; margin-top:40px; padding: 12px 40px 12px 40px}
    .slider-button-type-2{font-size:14px; font-family: '<?php echo $slidayar['font'] ?>', sans-serif; font-weight:800; letter-spacing: 0.05em ; margin-top:40px; padding: 12px 40px 12px 40px}
</style>

<?php
if($slider->rowCount() > 0) { ?>
    <div class="swiper-container">
        <div class="swiper-wrapper">


            <?php foreach ($slider as $row) { ?>

                <div class="swiper-slide" style="background-image:url(images/slider/<?php echo $row['gorsel']; ?>);  background-size: cover !important; background-position:top center; ">




                    <div class="options-slider-box" style="text-align: <?php echo $row['area']; ?>;">


                        <?php
                        if($row['text_status'] == 1) {
                            ?>
                            <!-- Text-Status : 1 ise !-->
                            <div class="slider-text-div">

                                <div class="slider-section slider-font-type-baslik"  style="color:#<?php echo $row['text_bg'] ?>; " data-aos="<?php echo $row['baslik_animation'] ?>" data-aos-offset="200" data-aos-delay="50"   data-aos-duration="1000" >
                                    <?php echo $row['baslik']; ?>
                                </div>


                                <div class="slider-section slider-font-type-spot" style="color:#<?php echo $row['text_bg'] ?>; " data-aos="<?php echo $row['spot_animation'] ?>" data-aos-offset="200" data-aos-delay="50"   data-aos-duration="1500" >
                                    <?php echo $row['spot']; ?>
                                </div>

                                <?php if($row['url'] == null) {

                                } else { ?>

                                    <div class="slider-section" data-aos="<?php echo $row['button_animation'] ?>" data-aos-offset="200" data-aos-delay="50"   data-aos-duration="1500" >
                                        <a href="<?php echo $row['url'] ?>">
                                            <div class="btn btn-sm btn-<?php echo $row['button_bg'] ?> slider-button-type" style="width: auto; color:#<?php echo $row['button_text_color'] ?>">
                                                <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                <?php echo $row['button_text']; ?>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>


                            </div>
                            <!-- Text-Status : 1 ise !-->
                        <?php } ?>


                        <?php
                        if($row['text_status'] == 0) {
                            ?>
                            <!-- Text-Status : 0 ise !-->

                            <?php if($row['url'] == null) {

                            } else { ?>

                                <div class="options-slider-just-button">

                                    <div class="slider-section" style="" data-aos="fade-down" data-aos-offset="200" data-aos-delay="50"   data-aos-duration="2000" >
                                        <a href="<?php echo $row['url'] ?>">
                                            <div class="btn btn-<?php echo $row['button_bg'] ?> slider-button-type-2" style="width: auto;margin-top:330px; color:#<?php echo $row['button_text_color'] ?>">
                                                <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                <?php echo $row['button_text']; ?>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            <?php } ?>
                            <!-- Text-Status : 0 ise !-->
                        <?php } ?>


                    </div>

                    <?php
                    if($row['dark_bg']==1)
                    {
                        ?>
                        <!-- Slider Karartma Var ise !-->
                        <div style="background: rgba(0,0,0,0.6); width: 100%; height: 100%; position: absolute"></div>
                        <!-- Slider Karartma Var ise !-->
                    <?php } ?>


                </div>
            <?php } ?>



        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <div class="swiper-pagination"></div>
    </div>

<?php } else { ?>

<div class="swiper-container" >

    <div class="swiper-wrapper">

            <div class="swiper-slide" style="background:#CCC; text-align: center; font-size:25px; font-weight: 700 ">
                <div class="options-slider-box" style="text-align: center; ">
                    <i class="fa fa-exclamation-circle" style="font-size:35px"></i> <br>
                    SLIDER EKLENMEMİŞ <br>
                    <span style="font-size:16px; font-weight: 500">Lütfen yeni bir slider ekleyin</span> <br>
                    <span style="font-size:20px;">1920 x <?php if($slidayar['height'] == 1) { ?>660<?php } else { ?>800<?php }?></span>
                </div>
            </div>

    </div>
</div>

<?php } ?>

