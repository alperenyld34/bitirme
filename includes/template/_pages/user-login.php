<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
if ($userSorgusu->rowCount() <=0 ) {
?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='uyeler' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>

<title><?php echo ucwords_tr($diller['uyelik-giris-sayfa-baslik']) ?> | <?php echo $ayar['site_baslik']?></title>
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



    <div class="user-login-content">



        <div  class="user-login-head font-open-sans font-24 font-bold">
           <i class="ion-unlocked"></i> <?=$diller['uye-girisi']?>
        </div>

        <div class="login-form-container">


            <form action="logining" method="post" >
            <label for="username" >* <?=$diller['uye-girisi-eposta']?></label>
            <br>
            <input type="email" name="emailadress" id="username" required  >
            <br><br>
            <label for="password">* <?=$diller['uye-girisi-sifre']?></label>
            <br>
            <input type="password" name="password" id="password" required >
            <div class="user-remember-area">
                <input type="checkbox" id="remember"><label for="remember"><?=$diller['uye-girisi-hatirla']?></label>
                <a href="sifremi-unuttum" ><?=$diller['uye-girisi-unuttum']?></a>
            </div>
            <button name="userlogin" class="btn btn-primary" style="font-family: 'Open Sans', Arial; font-weight: 600; font-size:14px; padding: 10px 25px"><?=$diller['uye-girisi-button']?></button>
            <div style="clear: both; margin-bottom: 18px"></div>

            </form>

            <?php if (isset($_SESSION['uyegiris_sorun'])) { ?>
            <div class="alert alert-danger aler">
                <?=$_SESSION['uyegiris_sorun']?>
                <?php unset($_SESSION['uyegiris_sorun'])?>
            </div>
            <?php }?>

        </div>




    </div><div class="user-login-right" style="margin-right: 0">
        <div class="catalog-page-baslik-head font-open-sans font-20 font-bold" style="margin-bottom: 15px">
            <?=$diller['uyelik-giris-sayfa-uyelik-baslik']?>
        </div>
        <div class="catalog-page-baslik-head font-open-sans font-14" style="margin-bottom: 0">
            <?=$diller['uyelik-giris-sayfa-uyelik-aciklama']?>
            <br><br>
            <a href="uyelik" class="btn btn-lg btn-success" style="font-family: 'Open Sans', Arial; font-size:14px; font-weight: 600; width: 100%"><i class="ion-person-add"></i> <?=$diller['hemen-uye-olun']?></a>
        </div>
    </div>



</div>

<!-- CONTENT AREA ============== !-->

<?php
if($_SESSION['cgpass'] == 'success' ){?>
    <script>
        $(document).ready(function () {
            swal({
                title: "<?=$diller['uyelik-sifemi-unuttum-basarili-baslik']?>",
                text: "Şifreniz oluşturulmuştur. Üye girişi yapabilirsiniz",
                type: "success",
                showConfirmButton: true,
                confirmButtonText:"<?=$diller['button-tamam']?>",
            });
        });
    </script>
    <?php unset($_SESSION['cgpass']); ?>
<?php }?>

<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

<?php } else {
  header('Location:index.html');
}
?>