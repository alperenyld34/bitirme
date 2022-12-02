<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Varyant Seçenekleri  | <?=$ayar['site_baslik']?></title>
<?php
$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from varyant_oz where varyant_id='$_GET[varyant_id]' order by sira ASC");
$ToplamVeri = $Say->rowCount();
$Limit = 500;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$ara = $_GET['search'];
$listele_tablo = $db->query("select * from varyant_oz where varyant_id='$_GET[varyant_id]' order by sira ASC limit $Goster,$Limit");
$tabloAl = $listele_tablo->fetchAll(PDO::FETCH_ASSOC);

$degerCek = $db->prepare("select * from varyant where id='$_GET[varyant_id]'");
$degerCek->execute();
$pr = $degerCek->fetch(PDO::FETCH_ASSOC);


$urunIDCek = $db->prepare("select * from varyant where id='$_GET[varyant_id]'");
$urunIDCek->execute();
$urunid = $urunIDCek->fetch(PDO::FETCH_ASSOC);
?>
<?php
if($degerCek->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=urunler");
}
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-debug-step-into"></i> Varyant Seçenekleri </h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Varyant Ayarları</a></li>
                <li class="breadcrumb-item active">Varyant Seçenekleri</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">




    <div class="col-md-12" style="text-align: left" >

        <a role="button"   href="pages.php?sayfa=varyantlar&urun_id=<?=$urunid['urun_id']?>" class="btn btn-dark m-b-15" style="color:#FFF" ><i class="fa fa-arrow-left"></i> Geri Dön</a>

        <a role="button" href="pages.php?sayfa=varyantozellikekle&varyant_id=<?=$pr['id']?>" class="btn btn-info m-b-15" style="color:#FFF" ><i class="fa fa-plus-circle"></i> Yeni Seçenek Ekle</a>


    </div>
    <div class="col-12">
        <div class="card" >
            <div class="card-body text-white" style="background: linear-gradient(to right, #4568dc, #b06ab3);" >

                <h3 class="card-title" style="margin-bottom: 0 !important;">Varyant Adı :  <?=$pr['baslik']?> </h3>

            </div>

        </div>
    </div>
    <div class="col-12">
        <div class="card" >
            <div class="card-body bg-secondary" >

                <h3 class="card-title m-b-25">Varyant Seçenekleri  </h3>
                <h6 class="card-subtitle">Seçili varyantınıza özellikler ekleyebilirsiniz.</h6>

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

                            <th  style="border-top: 0 !important; border-bottom: 0 !important;">VARYANT ÖZELLİĞİ</th>

                            <th class="text-nowrap" width="180" style="text-align: center; border-top: 0 !important; border-bottom: 0 !important; border-right: 0 !important;">#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($tabloAl as $row) {    ?>
                        <tr>
                            <td style="border-left:0 !important;">
                                <span class="btn btn-sm btn-dark text-white"><?=$row['sira']?></span>
                            </td>

                            <td style="font-weight: 400">
                                <?=$row['ozellik']?>
                            </td>


                            <td class="text-nowrap" style="text-align: center; border-right: 0 !important;">
                                <a  href="pages.php?sayfa=varyantozellik&ozellik_id=<?=$row['id']?>" class="btn btn-sm btn-info" style="color:#FFF"><i class="fa fa-pencil text-inverse"></i> Düzenle </a>
                                <a  onclick="deletebutton('<?=$row['id']?>','<?=$row['varyant_id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>
                            </td>

                        </tr>


                       <?php }?>



                        </tbody>
                    </table>




                </div>










                <?php } else {?>
                <div class="alert alert-info" style="font-weight: 400">
                  Henüz bu varyanta seçenek eklenmemiş!
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
                window.location.href = "support/post/delete/varyant-ozellik-sil.php?varyant=success&id="+ozellikid+"&varyant_id="+tabloid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>



<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=varyantozellikleri&varyant_id=<?=$_GET['varyant_id']?>">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=varyantozellikleri&varyant_id=<?=$_GET['varyant_id']?>">
<?php }?>
<?php if($_GET['status']=='nocheck'){ ?>
    <body onload="sweetAlert('Sorun Var!', 'Hiç seçim yapılmamış!', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=varyantozellikleri&varyant_id=<?=$_GET['varyant_id']?>">
<?php }?>
