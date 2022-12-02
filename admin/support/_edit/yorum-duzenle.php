<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$degerCek = $db->prepare("select * from yorum where id='$_GET[yorum_id]'");
$degerCek->execute();
$row = $degerCek->fetch(PDO::FETCH_ASSOC);
?>
<?php
if($degerCek->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=yorumlar");
}
?>
    <style>
        .rating {
            display: inline-block;
            position: relative;
            height: 45px;
            font-size: 25px; overflow: hidden;
        }

        .rating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            cursor: pointer;
        }

        .rating label:last-child {
            position: static;
        }

        .rating label:nth-child(1) {
            z-index: 5;
        }

        .rating label:nth-child(2) {
            z-index: 4;
        }

        .rating label:nth-child(3) {
            z-index: 3;
        }

        .rating label:nth-child(4) {
            z-index: 2;
        }

        .rating label:nth-child(5) {
            z-index: 1;
        }

        .rating label input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .rating label .icon {
            float: right;
            color: transparent;
        }

        .rating label:last-child .icon {
            color: #CCC;
        }

        .rating:not(:hover) label input:checked ~ .icon,
        .rating:hover label:hover input ~ .icon {
            color: #ffb400;
        }

        .rating label input:focus:not(:checked) ~ .icon:last-child {
            color: #000;
            text-shadow: 0 0 5px #09f;
        }

    </style>
<title>Yorum Düzenle | <?=$ayar['site_baslik']?></title>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="icon-bubbles"></i> Yorum Düzenle</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=yorumlar">Müşteri Yorumları</a></li>
                <li class="breadcrumb-item active">Yorum Düzenle</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial; padding: 0.25em;">

                <div class="card-body p-b-0">
                    <h3 class="card-title">Yorum Düzenle <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span></h3>

                <hr>

                <!-- Nav tabs -->

                <!-- Tab panes -->
                <form action="support/post/update/yorum-duzenle.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="yorum_id" value="<?=$row['id']?>">
                    <input type="hidden" name="eski_gorsel" value="<?=$row['gorsel']?>">

                <div class="tab-content">
                    <div class="tab-pane active" id="genel" role="tabpanel">
                        <div>


                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="control-label" for="yayin" style="margin-bottom: 13px; font-weight: 600">Yayın Durumu</label>
                                        <br>
                                        <input type='hidden' value='0' name='durum'>
                                        <input type="checkbox" <?php if ($row['durum'] == 1) {?>checked<?php }?> id="yayin" class="js-switch" data-color="#f62d51" name="durum" value="1" />
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group" >
                                        <label style="font-weight: 500" for="basLik">Yıldız Sayısı</label>

                                        <div class="input-group " style="text-align: center !important;" >

                                            <div class="rating">
                                                <label>
                                                    <input type="radio" name="star_rate" <?php if ($row['star_rate'] == 1) {?> checked <?php }?> value="1" />
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="star_rate" <?php if ($row['star_rate'] == 2) {?> checked <?php }?> value="2" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="star_rate" <?php if ($row['star_rate'] == 3) {?> checked <?php }?> value="3" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="star_rate" <?php if ($row['star_rate'] == 4) {?> checked <?php }?> value="4" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="star_rate" <?php if ($row['star_rate'] == 5) {?> checked <?php }?> value="5" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="basLik">İsim</label>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" name="isim" class="form-control" id="basLik" value="<?=$row['isim']?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="positionArea">Müşteri İş Pozisyonu</label>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" name="pozisyon" class="form-control" id="positionArea" value="<?=$row['pozisyon']?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="siraArea">Sıra</label>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="number" name="sira" class="form-control" id="siraArea" value="<?=$row['sira']?>" required min=1 oninput="validity.valid||(value='');">
                                        </div>
                                    </div>
                                </div>



                            </div>




                            <div class="row">
                                <div class="col-md-12 p-l-0 ">
                                    <div class="form-group col-md-12">
                                        <label style="font-weight: 500" for="resim"><i class="fa fa-photo"></i> Müşteri Fotoğrafı (Zorunlu Değildir)</label>

                                        <div style="width: 100%; height: auto; background-color: #FFF; border:1px solid #EBEBEB; padding: 15px; 0 15px 0; text-align: center;  margin-top:8px;">
                                            <?php
                                            if ($row['gorsel'] == 'no-image') {
                                                ?>
                                                <img src="../images/comments/yorum.jpg" alt="">
                                            <?php } else {?>
                                                <img src="../images/comments/<?=$row['gorsel']?>" style="width: 50px; height: 50px; ">
                                            <?php }?>
                                            <br><br>
                                            <small class="form-control-feedback text-purple" style="font-size:13px">Ebat : 50x50</small>
                                        </div>
                                        
                                        <div class="input-group" style="margin-top: 8px">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="gorsel" >
                                                <label class="custom-file-label" for="inputGroupFile04 ">Seç</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label style="font-weight: 500" for="yorumArea"><i class="fa fa-pencil"></i> Müşteri Yorumu </label><br><br>
                                    <textarea name="icerik" rows="3" id="yorumArea" class="form-control" required ><?=$row['icerik']?></textarea>
                                </div>
                            </div>



                        </div>
                    </div>


</div>
                </div>

                    <div class="form-actions p-l-20 p-b-20">
                        <button type="submit" class="btn btn-success" name="yorumdegis">
                            <i class="fa fa-refresh fa-spin fa-fw"></i>
                            <span class="sr-only">Yükleniyor...</span> Güncelle
                        </button>
                    </div>

                </form>

            </div>







        </div>
    </div>
</div>
    <script id="rendered-js">
        $(':radio').change(function () {
            console.log('New star rating: ' + this.value);
        });
        //# sourceURL=pen.js
    </script>
<?php if($_GET['status']=='imgtype'){ ?>
    <body onload="sweetAlert('HATA!', 'Görsel dosyanız jpg, png veya gif türü dışında olamaz', 'warning');">
    </body>
<?php }?>