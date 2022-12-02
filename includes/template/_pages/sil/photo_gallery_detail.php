<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='foto' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
$gal_id = $_GET['gal_id'];
$galeri_kat = $db->prepare("select * from galeri_kat where id=:id and durum=:durum and dil=:dil");
$galeri_kat->execute(array(
    'id' => $gal_id,
    'durum' => 1,
    'dil' => $_SESSION['dil']
));
$galeri = $galeri_kat->fetch(PDO::FETCH_ASSOC);

$foto_liste=$db->prepare("select * from galeri_resim where kat_id='$gal_id' order by sira asc");
$foto_liste->execute();
?>
<?php
if($galeri_kat->rowCount() == 0)
{
    header('Location:'.$siteurl.'');

    exit;

}
?>
<title><?php echo ucwords_tr($galeri['baslik']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$galeri[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$galeri[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$galeri[tags]" ?>">
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

<div class="photogallery-page-main">



    <div class="photogallery-detail-content">

        <div class="photogallery-page-baslik font-open-sans font-30 font-bold">

            <img src="images/gallery_icn.png" alt="Galeri"> <?php echo ucwords_tr($galeri['baslik']) ?>

        </div>



        <div class="photogallery-page-content" id="portfolio">


            <?php foreach($foto_liste as $foto) { ?>
            <div class="photogallery-detail-box">
                <a href="images/gallery/<?php echo $foto['gorsel'] ?>">
                <img src="images/gallery/<?=$foto['gorsel']?>" alt="<?=$foto['baslik']?>">
                </a>
            </div>
            <?php }?>



            <?php if ($foto_liste->rowCount() <= 0) { ?>

                <div class="alert alert-secondary" role="alert">
                    Henüz bu galeriye fotoğraf eklenmemiş!
                </div>

            <?php } ?>



        </div>

    </div>






</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

