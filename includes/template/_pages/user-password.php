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
    $current_page = 'sifre'
    ?>
    <?php
    if (isset($_POST['updatepassword'])) {

        $eskisifre = trim(md5($_POST['eskisifre']));
        $yenisifre = trim(md5($_POST['yenisifre']));
        $yenisifre2 = trim(md5($_POST['yenisifre_tekrar']));

        if ($_POST['eskisifre'] && $_POST['yenisifre'] && $_POST['yenisifre_tekrar'] ) {
            /* Eski şifre kontrolü */
            $sifreKontrol = $db->prepare("select * from uyeler where id=:id and uyesifre=:uyesifre");
            $sifreKontrol->execute(array(
               'id' => $userCek['id'],
               'uyesifre' => $eskisifre
            ));
            if ($sifreKontrol->rowCount()>0){
                    /* yeni şifrelerin eşitliğini kontrol et */
                if ($yenisifre == $yenisifre2){
                    /* eski ile yeni eşit mi kontrolü */
                    if ($yenisifre != $eskisifre){
                        /* Güncelleme işlemi */
                        $sifreGuncelle = $db->prepare(
                                "UPDATE uyeler SET
                                uyesifre=:uyesifre
                                WHERE id={$userCek['id']}
                                ");
                        $sifrekaydet = $sifreGuncelle->execute(array(
                           'uyesifre' => $yenisifre
                        ));
                        if ($sifrekaydet){
                            $_SESSION['basarili_guncelleme'] = 'success';
                        }else{
                            echo ' Veritabanı hatası';
                        }
                    }else{
                        $_SESSION['kayit_hata'] = 'eskiyenisorun';
                    }
                }else{
                    $_SESSION['kayit_hata'] = 'sifreleresitdegil';
                }
            }else{
                $_SESSION['kayit_hata'] = 'eskisifre';
            }
        }else{
            $_SESSION['kayit_hata'] = 'bos';
        }
    }
    ?>
    <?php
    if (isset($_SESSION['basarili_guncelleme'])) {
        ?>
        <div class="user_success_alert">
            <div class="user_success_alert_ic">
                <i class="fa fa-check"></i> <?=$diller['uyelik-guncellendi-yazisi']?>
            </div>
        </div>
        <meta http-equiv="refresh" content="1; URL=<?=$siteurl?>uyelik/sifre-degistir">
        <?php unset($_SESSION['basarili_guncelleme']);?>
    <?php }?>
    <?php
    if (isset($_SESSION['kayit_hata']) && $_SESSION['kayit_hata'] == 'bos') {
        ?>
        <div class="user_success_alert">
            <div class="user_success_alert_ic_red">
                <i class="fa fa-times"></i> <?=$diller['uyelik-bos-alan']?>
            </div>
        </div>
        <meta http-equiv="refresh" content="2; URL=<?=$siteurl?>uyelik/sifre-degistir">
        <?php unset($_SESSION['kayit_hata']);?>
    <?php }?>
    <?php
    if (isset($_SESSION['kayit_hata']) && $_SESSION['kayit_hata'] == 'eskisifre') {
        ?>
        <div class="user_success_alert">
            <div class="user_success_alert_ic_red">
                <i class="fa fa-times"></i> <?=$diller['uyelik-sifre-hata']?>
            </div>
        </div>
        <meta http-equiv="refresh" content="2; URL=<?=$siteurl?>uyelik/sifre-degistir">
        <?php unset($_SESSION['kayit_hata']);?>
    <?php }?>
    <?php
    if (isset($_SESSION['kayit_hata']) && $_SESSION['kayit_hata'] == 'sifreleresitdegil') {
        ?>
        <div class="user_success_alert">
            <div class="user_success_alert_ic_red">
                <i class="fa fa-times"></i> <?=$diller['uyelik-sifre-hata-2']?>
            </div>
        </div>
        <meta http-equiv="refresh" content="2; URL=<?=$siteurl?>uyelik/sifre-degistir">
        <?php unset($_SESSION['kayit_hata']);?>
    <?php }?>
    <?php
    if (isset($_SESSION['kayit_hata']) && $_SESSION['kayit_hata'] == 'eskiyenisorun') {
        ?>
        <div class="user_success_alert">
            <div class="user_success_alert_ic_red">
                <i class="fa fa-times"></i> <?=$diller['uyelik-sifre-hata-3']?>
            </div>
        </div>
        <meta http-equiv="refresh" content="2; URL=<?=$siteurl?>uyelik/sifre-degistir">
        <?php unset($_SESSION['kayit_hata']);?>
    <?php }?>
<title><?php echo ucwords_tr($diller['uyepanel-sifredegis']) ?> | <?php echo $ayar['site_baslik']?></title>
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



            <div class="user-right-haed">
                <i class="fa fa-key"></i> <?=$diller['uyepanel-sifredegis']?>
            </div>
            <div class="user-right-content-inside">





                    <div class="user-right-form-area">
                        <form method="post" action="">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="eskisifre"><?=$diller['uyelik-sifre-eski']?></label>
                                    <input type="password" name="eskisifre" class="form-control" id="eskisifre" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="yenisifre"><?=$diller['uyelik-sifre-yeni']?></label>
                                    <input type="password" name="yenisifre" class="form-control" id="yenisifre" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="yenisifre_tekrar"><?=$diller['uyelik-sifre-yeni-tekrar']?></label>
                                    <input type="password" name="yenisifre_tekrar" class="form-control" id="yenisifre_tekrar" required>
                                </div>
                            </div>
                            <button type="submit" name="updatepassword" class="btn btn-primary"><i class="fa fa-refresh"></i> <?=$diller['uyelik-guncelle-button']?></button>
                        </form>
                    </div>

                <div class="user-right-other-area" style="background-color: #659bff; color:#FFF; border-color:#3c6eff; font-size:14px; font-weight: 500">
                    <i class="fa fa-info-circle"></i><br>
                    <?=$diller['uyelik-sifre-aciklama']?>
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