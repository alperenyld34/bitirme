<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='video' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
$vid_id = $_GET['vid_id'];
$videolar = $db->prepare("select * from video where id=:id and durum=:durum and dil=:dil");
$videolar->execute(array(
        'id' => $vid_id,
        'durum' => '1',
    'dil' => $_SESSION['dil']
));
$video = $videolar->fetch(PDO::FETCH_ASSOC);
$etiketler = $video['tags'];
$etiketler = explode(',', $etiketler);

$video_hits = $db->prepare("UPDATE video SET hit = hit+1 WHERE id=:id  ");
$video_hits->execute(array(
        'id' => $vid_id
));
?>
<?php
if($videolar->rowCount() == 0)
{
    header('Location:'.$siteurl.'');

    exit;

}
?>
<title><?php echo ucwords_tr($video['baslik']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$video[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$video[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$video[tags]" ?>">
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

<div class="videogallery-page-main">



    <div class="videogallery-page-text-main">

        <div class="videogallery-page-baslik font-open-sans font-30 font-bold">

            <img src="images/video_page_icn.png" alt="Videos"> <?php echo ucwords_tr($video['baslik']) ?>

        </div>


        <div class="videogallery-page-content">


            <?php if($video['embed'] ==!null) {?>
            <div class="videogallery-page-content-embed">

                <?=$video['embed']?>

            </div>
            <?php } else {
                echo '
               <div class="alert alert-secondary" role="alert">
                    Video Embed Kodu Eklenmemiş!
                </div>
                ';
            }?>


            <div class="videogallery-page-content-txt">
                <?php
                $icerik  = $video['spot'];
                $eski   = "../images";
                $yeni   = "images";
                $icerik = str_replace($eski, $yeni, $icerik);
                ?>
                <?=$icerik?>
            </div>



            <?php if($video['tags'] ==!null) {?>

                <div class="videogallery-page-content-tags">

                    <div class="blog-detail-header-baslik font-spacing">
                        <?=$diller['etiketler']?>
                    </div>

                    <?php foreach( $etiketler as $anahtar => $deger ){ ?>
                        <div class="blog-detail-etiket-box"><?=$deger?></div>
                    <?php } ?>



                </div>


            <?php }?>








        </div>

    </div>






</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

