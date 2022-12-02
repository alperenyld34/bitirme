<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<!-- Right sidebar -->
<!-- ============================================================== -->
<!-- .right-sidebar -->
<div class="right-sidebar">
    <div class="slimscrollright">
        <div class="rpanel-title"> İçerik Dili <span><i class="ti-close right-side-toggle"></i></span> </div>
        <div class="r-panel-body">

            <div style="border-bottom: 1px solid #EBEBEB; padding: 0 0 10px 0; ">
            İçeriklerinizi hangi dilde eklemek veya düzenlemek istiyorsanız lütfen o dili seçiniz.
            </div>

            <?php
            $dilsirala = $db->prepare("select * from dil order by sira asc");
            $dilsirala->execute();
            while($d = $dilsirala->fetch(PDO::FETCH_ASSOC)){
                ?>
                <a class="dropdown-item dropdown-text-type" href="?language=<?php echo $d['kisa_ad'] ?>" style="<?php if($d['kisa_ad'] == $_SESSION['dil']) { ?>border-bottom:1px solid #EBEBEB; border:1px solid red<?php } else {?>border-bottom:1px solid #EBEBEB;<?php }?>">
                    <div class="flag-icon-<?php echo $d['flag'] ?>" style="width:18px; height:13px; display: inline-block; vertical-align: middle"></div>
                    <?php echo $d['baslik'] ?>
                </a>

            <?php }?>

        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Right sidebar -->
<!-- ============================================================== -->