<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Bilgi Kutusu Düzenle | <?=$ayar['site_baslik']?></title>

<?php
$kutucek = $db->prepare("select * from ticaret_bilgi where id='$_GET[kutu_id]'");
$kutucek->execute();
$kutu = $kutucek->fetch(PDO::FETCH_ASSOC);
?>
<?php
if($kutucek->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=bilgikutulari");
}
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-tab"></i> Bilgi Kutusu Düzenle </h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=bilgikutulari">Bilgi Kutuları</a></li>
                <li class="breadcrumb-item active">Bilgi Kutusu Düzenle </li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">






            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/update/ticaret-kutu.php" class="form-horizontal" method="post">

                    <input type="hidden" class="form-control" name="kutu_id"value="<?=$kutu['id']?>">


                    <h3 class="card-title">Kutu İçerikleri</h3>
                    <hr>
                    <div class="form-body">



                        <div class="row p-t-20 m-b-20" style="border-bottom:1px solid #EBEBEB">

                          <div class="col-md-7">
                                <div class="form-group">
                                    <label style="font-weight: 500" for="basLik">Kutu Yazısı</label><br><br>

                                    <input type="text" class="form-control" name="baslik" id="basLik"  value="<?=$kutu['baslik']?>">

                                </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label style="font-weight: 500" for="icons">Icon</label><br><br>


                                  <select class="form-control awesome-select" name="icon" id="icons">
                                      <option value='<?=$kutu['icon']?>' selected> <?=$kutu['icon']?></option>
                                      <?php include 'support/panel_parts/icon.php'?>
                                  </select>

                              </div>
                          </div>


                          <div class="col-md-2">
                              <div class="form-group">
                                  <label style="font-weight: 500" for="siRa">Sıra</label><br><br>

                                  <input type="text" class="form-control" name="sira" id="siRa"  value="<?=$kutu['sira']?>">

                              </div>
                          </div>


    

                        </div>


                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="kutudegis">
                            <i class="fa fa-refresh fa-spin fa-fw"></i>
                            <span class="sr-only">Yükleniyor...</span> Güncelle
                        </button>
                    </div>

                </form>

            </div>





        </div>
    </div>
</div>





