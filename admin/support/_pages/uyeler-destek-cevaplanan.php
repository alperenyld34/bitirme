<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Cevaplanan Destek Talepleri | <?=$ayar['site_baslik']?></title>
<?php
$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from uyeler_destek where durum='0' order by tarih desc");
$ToplamVeri = $Say->rowCount();
$Limit = 100;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$ara = $_GET['search'];
$listele_tablo = $db->query("select * from uyeler_destek where (support_id like '%$ara%' or konu like '%$ara%') and durum='0' order by tarih desc limit $Goster,$Limit");
$tabloAl = $listele_tablo->fetchAll(PDO::FETCH_ASSOC);



?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-tooltip-text"></i> Cevaplanan Destek Talepleri</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active"><a href="pages.php?sayfa=uyeler">Üyeler</a></li>
                <li class="breadcrumb-item active">Cevaplanan Destek Talepleri</li>
            </ol>
        </div>
    </div>
</div>

<form action="support/post/multi-delete/destek-cevaplanan-sil.php" method="post">
<div class="row">




    <div class="col-md-12" style="text-align: left" >


        <a role="button"   href="pages.php?sayfa=aktifdestek" class="btn btn-success m-b-15" style="color:#FFF" ><i class="mdi mdi-tooltip-text"></i> Açık Talepleri Gör</a>
        <button type="submit"  class="btn btn-danger m-b-15" style="color:#FFF"><i class="fa fa-trash"></i> Seçilenleri Sil</button>

    </div>

    <div class="col-12">
        <div class="card" >
            <div class="card-body bg-secondary" >

                <h3 class="card-title m-b-25"><i class="fa fa-dot-circle-o" style="color: green"></i> Cevaplanan Destek Talepleri</h3>
                <h6 class="card-subtitle">Bu alanda üyelerinizin destek taleplerine cevap verilmiş olan talepleri görebilirsiniz</h6>

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
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; width: 180px ">DESTEK TALEP NO</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important;">ÜYE ADI SOYADI</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important;">TALEP KONUSU</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important;  " >OLUŞTURULMA TARİHİ</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; " >SON MESAJ TARİHİ</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; " >DURUMU</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important;  text-align: center;" >İNCELE</th>
                            <th class="text-nowrap" width="180" style="text-align: center; border-top: 0 !important; border-bottom: 0 !important; border-right: 0 !important;">#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($tabloAl as $row) {

                            $talepUyeCek = $db->prepare("select * from uyeler where id=:id ");
                            $talepUyeCek->execute(array(
                                'id' => $row['user_id']
                            ));
                            $uye = $talepUyeCek->fetch(PDO::FETCH_ASSOC);

                                $sonmesaj = $db->prepare("select * from uyeler_destek_mesaj where support_id=:support_id order by id desc limit 1 ");
                                    $sonmesaj->execute(array(
                                            'support_id' => $row['support_id']
                                    ));
                                    $msj = $sonmesaj->fetch(PDO::FETCH_ASSOC);

                            ?>
                        <tr>
                            <td style="border-left:0 !important;">
                                <div class="form-checkbox">
                                <input type="checkbox" name='sil[]' id="checkSec-<?=$row['id']?>" value="<?=$row['id']?>" class="individual">
                                <label for="checkSec-<?=$row['id']?>"></label>
                                </div>
                            </td>


                            <td style="font-weight: 600;  ">
                              #<?=$row['support_id']?>
                            </td>

                            <td style="font-weight: 400">
                                <a href="pages.php?sayfa=uye&uye_id=<?=$uye['id']?>">
                                    <i class="fa fa-user"></i> <?=$uye['isim']?> <?=$uye['soyisim']?>
                                </a>
                            </td>

                            <td style="font-weight: 400">
                                <?=$row['konu']?>
                            </td>

                            <td style="font-weight: 400;">
                                <?php echo date_tr('j F Y, H:i ', ''.$row['tarih'].''); ?>
                            </td>

                            <td style="font-weight: 400">
                                <?php echo date_tr('j F Y, H:i', ''.$msj['tarih'].''); ?>
                            </td>

                            <td style="font-weight: 400">
                                <?php if($row['durum'] == '1' ) {?>
                                <div class="btn btn-sm btn-danger">Açık</div>
                                <?php }?>
                                <?php if($row['durum'] == '0' ) {?>
                                    <div class="btn btn-sm btn-success"><i class="fa fa-check"></i> Cevaplandı</div>
                                <?php }?>
                            </td>

                            <td style="font-weight: 400; text-align: center;">
                                <a href="pages.php?sayfa=talepincele&talep_id=<?=$row['id']?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Talebi İncele</a>
                            </td>
                            <td class="text-nowrap" style="text-align: center; border-right: 0 !important;">
                                <a  onclick="deletebutton('<?=$row['id']?>','<?=$row['support_id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>
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

                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=cevaplanandestek&page="><?=$diller['sayfalama-ilk']?></a></li>
                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=cevaplanandestek&page=<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

                    <?php } ?>
                    <?php
                    for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                        if($i == $Sayfa){

                            echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="pages.php?sayfa=cevaplanandestek&page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';

                        }else{
                            echo '
                    <li class="page-item"><a class="page-link" href="pages.php?sayfa=cevaplanandestek&page='.$i.'">'.$i.'</a></li>
                    ';
                        }
                    }
                    }
                    ?>

                    <?php if($listele_tablo->rowCount() <=0) { } else { ?>
                        <?php if($Sayfa != $Sayfa_Sayisi){?>

                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=cevaplanandestek&page=<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=cevaplanandestek&page=<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


                        <?php }} ?>

                    <?php if($Sayfa >= 1){?>
                        </ul>
                        </nav>
                    <?php } ?>
                    <!---- Sayfalama Elementleri ================== !-->




                <?php } else {?>
                <div class="alert alert-info" style="font-weight: 400">
                  Cevaplanan Destek Talebi Bulunamadı!
                    <?php if(isset($_GET['search'])) {?>
                        <a href="pages.php?sayfa=cevaplanandestek">Geri Dön</a>
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
                <input type="hidden" class="form-control mb-2" id="inlineFormInput" name="sayfa" value="cevaplanandestek">
            </div>

            <div class="col-auto">
                <input type="text" class="form-control mb-2" id="inlineFormInput" required name="search" placeholder="Talep No veya Konu">
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

    function deletebutton(destekid,supportid){

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
                window.location.href = "support/post/delete/destek-cevaplanan-sil.php?destek=success&id="+destekid+"&support_id="+supportid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>



<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=cevaplanandestek">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=cevaplanandestek">
<?php }?>
<?php if($_GET['status']=='nocheck'){ ?>
    <body onload="sweetAlert('Sorun Var!', 'Hiç seçim yapılmamış!', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=cevaplanandestek">
<?php }?>
