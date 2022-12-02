<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?><?php
$urun_modul_settings = $db->prepare("select * from urunmodul_ayar where id='1'");
$urun_modul_settings->execute();
$urunset = $urun_modul_settings->fetch(PDO::FETCH_ASSOC);

$urunkat_listele = $db->prepare("select * from urun_cat where dil='$_SESSION[dil]' and durum='1' and ust_id='0' order by sira asc");
$urunkat_listele->execute();

$urunkat_listeleMobile = $db->prepare("select * from urun_cat where dil='$_SESSION[dil]' and durum='1' and ust_id='0' order by sira asc");
$urunkat_listeleMobile->execute();

$urun_populer_list = $db->prepare("select * from urun where dil='$_SESSION[dil]' and durum='1' order by hit desc limit 5");
$urun_populer_list->execute();
?>
<?php $hashOlusturrandom = rand(0,(int) 9999999999999); //TODO BURADA VAR?>
<style>

    .products-leftmenu {
        width: 306px;
        font-family:'Open Sans', sans-serif;
        position: relative;
        background-color: #<?=$urunset['detay_altmenu_bg']?>;
        padding: 0;
    }
    .products-leftmenu a, .products-leftmenu a:link, .products-leftmenu a:visited, .products-leftmenu a:focus, span {
        color: #<?=$urunset['detay_altmenu_textcolor']?>;
        text-decoration: none;
    }

    .products-leftmenu > li {
        display: block;
        border-bottom: 1px solid #<?=$urunset['detay_altmenu_border']?>;
        font-weight: 400;
        font-size: 13px;
        height: 38px; overflow: hidden;

    }
    .products-leftmenu > li > a {
        display: block;
        padding: 9px 12px 18px 12px;
    }
    .products-leftmenu > li > a i{font-size:15px; margin-top: 2px }
    .products-leftmenu > li:hover > a {
        color: #<?=$urunset['detay_altmenu_hovertextcolor']?>;
    }

    .products-leftmenu > li:hover > a i {
        color: #<?=$urunset['detay_altmenu_hovertextcolor']?>;
    }



    .products-leftmenu > li:hover {
        background-color: #<?=$urunset['detay_altmenu_hover']?>;
    }
    /* Megadrop width dropdown */
    .products-leftmenu > li > .megadrop {
        opacity: 0;
        visibility: hidden;
        position: absolute;
        list-style: none;
        left: 306px;
        min-width: 255px;
        height: auto;
        text-align: left;
        margin-top:30px;
        padding: 0;
        z-index: 99;
        overflow: hidden;

        <?php if($urunset['detay_altmenu_megashadow'] == 1) { ?>
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        <?php } ?>

        border:1px solid #<?=$urunset['detay_altmenu_megaborder']?>;
        background: #FFF;


    }
    .products-leftmenu > li:hover .megadrop {
        opacity: 1;
        visibility: visible;
        margin-top: -47px;
    }
    .products-leftmenu ul li:hover:after {
        color: #227087;
    }

    .products-leftmenu > li > ul li ul, .products-leftmenu li >ul li, .products-leftmenu > li > .megadrop, .products-leftmenu > li > ul, .products-leftmenu > li {
        transition: all 0.2s ease-in-out;
        -moz-transition: all 0.2s ease-in-out;
        -webkit-transition: all 0.2s ease-in-out;
        -ms-transition: all 0.2s ease-in-out;
        -o-transition: all 0.2s ease-in-out;
    }
    .dropdown-subcat-box{width: 310px; height: 82px; overflow: hidden; margin: 20px; display: inline-block; vertical-align: top; }
    .dropdown-subcat-box-img{width:150px; height: 82px; overflow: hidden; display: inline-block; vertical-align: middle; margin-right: 14px;}
    .dropdown-subcat-box-img img{min-width:150px; max-width: 180px; min-height: 82px; transition: 0.2s ease-in-out 0s; }
    .dropdown-subcat-box:hover .dropdown-subcat-box-img img{transform: scale(1.1)}
    .dropdown-subcat-box-name{width:132px; height: auto; overflow: hidden; display: inline-block; vertical-align: middle; font-family: 'Open Sans',Arial; font-size:15px; line-height: 23px;}

    .dropdown-subcat-link-box{width: 100%; height: auto; background:#<?=$urunset['detay_altmenu_bg']?>; border-bottom: 1px solid #<?=$urunset['detay_altmenu_border']?>; padding: 10px 12px 8px 12px; overflow: hidden; transition: .1s ease-in-out 0s; font-family: 'Open Sans',Arial; font-size:13px;}
    .dropdown-subcat-link-box:hover{background: #<?=$urunset['detay_altmenu_hover']?>; }
    .dropdown-subcat-link-box:last-child{border-bottom: 0;}
    .dropdown-subcat-link-box i{margin-top: 2px; font-size:14px;}
    .megadrop > .dropdown-subcat-link-box a{color:#<?=$urunset['detay_altmenu_textcolor']?> !important;}
    .megadrop > .dropdown-subcat-link-box a i{color:#<?=$urunset['detay_altmenu_textcolor']?> !important;}
    .dropdown-subcat-link-box:hover a{color:#<?=$urunset['detay_altmenu_hovertextcolor']?> !important;}
    .dropdown-subcat-link-box:hover a i{color:#<?=$urunset['detay_altmenu_hovertextcolor']?> !important;}


     /* MOBIL GORUNUM KATEGORİLER */
    .mobile-controls { background:#FFF; border:1px solid #EBEBEB; width:100%;  }
    .mobile-controls button {background:none; color:#000; border:0px; outline:none; width: 100%; text-align: left; padding: 0 15px 0 15px;height:39px;  font-family:'Open Sans',Serif; font-size:14px; font-weight:600; }
    .mobile-controls button i {   margin-right: 10px;}
    .mobile-controls .back-button { display:none; }
    .mobile-menu {display:none;   height:auto;      position:relative; padding-top: 15px; background-color: #<?=$urunset['detay_altmenu_bg']?> }
    .mobile-menu ul { margin:0;   padding: 0;  position: relative; overflow: hidden;  width: 100%;   transition: 0.25s; }


    .specs-accordion {width: 100%; height: auto;}
    .specs-accordion .specs-heading {
        display: block;
        padding: 12px 10px 12px 10px;
        background-color: #<?=$urunset['detay_altmenu_bg']?>;
        color: #<?=$urunset['detay_altmenu_textcolor']?>; font-family: 'Open Sans', Arial; font-size:14px;
        position: relative; border-bottom:1px solid #<?=$urunset['detay_altmenu_border']?>;
    }
    .specs-heading i{margin-right: 10px;}
    .specs-accordion .specs-heading-sub {
        display: block;
        padding: 12px 10px 12px 35px;
        background-color: #<?=$urunset['detay_altmenu_bg']?>;
        color: #<?=$urunset['detay_altmenu_textcolor']?>; font-family: 'Open Sans', Arial; font-size:13px;
        position: relative; border-bottom:1px dashed #<?=$urunset['detay_altmenu_border']?>;
    }
    .specs-heading-sub i{margin-right: 10px;}
    .specs-accordion .trigger { position: absolute;   top: 9px;  right: 10px;  border: 1px solid #EBEBEB; color:#333;  background: #F8F8F8;  outline: 0; font-size:24px; }
    .specs-icons{width: 25px; display: inline-block; text-align: center}
    .specs-icons i{font-size:15px !important;}

    .fa-chevron-down{
        transform: rotate(0deg);
        transition: transform .02s linear;
    }

    .fa-chevron-down.open{
        transform: rotate(180deg);
        transition: transform 0.2s linear;
    }

</style>


<div class="products-left-bar-div-box">

    <div class="products-left-bar-div-name">

        <div class="products-left-bar-div-name-inside">

            <div class="products-left-bar-div-name-inside-icon">
                <span style="border-bottom: 2px solid #000; padding-bottom: 8px;">
                    <i class="fa fa-th" style="color:#000"></i>
                </span>
            </div>
            <div class="products-left-bar-div-name-inside-txt font-medium">

                <?=$diller['urun-kategorileri']?>

            </div>

        </div>

    </div>




    <ul class="products-leftmenu">


        <?php foreach ($urunkat_listele as $urunkat) {


        $urun_alt_kat=$db->prepare("select * from urun_cat where ust_id='$urunkat[id]' and dil='$_SESSION[dil]' and durum='1' order by sira asc");
        $urun_alt_kat->execute();

        ?>
        <li>
            <a href="urun-kategori/<?=$urunkat['id']?>/<?=seo($urunkat['baslik'])?>">

                <?php if($urunkat['icon'] == !null) { ?>
                <span style="float:left; width: 30px;"><i class="fa <?=$urunkat['icon']?>"></i></span>
                <?php }?>
                <?=$urunkat['baslik']?>


                <?php if ($urun_alt_kat->rowCount() > 0) { ?>
                <span style="float:right;"><i class="fa fa-angle-right"></i></span>
                <?php }?>

            </a>




            <?php if ($urunset['detay_altmenu_tip'] == 0 && $urun_alt_kat->rowCount() > 0 ) {?>

                <!-- Alt Kategori Tip = 0 - SADE LİNK ============================ !-->

                <div class="megadrop">

                    <?php foreach ($urun_alt_kat as $urunaltkat) { ?>
                    <div class="dropdown-subcat-link-box">

                        <a href="urun-kategori/<?=$urunaltkat['id']?>/<?=seo($urunaltkat['baslik'])?>">
                            <?php if($urunaltkat['icon'] == !null  ) {?>
                                <span style="float:left; width: 30px;"><i class="fa <?=$urunaltkat['icon']?>"></i></span>
                            <?php }?>
                            <?=$urunaltkat['baslik']?>
                        </a>

                    </div>
                    <?php } ?>

                </div>

                <!-- Alt Kategori Tip = 0 - SADE LİNK ============================ !-->
            <?php } ?>





            <?php if ($urunset['detay_altmenu_tip'] == 1 && $urun_alt_kat->rowCount() > 0 ) {?>


                    <!-- Alt Kategori Tip = 1 -  ============================ !-->

                    <?php
                    $sayi = 2;
                    ?>
                    <div class="megadrop">


                        <?php if($urun_alt_kat->rowCount() == 1) { ?>

                        <div style="width: 350px;">

                        <?php } ?>


                        <?php if($urun_alt_kat->rowCount() > 1) { ?>

                        <div style="width: 700px;">

                        <?php } ?>



                            <?php foreach ($urun_alt_kat as $urunaltkat) {

                                $urun_table=$db->prepare("select * from urun where kat_id='$urunaltkat[id]' and dil='$_SESSION[dil]' and durum='1' order by id desc");
                                $urun_table->execute();

                                ?><div class="dropdown-subcat-box">

                                    <div class="dropdown-subcat-box-img">

                                        <a href="urun-kategori/<?=$urunaltkat['id']?>/<?=seo($urunaltkat['baslik'])?>">
                                            <img src="images/product-category/<?=$urunaltkat['gorsel']?>" alt="<?=$urunaltkat['baslik']?>">
                                        </a>

                                    </div><div class="dropdown-subcat-box-name">

                                        <a href="urun-kategori/<?=$urunaltkat['id']?>/<?=seo($urunaltkat['baslik'])?>" style="color:#000">
                                            <strong>

                                                <?php
                                                echo mb_substr( $urunaltkat['baslik'], 0, 32, 'UTF-8' ) . '';
                                                ?>

                                            </strong>
                                        </a>

                                        <?php if($urun_table->rowCount() > 0) { ?>
                                        <br>
                                        <span style="font-size:13px; color:#999">( <?=$urun_table->rowCount()?> <?=$diller['urun-sayi-yazisi']?> )</span>

                                        <?php }?>


                                    </div>
                                </div><?php } ?>






                            </div>


                        </div>

                    <!-- Alt Kategori Tip = 1 -  ============================ !-->

            <?php } ?>




        </li>
        <?php }?>




    </ul>
</div>

<!---- RESPONSIVE DESIGN MOBILE CATEGORY =================================================================================0
============================================================================================ !-->
<div class="responsive-category-wrapper">
    <div class="mobile-controls">
            <span id="mobilcat_container">
                <button class="menu-toggle"><i class="fa fa-th"></i> <?=$diller['urunler-mobil-kategoriler-yazisi']?>
                    <i id="icon" class="fa fa-chevron-down" style="float:right; margin-right: 0 !important; margin-top: 2px;font-size:16px !important; "></i>
                </button>
            </span>
    </div>

    <div class="mobile-menu">
        <ul>
            <div class="specs-accordion">
               <?php foreach ($urunkat_listeleMobile as $mobcat) {

                   $urun_alt_kat_mobile=$db->prepare("select * from urun_cat where ust_id='$mobcat[id]' and dil='$_SESSION[dil]' and durum='1' order by sira asc");
                   $urun_alt_kat_mobile->execute();

                   ?>
                <div class="specs-category">
                    <div class="specs-heading">
                        <a href="urun-kategori/<?=$mobcat['id']?>/<?=seo($mobcat['baslik'])?>" style="color:#<?=$urunset['detay_altmenu_textcolor']?>; text-decoration: none;">
                        <?php if($mobcat['icon'] == !null) {?><div class="specs-icons"><i class="fa <?=$mobcat['icon']?>"></i></div><?php }?> <?=$mobcat['baslik'] ?>
                        </a>
                        <?php if($urun_alt_kat_mobile->rowCount()>0) { ?>
                        <button class="trigger fa fa-angle-down"></button>
                        <?php }?>
                    </div>

                    <div class="specs-table">
                        <?php foreach ($urun_alt_kat_mobile as $altmobcat) {?>
                        <div class="specs-heading-sub">
                            <a href="urun-kategori/<?=$altmobcat['id']?>/<?=seo($altmobcat['baslik'])?>" style="color:#<?=$urunset['detay_altmenu_textcolor']?>; text-decoration: none;">
                            <?php if($altmobcat['icon'] == !null) {?><div class="specs-icons"><i class="fa <?=$altmobcat['icon']?>"></i></div><?php }?> <?=$altmobcat['baslik']?>
                            </a>
                        </div>
                        <?php } ?>
                    </div>

                </div>
                <?php }?>

            </div>

        </ul>
    </div>
</div>
<!---- RESPONSIVE DESIGN MOBILE CATEGORY ENDING =================================================================================0
============================================================================================ !-->




<?php if($urunset['detay_arama'] == 1) { ?>
<div class="products-left-bar-div-box" style="background: #F8F8F8; padding-top: 15px; padding-bottom: 25px; display: block !important;">

    <div class="products-left-bar-div-name">

        <div class="products-left-bar-div-name-inside">

            <div class="products-left-bar-div-name-inside-icon">
                <span style="border-bottom: 2px solid #000; padding-bottom: 8px;">
                    <i class="fa fa-search" style="color:#000"></i>
                </span>
            </div>
            <div class="products-left-bar-div-name-inside-txt font-small">

                <?=$diller['urun-arayin']?>

            </div>

        </div>

    </div>


<div class="products-left-bar-search-div">
    <form method="get" action="urunara?search=" >
    <input type="text" name="search" required placeholder="<?=$diller['urun-ara-input-aciklama']?>"><input type="hidden" name="hash" value="<?=md5(sha1($hashOlusturrandom));?><?=md5(sha1($hashOlusturrandom));?>"><button><?=$diller['urun-ara-button-yazi']?></button>
    </form>
</div>


</div>
<?php } ?>



<?php if($urunset['detay_populer'] == 1) { ?>
<div class="products-left-bar-div-box" style="background: #FFF; padding-top: 15px; padding-bottom: 25px;">

    <div class="products-left-bar-div-name" style="margin-bottom: 30px">

        <div class="products-left-bar-div-name-inside">

            <div class="products-left-bar-div-name-inside-icon">
                <span style="border-bottom: 2px solid #000; padding-bottom: 8px;">
                    <i class="fa fa-star" style="color:#000"></i>
                </span>
            </div>
            <div class="products-left-bar-div-name-inside-txt font-small">

                <?=$diller['populer-urunler']?>

            </div>

        </div>

    </div>


    <?php foreach ($urun_populer_list as $populerurun) {




        $starDec = $db->prepare("SELECT SUM(yildiz) AS orta FROM urun_yorum where onay=:onay and urun_id=:urun_id; ");
        $starDec->execute(array(
            'onay' => '1',
            'urun_id' => $populerurun['id']
        ));
        $yildiz = $starDec->fetch(PDO::FETCH_ASSOC);

        $yorumsayisi = $db->prepare("select * from urun_yorum where onay=:onay and urun_id=:urun_id ");
        $yorumsayisi->execute(array(
            'onay' => '1',
            'urun_id' => $populerurun['id']
        ));
        $yorumcount = $yorumsayisi->rowCount();

        if($yorumcount == null  ) {
            $yildizhesap = '0';
        } else {
            $yildizhesap = $yildiz['orta'] / $yorumcount;
        }
        $finalstarrate_kat = (int)$yildizhesap;


        ?>

    <div class="mega-menu-product-box" style="width: 100% !important;">

        <a href="urun/<?php echo $populerurun['id'] ?>/<?php echo seo($populerurun['baslik']) ?>">
        <img src="images/product/<?=$populerurun['gorsel']?>" alt="<?=$populerurun['baslik']?>">
        </a>

        <h1 class="font-13 font-small font-raleway">

            <a href="urun/<?php echo $populerurun['id'] ?>/<?php echo seo($populerurun['baslik']) ?>" style="color:#000">
            <?=$populerurun['baslik']?>
            </a>

        </h1>
        <?php if($urunset['star_rate'] == 1) {?>
        <h1 class="font-14 font-bold font-raleway">

            <?php if($uyeayar['durum'] == '0' ) {?>
            <?php if($populerurun['star_rate'] == 0){ ?>
                <span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
            <?php }?>
            <?php if($populerurun['star_rate'] == 1){ ?>
                <span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
            <?php }?>
            <?php if($populerurun['star_rate'] == 2){ ?>
                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
            <?php }?>
            <?php if($populerurun['star_rate'] == 3){ ?>
                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
            <?php }?>
            <?php if($populerurun['star_rate'] == 4){ ?>
                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span>
            <?php }?>
            <?php if($populerurun['star_rate'] == 5){ ?>
                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span>
            <?php }?>
            <?php }?>


            <!-- ÜYELİK VARSA VE ÜRÜNE YORUMLAR KAPALIYSA YILDIZ SAYISINI GÖSTER !-->
            <?php if($uyeayar['durum'] == '1' ) {?>
            <?php if($populerurun['yorum_durum'] == '0' ) {?>
            <?php if($populerurun['star_rate'] == 0){ ?>
                <span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
            <?php }?>
            <?php if($populerurun['star_rate'] == 1){ ?>
                <span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
            <?php }?>
            <?php if($populerurun['star_rate'] == 2){ ?>
                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
            <?php }?>
            <?php if($populerurun['star_rate'] == 3){ ?>
                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
            <?php }?>
            <?php if($populerurun['star_rate'] == 4){ ?>
                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span>
            <?php }?>
            <?php if($populerurun['star_rate'] == 5){ ?>
                <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span>
            <?php }?>
                <?php } ?>
            <?php } ?>


            <!-- ÜYELİK VARSA VE ÜRÜNE YORUM YAPILABİLİR İSE OYLAMA ORTALAMASINI GÖSTER !-->
            <?php if($populerurun['yorum_durum'] == '1' ) {?>
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


        </h1>
            <?php }?>
        <h1 class="font-14 font-bold font-raleway">

            <?php
            if($populerurun['eski_fiyat']== null ||$populerurun['eski_fiyat']== '0')
            {
            } else { ?>

                <span style="color:#666; text-decoration:  line-through; font-weight: 300;">
                    <?php echo number_format($populerurun['eski_fiyat'], 2); ?> <?php echo $odemeayar['simge'] ?>
                </span>

            <?php }?>

            <?php
            if($populerurun['fiyat']== null ||$populerurun['fiyat']== '0')
            {
            } else { ?>

               <?php echo number_format($populerurun['fiyat'], 2); ?> <?php echo $odemeayar['simge'] ?>

            <?php }?>

        </h1>
    </div>

    <?php } ?>


</div>
<?php } ?>



<script id="rendered-js">
    $(document).ready(function () {

        initAccordion({
            table: '.specs-accordion',
            trigger: '.trigger',
            content: '.specs-table',
            parent: '.specs-category',
            firstItemOpen: false });


    });



    function initAccordion(data) {

        var $table = $(data.table),
            $triggers = $table.find(data.trigger),
            $details = $table.find(data.content);

        $details.hide();

        if (data.firstItemOpen) {
            $($details[0]).show();
        }

        $triggers.on('click', function () {
            var trigger = $(this),
                details = trigger.parents(data.parent).find(data.content);

            details.slideToggle();
            updateArrows.call(trigger);
        });
    }

    function updateArrows() {
        var openedClass = "fa-angle-up",
            closedClass = "fa-angle-down";
        if (this.hasClass('fa-angle-down')) {
            this.addClass(openedClass).removeClass(closedClass);
        } else {
            this.addClass(closedClass).removeClass(openedClass);
        }
    }
    //# sourceURL=pen.js
</script>

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
