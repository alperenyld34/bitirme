<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php
$page_header_setting = $db->prepare("select * from page_header where page_id='tracing' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<?php
//TODO BU SAYFADA VA
?>
<title><?php echo ucwords_tr($diller['siparis-takip-baslik']) ?> | <?php echo $ayar['site_baslik']?></title>
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

<div class="bank-page-main">



    <div class="bank-page-text-main">

        <div class="bank-page-baslik font-open-sans font-30 font-bold" style="margin-bottom: 20px;">

            <?php echo ucwords_tr($diller['siparis-takip-baslik']) ?>

        </div>

            <div style="width: 100%; text-align: center; margin-bottom: 90px;">
                <?=$diller['siparis-takip-aciklama']?>
                <div class="tracing-input-div">
                    <form action="siparis-sorgu" method="get">
                        <div class="form-group col-md-12 ">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-hashtag"></i></div>
                                </div>
                                <input type="text" class="form-control"  required  name="orderNo" style="border-radius: 0; height: 50px; font-size: 30px ; font-family : 'Open Sans', Arial ; font-weight: 600;">
                            </div>
                        </div>

                        <div class="form-group col-md-12 " style="margin-top: 20px;">
                            <button name="result" value="order" class="btn btn-danger" style="font-family : 'Open Sans', Arial ; font-size: 20px ; padding: 13px 20px 13px 20px; font-weight: 600;"><i class="fa fa-search"></i> <?=$diller['siparis-takip-button']?></button>
                        </div>
                    </form>
                </div>
            </div>








    </div>






</div>

<!-- CONTENT AREA ============== !-->



<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>

