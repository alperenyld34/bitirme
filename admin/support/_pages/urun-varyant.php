<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Ürün Varyant Ayarları  | <?=$ayar['site_baslik']?></title>
<?php
$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from varyant where urun_id='$_GET[urun_id]' order by sira ASC");
$ToplamVeri = $Say->rowCount();
$Limit = 500;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$ara = $_GET['search'];
$listele_tablo = $db->query("select * from varyant where urun_id='$_GET[urun_id]' order by sira ASC limit 4");
$tabloAl = $listele_tablo->fetchAll(PDO::FETCH_ASSOC);

$degerCek = $db->prepare("select * from urun where id='$_GET[urun_id]'");
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
        <h4 class="text-themecolor"><i class="mdi mdi-debug-step-into"></i> Ürün Varyant Ayarları </h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Ürün Varyant Ayarları</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">




    <div class="col-md-12" style="text-align: left" >

        <a role="button"   href="pages.php?sayfa=urunler" class="btn btn-dark m-b-15" style="color:#FFF" ><i class="fa fa-arrow-left"></i> Geri Dön</a>

        <?php if($ToplamVeri < 4) {?>
        <a role="button" href="pages.php?sayfa=varyantekle&urun_id=<?=$pr['id']?>" class="btn btn-info m-b-15" style="color:#FFF" ><i class="fa fa-plus-circle"></i> Yeni Varyant Ekle</a>
        <?php }?>

    </div>
    <div class="col-12">
        <div class="card" >
            <div class="card-body text-white" style="background: linear-gradient(to right, #4568dc, #b06ab3);" >

                <h3 class="card-title" style="margin-bottom: 0 !important;">Ürün :  <?=$pr['baslik']?> </h3>

            </div>

        </div>
    </div>
    <div class="col-12">
        <div class="card" >
            <div class="card-body bg-secondary" >

                <h3 class="card-title m-b-25">Ürün Varyant Ayarları  </h3>
                <h6 class="card-subtitle">Ürününüze varyant seçenekleri ekleyebilirsiniz. Mecburi değildir</h6>

            </div>

        </div>
    </div>
    <div class="col-12">
        <div class="card" >
            <div class="card-body bg-danger  text-white"  style="font-family: 'Open Sans', Arial; font-size:15px; font-weight: 400">

                <i class="fa fa-info-circle"></i> EN FAZLA <b> 4 ADET</b> VARYANT EKLENEBİLİR


            </div>

        </div>
    </div>




    <div class="col-12" >
        <div class="card"  style="margin-bottom: 0 !important;">
            <div class="card-body" style="padding: 15px !important;">


                <?php if ($listele_tablo->rowCount() > 0) {?>
                <div class="table-responsive"  >
                    <table class="table table-bordered table-striped" style="font-family: 'Open Sans', Arial; margin-bottom: 0 !important;" >
                        <thead>
                        <tr>
                            <th width="1%" style="border-top: 0 !important; border-bottom: 0 !important; border-left:0 !important;">
                                SIRA
                            </th>

                            <th  style="border-top: 0 !important; border-bottom: 0 !important;" width="180"></th>

                            <th  style="border-top: 0 !important; border-bottom: 0 !important;">VARYANT ADI</th>

                            <th class="text-nowrap" width="180" style="text-align: center; border-top: 0 !important; border-bottom: 0 !important; border-right: 0 !important;">#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($tabloAl as $row) {
                            $ozCeksene = $db->prepare("select * from varyant_oz where varyant_id='$row[id]' order by sira ASC");
                            $ozCeksene->execute();
                            ?>
                        <tr>
                            <td style="border-left:0 !important;">
                                <span class="btn btn-sm btn-dark text-white"><?=$row['sira']?></span>
                            </td>


                            <td style="font-weight: 400; text-align: center">
                                <a href="pages.php?sayfa=varyantozellikleri&varyant_id=<?=$row['id']?>" class="btn btn-sm btn-primary text-white"><i class="fa fa-caret-right"></i> SEÇENEKLER</a>
                            </td>

                            <td style="font-weight: 400">
                                <?=$row['baslik']?>
                                <?php if ($ozCeksene->rowCount()>0) {?>
                                    <span style="font-size:13px; color:#666; font-style: italic ">
                                    <?php foreach ($ozCeksene as $oz) { ?>
                                        <span class="badge badge-success"><?=$oz['ozellik']?></span>
                                    <?php }?>
                                    </span>
                                <?php }else {?>
                                <span style="font-size:13px; color:#666; font-style: italic "> - Seçenek Ekleyin</span>
                                <?php }?>

                            </td>


                            <td class="text-nowrap" style="text-align: center; border-right: 0 !important;">
                                <a  href="pages.php?sayfa=varyant&varyant_id=<?=$row['id']?>" class="btn btn-sm btn-info" style="color:#FFF"><i class="fa fa-pencil text-inverse"></i> Düzenle </a>
                                <a  onclick="deletebutton('<?=$row['id']?>','<?=$row['urun_id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>
                            </td>

                        </tr>


                       <?php }?>



                        </tbody>
                    </table>




                </div>










                <?php } else {?>
                <div class="alert alert-info" style="font-weight: 400">
                  Henüz bu ürüne varyant özellik eklenmemiş!
                </div>
                <?php }?>

            </div>
        </div>


    </div>




</div>




<script type="text/javascript">

    function deletebutton(ozellikid,tabloid){

        swal({
            title: "Silmek İstediğinize Emin Misiniz?",
            text: "Seçtiğiniz içerik kalıcı olarak silinecektir",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sil",
            cancelButtonText: "İptal",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {
                window.location.href = "support/post/delete/varyant-sil.php?varyant=success&id="+ozellikid+"&urun_id="+tabloid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>



<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=varyantlar&urun_id=<?=$_GET['urun_id']?>">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=varyantlar&urun_id=<?=$_GET['urun_id']?>">
<?php }?>
<?php if($_GET['status']=='nocheck'){ ?>
    <body onload="sweetAlert('Sorun Var!', 'Hiç seçim yapılmamış!', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=varyantlar&urun_id=<?=$_GET['urun_id']?>">
<?php }?>
