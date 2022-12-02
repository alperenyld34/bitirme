<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Varyant Seçeneği Ekle | <?=$ayar['site_baslik']?></title>
<?php
$Siralama = $db->prepare("select * from varyant_oz where varyant_id='$_GET[varyant_id]' ");
$Siralama->execute();

$degerCek = $db->prepare("select * from varyant where id='$_GET[varyant_id]'");
$degerCek->execute();
$pr = $degerCek->fetch(PDO::FETCH_ASSOC);

?>
<?php
if($degerCek->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=urunler");
}
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-table-edit"></i> Varyant Seçeneği Ekle</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=urunler">Ürünler</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Varyantlar</a></li>
                <li class="breadcrumb-item active">Varyant Seçeneği Ekle</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card" >
            <div class="card-body text-white" style="background: linear-gradient(to right, #4568dc, #b06ab3);" >

                <h3 class="card-title" style="margin-bottom: 0 !important;">Varyant Adı :  <?=$pr['baslik']?> </h3>

            </div>

        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">




            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/insert/varyant-ozellik-ekle.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="varyant_id" value="<?=$pr['id']?>">
                    <input type="hidden" name="tur" value="0">

                    <h3 class="card-title">Varyant Seçeneği Ekle</h3>
                    <hr>
                    <div class="form-body">




                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="ozellikAd" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">VARYANT ÖZELLİĞİ</label>
                            <div class="col-md-6">
                                <input type="text" name="ozellik" required class="form-control" id="ozellikAd">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3" for="siraArea" style="margin-top: 9px; margin-bottom: 10px; font-weight: 600">Görünüm Sırası</label>
                            <div class="col-md-1">
                                <input type="number" name="sira" required class="form-control" id="siraArea" value="<?=$Siralama->rowCount()+1;?>"  min=1 oninput="validity.valid||(value='');">
                            </div>
                        </div>


                        <div class="form-actions">
                            <button type="submit" class="btn btn-success" name="varyantekle">
                                <i class="fa fa-save"></i>
                                Kaydet
                            </button>
                        </div>



                </form>

                    </div>



            </div>







        </div>
    </div>
</div>

