<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$faqSettings = $db->prepare("select * from sss_ayar where id=:id");
$faqSettings->execute(array(
        'id' => '1'
));
$faqset = $faqSettings->fetch(PDO::FETCH_ASSOC);
?>
<?php
$faqCek = $db->prepare("select * from sss where durum=:durum and dil=:dil order by sira asc");
$faqCek->execute(array(
        'durum' => '1',
        'dil' => $_SESSION['dil']
));
?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='faq' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<title><?php echo ucwords_tr($diller['sss']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$faqset[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$faqset[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$faqset[tags]" ?>">
<meta name="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta itemprop="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta name="robots" content="index follow">
<meta name="googlebot" content="index follow">
<meta property="og:type" content="website" />

<?php include "includes/config/header_libs.php";?>
    <style>
        .about-counter-div{background: #<?php echo $about['counter_bgcolor'] ?>}
    </style>
</head>
<body>

<?php include 'includes/template/header.php'?>



<!-- CONTENT AREA ============== !-->

<div class="faq-page-main">



    <div class="faq-page-text-main">

        <div class="faq-page-baslik font-open-sans font-30 font-bold">

            <?php echo ucwords_tr($diller['sss']) ?>

        </div>



        <div class="page-spot-quote font-open-sans font-17 font-small">

            <?php echo $diller['sss-aciklamasi'] ?>

        </div>


        <div class="skill-page-content">


            <div class="accordion_main js-accordion">
                <?php foreach ($faqCek as $sss) { ?>
                    <div class="accordion__item js-accordion-item ">
                        <div class="accordion-header js-accordion-header"><div class="faq_span"><?=$sss['soru']?></div></div>
                        <div class="accordion-body js-accordion-body">
                            <div class="accordion-body__contents">
                                <?=$sss['cevap']?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($faqCek->rowCount() <=0) { ?>
                    <div class="alert alert-danger">Soru eklenmemiş</div>
                <?php }?>
            </div>




        </div>

    </div>




</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>
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
