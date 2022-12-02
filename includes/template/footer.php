<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117170495-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-117170495-2');
</script>

<?php
$footersettings = $db->prepare("select * from footer_ayar where id='1'");
$footersettings->execute();
$footset = $footersettings->fetch(PDO::FETCH_ASSOC);

$footer_about_text = $db->prepare("select * from about_page where dil='$_SESSION[dil]' ");
$footer_about_text->execute();
$about = $footer_about_text->fetch(PDO::FETCH_ASSOC);

$footer_social_links = $db->prepare("select * from sosyal order by sira asc ");
$footer_social_links->execute();

$footer_links_0 = $db->prepare("select * from footer_menu where yer='0' and durum='1' and dil='$_SESSION[dil]' order by sira asc ");
$footer_links_0->execute();

$footer_links_1 = $db->prepare("select * from footer_menu where yer='1' and durum='1' and dil='$_SESSION[dil]' order by sira asc ");
$footer_links_1->execute();
?>
<style>
    .footer-main-div{width:<?php if($footset['width']==1){?> 90%; <?php }else {?> 100% <?php }?> ; height: auto; overflow: hidden; }
</style>
<?php include 'includes/template/_modules/trigger_bottom.php'?>
<div class="footer-main-div">


    <?php if($footset['tip'] == 0) { ?>
    <!--- TİP - 0 - DARK THEME  ===============================
    =============================================================================================== !-->


        <div class="footer-dark-ust-main">
            
            <div class="footer-dark-ust-main-inside">
                
                <div class="footer-dark-about-div">
                    
                    <div class="footer-dark-logo">
                        <img src="images/logo/<?php echo $ayar['site_footer_logo'] ?>" alt="<?php echo $ayar['site_baslik'] ?>">
                    </div>

                    <?php if($about['spot'] == null) {} else { ?>
                    <div class="footer-dark-about-text font-14 font-open-sans font-medium">
                        <?php echo $about['spot'] ?>

                        <br><br>

                        <a href="kurumsal/<?php echo $about['seo_url'] ?>" style="color:#766239 !important;">
                        <span style="color:#766239 !important;">
                            <?php echo $diller['footer-hakkimizda-devami'] ?>
                            <i class="fa fa-arrow-right" aria-hidden="true" style="margin-left: 10px;"></i>
                        </span>
                        </a>

                    </div>
                    <?php } ?>

                    <div class="footer-dark-social">

                        <?php foreach ($footer_social_links as $soc) { ?>
                            <a href="<?php echo $soc['url'] ?>" target="_blank"><i class="fa <?php echo $soc['icon'] ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $soc['baslik'] ?>"></i></a>
                        <?php }?>

                    </div>
                    
                </div>

                <div class="footer-dark-contact-div">

                    <?php if($ayar['adres_bilgisi'] == null) {} else { ?>
                        <div class="footer-dark-contact-div-box font-14 font-open-sans">
                            <i class="fa fa-globe"></i> <?php echo $ayar['adres_bilgisi'] ?>
                        </div>
                    <?php } ?>

                    <?php if($ayar['site_tel'] == null) {} else { ?>
                        <div class="footer-dark-contact-div-box font-14 font-open-sans font-medium font-spacing">
                            <i class="fa fa-phone"></i>
                            <a href="tel:<?=$telsonuc?>" style="text-decoration: none; color:#8d8d8d">
                                <?php echo $ayar['site_tel'] ?>
                            </a>

                        </div>
                    <?php } ?>
                    <?php if($ayar['site_gsm'] == null) {} else { ?>
                        <div class="footer-dark-contact-div-box font-14 font-open-sans font-medium font-spacing">
                            <i class="fa fa-mobile"></i>
                            <a href="tel:<?=$gsmsonuc?>" style="text-decoration: none; color:#8d8d8d">
                                <?php echo $ayar['site_gsm'] ?>
                            </a>

                        </div>
                    <?php } ?>
                    <?php if($ayar['site_whatsapp'] == null) {} else { ?>
                        <div class="footer-dark-contact-div-box font-14 font-open-sans font-medium font-spacing">
                            <i class="fa fa-whatsapp"></i>
                            <a href="https://api.whatsapp.com/send?phone=<?=$whtsonuc2?>&text=Merhaba&source=&data=" target="_blank" style="text-decoration: none; color:#8d8d8d">
                                <?php echo $whtsonuc1 ?>
                            </a>
                        </div>
                    <?php } ?>

                    <?php if($ayar['site_mail'] == null) {} else { ?>
                        <div class="footer-dark-contact-div-box font-14 font-open-sans font-spacing">
                            <i class="fa fa-envelope-o" style="margin-top: 1px"></i> <?php echo $ayar['site_mail'] ?>
                        </div>
                    <?php } ?>

                    <?php if($ayar['site_workhour'] == null) {} else { ?>
                    <div class="footer-dark-contact-div-box font-14 font-open-sans font-spacing" style="margin-bottom: 0px;">
                        <i class="fa fa-clock-o" style="margin-top: 4px;"></i> <?php echo $diller['calisma-saatleri'] ?>
                    </div>
                    <div class="footer-dark-contact-div-box font-14 font-open-sans font-spacing" style="line-height: 24px; padding-left: 25px;">
                        <?php echo $ayar['site_workhour'] ?>
                    </div>
                    <?php } ?>

                </div>

                <div class="footer-dark-links-div">

                    <div class="footer-dark-links-div-header font-16 font-spacing font-medium font-open-sans">
                        <?php echo $diller['kurumsal'] ?>
                    </div>


                    <?php foreach ($footer_links_0 as $flink0) { ?>
                    <div class="footer-dark-links-div-links font-13 font-small font-open-sans">
                        <a href="<?php echo $flink0['url'] ?>"><?php echo $flink0['baslik'] ?></a>
                    </div>
                    <?php }?>

                </div>

                <div class="footer-dark-links-div">

                    <div class="footer-dark-links-div-header font-16 font-spacing font-medium font-open-sans">
                        <?php echo $diller['baglantilar'] ?>
                    </div>

                    <?php foreach ($footer_links_1 as $flink1) { ?>
                        <div class="footer-dark-links-div-links font-13 font-small font-open-sans">
                            <a href="<?php echo $flink1['url'] ?>"><?php echo $flink1['baslik'] ?></a>
                        </div>
                    <?php }?>

                </div>
                
            </div>
            
        </div>

        <div class="footer-dark-alt-main">

            <div class="footer-dark-alt-main-inside">

                <div class="footer-dark-alt-main-left">
                   
                    <div class="footer-dark-alt-main-left-copyright font-open-sans font-14 font-bold" style="color:#FFF;">
                        <?php echo $ayar['copyright_1'] ?>
                    </div>
                    <div class="footer-dark-alt-main-left-text font-open-sans font-13 font-small" style="color:#666">
                        <?php echo $ayar['copyright_2'] ?>
                    </div>
                    
                </div><div class="footer-dark-alt-main-right">
                    <?php if($footset['gorsel_onay'] == 0) {} else { ?>
                    <img src="images/uploads/<?php echo $footset['gorsel'] ?>" alt="<?php echo $footset['gorsel'] ?>">
                    <?php }?>
                </div>

            </div>

        </div>
        
        
    <!--- TİP - 0 - DARK THEME END  ===============================
    =============================================================================================== !-->
    <?php } ?>



    <?php if($footset['tip'] == 1) { ?>
        <!--- TİP - 1 - LIGHT THEME  ===============================
        =============================================================================================== !-->

        <div class="footer-light-ust-main">

            <div class="footer-light-ust-main-inside">

                <div class="footer-light-about-div">

                    <div class="footer-light-logo">
                        <img src="images/logo/<?php echo $ayar['site_footer_logo'] ?>" alt="<?php echo $ayar['site_baslik'] ?>">
                    </div>

                    <?php if($about['spot'] == null) {} else { ?>
                        <div class="footer-light-about-text font-14 font-open-sans font-medium">
                            <?php echo $about['spot'] ?>

                            <br><br>

                            <a href="kurumsal/<?php echo $about['seo_url'] ?>" style="color:#000">
                        <span>
                            <?php echo $diller['footer-hakkimizda-devami'] ?>
                            <i class="fa fa-arrow-right" aria-hidden="true" style="margin-left: 10px;"></i>
                        </span>
                            </a>

                        </div>
                    <?php } ?>

                    <div class="footer-light-social">

                        <?php foreach ($footer_social_links as $soc) { ?>
                            <a href="<?php echo $soc['url'] ?>" target="_blank"><i class="fa <?php echo $soc['icon'] ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $soc['baslik'] ?>"></i></a>
                        <?php }?>

                    </div>

                </div>

                <div class="footer-light-contact-div">

                    <?php if($ayar['adres_bilgisi'] == null) {} else { ?>
                    <div class="footer-light-contact-div-box font-14 font-open-sans">
                        <i class="fa fa-globe"></i> <?php echo $ayar['adres_bilgisi'] ?>
                    </div>
                    <?php } ?>

                    <?php if($ayar['site_tel'] == null) {} else { ?>
                    <div class="footer-light-contact-div-box font-14 font-open-sans font-medium font-spacing">
                        <i class="fa fa-phone"></i>
                        <a href="tel:<?=$telsonuc?>" style="text-decoration: none; color:#333">
                            <?php echo $ayar['site_tel'] ?>
                        </a>
                    </div>
                    <?php } ?>

                    <?php if($ayar['site_gsm'] == null) {} else { ?>
                        <div class="footer-light-contact-div-box font-14 font-open-sans font-medium font-spacing">
                            <i class="fa fa-mobile"></i>
                            <a href="tel:<?=$gsmsonuc?>" style="text-decoration: none; color:#333">
                                <?php echo $ayar['site_gsm'] ?>
                            </a>
                        </div>
                    <?php } ?>

                    <?php if($ayar['site_whatsapp'] == null) {} else { ?>
                    <div class="footer-light-contact-div-box font-14 font-open-sans font-medium font-spacing">
                        <i class="fa fa-whatsapp"></i>
                        <a href="https://api.whatsapp.com/send?phone=<?=$whtsonuc2?>&text=Merhaba&source=&data=" target="_blank" style="text-decoration: none; color:#333">
                            <?php echo $whtsonuc1 ?>
                        </a>
                    </div>
                    <?php } ?>

                    <?php if($ayar['site_mail'] == null) {} else { ?>
                    <div class="footer-light-contact-div-box font-14 font-open-sans font-spacing">
                        <i class="fa fa-envelope-o" style="margin-top: 1px"></i> <?php echo $ayar['site_mail'] ?>
                    </div>
                    <?php } ?>

                    <?php if($ayar['site_workhour'] == null) {} else { ?>
                        <div class="footer-light-contact-div-box font-14 font-open-sans font-spacing" style="margin-bottom: 0px;">
                            <i class="fa fa-clock-o" style="margin-top: 4px;"></i> <?php echo $diller['calisma-saatleri'] ?>
                        </div>
                        <div class="footer-light-contact-div-box font-14 font-open-sans font-spacing" style="line-height: 24px; padding-left: 25px;">
                            <?php echo $ayar['site_workhour'] ?>
                        </div>
                    <?php } ?>

                </div>

                <div class="footer-light-links-div">

                    <div class="footer-light-links-div-header font-16 font-spacing font-medium font-open-sans">
                        <?php echo $diller['kurumsal'] ?>
                    </div>


                    <?php foreach ($footer_links_0 as $flink0) { ?>
                        <div class="footer-light-links-div-links font-13 font-small font-open-sans">
                            <a href="<?php echo $flink0['url'] ?>"><?php echo $flink0['baslik'] ?></a>
                        </div>
                    <?php }?>

                </div>

                <div class="footer-light-links-div">

                    <div class="footer-light-links-div-header font-16 font-spacing font-medium font-open-sans">
                        <?php echo $diller['baglantilar'] ?>
                    </div>

                    <?php foreach ($footer_links_1 as $flink1) { ?>
                        <div class="footer-light-links-div-links font-13 font-small font-open-sans">
                            <a href="<?php echo $flink1['url'] ?>"><?php echo $flink1['baslik'] ?></a>
                        </div>
                    <?php }?>

                </div>

            </div>

        </div>

 
        <!--- TİP - 1 - LIGHT THEME END  ===============================
        =============================================================================================== !-->
    <?php } ?>


</div>