<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$headerayar=$db->prepare("SELECT * from header_ayar where id='1'");
$headerayar->execute();
$head = $headerayar->fetch(PDO::FETCH_ASSOC);
$headerlimit = $head['header_limit'];
?>
<?php
$sosyalcon=$db->prepare("SELECT * from sosyal order by sira asc");
$sosyalcon->execute();
$sosyalmobile=$db->prepare("SELECT * from sosyal order by sira asc");
$sosyalmobile->execute();
?>
<?php
$headermainmenu=$db->prepare("SELECT * from header_menu where ust_id='0' and durum='1' and dil='$_SESSION[dil]' order by sira asc limit $headerlimit");
$headermainmenu->execute();
?>
<?php
$telmetin = $ayar['site_tel'];
$telsonuc = str_replace(' ', '', $telmetin);

$gsmmetin = $ayar['site_gsm'];
$gsmsonuc = str_replace(' ', '', $gsmmetin);


$whtmetin = $ayar['site_whatsapp'];
$whtsonuc1 = str_replace('90', '+90 ', $whtmetin);
$whtsonuc2 = str_replace(' ', '', $whtmetin);

$fixedmenu = $db->prepare("select * from sabit_header where id=:id ");
$fixedmenu->execute(array(
    'id' => '1',
));
$fx = $fixedmenu->fetch(PDO::FETCH_ASSOC);
?>
<?php

?>
<?php $hashOlusturrandom = rand(0,(int) 9999999999999);?>
<header>
    <style>
        .header-ust-bar-main{padding: <?php echo $head['padding'] ?>px 0 <?php echo $head['padding'] ?>px 0; background-color: #<?php echo $head['back_color'] ?> ; width: <?php if($head['topheader_width']==1){?> 90%; <?php }else {?> 100% <?php }?>; border-bottom: 1px solid #<?php echo $head['border_color'] ?>;}
        .header-ust-bar-right-table-ic-box i{color:#<?php echo $head['icon_color'] ?>}
        .header-ust-bar-right-table-ic-box p{color:#<?php echo $head['text_color'] ?>}
        .header-ust-bar-left-table-ic a{color:#<?php echo $head['icon_color'] ?>}
        .top-level-menu > li:hover {background:#<?php echo $head['menu_hover_color'] ?>}
        .mega-level-menu{border-top:2px solid #<?php echo $head['menu_hover_color'] ?>;}
        .mega-level-menu:after{border-bottom-color:#<?php echo $head['menu_hover_color'] ?>;}
        .second-level-menu{border-top:2px solid #<?php echo $head['menu_hover_color'] ?>;}
        .second-level-menu:after {border-bottom-color:#<?php echo $head['menu_hover_color'] ?>;}
        .third-level-menu{border-top:2px solid #<?php echo $head['menu_hover_color'] ?>;}
        .top-level-menu > li span{color:#<?php echo $head['menu_text_color'] ?>}
        .top-level-menu > li:hover span{color:#<?php echo $head['menu_text_hover_color'] ?>}
        .kargo-limit-header{width: <?php if($odemeayar['kargolimit_width']==1){?> 90%; <?php }else {?> 100% <?php }?>; height: auto; margin: 0 auto; padding:5px 0;  background: linear-gradient(to right, #<?=$odemeayar['kargolimit_bg_1']?>, #<?=$odemeayar['kargolimit_bg_2']?>); }


    </style>
    <!-- Kargo Bedava ===========================================================================
              ===========================!-->
    <?php if ($odemeayar['kargolimit_header'] == 1) {?>
        <?php if( $odemeayar['kargo_limit'] == 0 || $odemeayar['kargo_limit'] == null ) {} else { ?>
            <div class="kargo-limit-header">
                <div class="kargo-limit-header-inside font-<?=$odemeayar['kargolimit_font']?>" style="color:#<?=$odemeayar['kargolimit_text_color']?>">
                    <i class="fa fa-truck"></i>
                    <?php echo number_format($odemeayar['kargo_limit'], 2); ?> <?php echo $odemeayar['simge'] ?></strong> <?=$diller['kargo-limit-aciklamasi']?>
                </div>
            </div>
        <?php }}?>
    <!-- Kargo Bedava ===========================================================================
      ===========================!-->



    <?php
    $headertopdurum = $db->prepare("SELECT * from header_ayar where id='1' and durum='1'");
    $headertopdurum->execute();
    while($h = $headertopdurum->fetch(PDO::FETCH_ASSOC)){
    ?>
    <!-- TOP OF HEADER  ============================ !-->
        <div class="header-ust-bar-main">
            <div class="header-ust-bar-in">
                <div class="header-ust-bar-left">
                    <div class="header-ust-bar-left-table">
                        <div class="header-ust-bar-left-table-ic">
                            <?php
                            $headersosyaldurum = $db->prepare("SELECT * from header_ayar where id='1' and sosyal='1'");
                            $headersosyaldurum->execute();
                            while($h = $headersosyaldurum->fetch(PDO::FETCH_ASSOC)){
                                ?>

                                <?php foreach ($sosyalcon as $sosyal){ ?>
                                    <a href="<?php echo $sosyal['url']?>" target="_blank"><i class="fa <?php echo $sosyal['icon']?>" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="<?php echo $sosyal['baslik'] ?>"></i></a>
                                <?php }?>

                            <?php } ?>
                        </div>
                    </div>
                </div><div class="header-ust-bar-right">
                    <div class="header-ust-bar-right-table">
                        <div class="header-ust-bar-right-table-ic">



                            <?php
                            $headersosyaldurum = $db->prepare("SELECT * from header_ayar where id='1' and tel='1'");
                            $headersosyaldurum->execute();
                            while($h = $headersosyaldurum->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <div class="header-ust-bar-right-table-ic-box">
                                    <?php

                                    ?>
                                    <i class="fa fa-phone" aria-hidden="true"></i><p class="font-<?php echo $h['font']?>">
                                        <a href="tel:<?=$telsonuc?>" style="text-decoration: none; color:#<?php echo $head['text_color'] ?>">
                                            <?php echo $ayar['site_tel'] ?>
                                        </a>
                                    </p>
                                </div>
                            <?php } ?>
                            <?php if($head['tel_2'] == 1) { ?>
                                <div class="header-ust-bar-right-table-ic-box">
                                    <?php

                                    ?>
                                    <i class="fa fa-mobile" aria-hidden="true" style="font-size:18px"></i><p class="font-<?php echo $head['font']?>">
                                        <a href="tel:<?=$gsmsonuc?>" style="text-decoration: none; color:#<?php echo $head['text_color'] ?>">
                                            <?php echo $ayar['site_gsm'] ?>
                                        </a>
                                    </p>
                                </div>
                            <?php }?>
                            <?php
                            $headersosyaldurum = $db->prepare("SELECT * from header_ayar where id='1' and whatsapp='1'");
                            $headersosyaldurum->execute();
                            while($h = $headersosyaldurum->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <div class="header-ust-bar-right-table-ic-box">
                                    <i class="fa fa-whatsapp" aria-hidden="true"></i><p class="font-<?php echo $h['font']?>">

                                        <a href="https://api.whatsapp.com/send?phone=<?=$whtsonuc2?>&text=Merhaba&source=&data=" target="_blank" style="text-decoration: none; color:#<?php echo $head['text_color'] ?>">
                                            <?php echo $whtsonuc1 ?>
                                        </a>
                                    </p>
                                </div>
                            <?php } ?>
                            <?php
                            $headersosyaldurum = $db->prepare("SELECT * from header_ayar where id='1' and mail='1'");
                            $headersosyaldurum->execute();
                            while($h = $headersosyaldurum->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <div class="header-ust-bar-right-table-ic-box">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i><p class="font-<?php echo $h['font']?>"><?php echo $ayar['site_mail'] ?></p>
                                </div>
                            <?php } ?>

                            <!-- Teklif Button //TODO Burada ekleme !-->
                            <?php if($head['teklif_button'] == '1' ) {?>
                                <a href="teklif-formu" class="btn btn-sm btn-<?=$head['teklif_button_bg']?>" style="font-size: 13px ; font-family : 'Open Sans', Arial ;"><?=$diller['topheader-teklif-button-yazisi']?></a>
                            <?php }?>
                            <?php if($head['siparis_takip_button'] == '1' ) {?>
                                <a href="siparis-takip" class="btn btn-sm btn-<?=$head['siparis_takip_button_bg']?>" style="font-size: 13px ; font-family : 'Open Sans', Arial ;"><i class="fa fa-truck"></i> <?=$diller['topheader-siparis-takip-button-yazisi']?></a>
                            <?php }?>
                            <!-- Teklif Button SON !-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- TOP OF HEADER END  ============================ !-->
    <?php } ?>


    <!-- MAIN HEADER WEB  ============================ !-->
    <?php
    if ($head['header_tip'] == 1) {
        include'headertype/header-1.php';
    }
    if ($head['header_tip'] == 2) {
        include "headertype/header-2.php";
    }
    ?>
    <!-- MAIN HEADER WEB  ============================ !-->

    <!-- MOBILE HEADER =============================================================================================================================================== !-->
    <style>
        .header-mobile-main{background-color: #<?=$head['mobil_bg']?>}
        #nav-icon1 span, #nav-icon3 span, #nav-icon4 span {background: #<?=$head['mobil_bar_color']?>;}
        .ladder a:link, .ladder a:visited {
            color: #<?=$head['menu_text_color']?>;
        }
        .ladder a:hover {
            background: #<?=$head['menu_hover_color']?>;
            color: #<?=$head['menu_text_hover_color']?>;
            text-decoration: none;
        }
    </style>
    <div class="header-mobile-main">

        <div class="header-mobile-logo">

            <a href="index.html">
            <img src="images/logo/<?=$ayar['site_mobil_logo']?>" alt="<?=$ayar['site_baslik']?>">
            </a>

        </div><div class="header-mobile-right">

            <div class="header-mobile-right-cart">

               <div class="headernew_stil_icons">


                        <?php if($uyeayar['durum'] == 1  ) {?>
                            <?php if($userSorgusu->rowCount() <= 0  ) {?>
                                <a href="uye-girisi" style="color:#<?=$head['uyelik_icon_color']?> ">
                                    <div class="headernew_stil_box">
                                        <i class="<?=$head['uyelik_icon']?>" style="font-size:18px; margin-right: 10px;"></i>
                                    </div>
                                </a>
                            <?php } else { ?>
                                <a href="uyelik/hesap-bilgileri" style="color:#<?=$head['uyelik_icon_color']?> ">
                                    <div class="headernew_stil_box">
                                        <div class="giris-okey-name" style="background-color: #000; color: #FFF;">
                                            <i class="fa fa-caret-down" style="color: #000;"></i>
                                            <?=$diller['uyelik-header-ok']?>
                                        </div>
                                        <i class="<?=$head['uyelik_icon']?>" style="font-size:18px; margin-right: 10px;"></i>
                                    </div>
                                </a>
                            <?php }?>
                        <?php }?>


                   <?php if ($odemeayar['sepet_sistemi'] == 1) {?>
                   <div class="headernew_stil_box">
                       <a href="sepet" style="text-decoration: none;">
                           <i class="ion-bag" style="font-size:22px;  color:#<?=$odemeayar['cart_color']?>;"></i><?php
                           if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"]) > 0){
                               ?><span class="shopping-detail font-open-sans font-13 font-medium" style="background-color: #<?=$odemeayar['cart_count_bg']?>; color:#<?=$odemeayar['cart_count_color']?>">
                               <?php echo count($_SESSION["shopping_cart"]); ?>
                               </span>
                               <?php
                           } else {}
                           ?>
                       </a>
                   </div>
                   <?php }?>


               </div>

            </div><div class="header-mobile-right-bars">

                <button class="mobile-menu-bar-button"><div  id="nav-icon1"><span></span><span></span><span></span></div></button>

            </div>

        </div>

        <div class="opening-mobile-menu-div">

            <?php
            if ($head['sosyal'] == 1 || $head['dil_secim'] == 1)
            {
                ?>
                <div class="mobile-menu-social-div">

                    <div class="mobile-menu-social-div-left">

                        <?php if ($head['sosyal'] == 1) {?>

                            <?php foreach ($sosyalmobile as $sossss){ ?>

                                <a href="<?php echo $sossss['url']?>" target="_blank"><i class="fa <?php echo $sossss['icon']?>" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="<?php echo $sossss['baslik'] ?>"></i></a>

                            <?php }?>

                        <?php }?>

                    </div><div class="mobile-menu-social-div-right">

                        <?php if ($head['dil_secim'] == 1) {?>

                            <!-- Language Select !-->
                            <div class="dropdown">

                                <a class="dropdown-toggle dropdown-text-type-mobile-lang" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"  data-display="static" aria-haspopup="true" aria-expanded="false" style="text-transform: uppercase">

                                    <?php
                                    $flagsecim = $db->prepare("select * from dil where kisa_ad='$_SESSION[dil]'");
                                    $flagsecim->execute();
                                    $fl = $flagsecim->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="flag-icon-<?php echo $fl['flag'] ?>" style="width:18px; height:13px; display: inline-block; vertical-align: middle"></div>


                                    <div style="display: inline-block; vertical-align: middle; margin-top: -20px;"><?php echo $_SESSION['dil'] ?></div>
                                </a>
                                <div class="dropdown-menu dropdown-box-type-lang-show-2 dropdown-menu-lg-right" >

                                    <div class="dropdown-arrow-before-lang-2"></div>
                                    <?php
                                    $dilsirala = $db->prepare("select * from dil order by sira asc");
                                    $dilsirala->execute();
                                    while($d = $dilsirala->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <a class="dropdown-item dropdown-text-type" href="?language=<?php echo $d['kisa_ad'] ?>">
                                            <div class="flag-icon-<?php echo $d['flag'] ?>" style="width:18px; height:13px; display: inline-block; vertical-align: middle"></div>
                                            <?php echo $d['baslik'] ?>
                                        </a>

                                    <?php }?>
                                </div>
                            </div>
                            <!-- Language Select !-->

                        <?php } ?>

                    </div>

                </div>
            <?php }?>

            <?php
            if($head['arama_button'] == 1) {
            ?>
            <!-- ARAMA MOBIL ============= !-->
            <div class="header-mobile-menu-search-area">

                <form method="get" action="urunara?search=" >
                    <input type="text" name="search" required placeholder="<?=$diller['urun-ara-input-aciklama']?>"><input type="hidden" name="hash" value="<?=md5(sha1($hashOlusturrandom));?><?=md5(sha1($hashOlusturrandom));?>"><button><?=$diller['urun-ara-button-yazi']?></button>
                </form>

            </div>
            <!-- ARAMA MOBIL ============= !-->
            <?php }?>


            <!-- YENİ EKLENEN TOP HEADER BUTTONLARI //TODO !-->
            <?php if($head['teklif_button'] == '1' || $head['siparis_takip_button'] == '1'  ) {?>
                <style>
                    .offer-tracing-mobile-main-div{
                        width: 100%;
                        padding: 14px 0 14px 10px;
                        display: flex;
                        border-bottom: 1px solid #ebebeb;
                        justify-content: flex-start;
                        background-color: #<?=$head['menu_bg']; ?>;
                        align-items: center;
                    }
                    .offer-tracing-mobile-main-div a{
                        margin-right: 5px;
                    }
                </style>
                <div class="offer-tracing-mobile-main-div">
                    <?php if($head['teklif_button'] == '1' ) {?>
                        <a href="teklif-formu" class="btn btn-sm btn-<?=$head['teklif_button_bg']?>" style="font-size: 13px ; font-family : 'Open Sans', Arial ;"><?=$diller['topheader-teklif-button-yazisi']?></a>
                    <?php }?>
                    <?php if($head['siparis_takip_button'] == '1' ) {?>
                        <a href="siparis-takip" class="btn btn-sm btn-<?=$head['siparis_takip_button_bg']?>" style="font-size: 13px ; font-family : 'Open Sans', Arial ;"><i class="fa fa-truck"></i> <?=$diller['topheader-siparis-takip-button-yazisi']?></a>
                    <?php }?>
                </div>
            <?php }?>
            <!-- YENİ EKLENEN TOP HEADER BUTTONLARI //TODO SON !-->


            <!-- ACCORDION MENU ITEMLERİ ========================== !-->
            <?php
            $mobil_menu_cek = $db->prepare("select * from header_menu where durum='1' and dil='$_SESSION[dil]' and ust_id='0'  order by sira asc ");
            $mobil_menu_cek->execute();
            ?>

            <section id='eg1' class="ladder tree" style="text-align: left; background-color: #<?=$head['menu_bg']; ?> ">


                <ul>

                    <?php foreach ($mobil_menu_cek as $mobilmenurow) { ?>
                        <li>

                            <a href="<?=$mobilmenurow['url']?>"><?=$mobilmenurow['baslik']?>


                                <?php
                                $mobil_altmenu_cek = $db->prepare("select * from header_menu where ust_id='$mobilmenurow[id]' and durum='1' and dil='$_SESSION[dil]' order by id desc limit 1");
                                $mobil_altmenu_cek->execute();
                                while($mobilaltrow = $mobil_altmenu_cek->fetch(PDO::FETCH_ASSOC))
                                {
                                ?>
                                <i class="fa fa-angle-down"></i>
                                <?php } ?>


                            </a>


                            <?php
                            $mobil_altmenu_cek = $db->prepare("select * from header_menu where ust_id='$mobilmenurow[id]' and durum='1' and dil='$_SESSION[dil]' order by id desc limit 1");
                            $mobil_altmenu_cek->execute();
                            while($mobilaltrow = $mobil_altmenu_cek->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                            <ul>

                                <?php
                                $mobil_altmenu_ceks = $db->prepare("select * from header_menu where ust_id='$mobilmenurow[id]' and durum='1' and dil='$_SESSION[dil]' order by sira asc");
                                $mobil_altmenu_ceks->execute();
                                while($mobilaltrowname = $mobil_altmenu_ceks->fetch(PDO::FETCH_ASSOC))
                                {
                                    ?>
                                        <li>

                                            <a href="<?=$mobilaltrowname['url']?>"><i class="fa fa-caret-right" style="float: left; margin-right: 10px; margin-left:15px;font-size:15px;"></i> <?=$mobilaltrowname['baslik']?>


                                                <?php
                                                $mobil_altalt = $db->prepare("select * from header_menu where ust_id='$mobilaltrowname[id]' and durum='1' and dil='$_SESSION[dil]' order by id desc limit 1");
                                                $mobil_altalt->execute();
                                                while($mobilaltaltrow = $mobil_altalt->fetch(PDO::FETCH_ASSOC))
                                                {
                                                ?>
                                                <i class="fa fa-angle-down"></i>
                                                <?php }?>

                                            </a>






                                            <?php
                                            $mobil_altalt = $db->prepare("select * from header_menu where ust_id='$mobilaltrowname[id]' and durum='1' and dil='$_SESSION[dil]' order by id desc limit 1");
                                            $mobil_altalt->execute();
                                            while($mobilaltaltrow = $mobil_altalt->fetch(PDO::FETCH_ASSOC))
                                            {
                                            ?>
                                                <ul>


                                                    <?php
                                                    $mobil_altalt_ceks = $db->prepare("select * from header_menu where ust_id='$mobilaltrowname[id]' and durum='1' and dil='$_SESSION[dil]' order by sira asc");
                                                    $mobil_altalt_ceks->execute();
                                                    while($mobilaltaltname = $mobil_altalt_ceks->fetch(PDO::FETCH_ASSOC))
                                                    {
                                                    ?>

                                                        <li><a href="<?=$mobilaltaltname['url']?>"><i class="fa fa-angle-right" style="float: left; margin-right: 10px; margin-left: 30px; font-size:15px"></i> <?=$mobilaltaltname['baslik']?></a></li>

                                                    <?php } ?>



                                                </ul>
                                            <?php } ?>

                                        </li>
                                    <?php }?>

                             </ul>
                             <?php }?>

                        </li>
                    <?php }?>


                </ul>


            </section>
            <!-- ACCORDION MENU ITEMLERİ ========================== !-->




            <?php if($head['tel'] == 1 || $head['whatsapp'] == 1 || $head['mail'] == 1) { ?>
            <!-- İLETİŞİM BİLGİLERİ MOBIL ===================== !-->
            <div class="header-mobile-menu-contact-area">


                <?php if ($ayar['site_tel'] == !null) {?>
                    <div class="header-mobile-menu-contact-box">

                        <div class="header-mobile-menu-contact-box">

                            <i class="fa fa-phone"></i>
                            <p>
                                <a href="tel:<?=$telsonuc?>" style="text-decoration: none; color:#000">
                                    <?php echo $ayar['site_tel'] ?>
                                </a>
                            </p>

                        </div>

                    </div>
                <?php }?>

                <?php if ($ayar['site_gsm'] == !null) {?>
                    <div class="header-mobile-menu-contact-box">

                        <div class="header-mobile-menu-contact-box">

                            <i class="fa fa-mobile"></i>
                            <p>
                                <a href="tel:<?=$gsmsonuc?>" style="text-decoration: none; color:#000">
                                    <?php echo $ayar['site_gsm'] ?>
                                </a>
                            </p>

                        </div>

                    </div>
                <?php }?>

                <?php if ($ayar['site_whatsapp'] == !null) {?>
                    <div class="header-mobile-menu-contact-box">

                        <div class="header-mobile-menu-contact-box">

                            <i class="fa fa-whatsapp"></i>
                            <p>
                                <a href="https://api.whatsapp.com/send?phone=<?=$whtsonuc2?>&text=Merhaba&source=&data=" target="_blank" style="text-decoration: none; color:#000">
                                    <?php echo $whtsonuc1 ?>
                                </a>
                            </p>

                        </div>

                    </div>
                <?php }?>

                <?php if ($ayar['site_mail'] == !null) {?>
                    <div class="header-mobile-menu-contact-box">

                        <div class="header-mobile-menu-contact-box">

                            <i class="fa fa-envelope-o"></i>
                            <p>
                                <a href="mailto:<?=$ayar['site_mail']?>" style="text-decoration: none; color:#000"><?=$ayar['site_mail']?></a>
                            </p>

                        </div>

                    </div>
                <?php }?>


            </div>
            <!-- İLETİŞİM BİLGİLERİ MOBIL ===================== !-->
            <?php }?>


        </div>



    </div>

    <!-- MOBILE HEADER END  ===================== !-->
</header>


<?php if($fx['durum'] == '1' ) {?>
    <!-- Fixed header !-->
    <?php include 'headertype/fixed_header.php'; ?>
    <!-- Fixed header SON !-->
<?php }?>