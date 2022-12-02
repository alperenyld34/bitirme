<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Üye Düzenle | <?=$ayar['site_baslik']?></title>
<?php
$uyeCek = $db->prepare("select * from uyeler where id='$_GET[uye_id]'");
$uyeCek->execute();
$row = $uyeCek->fetch(PDO::FETCH_ASSOC);
?>
<?php
if($uyeCek->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=uyeler");
}
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-account-multiple"></i> Üye Düzenle</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=uyeler">Üye Listesi</a></li>
                <li class="breadcrumb-item active">Üye Düzenle</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/update/uyeler-duzenle.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="uye_id" value="<?=$row['id']?>">

                    <h3 class="card-title">Üye Düzenle</h3>
                    <hr>
                    <div class="form-body">


                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="isim" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Adı</label>
                            <div class="col-md-6">
                                <input type="text" name="isim" required class="form-control" id="isim" value="<?=$row['isim']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="soyisim" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Soyadı</label>
                            <div class="col-md-6">
                                <input type="text" name="soyisim" required class="form-control" id="soyisim" value="<?=$row['soyisim']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="eposta" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">E-Posta Adresi</label>
                            <div class="col-md-6">
                                <input type="email" name="eposta" required class="form-control" id="eposta" value="<?=$row['eposta']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="telefon" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Telefon Numarası</label>
                            <div class="col-md-6">
                                <input type="number" name="telefon" required class="form-control" id="telefon" value="<?=$row['telefon']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="cinsiyet" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Cinsiyet</label>
                            <div class="col-md-6">
                                <select name="cinsiyet" class="form-control" id="cinsiyet" required>
                                    <option <?php if($row['cinsiyet'] =='Erkek' ) { ?>selected<?php }?> value="Erkek">Erkek</option>
                                    <option <?php if($row['cinsiyet'] =='Kadın' ) { ?>selected<?php }?> value="Kadın">Kadın</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="tcno" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">TC No</label>
                            <div class="col-md-6">
                                <input type="number" name="tcno"  class="form-control" id="tcno" value="<?=$row['tcno']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="ip" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">IP Numarası</label>
                            <div class="col-md-6">
                                <input type="text" name="ip" readonly  class="form-control" id="ip" value="<?=$row['ip']?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="uyesifre" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Şifre Değiştir</label>
                            <div class="col-md-6">
                                <input type="text" name="uyesifre"   class="form-control" id="uyesifre" value="">
                                <br>
                                <small class="form-control-feedback text-purple" style="font-size:13px">* Şifre değiştirilmeyecekse alanı boş bırakın</small>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success" name="uyedegis">
                                <i class="fa fa-refresh fa-spin fa-fw"></i>
                                <span class="sr-only">Yükleniyor...</span> Güncelle
                            </button>
                        </div>



                </form>

                    </div>



            </div>







        </div>
    </div>
</div>



<?php if($_GET['status']=='imgtype'){ ?>
    <body onload="sweetAlert('HATA!', 'Görsel dosyanız jpg, png veya gif türü dışında olamaz', 'warning');">
    </body>
<?php }?>
