<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<div class="users-left-sidebar">

    <ul>
        <li class="user-name-bar" style="border-color:#ff4443; ">
            <i class="fa fa-user-o"></i> <?=$userCek['isim']?> <?=$userCek['soyisim']?>
        </li>
        <li <?php if ($current_page == 'hesap'){ ?>style="font-weight: 600; background-color: #FFF; border-left: 0; border-right: 0  " <?php }?>>
            <i class="ion-person"></i>
            <a href="uyelik/hesap-bilgileri"><?=$diller['uyepanel-hesap']?></a>
        </li>
        <li <?php if ($current_page == 'sifre'){ ?>style="font-weight: 600; background-color: #FFF; border-left: 0; border-right: 0" <?php }?>>
            <i class="fa fa-key" style="font-size:14px"></i>
            <a href="uyelik/sifre-degistir"><?=$diller['uyepanel-sifredegis']?></a>
        </li>
    <?php if($uyeayar['siparisler_alani'] == '1'  ) {?>
        <li <?php if ($current_page == 'siparis'){ ?>style="font-weight: 600; background-color: #FFF; border-left: 0; border-right: 0" <?php }?>>
            <i class="ion-bag"></i>
            <a href="uyelik/siparisler"><?=$diller['uyepanel-siparis']?></a>
        </li>
    <?php }?>
        <?php if($uyeayar['adres_alani'] == '1'  ) {?>
        <li <?php if ($current_page == 'adres'){ ?>style="font-weight: 600; background-color: #FFF; border-left: 0; border-right: 0  " <?php }?>>
            <i class="ion-ios-location"></i>
            <a href="uyelik/kayitli-adresler"><?=$diller['uyepanel-adresler']?></a>
        </li>
        <?php }?>
        <?php if($uyeayar['destek_alani'] == '1'  ) {?>
        <li <?php if ($current_page == 'destek'){ ?>style="font-weight: 600; background-color: #FFF; border-left: 0; border-right: 0  " <?php }?>>
            <i class="ion-help-buoy"></i>
            <a href="uyelik/destek"><?=$diller['uyepanel-destek']?></a>
        </li>
        <?php }?>
        <?php if($uyeayar['yorumlar_alani'] == '1'  ) {?>
            <li <?php if ($current_page == 'yorum'){ ?>style="font-weight: 600; background-color: #FFF; border-left: 0; border-right: 0  " <?php } //TODO BURASIDA VAR?>>
                <i class="ion-chatbubbles"></i>
                <a href="uyelik/yorumlar"><?=$diller['uyelik-uye-yorumlari']?></a>
            </li>
        <?php }?>
        <li>
            <i class="fa fa-sign-out"></i>
            <a href="uye-cikis"><?=$diller['uyepanel-cikis']?></a>
        </li>

    </ul>


</div>

<!---- RESPONSIVE DESIGN MOBILE CATEGORY =================================================================================0
============================================================================================ !-->
<style>
    .mobile-controls { background:#FFF; border:1px solid #EBEBEB; width:100%;  }
    .mobile-controls button {background:none; color:#000; border:0px; outline:none; width: 100%; text-align: left; padding: 0 15px 0 15px;height:39px;  font-family:'Open Sans',Serif; font-size:14px; font-weight:600; }
    .mobile-controls button i {   margin-right: 10px;}
    .mobile-controls .back-button { display:none; }
    .mobile-menu {display:none;   height:auto;      position:relative;  }
    .mobile-menu ul { margin:0;   padding: 0;  position: relative; overflow: hidden;  width: 100%;   transition: 0.25s; }
    .fa-chevron-down{
        transform: rotate(0deg);
        transition: transform .02s linear;
    }

    .fa-chevron-down.open{
        transform: rotate(180deg);
        transition: transform 0.2s linear;
    }
</style>

<div class="responsive-category-wrapper" >
    <div class="userpanel-namesurname">
        <i class="fa fa-user-o"></i> <?=$userCek['isim']?> <?=$userCek['soyisim']?>
    </div>
    <div class="mobile-controls">
            <span id="mobilcat_container">
                <button class="menu-toggle"><i class="fa fa-bars"></i> <?=$diller['uyepanel-kullanici-menusu']?>
                    <i id="icon" class="fa fa-chevron-down" style="float:right; margin-right: 0 !important; margin-top: 2px;font-size:16px !important; "></i>
                </button>
            </span>
    </div>

    <div class="mobile-menu">


        <div class="users-left-sidebar-mobil">

            <ul>
                <li <?php if ($current_page == 'hesap'){ ?>style="font-weight: 600; background-color: #FFF; border-left: 0; border-right: 0  " <?php }?>>
                    <i class="ion-person"></i>
                    <a href="uyelik/hesap-bilgileri"><?=$diller['uyepanel-hesap']?></a>
                </li>
                <li <?php if ($current_page == 'sifre'){ ?>style="font-weight: 600; background-color: #FFF; border-left: 0; border-right: 0" <?php }?>>
                    <i class="fa fa-key" style="font-size:14px"></i>
                    <a href="uyelik/sifre-degistir"><?=$diller['uyepanel-sifredegis']?></a>
                </li>
                <?php if($uyeayar['siparisler_alani'] == '1'  ) {?>
                    <li <?php if ($current_page == 'siparis'){ ?>style="font-weight: 600; background-color: #FFF; border-left: 0; border-right: 0" <?php }?>>
                        <i class="ion-bag"></i>
                        <a href="uyelik/siparisler"><?=$diller['uyepanel-siparis']?></a>
                    </li>
                <?php }?>
                <?php if($uyeayar['adres_alani'] == '1'  ) {?>
                    <li <?php if ($current_page == 'adres'){ ?>style="font-weight: 600; background-color: #FFF; border-left: 0; border-right: 0  " <?php }?>>
                        <i class="ion-ios-location"></i>
                        <a href="uyelik/kayitli-adresler"><?=$diller['uyepanel-adresler']?></a>
                    </li>
                <?php }?>
                <?php if($uyeayar['destek_alani'] == '1'  ) {?>
                    <li <?php if ($current_page == 'destek'){ ?>style="font-weight: 600; background-color: #FFF; border-left: 0; border-right: 0  " <?php }?>>
                        <i class="ion-help-buoy"></i>
                        <a href="uyelik/destek"><?=$diller['uyepanel-destek']?></a>
                    </li>
                <?php }?>
                <?php if($uyeayar['yorumlar_alani'] == '1'  ) {?>
                        <li <?php if ($current_page == 'yorum'){ ?>style="font-weight: 600; background-color: #FFF; border-left: 0; border-right: 0  " <?php }?>>
                            <i class="ion-chatbubbles"></i>
                            <a href="uyelik/yorumlar"><?=$diller['uyelik-uye-yorumlari']?></a>
                        </li>
                <?php }?>
                <li>
                    <i class="fa fa-sign-out"></i>
                    <a href="uye-cikis"><?=$diller['uyepanel-cikis']?></a>
                </li>

            </ul>


        </div>



    </div>
</div>

<script >$(document).ready(function () {

        // Variable declaration...
        var left, width, newLeft;

        // Add the "top-menu" class to the top level ul...
        $('.mobile-menu').children('ul').addClass('top-menu');

        // Add buttons to items that have submenus...
        $('.has_child_menu').append('<button class="arrow"><i class="fa fa-chevron-right"></i></button>');

        // Mobile menu toggle functionality
        $('.menu-toggle').on('click', function () {

            // Detect whether the mobile menu is being displayed...
            display = $('.mobile-menu').css("display");

            if (display === 'none') {

                // Display the menu...
                $('.mobile-menu').css("display", "block");

            } else {

                // Hide the mobile menu...
                $('.mobile-menu').css("display", "none");

                // and reset the mobile menu...
                $('.current-menu').removeClass('current-menu');
                $('.top-menu').css("left", "0");
                $('.back-button').css("display", "none");
            }
        });

        // Functionality to reveal the submenus...
        $('.arrow').on('click', function () {

            // The .current-menu will no longer be current, so remove that class...
            $('.current-menu').removeClass('current-menu');

            // Turn on the display property of the child menu
            $(this).siblings('ul').css("display", "block").addClass('current-menu');

            left = parseFloat($('.top-menu').css("left"));
            width = Math.round($('.mobile').width());
            newLeft = left - width;

            // Slide the new menu leftwards (into the .mobile viewport)...
            $('.top-menu').css("left", newLeft);

            // Also display the "back button" (if it is hidden)...
            if ($('.back-button').css("display") === "none") {
                $('.back-button').css("display", "flex");
            }

        });

        // Functionality to return to parent menus...
        $('.back-button').on('click', function () {

            // Hide the back button (if the current menu is the top menu)...
            if ($('.current-menu').parent().parent().hasClass('top-menu')) {
                $('.back-button').css("display", "none");
            }

            left = parseFloat($('.top-menu').css("left"));
            width = Math.round($('.mobile').width());
            newLeft = left + width;

            // Slide the new menu leftwards (into the .mobile viewport)...
            $('.top-menu').css("left", newLeft);

            // Allow 0.25 seconds for the css transition to finish...
            window.setTimeout(function () {

                // Hide the out-going .current-menu...
                $('.current-menu').css("display", "none");

                // Add the .current-menu to the new current menu...
                $('.current-menu').parent().parent().addClass('current-menu');

                // Remove the .current-menu class from the out-going submenu...
                $('.current-menu .current-menu').removeClass('current-menu');

            }, 250);

        });

    });
    //# sourceURL=pen.js
</script>
<script>
    (function(document){
        var div = document.getElementById('mobilcat_container');
        var icon = document.getElementById('icon');
        var open = false;

        div.addEventListener('click', function(){
            if(open){
                icon.className = 'fa fa-chevron-down';
            } else{
                icon.className = 'fa fa-chevron-down open';
            }

            open = !open;
        });
    })(document);</script>
<!---- RESPONSIVE DESIGN MOBILE CATEGORY ENDING =================================================================================0
============================================================================================ !-->