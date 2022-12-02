<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<style>
    .top-level-menu > li
    {
        margin-right:20px !important;
    }
    .header-main{width: <?php if($head['header_width']==1){?> 90%; <?php }else {?> 100% <?php }?>;}
    .header-2-main-in{width: 1333px; margin: 0px auto; display: flex;padding: 30px 0; align-items: center }
    .header-2-logo{ width: 300px; height: auto; }
    .header-2-logo img{ max-width: 277px;}
    .header-2-search{margin-left:auto; width: 590px; position: relative; background-color: #FFF; border:2px solid #<?=$head['arama_button_color']?>; border-radius: 4px }
    .header-2-actions{<?php if($head['arama_button'] == 0){ ?>margin-left:auto; <?php }else {?>margin-left:30px; <?php } ?> display: flex; align-items: center}
    .header-2-action-div{ margin-right: 20px}
    .header-2-action-div:last-child{margin-right: 0}
    .header-2-search input{width: 90%; border:0;  height: 36px;   padding: 0 15px; outline: none; box-sizing: border-box; font-family: 'Open Sans', Arial; font-size:13px; }
    .header-2-search button{  border:0; background-color: #<?=$head['arama_button_color']?>; height: 38px; color:#<?=$head['arama_button_bg']?>; position: absolute; right: 0; top:-1px; font-size:13px; font-weight: 600; padding: 0 14px}
    .header-2-search button i{font-size:15px; }
    .header-2-search button:focus{outline: none}
    .header-2-menu-main-div{ margin: 0 auto; margin-bottom:<?=$head['header2_bottom_margin']?> ; border-top:1px solid #<?=$head['header2_menu_border']?>; background-color: #<?=$head['menu_bg']?>; width: <?php if($head['header_width']==1){?> 90%; <?php }else {?> 100% <?php }?>;}
    .header-2-menu-main-div-in{width: 1333px; height: <?=$head['header2_menu_height']?>; display: flex; margin: 0 auto; align-items: center; <?php if($head['menu_align'] == 1) { ?> justify-content: center <?php }?>}
    .btn-secondary:not(:disabled):not(.disabled).active:focus, .btn-secondary:not(:disabled):not(.disabled):active:focus, .show>.btn-secondary.dropdown-toggle:focus {box-shadow: 0 0 0 0.1rem rgba(0,0,0,0.1) !important;}
</style>
<div class="header-main" style="background-color: #<?=$head['header_menu_bg']?>; ">
        <div class="header-2-main-in">
            <div class="header-2-logo">
                <a href="index.html"><img src="images/logo/<?php echo $ayar['site_logo'] ?>" alt="<?php echo $ayar['site_baslik'] ?>"></a>
            </div>
            <?php if($head['arama_button'] == 1 ){ ?>
            <div class="header-2-search">
                <form action="urunara" method="get">
                    <input type="text" name="search" placeholder="<?php echo $diller['arama-area'] ?>" required>
                    <input type="hidden" name="hash" value="<?=md5(sha1($hashOlusturrandom));?><?=md5(sha1($hashOlusturrandom));?>">
                    <button><i class="fa fa-search"></i></button>
                </form>
            </div>
            <?php }?>

            <?php if ($odemeayar['sepet_sistemi'] == 1 || $head['dil_secim'] == 1 || $uyeayar['durum'] == '1') {?>
            <div class="header-2-actions">


                <?php if($uyeayar['durum'] == '1'  ) {?>
                    <!-- Üyelik !-->
                    <div class="header-2-action-div">
                        <!-- Cart items !-->
                        <div class="dropdown">
                            <a class="btn btn-<?=$head['header2_uyelik_bg']?> btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"  data-display="static" aria-haspopup="true" aria-expanded="false" style="display: flex; align-items: center; font-family: 'Open Sans', Arial; font-size:13px; padding: 8px;">
                                <i class="<?=$head['uyelik_icon']?>" style="font-size:18px; margin-right: 5px "></i>
                                <?php
                                if ($userSorgusu->rowCount() > 0) {?>
                                    <?=$diller['uyelik-header-ok']?>
                                <?php } else {?>
                                    <?=$diller['uyelik-header']?>
                                <?php }?>
                            </a>
                            <div class="dropdown-menu dropdown-box-type-cart-show dropdown-menu-lg-right" >
                                <div class="dropdown-arrow-before-cart"></div>
                                <!-- UYELIK YAZILARI !-->

                                <?php
                                if ($userSorgusu->rowCount() > 0) {?>

                                <div class="user-dropdown-top-main">
                                    <div class="user-dropdown-top-main-ic">

                                        <div class="shopping-cart-top-main-head font-open-sans font-13 font-medium" style="border-bottom:1px solid #EBEBEB;text-align: left; padding:4px 5px 8px 5px; box-sizing: border-box; margin-bottom: 5px;">
                                            <?=$userCek['isim']?> <?=$userCek['soyisim']?>
                                        </div>
                                        <ul class="user-topbar-ul">
                                            <a href="uyelik/hesap-bilgileri"><li><i class="ion-person"></i>  <?=$diller['uyepanel-hesap']?></li></a>
                                            <?php if($uyeayar['siparisler_alani'] == '1' ) {?>
                                                <a href="uyelik/siparisler"><li><i class="ion-bag"></i> <?=$diller['uyepanel-siparis']?></li></a>
                                            <?php }?>
                                            <?php if($uyeayar['adres_alani'] == '1' ) {?>
                                                <a href="uyelik/kayitli-adresler"><li><i class="ion-ios-location"></i> <?=$diller['uyepanel-adresler']?></li></a>
                                            <?php }?>
                                            <?php if($uyeayar['destek_alani'] == '1' ) {?>
                                                <a href="uyelik/destek"><li><i class="ion-help-buoy"></i> <?=$diller['uyepanel-destek']?></li></a>
                                            <?php }?>
                                            <?php if($uyeayar['yorumlar_alani'] == '1' ) {?>
                                                <a href="uyelik/yorumlar"><li><i class="ion-chatbubbles"></i> <?=$diller['uyelik-uye-yorumlari']?></li></a>
                                            <?php } //TODO Burası eklendi ?>
                                            <a href="uye-cikis"><li><i class="fa fa-sign-out"></i> <?=$diller['uyepanel-cikis']?></li></a>
                                        </ul>


                                        <?php } else {?>
                                        <div class="shopping-cart-top-main">
                                            <div class="shopping-cart-top-main-ic" style="text-align: left">

                                                <div style="width: 100%; height: auto; font-family: 'Open Sans', Arial; color:#666; font-size:13px; padding: 0 4px 15px 0; box-sizing: border-box; text-align: center;">
                                                    <i style="font-size:24px; margin-bottom: 10px;" class="<?=$head['uyelik_icon']?>"></i><br>
                                                    <span style="font-size:16px; font-weight: 700; color:#000; line-height: 40px"><?=$diller['uyelik-giris-yapilmamis']?></span>
                                                    <br>
                                                    <?=$diller['uyelik-kisa-aciklama']?>
                                                </div>

                                                <a href="uye-girisi" class="btn btn-sm btn-light" style="font-family: 'Open Sans', Arial; font-size:13px; color:#333; width: 100%">
                                                    <i class="ion-unlocked" style="margin-right: 6px"></i> <?=$diller['uyelik-giris-button']?></a>
                                                <br>

                                                <a href="uyelik" class="btn btn-sm btn-success" style="margin-top: 5px;font-family: 'Open Sans', Arial; font-size:13px;width: 100%; padding: 8px 0">
                                                    <i class="fa fa-plus-circle" style="margin-right: 6px; color:#FFF"></i> <?=$diller['uyelik-uye-ol-button']?></a>

                                                <?php }?>
                                            </div>
                                        </div>
                                        <!-- UYELIK YAZILARI SON !-->
                            </div>
                        </div>
                        <!-- Cart items !-->
                    </div>
                    <!-- Üyelik SON !-->
                <?php }?>



                <?php if ($odemeayar['sepet_sistemi'] == 1) {?>
                    <div class="header-2-action-div">
                        <!-- Cart items !-->
                        <div class="dropdown">
                            <a class="btn btn-<?=$head['header2_cart_bg']?> btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"  data-display="static" aria-haspopup="true" aria-expanded="false" style="display: flex; align-items: center; font-family: 'Open Sans', Arial; font-size:13px;">
                                <i class="<?=$odemeayar['cart_icon']?>" style="font-size:18px; margin-right: 5px "></i>
                                <?php echo $diller['sepetiniz'] ?>
                                <?php
                                if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"]) > 0){
                                    ?>
                                    <div style="margin-left: 5px">
                                    <span class="shopping-detail-header-2 font-open-sans font-13 font-medium" style="background-color: #<?=$odemeayar[cart_count_bg]?>; color:#<?=$odemeayar[cart_count_color]?>">
                                    <?php echo count($_SESSION["shopping_cart"]); ?>
                                    </span>
                                    </div>
                                    <?php
                                } else { ?>
                                    <div style="margin-left: 5px">
                                    <span class="shopping-detail-header-2 font-open-sans font-13 font-medium" style="background-color: #<?=$odemeayar[cart_count_bg]?>; color:#<?=$odemeayar[cart_count_color]?>">
                                    0
                                    </span>
                                    </div>

                                <?php } ?>
                            </a>
                            <div class="dropdown-menu dropdown-box-type-cart-show dropdown-menu-lg-right" >
                                <div class="dropdown-arrow-before-cart"></div>
                                <!-- KART ITEMLERI !-->
                                <div class="shopping-cart-top-main">
                                    <div class="shopping-cart-top-main-ic">
                                        <div class="shopping-cart-top-main-head font-raleway font-14 font-medium">
                                            <?php echo $diller['sepetiniz'] ?>
                                        </div>



                                        <?php
                                        if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"])>0) {
                                            ?>

                                            <?php
                                            $total = 0;
                                            foreach($_SESSION["shopping_cart"] as $urunsession){

                                                $urunsession_cek = $db ->prepare("select * from urun where id='$urunsession[item_id]' order by id desc limit 1");
                                                $urunsession_cek->execute();
                                                $urun_cek_row = $urunsession_cek->fetch(PDO::FETCH_ASSOC);

                                                ?>

                                                <div class="mega-menu-product-box">
                                                    <img src="images/product/<?=$urun_cek_row['gorsel']?>" >
                                                    <h1 class="font-13 font-small font-raleway"><?=$urun_cek_row['baslik']?></h1>

                                                    <h1 class="font-13 font-small font-raleway"><?=$urunsession['item_quantity']?> Adet</h1>
                                                    <?php
                                                    $fiyatt = $urunsession['item_quantity'] * $urun_cek_row['fiyat']
                                                    ?>
                                                    <h1 class="font-14 font-bold font-raleway"><strong><?php echo number_format($fiyatt, 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span></strong></h1>
                                                </div>

                                            <?php } ?>


                                            <a href="sepet">
                                                <div class="btn btn-primary font-open-sans font-14 font-medium" style="width: 100%;"><?php echo $diller['sepete-git'] ?></div>
                                            </a>

                                        <?php } else { ?>

                                            <div style="width: 100%; height: auto; font-family: 'Open Sans', Arial; font-size:13px;  background-color: #F8F8F8; padding: 4px 0 4px 0; text-align: center;">
                                                <?=$diller['sepet-bos-aciklamasi']?>
                                            </div>


                                        <?php }?>




                                    </div>
                                </div>
                                <!-- KART ITEMLERI !-->






                            </div>
                        </div>
                        <!-- Cart items !-->
                    </div>
                <?php }?>


                <?php if($head['dil_secim'] == 1 ){ ?>
                    <div class="header-2-action-div">
                        <!-- Language Select !-->
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #FFF; border:1px solid #<?=$head['dil_border']?>;  color:#333; padding: 7px 10px; ">
                                <?php
                                $flagsecim = $db->prepare("select * from dil where kisa_ad='$_SESSION[dil]'");
                                $flagsecim->execute();
                                $fl = $flagsecim->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div class="flag-icon-<?php echo $fl['flag'] ?>" style="width:18px; height:13px; display: inline-block; vertical-align: middle"></div>
                                <div style="display: inline-block; vertical-align: middle; margin-top: 0px; text-transform: uppercase; font-family: 'Open Sans', Arial; font-weight: 700; font-size:13px"><?php echo $_SESSION['dil'] ?></div>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="margin-top: 20px">
                                <div class="dropdown-arrow-before"></div>
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
                    </div>
                <?php }?>
            </div>
            <?php }?>

        </div>
</div>







<!-- Menu In !-->
    <div class="header-2-menu-main-div">
        <div class="header-2-menu-main-div-in">




            <ul class="top-level-menu">

                <?php foreach ($headermainmenu as $menu) { ?>

                    <li><a href="<?php if($menu['url'] ==!null) {?><?php echo $menu['url'] ?><?php } else {?>javascript:(void);<?php }?>"><span class="font-<?php echo $head['font_weight'] ?>" style="font-size:<?php echo $head['font_size']?>; text-transform: none; ">

                                <?php echo $menu['baslik'] ?>

                                <?php
                                $headeraltmenu=$db->prepare("select * from header_menu where ust_id='$menu[id]' and durum='1' and dil='$_SESSION[dil]' order by id desc limit 1");
                                $headeraltmenu->execute();
                                while ($alt = $headeraltmenu->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                <?php }?>


                                <?php
                                $megamenuarrow=$db->prepare("select * from header_menu where id='$menu[id]' and ust_id='0' and durum='1' and dil='$_SESSION[dil]' and mega_durum='1' order by id desc limit 1");
                                $megamenuarrow->execute();
                                while ($megas = $megamenuarrow->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                <?php }?>



                                        </span>
                        </a>
                        <?php
                        if($menu['mega_durum'] == 0) {
                            ?>


                            <?php
                            $headeraltmenu=$db->prepare("select * from header_menu where ust_id='$menu[id]' and durum='1' and dil='$_SESSION[dil]' order by id desc limit 1");
                            $headeraltmenu->execute();
                            while ($alt = $headeraltmenu->fetch(PDO::FETCH_ASSOC)){
                                ?>


                                <ul class="second-level-menu" >



                                    <?php
                                    $headeraltmenu=$db->prepare("select * from header_menu where ust_id='$menu[id]' and durum='1' and dil='$_SESSION[dil]' order by sira asc ");
                                    $headeraltmenu->execute();
                                    while ($alt = $headeraltmenu->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <li><a href="<?php if($alt['url'] ==!null) {?><?php echo $alt['url'] ?><?php } else {?>javascript:(void);<?php }?>"><p><?php echo $alt['baslik'] ?>


                                                    <?php
                                                    $headeraltmenu2=$db->prepare("select * from header_menu where ust_id='$alt[id]' and durum='1' and dil='$_SESSION[dil]'  order by id desc limit 1 ");
                                                    $headeraltmenu2->execute();
                                                    while ($alt2 = $headeraltmenu2->fetch(PDO::FETCH_ASSOC)){
                                                        ?>

                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>

                                                    <?php }?>


                                                </p></a>


                                            <?php
                                            $headeraltmenu2=$db->prepare("select * from header_menu where ust_id='$alt[id]' and durum='1' and dil='$_SESSION[dil]'  order by id desc limit 1 ");
                                            $headeraltmenu2->execute();
                                            while ($alt2 = $headeraltmenu2->fetch(PDO::FETCH_ASSOC)){
                                                ?>
                                                <ul class="third-level-menu">

                                                    <?php
                                                    $headeraltmenu2=$db->prepare("select * from header_menu where ust_id='$alt[id]' and durum='1' and dil='$_SESSION[dil]'  order by sira asc ");
                                                    $headeraltmenu2->execute();
                                                    while ($alt2 = $headeraltmenu2->fetch(PDO::FETCH_ASSOC)){
                                                        ?>
                                                        <li><a href="<?php if($alt2['url'] ==!null) {?><?php echo $alt2['url'] ?><?php } else {?>javascript:(void);<?php }?>"><p><?php echo $alt2['baslik'] ?></p></a></li>
                                                    <?php }?>


                                                </ul>
                                            <?php }?>

                                        </li>
                                    <?php }?>


                                </ul>
                            <?php }?>
                        <?php }?>



                        <?php
                        if($menu['mega_durum'] == 1) {
                            ?>
                            <ul class="mega-level-menu" >



                                <div class="mega-menu-firsat">
                                    <div class="mega-menu-firsat-text-area">
                                        <div class="mega-menu-text-table">

                                            <div class="mega-menu-text-table-ic">
                                                <h1><?php echo $diller['mega-menu-baslik'] ?></h1>
                                                <br>
                                                <h2><?php echo $diller['mega-menu-icerik'] ?></h2>
                                                <br>
                                                <a href="urunler">
                                                    <div  class="btn btn-primary font-open-sans font-14 font-medium"><?php echo $diller['mega-menu-button'] ?></div>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <img src="images/firsat/<?php echo $head['mega_gorsel'] ?>" >
                                </div><?php
                                $populerCekUrun=$db->prepare("select * from urun where dil='$_SESSION[dil]' and durum='1' order by hit desc limit 3");
                                $populerCekUrun->execute();

                                $prokategoriCek=$db->prepare("select * from urun_cat where dil='$_SESSION[dil]' and durum='1' and ust_id='0' order by sira asc limit 6");
                                $prokategoriCek->execute();
                                ?>

                                <?php
                                if($populerCekUrun->rowCount()>0)
                                {
                                    ?><div class="mega-menu-product">


                                    <div class="mega-menu-product-head font-open-sans font-14 font-bold">
                                        <?php echo $diller['populer-urunler'] ?>
                                    </div>

                                    <?php foreach ($populerCekUrun as $pops) {?>
                                    <div class="mega-menu-product-box">
                                        <a href="urun/<?=$pops['id']?>/<?=seo($pops['baslik'])?>">
                                            <img src="images/product/<?=$pops['gorsel']?>" >
                                        </a>
                                        <a href="urun/<?=$pops['id']?>/<?=seo($pops['baslik'])?>">
                                            <h1 class="font-13 font-small font-raleway"><?=$pops['baslik']?></h1>
                                            <h1 class="font-14 font-bold font-raleway">
                                                <?php if($pops['fiyat'] > '0') {?>
                                                    <?php echo number_format($pops['fiyat'], 2); ?> <?php echo $odemeayar['simge'] ?>
                                                <?php }?>
                                            </h1>
                                        </a>
                                    </div>
                                <?php }?>



                                    </div><?php }?><li class="mega-menu-product-cat">
                                    <div class="mega-menu-product-head font-open-sans font-14 font-bold">
                                        <?php echo $diller['kategoriler'] ?>
                                    </div>
                                    <?php foreach ($prokategoriCek as $kats) {?>
                                        <div class="mega-menu-product-cat-box font-open-sans font-13 font-small">
                                            <a href="urun-kategori/<?=$kats['id']?>/<?=seo($kats['baslik'])?>"><i class="fa <?=$kats['icon']?>" style="margin-right: 8px;"></i> <?=$kats['baslik']?></a>
                                        </div>
                                    <?php }?>
                                    <div class="mega-menu-product-cat-box-all font-open-sans font-13 font-bold">
                                        <a href="urunler"><i class="fa fa-angle-right"></i> <?php echo $diller['tum-kategoriler'] ?></a>
                                    </div>


                                </li>



                            </ul>

                        <?php }?>
                    </li>






                <?php }?>


            </ul>







        </div>
    </div>
<!-- Menu In !-->
