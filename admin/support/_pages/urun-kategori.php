<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Ürün Kategorileri | <?=$ayar['site_baslik']?></title>
<?php
$Sayfa = @intval($_GET['page']); if(!$Sayfa) $Sayfa = 1;
$Say = $db->query("select * from urun_cat where dil='$_SESSION[dil]' order by id DESC");
$ToplamVeri = $Say->rowCount();
$Limit = 40;
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
$Goster = $Sayfa * $Limit - $Limit;
$GorunenSayfa = 5;
$ara = $_GET['search'];
$urunKatListele = $db->query("select * from urun_cat where baslik like '%$ara%' and dil='$_SESSION[dil]' and ust_id='0' order by sira ASC limit $Goster,$Limit");
$tabloAl = $urunKatListele->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-arrange-bring-forward"></i> Ürün Kategorileri</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>

                <li class="breadcrumb-item active">Ürün Kategorileri</li>
            </ol>
        </div>
    </div>
</div>

<form action="support/post/multi-delete/urun-kategorilerini-sil.php" method="post">
<div class="row">




    <div class="col-md-12" style="text-align: left" >


        <a role="button" href="pages.php?sayfa=urunkategorisiekle" class="btn btn-info m-b-15" style="color:#FFF" ><i class="fa fa-plus-circle"></i> Kategori Ekle</a>

        <a role="button"  class="btn btn-success m-b-15" href="pages.php?sayfa=urungrupsiralamasi" style="color:#FFF"><i class="fa fa-list-ol"></i> Ürün Grupları Sıralaması</a>

         <a role="button"  class="btn btn-dark m-b-15" href="pages.php?sayfa=urunmodul" style="color:#FFF"><i class="fa fa-cog"></i> Ürün Modül Ayarları</a>


        <button type="submit"  class="btn btn-danger m-b-15" style="color:#FFF"><i class="fa fa-trash"></i> Seçilenleri Sil</button>

    </div>

    <div class="col-12">
        <div class="card" >
            <div class="card-body bg-secondary" >

                <h3 class="card-title m-b-25">Ürün Kategorileri</h3>
                <h6 class="card-subtitle">Bu alanda ürün kategorilerinizi bulabilirsiniz.</h6>

            </div>

        </div>
    </div>


    <div class="col-12" >
        <div class="card"  style="margin-bottom: 0 !important;">
            <div class="card-body" style="padding: 15px !important;">


                <?php if ($urunKatListele->rowCount() > 0) {?>
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
                            <th style="text-align: center; border-top: 0 !important; border-bottom: 0 !important;" width="110">SIRA</th>
                            <th style="text-align: center; border-top: 0 !important; border-bottom: 0 !important;" width="300">BAŞLIK</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center">ICON</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center">ANASAYFA TAB</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center ">ÜRÜN GRUPLARI</th>
                            <th style="border-top: 0 !important; border-bottom: 0 !important; text-align: center">DURUM</th>
                            <th class="text-nowrap" width="180" style="text-align: center; border-top: 0 !important; border-bottom: 0 !important; border-right: 0 !important;">#</th>
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

                            <td style="text-align: center"><span class="btn btn-sm btn-dark"><?=$row['sira']?></span></td>

                            <td style="font-weight: 400">
                                <?=$row['baslik']?>
                            </td>

                            <td style="font-weight: 400; text-align: center">
                                <?php
                                if ($row['icon'] == !null) {
                                    ?>
                                    <i class="fa <?=$row['icon']?>"></i>
                                <?php } else {?>
                                    <i class="fa fa-times"></i>
                                <?php }?>
                            </td>

                            <td style="font-weight: 400;text-align: center">
                                <?php
                                if ($row['anasayfa'] == 1) {
                                ?>
                                    <span class="btn btn-success btn-sm"><i class="fa fa-check"></i> Aktif</span>
                                <?php } else {?>
                                    <span class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Pasif</span>
                                <?php }?>
                            </td>

                            <td style="font-weight: 400; text-align: center">
                                <?php
                                if ($row['anasayfa_grup'] == 1) {
                                    ?>
                                    <span class="btn btn-success btn-sm"><i class="fa fa-check"></i> Aktif</span>
                                <?php } else {?>
                                    <span class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Pasif</span>
                                <?php }?>
                            </td>

                            <td style="font-weight: 400; text-align: center">
                                <?php
                                if ($row['durum'] == 1) {
                                    ?>
                                    <span class="btn btn-success btn-sm"><i class="fa fa-check"></i> Aktif</span>
                                <?php } else {?>
                                    <span class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Pasif</span>
                                <?php }?>
                            </td>

                            <td class="text-nowrap" style="text-align: center; border-right: 0 !important;">
                                <a  href="pages.php?sayfa=urunkategori&kategori_id=<?=$row['id']?>" class="btn btn-sm btn-info" style="color:#FFF"><i class="fa fa-pencil text-inverse"></i> Düzenle </a>
                                <a  onclick="deletebutton('<?=$row['id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>
                            </td>

                        </tr>

                            <?php
                            $alt_kat = $db->prepare("select * from urun_cat where ust_id='$row[id]' and dil='$_SESSION[dil]' order by sira asc");
                            $alt_kat->execute();
                            while($alt = $alt_kat->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                                <tr>
                                    <td style="border-left:0 !important;">
                                        <div class="form-checkbox">
                                            <input type="checkbox" name='sil[]' id="checkSec-<?=$alt['id']?>" value="<?=$alt['id']?>" class="individual">
                                            <label for="checkSec-<?=$alt['id']?>"></label>
                                        </div>
                                    </td>

                                    <td style="text-align: center"><span class="btn btn-sm btn-primary" style="padding: .10rem .3rem;"><?=$alt['sira']?></span></td>

                                    <td style="font-weight: 400">
                                       <span style="padding-left: 20px; font-size:13px">|-- <i class="fa fa-caret-right"></i> <?=$alt['baslik']?></span>
                                    </td>

                                    <td style="font-weight: 400; text-align: center">
                                        <?php
                                        if ($alt['icon'] == !null) {
                                            ?>
                                            <i class="fa <?=$alt['icon']?>"></i>
                                        <?php } else {?>
                                            <i class="fa fa-times"></i>
                                        <?php }?>
                                    </td>

                                    <td style="font-weight: 400;text-align: center">

                                            <span class="btn btn-dark btn-sm"><i class="fa fa-times"></i> Kullanılamaz</span>

                                    </td>

                                    <td style="font-weight: 400; text-align: center">
                                        <?php
                                        if ($alt['anasayfa_grup'] == 1) {
                                            ?>
                                            <span class="btn btn-success btn-sm"><i class="fa fa-check"></i> Aktif</span>
                                        <?php } else {?>
                                            <span class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Pasif</span>
                                        <?php }?>
                                    </td>

                                    <td style="font-weight: 400; text-align: center">
                                        <?php
                                        if ($alt['durum'] == 1) {
                                            ?>
                                            <span class="btn btn-success btn-sm"><i class="fa fa-check"></i> Aktif</span>
                                        <?php } else {?>
                                            <span class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Pasif</span>
                                        <?php }?>
                                    </td>

                                    <td class="text-nowrap" style="text-align: center; border-right: 0 !important;">
                                        <a  href="pages.php?sayfa=urunkategori&kategori_id=<?=$alt['id']?>" class="btn btn-sm btn-info" style="color:#FFF"><i class="fa fa-pencil text-inverse"></i> Düzenle </a>
                                        <a  onclick="deletebutton('<?=$alt['id']?>')" class="btn btn-sm btn-danger" style="color:#FFF"><i class="fa fa-times text-inverse"></i> Sil </a>
                                    </td>

                                </tr>
                            <?php }?>
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

                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=urunkategorileri&page="><?=$diller['sayfalama-ilk']?></a></li>
                        <li class="page-item"><a class="page-link" href="pages.php?sayfa=urunkategorileri&page=<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>

                    <?php } ?>
                    <?php
                    for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                        if($i == $Sayfa){

                            echo '    
    
                            <li class="page-item active" aria-current="page">
                              <a class="page-link" href="pages.php?sayfa=urunkategorileri&page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                            </li>
                            
                            ';

                        }else{
                            echo '
                    <li class="page-item"><a class="page-link" href="pages.php?sayfa=urunkategorileri&page='.$i.'">'.$i.'</a></li>
                    ';
                        }
                    }
                    }
                    ?>

                    <?php if($urunKatListele->rowCount() <=0) { } else { ?>
                        <?php if($Sayfa != $Sayfa_Sayisi){?>

                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=urunkategorileri&page=<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                            <li class="page-item"><a class="page-link" href="pages.php?sayfa=urunkategorileri&page=<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>


                        <?php }} ?>

                    <?php if($Sayfa >= 1){?>
                        </ul>
                        </nav>
                    <?php } ?>
                    <!---- Sayfalama Elementleri ================== !-->




                <?php } else {?>
                <div class="alert alert-info" style="font-weight: 400">
                   Ürün Kategorisi Bulunamadı!
                    <?php if(isset($_GET['search'])) {?>
                        <a href="pages.php?sayfa=urunkategorileri">Geri Dön</a>
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
if ($urunKatListele->rowCount()>0) {
?>
<div class="col-md-12 p-l-0 p-r-0" style="border-top: 1px solid #EBEBEB">
<div class="card p-l-5 p-b-15 p-t-20 bg-secondary">

    <form method="get" action="pages.php?sayfa=smsnumaralar&" >
        <div class="form-row align-items-center">

            <div class="col-auto">
                <input type="hidden" class="form-control mb-2" id="inlineFormInput" name="sayfa" value="urunkategorileri">
            </div>

            <div class="col-auto">
                <input type="text" class="form-control mb-2" id="inlineFormInput" required name="search" placeholder="Başlıklarda ara">
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

    function deletebutton(urunkatid){

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
                window.location.href = "support/post/delete/urun-kategori-sil.php?urunkat=success&id="+urunkatid;
            } else {
                swal("İptal Edildi", "Seçtiğiniz içerik silinmemiştir", "error");
            }
        });

    }

</script>




<?php if( $_GET['status']=='success'){ ?>
    <body onload="sweetAlert('İşlem Başarılı', 'İşleminiz başarıyla gerçekleşmiştir', 'success');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urunkategorileri">
<?php }?>
<?php if($_GET['status']=='warning'){ ?>
    <body onload="sweetAlert('Başarısız!', 'İşlem sırasında hata oluştu', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urunkategorileri">
<?php }?>
<?php if($_GET['status']=='nocheck'){ ?>
    <body onload="sweetAlert('Sorun Var!', 'Hiç seçim yapılmamış!', 'warning');">
    </body>
    <meta http-equiv="refresh" content="1; URL=pages.php?sayfa=urunkategorileri">
<?php }?>
