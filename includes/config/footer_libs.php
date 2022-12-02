<?php echo $ayar['analytics_code'] ?>
<?php echo $ayar['yandex_code'] ?>
<?php echo $ayar['canli_destek_kodu'] ?>
<!-- JS
=========================================-->

<script src='assets/js/tabs/tabs.js'></script>
<script src="assets/js/owl/owl.carousel.js"></script>
<script src="assets/helper/bootstrap/js/popper.min.js" ></script>
<script src="assets/helper/bootstrap/js/bootstrap.min.js" ></script>
<script src='assets/js/jquery.magnific-popup.min.js'></script>
<script src='assets/js/slider/swiper.js'></script>
<script src='assets/js/slider/aos.js'></script>
<script src="assets/helper/other/jquery.appear/jquery.appear.min.js"></script>
<script src="assets/helper/other/common/common.min.js"></script>
<script src="assets/helper/other/theme.js"></script>
<script src="assets/helper/other/theme.init.js"></script>
<script src='assets/js/filter-isotope/isotope.pkgd.js'></script>
<script src="assets/js/lightbox/lightbox.js"></script>
<script src='assets/js/progress/wow.min.js'></script>
<script src="assets/js/progress/progressbar.js"></script>
<script src="assets/js/sweetalert/sweetalert2.min.js"></script>

<!-- JS END
=========================================-->
<script id="rendered-js">
    // ===== Scroll to Top ====
    $(window).scroll(function () {
        if ($(this).scrollTop() >= 1000) {// If page is scrolled more than 50px
            $('#return-to-top').fadeIn(); // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(); // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function () {// When arrow is clicked
        $('body,html').animate({
            scrollTop: 0 // Scroll to top of body
        }, );
    });
    //# sourceURL=pen.js
</script>

<!-- MOBILE MENU =========================================================== !-->
<script >var $menuButton = $('.mobile-menu-bar-button');
    var clicked = false;


    $menuButton.click(function () {
        if (!clicked) {
            $('.opening-mobile-menu-div').slideDown('1s');
            clicked = true;
        } else
        {
            $('.opening-mobile-menu-div').slideUp('1s');
            clicked = false;
            $menuButton.blur();
        }

    });
    $(document).ready(function(){
        $('#nav-icon1,#nav-icon2,#nav-icon3,#nav-icon4').click(function(){
            $(this).toggleClass('open');
        });
    });
</script>

<!-- MOBILE MENU ACCORDION ITEMS ============================================= !-->
<script id="rendered-js">
    $("#eg1 li ul").slideToggle(); // hide all nested lists
    $("#eg1 li ul").prev("a").click(function () {// add fn to list items that have a nested list
        $(this).next("ul").slideToggle(100); // show/hide the nested list
        return false; // prevent scrolling
    });
</script>



<!-- Link Popup =================================================== !-->
<SCRIPT TYPE="text/javascript">
    <!--
    function popup(mylink, windowname)
    {
        if (! window.focus)return true;
        var href;
        if (typeof(mylink) == 'string')
            href=mylink;
        else
            href=mylink.href;
        window.open(href, windowname, 'width=500,height=450,scrollbars=yes');
        return false;
    }
    //-->
</SCRIPT>
<!-- Link Popup END !-->





<!-- SLIDER-TOP ============================================== !-->

<script id="rendered-js">
    var swiper = new Swiper('.swiper-container', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev' },

        pagination: {
            el: '.swiper-pagination', clickable: true, },

        autoplay: {
            delay: 6000,
        },


        on: {
            slideChangeTransitionStart: function () {
                $('.slider-section').hide(0);
                $('.slider-section').removeClass('aos-init').removeClass('aos-animate');
            },
            slideChangeTransitionEnd: function () {
                $('.slider-section').show(0);
                AOS.init();
            } } });

    AOS.init();
    //# sourceURL=pen.js
</script>
<!-- SLIDER-TOP END ============================================== !-->





<!-- SLIDER-MIDDLE ============================================== !-->

<script id="rendered-js">
    var swiper = new Swiper('.swiper-container-slider-2', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev' },

        pagination: {
            el: '.swiper-pagination', clickable: true, },
        autoplay: {
            delay: 7000,
        },
        on: {
            slideChangeTransitionStart: function () {
                $('.slider-section2').hide(0);
                $('.slider-section2').removeClass('aos-init').removeClass('aos-animate');
            },
            slideChangeTransitionEnd: function () {
                $('.slider-section2').show(0);
                AOS.init();
            } }


     });

    AOS.init();
    //# sourceURL=pen.js
</script>
<!-- SLIDER-MIDDLE END ============================================== !-->



<!-- FILTER ISOTOPE PROJECT
                    ============================================== !-->
<script id="rendered-js">
    // external js: isotope.pkgd.js

    // init Isotope
    var $grid = $('.filter-project-grid').isotope({
        itemSelector: '.project-item',
        layoutMode: 'fitRows' });

    // filter functions
    var filterFns = {
        // show if number is greater than 50
        numberGreaterThan50: function () {
            var number = $(this).find('.number').text();
            return parseInt(number, 10) > 50;
        },
        // show if name ends with -ium
        ium: function () {
            var name = $(this).find('.name').text();
            return name.match(/ium$/);
        } };

    // bind filter button click
    $('.filters-button-group').on('click', 'button', function () {
        var filterValue = $(this).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterFns[filterValue] || filterValue;
        $grid.isotope({ filter: filterValue });
    });
    // change is-checked class on buttons
    $('.button-group').each(function (i, buttonGroup) {
        var $buttonGroup = $(buttonGroup);
        $buttonGroup.on('click', 'button', function () {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
    });
    //# sourceURL=pen.js
</script>

<!-- FILTER ISOTOPE PROJECT END
                    ============================================== !-->





<!-- ADET SEÇİM CUSTOM ====================================== !-->
<script>
    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function () {
        var spinner = jQuery(this),
            input = spinner.find('input[type="number"]'),
            btnUp = spinner.find('.quantity-up'),
            btnDown = spinner.find('.quantity-down'),
            min = input.attr('min'),
            max = input.attr('max');

        btnUp.click(function () {
            var oldValue = parseFloat(input.val());
            if (oldValue >= max) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue + 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

        btnDown.click(function () {
            var oldValue = parseFloat(input.val());
            if (oldValue <= min) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue - 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

    });
    //# sourceURL=pen.js
</script>



<!-- Fixed Header Codes !-->
<script>
    $(window).stop().scroll(function() {
        var top = $(window).scrollTop();
        var durum = $("#fixed-header-main").css("display");

        if(top > 160){
            if(durum != "block"){
                $("#fixed-header-main").slideDown(160);
            }
        }else{
            if(durum != "none"){
                $("#fixed-header-main").slideUp(160);
            }
        }
    });
</script>
<!-- Fixed Header Codes SON !-->