<!-- Mobile Settings
    ======================================================================== -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Mobile icons and fav settings
    ======================================================================== -->
<link rel="shortcut icon" href="<?php echo $ayar['site_url'] ?>images/<?php echo $ayar['site_favicon']; ?>">
<link rel="apple-touch-icon" sizes="57x57" href="images/icons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="images/icons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/icons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="images/icons/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/icons/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="images/icons/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="images/icons/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="images/icons/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="images/icons/apple-touch-icon-180x180.png">

<!-- Mobile icons and fav settings End -->



<!-- Google Fonts
    ======================================================================== -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

<!-- Google Fonts End -->


<!--  CSS Assets
    ======================================================================== -->
<link rel="stylesheet" href="assets/css/font-awesome/font-awesome.min.css" />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css'>
<link rel="stylesheet" href="assets/css/style.css" >
<link rel="stylesheet" href="assets/css/responsive.css" >
<link rel="stylesheet" href="assets/helper/bootstrap/css/bootstrap.min.css" >
<link rel="stylesheet" href="assets/css/magnific-popup.css">
<link rel="stylesheet" href="assets/css/fonts.css">
<link rel="stylesheet" href="assets/css/nav-menu.css">
<link rel="stylesheet" href="assets/css/flag/flag-icon.css" >
<link rel='stylesheet' href='assets/css/slider/swiper.min.css'>
<link rel='stylesheet' href='assets/css/slider/aos.css'>
<link rel="stylesheet" href="assets/css/owl/owl.carousel.min.css">
<link rel="stylesheet" href="assets/css/owl/owl.theme.default.min.css">
<link rel="stylesheet" href="assets/helper/other/animate/animate.min.css">
<link rel="stylesheet" href="assets/css/lightbox/lightbox.css" >
<link rel="stylesheet" href="assets/css/sweetalert/sweetalert2.min.css" >
<!--  CSS Assets End -->



<!--  Js Assets
    ======================================================================== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="assets/js/custom.js"></script>

<!--  Js Assets End
   ======================================================================== -->


<!-- RSS
   ======================================================================== -->
<link rel="alternate" type="application/rss+xml" title="RSS servisi" href="<?php echo"$ayar[site_url]" ?>rss.xml" />
<!-- RSS  End !-->

<!-- ToTop Module -->
<style>
    body{background-color: #<?php echo $ayar['site_bg_color']?>}
    #return-to-top{background-color: #<?=$ayar['totop_bg']?>; bottom:<?=$ayar['totop_bottom']?>px;}
    #return-to-top:hover{background-color: #<?=$ayar['totop_bg']?>}
    #return-to-top i{color: #<?=$ayar['totop_icon']?>}
    #return-to-top:hover i{color: #<?=$ayar['totop_icon']?>}
</style>
<?php
if ($ayar['totop'] == 1) {
?>
<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
<?php }?>
<!-- ToTop Module End -->


<?php
$cerezlerCek = $db->prepare("select * from cerez_ayar where dil='$_SESSION[dil]' and durum='1' order by id desc limit 1");
$cerezlerCek->execute();
$cer = $cerezlerCek->fetch(PDO::FETCH_ASSOC);

if ($cerezlerCek->rowCount() > 0) {
?>
<!-- Cookies Agree -->

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
    <script>
        window.cookieconsent.initialise({
            "palette": {
                "popup": {
                    "background": "#<?=$cer['bg_color']?>",
                    "text": "#<?=$cer['bg_text_color']?>"
                },
                "button": {
                    "background": "#<?=$cer['button_bg']?>",
                    "text": "#<?=$cer['button_text_color']?>"
                }
            },
            "content": {
                "message": "<?=$cer['spot']?>",
                "dismiss": "<?=$cer['button_text']?>",
                "link": "<?=$cer['link_text']?>",
                "href": "<?=$cer['link']?>"
            }
        });
    </script>

<!-- Cookies Agree End -->
<?php }?>