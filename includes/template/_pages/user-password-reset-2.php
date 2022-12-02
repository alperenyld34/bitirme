<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
if ($userSorgusu->rowCount() <=0 ) {
?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='uyeler' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php if($_GET['key'] == !null  ) {

        if( $_GET['key'] == $_SESSION['epostareset'] ) {

    ?>
<title><?php echo ucwords_tr($diller['uyelik-sifre-sifirla-title']) ?> | <?php echo $ayar['site_baslik']?></title>
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
           <?=$diller['uyelik-sifre-sifirla-title']?>
        </div>

        <div class="login-form-container">


            <form action="resetchangepassword" method="post" >
            <label for="newpass" >* <?=$diller['uyelik-sifre-yeni']?></label>
            <br>
            <input type="password" name="newpass" id="newpass" required style="width: 100%" >
                <br><br>
            <button name="reset" class="btn btn-primary" style="font-family: 'Open Sans', Arial; font-weight: 600; font-size:14px; padding: 10px 25px"><?=$diller['uyepanel-sifredegis']?></button>
            <div style="clear: both; margin-bottom: 18px"></div>

            </form>

            <?php if (isset($_SESSION['uyegiris_sorun'])) { ?>
            <div class="alert alert-danger aler">
                <?=$_SESSION['uyegiris_sorun']?>
                <?php unset($_SESSION['uyegiris_sorun'])?>
            </div>
            <?php }?>

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
if($_SESSION['bos'] == 'bos' ){?>
    <script>
        $(document).ready(function () {
            swal({
                title: "<?=$diller['post-hata']?>",
                text: "<?=$diller['uyelik-destek-mesaj-hat-yazisi']?>",
                type: "warning",
                timer: '3500',
                showConfirmButton: true,
                confirmButtonText:"<?=$diller['button-tamam']?>",
            });
        });
    </script>
    <?php unset($_SESSION['bos']); ?>
<?php }?>

<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>
        <?php } else{
            header('Location:404');
        }?>
    <?php } else{
        header('Location:404');
    }?>
<?php } else {
  header('Location:404');
}
?>