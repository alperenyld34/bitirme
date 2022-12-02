<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
if ($userSorgusu->rowCount() > 0 ) {
?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='uyeler' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
    <?php
    $current_page = 'siparis';

    $siparisno = $_GET['order_id'];

    $siparisCek = $db->prepare("select * from siparis where user_id=:user_id and siparis_no=:siparis_no");
    $siparisCek->execute(array(
            'user_id' => $userCek['id'],
            'siparis_no' => $siparisno
    ));
    $order = $siparisCek->fetch(PDO::FETCH_ASSOC);


    $orderProduct = $db->prepare("select * from siparis_urunler where siparis_id=:siparis_id");
    $orderProduct->execute(array(
            'siparis_id' => $order['siparis_no']
    ));
    ?>
    <?php
    if($siparisCek->rowCount()<=0) {
        header('Location:'.$siteurl.'404');
    }
    ?>
<title><?php echo ucwords_tr($diller['uyepanel-siparis']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$ayar[site_desc]" ?>">
<meta name="keywords" content="<?php echo"$ayar[site_tags]" ?>">
<meta name="news_keywords" content="<?php echo"$ayar[site_tags]" ?>">
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

<div class="users-page-main"  >










    <div class="user-content-area">


        <?php include'includes/template/user-leftbar.php'; ?>

        <div class="user-right-content">

            <a href="uyelik/siparisler" class="btn btn-sm btn-dark"><i class="fa fa-arrow-left"></i> <?=$diller['uyelik-geridon-button-yazisi']?></a>
            <br><br>
            <div class="user-right-haed" style="" >
                <i class="ion-bag"></i> <?=$diller['uyepanel-siparis']?> <span style="font-size:14px">> #<?=$order['siparis_no']?> <?=$diller['uyelik-siparis-detay-baslik']?></span>
            </div>

            <div class="user-right-content-inside" style="display: block">

                <?php if($order['siparis_durum'] == 0) { ?>
                    <div class="user-order-detail-status font-14" style="background-color: #ff4443; color:#FFF">
                        <i class="fa fa-dot-circle-o"></i> <strong><?=$diller['uyelik-siparis-durum']?></strong> : <span style="text-transform: uppercase"><?=$diller['uyelik-siparis-durum-yeni']?></span>
                    </div>
                <?php } ?>
                <?php if($order['siparis_durum'] == 1) { ?>
                    <div class="user-order-detail-status font-14" style="background-color: #ffb14b; color:#FFF">
                        <i class="fa fa-dot-circle-o"></i> <strong><?=$diller['uyelik-siparis-durum']?></strong> : <span style="text-transform: uppercase"><i class="fa fa-refresh"></i> <?=$diller['uyelik-siparis-durum-odeme']?></span>
                    </div>
                <?php } ?>
                <?php if($order['siparis_durum'] == 2) { ?>
                    <div class="user-order-detail-status font-14" style="background-color: #44a8cb; color:#FFF">
                        <i class="fa fa-dot-circle-o"></i> <strong><?=$diller['uyelik-siparis-durum']?></strong> : <span style="text-transform: uppercase"><i class="fa fa-refresh"></i> <?=$diller['uyelik-siparis-durum-hazirlanma']?></span>
                    </div>
                <?php } ?>
                <?php if($order['siparis_durum'] == 3) { ?>
                    <div class="user-order-detail-status font-14" style="background-color: #ff4443; color:#FFF">
                        <i class="fa fa-dot-circle-o"></i> <strong><?=$diller['uyelik-siparis-durum']?></strong> : <span style="text-transform: uppercase"><?=$diller['uyelik-siparis-durum-tedarik']?></span>
                    </div>
                <?php } ?>
                <?php if($order['siparis_durum'] == 4) { ?>
                    <div class="user-order-detail-status font-14" style="background-color: #7a59ff; color:#FFF">
                        <i class="fa fa-dot-circle-o"></i> <strong><?=$diller['uyelik-siparis-durum']?></strong> : <span style="text-transform: uppercase"><i class="fa fa-truck"></i> <?=$diller['uyelik-siparis-durum-kargolandi']?></span>
                    </div>
                <?php } ?>
                <?php if($order['siparis_durum'] == 5) { ?>
                    <div class="user-order-detail-status font-14" style="background-color: #19b355; color:#FFF">
                        <i class="fa fa-dot-circle-o"></i> <strong><?=$diller['uyelik-siparis-durum']?></strong> : <span style="text-transform: uppercase"><i class="fa fa-check"></i> <?=$diller['uyelik-siparis-durum-tamamlandi']?></span>
                    </div>
                <?php } ?>
                <?php if($order['siparis_durum'] == 6) { ?>
                    <div class="user-order-detail-status font-14" style="background-color: #333; color:#FFF">
                        <i class="fa fa-dot-circle-o"></i> <strong><?=$diller['uyelik-siparis-durum']?></strong> : <span style="text-transform: uppercase"><i class="fa fa-times"></i> <?=$diller['uyelik-siparis-durum-iptal']?></span>
                    </div>
                <?php } ?>

                <?php
                if ($order['odeme_tip'] == 2 && $order['siparis_durum'] == 0){?>
                <div class="user-order-detail-status font-13" style="background-color: #f8f8f8; color:#000; border:1px solid #EBEBEB">
                    <i class="fa fa-info-circle"></i> <?=$diller['odeme-tur-havale-aciklamasi']?>
                </div>
                <?php }?>
                <?php
                if ($order['odeme_tip'] == 2 && $order['siparis_durum'] == 1){?>
                    <div class="user-order-detail-status font-13" style="background-color: #f8f8f8; color:#000; border:1px solid #EBEBEB">
                        <i class="fa fa-info-circle"></i> <?=$diller['odeme-tur-havale-aciklamasi']?>
                    </div>
                <?php }?>

                <div class="user-order-info-main">
                    <div class="user-order-info-box">

                            <ul>
                                <li><strong><?=$diller['uyelik-siparis-no']?> : </strong>#<?=$order['siparis_no']?> </li>
                                <li><strong><?=$diller['uyelik-siparis-sahibi']?> : </strong><?=$order['isim']?> </li>
                                <li><strong><?=$diller['uyelik-siparis-tarih']?> : </strong>
                                    <?php
                                    $originalDate = $order['siparis_tarih'];
                                    $newDate = date("d-m-Y H:i", strtotime($originalDate));
                                    echo $newDate;
                                    ?>
                                <li><strong><?=$diller['uyelik-siparis-tur']?> : </strong> <?php if($order['odeme_tip'] == 1) {?><i class="fa fa-credit-card"></i> <?=$diller['odeme-tur-kredi-karti']?><?php }?><?php if($order['odeme_tip'] == 2) {?><i class="fa fa-exchange"></i> <?=$diller['odeme-tur-havale']?><?php }?></li>
                                <li><strong><?=$diller['uyelik-siparis-telefon']?> : </strong><?=$order['tel']?> </li>
                                <li><strong><?=$diller['uyelik-siparis-eposta']?> : </strong><?=$order['eposta']?> </li>
                            </ul>

                    </div>
                    <div class="user-order-info-box">

                        <div class="user-order-info-address">
                            <span style="font-size:15px; font-weight: bold"><i class="fa fa-map-marker"></i> <?=$diller['uyelik-siparis-adres']?></span>
                            <br><br>
                            <?=$order['adres']?>
                            <br>
                            <?=$order['postakodu']?> / <strong><?=$order['sehir']?></strong>
                        </div>
                        <div class="user-order-info-address">
                            <span style="font-size:15px; font-weight: bold"><i class="fa fa-map-marker"></i> <?=$diller['uyelik-siparis-fatura-adres']?></span>
                            <br><br>
                            <?=$order['adres_fatura']?>
                        </div>
                    </div>
                </div>


                <div class="user-right-haed" >
                   <?=$diller['uyelik-siparis-detay-urunler']?>
                </div>


                <?php foreach ($orderProduct as $urun){

                    /* Toplam Tutar */

                    $kdvhesap = $urun['kdv_tutar'] * $urun['adet'];

                    $uruntoplamtutar = ($urun['tutar'] * $urun['adet']) + $kdvhesap + $urun['kargo_tutar'];


                    /* TT son */

                    /* Kargo Sorgusu */
                    $delivery = $db->prepare("select * from kargo where siparis_urun_id=:siparis_urun_id ");
                    $delivery->execute(array(
                       'siparis_urun_id' => $urun['id']
                    ));
                    $kargo = $delivery->fetch(PDO::FETCH_ASSOC);
                    /* Kargo Sorgusu */



                    $realProduct = $db->prepare("select * from urun where id=:id ");
                    $realProduct->execute(array(
                            'id' => $urun['urun_id']
                    ));
                    $real = $realProduct->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="user-order-product-main-div" <?php if ($delivery->rowCount()>0) { ?> style="margin-bottom: 0" <?php }?> >

                        <div class="user-order-product-inbox" style="width: auto; flex: 0">
                            <div class="user-order-pro-div">
                                <a href="urun/<?=$real['id']?>/<?=seo($real['baslik'])?>" target="_blank">
                                    <img src="images/product/<?=$real['gorsel'] ?>">
                                </a>
                            </div>
                        </div>

                        <div class="user-order-product-inbox" style="display: flex; align-items: center">
                            <div class="user-order-pro-div-name">
                                <a href="urun/<?=$real['id']?>/<?=seo($real['baslik'])?>" target="_blank">
                                    <strong><?=$urun['urun_baslik']?></strong>
                                </a>
                                <br><br>
                                <?=$urun['varyantlar']?>
                            </div>
                        </div>
                        <div class="user-order-product-inbox">
                            <div class="user-order-pro-div" style="text-align: center">
                                <strong><?=$diller['uyelik-siparis-urun-birim']?></strong>
                                <br><br>
                                <?php echo number_format($urun['tutar'], 2); ?> <?php echo $odemeayar['simge'] ?>
                            </div>
                        </div>
                        <div class="user-order-product-inbox">
                            <div class="user-order-pro-div" style="text-align: center">
                                <strong><?=$diller['uyelik-siparis-urun-adet']?></strong>
                                <br><br>
                                <?=$urun['adet']?>
                            </div>
                        </div>
                        <div class="user-order-product-inbox">
                            <div class="user-order-pro-div" style="text-align: center;">
                                <strong><?=$diller['uyelik-siparis-urun-kdv']?></strong>
                                <br><br>
                                <?php echo number_format($urun['kdv_tutar'], 2); ?> <?php echo $odemeayar['simge'] ?>
                                <?php if($urun['kdv_tutar'] > 0) {?>
                                <br>
                                <span style="color:#666; font-size:12px">(<?php echo number_format($urun['kdv_tutar'], 2); ?> <?php echo $odemeayar['simge'] ?> X <?=$urun['adet']?>)</span>
                                <?php }?>
                            </div>
                        </div>
                        <div class="user-order-product-inbox">
                            <div class="user-order-pro-div" style="text-align: center">
                                <strong><?=$diller['uyelik-siparis-urun-kargo']?></strong>
                                <br><br>
                                <?php echo number_format($urun['kargo_tutar'], 2); ?> <?php echo $odemeayar['simge'] ?>
                            </div>
                        </div>
                        <div class="user-order-product-inbox">
                            <div class="user-order-pro-div" style="text-align: center">
                                <strong><?=$diller['uyelik-siparis-urun-toplam']?></strong>
                                <br><br>
                                <?php echo number_format($uruntoplamtutar, 2); ?> <?php echo $odemeayar['simge'] ?>
                            </div>
                        </div>

                    </div>
                    <?php if ($delivery->rowCount()>0) { ?>
                        <div class="user-order-tracking-main">
                            <div class="user-order-tracking-main-ic">
                                <?=$diller['uyelik-siparis-urun-kargofirma']?> : <strong><?=$kargo['kargo_adi']?></strong>
                            </div>
                            <div class="user-order-tracking-main-ic">
                                <?=$diller['uyelik-siparis-urun-takipno']?> : <strong><?=$kargo['takip_no']?></strong>
                            </div>
                        </div>
                    <?php }  ?>
                <?php }?>



                <div class="user-order-price-detail">

                    <div class="user-order-price-detail-box">
                        <div class="user-order-price-detail-box-in">
                            <?=$diller['ara-toplam']?> :
                        </div>
                        <div class="user-order-price-detail-box-in" style="text-align: right; font-weight: 600">
                            <?php echo number_format($order['ara_tutar'], 2); ?> <?php echo $odemeayar['simge'] ?>
                        </div>
                    </div>

                    <?php if ($order['kdv_tutar'] == !null){?>
                    <div class="user-order-price-detail-box">
                        <div class="user-order-price-detail-box-in">
                            <?=$diller['kdv']?> :
                        </div>
                        <div class="user-order-price-detail-box-in" style="text-align: right; font-weight: 600">
                            <?php echo number_format($order['kdv_tutar'], 2); ?> <?php echo $odemeayar['simge'] ?>
                        </div>
                    </div>
                    <?php }?>

                    <div class="user-order-price-detail-box">
                        <div class="user-order-price-detail-box-in">
                            <?=$diller['kargo-bedeli']?> :
                        </div>
                        <div class="user-order-price-detail-box-in" style="text-align: right; font-weight: 600">
                            <?php echo number_format($order['kargo_tutar'], 2); ?> <?php echo $odemeayar['simge'] ?>
                        </div>
                    </div>

                    <div class="user-order-price-detail-box">
                        <div class="user-order-price-detail-box-in" style="font-size:18px;">
                            <?=$diller['uyelik-siparis-toplam']?>  :
                        </div>
                        <div class="user-order-price-detail-box-in" style="text-align: right; font-size:18px; font-weight: 600">
                            <?php echo number_format($order['toplam_tutar'], 2); ?> <?php echo $odemeayar['simge'] ?>
                        </div>
                    </div>

                </div>





            </div>






        </div>


    </div>
</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

<?php }else{
    header('Location:'.$siteurl.'404');
}
?>