<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?><?php
$loaderCek = $db->prepare("select * from loader where id='1'");
$loaderCek->execute();
$load = $loaderCek->fetch(PDO::FETCH_ASSOC);
?>

<?php
if($load['durum'] == 1) {
?>
<style>
    .preload-main {
        display: flex;
        height: 100vh;
        width: 100%;
        position: fixed; z-index: 9999;
        justify-content: center;
        align-items: center;
        background: #<?=$load['back_color']?>; overflow: hidden;
        position: fixed;
        top: 0;
        left: 0;
    }

    .loader {
        position: relative;
    }
</style>
</head>
<div class="preload-main">
    <div class="loader">
        <img src="images/loader/<?=$load['icon']?>" alt="">
    </div>
</div>
<script id="rendered-js">

    $(window).on('load', function(){
        $('.preload-main').delay(<?=$load['delay']?>).fadeOut('slow', function(){
            $("body").removeClass("hidden");
        });

    });
</script>

<?php }?>