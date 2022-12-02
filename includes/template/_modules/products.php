<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?><?php
$productsayar = $db->prepare("select * from urunmodul_ayar where id='1'");
$productsayar->execute();
$prodayar = $productsayar->fetch(PDO::FETCH_ASSOC);
$tablimit = $prodayar["tab_limit"];
$gruplimit = $prodayar["urun_grup_limit"];
$urunlimit = $prodayar["tab_urun_limit"];
?>
<?php
$productcat = $db->prepare("select * from urun_cat where dil='$_SESSION[dil]' and anasayfa='1' and ust_id='0' and durum='1' order by sira asc limit $tablimit");
$productcat ->execute();

$productcat2 = $db->prepare("select * from urun_cat where dil='$_SESSION[dil]' and anasayfa='1' and ust_id='0' and durum='1' order by sira asc limit $tablimit");
$productcat2 ->execute();
?>
<?php
$product_list_new = $db->prepare("select * from urun where durum='1' and dil='$_SESSION[dil]' order by id desc limit $urunlimit");
$product_list_new ->execute();

$product_list_populer = $db->prepare("select * from urun where durum='1' and dil='$_SESSION[dil]' order by hit desc limit $urunlimit");
$product_list_populer ->execute();
?>
<style>
    .products-home-main-div{width:<?php if($prodayar['width']==1){?> 90%; <?php }else {?> 100% <?php }?> ; height: auto; overflow: hidden; background-color: #<?php echo $prodayar['back_color'] ?>; padding: <?php echo $prodayar['padding'] ?>px 0 <?php echo $prodayar['padding'] ?>px 0; }

    .product-main-box-img .buttons .text{background-color: #<?php echo $prodayar['incele_button_back'] ?>; }


    .product_tabs {  width: 100%; height: auto; margin: 0 auto; text-align: center; overflow: hidden; padding: 0; padding: 5px 0 35px 0; }
    .product_tabs li { display: inline-block;  height: auto;  }
    .product_tabs li a {
        outline: none; font-size: <?php echo $prodayar['tab_font_size'] ?>; font-family: 'Open Sans', Arial; font-weight: 500;
        padding: 5px 15px 5px 15px;
        text-decoration: none;
        border:1px solid #<?php echo $prodayar['back_color'] ?>;
        border-radius:<?php echo $prodayar['tab_border_radius'] ?>px ;
        background: #<?php echo $prodayar['back_color'] ?>;
        color: #<?php echo $prodayar['tab_text_color'] ?>;
    }
    .product_tabs li .active { position: relative;  }
    .product_tabs li a.active { font-weight: bold;  border:1px solid #<?php echo $prodayar['tab_border_color'] ?>;  background: #<?php echo $prodayar['tab_back_color'] ?>; color: #<?php echo $prodayar['tab_act_text_color'] ?>;}

    .product_tabs_content{width: 100%; margin: 0 auto; display: none}


</style>

<div class="products-home-main-div">

    <div class="modules-header-main-product-group">
        <div class="modules-header-main-head" style="background:url(images/<?php echo $prodayar['divider'] ?>.png) no-repeat center bottom;">
            <div class="modules-header-main-baslik font-open-sans font-<?php echo $prodayar['font_weight'] ?> font-spacing" style="color:#<?php echo $prodayar['baslik_color'] ?>">
                <?php echo $diller['urunlerimiz']?>
            </div>
            <div class="modules-header-main-spot font-raleway font-light" style="color:#<?php echo $prodayar['spot_color'] ?>; letter-spacing: 0.07em; ">
                <?php echo $diller['urunlerimiz-aciklamasi']?>
            </div>
        </div>
    </div>


    <div class="products-home-main-div-inside">

        <div id="tab-container" >


            <ul class='product_tabs'>
                <?php
                if($prodayar['yeni'] == 1) {
                ?>
                <li><a href="#yeni"><?php echo $diller['yeni'] ?></a></li>
                <?php }?>

                <?php
                if($prodayar['populer'] == 1) {
                    ?>
                    <!-- Popüler Aktif -->
                    <li><a href="#populer"><?php echo $diller['populer'] ?></a></li>
                    <!-- Popüler Aktif -->
                <?php } ?>



                <?php foreach ($productcat as $procats) {   ?>
                    <!-- Ürün Kategori Tabs !-->
                    <li><a href="#<?php echo $procats['id'] ?>"><?php echo $procats['baslik'] ?></a></li>
                    <!-- Ürün Kategori Tabs !-->
                <?php     }?>

            </ul>



            <?php
            if($prodayar['yeni'] == 1) {
            ?>

                <?php if($product_list_new->rowCount() > 0) { ?>
                <!-- Yeni Ürünler Aktif -->
            <div id="yeni" class="product_tabs_content" >

                <?php foreach ($product_list_new as $pronew) {

                $pro_list_cat = $db->prepare("select * from urun_cat where id='$pronew[kat_id]' and durum='1' and dil='$_SESSION[dil]' order by id desc limit 1 ");
                $pro_list_cat->execute();
                $pro_cat = $pro_list_cat->fetch(PDO::FETCH_ASSOC);

                    $starDec = $db->prepare("SELECT SUM(yildiz) AS orta FROM urun_yorum where onay=:onay and urun_id=:urun_id; ");
                    $starDec->execute(array(
                        'onay' => '1',
                        'urun_id' => $pronew['id']
                    ));
                    $yildiz = $starDec->fetch(PDO::FETCH_ASSOC);

                    $yorumsayisi = $db->prepare("select * from urun_yorum where onay=:onay and urun_id=:urun_id ");
                    $yorumsayisi->execute(array(
                        'onay' => '1',
                        'urun_id' => $pronew['id']
                    ));
                    $yorumcount = $yorumsayisi->rowCount();

                    if($yorumcount == null  ) {
                        $yildizhesap = '0';
                    } else {
                        $yildizhesap = $yildiz['orta'] / $yorumcount;
                    }
                    $finalstarrate_hit = (int)$yildizhesap;

                ?>

                <?php
                if($pronew['stok'] > 0) {
                ?>

                <div class="product-main-box">
                    <div class="product-main-box-in">
                        <div class="product-main-box-img">

                            <img src="images/product/<?php echo $pronew['gorsel'] ?>" alt="<?php echo $pronew['baslik'] ?>">
                            <a href="urun/<?php echo $pronew['id'] ?>/<?php echo seo($pronew['baslik']) ?>"><div class="ovrly"></div></a>
                            <div class="buttons">
                                <a href="urun/<?php echo $pronew['id'] ?>/<?php echo seo($pronew['baslik']) ?>" class="text" style="color:#<?php echo $prodayar['incele_button_color']?>;"><i class="fa fa-search" style="color:#<?php echo $prodayar['incele_button_color']?>"></i> <?php echo $diller['incele'] ?></a>
                            </div>

                        </div>
                        <div class="product-main-box-baslik">
                            <div class="product-main-box-baslik-in">
                                <a href="urun/<?php echo $pronew['id'] ?>/<?php echo seo($pronew['baslik']) ?>"><?php echo $pronew['baslik'] ?></a>
                            </div>
                        </div>
                        <div class="product-main-box-category">
                            <?php echo $pro_cat['baslik'] ?>
                        </div>
                        <?php if($prodayar['star_rate'] == 1) {?>




                        <div class="product-main-box-rate">
                        <?php if($uyeayar['durum'] == '0' ) {?>
                            <?php if($pronew['star_rate'] == 0){ ?>
                                <span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($pronew['star_rate'] == 1){ ?>
                                <span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($pronew['star_rate'] == 2){ ?>
                                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($pronew['star_rate'] == 3){ ?>
                                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($pronew['star_rate'] == 4){ ?>
                                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span>
                            <?php }?>
                            <?php if($pronew['star_rate'] == 5){ ?>
                                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span>
                            <?php }?>
                        <?php }?>



                            <!-- ÜYELİK VARSA VE ÜRÜNE YORUMLAR KAPALIYSA YILDIZ SAYISINI GÖSTER !-->
                            <?php if($uyeayar['durum'] == '1' ) {?>
                                <?php if($pronew['yorum_durum'] == '0' ) {?>
                                    <?php if($pronew['star_rate'] == 0){ ?>
                                        <span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                    <?php }?>
                                    <?php if($pronew['star_rate'] == 1){ ?>
                                        <span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                    <?php }?>
                                    <?php if($pronew['star_rate'] == 2){ ?>
                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                    <?php }?>
                                    <?php if($pronew['star_rate'] == 3){ ?>
                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                    <?php }?>
                                    <?php if($pronew['star_rate'] == 4){ ?>
                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span>
                                    <?php }?>
                                    <?php if($pronew['star_rate'] == 5){ ?>
                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span>
                                    <?php }?>
                                <?php } ?>
                            <?php } ?>
                            <!-- ÜYELİK VARSA VE ÜRÜNE YORUMLAR KAPALIYSA YILDIZ SAYISINI GÖSTER SON !-->



                            <!-- ÜYELİK VARSA VE ÜRÜNE YORUM YAPILABİLİR İSE OYLAMA ORTALAMASINI GÖSTER !-->
                            <?php if($pronew['yorum_durum'] == '1' ) {?>
                                <?php if($uyeayar['durum'] == '1' ) {?>

                                    <?php if($finalstarrate_hit == 0){ ?>
                                        <span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                    <?php }?>
                                    <?php if($finalstarrate_hit == 1){ ?>
                                        <span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                    <?php }?>
                                    <?php if($finalstarrate_hit == 2){ ?>
                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                    <?php }?>
                                    <?php if($finalstarrate_hit == 3){ ?>
                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                    <?php }?>
                                    <?php if($finalstarrate_hit == 4){ ?>
                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span>
                                    <?php }?>
                                    <?php if($finalstarrate_hit == 5){ ?>
                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span>
                                    <?php }?>
                                <?php } ?>
                            <?php } ?>
                            <!-- ÜYELİK VARSA VE ÜRÜNE YORUM YAPILABİLİR İSE OYLAMA ORTALAMASINI GÖSTER !-->


                        </div>




                    <?php }?>
                        <div class="product-main-box-price">


                            <?php
                            if($pronew['eski_fiyat']=='0')
                            {
                            } else { ?>

                                <span style="font-size:15px; font-weight: 400; font-family: 'Open Sans', Arial; color:#999; display: inline-block; text-decoration: line-through;"><?php echo number_format($pronew['eski_fiyat'], 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span></span>

                            <?php }?>


                            <?php
                            if($pronew['fiyat']== null || $pronew['fiyat']== '0')
                            {
                            } else { ?>

                                <h1><?php echo number_format($pronew['fiyat'], 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span></h1>

                            <?php }?>
                        </div>
                    </div>
                </div>

                <?php }?>
                <?php } ?>

            </div>
                <!-- Yeni Ürünler Aktif -->
                    <?php } else { ?>

            <div id="yeni" class="product_tabs_content font-15 font-open-sans font-bold" style="background: #EBEBEB; padding: 20px 0 20px 0" >
                YENİ BİR ÜRÜN BULUNAMADI <br>
                <span class="font-14 font-small font-open-sans">Yeni bir ürün ekleyiniz</span>
            </div>

                    <?php }?>
            <?php }?>




            <?php
            if($prodayar['populer'] == 1) {
                ?>

            <?php if($product_list_populer->rowCount() > 0) { ?>
                <!-- Popüler Aktif -->
                <div id="populer" class="product_tabs_content" >


                    <?php foreach ($product_list_populer as $prohit) {

                        $pro_list_cat = $db->prepare("select * from urun_cat where id='$prohit[kat_id]' and durum='1' and dil='$_SESSION[dil]' order by id desc limit 1 ");
                        $pro_list_cat->execute();
                        $pro_cat = $pro_list_cat->fetch(PDO::FETCH_ASSOC);

                        $starDec = $db->prepare("SELECT SUM(yildiz) AS orta FROM urun_yorum where onay=:onay and urun_id=:urun_id; ");
                        $starDec->execute(array(
                            'onay' => '1',
                            'urun_id' => $prohit['id']
                        ));
                        $yildiz = $starDec->fetch(PDO::FETCH_ASSOC);

                        $yorumsayisi = $db->prepare("select * from urun_yorum where onay=:onay and urun_id=:urun_id ");
                        $yorumsayisi->execute(array(
                            'onay' => '1',
                            'urun_id' => $prohit['id']
                        ));
                        $yorumcount = $yorumsayisi->rowCount();

                        if($yorumcount == null  ) {
                            $yildizhesap = '0';
                        } else {
                            $yildizhesap = $yildiz['orta'] / $yorumcount;
                        }
                        $finalstarrate_pop = (int)$yildizhesap;
                        ?>

                        <?php
                        if($prohit['stok'] > 0) {
                            ?>
                            <div class="product-main-box">
                                <div class="product-main-box-in">
                                    <div class="product-main-box-img">

                                        <img src="images/product/<?php echo $prohit['gorsel'] ?>" alt="<?php echo $prohit['baslik'] ?>">
                                        <a href="urun/<?php echo $prohit['id'] ?>/<?php echo seo($prohit['baslik']) ?>"><div class="ovrly"></div></a>
                                        <div class="buttons">
                                            <a href="urun/<?php echo $prohit['id'] ?>/<?php echo seo($prohit['baslik']) ?>" class="text" style="color:#<?php echo $prodayar['incele_button_color']?>;"><i class="fa fa-search" style="color:#<?php echo $prodayar['incele_button_color']?>"></i> <?php echo $diller['incele'] ?></a>
                                        </div>

                                    </div>
                                    <div class="product-main-box-baslik">
                                        <div class="product-main-box-baslik-in">
                                            <a href="urun/<?php echo $prohit['id'] ?>/<?php echo seo($prohit['baslik']) ?>"><?php echo $prohit['baslik'] ?></a>
                                        </div>
                                    </div>
                                    <div class="product-main-box-category">
                                        <?php echo $pro_cat['baslik'] ?>
                                    </div>
                                    <?php if($prodayar['star_rate'] == 1) {?>
                                        <div class="product-main-box-rate">
                                            <?php if($uyeayar['durum'] == '0' ) {?>
                                                <?php if($prohit['star_rate'] == 0){ ?>
                                                    <span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                                <?php }?>
                                                <?php if($prohit['star_rate'] == 1){ ?>
                                                    <span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                                <?php }?>
                                                <?php if($prohit['star_rate'] == 2){ ?>
                                                    <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                                <?php }?>
                                                <?php if($prohit['star_rate'] == 3){ ?>
                                                    <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                                <?php }?>
                                                <?php if($prohit['star_rate'] == 4){ ?>
                                                    <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span>
                                                <?php }?>
                                                <?php if($prohit['star_rate'] == 5){ ?>
                                                    <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span>
                                                <?php }?>
                                            <?php }?>



                                            <!-- ÜYELİK VARSA VE ÜRÜNE YORUMLAR KAPALIYSA YILDIZ SAYISINI GÖSTER !-->
                                            <?php if($uyeayar['durum'] == '1' ) {?>
                                                <?php if($prohit['yorum_durum'] == '0' ) {?>
                                                    <?php if($prohit['star_rate'] == 0){ ?>
                                                        <span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                                    <?php }?>
                                                    <?php if($prohit['star_rate'] == 1){ ?>
                                                        <span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                                    <?php }?>
                                                    <?php if($prohit['star_rate'] == 2){ ?>
                                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                                    <?php }?>
                                                    <?php if($prohit['star_rate'] == 3){ ?>
                                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                                    <?php }?>
                                                    <?php if($prohit['star_rate'] == 4){ ?>
                                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span>
                                                    <?php }?>
                                                    <?php if($prohit['star_rate'] == 5){ ?>
                                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span>
                                                    <?php }?>
                                                <?php } ?>
                                            <?php } ?>
                                            <!-- ÜYELİK VARSA VE ÜRÜNE YORUMLAR KAPALIYSA YILDIZ SAYISINI GÖSTER SON !-->



                                            <!-- ÜYELİK VARSA VE ÜRÜNE YORUM YAPILABİLİR İSE OYLAMA ORTALAMASINI GÖSTER !-->
                                            <?php if($prohit['yorum_durum'] == '1' ) {?>
                                                <?php if($uyeayar['durum'] == '1' ) {?>

                                                    <?php if($finalstarrate_pop == 0){ ?>
                                                        <span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                                    <?php }?>
                                                    <?php if($finalstarrate_pop == 1){ ?>
                                                        <span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                                    <?php }?>
                                                    <?php if($finalstarrate_pop == 2){ ?>
                                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                                    <?php }?>
                                                    <?php if($finalstarrate_pop == 3){ ?>
                                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                                    <?php }?>
                                                    <?php if($finalstarrate_pop == 4){ ?>
                                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span>
                                                    <?php }?>
                                                    <?php if($finalstarrate_pop == 5){ ?>
                                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span>
                                                    <?php }?>
                                                <?php } ?>
                                            <?php } ?>
                                            <!-- ÜYELİK VARSA VE ÜRÜNE YORUM YAPILABİLİR İSE OYLAMA ORTALAMASINI GÖSTER !-->


                                        </div>

                                    <?php }?>
                                    <div class="product-main-box-price">


                                        <?php
                                        if($prohit['eski_fiyat']=='0')
                                        {
                                        } else { ?>

                                            <span style="font-size:15px; font-weight: 400; font-family: 'Open Sans', Arial; color:#999; display: inline-block; text-decoration: line-through;"><?php echo number_format($prohit['eski_fiyat'], 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span></span>

                                        <?php }?>


                                        <?php
                                        if($prohit['fiyat']== null || $prohit['fiyat']== '0')
                                        {
                                        } else { ?>

                                            <h1><?php echo number_format($prohit['fiyat'], 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span></h1>

                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    <?php } ?>



                </div>
                <!-- Popüler Aktif -->
                <?php } else { ?>

                    <div id="populer" class="product_tabs_content font-15 font-open-sans font-bold" style="background: #EBEBEB; padding: 20px 0 20px 0" >
                        POPÜLER ÜRÜN BULUNAMADI <br>
                        <span class="font-14 font-small font-open-sans">Yeni bir ürün ekleyiniz</span>
                    </div>

                <?php }?>
            <?php } ?>




            <?php foreach ($productcat2 as $procats2) {
            $cat_ids = $procats2['id'];
            ?>
            <div id="<?php echo $procats2['id'] ?>"  class="product_tabs_content" >


                <?php
                $newcatlisturun = $db->prepare("SELECT * FROM urun WHERE durum='1' and dil='$_SESSION[dil]' and kat_id IN (
                                                          SELECT id FROM urun_cat  WHERE id = $cat_ids OR ust_id = $cat_ids) order by id desc limit $urunlimit");
                $newcatlisturun ->execute();
                while($urunrow = $newcatlisturun->fetch(PDO::FETCH_ASSOC)){

                    $kat_list_son = $db->prepare("select * from urun_cat where id='$urunrow[kat_id]' and durum='1' and dil='$_SESSION[dil]' order by id desc limit 1 ");
                    $kat_list_son->execute();
                    $row_kat = $kat_list_son->fetch(PDO::FETCH_ASSOC);

                    $starDec = $db->prepare("SELECT SUM(yildiz) AS orta FROM urun_yorum where onay=:onay and urun_id=:urun_id; ");
                    $starDec->execute(array(
                        'onay' => '1',
                        'urun_id' => $urunrow['id']
                    ));
                    $yildiz = $starDec->fetch(PDO::FETCH_ASSOC);

                    $yorumsayisi = $db->prepare("select * from urun_yorum where onay=:onay and urun_id=:urun_id ");
                    $yorumsayisi->execute(array(
                        'onay' => '1',
                        'urun_id' => $urunrow['id']
                    ));
                    $yorumcount = $yorumsayisi->rowCount();

                    if($yorumcount == null  ) {
                        $yildizhesap = '0';
                    } else {
                        $yildizhesap = $yildiz['orta'] / $yorumcount;
                    }
                    $finalstarrate_kat = (int)$yildizhesap;
                    ?>

<?php
//TODO Burada Var
?>


                    <?php
                    if($urunrow['stok'] > 0) {
                        ?>
                        <div class="product-main-box">
                            <div class="product-main-box-in">
                                <div class="product-main-box-img">

                                    <img src="images/product/<?php echo $urunrow['gorsel'] ?>" alt="<?php echo $urunrow['baslik'] ?>">
                                    <a href="urun/<?php echo $urunrow['id'] ?>/<?php echo seo($urunrow['baslik']) ?>"><div class="ovrly"></div></a>
                                    <div class="buttons">
                                        <a href="urun/<?php echo $urunrow['id'] ?>/<?php echo seo($urunrow['baslik']) ?>" class="text" style="color:#<?php echo $prodayar['incele_button_color']?>;"><i class="fa fa-search" style="color:#<?php echo $prodayar['incele_button_color']?>"></i> <?php echo $diller['incele'] ?></a>
                                    </div>

                                </div>
                                <div class="product-main-box-baslik">
                                    <div class="product-main-box-baslik-in">
                                        <a href="urun/<?php echo $urunrow['id'] ?>/<?php echo seo($urunrow['baslik']) ?>"><?php echo $urunrow['baslik'] ?></a>
                                    </div>
                                </div>
                                <div class="product-main-box-category">
                                    <?php echo $row_kat['baslik'] ?>
                                </div>
                        <?php if($prodayar['star_rate'] == 1) {?>
                            <div class="product-main-box-rate">
                                <?php if($uyeayar['durum'] == '0' ) {?>
                                    <?php if($urunrow['star_rate'] == 0){ ?>
                                        <span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                    <?php }?>
                                    <?php if($urunrow['star_rate'] == 1){ ?>
                                        <span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                    <?php }?>
                                    <?php if($urunrow['star_rate'] == 2){ ?>
                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                    <?php }?>
                                    <?php if($urunrow['star_rate'] == 3){ ?>
                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                    <?php }?>
                                    <?php if($urunrow['star_rate'] == 4){ ?>
                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span>
                                    <?php }?>
                                    <?php if($urunrow['star_rate'] == 5){ ?>
                                        <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span>
                                    <?php }?>
                                <?php }?>



                                <!-- ÜYELİK VARSA VE ÜRÜNE YORUMLAR KAPALIYSA YILDIZ SAYISINI GÖSTER !-->
                                <?php if($uyeayar['durum'] == '1' ) {?>
                                    <?php if($urunrow['yorum_durum'] == '0' ) {?>
                                        <?php if($urunrow['star_rate'] == 0){ ?>
                                            <span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                        <?php }?>
                                        <?php if($urunrow['star_rate'] == 1){ ?>
                                            <span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                        <?php }?>
                                        <?php if($urunrow['star_rate'] == 2){ ?>
                                            <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                        <?php }?>
                                        <?php if($urunrow['star_rate'] == 3){ ?>
                                            <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                        <?php }?>
                                        <?php if($urunrow['star_rate'] == 4){ ?>
                                            <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span>
                                        <?php }?>
                                        <?php if($urunrow['star_rate'] == 5){ ?>
                                            <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span>
                                        <?php }?>
                                    <?php } ?>
                                <?php } ?>
                                <!-- ÜYELİK VARSA VE ÜRÜNE YORUMLAR KAPALIYSA YILDIZ SAYISINI GÖSTER SON !-->



                                <!-- ÜYELİK VARSA VE ÜRÜNE YORUM YAPILABİLİR İSE OYLAMA ORTALAMASINI GÖSTER !-->
                                <?php if($urunrow['yorum_durum'] == '1' ) {?>
                                    <?php if($uyeayar['durum'] == '1' ) {?>

                                        <?php if($finalstarrate_kat == 0){ ?>
                                            <span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                        <?php }?>
                                        <?php if($finalstarrate_kat == 1){ ?>
                                            <span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                        <?php }?>
                                        <?php if($finalstarrate_kat == 2){ ?>
                                            <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                        <?php }?>
                                        <?php if($finalstarrate_kat == 3){ ?>
                                            <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                                        <?php }?>
                                        <?php if($finalstarrate_kat == 4){ ?>
                                            <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span>
                                        <?php }?>
                                        <?php if($finalstarrate_kat == 5){ ?>
                                            <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span>
                                        <?php }?>
                                    <?php } ?>
                                <?php } ?>
                                <!-- ÜYELİK VARSA VE ÜRÜNE YORUM YAPILABİLİR İSE OYLAMA ORTALAMASINI GÖSTER !-->


                            </div>

                        <?php }?>
                                <div class="product-main-box-price">


                                    <?php
                                    if($urunrow['eski_fiyat']=='0')
                                    {
                                    } else { ?>

                                        <span style="font-size:15px; font-weight: 400; font-family: 'Open Sans', Arial; color:#999; display: inline-block; text-decoration: line-through;"><?php echo number_format($urunrow['eski_fiyat'], 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span></span>

                                    <?php }?>


                                    <?php
                                    if($urunrow['fiyat']== null || $urunrow['fiyat']== '0')
                                    {
                                    } else { ?>

                                        <h1><?php echo number_format($urunrow['fiyat'], 2); ?> <span class="font-exlight"><?php echo $odemeayar['simge'] ?></span></h1>

                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    <?php }?>



                <?php }?>


                <?php
                $taburunsayisi = $db->prepare("SELECT * FROM urun WHERE durum='1' and dil='$_SESSION[dil]' and kat_id IN (
                                                          SELECT id FROM urun_cat  WHERE id = $cat_ids OR ust_id = $cat_ids) order by id desc limit $urunlimit");
                $taburunsayisi ->execute();

                ?>
                <?php if($taburunsayisi->rowCount() <= 0)  { ?>
                    <div  class="font-15 font-open-sans font-bold" style="background: #EBEBEB; padding: 20px 0 20px 0" >
                        BU TAB'A AİT ÜRÜN BULUNAMADI <br>
                        <span class="font-14 font-small font-open-sans">Yeni bir ürün ekleyiniz veya bu kategoriye ürün seçiniz</span>
                    </div>
                <?php }?>


            </div>
            <?php }?>




        </div>


    </div>




        <!-- TİCARET BİLGİLENDİRME ALANI ========================== !-->
    <?php
    $commerceinfo = $db->prepare("select * from ticaret_bilgi where dil='$_SESSION[dil]' order by sira asc limit 4");
    $commerceinfo->execute();
    ?>
    <?php
    if($ayar['ticaret_text_home'] == 1)
    {
        ?>
            <?php if($commerceinfo->rowCount() > 0) { ?>
        <style>
            .ticaret-bilgilendirme-box{border-color:#<?php echo $ayar['ticaret_text_border'] ?>}
        </style>
        <div class="ticaret-bilgilendirme-main-div" style="border:1px solid #<?php echo $ayar['ticaret_text_border'] ?>; background-color: #<?php echo $ayar['ticaret_text_back'] ?> <?php if($prodayar['urun_grup'] == 0){ ?>; margin-bottom:0; <?php }?>">

            <?php foreach ($commerceinfo as $tic){ ?>
                <div class="ticaret-bilgilendirme-box"style="border-right: 1px solid #<?php echo $ayar['ticaret_text_border'] ?>">
                    <div class="ticaret-bilgilendirme-box-i" style="color:#<?php echo $ayar['ticaret_text_icon']?>">
                        <i class="fa <?php echo $tic['icon']?>"></i>
                    </div>
                    <div class="ticaret-bilgilendirme-box-text font-open-sans font-14 font-light" style="color:#<?php echo $ayar['ticaret_text_color']?>" >
                        <?php echo $tic['baslik']?>
                    </div>
                </div>
            <?php }?>

        </div>
            <?php } else {?>

    <div class="ticaret-bilgilendirme-main-div" style="border:1px solid #000; background-color: #333">
        <div class="ticaret-bilgilendirme-box" style="color:#FFF;">

                <span class="font-16 font-bold font-open-sans">HENÜZ TİCARET BİLGİ KUTULARI EKLENMEMİŞ</span>
            <br>
                <span class="font-14 font-small font-open-sans">Lütfen yeni ticaret bilgi kutuları ekleyerek ziyaretçilerinizi bilgilendirme şansını yakalayın</span>
        </div>
    </div>

            <?php }?>
    <?php }?>

        <!-- TİCARET BİLGİLENDİRME ALANI ========================== !-->






    <!-- ÜRÜN GRUPLARI !-->
    <?php
    if($prodayar['urun_grup'] == 1)
    {
        ?>







        <?php
        if($ayar['ticaret_text_home'] == 0)
        {
            ?>

            <div style="margin-bottom: 50px; width: 100px;  overflow: hidden;"></div>

        <?php }?>





        <div class="products-home-main-div-inside">


            <div class="modules-header-main-product-group">
                <div class="modules-header-main-head" style="background:url(images/<?php echo $prodayar['divider'] ?>.png) no-repeat center bottom;">
                    <div class="modules-header-main-baslik font-open-sans font-<?php echo $prodayar['font_weight'] ?> font-spacing" style="color:#<?php echo $prodayar['baslik_color'] ?>">
                        <?php echo $diller['urun-gruplari']?>
                    </div>
                </div>
            </div>

            <div class="product-group-main">


                <?php $sql_urungrup = $db->prepare("select * from urun_cat where durum='1' and dil='$_SESSION[dil]' and anasayfa_grup='1' order by grup_sira asc limit $gruplimit");
                $sql_urungrup->execute();
                while($gruprow=$sql_urungrup->fetch(PDO::FETCH_ASSOC))
                {
                    ?><div class="product-group-box" style="border:1px solid #<?php echo $prodayar['urun_grup_border'] ?>">
                    <a href="urun-kategori/<?php echo $gruprow['id']?>/<?php echo seo($gruprow['baslik']) ?>">
                        <div class="product-group-box-text">
                            <div class="product-group-box-text-head font-open-sans font-16 font-bold " style="color:#<?php echo $prodayar['urun_grup_textcolor'] ?>; background-color: #<?php echo $prodayar['urun_grup_back'] ?>">
                                <?php echo $gruprow['baslik'] ?>
                            </div>
                            <div class="product-group-box-clear"></div>
                            <div class="product-group-box-text-browse font-open-sans font-13 font-exlight" style="color:#<?php echo $prodayar['urun_grup_incelecolor'] ?>; background-color: #<?php echo $prodayar['urun_grup_incele_back'] ?>;">

                                <?php echo $diller['urunlere-git'] ?> <i class="fa fa-angle-right" style="margin-left:10px"></i>
                            </div>
                        </div>
                        <img src="images/product-category/<?php echo $gruprow['gorsel']?>" alt="<?php echo $gruprow['baslik']?>">
                    </a>
                    </div><?php }?>

                <?php
                if($sql_urungrup->rowCount() <= 0) { ?>

                    <div class="product-group-box" style="border:1px solid #333; background: #EBEBEB;">

                        <div class="product-group-box-text-head font-open-sans font-16 font-bold " style="color:#FFF; background-color: #000">
                            ÜRÜN GRUBU EKLENMEMİŞ YADA ANASAYFA SEÇİLİ DEĞİL!
                        </div>
                        <i class="fa fa-exclamation-circle" style="font-size:35px; margin-top: 10px;"></i>


                    </div>
                <?php } ?>

            </div>


        </div>

    <?php } ?>
    <!-- ÜRÜN GRUPLARI !-->


</div>


