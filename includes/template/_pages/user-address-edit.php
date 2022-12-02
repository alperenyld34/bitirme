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
    $current_page = 'adres'
    ?>
    <?php
    if (isset($_POST['updateaddress'])) {

        $rand_id = rand(0,(int) 99999999);

        $baslik = trim(strip_tags($_POST['baslik']));
        $sehir = trim(strip_tags($_POST['sehir']));
        $ilce = trim(strip_tags($_POST['ilce']));
        $postakodu = trim(strip_tags($_POST['posta_kodu']));
        $adres = trim(strip_tags($_POST['adres']));
        $adres_fatura = trim(strip_tags($_POST['adres_fatura']));

        if ($baslik && $sehir && $ilce && $postakodu && $adres && $adres_fatura){

            $adreskaydet = $db->prepare("UPDATE uyeler_adres set 
            baslik=:baslik,
            sehir=:sehir,
            ilce=:ilce,
            posta_kodu=:posta_kodu,
            adres=:adres,
            fatura_adres=:fatura_adres
            WHERE adres_id={$_POST['address_id']}
            ");
           $sonuc= $adreskaydet->execute(array(
               'baslik' => $baslik,
               'sehir' => $sehir,
               'ilce' => $ilce,
               'posta_kodu' => $postakodu,
                'adres' => $adres,
                'fatura_adres' => $adres_fatura
            ));
           if ($sonuc) {

               $_SESSION['basarili_guncelleme'] = 'success';

           }else{
               echo 'Veritabanı hatası ';
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
                <i class="fa fa-check"></i> <?=$diller['uyelik-adres-guncelle-basarili']?>
            </div>
        </div>
        <meta http-equiv="refresh" content="2; URL=<?=$siteurl?>uyelik/kayitli-adresler">
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
        <meta http-equiv="refresh" content="2; URL=<?=$siteurl?>uyelik/kayitli-adresler">
        <?php unset($_SESSION['kayit_hata']);?>
    <?php }?>
    <?php
        $adres_id = $_GET['address_id'];
        $adresCek = $db->prepare("select * from uyeler_adres where uye_id=:uye_id and adres_id=:adres_id");
        $adresCek->execute(array(
           'uye_id' => $userCek['id'],
           'adres_id' => $adres_id
        ));
        $row = $adresCek->fetch(PDO::FETCH_ASSOC);
    ?>
<title><?php echo ucwords_tr($diller['uyelik-adres-duzenle']) ?> | <?php echo $ayar['site_baslik']?></title>
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

<div class="users-page-main" style="background-color: #FFF; width:<?php if($pagehead['width']==1){?> 90%; <?php }else {?> 100% <?php }?> ;" >










    <div class="user-content-area">


        <?php include'includes/template/user-leftbar.php'; ?>

        <div class="user-right-content">


            <a href="uyelik/kayitli-adresler" class="btn btn-sm btn-dark"><i class="fa fa-arrow-left"></i> <?=$diller['uyelik-geridon-button-yazisi']?></a>
            <br><br>

            <div class="user-right-haed">
                <i class="ion-ios-location"></i> <?=$diller['uyelik-adres-duzenle']?>
            </div>
            <div class="user-right-content-inside">


                    <div class="user-right-form-area" style="width: 100%">
                        <form method="post" action="">
                            <input type="hidden" name="address_id" value="<?=$_GET['address_id']?>">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="baslik"><?=$diller['uyelik-adres-basligi']?></label>
                                    <input type="text" name="baslik" class="form-control" id="baslik" value="<?=$row['baslik']?>" required>
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label for="sehir"><?=$diller['uyelik-adres-sehir']?></label>
                                    <select name="sehir"  class="form-control" id="sehir" required>
                                        <option value="<?=$row['sehir']?>"><?=$row['sehir']?></option>
                                        <option value="Adana">Adana</option>
                                        <option value="Adıyaman">Adıyaman</option>
                                        <option value="Afyonkarahisar">Afyonkarahisar</option>
                                        <option value="Ağrı">Ağrı</option>
                                        <option value="Amasya">Amasya</option>
                                        <option value="Ankara">Ankara</option>
                                        <option value="Antalya">Antalya</option>
                                        <option value="Artvin">Artvin</option>
                                        <option value="Aydın">Aydın</option>
                                        <option value="Balıkesir">Balıkesir</option>
                                        <option value="Bilecik">Bilecik</option>
                                        <option value="Bingöl">Bingöl</option>
                                        <option value="Bitlis">Bitlis</option>
                                        <option value="Bolu">Bolu</option>
                                        <option value="Burdur">Burdur</option>
                                        <option value="Bursa">Bursa</option>
                                        <option value="Çanakkale">Çanakkale</option>
                                        <option value="Çankırı">Çankırı</option>
                                        <option value="Çorum">Çorum</option>
                                        <option value="Denizli">Denizli</option>
                                        <option value="Diyarbakır">Diyarbakır</option>
                                        <option value="Edirne">Edirne</option>
                                        <option value="Elazığ">Elazığ</option>
                                        <option value="Erzincan">Erzincan</option>
                                        <option value="Erzurum">Erzurum</option>
                                        <option value="Eskişehir">Eskişehir</option>
                                        <option value="Gaziantep">Gaziantep</option>
                                        <option value="Giresun">Giresun</option>
                                        <option value="Gümüşhane">Gümüşhane</option>
                                        <option value="Hakkâri">Hakkâri</option>
                                        <option value="Hatay">Hatay</option>
                                        <option value="Isparta">Isparta</option>
                                        <option value="Mersin">Mersin</option>
                                        <option value="İstanbul">İstanbul</option>
                                        <option value="İzmir">İzmir</option>
                                        <option value="Kars">Kars</option>
                                        <option value="Kastamonu">Kastamonu</option>
                                        <option value="Kayseri">Kayseri</option>
                                        <option value="Kırklareli">Kırklareli</option>
                                        <option value="Kırşehir">Kırşehir</option>
                                        <option value="Kocaeli">Kocaeli</option>
                                        <option value="Konya">Konya</option>
                                        <option value="Kütahya">Kütahya</option>
                                        <option value="Malatya">Malatya</option>
                                        <option value="Manisa">Manisa</option>
                                        <option value="Kahramanmaraş">Kahramanmaraş</option>
                                        <option value="Mardin">Mardin</option>
                                        <option value="Muğla">Muğla</option>
                                        <option value="Muş">Muş</option>
                                        <option value="Nevşehir">Nevşehir</option>
                                        <option value="Niğde">Niğde</option>
                                        <option value="Ordu">Ordu</option>
                                        <option value="Rize">Rize</option>
                                        <option value="Sakarya">Sakarya</option>
                                        <option value="Samsun">Samsun</option>
                                        <option value="Siirt">Siirt</option>
                                        <option value="Sinop">Sinop</option>
                                        <option value="Sivas">Sivas</option>
                                        <option value="Tekirdağ">Tekirdağ</option>
                                        <option value="Tokat">Tokat</option>
                                        <option value="Trabzon">Trabzon</option>
                                        <option value="Tunceli">Tunceli</option>
                                        <option value="Şanlıurfa">Şanlıurfa</option>
                                        <option value="Uşak">Uşak</option>
                                        <option value="Van">Van</option>
                                        <option value="Yozgat">Yozgat</option>
                                        <option value="Zonguldak">Zonguldak</option>
                                        <option value="Aksaray">Aksaray</option>
                                        <option value="Bayburt">Bayburt</option>
                                        <option value="Karaman">Karaman</option>
                                        <option value="Kırıkkale">Kırıkkale</option>
                                        <option value="Batman">Batman</option>
                                        <option value="Şırnak">Şırnak</option>
                                        <option value="Bartın">Bartın</option>
                                        <option value="Ardahan">Ardahan</option>
                                        <option value="Iğdır">Iğdır</option>
                                        <option value="Yalova">Yalova</option>
                                        <option value="Karabük">Karabük</option>
                                        <option value="Kilis">Kilis</option>
                                        <option value="Osmaniye">Osmaniye</option>
                                        <option value="Düzce">Düzce</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="ilce"><?=$diller['uyelik-adres-ilce']?></label>
                                    <input type="text" name="ilce" class="form-control" id="ilce" value="<?=$row['ilce']?>"  required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="posta_kodu"><?=$diller['uyelik-adres-postakodu']?></label>
                                    <input type="text" name="posta_kodu" class="form-control" id="posta_kodu" value="<?=$row['posta_kodu']?>"  required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="adres"><?=$diller['uyelik-adres-adres']?></label>
                                    <textarea name="adres" id="adres" class="form-control" required rows="3"><?=$row['adres']?></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="adres_fatura"><?=$diller['uyelik-adres-adres-fatura']?></label>
                                    <textarea name="adres_fatura" id="adres_fatura"  class="form-control" required rows="3"><?=$row['fatura_adres']?></textarea>
                                </div>
                            </div>

                            <button type="submit" name="updateaddress" class="btn btn-primary"><i class="fa fa-refresh"></i> <?=$diller['uyelik-adres-duzenle-button']?></button>
                        </form>
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