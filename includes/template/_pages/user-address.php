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
    $current_page = 'adres';

    $addressSorgu = $db->prepare("select * from uyeler_adres where uye_id=:uye_id");
    $addressSorgu->execute(array(
            'uye_id' => $userCek['id']
    ));

    ?>
    <?php
    if (isset($_SESSION['sil_success'])) {
        ?>
        <div class="user_success_alert">
            <div class="user_success_alert_ic">
                <i class="fa fa-check"></i> <?=$diller['uyelik-adres-sil-basarili']?>
            </div>
        </div>
        <meta http-equiv="refresh" content="2; URL=<?=$siteurl?>uyelik/kayitli-adresler">
        <?php unset($_SESSION['sil_success']);?>
    <?php }?>
<title><?php echo ucwords_tr($diller['uyepanel-adresler']) ?> | <?php echo $ayar['site_baslik']?></title>
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
                <i class="ion-ios-location"></i> <?=$diller['uyepanel-adresler']?>
            </div>

            <a href="uyelik/adres-ekle" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> <?=$diller['uyelik-adres-ekle']?></a>
            <br><br>

            <?php if($addressSorgu->rowCount()<=0) {?>
            <div class="alert alert-warning font-open-sans font-13">
                <?=$diller['uyelik-adres-yok']?>
            </div>
            <?php }?>


            <?php foreach ($addressSorgu as $adres) { ?>
            <div class="user-address-main-div">
                <div class="user-address-main-head">
                   <i class="fa fa-home"></i> <?=$diller['uyelik-adres-basligi']?> : <strong><?=$adres['baslik']?></strong>
                </div>
                <div class="user-address-in-box">
                    <div class="user-address-box-1">
                        <?=$adres['adres']?>
                    </div>
                </div>
                <div class="user-address-in-box">
                    <div class="user-address-box-2">
                        <?=$adres['posta_kodu']?>
                    </div>
                </div>
                <div class="user-address-in-box">
                    <div class="user-address-box-2">
                        <?=$adres['ilce']?>/<?=$adres['sehir']?>
                    </div>
                </div>
                <div class="user-address-in-box" style="padding: 20px 20px">
                    <div class="user-address-box-3">

                        <a href="uyelik/adres-duzenle/<?=$adres['adres_id']?>" class="btn btn-sm btn-primary font-open-sans font-13"><?=$diller['uyelik-adres-button-duzenle']?></a>
                        <a data-href="uyelik/adres-sil/<?=$adres['adres_id']?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-danger font-open-sans font-13" style="color:#FFF; cursor: pointer"><i class="fa fa-times"></i> <?=$diller['uyelik-adres-button-sil']?></a>

                    </div>
                </div>
            </div>
            <?php } ?>




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