<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Ürün Markaları | <?=$ayar['site_baslik']?></title>
<?php
$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from urun_marka  order by id DESC");
$ToplamVeri = $Say->rowCount();
$Limit = 20;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$ara = $_GET['search'];
$listele_tablo = $db->query("select * from urun_marka where (baslik like '%$ara%' ) order by sira ASC limit $Goster,$Limit");
$tabloAl = $listele_tablo->fetchAll(PDO::FETCH_ASSOC);

/////////////////////////* Marka Insert ///////////////////////////////////////////*/
if(isset($_POST['markaEkle'])  ) {
    if($_POST['baslik'] && $_POST['sira']  ) {


if ($_FILES['gorsel']["size"] > '0') {
    $dosyas = $_FILES["gorsel"];
    if ($dosyas['type'] == 'image/jpg' || $dosyas['type'] == 'image/jpeg' || $dosyas['type'] == 'image/png') {
        $kaynak = $_FILES["gorsel"]["tmp_name"];
        $dosya = $_FILES["gorsel"]["name"];
        $uzanti = explode(".", $_FILES['gorsel']['name']);
        $random = rand(0, 9999999999999);
        $random2 = rand(0, 999);
        $yeni_isim = $random . "-" . $random2 . "-" . $dosya;
        $hedef = "../images/uploads/" . $yeni_isim;
        $gitti = move_uploaded_file($kaynak, $hedef);



        $kaydet = $db->prepare("INSERT INTO urun_marka SET
        baslik=:baslik,
        gorsel=:gorsel,
        sira=:sira,
        durum=:durum
");
        $sonuc = $kaydet->execute(array(
            'baslik' => $_POST['baslik'],
            'gorsel' => $yeni_isim,
            'sira' => $_POST['sira'],
            'durum' => '1'
        ));
        if($sonuc){
            header('Location:pages.php?sayfa=urunmarkalari&status=success');
        }else{
            echo 'Veritabanı Hatası';
        }
    }else{
        header('Location:pages.php?sayfa=urunmarkalari&status=imgtype');
    }
}else{
    $markaGorsel = null;
    $kaydet = $db->prepare("INSERT INTO urun_marka SET
        baslik=:baslik,
        gorsel=:gorsel,
        sira=:sira,
        durum=:durum
");
    $sonuc = $kaydet->execute(array(
        'baslik' => $_POST['baslik'],
        'gorsel' => $markaGorsel,
        'sira' => $_POST['sira'],
        'durum' => '1'
    ));
    if($sonuc){
        header('Location:pages.php?sayfa=urunmarkalari&status=success');
    }else{
        echo 'Veritabanı Hatası';
    }
}

  }else{
        header('Location:pages.php?sayfa=urunmarkalari&status=warning');
  }
}
/////////////////////////*  <========SON=========>>> Marka Insert SON ///////////////////////////////////////////*/
///
///
///todo ürün marka
/// 
/// 
/* Update */
if(isset($_POST['markaDuzenle'])  ) {
    if ($_POST['baslik'] && $_POST['sira']) {
        if ($_FILES['gorsel']["size"] > '0') {
            unlink("../images/uploads/$_POST[eski_gorsel]");
            $dosyas = $_FILES["gorsel"];
            if ($dosyas['type'] == 'image/jpg' || $dosyas['type'] == 'image/jpeg' || $dosyas['type'] == 'image/png') {
                $kaynak = $_FILES["gorsel"]["tmp_name"];
                $dosya = $_FILES["gorsel"]["name"];
                $uzanti = explode(".", $_FILES['gorsel']['name']);
                $random = rand(0, 9999999999999);
                $random2 = rand(0, 999);
                $yeni_isim = $random . "-" . $random2 . "-" . $dosya;
                $hedef = "../images/uploads/" . $yeni_isim;
                $gitti = move_uploaded_file($kaynak, $hedef);
                $guncelle = $db->prepare("UPDATE urun_marka SET
                   baslik=:baslik,
                   gorsel=:gorsel,
                   sira=:sira,
                   durum=:durum
            WHERE id={$_POST['hidden_id']}      
           ");
                $sonuc = $guncelle->execute(array(
                    'baslik' => $_POST['baslik'],
                    'gorsel' => $yeni_isim,
                    'sira' => $_POST['sira'],
                    'durum' => $_POST['durum']
                ));
                if($sonuc){
                    header('Location:pages.php?sayfa=urunmarkalari&status=success');
                }else{
                    echo 'Veritabanı Hatası';
                }
            }else{
                header('Location:pages.php?sayfa=urunmarkalari&status=imgtype');
            }
        }else{
           $guncelle = $db->prepare("UPDATE urun_marka SET
                   baslik=:baslik,
                   sira=:sira,
                   durum=:durum
            WHERE id={$_POST['hidden_id']}      
           ");
           $sonuc = $guncelle->execute(array(
               'baslik' => $_POST['baslik'],
               'sira' => $_POST['sira'],
               'durum' => $_POST['durum']
           ));
           if($sonuc){
               header('Location:pages.php?sayfa=urunmarkalari&status=success');
           }else{
           echo 'Veritabanı Hatası';
           } 
        }
    }else{
        header('Location:pages.php?sayfa=urunmarkalari&status=warning'); 
    }
}
/*  <========SON=========>>> Update SON */

/* Sil */
if($_GET['sil']=='success'  ) {
    $markaBul = $db->prepare("select * from urun_marka where id=:id ");
    $markaBul->execute(array(
            'id' => $_GET['id'],
    ));
    $bulmarka =  $markaBul->fetch(PDO::FETCH_ASSOC);


    /* Önce görseli sil */
    if($bulmarka['gorsel'] == !null ) {
     $markaresimsil = unlink("../images/uploads/$bulmarka[gorsel]");
        $silmeislem = $db->prepare("DELETE from urun_marka WHERE id=:id ");
        $silmeislem->execute(array(
            'id' => $_GET['id']
        ));
        if ($silmeislem) {
            header('Location:pages.php?sayfa=urunmarkalari&status=success');
        }else {
            echo 'veritabanı hatası';
        }
    }else{
        $silmeislem = $db->prepare("DELETE from urun_marka WHERE id=:id ");
        $silmeislem->execute(array(
            'id' => $_GET['id']
        ));
        if ($silmeislem) {
            header('Location:pages.php?sayfa=urunmarkalari&status=success');
        }else {
            echo 'veritabanı hatası';
        }
    }
    /*  <========SON=========>>> Önce görseli sil SON */

}
/*  <========SON=========>>> Sil SON */


/* Resim Sil */
if($_GET['gorselsil'] == 'success'  ) {
    $markaBul = $db->prepare("select * from urun_marka where id=:id ");
    $markaBul->execute(array(
        'id' => $_GET['id'],
    ));
    $bulmarka =  $markaBul->fetch(PDO::FETCH_ASSOC);
    if($bulmarka['gorsel'] == !null ) {
        $guncelle = $db->prepare("UPDATE urun_marka SET
                gorsel=:gorsel
         WHERE id={$_GET['id']}      
        ");
        $sonuc = $guncelle->execute(array(
            'gorsel' => null
        ));
        if($sonuc){
            $markaresimsil = unlink("../images/uploads/$bulmarka[gorsel]");
            header('Location:pages.php?sayfa=urunmarkalari&status=success');
        }else{
        echo 'Veritabanı Hatası';
        }
    }
}
/*  <========SON=========>>> Resim Sil SON */
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Ürün Markaları</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Ürün Markaları</li>
            </ol>
        </div>
    </div>
</div>

<form action="support/post/multi-delete/urun-marka-sil.php" method="post">
<div class="row">




    <div class="col-md-12" style="text-align: left" >


        <a role="button"  data-toggle="modal" data-target="#yeniekle" class="btn btn-info m-b-15" style="color:#FFF" ><i class="fa fa-plus-circle"></i> Yeni Marka Ekle</a>




        <button type="submit"  class="btn btn-danger m-b-15" style="color:#FFF"><i class="fa fa-trash"></i> Seçilenleri Sil</button>

    </div>

    <div class="col-12">
        <div class="card" >
            <div class="card-body bg-secondary" >

                <h3 class="card-title m-b-25">Ürün Markaları</h3>
                <h6 class="card-subtitle">Ürün markaları oluşturabilirsiniz</h6>

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

                                <div class="form-checkbox" style="overflow: hidden; height: 24px;">
                                    <input type="checkbox" class="selectall" id="hepsiniSecCheckBox" />
                                    <label for="hepsiniSecCheckBox"></label>
                                </div>

                            </th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; text-align: center;" width="100">SIRA</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important;">MARKA ADI</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; text-align: center; width: 120px">DURUM</th>

                            <th class="text-nowrap" width="180" style="text-align: center; border-top: 0 !important; border-bottom: 0 !important; border-right: 0 !important;">#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($tabloAl as $row) {

                            ?>
                        <tr>
                            <td style="border-left:0 !important;">
                                <div class="form-checkbox">
                                <input type="checkbox" name='sil[]' id="checkSec-<?=$row['id']?>" value="<?=$row['id']?>" class="individual">
                                <label for="checkSec-<?=$row['id']?>"></label>
                                </div>
                            </td>
                            <td style="font-weight: 400; text-align: center;">
                                <?=$row['sira']?>
                            </td>
                            <td style="font-weight: 400">
                                <?php if($row['gorsel'] == !null ) {?>
                                    <img src="<?=$ayar['site_url']?>images/uploads/<?=$row['gorsel']?>" style="border: 1px solid #EBEBEB; padding: 5px; margin-right: 10px; max-width: 70px;  ">
                                <?php }?>
                                <?=$row['baslik']?>
                            </td>
                            <td style="font-weight: 400; text-align: center">
                                <?php
                                if($row['durum'] == 1) {
                                    ?>
                                    <span class="btn btn-success btn-sm"><i class="fa fa-check"></i> Aktif</span>
                                <?php } ?>
                                <?php
                                if($row['durum'] == 0) {
                                    ?>
                                    <span class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Pasif</span>
                                <?php } ?>
                            </td>

                            <td class="text-nowrap" style="text-align: center; border-right: 0 !important;">
                                <a data-id="<?=$row['id']?>" class="btn btn-sm btn-info duzenleAjax" style="color:#FFF"><i class="fa fa-pencil text-inverse"></i> Düzenle </a>
                                <a  onclick="deletebutton('<?=$row['id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>
                            </td>

                        </tr>


                       <?php }?>



                        </tbody>
                    </table>




                </div>






                    <!---- Sayfalama Elementleri ================== !-->
                    <?php if($Sayfa >= 1){?>
                        <nav aria-label="Page navigation example" style="margin-top:20px;">
                        <ul class="pagination">
                    <?php } ?>

                    <?php if($Sayfa > 1){?>

                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=urunmarkalari&page="><?=$diller['sayfalama-ilk']?></a></li>
                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=urunmarkalari&page=<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

                    <?php } ?>
                    <?php
                    for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                        if($i == $Sayfa){

                            echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="pages.php?sayfa=urunmarkalari&page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';

                        }else{
                            echo '
                    <li class="page-item"><a class="page-link" href="pages.php?sayfa=urunmarkalari&page='.$i.'">'.$i.'</a></li>
                    ';
                        }
                    }
                    }
                    ?>

                    <?php if($listele_tablo->rowCount() <=0) { } else { ?>
                        <?php if($Sayfa != $Sayfa_Sayisi){?>

                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=urunmarkalari&page=<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=urunmarkalari&page=<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


                        <?php }} ?>

                    <?php if($Sayfa >= 1){?>
                        </ul>
                        </nav>
                    <?php } ?>
                    <!---- Sayfalama Elementleri ================== !-->




                <?php } else {?>
                <div class="alert alert-info" style="font-weight: 400">
                  Marka bulunamadı!
                    <?php if(isset($_GET['search'])) {?>
                        <a href="pages.php?sayfa=urunmarkalari">Geri Dön</a>
                    <?php }?>
                </div>
                <?php }?>

            </div>
        </div>


    </div>




</div>
</form>

<!-- ARAMA !-->
<?php
if ($listele_tablo->rowCount()>0) {
?>
<div class="col-md-12 p-l-0 p-r-0" style="border-top: 1px solid #EBEBEB">
<div class="card p-l-5 p-b-15 p-t-20 bg-secondary">

    <form method="get" action="pages.php?" >
        <div class="form-row align-items-center">

            <div class="col-auto">
                <input type="hidden" class="form-control mb-2" id="inlineFormInput" name="sayfa" value="urunmarkalari">
            </div>

            <div class="col-auto">
                <input type="text" class="form-control mb-2" id="inlineFormInput" required name="search" placeholder="Başlık ">
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Ara</button>
            </div>
        </div>
    </form>

</div>
</div>
<?php } ?>
<!-- ARAMA !-->


<script type="text/javascript">

    function deletebutton(markaid){

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
                window.location.href = "pages.php?sayfa=urunmarkalari&sil=success&id="+markaid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>


<?php if($_GET['status']=='imgtype'){ ?>
    <body onload="sweetAlert('HATA!', 'Görsel dosyanız jpg, png veya gif türü dışında olamaz', 'warning');">
    </body>
<?php }?>
<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urunmarkalari">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urunmarkalari">
<?php }?>
<?php if($_GET['status']=='nocheck'){ ?>
    <body onload="sweetAlert('Sorun Var!', 'Hiç seçim yapılmamış!', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urunmarkalari">
<?php }?>
<!-- YENİ EKLE MODAL-->
<div id="yeniekle" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <form method="post" action="pages.php?sayfa=urunmarkalari" enctype="multipart/form-data">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Yeni Marka Ekle</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="baslik" class="control-label">Marka Başlığı :</label>
                            <input type="text" class="form-control" id="baslik" name="baslik" required  >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="sira" class="control-label">Sıra :</label>
                            <input type="number" class="form-control" id="sira" name="sira"  required  >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="gorsel" class="control-label">Marka Görseli :</label>
                            <div class="input-group" style="margin-top: 8px">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="gorsel"  >
                                    <label class="custom-file-label" for="inputGroupFile04">Seç</label>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">İptal</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light" name="markaEkle"><i class="fa fa-save"></i> Kaydet</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.YENİ EKLE MODAL -->



<!-- Düzenle Modal EDITABLE !-->
<div id="duzenle" class="modal fade" data-backdrop="static" >
    <form method="post" action="pages.php?sayfa=urunmarkalari" enctype="multipart/form-data">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Marka Düzenle</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body modal-editable">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">İptal</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light" name="markaDuzenle"><i class="fa fa-save"></i> Kaydet</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!--  <========SON=========>>> Düzenle Modal EDITABLE SON !-->
<!-- Editable Modal !-->
<script type='text/javascript'>
    $(document).ready(function(){

        $('.duzenleAjax').click(function(){

            var markaID = $(this).data('id');

            // AJAX request
            $.ajax({
                url: 'support/_edit/urun-marka-duzenle.php',
                type: 'post',
                data: {markaID: markaID},
                success: function(response){
                    $('.modal-editable').html(response);
                    $('#duzenle').modal('show');
                }
            });
        });
    });
</script>
<!--  <========SON=========>>> Editable Modal SON !-->