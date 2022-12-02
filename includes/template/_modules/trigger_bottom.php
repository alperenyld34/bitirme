<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?><?php
$trigger2 = $db->prepare("select * from tetikleyiciler where dil='$_SESSION[dil]' and durum='1' and area='1' order by id desc limit 1");
$trigger2->execute();
?>
<?php foreach ($trigger2 as $tgb) { ?>
<div class="trigger-main-div" style="width: <?php if($tgb['width']==1){?> 90%; <?php }else {?> 100% <?php }?>; background-color: #<?php echo $tgb['bg_color'] ?>; padding: 15px 0 15px 0">
    <div class="trigger-main-div-in" style="text-align: center">


        <div class="trigger-bottom-text-div" style="color:#<?php echo $tgb['text_color'] ?>">
            <div class="trigger-bottom-text-span"><i class="fa fa-phone" aria-hidden="true"></i></div>
            <div class="trigger-bottom-text-span"><?php echo $tgb['text'] ?></div>
            <div class="trigger-bottom-phone-span">
                <a href="tel:<?=$telsonuc?>" style="text-decoration: none; color:#<?php echo $tgb['text_color'] ?>">
                    <?php echo $ayar['site_tel'] ?>
                </a>
            </div>

        </div>


    </div>
</div>
<?php }?>