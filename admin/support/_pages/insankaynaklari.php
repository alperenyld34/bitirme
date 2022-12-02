<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>İnsan Kaynakları Başvuruları  | <?=$ayar['site_baslik']?></title>
<?php
$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from insan_kaynaklari order by id DESC");
$ToplamVeri = $Say->rowCount();
$Limit = 20;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$ara = $_GET['search'];
$listele_tablo = $db->query("select * from insan_kaynaklari where (isim like '%$ara%' or telno like '%$ara%' or mailadresi like '%$ara%') order by id DESC limit $Goster,$Limit");
$tabloAl = $listele_tablo->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-account"></i> İnsan Kaynakları Başvuruları </h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">İnsan Kaynakları Başvuruları</li>
            </ol>
        </div>
    </div>
</div>

<form action="support/post/multi-delete/insankaynaklarini-sil.php" method="post">
<div class="row">




    <div class="col-md-12" style="text-align: left" >
        <button type="submit"  class="btn btn-danger m-b-15" style="color:#FFF"><i class="fa fa-trash"></i> Seçilenleri Sil</button>
    </div>

    <div class="col-12">
        <div class="card" >
            <div class="card-body bg-secondary" >

                <h3 class="card-title m-b-25">İnsan Kaynakları Başvuruları</h3>
                <h6 class="card-subtitle">Firmanızda çalışmak için yapılan başvuruları inceleyebilirsiniz. Arama yapmak için sayfanın altına gidiniz.</h6>

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
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; text-align: center;" width="100">DURUM</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important;">İSİM</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; text-align: center">TELEFON</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; text-align: center; ">E-POSTA</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; text-align: center;">İL/İLÇE</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; text-align: center; ">BAŞVURU TARİHİ</th>
                            <th class="text-nowrap" width="100" style="text-align: center; border-top: 0 !important; border-bottom: 0 !important; border-right: 0 !important;"></th>
                            <th class="text-nowrap" width="100" style="text-align: center; border-top: 0 !important; border-bottom: 0 !important; border-right: 0 !important;">#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($tabloAl as $row) {    ?>
                        <tr>
                            <td style="border-left:0 !important;">
                                <div class="form-checkbox">
                                <input type="checkbox" name='sil[]' id="checkSec-<?=$row['id']?>" value="<?=$row['id']?>" class="individual">
                                <label for="checkSec-<?=$row['id']?>"></label>
                                </div>
                            </td>


                            <td style="font-weight: 400; text-align: center;">
                                <?php
                                if($row['durum'] == 1) {
                                    ?>
                                    <span class="btn btn-primary btn-sm">
                                       <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i>
                                        <span class="sr-only">Loading...</span> YENİ BAŞVURU
                                    </span>
                                <?php } ?>
                                <?php
                                if($row['durum'] == 0) {
                                    ?>

                                    <span class="badge badge-secondary" style="font-weight: 500; font-size:12px; border:1px solid #EBEBEB"><i class="fa fa-check"></i> İNCELENDİ</span>

                                <?php } ?>
                            </td>


                            <td style="font-weight: 400">
                                <?=$row['isim']?>
                            </td>

                            <td style="font-weight: 400; text-align: center" width="150" >
                              <?=$row['telno']?>
                            </td>

                            <td style="font-weight: 400; text-align: center" >
                               <?=$row['mailadresi']?>
                            </td>

                            <td style="font-weight: 400; text-align: center" >
                                <?=$row['il']?> / <?=$row['ilce']?>
                            </td>

                            <td style="font-weight: 400; text-align: center" >
                                <?php echo date_tr('j F Y, H:i, l ', ''.$row['tarih'].''); ?>
                            </td>

                            <td class="text-nowrap" style="text-align: center; border-right: 0 !important;">
                                <a role="button" class="btn btn-sm btn-info" href="pages.php?sayfa=basvuruoku&id=<?=$row['id']?>"><i class="fa fa-eye"></i> BAŞVURUYU İNCELE</a>
                            </td>
                            <td class="text-nowrap" style="text-align: center; border-right: 0 !important;">
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

                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=insankaynaklari&page="><?=$diller['sayfalama-ilk']?></a></li>
                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=insankaynaklari&page=<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

                    <?php } ?>
                    <?php
                    for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                        if($i == $Sayfa){

                            echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="pages.php?sayfa=insankaynaklari&page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';

                        }else{
                            echo '
                    <li class="page-item"><a class="page-link" href="pages.php?sayfa=insankaynaklari&page='.$i.'">'.$i.'</a></li>
                    ';
                        }
                    }
                    }
                    ?>

                    <?php if($listele_tablo->rowCount() <=0) { } else { ?>
                        <?php if($Sayfa != $Sayfa_Sayisi){?>

                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=insankaynaklari&page=<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=insankaynaklari&page=<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


                        <?php }} ?>

                    <?php if($Sayfa >= 1){?>
                        </ul>
                        </nav>
                    <?php } ?>
                    <!---- Sayfalama Elementleri ================== !-->




                <?php } else {?>
                <div class="alert alert-info" style="font-weight: 400">
                  Başvuru bulunamadı !
                    <?php if(isset($_GET['search'])) {?>
                        <a href="pages.php?sayfa=insankaynaklari">Geri Dön</a>
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
                <input type="hidden" class="form-control mb-2" id="inlineFormInput" name="sayfa" value="insankaynaklari">
            </div>

            <div class="col-auto">
                <input type="text" class="form-control mb-2" id="inlineFormInput" required name="search" placeholder="İsim,Tel veya E-Posta">
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

    function deletebutton(ikid){

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
                window.location.href = "support/post/delete/insankaynaklari-sil.php?insankaynaklari=success&id="+ikid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>



<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=insankaynaklari">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=insankaynaklari">
<?php }?>
<?php if($_GET['status']=='nocheck'){ ?>
    <body onload="sweetAlert('Sorun Var!', 'Hiç seçim yapılmamış!', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=insankaynaklari">
<?php }?>
