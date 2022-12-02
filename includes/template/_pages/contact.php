<?php echo !defined("GUVENLIK") ? die("İzinsiz Giriş") : null;?>
<?php
$sosyalmedya_cek=$db->prepare("select * from sosyal order by sira asc");
$sosyalmedya_cek->execute();
?>
<title><?php echo $diller['iletisim-title'] ?> | <?php echo $ayar['site_baslik']?></title>
<meta name="description" content="<?php echo"$ayar[site_desc]" ?>">
<meta name="keywords" content="<?php echo"$ayar[site_tags]" ?>">
<meta name="news_keywords" content="<?php echo"$ayar[site_tags]" ?>">
<meta name="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta itemprop="author" content="<?php echo"$ayar[site_baslik]" ?>" />
<meta name="robots" content="index, follow">
<meta property="og:type" content="website" />

<?php include "includes/config/header_libs.php";?>

    <style>
        .form-control {
            border-radius: 0;
            height:  calc(2em + .75rem + 2px);

        }
    </style>
</head>
<body>
<?php include 'includes/template/header.php'?>

<!-- CONTENT AREA ============== !-->

<div class="contact-page-main">


   

        <div class="contact-page-infos-area">

            <div class="contact-page-infos-ust">

                <div class="modules-header-main" style="margin-bottom: 0">
                    <div class="modules-header-main-head" style="background:url(images/divider.png) no-repeat center bottom;">
                        <div class="modules-header-main-baslik font-open-sans font-bold font-spacing" style="color:#000">
                            <?php echo $diller['iletisime-gec']?>
                        </div>
                    </div>
                </div>



                <?php if($ayar['site_tel'] ==! null){?>
                    <div class="contact-page-icon-box">
                        <div class="contact-page-icon-box-i">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="contact-page-icon-box-txt font-spacing font-18">
                            <?=$ayar['site_tel']?>
                        </div>
                    </div>
                <?php } ?>

                <?php if($ayar['site_gsm'] ==! null){?>
                    <div class="contact-page-icon-box">
                        <div class="contact-page-icon-box-i">
                            <i class="fa fa-mobile"></i>
                        </div>
                        <div class="contact-page-icon-box-txt font-spacing font-18">
                            <?=$ayar['site_gsm']?>
                        </div>
                    </div>
                <?php } ?>

                <?php if($ayar['site_whatsapp'] ==! null){?>
                    <div class="contact-page-icon-box">
                        <div class="contact-page-icon-box-i">
                            <i class="fa fa-whatsapp" style="color:limegreen; "></i>
                        </div>
                        <div class="contact-page-icon-box-txt font-spacing font-18">
                            <?=$ayar['site_whatsapp']?>
                        </div>
                    </div>
                <?php } ?>

                <?php if($ayar['site_mail'] ==! null){?>
                    <div class="contact-page-icon-box">
                        <div class="contact-page-icon-box-i">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <div class="contact-page-icon-box-txt font-spacing">
                            <?=$ayar['site_mail']?>
                        </div>
                    </div>
                <?php } ?>

                <?php if($ayar['adres_bilgisi'] ==! null){?>
                    <div class="contact-page-icon-box">
                        <div class="contact-page-icon-box-i">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <div class="contact-page-icon-box-txt font-spacing">
                            <?=$ayar['adres_bilgisi']?>
                        </div>
                    </div>
                <?php } ?>

                <?php if($ayar['site_workhour'] == !null){?>
                    <div class="contact-page-icon-box" style=" padding: 0px 0 10px 0; ">
                        <div class="contact-page-icon-box-i">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <div class="contact-page-icon-box-txt font-spacing">
                            <strong><?php echo $diller['calisma-saatleri'] ?></strong> <br>
                           <?=$ayar['site_workhour']?>
                        </div>
                    </div>
                <?php } ?>



            </div>


            <?php if($sosyalmedya_cek->rowCount() > 0) {?>
            <div class="contact-page-infos-alt">


                <div class="contact-page-infos-alt-ic">


                    <?php foreach ($sosyalmedya_cek as $sosyal) {?>

                        <a href="<?=$sosyal['url']?>" target="_blank"><i class="fa <?=$sosyal['icon']?>" data-toggle="tooltip" data-placement="bottom" title="<?=$sosyal['baslik']?>"></i></a>

                    <?php } ?>



                </div>


            </div>
            <?php } ?>

        </div>


    <div class="contact-page-form-area">


        <div class="modules-header-main" style="margin-bottom: 35px;">
            <div class="modules-header-main-head" style="background:url(images/divider.png) no-repeat center bottom;">
                <div class="modules-header-main-baslik font-open-sans font-bold font-spacing" style="color:#000">
                    <?php echo $diller['bize-yazin']?>
                </div>
            </div>
        </div>


        <form method="post" action="includes/post/contactpost.php">


            <div class="form-row">

                <div class="form-group col-md-4 ">
                    <label for="inputnName"><?=$diller['iletisim-isim']?></label>
                    <input type="text" name="isim" class="form-control" id="inputnName"  required >
                </div>
                <div class="form-group col-md-4">
                    <label for="inputDate"><?=$diller['iletisim-mail']?></label>
                    <input type="email" name="eposta" class="form-control"  id="inputDate" required  placeholder="">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputKonu"><?=$diller['iletisim-telno']?></label>
                    <input type="number" name="telno" class="form-control"  id="inputKonu"  required placeholder="">
                </div>

            </div>

            <div class="form-row">

                <div class="form-group col-md-12">
                    <label for="textareaEgitim"><?=$diller['iletisim-mesaj']?></label>
                    <textarea class="form-control" id="textareaEgitim"   name="mesaj"  required style="height: 100px!important;"></textarea>
                </div>
            </div>
            <button type="submit" name="contactgonder" class="btn btn-danger btn-lg"><?=$diller['iletisim-button-gonder']?></button>
        </form>
    </div>
</div>

<!-- CONTENT AREA ============== !-->




<?php if($_GET['status']=='success'){ ?>
    <script>
        $(document).ready(function () {
            swal({
                title: "<?=$diller['post-basarili']?>",
                text: "<?=$diller['post-iletisim-basarili-aciklamasi']?>",
                type: "success",
                timer: '3500',
                showConfirmButton: true,
                confirmButtonText:"<?=$diller['button-tamam']?>",
            });
        });
    </script>
    <meta http-equiv="refresh" content="3; URL=index.html">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
<script>
    $(document).ready(function () {
        swal({
            title: "<?=$diller['post-hata']?>",
            text: "<?=$diller['post-guvenlik-kod-hata']?>",
            type: "warning",
            showConfirmButton: true,
            confirmButtonText:"<?=$diller['button-tamam']?>",
        });
    });
</script>
<?php }?>
<?php if($_GET['status']=='critical'){ ?>
<script>
    $(document).ready(function () {
        swal({
            title: "KRİTİK HATA!",
            text: "SMTP Ayarlarınız hatalı! Başvuru sisteme girildi ancak bildirim gönderilemedi.",
            type: "warning",
            timer: '3500',
            showConfirmButton: true,
            confirmButtonText:"<?=$diller['button-tamam']?>",
        });
    });
</script>
<meta http-equiv="refresh" content="3; URL=index.html">
<?php }?>


<?php if(isset($_SESSION['contact_array']) && $_SESSION['contact_array']['status'] == 'error'){ ?>
    <script>
        $(document).ready(function () {
            swal({
                title: "<?=$diller['post-hata']?>",
                text: "<?=$diller['form-eksik-alan']?>",
                type: "warning",
                timer: '3500',
                showConfirmButton: true,
                confirmButtonText:"<?=$diller['button-tamam']?>",
            });
        });
    </script>
    <meta http-equiv="refresh" content="3; URL=iletisim">
    <?php unset($_SESSION['contact_array']); ?>
<?php }?>


<?php include 'includes/template/footer.php'?>
</body>
    </html>
<?php include "includes/config/footer_libs.php";?>