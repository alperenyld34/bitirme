<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
if ($userSorgusu->rowCount() > 0 ) {
?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='uyeler' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
    $current_page = 'yorum';
?>
    <?php
    //TODO bu sayfa da var yorumlar için


    $Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
    $Say = $db->query("select * from urun_yorum where uye_id='$userCek[id]' and onay='1' order by id DESC");
    $ToplamVeri = $Say->rowCount();
    $Limit = 20;
    $Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
    $Goster = $Sayfa * $Limit - $Limit;
    $GorunenSayfa = 5;
    $listele_tablo = $db->query("select * from urun_yorum where uye_id='$userCek[id]' and onay='1' order by id DESC limit $Goster,$Limit");
    $tabloAl = $listele_tablo->fetchAll(PDO::FETCH_ASSOC);


    $onayBekleyen = $db->prepare("select * from urun_yorum where uye_id='$userCek[id]' and onay='0' order by id desc  ");
    $onayBekleyen->execute();
    
            
    ?>
<title><?php echo ucwords_tr($diller['uyelik-uye-yorumlari']) ?> | <?php echo $ayar['site_baslik']?></title>
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


            <div class="user-right-haed" >
                <i class="ion-chatbubbles"></i> <?=$diller['uyelik-uye-yorumlari']?>
            </div>

            <div class="user-comments-status-div">
                <div class="user-comments-status-box">
                    <?=$diller['uyelik-uye-onay-bekleyen-yazisi']?> <br>
                    <span style="font-size: 18px ; font-weight: bold;"><?=$onayBekleyen->rowCount()?></span>
                </div>
                <div class="user-comments-status-box">
                    <?=$diller['uyelik-uye-onaylanan-yazisi']?> <br>
                    <span style="font-size: 18px ; font-weight: bold;"><?=$ToplamVeri?></span>
                </div>
            </div>

<?php if($ToplamVeri < 1 ) {?>
    <div class="alert alert-warning font-open-sans font-13">
        <?=$diller['uyelik-uye-yorum-bulunamadi-yazisi']?>
    </div>
<?php }?>


            <?php foreach ($tabloAl as $yorum) {

                $urunCekcek = $db->prepare("select * from urun where id='$yorum[urun_id]' ");
                $urunCekcek->execute();
                $urun = $urunCekcek->fetch(PDO::FETCH_ASSOC);
                ?>
            <div class="user-address-main-div">
                <div class="user-address-main-head">
                    

                    <?php if($urunCekcek->rowCount()>0  ) {?>
                        <a href="<?=$siteurl?>urun/<?=$urun['id']?>/<?=seo($urun['baslik'])?>" style="color: #000;" target="_blank"><i class="fa fa-external-link" style="margin-right: 10px;"></i><strong><?=$urun['baslik']?></strong></a>
                    <?php }else { ?>
                        <strong>Ürün Kaldırılmış!</strong>
                    <?php }?>

                    <span style="font-size: 13px ; color: #666;"><i class="fa fa-clock-o" style="margin-left: 15px"></i> <?php echo date_tr('j F Y, H:i, l ', ''.$yorum['tarih'].''); ?></span>
                </div>
                <div class="user-address-in-box">
                    <div class="user-address-box-1">
                        <span style="font-size: 16px ; font-weight: bold;"> <?=$yorum['baslik']?></span><br><br>
                        <?=$yorum['yorum']?>
                    </div>
                </div>
                <div class="user-address-in-box">
                    <div class="user-address-box-2" style="font-size: 20px ;">
                        <span style="font-size: 15px ;"><?=$diller['uyelik-uye-urun-oyunuz']?></span><br>
                        <?php if($yorum['yildiz'] == 0){ ?>
                            <span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                        <?php }?>
                        <?php if($yorum['yildiz'] == 1){ ?>
                            <span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                        <?php }?>
                        <?php if($yorum['yildiz'] == 2){ ?>
                            <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                        <?php }?>
                        <?php if($yorum['yildiz'] == 3){ ?>
                            <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span><span style="color:#CCC">★</span>
                        <?php }?>
                        <?php if($yorum['yildiz'] == 4){ ?>
                            <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#CCC">★</span>
                        <?php }?>
                        <?php if($yorum['yildiz'] == 5){ ?>
                            <span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span><span style="color:#ffb400">★</span>
                        <?php }?>
                    </div>
                </div>
            </div>
            <?php }?>

            <!---- Sayfalama Elementleri ================== !-->
            <?php if($Sayfa >= 1){?>
            <nav aria-label="Page navigation example" style="margin-top:20px;">
                <ul class="pagination pagination-sm justify-content-end">
                    <?php } ?>

                    <?php if($Sayfa > 1){?>

                        <li class="page-item"><a class="page-link" href="uyelik/yorumlar"><?=$diller['sayfalama-ilk']?></a></li>
                        <li class="page-item"><a class="page-link" href="uyelik/yorumlar/<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

                    <?php } ?>
                    <?php
                    for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                        if($i == $Sayfa){

                            echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="uyelik/yorumlar/'.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';

                        }else{
                            echo '
                    <li class="page-item"><a class="page-link" href="uyelik/yorumlar/'.$i.'">'.$i.'</a></li>
                    ';
                        }
                    }
                    }
                    ?>

                    <?php if($listele_tablo->rowCount() <=0) { } else { ?>
                        <?php if($Sayfa != $Sayfa_Sayisi){?>

                            <li class="page-item"><a class="page-link" href="uyelik/yorumlar/<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                            <li class="page-item"><a class="page-link" href="uyelik/yorumlar/<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


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
<!-- SİL UYARI POPUP !-->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header font-bold font-20" >
            </div>
            <div class="modal-body font-open-sans font-16">
               <?=$diller['uyelik-adres-sil-uyari']?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><?=$diller['uyelik-adres-sil-iptal']?></button>
                <a class="btn btn-sm btn-danger btn-ok"><?=$diller['uyelik-adres-sil']?></a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('a[data-confirm]').click(function(ev) {
            var href = $(this).attr('href');

            if (!$('#dataConfirmModal').length) {
                $('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel">Please Confirm</h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button><a class="btn btn-primary" id="dataConfirmOK">OK</a></div></div>');
            }
            $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
            $('#dataConfirmOK').attr('href', href);
            $('#dataConfirmModal').modal({show:true});
            return false;
        });
    });

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

</script>

<!-- SİL UYARI POPUP !-->


<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

<?php }else{
    header('Location:'.$siteurl.'404');
}
?>