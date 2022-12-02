<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?>
<title>Kargo Bilgisi Ekleme | <?=$ayar['site_baslik']?></title>
<?php
$siparisCikar = $db->prepare("select * from siparis_urunler where id='$_GET[sip_urun_id]'");
$siparisCikar->execute();
$urun = $siparisCikar ->fetch(PDO::FETCH_ASSOC);
?>
<?php
if($siparisCikar->rowCount() == 0 ) {
    header("Location:pages.php?sayfa=siparisler");
}
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><i class="ti-truck"></i> Kargo Bilgisi Ekleme</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="pages.php?sayfa=siparisler">Siparişler</a></li>
                <li class="breadcrumb-item active">Kargo Bilgisi Ekleme</li>
            </ol>
        </div>
    </div>
</div>

<a href="pages.php?sayfa=kargo&siparis_id=<?=$urun['siparis_id']?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Geri Dön</a>
<br><br>

<div class="row">
    <div class="col-lg-12">

        <div class="card">






            <div class="card-body" style="font-family: 'Open Sans', Arial">

                <form action="support/post/insert/kargo-bilgisi-ekle.php" class="form-horizontal form-bordered" method="post">


                    <input type="hidden" name="urun_id" value="<?=$urun['id']?>">
                    
                    <h3 class="card-title">Kargo Bilgisi Ekleme <span style="font-size:15px;"></span></h3>
                    <hr>
                    <div class="form-body">




                      <div class="row">

                          <div class="form-group col-md-2">
                              <label for="siparisno" class="control-label" style="font-weight: 500">Sipariş No :</label>
                              <br><br>
                              <input type="text" class="form-control" id="siparisno" name="siparis_id"  readonly value="<?=$urun['siparis_id']?>" >
                          </div>



                          <div class="form-group col-md-2">
                              <label for="adetSayisi" class="control-label" style="font-weight: 500">Adet :</label>
                              <br><br>
                              <input type="text" class="form-control" id="adetSayisi"  readonly value="<?=$urun['adet']?>" >
                          </div>

                          <div class="form-group col-md-8">
                              <label for="urunAdi" class="control-label" style="font-weight: 500">Ürün Adı :</label>
                              <br><br>
                              <input type="text" class="form-control" id="urunAdi"  readonly value="<?=$urun['urun_baslik']?>" >
                          </div>



                          <div class="form-group col-md-6">
                              <label for="kargoAdi" class="control-label" style="font-weight: 500">Kargo Firması :</label>
                              <br><br>
                              <input type="text" class="form-control" id="kargoAdi" name="kargo_adi"  required >
                          </div>
                          <div class="form-group col-md-6">
                              <label for="recipient-name" class="control-label" style="font-weight: 500">Kargo Takip No :</label>
                              <br><br>
                              <input type="text" class="form-control" id="recipient-name" name="takip_no" required >
                          </div>
                          <div class="form-group col-md-6">
                              <label for="message-text" class="control-label" style="font-weight: 500">E-Posta Bildirim İçeriği</label>
                              <br><br>
                              <small>E-Posta ile bilgilendirme maili içeriğini kendiniz belirleyebilirsiniz. Mesajınız kargo bilgilerinin altında yer alacaktır. Boş bırakabilirsiniz.</small>
                              <br><br>
                              <textarea class="textarea_editor form-control" id="message-text" rows="4" name="eposta_mesaj"  ></textarea>
                          </div>
                          <div class="form-group col-md-6">
                              <label for="message-tex2t" class="control-label" style="font-weight: 500">SMS Bildirim İçeriği</label>
                              <br><br>
                              <small>SMS ile bilgilendirme mesajını kendiniz belirleyebilirsiniz. Mesajınız kargo bilgilerinin altında yer alacaktır. Boş bırakabilirsiniz.</small>
                              <br><br>
                              <textarea class="textarea_editor form-control" id="message-tex2t" rows="6" name="sms_mesaj"  ></textarea>
                          </div>
    

                    </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-info" name="kargoekle">
                            <i class="fa fa-save"></i>
                            Kaydet
                        </button>
                    </div>



                </form>

            </div>





        </div>



    </div>
</div>





