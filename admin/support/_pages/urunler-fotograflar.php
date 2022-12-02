<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Ürün Galerisi | <?=$ayar['site_baslik']?></title>
<?php
//todo xml
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<?php
$urunBilgisi = $db ->prepare("select * from urun where id='$_GET[urun_id]'");
$urunBilgisi ->execute();
$urun = $urunBilgisi->fetch(PDO::FETCH_ASSOC);

if($urun['galeri_xml_durum'] == '1'  ) {
    $fotolar = $db ->prepare("select * from urun_galeri where xml_urun_id='$urun[xml_urun_id]' order by sira asc ");
    $fotolar ->execute();
}
if($urun['galeri_xml_durum'] == '0' || $urun['galeri_xml_durum'] == null ) {
    $fotolar = $db ->prepare("select * from urun_galeri where urun_id='$_GET[urun_id]' order by sira asc ");
    $fotolar ->execute();
}

?>
<?php
if($urunBilgisi->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=urunler");
}
?>
<style>
    section {
        flex-grow: 1;
    }

    .file-drop-area {
        position: relative;
        display: inline-block;

        width: auto;
        max-width: 100%; text-align: center;
        padding: 25px;
        border-radius: 3px;
        transition: 0.2s;
    }
    .file-drop-area.is-active {
        background-color: #f8f9fa!important;
    }

    .fake-btn {
        flex-shrink: 0;
        background-color: #FFF;
        border: 1px dashed #CCC;
        border-radius: 3px;
        padding: 8px 15px;
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 400; margin: 15px;
    }

    .file-msg {
        font-size: 16px;
        font-weight: 400;
        line-height: 2.5;
        overflow: hidden;

    }

    .file-input {
        position: absolute;
        left: 0;
        top: 0; margin-bottom: 20px !important;
        height: 100%;
        width: 100%;
        cursor: pointer;
        opacity: 0;
    }
    .file-input:focus {
        outline: none;
    }
</style>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-camera-enhance"></i> Ürün Galerisi</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=urunler">Ürünler</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=urun&urun_id=<?=$urun['id']?>"><?=$urun['baslik']?></a></li>
                <li class="breadcrumb-item active">Ürün Galerisi</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">


    <div class="col-md-12" >
        <a role="button"    href="pages.php?sayfa=urunler" class="btn btn-dark m-b-15" style="color:#FFF" ><i class="fa fa-arrow-left"></i> Geri Dön</a>
    </div>

    <div class="col-12">
        <div class="card" >
            <div class="card-body text-white" style="background: linear-gradient(to right, #4568dc, #b06ab3);" >

                <h3 class="card-title" style="margin-bottom: 0 !important;"><i class="mdi mdi-camera"></i> <?=$urun['baslik']?> Ürün Galerisi</h3>

            </div>

        </div>
    </div>



    <div class="col-12" >
        <div class="card bg-secondary" style=" border-bottom:1px solid #EBEBEB; ">
            <div class="card-body" style="padding: 15px !important; text-align: center;">

                <form action="support/post/insert/urun-fotograf-ekle.php" method="post" enctype='multipart/form-data'>
                    <input type="hidden" name="urun_id" value="<?=$urun['id']?>">
                        <input type="hidden" name="xml_urun_id" value="<?=$urun['xml_urun_id']?>" >
                        <input type="hidden" name="xml_no" value="<?=$urun['xml_no']?>" >
                <div class="file-drop-area">
                    <span class="fake-btn"><i class="fa fa-photo"></i> Fotoğrafları Seçin</span>
                    <span class="file-msg">ya da dosyaları sürükleyip buraya bırakın</span>
                    <input class="file-input"name='gorsel[]' type="file" required multiple>
                </div>

                <button class="btn btn-success" name="topluresimyukle" type="submit"><i class="fa fa-upload"></i> YÜKLE</button>
                </form>
            </div>
        </div>
    </div>



    <div class="col-12" >
        <div class="card">
            <div class="card-body" style="padding: 15px !important; ">


                <?php if ($fotolar->rowCount() > 0) {?>

                    <table class="table table-bordered table-striped" style="font-family: 'Open Sans', Arial; font-size:15px; font-weight: 500">

                        <tbody class="row_position">
                    <?php
                    foreach ($fotolar as $foto) {
                    ?>


                        <tr  id="<?=$foto['id']?>">
                            <td width="200" height="60" style="text-align: center;" ><?php echo $foto['sira'] ?></td>
                            <td style="cursor: all-scroll">
                                <div id="<?=$foto['id']?>" class="degisken" style="margin: 10px; display: inline-block !important;">

                                    <div class="btn btn-sm btn-danger" style="position: absolute; margin: 5px 0 0 5px; padding: 0!important;">
                                        <a  onclick="deletebutton('<?=$foto['id']?>','<?=$urun['id']?>')" class="btn btn-sm btn-danger" style="color:#FFF; ">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>

                                    <img src="../images/product/<?=$foto['gorsel']?>" style="width: 130px; height: 130px; border:1px solid #EBEBEB">
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                        </tbody>
                    </table>



                <?php } else {?>
                <div class="alert alert-danger text-center" style="font-weight: 400; margin-top: 15px;">
                   <?=$urun['baslik']?> Ürününe Hiç Fotoğraf Eklenmemiş!
                </div>
                <?php }?>
            </div>
        </div>
    </div>




</div>


    <script type="text/javascript">
        $( ".row_position" ).sortable({
            delay: 150,
            stop: function() {
                var selectedData = new Array();
                $('.row_position>tr').each(function() {
                    selectedData.push($(this).attr("id"));
                });
                updateOrder(selectedData);
            }
        });


        function updateOrder(data) {
            $.ajax({
                url:"support/post/update/urun-foto-siralama.php",
                type:'post',
                data:{position:data},
                success:function(){
                    setTimeout(function(){// wait for 5 secs(2)
                        location.reload(); // then reload the page.(3)
                    }, 1);
                }
            })
        }
    </script>

<script type="text/javascript">

    function deletebutton(fotoid,urunid){

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
                window.location.href = "support/post/delete/urun-foto-sil.php?urunfoto=success&id="+fotoid+"&urun_id="+urunid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>

<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urunfoto&urun_id=<?=$_GET['urun_id']?>">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urunfoto&urun_id=<?=$_GET['urun_id']?>">
<?php }?>
<?php if($_GET['status']=='nofile'){ ?>
    <body onload="sweetAlert('Başarısız!', 'Dosya boyutunuz 0kb olamaz', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urunfoto&urun_id=<?=$_GET['urun_id']?>">
<?php }?>
<?php if($_GET['status']=='imgtype'){ ?>
    <body onload="sweetAlert('HATA!', 'Görsel dosyanız jpg, png veya gif türü dışında olamaz', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urunfoto&urun_id=<?=$_GET['urun_id']?>">
<?php }?>