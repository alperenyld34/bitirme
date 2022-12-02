<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
$siraCek = $db->prepare("select * from sss where dil='$_SESSION[dil]'");
$siraCek->execute();
?>

<title>Yeni Soru Ekle | <?=$ayar['site_baslik']?></title>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-help-circle"></i> Yeni Soru Ekle</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=sorular">Sık Sorulan Sorular</a></li>
                <li class="breadcrumb-item active">Yeni Soru Ekle</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial; padding: 0.25em;">

                <div class="card-body p-b-0">
                    <h3 class="card-title">Yeni Soru Ekle <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span></h3>

                <hr>

                <!-- Nav tabs -->

                <!-- Tab panes -->
                <form action="support/post/insert/soru-ekle.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="dil" value="<?=$_SESSION['dil']?>">

                <div class="tab-content">
                    <div class="tab-pane active" id="genel" role="tabpanel">
                        <div>


                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="control-label" for="yayin" style="margin-bottom: 13px; font-weight: 600">Yayın Durumu</label>
                                        <br>
                                        <input type='hidden' value='0' name='durum'>
                                        <input type="checkbox" checked id="yayin" class="js-switch" data-color="#f62d51" name="durum" value="1" />
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="control-label" for="yahomeDurum" style="margin-bottom: 13px; font-weight: 600">Anasayfa</label>
                                        <br>
                                        <input type='hidden' value='0' name='anasayfa'>
                                        <input type="checkbox" checked id="yahomeDurum" class="js-switch" data-color="#f62d51" name="anasayfa" value="1" />
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="basLik">Soru</label>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="text" name="soru" class="form-control" id="basLik" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="font-weight: 500" for="siraArea">Sıra</label>
                                        <br><br>
                                        <div class="input-group" >
                                            <input type="number" name="sira" class="form-control" id="siraArea" value="<?=$siraCek->rowCount()+1;?>" required min=1 oninput="validity.valid||(value='');">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label style="font-weight: 500" for="cevapArea">Soru Cevabı </label><br><br>
                                    <textarea name="cevap" rows="3" id="cevapArea" class="form-control" required ></textarea>
                                </div>
                            </div>



                        </div>
                    </div>


</div>
                </div>

                    <div class="form-actions p-l-20 p-b-20">
                        <button type="submit" class="btn btn-success" name="soruekle">
                            <i class="fa fa-save"></i>
                            Kaydet
                        </button>
                    </div>

                </form>

            </div>







        </div>
    </div>
</div>

<?php if($_GET['status']=='imgtype'){ ?>
    <body onload="sweetAlert('HATA!', 'Görsel dosyanız jpg, png veya gif türü dışında olamaz', 'warning');">
    </body>
<?php }?>