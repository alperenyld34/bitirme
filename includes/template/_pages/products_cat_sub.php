<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='products' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
$productsayar = $db->prepare("select * from urunmodul_ayar where id=:id");
$productsayar->execute(array(
    'id' => 1
));
$prodayar = $productsayar->fetch(PDO::FETCH_ASSOC);
?>
<?php
$cat_id = $_GET['cat_id'];
$product_kat_info = $db->prepare("select * from urun_cat where id=:id and durum=:durum and dil=:dil");
$product_kat_info->execute(array(
        'id'=>$cat_id,
        'durum' => 1,
        'dil' => $_SESSION['dil']
));
$procat = $product_kat_info->fetch(PDO::FETCH_ASSOC);
?>
<?php
$product_ust_kat = $db->prepare("select * from urun_cat where id=:id and durum=:durum and dil=:dil");
$product_ust_kat->execute(array(
        'id' => $procat['ust_id'],
        'durum' => 1,
        'dil' => $_SESSION['dil']
));
$proustcat = $product_ust_kat->fetch(PDO::FETCH_ASSOC);
?>
<?php
$Sayfa = @intval($_GET['s']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("SELECT * FROM urun WHERE durum='1' and dil='$_SESSION[dil]' and kat_id IN (
                                                          SELECT id FROM urun_cat  WHERE id = $_GET[cat_id] OR ust_id = $_GET[cat_id]) order by id desc");
$ToplamVeri = $Say->rowCount();
$Limit = 24;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;

if(!empty($_GET)){

    $urun_listele = $db->query("SELECT * FROM urun WHERE durum='1' and dil='$_SESSION[dil]' and kat_id IN (
                                                          SELECT id FROM urun_cat  WHERE id = $_GET[cat_id] OR ust_id = $_GET[cat_id]) order by id desc limit $Goster,$Limit");
    $UrunAl = $urun_listele->fetchAll(PDO::FETCH_ASSOC);

}


if($_GET['sirala'] == 1){

$urun_listele = $db->query("SELECT * FROM urun WHERE durum='1' and dil='$_SESSION[dil]' and kat_id IN (
                                                          SELECT id FROM urun_cat  WHERE id = $_GET[cat_id] OR ust_id = $_GET[cat_id]) order by id desc limit $Goster,$Limit");
$UrunAl = $urun_listele->fetchAll(PDO::FETCH_ASSOC);

}

if($_GET['sirala'] == 2){

    $urun_listele = $db->query("SELECT * FROM urun WHERE durum='1' and dil='$_SESSION[dil]' and kat_id IN (
                                                          SELECT id FROM urun_cat  WHERE id = $_GET[cat_id] OR ust_id = $_GET[cat_id]) order by hit desc limit $Goster,$Limit");
    $UrunAl = $urun_listele->fetchAll(PDO::FETCH_ASSOC);

}

if($_GET['sirala'] == 3){

    $urun_listele = $db->query("SELECT * FROM urun WHERE durum='1' and dil='$_SESSION[dil]' and kat_id IN (
                                                          SELECT id FROM urun_cat  WHERE id = $_GET[cat_id] OR ust_id = $_GET[cat_id]) order by fiyat asc limit $Goster,$Limit");
    $UrunAl = $urun_listele->fetchAll(PDO::FETCH_ASSOC);

}

if($_GET['sirala'] == 4){

    $urun_listele = $db->query("SELECT * FROM urun WHERE durum='1' and dil='$_SESSION[dil]' and kat_id IN (
                                                          SELECT id FROM urun_cat  WHERE id = $_GET[cat_id] OR ust_id = $_GET[cat_id]) order by fiyat desc limit $Goster,$Limit");
    $UrunAl = $urun_listele->fetchAll(PDO::FETCH_ASSOC);

}

?>
<?php
if($product_kat_info->rowCount() == 0)
{
    header('Location:'.$siteurl.'');

    exit;

}
?>
<title><?php echo ucwords_tr($procat['baslik']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$procat[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$procat[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$procat[tags]" ?>">
<meta name="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta itemprop="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta name="robots" content="index follow">
<meta name="googlebot" content="index follow">
<meta property="og:type" content="website" />

<?php include "includes/config/header_libs.php";?>

</head>
<body>

<?php include 'includes/template/header.php'?>


<!-- CONTENT AREA ============== !-->

<div class="products-page-main">





            <div class="products-left-bar-main">


                <?php include'includes/template/products-cat-leftbar.php'; ?>


            </div><div class="products-right-main">


                <div class="category-name-value-div" >

                    <?php if($proustcat['id'] == 0) {?>
                        <span style="font-size:24px; font-weight: 700;"><?php echo ucwords_tr($procat['baslik']) ?></span>
                    <?php }?>

                    <?php if($proustcat['id'] == !0) {?>
                        <a href="urun-kategori/<?=$proustcat['id']?>/<?=seo($proustcat['baslik'])?>" style="color:#000"><span style="font-size:24px; font-weight: 700;"><?php echo ucwords_tr($proustcat['baslik']) ?></span></a>
                    <?php }?>

                    <?php if($proustcat['id'] == !0) {?>
                        <span style="font-size:18px; font-weight: 600"><i class="fa fa-caret-right" style="margin: 0 0 0 15px"></i> <?php echo ucwords_tr($procat['baslik']) ?></span>
                     <?php }?>

                </div>

                <div class="products-right-nav-head">


                        <div class="products-right-nav-head-txt">


                            <?php echo $diller['urun-toplam-sayi'] ?> <strong><?php echo $ToplamVeri ?></strong>

                        </div>

                        <div class="products-right-nav-head-select">


                            <select id="dynamicList">
                                <option value="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?sirala=1" <?php if($_GET['sirala'] == 1) { echo'selected'; }?> ><?php echo $diller['urun-siralama-yeni'] ?></option>
                                <option value="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?sirala=2" <?php if($_GET['sirala'] == 2) { echo'selected'; }?>><?php echo $diller['urun-siralama-populer'] ?></option>
                                <option value="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?sirala=3" <?php if($_GET['sirala'] == 3) { echo'selected'; }?>><?php echo $diller['urun-siralama-artan'] ?></option>
                                <option value="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?sirala=4" <?php if($_GET['sirala'] == 4) { echo'selected'; }?>><?php echo $diller['urun-siralama-azalan'] ?></option>
                            </select>


                        </div>

                </div>

                <div class="products-right-products-area">


                    <?php if($ToplamVeri == 0) { ?>

                        <div class="alert alert-secondary" role="alert">
                          Bu Kategoriye Ürün Eklenmemiş!
                        </div>

                    <?php }?>

                    <?php foreach($UrunAl as $prohit){ //TODO BAR

                    $pro_list_cat = $db->prepare("select * from urun_cat where id=:id and durum=:durum and dil=:dil order by id desc limit 1 ");
                    $pro_list_cat->execute(array(
                            'id' => $prohit['kat_id'],
                            'durum'=> 1,
                            'dil' => $_SESSION['dil']
                    ));
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
                        $finalstarrate_kat = (int)$yildizhesap;
                    ?>

                        <div class="product-main-box">
                            <div class="product-main-box-in">
                                <div class="product-main-box-img">

                                    <img src="images/product/<?php echo $prohit['gorsel'] ?>" alt="<?php echo $prohit['baslik'] ?>">
                                    <?php
                                    if($prohit['stok'] > 0) {
                                        ?>
                                        <a href="urun/<?php echo $prohit['id'] ?>/<?php echo seo($prohit['baslik']) ?>"><div class="ovrly"></div></a>
                                        <div class="buttons">
                                            <a href="urun/<?php echo $prohit['id'] ?>/<?php echo seo($prohit['baslik']) ?>" class="text" style="color:#<?php echo $prodayar['incele_button_color']?>;"><i class="fa fa-search" style="color:#<?php echo $prodayar['incele_button_color']?>"></i> <?php echo $diller['incele'] ?></a>
                                        </div>
                                    <?php } else {?>
                                        <a href="urun/<?php echo $prohit['id'] ?>/<?php echo seo($prohit['baslik']) ?>"><div class="opaovrly"></div></a>
                                        <div class="nostock">
                                            <a href="urun/<?php echo $prohit['id'] ?>/<?php echo seo($prohit['baslik']) ?>" class="text" style="color:#<?php echo $prodayar['incele_button_color']?>;">
                                                <i class="fa fa-times" style="color:#<?php echo $prodayar['incele_button_color']?>"></i> <?php echo $diller['stok-yok'] ?></a>
                                        </div>
                                    <?php }?>

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
                                    if($prohit['eski_fiyat']== '0')
                                    {
                                    } else { ?>

                                        <span style="font-size:15px; font-weight: 400; font-family: 'Open Sans', Arial; color:#999; display: inline-block; text-decoration: line-through;"><?php echo number_format($prohit['eski_fiyat'], 2); ?> <span class="font-exlight" style="color:#999"><?php echo $odemeayar['simge'] ?></span></span>

                                    <?php }?>


                                    <?php
                                    if($prohit['fiyat']== null || $prohit['fiyat']== '0')
                                    {
                                    } else { ?>

                                        <h1><?php echo number_format($prohit['fiyat'], 2); ?> <span class="font-exlight" style="color:#000"><?php echo $odemeayar['simge'] ?></span></h1>

                                    <?php }?>
                                </div>
                            </div>
                        </div>

                    <?php } ?>









                    <!---- Sayfalama Elementleri ================== !-->

                    <?php if($Sayfa >= 1){?>
                    <nav aria-label="Page navigation example" style="margin-top: 50px;">
                        <ul class="pagination pagination-sm justify-content-center">
                            <?php } ?>

                            <?php if($Sayfa > 1){?>

                            <?php if($_GET['sirala'] == null){ ?>
                                <li class="page-item"><a class="page-link" href="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?s=1"><?=$diller['sayfalama-ilk']?></a></li>
                                <li class="page-item"><a class="page-link" href="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?s=<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>
                            <?php } else { ?>
                                <li class="page-item"><a class="page-link" href="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?s=1&sirala=<?=$_GET['sirala']?>"><?=$diller['sayfalama-ilk']?></a></li>
                                <li class="page-item"><a class="page-link" href="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?s=<?=$Sayfa - 1?>&sirala=<?=$_GET['sirala']?>"><?=$diller['sayfalama-onceki']?></a></li>
                            <?php } ?>

                            <?php } ?>
                            <?php
                            for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                                if($i == $Sayfa){
                                  ?>
    
                            <li class="page-item active" aria-current="page">

                                <?php if($_GET['sirala'] == null){ ?>

                              <a class="page-link" href="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?s=<?=$i?>"><?=$i?><span class="sr-only">(current)</span></a>

                                <?php } else { ?>

                              <a class="page-link" href="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?s=<?=$i?>&sirala=<?=$_GET['sirala']?>"><?=$i?><span class="sr-only">(current)</span></a>


                                <?php } ?>

                            </li>
                            
                           <?php
                                }else{ ?>

                                    <?php if($_GET['sirala'] == null){ ?>

                                    <li class="page-item"><a class="page-link" href="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?s=<?=$i?>"><?=$i?></a></li>

                                    <?php } else { ?>

                                    <li class="page-item"><a class="page-link" href="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?s=<?=$i?>&sirala=<?=$_GET['sirala']?>"><?=$i?></a></li>

                                    <?php } ?>

                           <?php
                                }
                            }
                            }
                            ?>

                            <?php if($urun_listele->rowCount() <=0) { } else { ?>
                                <?php if($Sayfa != $Sayfa_Sayisi){?>


                                    <?php if($_GET['sirala'] == null){ ?>

                                    <li class="page-item"><a class="page-link" href="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?s=<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                                    <li class="page-item"><a class="page-link" href="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?s=<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>

                                    <?php } else { ?>

                                        <li class="page-item"><a class="page-link" href="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?s=<?=$Sayfa + 1?>&sirala=<?=$_GET['sirala']?>"><?=$diller['sayfalama-sonraki']?></a></li>
                                        <li class="page-item"><a class="page-link" href="urun-kategori/<?=$procat['id']?>/<?=seo($procat['baslik'])?>?s=<?=$Sayfa_Sayisi?>&sirala=<?=$_GET['sirala']?>"><?=$diller['sayfalama-son']?></a></li>

                                    <?php } ?>



                                <?php }} ?>

                            <?php if($Sayfa >= 1){?>
                        </ul>
                    </nav>
                <?php } ?>
                    <!---- Sayfalama Elementleri ================== !-->







                </div>




            </div>











</div>

<!-- CONTENT AREA ============== !-->
<script>
    $(function(){
        // bind change event to select
        $('#dynamicList').on('change', function () {
            var url = $(this).val(); // get selected value
            if (url) { // require a URL
                window.location = url; // redirect
            }
            return false;
        });
    });
</script>


<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

