<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Modül Sıralama | <?=$ayar['site_baslik']?></title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="ti-layout-grid2"></i> Modül Sıralama</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Modül Sıralama</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">



    <div class="col-12">
        <div class="card">
            <div class="card-body bg-secondary" >

                <h3 class="card-title m-b-25">Modül Sıralaması </h3>

                <h6>Modülleri aktifleştirmek veya pasifleştirmek için durumlarına tıklamanız yeterlidir</h6>

            </div>

        </div>
    </div>


    <div class="col-12" >
        <div class="card"style="">
            <div class="card-body" style="padding: 15px !important;">

                <div class="alert alert-info" style="font-size:14px; font-weight: 500">Sürükle bırak sistemi ile modüllerinizi sıralayabilirsiniz.</div>

                    <table class="table table-bordered table-striped" style="font-family: 'Open Sans', Arial; font-size:15px; font-weight: 500">

                        <tbody class="row_position">
                        <?php


                        $sql = $db->prepare("select * from moduller order by sira");
                        $sql->execute();

                        foreach ($sql as $user) {

                            ?>
                            <tr  id="<?php echo $user['id'] ?>">
                                <td width="100" height="60" style="text-align: center;" >
                                    <span class="btn btn-sm btn-outline-secondary text-dark" style="font-weight: bold"><?php echo $user['sira'] ?></span>
                                </td>
                                <?php
                                if ($user['durum'] == 1) {
                                ?>

                                <td width="100" style="text-align: center"><a href="support/post/update/modul-durum.php?modul=pasif&modul_id=<?=$user['id']?>"><span class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aktif</span></a></td>

                                <?php }?>
                                <?php
                                if ($user['durum'] == 0) {
                                    ?>
                                    <td width="100" style="text-align: center"><a href="support/post/update/modul-durum.php?modul=aktif&modul_id=<?=$user['id']?>"><span class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Pasif</span></a></td>
                                <?php }?>
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
            url:"support/post/update/modul-siralama.php",
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
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=modulsiralama">
<?php }?>
<?php if( $_GET['status']=='success2'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'Seçtiğiniz modül aktifleştirilmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=modulsiralama">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=modulsiralama">
<?php }?>