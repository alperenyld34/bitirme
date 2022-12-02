<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='service' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
$serviceayar = $db->prepare("select * from hizmet_ayar where id=:id");
$serviceayar->execute(array(
    'id' => '1'
));
$serv = $serviceayar->fetch(PDO::FETCH_ASSOC);

$hizmet_id = $_GET['ser_id'];
$hizmetler = $db->prepare("select * from hizmet where id=:id and durum=:durum and dil=:dil");
$hizmetler->execute(array(
        'id' => $hizmet_id,
        'durum' => '1',
        'dil' => $_SESSION['dil']
));
$hizmet = $hizmetler->fetch(PDO::FETCH_ASSOC);

$serviceliste = $db->prepare("select * from hizmet where durum=:durum and dil=:dil order by sira asc");
$serviceliste->execute(array(
        'durum' => '1',
        'dil' => $_SESSION['dil']
));
?>
<?php
if($hizmetler->rowCount() == 0)
{
    header('Location:'.$siteurl.'');

    exit;

}
?>
<?php $current_page = $hizmet_id  ?>
<title><?php echo ucwords_tr($hizmet['baslik']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$hizmet[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$hizmet[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$hizmet[tags]" ?>">
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

<div class="services-detail-page-main">


        <div class="services-detail-content">

            <div class="services-detail-content-left">


                <div class="services-detail-content-left-baslik">
                    <?=$hizmet['baslik']?>
                    <?php if($hizmet['icon'] == null) {} else { ?>
                    <span style="float: right"><i class="fa <?=$hizmet['icon']?>"></i></span>
                    <?php }?>
                </div>

                <?php if($hizmet['gorsel'] == null) {} else { ?>
                <div class="services-detail-content-left-img">
                    <img src="images/services/<?=$hizmet['gorsel']?>" alt="<?=$hizmet['baslik']?>">
                </div>
                <?php }?>

                <div class="services-detail-content-left-txt">
                    <?php
                    $icerik  = $hizmet['icerik'];
                    $eski   = "../images";
                    $yeni   = "images";
                    $icerik = str_replace($eski, $yeni, $icerik);
                    ?>
                    <?=$icerik?>
                </div>

                <div class="services-detail-content-left-social">



                    <a href="https://www.facebook.com/sharer.php?u=<?=$ayar['site_url']?>hizmet/<?=$hizmet['id']?>/<?=seo($hizmet['baslik'])?>" onClick="return popup(this, 'notes')"  ><i aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="<?=$diller['paylas']?>" class="fa fa-facebook"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?=$ayar['site_url']?>hizmet/<?=$hizmet['id']?>/<?=seo($hizmet['baslik'])?>" onClick="return popup(this, 'notes')" ><i class="fa fa-twitter" data-toggle="tooltip" data-placement="bottom" title="<?=$diller['paylas']?>"></i></a>
                    <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?=$ayar['site_url']?>hizmet/<?=$hizmet['id']?>/<?=seo($hizmet['baslik'])?>" onClick="return popup(this, 'notes')"><i class="fa fa-linkedin" data-toggle="tooltip" data-placement="bottom" title="<?=$diller['paylas']?>"></i></a>
                    <?php if($hizmet['gorsel'] == null) {} else { ?>
                    <a href="https://www.pinterest.com/pin/create/button/?url=<?=$ayar['site_url']?>hizmet/<?=$hizmet['id']?>/<?=seo($hizmet['baslik'])?>&media=<?=$ayar['site_url']?>images/services/<?=$hizmet['gorsel']?>&description=<?=$hizmet['baslik']?>"  onClick="return popup(this, 'notes')"><i class="fa fa-pinterest-p" data-toggle="tooltip" data-placement="bottom" title="<?=$diller['paylas']?>"></i></a>
                    <?php }?>
                    <a href="https://api.whatsapp.com/send?text=<?=$hizmet['baslik']?> <?=$ayar['site_url']?>hizmet/<?=$hizmet['id']?>/<?=seo($hizmet['baslik'])?>" target="_blank"><i class="fa fa-whatsapp" data-toggle="tooltip" data-placement="bottom" title="<?=$diller['paylas']?>"></i></a>


                </div>


            </div><div class="services-detail-content-right">

            <div class="services-detail-header">
                <div class="services-detail-header-baslik font-spacing">
                    <?=$diller['hizmetlerimiz']?>
                </div>
                <div class="services-detail-header-spot">
                    <?=$diller['hizmetlerimiz-aciklamasi']?>
                </div>
                <div class="services-detail-header-divider"></div>
            </div>

                <?php foreach ($serviceliste as $hizmetliste) { ?>
                <a href="hizmet/<?=$hizmetliste['id']?>/<?=seo($hizmetliste['baslik'])?>" class="services-link-class <?php if($current_page==$hizmetliste['id']){ ?>services-link-active<?php }?>">

                <div class="services-detail-buttons <?php if($current_page==$hizmetliste['id']){ ?>services-detail-buttons-active<?php }?>" >

                    <?php if($current_page==$hizmetliste['id']){ ?><div class="services-detail-buttons-left-arrow"><i class="fa fa-caret-left" style="color:#<?=$serv['detay_button_bg']?>"></i></div><?php }?>

                    <?=$hizmetliste['baslik']?>

                </div>

                </a>
                <?php } ?>

            </div>


        </div>










</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>