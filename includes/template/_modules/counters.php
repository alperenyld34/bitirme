<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?><?php
$countersettings = $db->prepare("select * from sayac_ayar where id='1'");
$countersettings->execute();
$countsett = $countersettings->fetch(PDO::FETCH_ASSOC);
?>
<?php
$counter_counts = $db->prepare("select * from sayac where durum='1' and dil='$_SESSION[dil]' order by sira asc");
$counter_counts->execute();
$sayi = 2;
?>
<style>
    .counter-home-main-div{width:<?php if($countsett['width']==1){?> 90%; <?php }else {?> 100% <?php }?> ; height: auto; overflow: hidden; background-color: #<?php echo $countsett['back_color'] ?>; padding: <?php echo $countsett['padding'] ?>px 0 <?php echo $countsett['padding'] ?>px 0; }
    .counter-box{border:1px solid #<?php echo $countsett['box_border_color'] ?>; background-color: #<?php echo $countsett['box_bg_color'] ?>; }
</style>
<div class="counter-home-main-div">

    <div class="counter-home-main-div-inside counters">


<?php if($counter_counts->rowCount() > 0) { ?>


        <?php foreach ($counter_counts as $count1){ ?>

        <div class="counter-box" style="color:#<?php echo $countsett['box_text_color'] ?>;" data-appear-animation="fadeInUp" data-appear-animation-delay="<?=$sayi++;?>00" >
            <?php if ($countsett['icon'] == 1) {?>
            <i class="fa <?php echo $count1['icon'] ?>"></i><br>
            <?php }?>
            <span data-to="<?php echo $count1['count'] ?>" <?php if($count1['plus'] == 1) { ?>data-append="+"<?php }?> >0</span><br>
            <label><?php echo $count1['baslik'] ?></label>
        </div>

        <?php }?>


<?php } else { ?>

            <div class="counter-box" style="color:#000>;" data-appear-animation="fadeInUp" data-appear-animation-delay="<?=$sayi++;?>00" >


                <span data-to="0" >0</span><br>
                <label><strong>Counter Eklenmemiş !</strong></label>
                <br>
                <span style="font-size:13px !important;">Lütfen yeni bir sayaç kutusu ekleyiniz</span>
            </div>

<?php }?>


    </div>

</div>