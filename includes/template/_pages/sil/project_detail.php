<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='proje' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
$pro_id = $_GET['pro_id'];
$projects = $db->prepare("select * from proje where id=:id and durum=:durum and dil=:dil");
$projects->execute(array(
        'id' => $pro_id,
        'durum' => '1',
    'dil' => $_SESSION['dil']
));
$proje = $projects->fetch(PDO::FETCH_ASSOC);
$etiketler = $proje['tags'];
$etiketler = explode(',', $etiketler);

$proje_kat = $db->prepare("select * from proje_kat where id=:id and durum=:durum and dil=:dil");
$proje_kat->execute(array(
        'id' => $proje['kat_id'],
    'durum' => '1',
    'dil' => $_SESSION['dil']
));
$kat = $proje_kat->fetch(PDO::FETCH_ASSOC);

$proje_galeri = $db->prepare("select * from proje_resim where proje_id=:proje_id order by sira asc");
$proje_galeri->execute(array(
        'proje_id' => $proje['id']
));
?>
<?php
if($projects->rowCount() == 0)
{
    header('Location:'.$siteurl.'');

    exit;

}
?>
<title><?php echo ucwords_tr($proje['baslik']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$proje[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$proje[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$proje[tags]" ?>">
<meta name="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta itemprop="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta name="robots" content="index follow">
<meta name="googlebot" content="index follow">
<meta property="og:type" content="website" />

<?php include "includes/config/header_libs.php";?>

</head>
<body>
<?php include 'includes/template/pre-loader.php'?>
<?php include 'includes/template/header.php'?>

<!-- CONTENT AREA ============== !-->

<div class="proje-detail-page-main">


        <div class="proje-detail-ust">

            <div class="proje-detail-ust-img">

                <img src="images/projects/<?=$proje['gorsel']?>" alt="<?=$proje['baslik']?>">

            </div><div class="proje-detail-ust-info">



                <div class="proje-detail-ust-info-it font-spacing font-open-sans" style="margin-bottom: 0">
                   <strong><?php echo $diller['proje-adi'] ?></strong>
                </div>

                <div class="proje-detail-ust-info-name">
                    <?=$proje['baslik']?>
                </div>

                <?php if($proje['spot'] ==!null){ ?>
                <div class="proje-detail-ust-info-spot">

                    <?=$proje['spot']?>

                </div>
                <?php }?>



                <?php if($proje['adres'] ==!null){ ?>
                <div class="proje-detail-ust-info-it font-spacing">

                   <i class="fa fa-map-marker"></i>
                    <?=$proje['adres']?>

                </div>
                <?php }?>

                <?php if($proje['kat_id'] ==!null){ ?>
                    <div class="proje-detail-ust-info-it font-spacing">

                        <i class="fa fa-hashtag" style="color:dodgerblue; font-size:16px; margin-right: 10px; margin-top: 2px;"></i>
                        <strong><?=$kat['baslik']?></strong>

                    </div>
                <?php }?>

                <?php if($proje['start_date'] ==!null){ ?>
                    <div class="proje-detail-ust-info-it font-spacing">

                        <i class="fa fa-calendar-plus-o" style="font-size:17px; margin-top:1px"></i>
                        <strong><?php echo $diller['proje-baslangic'] ?> : </strong> <?php echo date_tr('j F Y', ''.$proje['start_date'].''); ?>

                    </div>
                <?php }?>

                <?php if($proje['finish_date'] ==!null){ ?>
                    <div class="proje-detail-ust-info-it font-spacing">

                        <i class="fa fa-calendar-check-o" style="font-size:17px; margin-top:1px"></i>
                        <strong><?php echo $diller['proje-bitis'] ?> : </strong> <?php echo date_tr('j F Y', ''.$proje['finish_date'].''); ?>

                    </div>
                <?php }?>


                <?php if($proje['url'] ==!null){ ?>
                    <a href="<?=$proje['url']?>" class="btn btn-danger" role="button" aria-pressed="true" target="_blank" >
                        <i class="fa fa-link"></i>
                        <?php echo $diller['proje-link'] ?>
                    </a>
                <?php }?>

            </div>

        </div>

    <div class="proje-detail-alt" >

             <div id="tab-projects" >

                <ul class='projects_tabs_ul'>


                    <?php if($proje['icerik'] ==!null) {?>
                    <li>
                        <a href="#info">
                            <i class="fa fa-info-circle"></i>
                            <?php echo $diller['proje-hakkinda'] ?>
                        </a>
                    </li>
                    <?php }?>

                    <?php if($proje['maps'] ==!null) {?>
                    <li>
                        <a href="#map">
                            <i class="fa fa-map-o"></i>
                            <?php echo $diller['proje-ulasim'] ?>
                        </a>
                    </li>
                    <?php }?>

                    <?php if ($proje_galeri->rowCount() >0 ){ ?>
                    <li>
                        <a href="#gallery">
                            <i class="fa fa-camera"></i>
                            <?php echo $diller['proje-galeri'] ?>
                        </a>
                    </li>
                    <?php }?>


                    <?php if($proje['embed'] ==!null) {?>
                    <li>
                        <a href="#video">
                            <i class="fa fa-video-camera"></i>
                            <?php echo $diller['proje-videosu'] ?>
                        </a>
                    </li>
                    <?php }?>

                </ul>




                 <div id="info" class="projects_tabs_content" >
                     <?php
                     $icerik  = $proje['icerik'];
                     $eski   = "../images";
                     $yeni   = "images";
                     $icerik = str_replace($eski, $yeni, $icerik);
                     ?>
                     <?=$icerik?>
                 </div>

                 <div id="map" class="projects_tabs_content" >
                     <?=$proje['maps']?>
                 </div>

                 <div id="gallery" class="projects_tabs_content"  style="text-align: center" >

                    <div id="portfolio">
                     <?php foreach ($proje_galeri as $galeri) {?>
                         <div class="photogallery-box" style="padding-bottom: 0">
                             <div class="photogallery-box-img">
                                 <a href="images/projects/<?=$galeri['gorsel']?>">
                                     <div class="photogallery-ovrly">
                                         <i class="fa fa-search-plus"></i>
                                     </div>

                                     <img src="images/projects/<?=$galeri['gorsel']?>" alt="<?=$proje['baslik']?>">
                                 </a>
                             </div>
                         </div>
                     <?php }?>
                    </div>

                 </div>


                 <div id="video" class="projects_tabs_content" >
                     <?=$proje['embed']?>
                 </div>



            </div>

            <div class="proje-detail-social-share">


                <a href="https://www.facebook.com/sharer.php?u=<?=$ayar['site_url']?>proje/<?=$proje['id']?>/<?=seo($proje['baslik'])?>" onClick="return popup(this, 'notes')"  ><i aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="<?=$diller['paylas']?>" class="fa fa-facebook"></i></a>

                <a href="https://twitter.com/intent/tweet?url=<?=$ayar['site_url']?>proje/<?=$proje['id']?>/<?=seo($proje['baslik'])?>" onClick="return popup(this, 'notes')" ><i class="fa fa-twitter" data-toggle="tooltip" data-placement="bottom" title="<?=$diller['paylas']?>"></i></a>

                <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?=$ayar['site_url']?>proje/<?=$proje['id']?>/<?=seo($proje['baslik'])?>" onClick="return popup(this, 'notes')"><i class="fa fa-linkedin" data-toggle="tooltip" data-placement="bottom" title="<?=$diller['paylas']?>"></i></a>

                <a href="https://www.pinterest.com/pin/create/button/?url=<?=$ayar['site_url']?>proje/<?=$proje['id']?>/<?=seo($proje['baslik'])?>&media=<?=$ayar['site_url']?>images/projects/<?=$proje['gorsel']?>&description=<?=$proje['baslik']?>"  onClick="return popup(this, 'notes')"><i class="fa fa-pinterest-p" data-toggle="tooltip" data-placement="bottom" title="<?=$diller['paylas']?>"></i></a>

                <a href="https://api.whatsapp.com/send?text=<?=$proje['baslik']?> <?=$ayar['site_url']?>proje/<?=$proje['id']?>/<?=seo($proje['baslik'])?>" target="_blank"><i class="fa fa-whatsapp" data-toggle="tooltip" data-placement="bottom" title="<?=$diller['paylas']?>"></i></a>



            </div>










    </div>











</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

