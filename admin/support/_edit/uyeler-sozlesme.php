<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<?php
    $sozlesme = $db->prepare("select * from uyeler_sozlesme where dil=:dil and id=:id ");
        $sozlesme->execute(array(
                'dil' => $_SESSION['dil'] ,
            'id' => $_GET['sozlesme_id']
        ));
        $row = $sozlesme->fetch(PDO::FETCH_ASSOC);

        if($sozlesme->rowCount() <= 0  ) { 
         header('Location:pages.php?sayfa=uyeliksozlesmesi');
        }
?>
<title>Sözleşme İçeriğini Düzenle | <?=$ayar['site_baslik']?></title>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="mdi mdi-email"></i> Sözleşme İçeriğini Düzenle</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=uyeliksozlesmesi">Üyelik Sözleşmesi</a></li>
                <li class="breadcrumb-item active">Sözleşme İçeriğini Düzenle</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">






            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/update/uyeler-sozlesme.php" class="form-horizontal form-bordered" method="post">

                    <input type="hidden" name="sozlesme_id" value="<?=$row['id']?>" >

                    <h3 class="card-title">Sözleşme İçeriğini Düzenle  <span style="font-size:15px;">( <i class="flag-icon-<?php echo $lang['flag'] ?>" style="width:18px; height:13px; display: inline-block; margin-right: 10px; "></i><?=$lang['baslik']?> Dilinde ) </span> </h3>
                    <hr>
                    <div class="form-body">



                      <div class="row">



                          <div class="form-group col-md-12">
                              <label style="font-weight: 500" for="mymce">Sözleşme Metni</label><br><br>


                              <textarea name="icerik" class="textarea_editor form-control"  rows="15" >
                                  <?=$row['icerik']?>
                              </textarea>


                          </div>


    

                    </div>


                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="sozlesmedegis">
                            <i class="fa fa-refresh fa-spin fa-fw"></i>
                            <span class="sr-only">Yükleniyor...</span> Güncelle
                        </button>
                    </div>

                </form>

            </div>





        </div>
    </div>
</div>





