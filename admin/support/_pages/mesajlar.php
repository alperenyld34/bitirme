<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Gelen Kutusu | <?=$ayar['site_baslik']?></title>
<?php
$mesajjkutusuu = $db ->prepare("select * from mesaj order by id desc");
$mesajjkutusuu ->execute();
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-email"></i> Gelen Kutusu</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Gelen Kutusu</li>
            </ol>
        </div>
    </div>
</div>


<form action="support/post/multi-delete/mesajlari-sil.php" method="post">
<div class="row">

    <?php if ($mesajjkutusuu->rowCount() > 0) {?>
    <div class="col-md-12" >

        <button type="submit"  class="btn btn-danger m-b-15" style="color:#FFF"><i class="fa fa-trash"></i> Seçilenleri Sil</button>

    </div>
    <?php }?>


    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Gelen Kutusu (<?=$mesajjkutusuu->rowCount()?>)</h3>
                <h6 class="card-subtitle">Bu sayfada iletişim formundan gelen mesajları görebilirsiniz</h6>
                <div class="table-responsive m-t-10">
                    <table id="myTable" class="table table-bordered table-striped" style="font-family: 'Open Sans', Arial; font-weight: 400;">
                        <thead>
                        <tr>
                            <th>



                            </th>
                            <th style="text-align: center">DURUM</th>
                            <th>İSİM</th>
                            <th>E-POSTA</th>
                            <th>TELEFON</th>

                            <th>GÖNDERİLME TARİHİ</th>
                            <th style="text-align: right">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($mesajjkutusuu as $mesaj) {?>

                        <tr>
                            <td>

                                <div class="form-checkbox">
                                    <input type="checkbox" name='sil[]' id="checkSec-<?=$mesaj['id']?>" value="<?=$mesaj['id']?>" class="individual">
                                    <label for="checkSec-<?=$mesaj['id']?>"></label>
                                </div>


                            </td>
                            <td style="text-align: center">
                                <?php if ($mesaj['durum'] == 1) {?>
                                    <span class="badge badge-success" style="font-weight: 500; font-size:12px;"><i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i>
<span class="sr-only">Loading...</span> OKUNMAMIŞ</span>
                                <?php } else {?>
                                    <span class="badge badge-secondary" style="font-weight: 500; font-size:12px;"><i class="fa fa-check"></i> OKUNDU</span>
                                <?php }?>
                            </td>
                            <td><?=$mesaj['isim']?></td>
                            <td><?=$mesaj['eposta']?></td>
                            <td><?=$mesaj['telno']?></td>

                            <td><?php echo date_tr('j F Y, H:i, l ', ''.$mesaj['tarih'].''); ?></td>
                            <td style="text-align: center;" width="15%;">

                                <a  href="pages.php?sayfa=mesaj&mesaj_id=<?=$mesaj['id']?>" class="btn btn-sm btn-info" style="color:#FFF;  font-weight: 500"><i class="fa fa-eye text-inverse"></i> MESAJI OKU </a>

                                <a  onclick="deletebutton('<?=$mesaj['id']?>')" class="btn btn-sm btn-danger" style="color:#FFF;  font-weight: 500"><i class="fa fa-times text-inverse"></i> Sil </a>

                            </td>
                        </tr>

                        <?php }?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




</div>
</form>



<script type="text/javascript">

    function deletebutton(mesajid){

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
                window.location.href = "support/post/delete/mesaj-sil.php?mesaj=success&id="+mesajid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>

<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=mesajlar">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=mesajlar">
<?php }?>

<?php if($_GET['status']=='nocheck'){ ?>
    <body onload="sweetAlert('Sorun Var!', 'Hiç seçim yapılmamış!', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=mesajlar">
<?php }?>
