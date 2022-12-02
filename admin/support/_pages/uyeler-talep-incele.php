<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Destek Talebi Detayları | <?=$ayar['site_baslik']?></title>
<?php
$talepDetay = $db->prepare("select * from uyeler_destek where id='$_GET[talep_id]'");
$talepDetay->execute();
$row = $talepDetay->fetch(PDO::FETCH_ASSOC);
$sonmesaj = $db->prepare("select * from uyeler_destek_mesaj where support_id=:support_id  order by id desc limit 1 ");
$sonmesaj->execute(array(
    'support_id' => $row['support_id'],
));
$msj = $sonmesaj->fetch(PDO::FETCH_ASSOC);

$mesajlar = $db->prepare("select * from uyeler_destek_mesaj where support_id=:support_id order by id asc ");
$mesajlar->execute(array(
    'support_id' => $row['support_id'],
));

    $uyelerr = $db->prepare("select * from uyeler where id=:id ");
        $uyelerr->execute(array(
                'id' => $row['user_id']
        ));
        $uye = $uyelerr->fetch(PDO::FETCH_ASSOC);

?>

<style>
    select {
        background: #FFF !important;
        color:#000 !important;
    }


    select * {
        background:#FFF;
        color:#000;
    }


</style>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-tooltip-text"></i> Destek Talebi Detayları</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=uyeler">Üyeler</a></li>
                <li class="breadcrumb-item">Destek Talepleri</li>
                <li class="breadcrumb-item active">Destek Talebi Detayları</li>
            </ol>
        </div>
    </div>
</div>

<div class="row" style="font-family: 'Open Sans', Arial">


    <div class="col-md-12" style="text-align: left" >


        <a role="button"   href="pages.php?sayfa=cevaplanandestek" class="btn btn-success m-b-15" style="color:#FFF" ><i class="mdi mdi-tooltip-text"></i> Cevaplanan Talepleri Gör</a>
        <a role="button"   href="pages.php?sayfa=aktifdestek" class="btn btn-danger m-b-15" style="color:#FFF" ><i class="mdi mdi-tooltip-text"></i> Açık Talepleri Gör</a>
    </div>

    <div class="col-md-12">

        <div class="card card-body printableArea" >



            <div class="card-body text-white" style="background: linear-gradient(to right, #4568dc, #b06ab3);" >

                <h3 class="card-title text-left" style="margin-bottom: 0 !important; ">
                    Destek Talep No <span style="font-weight: 500">#<?=$row['support_id']?></span>
                </h3>

            </div>



            <div class="row m-t-0">

                <div class="col-12">
                    <div class="card" style="margin-bottom: 0; ">
                        <div class="card-body bg-secondary" >

                            <form class="form-bordered" >
                                <h3 class="card-title">Destek Talebi Detayları</h3>
                                <hr style="background-color: #FFF;">
                                <div class="row" style="font-family: 'Open Sans', Arial; font-size:15px;">
                                    <div class="col-md-3">
                                        <div class="form-group" style="font-weight: 400">
                                            <label style="font-weight: 500" for="basLik">Destek Talebi Numarası</label><br>

                                            #<?=$row['support_id']?>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="font-weight: 400">
                                            <label style="font-weight: 500" for="basLik">Oluşturulma Tarihi</label><br>
                                            <?php echo date_tr('j F Y, H:i', ''.$row['tarih'].''); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="font-weight: 400">
                                            <label style="font-weight: 500" for="basLik">Son İşlem Tarihi</label><br>
                                            <?php echo date_tr('j F Y, H:i', ''.$msj['tarih'].''); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="font-weight: 400">
                                            <label style="font-weight: 500" for="basLik">Konu</label><br>
                                            <?=$row['konu']?>
                                        </div>
                                    </div>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>

            </div>

            <div class="row m-t-0">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body bg-secondary" style="padding-top: 0" >

                            <form method="post" action="support/post/insert/destek-mesaj-ekle.php">
                                <input type="hidden" name="support_id" value="<?=$row['support_id']?>">
                                <input type="hidden" name="normal_id" value="<?=$row['id']?>">
                                <input type="hidden" name="uye_id" value="<?=$uye['id']?>">
                                <h3 class="card-title">Yeni Mesaj Gönder</h3>
                                <hr>
                                <div class="row" >

                                    <div class="col-md-2">
                                        <div class="form-group" style="font-weight: 400">
                                            <label style="font-weight: 500" for="eposta">Bilgilendirme E-Postası Gönder</label><br>
                                            <input type='hidden' value='0' name='eposta'>
                                            <input type="checkbox"  id="eposta" class="js-switch" data-color="#f62d51" name="eposta" value="1" />
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group" style="font-weight: 400">
                                            <textarea name="mesaj" id="" class="form-control" rows="3" required  placeholder="Mesajınızı Buraya Yazın"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" style="font-weight: 400">
                                            <button name="msjgonder" class="btn btn-success" style="font-weight: bold; padding: 25px; width: 100%">
                                                <i class="fa fa-plus-circle"></i> MESAJI GÖNDER
                                            </button>

                                        </div>
                                    </div>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-md-12 m-t-25">

                    <div class="card">
                        <div class="card-body " style="padding-top: 0" >
                    <div class="row ">
                        <h4 style="font-weight: 500"><i class="mdi mdi-tooltip-text" style="margin-right: 10px"></i>Mesajlar (<?=$mesajlar->rowCount()?>)</h4>
                        <hr>

                        <style>
                            .left-msj{width: 100%;  border-bottom: 1px solid #EBEBEB; padding: 15px 30px; }
                            .right-msj{
                               width: 100%;
                                padding: 20px 30px;
                                box-sizing: border-box;
                            }
                        </style>

                        <?php foreach ($mesajlar as $mm) {?>
                            <div style="width: 100%; <?php if($mm['tip'] == '0' ) { ?>background-color: #f8f8f8;<?php }?>  box-sizing: border-box; border: 1px solid #EBEBEB; margin-bottom: 10px;font-family: 'Open Sans', Arial; font-size: 14px; color: #000; font-weight: 400;  ">
                                <div class="left-msj">
                                    <?php if($mm['tip'] == '0' ) { ?>
                                        <strong><i class="fa fa-reply"></i> Siz</strong>
                                    <?php } ?>
                                    <?php if($mm['tip'] == '1' ) { ?>
                                        <strong><i class="fa fa-user"></i>
                                            <a href="pages.php?sayfa=uye&uye_id=<?=$uye['id']?>" target="_blank">
                                                <?=$uye['isim']?> <?=$uye['soyisim']?>
                                            </a>
                                        </strong>
                                    <?php } ?>
                                    <br>
                                   <?php echo date_tr('j F Y, H:i, l ', ''.$mm['tarih'].''); ?>
                                </div>
                                <div class="right-msj">
                                   <?=$mm['mesaj']?>
                                </div>
                            </div>
                        <?php }?>

                    </div>
                </div>
                    </div>



                </div>

            </div>


        </div>




    </div>
</div>





<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'Mesajınız kullanıcıya gönderilmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=talepincele&talep_id=<?=$_GET['talep_id']?>">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=talepincele&talep_id=<?=$_GET['talep_id']?>">
<?php }?>
