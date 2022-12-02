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
?>
<?php
$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from hizmet where durum='1' and dil='$_SESSION[dil]' order by sira ASC");
$ToplamVeri = $Say->rowCount();
$Limit = 12;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$Service_Liste = $db->query("select * from hizmet where durum='1' and dil='$_SESSION[dil]' order by sira ASC limit $Goster,$Limit");
$ServiceAl = $Service_Liste->fetchAll(PDO::FETCH_ASSOC);
?>
<title><?php echo ucwords_tr($diller['hizmetlerimiz']) ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$serv[meta_desc]" ?>">
<meta name="keywords" content="<?php echo"$serv[tags]" ?>">
<meta name="news_keywords" content="<?php echo"$serv[tags]" ?>">
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

<div class="services-page-main">



    <div class="services-page-text-main" style="width: 90%;">

        <div class="services-page-baslik font-open-sans font-30 font-bold">

            <?php echo ucwords_tr($diller['hizmetlerimiz']) ?>

        </div>



        <div class="page-spot-quote font-open-sans font-17 font-small">

            <?php echo $diller['hizmetlerimiz-aciklamasi'] ?>

        </div>

        <div class="services-page-content">






            <?php if($serv['tip'] == 0)
            {
                ?>
                <!-- TİP 0 ========================== !-->

                <?php foreach ($ServiceAl as $ser)  {     ?>

                <div class="service-image-box" data-appear-animation="fadeInUp" data-appear-animation-delay="<?php echo $num++ ?>00">

                    <?php
                    if($serv['detay_url'] == 0) {  ?>

                        <img src="images/services/<?php echo $ser['gorsel'] ?>" alt="<?php echo $ser['baslik'] ?>">
                        <h1 class="font-open-sans"  ><?php echo $ser['baslik'] ?></h1>

                    <?php }?>
                    <?php
                    if($serv['detay_url'] == 1) {  ?>

                        <a href="hizmet/<?php echo seo($ser['id'])?>/<?php echo seo($ser['baslik']) ?>">
                            <img src="images/services/<?php echo $ser['gorsel'] ?>" alt="<?php echo $ser['baslik'] ?>">
                        </a>
                        <a href="hizmet/<?php echo seo($ser['id'])?>/<?php echo seo($ser['baslik']) ?>" style="color:#000">
                            <h1 class="font-open-sans"  ><?php echo $ser['baslik'] ?></h1>
                        </a>

                    <?php }?>

                    <h2 style="color:#666"><?php echo $ser['spot'] ?></h2>
                </div>
            <?php }?>

                <!-- TİP 0 ========================== !-->
                <?php } ?>



            <?php if($serv['tip'] == 1)
            {
                ?>
                <!-- TİP 1 ========================== !-->

                <?php foreach ($ServiceAl as $ser2) {  ?><div class="service-icon-1-box" data-appear-animation="fadeInUp" data-appear-animation-delay="<?php echo $num++ ?>00">
                <div class="service-icon-1-icon">
                    <i class="fa <?=$ser2['icon']?>" style="color:#000"></i>
                </div><div class="service-icon-1-text">


                    <?php
                    if($serv['detay_url'] == 0) {  ?>
                        <h1 class="font-open-sans" style="color:#000"><?php echo $ser2['baslik'] ?></h1>
                    <?php }?>

                    <?php
                    if($serv['detay_url'] == 1) {  ?>
                        <a href="hizmet/<?php echo seo($ser2['id'])?>/<?php echo seo($ser2['baslik']) ?>" style="color:#000">
                            <h1 class="font-open-sans"><?php echo $ser2['baslik'] ?></h1>
                        </a>
                    <?php }?>

                    <h2 class="font-raleway" style="color:#666"><?php echo $ser2['spot'] ?></h2>
                </div>
                </div><?php } ?>

                <!-- TİP 1 ========================== !-->
            <?php }?>



            <?php if($serv['tip'] == 2)
            {
                ?>
                <!-- TİP 2 ========================== !-->
                <?php foreach ($ServiceAl as $ser3) {  ?><div class="service-icon-2-box">

                <i class="fa <?=$ser3['icon']?>" style="color:#000"></i>


                <?php
                if($serv['detay_url'] == 0) {  ?>
                    <h1 class="font-open-sans" style="color:#000"><?php echo $ser3['baslik'] ?></h1>
                <?php }?>

                <?php
                if($serv['detay_url'] == 1) {  ?>
                    <a href="hizmet/<?php echo seo($ser3['id'])?>/<?php echo seo($ser3['baslik']) ?>" style="color:#000">
                        <h1 class="font-open-sans"><?php echo $ser3['baslik'] ?></h1>
                    </a>
                <?php }?>

                <h2 class="font-raleway" style="color:#666"><?php echo $ser3['spot'] ?></h2>
                </div><?php } ?>


                <!-- TİP 2 ========================== !-->
            <?php }?>





            <!---- Sayfalama Elementleri ================== !-->

            <?php if($Sayfa >= 1){?>
                <nav aria-label="Page navigation example" style="margin-top: 50px;">
                    <ul class="pagination pagination-sm justify-content-center">
            <?php } ?>

            <?php if($Sayfa > 1){?>

                <li class="page-item"><a class="page-link" href="hizmetler/1"><?=$diller['sayfalama-ilk']?></a></li>
                <li class="page-item"><a class="page-link" href="hizmetler/<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

            <?php } ?>
            <?php
            for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                if($i == $Sayfa){
                    echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="hizmetler/'.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';
                }else{
                    echo '
                    <li class="page-item"><a class="page-link" href="hizmetler/'.$i.'">'.$i.'</a></li>
                    ';
                }
            }
            }
            ?>

            <?php if($Service_Liste->rowCount() <=0) { } else { ?>
            <?php if($Sayfa != $Sayfa_Sayisi){?>

                    <li class="page-item"><a class="page-link" href="hizmetler/<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                    <li class="page-item"><a class="page-link" href="hizmetler/<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


            <?php }} ?>

          <?php if($Sayfa >= 1){?>
                    </ul>
                </nav>
          <?php } ?>
            <!---- Sayfalama Elementleri ================== !-->



            <?php if ($Service_Liste->rowCount() <= 0) { ?>
                <div class="service-image-box" data-appear-animation="fadeInUp" data-appear-animation-delay="100">



                            <img src="http://www.fpoimg.com/865x460" alt="NoImage">
                            <h1 class="font-open-sans"  >HİZMET EKLENMEMİŞ!</h1>



                    <h2 style="color:#<?php echo $serv['spot_color'] ?>">Lütfen yeni bir hizmet ekleyiniz.</h2>
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

