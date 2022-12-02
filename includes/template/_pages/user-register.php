<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
if ($userSorgusu->rowCount() <=0 ) {
?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='uyeler' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);

$registerSozlesme = $db->prepare("select * from uyeler_sozlesme where dil=:dil and durum=:durum order by id desc");
$registerSozlesme->execute(array(
        'dil' =>  $_SESSION['dil'],
        'durum' => '1'
));
$uyesozlesme = $registerSozlesme->fetch(PDO::FETCH_ASSOC);
?>
<title><?php echo ucwords_tr($diller['yeni-uyelik-sayfa-baslik']) ?> | <?php echo $ayar['site_baslik']?></title>
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

<div class="catalog-page-main">



    <div class="user-register-content">



        <div  class="user-login-head font-open-sans font-24 font-bold" style="text-align: left">
           <i class="ion-person-add"></i> <?php echo ucwords_tr($diller['yeni-uyelik-sayfa-baslik']) ?>
        </div>

        <div class="register-form-container">

            <?php if (isset($_SESSION['uyelik_sorun'])) { ?>
                <div class="alert alert-danger">
                    <?=$_SESSION['uyelik_sorun']?>
                    <?php unset($_SESSION['uyelik_sorun'])?>
                </div>
            <?php }?>
            <form action="registering" method="post" >

                <label for="namearea" >* <?=$diller['yeni-uyelik-isim']?></label>
                <br>
                <input type="text" name="namearea" id="namearea"  required  >
                <br><br>

                <label for="surnamearea" >* <?=$diller['yeni-uyelik-soyisim']?></label>
                <br>
                <input type="text" name="surnamearea" id="surnamearea"  required >
                <br><br>

                <label for="phonearea" >* <?=$diller['yeni-uyelik-telefon']?></label>
                <br>
                <input type="number" name="phonearea" id="phonearea"  required >
                <br><br>

            <label for="emailarea" >* <?=$diller['yeni-uyelik-eposta']?></label>
            <br>
            <input type="text" name="emailarea" id="emailarea" required  >
            <br><br>

            <label for="password">* <?=$diller['yeni-uyelik-sifre']?></label>
            <br>
            <input type="password" name="password" id="password"  required >
                <br><br>

                <label for="passwordverify">* <?=$diller['yeni-uyelik-sifre-tekrar']?></label>
                <br>
                <input type="password" name="passwordverify" id="passwordverify" required  >
                <br><br>

                <label for="tcnumber"><?=$diller['yeni-uyelik-tc']?></label>
                <br>
                <input type="number" name="tcnumber" id="tcnumber"  >
                <br><br>

                <label for="cinsiyet"><?=$diller['yeni-uyelik-cinsiyet']?></label>
                <br>
                <select name="cinsiyet" id="cinsiyet">
                    <option value="Erkek"><?=$diller['yeni-uyelik-erkek']?></option>
                    <option value="Kadın"><?=$diller['yeni-uyelik-kadin']?></option>
                </select>

                <?php
                if($ayar['site_captcha'] == 1)
                {
                    ?><br><br>
                    <!-- GÜVENLİK CAPTCHA ========== !-->
                    <div class="form-row">


                        <?php $kod=$_SESSION['secure_code'];?>



                        <div class="form-group col-md-5 ">
                            <label for="inputCaptcha"><?=$diller['guvenlik-kodu']?></label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img src='includes/template/captcha.php'/></div>
                                </div>
                                <input type="text" class="form-control form-captcha-height" id="inputCaptcha"  required name="secure_code" maxlength="5" >
                            </div>
                        </div>

                    </div>
                    <!-- GÜVENLİK CAPTCHA ========== !-->
                <?php }?>

            <div class="user-remember-area">
                <?php if ($registerSozlesme->rowCount() > 0) { ?>
                    <input type="checkbox" id="remember" name="sozlesmeonay" required ><label for="remember"><strong><?=$diller['yeni-uyelik-sozlesme']?></strong></label>
                <?php }?>
            </div>

            <button name="usersave" class="btn btn-primary" style="font-family: 'Open Sans', Arial; font-weight: 600; font-size:14px; padding: 10px 25px"><?=$diller['yeni-uyelik-button']?></button>
            <div style="clear: both; margin-bottom: 18px"></div>

            </form>



        </div>




    </div><?php if ($registerSozlesme->rowCount() > 0) { ?><div class="user-register-right">
        <div  class="user-login-head font-open-sans font-24 font-bold" style="text-align: left">
            <?=$diller['uyelik-sozlesmesi']?>
        </div>

        <div class="register-form-sozlesme">
            <?=$uyesozlesme['icerik']?>
        </div>


    </div><?php }?>






</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

<?php } else {
  header('Location:index.html');
}
?>