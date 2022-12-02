<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='tracing' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
//TODO BU SAYFADA VAR





?>
<title><?php echo ucwords_tr($diller['siparis-takip-baslik']) ?> | <?php echo $ayar['site_baslik']?></title>
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

<div class="bank-page-main">



    <div class="bank-page-text-main">


        <?php
        $sipno = trim(strip_tags($_GET['orderNo']));
            $siparisCek = $db->prepare("select * from siparis where siparis_no=:siparis_no ");
                $siparisCek->execute(array(
                    'siparis_no' => $sipno
                ));
                $rowss = $siparisCek->fetch(PDO::FETCH_ASSOC);

        $orderProduct = $db->prepare("select * from siparis_urunler where siparis_id=:siparis_id");
        $orderProduct->execute(array(
            'siparis_id' => $rowss['siparis_no']
        ));
        ?>

        <?php if($siparisCek->rowCount() > '0' ) {?>

            <div class="tracing-order-main-div">
               <div class="tracing-order-no-div">
                   <?=$diller['siparis-takip-no']?> : #<?=$sipno?>
               </div>

                <!-- Sipariş Detayları !-->
                <div class="user-right-content-inside" style="display: block">

                    <?php if($rowss['siparis_durum'] == 0) { ?>
                        <div class="user-order-detail-status font-14" style="background-color: #ff4443; color:#FFF">
                            <i class="fa fa-dot-circle-o"></i> <strong><?=$diller['siparis-takip-order-durum']?></strong> : <span style="text-transform: uppercase"><?=$diller['siparis-takip-order-durum-yeni']?></span>
                        </div>
                    <?php } ?>
                    <?php if($rowss['siparis_durum'] == 1) { ?>
                        <div class="user-order-detail-status font-14" style="background-color: #ffb14b; color:#FFF">
                            <i class="fa fa-dot-circle-o"></i> <strong><?=$diller['siparis-takip-order-durum']?></strong> : <span style="text-transform: uppercase"><i class="fa fa-refresh"></i> <?=$diller['siparis-takip-order-durum-odeme']?></span>
                        </div>
                    <?php } ?>
                    <?php if($rowss['siparis_durum'] == 2) { ?>
                        <div class="user-order-detail-status font-14" style="background-color: #44a8cb; color:#FFF">
                            <i class="fa fa-dot-circle-o"></i> <strong><?=$diller['siparis-takip-order-durum']?></strong> : <span style="text-transform: uppercase"><i class="fa fa-refresh"></i> <?=$diller['siparis-takip-order-durum-hazirlanma']?></span>
                        </div>
                    <?php } ?>
                    <?php if($rowss['siparis_durum'] == 3) { ?>
                        <div class="user-order-detail-status font-14" style="background-color: #ff4443; color:#FFF">
                            <i class="fa fa-dot-circle-o"></i> <strong><?=$diller['siparis-takip-order-durum']?></strong> : <span style="text-transform: uppercase"><?=$diller['siparis-takip-order-durum-tedarik']?></span>
                        </div>
                    <?php } ?>
                    <?php if($rowss['siparis_durum'] == 4) { ?>
                        <div class="user-order-detail-status font-14" style="background-color: #7a59ff; color:#FFF">
                            <i class="fa fa-dot-circle-o"></i> <strong><?=$diller['siparis-takip-order-durum']?></strong> : <span style="text-transform: uppercase"><i class="fa fa-truck"></i> <?=$diller['siparis-takip-order-durum-kargolandi']?></span>
                        </div>
                    <?php } ?>
                    <?php if($rowss['siparis_durum'] == 5) { ?>
                        <div class="user-order-detail-status font-14" style="background-color: #19b355; color:#FFF">
                            <i class="fa fa-dot-circle-o"></i> <strong><?=$diller['siparis-takip-order-durum']?></strong> : <span style="text-transform: uppercase"><i class="fa fa-check"></i> <?=$diller['siparis-takip-order-durum-tamamlandi']?></span>
                        </div>
                    <?php } ?>
                    <?php if($rowss['siparis_durum'] == 6) { ?>
                        <div class="user-order-detail-status font-14" style="background-color: #333; color:#FFF">
                            <i class="fa fa-dot-circle-o"></i> <strong><?=$diller['siparis-takip-order-durum']?></strong> : <span style="text-transform: uppercase"><i class="fa fa-times"></i> <?=$diller['siparis-takip-order-durum-iptal']?></span>
                        </div>
                    <?php } ?>

                    <?php
                    if ($rowss['odeme_tip'] == 2 && $rowss['siparis_durum'] == 0){?>
                        <div class="user-order-detail-status font-13" style="background-color: #f8f8f8; color:#000; border:1px solid #EBEBEB">
                            <i class="fa fa-info-circle"></i> <?=$diller['odeme-tur-havale-aciklamasi']?>
                        </div>
                    <?php }?>
                    <?php
                    if ($rowss['odeme_tip'] == 2 && $rowss['siparis_durum'] == 1){?>
                        <div class="user-order-detail-status font-13" style="background-color: #f8f8f8; color:#000; border:1px solid #EBEBEB">
                            <i class="fa fa-info-circle"></i> <?=$diller['odeme-tur-havale-aciklamasi']?>
                        </div>
                    <?php }?>

                    <div class="user-order-info-main">
                        <div class="user-order-info-box">

                            <ul>
                                <li><strong><?=$diller['siparis-takip-no']?> : </strong>#<?=$rowss['siparis_no']?> </li>
                                <li><strong><?=$diller['siparis-takip-order-sahibi']?> : </strong><?=$rowss['isim']?> </li>
                                <li><strong><?=$diller['siparis-takip-order-tarih']?> : </strong> <?php echo date_tr('j F Y, H:i', ''.$rowss['siparis_tarih'].''); ?></li>
                                <li><strong><?=$diller['siparis-takip-order-tur']?> : </strong> <?php if($rowss['odeme_tip'] == 1) {?><i class="fa fa-credit-card"></i> <?=$diller['odeme-tur-kredi-karti']?><?php }?><?php if($rowss['odeme_tip'] == 2) {?><i class="fa fa-exchange"></i> <?=$diller['odeme-tur-havale']?><?php }?></li>
                                <li><strong><?=$diller['siparis-takip-order-telefon']?> : </strong><?=$rowss['tel']?> </li>
                                <li><strong><?=$diller['siparis-takip-order-eposta']?> : </strong><?=$rowss['eposta']?> </li>
                            </ul>

                        </div>
                        <div class="user-order-info-box">

                            <div class="user-order-info-address">
                                <span style="font-size:15px; font-weight: bold"><i class="fa fa-map-marker"></i> <?=$diller['siparis-takip-order-adres']?></span>
                                <br><br>
                                <?=$rowss['adres']?>
                                <br>
                                <?=$rowss['postakodu']?> / <strong><?=$rowss['sehir']?></strong>
                            </div>
                        </div>
                    </div>


                    <div class="user-right-haed" >
                        <?=$diller['siparis-takip-order-detay-urunler']?>
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
                                    <strong><?=$diller['siparis-takip-order-urun-birim']?></strong>
                                    <br><br>
                                    <?php echo number_format($urun['tutar'], 2); ?> <?php echo $odemeayar['simge'] ?>
                                </div>
                            </div>
                            <div class="user-order-product-inbox">
                                <div class="user-order-pro-div" style="text-align: center">
                                    <strong><?=$diller['siparis-takip-order-urun-adet']?></strong>
                                    <br><br>
                                    <?=$urun['adet']?>
                                </div>
                            </div>
                            <div class="user-order-product-inbox">
                                <div class="user-order-pro-div" style="text-align: center;">
                                    <strong><?=$diller['siparis-takip-order-urun-kdv']?></strong>
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
                                    <strong><?=$diller['siparis-takip-order-urun-kargo']?></strong>
                                    <br><br>
                                    <?php echo number_format($urun['kargo_tutar'], 2); ?> <?php echo $odemeayar['simge'] ?>
                                </div>
                            </div>
                            <div class="user-order-product-inbox">
                                <div class="user-order-pro-div" style="text-align: center">
                                    <strong><?=$diller['siparis-takip-order-urun-toplam']?></strong>
                                    <br><br>
                                    <?php echo number_format($uruntoplamtutar, 2); ?> <?php echo $odemeayar['simge'] ?>
                                </div>
                            </div>

                        </div>
                        <?php if ($delivery->rowCount()>0) { ?>
                            <div class="user-order-tracking-main">
                                <div class="user-order-tracking-main-ic">
                                    <?=$diller['siparis-takip-order-urun-kargofirma']?> : <strong><?=$kargo['kargo_adi']?></strong>
                                </div>
                                <div class="user-order-tracking-main-ic">
                                    <?=$diller['siparis-takip-order-urun-takipno']?> : <strong><?=$kargo['takip_no']?></strong>
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
                                <?php echo number_format($rowss['ara_tutar'], 2); ?> <?php echo $odemeayar['simge'] ?>
                            </div>
                        </div>

                        <?php if ($rowss['kdv_tutar'] == !null){?>
                            <div class="user-order-price-detail-box">
                                <div class="user-order-price-detail-box-in">
                                    <?=$diller['kdv']?> :
                                </div>
                                <div class="user-order-price-detail-box-in" style="text-align: right; font-weight: 600">
                                    <?php echo number_format($rowss['kdv_tutar'], 2); ?> <?php echo $odemeayar['simge'] ?>
                                </div>
                            </div>
                        <?php }?>

                        <div class="user-order-price-detail-box">
                            <div class="user-order-price-detail-box-in">
                                <?=$diller['kargo-bedeli']?> :
                            </div>
                            <div class="user-order-price-detail-box-in" style="text-align: right; font-weight: 600">
                                <?php echo number_format($rowss['kargo_tutar'], 2); ?> <?php echo $odemeayar['simge'] ?>
                            </div>
                        </div>

                        <div class="user-order-price-detail-box">
                            <div class="user-order-price-detail-box-in" style="font-size:18px;">
                                <?=$diller['siparis-takip-order-toplam']?>  :
                            </div>
                            <div class="user-order-price-detail-box-in" style="text-align: right; font-size:18px; font-weight: 600">
                                <?php echo number_format($rowss['toplam_tutar'], 2); ?> <?php echo $odemeayar['simge'] ?>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- Sipariş Detayları SON !-->




            </div>


        <?php }else { ?>
            <div style="width: 100%; text-align: center; margin-bottom: 50px;">
                <div class="alert alert-danger">
                    <i class="fa fa-frown-o" style="font-size:32px"></i>
                    <br>
                    <?=$diller['siparis-takip-bulunamadi']?>
                </div>
                <a href="siparis-takip" class="btn btn-primary"><?=$diller['siparis-takip-tekrar-sorgula-button']?></a>
            </div>
        <?php }?>

    </div>






</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

