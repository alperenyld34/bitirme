<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117170495-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-117170495-2');
</script>

<?php
$gelen_mesaj = $db ->prepare("select * from mesaj where durum='1' order by id desc");
$gelen_mesaj->execute();
$eski_mesaj = $db ->prepare("select * from mesaj where durum='0' order by id desc");
$eski_mesaj->execute();
$toplammesaj = $db ->prepare("select * from mesaj order by id desc");
$toplammesaj->execute();
?>
<?php
$yeni_siparis = $db ->prepare("select * from siparis where siparis_durum='0' order by id desc limit 7");
$yeni_siparis->execute();

$bakimModu = $db ->prepare("select * from bakim where id='1' ");
$bakimModu->execute();
$bakim = $bakimModu->fetch(PDO::FETCH_ASSOC);
?>
<header class="topbar" style="margin-top: -1px !important;">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">

        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">
               <b>

                    <img src="../images/logo/934065616503-315-Screenshot_18.png" width="175" height="60" alt="homepage" class="light-logo" />
                </b>
                    <span>

                         <img src="../images/logo/934065616503-315-Screenshot_18.png" width="175" height="60" alt="homepage" class="dark-logo" />

                         <img src="../images/logo/934065616503-315-Screenshot_18.png" width="175" height="60" class="light-logo" alt="homepage" /></span> </a>
        </div> 

        <div class="navbar-collapse">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-sm-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>


            </ul>

            <ul class="navbar-nav my-lg-0">

                <li class="nav-item dropdown" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Gelen Kutusu">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ti-email"></i>
                        <div class="notify">

                            <?php if ($gelen_mesaj->rowCount()>0) {?>
                            <span class="heartbit"></span> <span class="point"></span>
                            <?php }?>

                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mailbox animated fadeInDown">
                        <ul>
                            <li>
                                <div class="drop-title">Gelen Kutusu</div>
                            </li>
                            <li>
                                <div class="message-center">

                                    <?php foreach ($gelen_mesaj as $yenimesaj) {?>
                                    <a href="pages.php?sayfa=mesaj&mesaj_id=<?=$yenimesaj['id']?>">
                                        <div class="btn btn-danger btn-circle"><i class="ti-email"></i></div>
                                        <div class="mail-contnet">
                                            <h5><?=$yenimesaj['isim']?></h5> <span class="mail-desc">Mesajı görmek için tıklayın</span> <span class="time"><?php echo date_tr('j F Y, l', ''.$yenimesaj['tarih'].''); ?></span> </div>
                                    </a>
                                    <?php }?>

                                    <?php foreach ($eski_mesaj as $eskimesaj) {?>
                                        <a href="pages.php?sayfa=mesaj&mesaj_id=<?=$eskimesaj['id']?>">
                                            <div class="btn btn-secondary btn-circle"><i class="ti-share"></i></div>
                                            <div class="mail-contnet">
                                                <h5><?=$eskimesaj['isim']?></h5> <span class="mail-desc">Mesajı tekrar okuyun</span> <span class="time"><?php echo date_tr('j F Y, l', ''.$eskimesaj['tarih'].''); ?></span> </div>
                                        </a>
                                    <?php }?>

                                    <?php
                                    if($toplammesaj->rowCount()<= 0) {
                                        ?>
                                        <div style="width: 100%; height: auto; padding: 20px 0 20px 0; text-align: center">
                                            <span style="font-size:25px; font-weight: bold">0</span> <br>
                                            Mesaj bulunamadı
                                        </div>
                                    <?php }?>

                                </div>
                            </li>
                            <li>
                                <a class="nav-link text-center link" href="pages.php?sayfa=mesajlar"> <strong>Tüm Mesajları Git</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item dropdown" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Yeni Siparişler">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icon-handbag"></i>
                        <div class="notify">
                            <?php if ($yeni_siparis->rowCount()>0) {?>
                                <span class="heartbit"></span> <span class="point"></span>
                            <?php }?>
                        </div>
                    </a>
                    <div class="dropdown-menu mailbox dropdown-menu-right animated bounceInDown" aria-labelledby="2">
                        <ul>
                            <li>
                                <div class="drop-title">Yeni Siparişler</div>
                            </li>
                            <li>
                                <div class="message-center">


                                    <?php foreach ($yeni_siparis as $yenisiparis) {?>
                                        <a href="pages.php?sayfa=siparis&siparis_id=<?=$yenisiparis['id']?>">
                                            <div class="btn btn-info btn-circle"><i class="ti-shopping-cart"></i></div>
                                            <div class="mail-contnet">
                                                <h5><?=$yenisiparis['isim']?> #<?=$yenisiparis['siparis_no']?></h5> <span class="mail-desc">Siparişi görmek için tıklayın</span> <span class="time"><?php echo date_tr('j F Y, l', ''.$yenisiparis['siparis_tarih'].''); ?></span> </div>
                                        </a>
                                    <?php }?>

                                    <?php
                                    if($yeni_siparis->rowCount()<= 0) {
                                    ?>
                                    <div style="width: 100%; height: auto; padding: 20px 0 20px 0; text-align: center">
                                        <span style="font-size:25px; font-weight: bold">0</span> <br>
                                    Yeni siparişiniz bulunmamaktadır
                                    </div>
                                    <?php }?>

                                </div>
                            </li>
                            <li>
                                <a class="nav-link text-center link" href="pages.php?sayfa=siparisler"> <strong>Tüm Siparişler</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Siteye Gidin"> <a class="nav-link  waves-effect waves-light" href="<?=$ayar['site_url']?>index.html" target="_blank" ><i class="ti-location-arrow"></i></a></li>

                <li class="nav-item right-side-toggle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Dil Seçimi"> <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="ti-world"></i><span style="color:#FFF; padding-left: 10px; font-size:14px; text-transform: uppercase"><?php echo $_SESSION['dil'] ?></span></a></li>
            </ul>
        </div>
    </nav>
</header>