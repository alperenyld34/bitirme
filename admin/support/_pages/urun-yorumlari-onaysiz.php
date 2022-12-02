<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Onay Bekleyen Ürün Yorumları | <?=$ayar['site_baslik']?></title>
<?php
$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from urun_yorum where onay='0' order by id desc");
$ToplamVeri = $Say->rowCount();
$Limit = 100;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$ara = $_GET['search'];
$listele_tablo = $db->query("select * from urun_yorum where (isim like '%$ara%' or soyisim like '%$ara%' or baslik like '%$ara%' or yorum like '%$ara%') and onay='0' order by id desc limit $Goster,$Limit");
$tabloAl = $listele_tablo->fetchAll(PDO::FETCH_ASSOC);
?>

    <?php if($_GET['do'] == 'active'  ) {?>
        <?php
        $updateComment = $db->prepare("UPDATE urun_yorum SET onay = 1 WHERE onay=:onay  ");
        $updateComment->execute(array(
            'onay' => '0'
        ));
        ?>
        <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
        </body>
        <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=onaybekleyenyorumlar">
    <?php }?>
<?php if($_GET['do'] == 'onlyactive'  ) {?>
    <?php
    $updateComment = $db->prepare("UPDATE urun_yorum SET onay = 1 WHERE id=:id  ");
    $updateComment->execute(array(
        'id' => $_GET['yorum_id']
    ));
    ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=onaybekleyenyorumlar">
<?php }?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-comment"></i> Onay Bekleyen Ürün Yorumları</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active"><a href="pages.php?sayfa=urunler">Ürünler</a></li>
                <li class="breadcrumb-item active">Onay Bekleyen Ürün Yorumları</li>
            </ol>
        </div>
    </div>
</div>

<form action="support/post/multi-delete/urun-yorumlarini-sil.php" method="post">
<div class="row">




    <div class="col-md-12" style="text-align: left" >
        <?php if($ToplamVeri > '0'  ) {?>
        <a role="button"  href="pages.php?sayfa=onaybekleyenyorumlar&do=active" class="btn btn-success m-b-15" style="color:#FFF" ><i class="fa fa-check"></i> Tümünü Onayla</a>
        <?php } ?>
        <button type="submit"  class="btn btn-danger m-b-15" style="color:#FFF"><i class="fa fa-trash"></i> Seçilenleri Sil</button>

    </div>

    <div class="col-12">
        <div class="card" >
            <div class="card-body bg-secondary" >

                <h3 class="card-title m-b-25"><i class="fa fa-exclamation-triangle fa-2x fa-pull-left fa-border" style="color: #ED4660;" aria-hidden="true"></i> Onay Bekleyen Ürün Yorumları <span style="font-size:15px;">( <?=$ToplamVeri?> ) </span></h3>
                <h6 class="card-subtitle">Bu alanda üyelerin onay bekleyen yorum ve değerlendirmelerini inceleyebilir, yayınlanmasını sağlayabilirsiniz.</h6>

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
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; width: 180px ">ÜRÜN</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important;">ÜYE ADI SOYADI</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important;">YORUM BAŞLIĞI</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important;  " >YORUM</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; " >EKLENME TAR.</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; text-align: center; " >DURUMU</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important;  text-align: center;" >YORUMU OKU</th>
                            <th class="text-nowrap" width="180" style="text-align: center; border-top: 0 !important; border-bottom: 0 !important; border-right: 0 !important;">#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($tabloAl as $row) {

                            $talepUyeCek = $db->prepare("select * from uyeler where id=:id ");
                            $talepUyeCek->execute(array(
                                'id' => $row['uye_id']
                            ));
                            $uye = $talepUyeCek->fetch(PDO::FETCH_ASSOC);

                                $urunCekk = $db->prepare("select * from urun where id=:id ");
                                    $urunCekk->execute(array(
                                        'id' => $row['urun_id']
                                    ));
                                    $uruns = $urunCekk->fetch(PDO::FETCH_ASSOC);
                                    

                            ?>
                        <tr>
                            <td style="border-left:0 !important;">
                                <div class="form-checkbox">
                                <input type="checkbox" name='sil[]' id="checkSec-<?=$row['id']?>" value="<?=$row['id']?>" class="individual">
                                <label for="checkSec-<?=$row['id']?>"></label>
                                </div>
                            </td>


                            <td style="font-weight: 600; ">
                                <a href="<?=$ayar['site_url']?>urun/<?=$uruns['id']?>/<?=seo($uruns['baslik'])?>" target="_blank" style="color: #000;">
                              <i class="fa fa-external-link"></i>
                                <?php
                                $kisaurun = substr($uruns['baslik'], 0, 40);
                                ?>
                                <?=$kisaurun?>...
                                </a>
                            </td>

                            <td style="font-weight: 400">
                                <a href="pages.php?sayfa=uye&uye_id=<?=$uye['id']?>">
                                    <i class="fa fa-user"></i> <?=$uye['isim']?> <?=$uye['soyisim']?>
                                </a>
                            </td>

                            <td style="font-weight: 400">
                                <?php
                                $kisabaslik = substr($row['baslik'], 0, 40);
                                ?>
                                <?=$kisabaslik?>...
                            </td>

                            <td style="font-weight: 400;">
                                <?php
                                $kisayorum = substr($row['yorum'], 0, 40);
                                ?>
                                <?=$kisayorum?>...
                            </td>

                            <td style="font-weight: 400">
                                <?php echo date_tr('j F Y, H:i ', ''.$row['tarih'].''); ?>
                            </td>


                            <td style="font-weight: 400; text-align: center;">
                                <?php if($row['onay'] == '0' ) {?>
                                    <div class="btn btn-sm btn-warning"><i class="fa fa-spinner fa-spin fa-fw"></i>
                                        <span class="sr-only">Loading...</span> Onay Bekliyor</div>
                                <?php }?>
                            </td>


                            <td style="font-weight: 400; text-align: center;">
                                <a href="pages.php?sayfa=urunyorumu&yorum_id=<?=$row['id']?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Yorumu Oku</a>
                            </td>
                            <td class="text-nowrap" style="text-align: center; border-right: 0 !important;">
                                <a href="pages.php?sayfa=onaybekleyenyorumlar&do=onlyactive&yorum_id=<?=$row['id']?>" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Onayla</a>
                                <a  onclick="deletebutton('<?=$row['id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>
                            </td>

                        </tr>


                       <?php } //TODO BU sayfa var?>



                        </tbody>
                    </table>




                </div>






                    <!---- Sayfalama Elementleri ================== !-->
                    <?php if($Sayfa >= 1){?>
                        <nav aria-label="Page navigation example" style="margin-top:20px;">
                        <ul class="pagination">
                    <?php } ?>

                    <?php if($Sayfa > 1){?>

                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=onaybekleyenyorumlar&page="><?=$diller['sayfalama-ilk']?></a></li>
                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=onaybekleyenyorumlar&page=<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

                    <?php } ?>
                    <?php
                    for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                        if($i == $Sayfa){

                            echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="pages.php?sayfa=onaybekleyenyorumlar&page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';

                        }else{
                            echo '
                    <li class="page-item"><a class="page-link" href="pages.php?sayfa=onaybekleyenyorumlar&page='.$i.'">'.$i.'</a></li>
                    ';
                        }
                    }
                    }
                    ?>

                    <?php if($listele_tablo->rowCount() <=0) { } else { ?>
                        <?php if($Sayfa != $Sayfa_Sayisi){?>

                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=onaybekleyenyorumlar&page=<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=onaybekleyenyorumlar&page=<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


                        <?php }} ?>

                    <?php if($Sayfa >= 1){?>
                        </ul>
                        </nav>
                    <?php } ?>
                    <!---- Sayfalama Elementleri ================== !-->




                <?php } else {?>
                <div class="alert alert-info" style="font-weight: 400">
                 Onaysız Ürün Bulunamadı
                    <?php if(isset($_GET['search'])) {?>
                        <a href="pages.php?sayfa=onaybekleyenyorumlar">Geri Dön</a>
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
                <input type="hidden" class="form-control mb-2" id="inlineFormInput" name="sayfa" value="onaybekleyenyorumlar">
            </div>

            <div class="col-auto">
                <input type="text" class="form-control mb-2" id="inlineFormInput" required name="search" placeholder="Üye veya yorum">
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

    function deletebutton(destekid){

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
                window.location.href = "support/post/delete/urun-yorum-sil.php?yorum=success&id="+destekid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>



<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=onaybekleyenyorumlar">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=onaybekleyenyorumlar">
<?php }?>
<?php if($_GET['status']=='nocheck'){ ?>
    <body onload="sweetAlert('Sorun Var!', 'Hiç seçim yapılmamış!', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=onaybekleyenyorumlar">
<?php }?>
