<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>
<?php


$page_header_setting = $db->prepare("select * from page_header where page_id='ik' order by id");
$page_header_setting->execute();
$pagehead = $page_header_setting->fetch(PDO::FETCH_ASSOC);
?>
<title><?php echo ucwords_tr($diller['insan-kaynaklari']) ?> | <?php echo $ayar['site_baslik']?></title>
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

<div class="human-resource-page-main">



    <div class="human-resource-page-baslik">
        <div class="catalog-page-baslik-head font-open-sans font-24 font-bold">
            <?php echo ucwords_tr($diller['insan-kaynaklari']) ?>
        </div>
        <div class="human-resource-page-baslik-head font-open-sans font-14">
            <?php echo $diller['insan-kaynaklari-aciklamasi'] ?>
        </div>
        <div class="human-resource-page-baslik-img">
            <img src="images/humansource2.png" alt="">
        </div>

    </div><div class="human-resource-page-content"><div class="human-resource-page-content-form">

            <form method="post" action="includes/post/ikpost.php">


                <div class="alert alert-info" role="alert" style="color:#000">
                    <i class="fa fa-info-circle" style="margin-right: 10px"></i> <?=$diller['form-eksiksiz-doldur-alani']?>
                </div>

                <div class="form-row">

                    <div class="form-group col-md-6 ">
                        <label for="inputnName"><?=$diller['isim-soyisim']?></label>
                        <input type="text" name="isim" class="form-control" id="inputnName"  required >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputDate"><?=$diller['dogum-tarihi']?></label>
                        <input type="text" name="d_tarih" class="form-control"  id="inputDate" required  placeholder="<?=$diller['dogum-tarihi-kisa']?>">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-6 ">
                        <label for="inputPhone"><?=$diller['telefon-numaraniz']?></label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-phone"></i></div>
                            </div>
                            <input type="number" class="form-control" id="inputPhone" required  name="telno">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputMail"><?=$diller['email-adresiniz']?></label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-envelope-o"></i></div>
                            </div>
                            <input type="email" class="form-control" id="inputMail" required name="mailadresi">
                        </div>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-6 ">
                        <label for="inputSehir"><?=$diller['il']?></label>
                        <input type="text" name="il" class="form-control" id="inputSehir" required  >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputilce"><?=$diller['ilce']?></label>
                        <input type="text" name="ilce" class="form-control"  id="inputilce"  required >
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputCinsiyet"><?=$diller['cinsiyetiniz']?></label>
                        <select id="inputCinsiyet" class="form-control" name="cinsiyet" required >
                            <option value=""><?=$diller['secim-yap']?></option>
                            <option value="<?=$diller['erkek']?>"><?=$diller['erkek']?></option>
                            <option value="<?=$diller['kadin']?>"><?=$diller['kadin']?></option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputMedeniHal"><?=$diller['medeni-haliniz']?></label>
                        <select id="inputMedeniHal" class="form-control"  name="medeni" required >
                            <option value=""><?=$diller['secim-yap']?></option>
                            <option value="<?=$diller['evli']?>" ><?=$diller['evli']?></option>
                            <option value="<?=$diller['bekar']?>"><?=$diller['bekar']?></option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputKanGrubu"><?=$diller['kan-grubu']?></label>
                        <select id="inputKanGrubu" class="form-control" name="kangrubu" required>
                            <option value=""><?=$diller['secim-yap']?></option>
                            <option value="A rh(+)">A rh(+)</option>
                            <option value="A rh(-)">A rh(-)</option>
                            <option value="B rh(+)">B rh(+)</option>
                            <option value="B rh(-)">B rh(-)</option>
                            <option value="AB rh(+)">AB rh(+)</option>
                            <option value="AB rh(-)">AB rh(-)</option>
                            <option value="0 rh(+)">0 rh(+)</option>
                            <option value="0 rh(-)">0 rh(-)</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">

                    <div class="form-group col-md-6 ">
                        <label for="inputAskerlik"><?=$diller['askerlik']?></label>
                        <input type="text" name="askerlik" class="form-control"  id="inputAskerlik"  placeholder="<?=$diller['askerlik-aciklamasi']?>" required  >
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="inputEhliyet"><?=$diller['ehliyet']?></label>
                        <input type="text" name="ehliyet" class="form-control"  id="inputEhliyet"  placeholder="<?=$diller['ehliyet-aciklamasi']?>" required >
                    </div>

                </div>


                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="textareaEgitim"><?=$diller['egitim-durumu']?></label>
                        <textarea class="form-control" id="textareaEgitim" rows="3"  name="egitim" required></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="textareaYabanciDil"><?=$diller['yabanci-dil-durumu']?></label>
                        <textarea class="form-control" id="textareaYabanciDil" rows="3"  name="yabancidil" required></textarea>
                    </div>

                </div>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="textareaTecrube"><?=$diller['calisma-tecrubeleri']?></label>
                        <textarea class="form-control" id="textareaTecrube" rows="3"  name="tecrube" required></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="textareaBilgi"><?=$diller['bilgi-referans']?></label>
                        <textarea class="form-control" id="textareaBilgi" rows="3"  name="kisabilgi" required></textarea>
                    </div>

                </div>

                <?php
                if($ayar['site_captcha'] == 1)
                {
                ?>
                <!-- GÜVENLİK CAPTCHA ========== !-->
                <div class="form-row">

                  <?php $kod=$_SESSION['secure_code'];?>



                    <div class="form-group col-md-4 ">
                        <label for="inputCaptcha"><?=$diller['guvenlik-kodu']?></label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img src='includes/template/captcha.php'/></div>
                            </div>
                            <input type="text" class="form-control form-captcha-height" id="inputCaptcha"   name="secure_code" maxlength="5" required >
                        </div>
                    </div>

                </div>
                <!-- GÜVENLİK CAPTCHA ========== !-->
                <?php }?>

                <button type="submit" name="ikgonder" class="btn btn-danger"><?=$diller['basvuruyu-gonder']?></button>
            </form>


        </div></div>



</div>

<!-- CONTENT AREA ============== !-->


<?php if($_GET['status']=='success'){ ?>
    <script>
        $(document).ready(function () {
            swal({
                title: "<?=$diller['post-basarili']?>",
                text: "<?=$diller['post-basvuru-basarili-aciklamasi']?>",
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
    <meta http-equiv="refresh" content="3; URL=insan-kaynaklari">
<?php }?>
<?php if(isset($_SESSION['ikArray']) && $_SESSION['ikArray']['status'] == 'error'){ ?>
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
    <meta http-equiv="refresh" content="3; URL=insan-kaynaklari">
    <?php unset($_SESSION['ikArray']); ?>
<?php }?>



<?php include 'includes/template/footer.php'?>
</body>
</html>
<?php include "includes/config/footer_libs.php";?>

