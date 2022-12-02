<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?><?php
$popupCek = $db->prepare("select * from popup where id='1'");
$popupCek->execute();
$popup = $popupCek->fetch(PDO::FETCH_ASSOC);
?>

<?php
if($popup['durum'] == 1) {
?>
    <link rel="stylesheet" type="text/css" href="assets/helper/other/popup/jquery.fancybox.css">
    <script type="text/javascript" src="assets/helper/other/popup/jquery.fancybox.js"></script>
    <script type="text/javascript" src="assets/helper/other/popup/jquery_cook_new.js"></script>

        <style id="compiled-css" type="text/css">
            /* hide so it doesnt show on page  */
            #popup-box {
                display: none;
                height: auto;
                padding: 0;
            }
            #popup-box img{max-width: 700px; height: auto}
            #popup-box iframe{width: 700px !important; height: 420px !important;}
            @media screen and (max-width:321px) and (min-width:0px) {
                #popup-box img{max-width: 100%; height: auto}
                #popup-box iframe{width: 100% !important; height: auto !important;}
            }
            @media screen and (max-width:410px) and (min-width:321px) {
                #popup-box img{max-width: 100%; height: auto}
                #popup-box iframe{width: 100% !important; height: auto !important;}
            }
            @media screen and (max-width:767px) and (min-width:410px) {
                #popup-box img{max-width: 100%; height: auto}
                #popup-box iframe{width: 100% !important; height: auto !important;}
            }

        </style>


        <script type="text/javascript">//<![CDATA[

            $(function(){

                $(document).ready(function() {

                    var active = Cookies.get('active');
                    if (active == '<?=$popup["ip_durum"]?>') {
                        return false; // cookie active do nothing
                    } else { //trigger popup and set a cookie
                        setTimeout(function() {
                            $(".fancybox").eq(0).trigger('click');
                        }, <?=$popup["delay"]?>);
                        $(".fancybox")
                            .attr('rel', 'group')
                            .fancybox({

                                padding:<?=$popup["padding"]?>,
                                scrolling: 'auto'
                            });
                    }
                    Cookies.set('active', 'yes', {
                        expires: 1 // the number of days cookie  will be effective
                    });

                });


            });

            //]]></script>

    <a href="#popup-box" id="pop" class="fancybox" rel="group"></a>
    <div id="popup-box">

        <?php if ($popup['tur'] == 0) {?>
        <?php if ($popup['url'] == !null) {?><a href="<?=$popup['url']?>" <?php if($popup['url_target'] == 1) { ?> target="_blank" <?php }?> ><?php }?>
        <img src="images/uploads/<?=$popup["gorsel"]?>" alt="Popup">
            <?php if ($popup['url'] == !null) {?></a><?php }?>
        <?php } else {?>
            <?=$popup["embed"]?>
        <?php }?>
    </div>


<?php }?>