<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Yöneticiler | <?=$ayar['site_baslik']?></title>
<?php
$yoneticiCek = $db ->prepare("select * from yonetici order by id desc ");
$yoneticiCek ->execute();
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-account-edit"></i> Yöneticiler</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Yöneticiler</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12" >

        <a role="button"    href="pages.php?sayfa=yoneticiekle" class="btn btn-info m-b-15" style="color:#FFF" ><i class="fa fa-plus-circle"></i> Yönetici Ekle</a>

    </div>

    <div class="col-12">
        <div class="card" >
            <div class="card-body bg-secondary" >

                <h3 class="card-title m-b-25">Site Yöneticileri</h3>
                <h6 class="card-subtitle">Bu alanda sitenizdeki yöneticileri görüntüleyebilirsiniz.</h6>

            </div>

        </div>
    </div>


    <div class="col-12" >
        <div class="card" style="margin-bottom: 0 !important;">
            <div class="card-body" style="padding: 15px !important;">


                <?php if ($yoneticiCek->rowCount() > 0) {?>
                <div class="table-responsive"  >
                    <table class="table table-bordered table-striped" style="font-family: 'Open Sans', Arial; margin-bottom: 0 !important;" >
                        <thead>
                        <tr>
                            <th width="100" style="border-top: 0 !important; border-bottom: 0 !important; border-left:0 !important; text-align: center">PROFİL</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center" width="80">ID</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important;">İSİM</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important;">KULLANICI ADI</th>
                            <th class="text-nowrap" style="text-align: center; border-top: 0 !important; border-bottom: 0 !important; border-right: 0 !important;" width="100">#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($yoneticiCek as $yon) {    ?>
                        <tr>


                            <td style="border-left:0 !important; text-align: center">
                            <?php if ($yon['foto'] == !null) {?>
                                <img src="../assets/images/users/<?=$yon['foto']?>" style="width: 50px; height: 50px; border-radius: 100%;">
                                <?php } else { ?>
                                <img src="support/images/user_default.png" style="width: 50px; height: 50px; border-radius: 100%;">
                                <?php }?>
                            </td>

                            <td style="text-align: center; font-weight: 400;"><?=$yon['id']?></td>

                            <td style="font-weight: 400;"><?=$yon['isim']?></td>

                            <td style="font-weight: 600;">
                                <?=$yon['user_adi']?>
                            </td>


                            <td class="text-nowrap" style="text-align: center; border-right: 0 !important; vertical-align: middle !important;">
                                <a  href="pages.php?sayfa=yoneticiler&yonetici_id=<?=$yon['id']?>" class="btn btn-sm btn-info" style="color:#FFF"><i class="fa fa-pencil text-inverse"></i> Düzenle </a>
                                <a  onclick="deletebutton('<?=$yon['id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>
                            </td>

                        </tr>
                       <?php }?>



                        </tbody>
                    </table>




                </div>





                <?php } else {?>
                <div class="alert alert-info" style="font-weight: 400">
                   Yönetici Eklenmemiş! Hemen eklemelisiniz.
                </div>
                <?php }?>
            </div>
        </div>
    </div>




</div>




<script type="text/javascript">

    function deletebutton(yoneticiid){

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
                window.location.href = "support/post/delete/yonetici-sil.php?yonetici=success&id="+yoneticiid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>

<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=yonetici">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=yonetici">
<?php }?>
