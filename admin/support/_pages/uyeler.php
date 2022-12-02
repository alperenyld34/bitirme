<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Üye Listesi | <?=$ayar['site_baslik']?></title>
<?php
$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from uyeler order by id desc");
$ToplamVeri = $Say->rowCount();
$Limit = 100;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$ara = $_GET['search'];
$listele_tablo = $db->query("select * from uyeler where (isim like '%$ara%' or soyisim like '%$ara%' or eposta like '%$ara%' or telefon like '%$ara%') order by id desc limit $Goster,$Limit");
$tabloAl = $listele_tablo->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-account-multiple"></i> Üye Listesi</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Üyeler</li>
            </ol>
        </div>
    </div>
</div>

<form action="support/post/multi-delete/uyeleri-sil.php" method="post">
<div class="row">




    <div class="col-md-12" style="text-align: left" >


        <a role="button"   href="pages.php?sayfa=uyeayar" class="btn btn-dark m-b-15" style="color:#FFF" ><i class="fa fa-cog"></i> Üyelik Ayarları</a>
        <a role="button"   href="pages.php?sayfa=aktifdestek" class="btn btn-success m-b-15" style="color:#FFF" ><i class="mdi mdi-tooltip-text"></i> Açık Destek Talepleri</a>
        <button type="submit"  class="btn btn-danger m-b-15" style="color:#FFF"><i class="fa fa-trash"></i> Seçilenleri Sil</button>

    </div>

    <div class="col-12">
        <div class="card" >
            <div class="card-body bg-secondary" >

                <h3 class="card-title m-b-25">Üye Listesi <span style="font-size:15px;">( <?=$ToplamVeri?> Üye ) </span></h3>
                <h6 class="card-subtitle">Bu alanda sitenize kayıt olan üyeleri görebilirsiniz. Arama yapmak için sayfanın altına gidiniz.</h6>

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
                            <th  style="border-top: 0 !important; border-bottom: 0 !important;">İSİM</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important;">TELEFON</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; " >E-POSTA</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; " >IP</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; text-align: center; " >CİNSİYET</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important; " >ÜYELİK TARİHİ</th>
                            <th  style="border-top: 0 !important; border-bottom: 0 !important;  text-align: center;" >SİPARİŞLER</th>
                            <th class="text-nowrap" width="180" style="text-align: center; border-top: 0 !important; border-bottom: 0 !important; border-right: 0 !important;">#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($tabloAl as $row) {

                                $siparisCek = $db->prepare("select * from siparis where user_id=:user_id ");
                                    $siparisCek->execute(array(
                                            'user_id' => $row['id']
                                    ));
                                    
                            ?>
                        <tr>
                            <td style="border-left:0 !important;">
                                <div class="form-checkbox">
                                <input type="checkbox" name='sil[]' id="checkSec-<?=$row['id']?>" value="<?=$row['id']?>" class="individual">
                                <label for="checkSec-<?=$row['id']?>"></label>
                                </div>
                            </td>


                            <td style="font-weight: 400; ">
                               <?=$row['isim']?> <?=$row['soyisim']?>
                            </td>



                            <td style="font-weight: 400">
                                <?=$row['telefon']?>
                            </td>

                            <td style="font-weight: 400">
                                <?=$row['eposta']?>
                            </td>

                            <td style="font-weight: 400">
                                <?=$row['ip']?>
                            </td>

                            <td style="font-weight: 400; text-align: center;">
                                <?=$row['cinsiyet']?>
                            </td>

                            <td style="font-weight: 400">
                                <?php echo date_tr('j F Y, H:i', ''.$row['tarih'].''); ?>
                            </td>
                            <td style="font-weight: 400; text-align: center;">
                                <?php if($siparisCek->rowCount()>0  ) {?>
                                    <a href="pages.php?sayfa=uyesiparis&user_id=<?=$row['id']?>" class="btn btn-sm btn-primary"><i class="fa fa-shopping-cart"></i> Siparişleri Gör (<?=$siparisCek->rowCount()?>)</a>
                                <?php } else { ?>
                                    <a  class="btn btn-sm btn-dark" href="">Sipariş Yok</a>
                                <?php }?>
                            </td>
                            <td class="text-nowrap" style="text-align: center; border-right: 0 !important;">
                                <a  href="pages.php?sayfa=uye&uye_id=<?=$row['id']?>" class="btn btn-sm btn-info" style="color:#FFF"><i class="fa fa-pencil text-inverse"></i> Düzenle </a>
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

                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=uyeler&page="><?=$diller['sayfalama-ilk']?></a></li>
                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=uyeler&page=<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

                    <?php } ?>
                    <?php
                    for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                        if($i == $Sayfa){

                            echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="pages.php?sayfa=uyeler&page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';

                        }else{
                            echo '
                    <li class="page-item"><a class="page-link" href="pages.php?sayfa=uyeler&page='.$i.'">'.$i.'</a></li>
                    ';
                        }
                    }
                    }
                    ?>

                    <?php if($listele_tablo->rowCount() <=0) { } else { ?>
                        <?php if($Sayfa != $Sayfa_Sayisi){?>

                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=uyeler&page=<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=uyeler&page=<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


                        <?php }} ?>

                    <?php if($Sayfa >= 1){?>
                        </ul>
                        </nav>
                    <?php } ?>
                    <!---- Sayfalama Elementleri ================== !-->




                <?php } else {?>
                <div class="alert alert-info" style="font-weight: 400">
                  Üye bulunamadı!
                    <?php if(isset($_GET['search'])) {?>
                        <a href="pages.php?sayfa=uyeler">Geri Dön</a>
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
                <input type="hidden" class="form-control mb-2" id="inlineFormInput" name="sayfa" value="uyeler">
            </div>

            <div class="col-auto">
                <input type="text" class="form-control mb-2" id="inlineFormInput" required name="search" placeholder="isim, telefon veya eposta">
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

    function deletebutton(uyeid){

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
                window.location.href = "support/post/delete/uye-sil.php?uye=success&id="+uyeid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>



<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=uyeler">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=uyeler">
<?php }?>
<?php if($_GET['status']=='nocheck'){ ?>
    <body onload="sweetAlert('Sorun Var!', 'Hiç seçim yapılmamış!', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=uyeler">
<?php }?>
