<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
if ($userSorgusu->rowCount() <=0 ) {
?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='uyeler' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<title><?php echo ucwords_tr($diller['uye-girisi-unuttum']) ?> | <?php echo $ayar['site_baslik']?></title>
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
           <i class="fa fa-key"></i> <?=$diller['uye-girisi-unuttum']?>
        </div>

        <div class="login-form-container">


            <form action="rememberpassword" method="post" >
            <label for="username" >* <?=$diller['uye-girisi-eposta']?></label>
            <br>
            <input type="email" name="emailadress" id="username" required  >
                <br><br>
            <button name="reset" class="btn btn-primary" style="font-family: 'Open Sans', Arial; font-weight: 600; font-size:14px; padding: 10px 25px"><?=$diller['reset-my-password']?></button>
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
          <i class="fa fa-info-circle"></i> <?=$diller['uyelik-sifemi-unuttum-bilgi']?>
        </div>
        <div class="catalog-page-baslik-head font-open-sans font-13" style="margin-bottom: 0">
            <?=$diller['uyelik-sifemi-unuttum-bilgi-aciklama']?>
        </div>
    </div>



</div>

<!-- CONTENT AREA ============== !-->
<?php
if($_SESSION['successpost'] == 'suc' ){?>
    <script>
        $(document).ready(function () {
            swal({
                title: "<?=$diller['uyelik-sifemi-unuttum-basarili-baslik']?>",
                text: "<?=$diller['uyelik-sifemi-unuttum-basarili-aciklama']?>",
                type: "success",
                showConfirmButton: true,
                confirmButtonText:"<?=$diller['button-tamam']?>",
            });
        });
    </script>
    <?php unset($_SESSION['successpost']); ?>
<?php }?>
<?php
if($_SESSION['successpost'] == 'problem' ){?>
    <script>
        $(document).ready(function () {
            swal({
                title: "HATA",
                text: "Bir Takım İşlemler Ters Gitti!",
                type: "warning",
                timer: '3500',
                showConfirmButton: true,
                confirmButtonText:"<?=$diller['button-tamam']?>",
            });
        });
    </script>
    <?php unset($_SESSION['successpost']); ?>
<?php }?>
<?php
if($_SESSION['hata'] == 'hata' ){?>
    <script>
        $(document).ready(function () {
            swal({
                title: "<?=$diller['post-hata']?>",
                text: "<?=$diller['uyelik-gecersiz-eposta']?>",
                type: "warning",
                timer: '3500',
                showConfirmButton: true,
                confirmButtonText:"<?=$diller['button-tamam']?>",
            });
        });
    </script>
    <?php unset($_SESSION['hata']); ?>
<?php }?>
<?php
if($_SESSION['hata'] == 'epostayok' ){?>
    <script>
        $(document).ready(function () {
            swal({
                title: "<?=$diller['post-hata']?>",
                text: "E-Posta Adresi Bulunamadı!",
                type: "warning",
                timer: '3500',
                showConfirmButton: true,
                confirmButtonText:"<?=$diller['button-tamam']?>",
            });
        });
    </script>
    <?php unset($_SESSION['hata']); ?>
<?php }?>

<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

<?php } else {
  header('Location:404');
}
?>