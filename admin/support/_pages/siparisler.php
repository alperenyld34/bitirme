<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Siparişler | <?=$ayar['site_baslik']?></title>
<?php
$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from siparis order by id DESC");
$ToplamVeri = $Say->rowCount();
$Limit = 80;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$ara = $_GET['search'];
$listele_tablo = $db->query("select * from siparis where (siparis_no like '%$ara%' or isim like '%$ara%' or tel like '%$ara%') and NOT siparis_durum='99' order by id DESC limit $Goster,$Limit");
$tabloAl = $listele_tablo->fetchAll(PDO::FETCH_ASSOC);

$paywantSiparis = $db->prepare("select * from siparis where siparis_durum='99'");
$paywantSiparis->execute();
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="icon-handbag"></i> Siparişler</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">Siparişler</li>
            </ol>
        </div>
    </div>
</div>

<form action="support/post/multi-delete/siparisleri-sil.php" method="post">
<div class="row">




    <div class="col-md-12" style="text-align: left" >



         <a role="button"  class="btn btn-dark m-b-15" href="pages.php?sayfa=ticariayar" style="color:#FFF"><i class="fa fa-cog"></i> Ticari Ayarlar</a>
        <a role="button"  class="btn btn-dark m-b-15" href="pages.php?sayfa=posayar" style="color:#FFF"><i class="fa fa-cog"></i> POS Ayarları</a>

        <button type="submit"  class="btn btn-danger m-b-15" style="color:#FFF"><i class="fa fa-trash"></i> Seçilenleri Sil</button>

        <?php if ($odemeayar['pos_tur'] == '4' && $paywantSiparis->rowCount()>0) {?>
            <a role="button"  class="btn btn-purple m-b-15" alt="default" data-toggle="modal" data-target="#tamamlanamayan" style="color:#FFF"><i class="fa fa-ban"></i> Tamamlanamayan Siparişler</a>
        <?php }?>

    </div>

    <div class="col-12">
        <div class="card" >
            <div class="card-body bg-secondary" >

                <h3 class="card-title m-b-25">Siparişler [<?=$listele_tablo->rowCount()?> Sipariş]</h3>
                <h6 class="card-subtitle">Bu alanda siteniz üzerinden gelen siparişleri görebilirsiniz. Arama yapmak için sayfanın altına gidiniz.</h6>

        </div>
    </div>
        <div class="alert alert-danger" style="font-weight: 500;"><i class="fa fa-info-circle" style="float: left; margin-bottom: 20px; margin-right: 10px; margin-top: 3px;"></i> UYARI : Havale/EFT ve Kredi Kartı ile verilen siparişlerin ardından sipariş edilen ürünlerin stok sayısı otomatik olarak seçilen adetlere göre azalmaktadır. Herhangi bir siparişi silecekseniz eğer lütfen siparişteki ürünlerin stok adetlerini tekrardan ekleyiniz.</div>
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
                            <th style="text-align: center; border-top: 0 !important; border-bottom: 0 !important;" width="140">SİPARİŞ NO</th>
                            <th width="230" style="border-top: 0 !important; border-bottom: 0 !important;">İSİM</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important;" width="150">SİPARİŞ TÜRÜ</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center" width="180">TOPLAM TUTAR</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center" width="180">TELEFON</th>

                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: left " width="200">SİPARİŞ TARİHİ</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center">DURUM</th>
                            <th class="text-nowrap" width="180" style="text-align: center; border-top: 0 !important; border-bottom: 0 !important; border-right: 0 !important;">#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($tabloAl as $row) {

                            $secili_urunCek = $db->prepare("select * from urun where id='$row[siparis_id]'");
                            $secili_urunCek->execute();
                            $sipurun=$secili_urunCek->fetch(PDO::FETCH_ASSOC);


                            ?>
                        <tr>
                            <td style="border-left:0 !important;">
                                <div class="form-checkbox">
                                <input type="checkbox" name='sil[]' id="checkSec-<?=$row['id']?>" value="<?=$row['id']?>" class="individual">
                                <label for="checkSec-<?=$row['id']?>"></label>
                                </div>
                            </td>

                            <td style="text-align: center; font-size:13px; font-weight: 500">

                                #<?=$row['siparis_no']?>
                                
                            </td>

                            <td style="font-weight: 400">
                                <?=$row['isim']?>
                            </td>

                            <td style="font-weight: 400; font-size:13px">
                                <?php
                                if ($row['odeme_tip'] == 1) {
                                    ?>
                                    <i class="fa fa-credit-card"></i> Kredi Kartı
                                <?php }?>
                                <?php
                                if ($row['odeme_tip'] == 2) {
                                    ?>
                                    <i class="fa fa-exchange"></i> Havale/EFT
                                <?php }?>
                                <?php
                                if ($row['odeme_tip'] == 3) {
                                    ?>
                                    <i class="fa fa-gg"></i> Normal Sipariş
                                <?php }?>
                            </td>

                            <td style="font-weight: 500; text-align: center">
                                <?php
                                if ($row['odeme_tip'] == 1 || $row['odeme_tip'] == 2) {
                                    ?>
                                    <?php echo number_format($row['toplam_tutar'], 2); ?> <?=$odemeayar['simge']?>
                                <?php }?>
                                <?php
                                if ($row['odeme_tip'] == 3) {
                                    ?>
                                    <?php if($sipurun['fiyat'] == !null) {?>
                                    <?php echo number_format($sipurun['fiyat'], 2); ?> <?=$odemeayar['simge']?>
                                    <?php } else { echo 'Fiyatsız';}?>
                                <?php }?>

                            </td>

                            <td style="font-weight: 500;text-align: center">
                            <i class="fa fa-phone"></i> <?=$row['tel']?>
                            </td>



                            <td style="font-weight: 400; text-align: left; font-size:13px;">
                                <?php echo date_tr('j F Y, H:i', ''.$row['siparis_tarih'].''); ?>
                            </td>

                            <td style="font-weight: 400; text-align: center">

                                <?php if($row['siparis_durum'] == 0) { ?>
                                    <div class="label label-table label-danger" style=" font-size:13px">YENİ SİPARİŞ</div>
                                <?php } ?>

                                <?php if($row['siparis_durum'] == 1) { ?>
                                    <div class="label label-table label-warning" style=" font-size:13px"><i class="fa fa-spinner"></i> ÖDEME BEKLENİYOR</div>
                                <?php } ?>

                                <?php if($row['siparis_durum'] == 2) { ?>
                                    <div class="label label-table label-info" style=" font-size:13px"><i class="mdi mdi-dots-vertical"></i> HAZIRLANIYOR</div>
                                <?php } ?>

                                <?php if($row['siparis_durum'] == 3) { ?>
                                    <div class="label label-table label-danger" style="background-color: #333; color:#FFF;  font-size:13px"><i class="mdi mdi-search-web"></i> TEDARİK EDİLİYOR</div>
                                <?php } ?>

                                <?php if($row['siparis_durum'] == 4) { ?>
                                    <div class="label label-table" style="background-color: #FFF; border:1px solid #EBEBEB; color:#000; font-size:13px"><i class="mdi mdi-truck"></i> KARGOLANDI</div>
                                <?php } ?>

                                <?php if($row['siparis_durum'] == 5) { ?>
                                    <div class="label label-table label-success" style=" font-size:13px"><i class="mdi mdi-check"></i> TAMAMLANDI</div>
                                <?php } ?>

                                <?php if($row['siparis_durum'] == 6) { ?>
                                    <div class="label label-table label-danger" style="background-color: orangered; font-size:13px"><i class="mdi mdi-close"></i> İPTAL EDİLDİ</div>
                                <?php } ?>

                            </td>

                            <td class="text-nowrap" style="text-align: center; border-right: 0 !important;">
                                <a  href="pages.php?sayfa=siparis&siparis_id=<?=$row['id']?>" class="btn btn-sm btn-info" style="color:#FFF"><i class="fa fa-eye text-inverse"></i> İNCELE </a>
                                <a  href="pages.php?sayfa=kargo&siparis_id=<?=$row['siparis_no']?>" class="btn btn-sm btn-dark" style="color:#FFF"><i class="fa fa-truck text-inverse"></i> Kargo </a>
                                <a  onclick="deletebutton('<?=$row['id']?>','<?=$row['siparis_no']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>
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

                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=siparisler&page="><?=$diller['sayfalama-ilk']?></a></li>
                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=siparisler&page=<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

                    <?php } ?>
                    <?php
                    for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                        if($i == $Sayfa){

                            echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="pages.php?sayfa=siparisler&page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';

                        }else{
                            echo '
                    <li class="page-item"><a class="page-link" href="pages.php?sayfa=siparisler&page='.$i.'">'.$i.'</a></li>
                    ';
                        }
                    }
                    }
                    ?>

                    <?php if($listele_tablo->rowCount() <=0) { } else { ?>
                        <?php if($Sayfa != $Sayfa_Sayisi){?>

                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=siparisler&page=<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=siparisler&page=<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


                        <?php }} ?>

                    <?php if($Sayfa >= 1){?>
                        </ul>
                        </nav>
                    <?php } ?>
                    <!---- Sayfalama Elementleri ================== !-->




                <?php } else {?>
                <div class="alert alert-info" style="font-weight: 400">
                   Sipariş bulunamadı
                    <?php if(isset($_GET['search'])) {?>
                        <a href="pages.php?sayfa=siparisler">Geri Dön</a>
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
                <input type="hidden" class="form-control mb-2" id="inlineFormInput" name="sayfa" value="siparisler">
            </div>

            <div class="col-auto">
                <input type="text" class="form-control mb-2" id="inlineFormInput" required name="search" placeholder="Sipariş no,isim veya tel">
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

    function deletebutton(siparisid,siparisno){

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
                window.location.href = "support/post/delete/siparis-sil.php?siparis=success&id="+siparisid+"&siparis_no="+siparisno;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>


<!-- TAMAMLANAMAYAN PAYWANT SİPARİŞLER ============================================ !-->
<?php if ($odemeayar['pos_tur'] == '4') {
    $paywantSiparis = $db->prepare("select * from siparis where siparis_durum='99'");
    $paywantSiparis->execute();
    ?>
<div id="tamamlanamayan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tamamlanamayan Siparişler</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">

                    <span style="font-weight: 400; font-family: 'Open Sans', Arial">Sanal POS olarak Paywant ödeme modülünü kullanıyorsanız eğer, müşterileriniz ödeme ekranına geldiğinde hatalı bilgiler girmiş veya ödemeden sayfadan ayrılmış ise
                        arkaplanda sepetteki ürünler sistem tarafından otomatik olarak veritabanına kaydedilmektedir.
                        <br><br>
                        Bu ürünleri göremezsiniz ancak tamamlanamayan sipariş sayısını aşağıdan öğrenebilirsiniz.
                        <br><br>
                        <strong>Ara sıra burayı kontrol ederek aşağıdaki Tümünü Sil yazısına tıklayıp temizlemenizi öneririz.</strong>
                        <br><br>
                        Tamamlanamayan Sipariş Sayısı : <b><?=$paywantSiparis->rowCount();?></b>
                    </span>






                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">İptal</button>
                    <a class="btn btn-danger waves-effect waves-light" style="color:#FFF" href="support/post/delete/tamamlanamayan-siparis-sil.php">
                        <i class="fa fa-refresh fa-spin fa-fw"></i>
                        <span class="sr-only">Yükleniyor...</span>Tümünü Sil

                    </a>
                </div>
            </div>
        </div>
</div>
<?php } ?>
<!-- TAMAMLANAMAYAN PAYWANT SİPARİŞLER ENDING ============================================ !-->


<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=siparisler">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=siparisler">
<?php }?>
<?php if($_GET['status']=='nocheck'){ ?>
    <body onload="sweetAlert('Sorun Var!', 'Hiç seçim yapılmamış!', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=siparisler">
<?php }?>
