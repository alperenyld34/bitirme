<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php //TODO BU SAYFA VAR


$page_header_setting = $db->prepare("select * from page_header where page_id='offer' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<title><?php echo ucwords_tr($diller['teklif-form-baslik']) ?> | <?php echo $ayar['site_baslik']?></title>
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
<style>
    .form-group{
        font-family: 'Open Sans', Arial;
        font-size: 14px ;
        font-weight: 600;
    }
</style>
<div class="human-resource-page-main">



    <div class="human-resource-page-baslik">
        <div class="catalog-page-baslik-head font-open-sans font-24 font-bold">
            <?php echo ucwords_tr($diller['teklif-form-baslik']) ?>
        </div>
        <div class="human-resource-page-baslik-head font-open-sans font-14">
            <?php echo $diller['teklif-form-aciklama'] ?>
        </div>


    </div><div class="human-resource-page-content"><div class="human-resource-page-content-form">

            <form method="post" action="offerpost" enctype="multipart/form-data">


                <div class="form-row">

                    <div class="form-group col-md-6 ">
                        <label for="inputnName"><?=$diller['teklif-form-isim']?></label>
                        <input type="text" name="ad_soyad" class="form-control" id="inputnName" style="border-radius: 0" required >
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="eposta"><?=$diller['teklif-form-eposta']?></label>
                        <input type="email" name="eposta" class="form-control" id="eposta" style="border-radius: 0" required >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 ">
                        <label for="telefon"><?=$diller['teklif-form-tel']?></label>
                        <input type="number" name="telefon" class="form-control" id="telefon"  style="border-radius: 0" required>
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="teklif_konu"><?=$diller['teklif-form-konu']?></label>
                        <input type="text" name="teklif_konu" class="form-control" id="teklif_konu"   style="border-radius: 0"required>
                    </div>
                </div>


                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="firma_bilgileri"><?=$diller['teklif-form-firma-bilgi']?></label>
                        <textarea class="form-control" id="firma_bilgileri" rows="2"  name="firma_bilgileri" style="border-radius: 0"required ></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="textareaBilgi"><?=$diller['teklif-form-icerik']?></label>
                        <textarea class="form-control" id="textareaBilgi" rows="4"  name="icerik" style="border-radius: 0"required></textarea>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-12 ">
                        <label for="dosya"><?=$diller['teklif-form-dosya']?> <span style="color: red; font-size: 11px;">(JPG,PNG,GIF,PDF,WORD)</span></label>
                        <input type="file" name="dosya" class="form-control" id="dosya" style="padding: 10px; height: auto; border-radius: 0"   >
                    </div>
                </div>

                <?php
                if($ayar['site_captcha'] == 1)
                {
                ?>
                <!-- GÜVENLİK CAPTCHA ========== !-->
                <div class="form-row">

                  <?php $kod=$_SESSION['secure_code'];?>



                    <div class="form-group col-md-4 ">
                        <label for="inputCaptcha"><?=$diller['guvenlik-kodu']?></label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img src='includes/template/captcha.php'/></div>
                            </div>
                            <input type="text" class="form-control form-captcha-height" id="inputCaptcha"   name="secure_code" maxlength="5" required >
                        </div>
                    </div>

                </div>
                <!-- GÜVENLİK CAPTCHA ========== !-->
                <?php }?>

                <button type="submit" name="offerbutton" class="btn btn-danger"><?=$diller['teklif-form-gonder-button']?></button>
            </form>


        </div></div>



</div>

<!-- CONTENT AREA ============== !-->



<?php
if($_SESSION['teklif_sonuc'] == 'secure') {
?>
    <script>
        $(document).ready(function () {
            swal({
                title: "<?=$diller['post-hata']?>",
                text: "<?=$diller['post-guvenlik-kod-hata']?>",
                type: "warning",
                showConfirmButton: true,
                confirmButtonText:"<?=$diller['button-tamam']?>",
            });
        });
    </script>
    <?php unset($_SESSION['teklif_sonuc']); ?>
<?php }?>
<?php
if($_SESSION['teklif_sonuc'] == 'dosyatip') {
    ?>
    <script>
        $(document).ready(function () {
            swal({
                title: "<?=$diller['post-hata']?>",
                text: "<?=$diller['teklif-form-hatali-dosya-tipi']?>",
                type: "warning",
                showConfirmButton: true,
                confirmButtonText:"<?=$diller['button-tamam']?>",
            });
        });
    </script>
    <?php unset($_SESSION['teklif_sonuc']); ?>
<?php }?>
<?php if($_SESSION['teklif_sonuc'] == 'bos') {?>
    <script>
        $(document).ready(function () {
            swal({
                title: "<?=$diller['post-hata']?>",
                text: "<?=$diller['form-eksik-alan']?>",
                type: "warning",
                timer: '4500',
                showConfirmButton: true,
                confirmButtonText:"<?=$diller['button-tamam']?>",
            });
        });
    </script>
    <?php unset($_SESSION['teklif_sonuc']); ?>
<?php }?>
<?php
if($_SESSION['teklif_sonuc'] == 'eposta') {?>
    <script>
        $(document).ready(function () {
            swal({
                title: "<?=$diller['post-hata']?>",
                text: "<?=$diller['teklif-form-hatali-eposta-uyari']?>",
                type: "warning",
                showConfirmButton: true,
                confirmButtonText:"<?=$diller['button-tamam']?>",
            });
        });
    </script>
    <?php unset($_SESSION['teklif_sonuc']); ?>
<?php }?>


<?php
if($_SESSION['teklif_sonuc'] == 'success') {?>
    <script>
        $(document).ready(function () {
            swal({
                title: "<?=$diller['post-basarili']?>",
                text: "<?=$diller['teklif-form-basarili-yazisi']?>",
                type: "success",
                showConfirmButton: true,
                confirmButtonText:"<?=$diller['button-tamam']?>",
            });
        });
    </script>
    <?php unset($_SESSION['teklif_sonuc']); ?>
<?php }?>



<?php include 'includes/template/footer.php'?>
</body>
</html>
<?php include "includes/config/footer_libs.php";?>

