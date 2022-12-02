<?php include 'includes/config/session.php'; ?>
<?php
if ($bakim['durum'] == 1 ) {
    header("Location:$ayar[site_url]bakimdayiz");
}
?>
<!doctype html>
<html lang="<?=$current_lang['kisa_ad']?>">
<head>
    <base href="<?php echo"$ayar[site_url]"?>">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $ayar['site_baslik']?></title>
    <meta name="description" content="<?php echo"$ayar[site_desc]" ?>">
    <meta name="author" content="<?php echo"$ayar[site_baslik]" ?>" />
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website" />
    <?php include "includes/config/header_libs.php";?>
</head>
<body>
<?php include 'includes/template/header.php'?>
<?php include 'includes/template/modules.php'?>
<?php include 'includes/template/footer.php'?>
<?php if (isset($_SESSION['uyelik_basarili'])) { ?>
    <script>
        $(document).ready(function () {
            swal({
                title: "<?=$diller['yeni-uyelik-basarili']?>",
                text: "<?=$diller['yeni-uyelik-basarili-aciklama']?>",
                type: "success",
                showConfirmButton: true,
                confirmButtonText:"<?=$diller['button-tamam']?>",
            });
        });
    </script>
<?php unset($_SESSION['uyelik_basarili']);?>
<?php }?>
</body>
</html>
<?php include "includes/config/footer_libs.php";?>