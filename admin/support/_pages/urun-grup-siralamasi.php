<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Ürün Grupları Sıralaması | <?=$ayar['site_baslik']?></title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="fa fa-list-ol"></i> Ürün Grupları Sıralaması</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=urunkategorileri">Ürün kategorileri</a></li>
                <li class="breadcrumb-item active">Ürün Grupları Sıralaması</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12" style="text-align: left" >

        <a role="button"  class="btn btn-dark m-b-15" href="pages.php?sayfa=urunkategorileri" style="color:#FFF"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        <a role="button" href="pages.php?sayfa=urunkategorisiekle" class="btn btn-info m-b-15" style="color:#FFF" ><i class="fa fa-plus-circle"></i> Yeni Kategori Ekle</a>





    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body bg-secondary" >

                <h3 class="card-title m-b-25">Ürün Grupları Sıralamasısı </h3>

                <h6>Anasayfadaki ürün gruplarının sıralamasını sürükle-bırak sistemi ile dilediğiniz gibi belirleyebilirsiniz. </h6>

            </div>

        </div>
    </div>


    <div class="col-12" >
        <div class="card"style="">
            <div class="card-body" style="padding: 15px !important;">

                <div class="alert alert-info" style="font-size:14px; font-weight: 500">Sürükle bırak sistemi ile ürün gruplarını sıralayabilirsiniz.</div>

                    <table class="table table-bordered table-striped" style="font-family: 'Open Sans', Arial; font-size:15px; font-weight: 500">

                        <tbody class="row_position">
                        <?php


                        $sql = $db->prepare("select * from urun_cat where dil='$_SESSION[dil]' and anasayfa_grup='1' and durum='1' order by grup_sira");
                        $sql->execute();

                        foreach ($sql as $user) {

                            ?>
                            <tr  id="<?php echo $user['id'] ?>">
                                <td width="100" height="60" style="text-align: center;" >
                                    <span class="btn btn-sm btn-outline-secondary text-dark" style="font-weight: bold"><?php echo $user['grup_sira'] ?></span>
                                </td>
                                

                                <td width="200" style="text-align: center; cursor: all-scroll">
                                    <img src="../images/product-category/<?=$user['gorsel']?>" style="cursor: all-scroll;" width="150">
                                </td>

                               
                               
                                <td style="cursor: all-scroll"><?php echo $user['baslik'] ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>











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
            url:"support/post/update/urun-grup-siralama.php",
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



<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'Seçtiğiniz modül pasifleştirilmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urungrupsiralamasi">
<?php }?>
<?php if( $_GET['status']=='success2'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'Seçtiğiniz modül aktifleştirilmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urungrupsiralamasi">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urungrupsiralamasi">
<?php }?>