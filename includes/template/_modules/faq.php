<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$faqAyar = $db->prepare("select * from sss_ayar where id='1'");
$faqAyar->execute();
$faqset = $faqAyar->fetch(PDO::FETCH_ASSOC);
$ssslimit = $faqset['sss_limit'];
?>
<?php
$sssCek = $db->prepare("select * from sss where durum='1' and dil='$_SESSION[dil]' and anasayfa='1' order by sira ASC limit $ssslimit");
$sssCek->execute();
?>
<style>
    .faq-home-main-div{width:<?php if($faqset['width']==1){?> 90%; <?php }else {?> 100% <?php }?> ; height: auto; overflow: hidden; background-color: #<?php echo $faqset['back_color'] ?>; padding: <?php echo $faqset['padding'] ?>px 0 <?php echo $faqset['padding'] ?>px 0; }
    .accordion_main {  width: 100%; font-family: 'Open Sans', Arial; text-align: left  }

    .accordion-header,
    .accordion-body {}

    .accordion__item{border:1px solid #EBEBEB !important; margin-bottom: 10px;}
    .accordion-header {
        padding: 1.5em 1.5em;
        background: #FFF;
        color: #000;
        cursor: pointer;
        font-size:15px; font-weight: 600;
        letter-spacing: .05em;
        transition: all .3s;
    }
    .accordion__item:last-child{border-bottom:1px solid #EBEBEB !important;}


    .accordion-body {
        background: #FFF;
        color: #3f3c3c;
        display: none;
    }

    .accordion-body__contents {
        padding: 0 1.5em 25px 1.5em; line-height: 25px;
        font-size: 14px;  width: 100%;letter-spacing: .03em;
    }

    .accordion__item.active:last-child .accordion-header {
        border-radius: 0;
    }

    .accordion:first-child > .accordion__item > .accordion-header {
        border-bottom: 1px solid transparent;
    }

    .accordion__item > .accordion-header:after {
        content: "\f3d0";
        font-family: IonIcons;
        font-size: 1.2em;
        float: right;
        position: relative;
        top: -2px;
        transition: .3s all;
        transform: rotate(0deg);
    }

    .accordion__item.active > .accordion-header:after {
        transform: rotate(-180deg);
    }

    .accordion__item.active .accordion-header {
        background: #FFF;
        color:#000
    }

    .accordion__item .accordion__item .accordion-header {
        background: #f1f1f1;
        color: black;
    }

</style>


<div class="faq-home-main-div">

    <div class="modules-header-main">
        <div class="modules-header-main-head" style="background:url(images/<?php echo $faqset['divider'] ?>.png) no-repeat center bottom;">
            <div class="modules-header-main-baslik font-open-sans font-<?php echo $faqset['font_weight'] ?> font-spacing" style="color:#<?php echo $faqset['baslik_color'] ?>">
                <?php echo $diller['sss']?> <i class="fa fa-question-circle"></i>
            </div>
            <div class="modules-header-main-spot font-raleway font-light" style="color:#<?php echo $beceriset['spot_color'] ?>; letter-spacing: 0.07em">
                <?php echo $diller['sss-aciklamasi']?>
            </div>
        </div>
    </div>

    <div class="faq-home-main-div-inside ">


        <div class="accordion_main js-accordion">


            <?php foreach ($sssCek as $sss) { ?>
            <div class="accordion__item js-accordion-item ">
                <div class="accordion-header js-accordion-header"><div class="faq_span"><?=$sss['soru']?></div></div>
                <div class="accordion-body js-accordion-body">
                    <div class="accordion-body__contents">
                        <?=$sss['cevap']?>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php if ($sssCek->rowCount() <=0) { ?>
            <div class="alert alert-danger">Soru eklenmemiş ya da anasayfa seçilmemiş!</div>
            <?php }?>

        </div>




    </div>
</div>
<script id="rendered-js">
    var accordion = function () {

        var $accordion = $('.js-accordion');
        var $accordion_header = $accordion.find('.js-accordion-header');
        var $accordion_item = $('.js-accordion-item');

        // default settings
        var settings = {
            // animation speed
            speed: 400,

            // close all other accordion items if true
            oneOpen: false };


        return {
            // pass configurable object literal
            init: function ($settings) {
                $accordion_header.on('click', function () {
                    accordion.toggle($(this));
                });

                $.extend(settings, $settings);

                // ensure only one accordion is active if oneOpen is true
                if (settings.oneOpen && $('.js-accordion-item.active').length > 1) {
                    $('.js-accordion-item.active:not(:first)').removeClass('active');
                }

                // reveal the active accordion bodies
                $('.js-accordion-item.active').find('> .js-accordion-body').show();
            },
            toggle: function ($this) {

                if (settings.oneOpen && $this[0] != $this.closest('.js-accordion').find('> .js-accordion-item.active > .js-accordion-header')[0]) {
                    $this.closest('.js-accordion').
                    find('> .js-accordion-item').
                    removeClass('active').
                    find('.js-accordion-body').
                    slideUp();
                }

                // show/hide the clicked accordion item
                $this.closest('.js-accordion-item').toggleClass('active');
                $this.next().stop().slideToggle(settings.speed);
            } };

    }();

    $(document).ready(function () {
        accordion.init({ speed: 300, oneOpen: true });
    });
    //# sourceURL=pen.js
</script>
