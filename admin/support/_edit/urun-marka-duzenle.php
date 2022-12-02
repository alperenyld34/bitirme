<?php
ob_start();
session_start();
include "../../../includes/config/config.php";
date_default_timezone_set( 'Europe/Istanbul' );
$settings=$db->prepare("SELECT * from ayarlar where id='1'");
$settings->execute(array(0));
$ayar=$settings->fetch(PDO::FETCH_ASSOC);
$siteurl = $ayar['site_url'];
?>


<?php
include_once '../secure_post.php';
if ($adminsorgusu->rowCount()===0) {
    header("Location: 404");
} else { ?>

<?php if($_POST['markaID']  ) {?>

        <?php
        $markaQuery = $db->prepare("select * from urun_marka where id=:id ");
        $markaQuery->execute(array(
            'id' => $_POST['markaID']
        ));
        $markaRow = $markaQuery->fetch(PDO::FETCH_ASSOC);
        ?>

        <div class="row">
            <div class="form-group col-md-12" >
                <label for="yayinDurum" class="control-label">Yayın Durumu :</label>
                <input type='hidden' value='0' name='durum'>
                <input type="checkbox" <?php if($markaRow['durum'] == 1){?>checked<?php }?> id="yayinDurum" class="js-switch" data-color="#f62d51" name="durum" value="1" />
            </div>
            <div class="form-group col-md-12">
                <label for="baslik" class="control-label">Marka Başlığı :</label>
                <input type="text" class="form-control" id="baslik" name="baslik" required value="<?=$markaRow['baslik']?>"  >
            </div>
            <div class="form-group col-md-12">
                <label for="sira" class="control-label">Sıra :</label>
                <input type="number" class="form-control" id="sira" name="sira"  required value="<?=$markaRow['sira']?>" >
            </div>
            <div class="form-group col-md-12">
                <input type="hidden" name="eski_gorsel" value="<?=$markaRow['gorsel']?>">
                <label for="gorsel" class="control-label">Marka Görseli :</label>
                <?php if($markaRow['gorsel'] == !null ) {?>
                    <div>
                        <img src="../images/uploads/<?=$markaRow['gorsel']?>" style="max-width: 150px; border: 1px solid #EBEBEB; padding: 8px;  ">
                        <a href="pages.php?sayfa=urunmarkalari&gorselsil=success&id=<?=$markaRow['id']?>" class="btn btn-sm btn-danger">x Sil</a>
                    </div>
                <?php }?>
                <div class="input-group" style="margin-top: 8px">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="gorsel"  >
                        <label class="custom-file-label" for="inputGroupFile04">Seç</label>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="hidden_id" value="<?=$markaRow['id']?>" >
        
<?php }?>

<?php } //todo ürün marka?>


