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
    $current_page = 'siparis'
    ?>
    <?php
    $Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
    $Say = $db->query("select * from siparis where user_id='$userCek[id]' and NOT siparis_durum='99' order by id DESC");
    $ToplamVeri = $Say->rowCount();
    $Limit = 20;
    $Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
    $Goster = $Sayfa * $Limit - $Limit;
    $GorunenSayfa = 5;
    $listele_tablo = $db->query("select * from siparis where user_id='$userCek[id]' and NOT siparis_durum='99' order by id DESC limit $Goster,$Limit");
    $tabloAl = $listele_tablo->fetchAll(PDO::FETCH_ASSOC);

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



            <div class="user-right-haed" style="border:0; margin-bottom: 0">
                <i class="ion-bag"></i> <?=$diller['uyepanel-siparis']?> (<?=$listele_tablo->rowCount()?>)
                <div class="user-order-sort-info"><?=$diller['uyelik-siparis-siralama-bilgi']?></div>
            </div>
            <div class="user-right-content-inside" style="display: block">

    <?php if ($listele_tablo->rowCount() >0) {?>
                <div class="user-order-alert-box">
                    <?=$diller['uyelik-bilgi-destek']?>
                </div>
    <?php }?>
                <?php  if ($listele_tablo->rowCount() <= 0) {?>
                <div class="alert alert-warning font-open-sans font-13">
                  <?=$diller['uyelik-siparis-bulunamadi']?>
                </div>
                    <?php }?>

    <?php foreach ($tabloAl as $siparis) {
        $orderproduct = $db->prepare("select * from siparis_urunler where siparis_id=:siparis_id ");
        $orderproduct->execute(array(
            'siparis_id' => $siparis['siparis_no'],

            ));
        ?>
        <div class="user-order-box">
            <div class="user-order-box-item">
                <div class="user-order-item-head"><?=$diller['uyelik-siparis-no']?> : <strong>#<?=$siparis['siparis_no']?></strong></div>
                <div class="user-order-item-desc"><?php if($siparis['odeme_tip'] == 1) {?> <strong><?=$diller['odeme-tur-kredi-karti']?></strong> <?php }?><?php if($siparis['odeme_tip'] == 2) {?> <strong><?=$diller['odeme-tur-havale']?></strong> <?php }?> / <?=$orderproduct->rowCount()?> <?=$diller['uyelik-siparis-adet-yazisi']?></div>
            </div>
            <div class="user-order-box-item">
                <div class="user-order-item-head"><?=$diller['uyelik-siparis-durum']?></div>
                <div class="user-order-item-desc">
                <?php if($siparis['siparis_durum'] == 0) { ?>
                    <div class="user-order-item-delivery" style="background-color: #ff4443; color:#FFF"> <?=$diller['uyelik-siparis-durum-yeni']?></div>
                <?php }?>
                    <?php if($siparis['siparis_durum'] == 1) { ?>
                        <div class="user-order-item-delivery" style="background-color: #ffb14b; color:#FFF"><i class="fa fa-refresh"></i> <?=$diller['uyelik-siparis-durum-odeme']?></div>
                    <?php }?>
                    <?php if($siparis['siparis_durum'] == 2) { ?>
                        <div class="user-order-item-delivery" style="background-color: #44a8cb; color:#FFF"><i class="fa fa-refresh"></i> <?=$diller['uyelik-siparis-durum-hazirlanma']?></div>
                    <?php }?>
                    <?php if($siparis['siparis_durum'] == 3) { ?>
                        <div class="user-order-item-delivery" style="background-color: #ff4443; color:#FFF"> <?=$diller['uyelik-siparis-durum-tedarik']?></div>
                    <?php }?>
                    <?php if($siparis['siparis_durum'] == 4) { ?>
                        <div class="user-order-item-delivery" style="background-color: #7a59ff; color:#FFF"><i class="fa fa-truck"></i> <?=$diller['uyelik-siparis-durum-kargolandi']?></div>
                    <?php }?>
                    <?php if($siparis['siparis_durum'] == 5) { ?>
                        <div class="user-order-item-delivery" style="background-color: #19b355; color:#FFF"><i class="fa fa-check"></i> <?=$diller['uyelik-siparis-durum-tamamlandi']?></div>
                    <?php }?>
                    <?php if($siparis['siparis_durum'] == 6) { ?>
                        <div class="user-order-item-delivery" style="background-color: #07150a; color:#FFF"><i class="fa fa-times"></i> <?=$diller['uyelik-siparis-durum-iptal']?></div>
                    <?php }?>
                </div>
            </div>
            <div class="user-order-box-item">
                <div class="user-order-item-head"><?=$diller['uyelik-siparis-tarih']?></div>
                <div class="user-order-item-desc"><?php echo date_tr('j F Y, H:i', ''.$siparis['siparis_tarih'].''); ?></div>
            </div>
            <div class="user-order-box-item">
                <div class="user-order-item-head"><?=$diller['uyelik-siparis-toplam']?></div>
                <div class="user-order-item-desc-price"><?php echo number_format($siparis['toplam_tutar'], 2); ?> <?php echo $odemeayar['simge'] ?></div>
            </div>
            <div class="user-order-box-item">
                <a href="uyelik/siparis/<?=$siparis['siparis_no']?>" class="btn btn-primary btn-sm font-open-sans font-13 font-medium"><?=$diller['uyelik-siparis-button']?></a>
            </div>
        </div>
    <?php }?>


                <!---- Sayfalama Elementleri ================== !-->
                <?php if($Sayfa >= 1){?>
                <nav aria-label="Page navigation example" style="margin-top:20px;">
                    <ul class="pagination pagination-sm justify-content-end">
                        <?php } ?>

                        <?php if($Sayfa > 1){?>

                            <li class="page-item"><a class="page-link" href="uyelik/siparisler"><?=$diller['sayfalama-ilk']?></a></li>
                            <li class="page-item"><a class="page-link" href="uyelik/siparisler/<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

                        <?php } ?>
                        <?php
                        for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                            if($i == $Sayfa){

                                echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="uyelik/siparisler/'.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';

                            }else{
                                echo '
                    <li class="page-item"><a class="page-link" href="uyelik/siparisler/'.$i.'">'.$i.'</a></li>
                    ';
                            }
                        }
                        }
                        ?>

                        <?php if($listele_tablo->rowCount() <=0) { } else { ?>
                            <?php if($Sayfa != $Sayfa_Sayisi){?>

                                <li class="page-item"><a class="page-link" href="uyelik/siparisler/<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                                <li class="page-item"><a class="page-link" href="uyelik/siparisler/<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


                            <?php }} ?>

                        <?php if($Sayfa >= 1){?>
                    </ul>
                </nav>
            <?php } ?>
                <!---- Sayfalama Elementleri ================== !-->



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