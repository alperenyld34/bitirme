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
    $current_page = 'hesap'
    ?>
    <?php
    if (isset($_POST['updateuser'])) {

        $isim = trim(strip_tags($_POST['isim']));
        $eposta = trim(strip_tags($_POST['eposta']));
        $soyisim = trim(strip_tags($_POST['soyisim']));
        $telefon = trim(strip_tags($_POST['telefon']));
        $tcno = trim(strip_tags($_POST['tcno']));
        $cinsiyet = trim(strip_tags($_POST['cinsiyet']));

        if ($isim && $soyisim && $eposta && $telefon) {
            /* Geçrli eposta kontrolü */
                if (filter_var($eposta, FILTER_VALIDATE_EMAIL)){
                    /* E-posta var mı Kontrolü */
                        $epostaCek = $db->prepare("select * from uyeler where eposta=:eposta and not id=:id");
                        $epostaCek->execute(array(
                                'eposta' => $eposta,
                                'id' => $userCek['id']
                        ));
                        if ($epostaCek->rowCount() <=0){
                            /* Güncelleme işlemi */
                            $guncelle = $db->prepare(
                                    "UPDATE uyeler SET 
                            isim=:isim,
                            soyisim=:soyisim,
                            eposta=:eposta,
                            telefon=:telefon,
                            tcno=:tcno,
                            cinsiyet=:cinsiyet
                            WHERE id={$userCek['id']}
");
                            $kaydet = $guncelle->execute(array(
                                   'isim' => $isim,
                                    'soyisim' => $soyisim,
                                    'eposta' => $eposta,
                                    'telefon' => $telefon,
                                    'tcno' => $tcno,
                                    'cinsiyet' => $cinsiyet
                            ));
                            if ($kaydet){
                                $_SESSION['user_email_address'] = $eposta;
                                $_SESSION['basarili_guncelleme'] = 'success';
                            }else{
                                echo'Veritabanı Hatası!';
                            }
                        }else{
                            $_SESSION['kayit_hata'] = 'epostavarsorun';
                        }
                }else{
                    $_SESSION['kayit_hata'] = 'epostasorun';
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
        <meta http-equiv="refresh" content="1; URL=<?=$siteurl?>uyelik/hesap-bilgileri">
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
        <meta http-equiv="refresh" content="2; URL=<?=$siteurl?>uyelik/hesap-bilgileri">
        <?php unset($_SESSION['kayit_hata']);?>
    <?php }?>
    <?php
    if (isset($_SESSION['kayit_hata']) && $_SESSION['kayit_hata'] == 'epostasorun') {
        ?>
        <div class="user_success_alert">
            <div class="user_success_alert_ic_red">
                <i class="fa fa-times"></i> <?=$diller['uyelik-gecersiz-eposta']?>
            </div>
        </div>
        <meta http-equiv="refresh" content="2; URL=<?=$siteurl?>uyelik/hesap-bilgileri">
        <?php unset($_SESSION['kayit_hata']);?>
    <?php }?>
    <?php
    if (isset($_SESSION['kayit_hata']) && $_SESSION['kayit_hata'] == 'epostavarsorun') {
        ?>
        <div class="user_success_alert">
            <div class="user_success_alert_ic_red">
                <i class="fa fa-times"></i> <?=$diller['uyelik-eposta-mevcut']?>
            </div>
        </div>
        <meta http-equiv="refresh" content="2; URL=<?=$siteurl?>uyelik/hesap-bilgileri">
        <?php unset($_SESSION['kayit_hata']);?>
    <?php }?>
<title><?php echo ucwords_tr($diller['uyepanel-hesap']) ?> | <?php echo $ayar['site_baslik']?></title>
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

<div class="users-page-main" " >










    <div class="user-content-area">


        <?php include'includes/template/user-leftbar.php'; ?>

        <div class="user-right-content">



            <div class="user-right-haed">
                <i class="ion-person"></i> <?=$diller['uyepanel-hesap']?>
            </div>
            <div class="user-right-content-inside">


                    <div class="user-right-form-area">
                        <form method="post" action="">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="isim"><?=$diller['yeni-uyelik-isim']?></label>
                                    <input type="text" name="isim" class="form-control" id="isim" value="<?=$userCek['isim']?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="soyisim"><?=$diller['yeni-uyelik-soyisim']?></label>
                                    <input type="text" name="soyisim" class="form-control" id="soyisim" value="<?=$userCek['soyisim']?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="eposta"><?=$diller['yeni-uyelik-eposta']?></label>
                                    <input type="email" name="eposta" class="form-control" id="eposta" value="<?=$userCek['eposta']?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="telefon"><?=$diller['yeni-uyelik-telefon']?></label>
                                    <input type="number" name="telefon" class="form-control" value="<?=$userCek['telefon']?>" id="telefon" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tcno"><?=$diller['yeni-uyelik-tc']?></label>
                                    <input type="number" name="tcno" class="form-control" value="<?=$userCek['tcno']?>" id="tcno" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cinsiyet"><?=$diller['yeni-uyelik-cinsiyet']?></label>
                                    <select name="cinsiyet" id="cinsiyet" class="form-control">
                                        <option value="Erkek" <?php if ($userCek['cinsiyet'] == 'Erkek') { ?> selected <?php }?> ><?=$diller['yeni-uyelik-erkek']?></option>
                                        <option value="Kadın" <?php if ($userCek['cinsiyet'] == 'Kadın') { ?> selected <?php }?> ><?=$diller['yeni-uyelik-kadin']?></option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="updateuser" class="btn btn-primary"><i class="fa fa-refresh"></i> <?=$diller['uyelik-guncelle-button']?></button>
                        </form>
                    </div>


                    <div class="user-right-other-area">
                        <i class="fa fa-key"></i>
                        <br>
                        <a style="color:#000" href="uyelik/sifre-degistir"><?=$diller['uyelik-sifre-degistir']?></a>
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