<?php echo !defined("GUVENLIK") ? die("vay be! Bu ne cesaret, Seni tanımak isterim Yiğidim?") : null;?>
<style>
    #fixed-header-main{
        position:fixed;
        display:none;
        width:100%;
        z-index:999;
        top: 0;
        background: #<?=$fx['arkaplan']?>;
        left: 0;
        padding: <?=$fx['padding']?>px 0;
        <?php if($fx['shadow'] == '1'  ) {?>
        box-shadow: 0 0 10px 0 rgba(0,0,0,0.1);
        <?php }?>
    }
</style>
<div id="fixed-header-main">
    <div class="fixed-header-in">

        <div class="fixed-header-logo">
            <a href="index.html"><img src="images/logo/<?php echo $ayar['site_logo'] ?>" alt="<?php echo $ayar['site_baslik'] ?>"></a>
        </div>
        <div class="fixed-header-text">

            <div class="fixed-header-menu-area">
               <!-- MENULERRRRRRRRR ====================================================================================================== !-->
                <?php
                $fixmenuone=$db->prepare("SELECT * from header_menu where ust_id='0' and durum='1' and dil='$_SESSION[dil]' order by sira asc limit $headerlimit");
                $fixmenuone->execute();
                ?>
                <ul class="top-level-menu">
                    <?php foreach ($fixmenuone as $menu) { ?>
                        <li><a href="<?php if($menu['url'] ==!null) {?><?php echo $menu['url'] ?><?php } else {?>javascript:(void);<?php }?>"><span class="font-<?php echo $head['font_weight'] ?>" style="font-size:<?php echo $head['font_size']?>"><?php echo $menu['baslik'] ?>
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
                                                    <?php if($pops['fiyat'] ==!null) {?>
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
               <!-- MENULERRRRRRRRR ====================================================================================================== SON !-->
            </div>

            <div class="fixed-header-icons-area">

                <?php if($uyeayar['durum'] == '1') { ?>
                <div class="fixed-header-icons-area-box">
                    <div class="dropdown" style="margin-top: 2px;">
                        <a class="dropdown-box-type-cart" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"  data-display="static" aria-haspopup="true" aria-expanded="false" style="text-decoration: none; display: flex">
                            <i class="<?=$head['uyelik_icon']?>" style="font-size:17px; margin-right: 5px;  color:#<?=$head['uyelik_icon_color']?>;"></i>
                            <span style="font-size:12px; color:#<?=$head['uyelik_icon_color']?>">
                                        <?php
                                        if ($userSorgusu->rowCount() > 0) {?>
                                            <?=$diller['uyelik-header-ok']?>
                                        <?php } else {?>
                                            <?=$diller['uyelik-header']?>
                                        <?php }?>
                                    </span>
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
                                        <?php }  //TODO Buras覺 eklendi?>
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
                </div>
                <?php } ?>

                <?php if ($head['arama_button'] == 1) {?>
                <div class="fixed-header-icons-area-box">
                    <!-- Product Search Area !-->
                    <div class="dropdown">
                        <a class="dropdown-box-type-cart" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"  data-display="static" aria-haspopup="true" aria-expanded="false" style="text-decoration: none;">
                            <i class="fa fa-search" style="color:#<?=$head['arama_button_bg']?>"></i>
                        </a>
                        <div class="dropdown-menu dropdown-box-type-search-show dropdown-menu-lg-right" >
                            <div class="dropdown-arrow-before-search"></div>
                            <!-- Form Alan覺 !-->
                            <form action="urunara" method="get">
                                <input type="text" name="search" placeholder="<?php echo $diller['arama-area'] ?>" required>
                                <input type="hidden" name="hash" value="<?=md5(sha1($hashOlusturrandom));?><?=md5(sha1($hashOlusturrandom));?>">
                                <button></button>
                            </form>
                            <!-- Form Alan覺 !-->
                        </div>
                    </div>
                    <!-- Product Search Area Ending !-->
                </div>
                <?php } ?>

                <?php if ($odemeayar['sepet_sistemi'] == 1) {?>
                    <div class="fixed-header-icons-area-box">
                        <!-- Shopping Cart !-->
                        <div class="dropdown" style="margin-top: 2px;">
                            <a class="dropdown-box-type-cart" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"  data-display="static" aria-haspopup="true" aria-expanded="false" style="text-decoration: none;">
                                <i class="<?=$odemeayar['cart_icon']?>" style="font-size:22px;  color:#<?=$odemeayar['cart_color']?>;"></i><?php
                                if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"]) > 0){
                                    ?><span class="shopping-detail font-open-sans font-13 font-medium" style="background-color: #<?=$odemeayar['cart_count_bg']?>; color:#<?=$odemeayar['cart_count_color']?>">
                                    <?php echo count($_SESSION["shopping_cart"]); ?>
                                    </span>
                                    <?php } else {} ?>
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
                                        if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"])>0) { ?>
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
                                                    <h1 class="font-14 font-bold font-raleway"><strong><?php echo number_format($urun_cek_row['fiyat'], 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span></strong></h1>
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
                        <!-- Shopping Cart !-->
                    </div>
                <?php } ?>

                <?php if ($head['dil_secim'] == 1) {?>
                <div class="fixed-header-icons-area-box">
                    <!-- Language Select !-->
                    <div class="dropdown">
                        <a class="dropdown-toggle dropdown-text-type-2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform: uppercase; border:1px solid #<?=$head['dil_border']?>; background-color: #FFF">
                            <?php
                            $flagsecim = $db->prepare("select * from dil where kisa_ad='$_SESSION[dil]'");
                            $flagsecim->execute();
                            $fl = $flagsecim->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <div class="flag-icon-<?php echo $fl['flag'] ?>" style="width:18px; height:13px; display: inline-block; vertical-align: middle"></div>
                            <div style="display: inline-block; vertical-align: middle; margin-top: 0px;"><?php echo $_SESSION['dil'] ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-box-type-1" aria-labelledby="dropdownMenuButton" >
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
                <?php } ?>

            </div>

        </div>

    </div>
</div>

