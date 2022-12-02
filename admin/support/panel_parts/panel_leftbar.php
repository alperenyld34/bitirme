<?php echo !defined("GUVENLIK") ? die("İzinsiz!?") : null;?>

<?php
$yoneticisql = $db->prepare("select * from yonetici where user_adi = '$_SESSION[admin_username]' order by id");
$yoneticisql->execute();
$yonetici = $yoneticisql->fetch(PDO::FETCH_ASSOC);

$mesajj = $db->prepare("select * from mesaj where durum='1' order by id desc");
$mesajj->execute();

$sipariss = $db->prepare("select * from siparis where siparis_durum='0' order by id desc");
$sipariss->execute();

$insankaynaklari = $db->prepare("select * from insan_kaynaklari where durum='1' order by id desc");
$insankaynaklari->execute();

$destektalepleri = $db->prepare("select * from uyeler_destek where durum=:durum ");
$destektalepleri->execute(array(
    'durum' => '1'
));

$bekleyenYorum = $db->prepare("select * from urun_yorum where onay=:onay ");
$bekleyenYorum->execute(array(
    'onay' => '0'
));
$onaysizyorumsay = $bekleyenYorum->rowCount();

$tekliflerCek = $db->prepare("select * from teklif_form where durum='1' order by id desc");
$tekliflerCek->execute();

?>
<aside class="left-sidebar" >
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" >
        <!-- User Profile-->
        <div class="user-profile">
            <div class="user-pro-body">
                <?php
                if ($yonetici['foto'] == null) {
                    ?>
                    <div><img src="support/images/user_default.png" alt="user-img" class="img-circle"></div>
                <?php } else {?>
                    <div><img src="../assets/images/users/<?=$yonetici['foto']?>" alt="user-img" class="img-circle"></div>
                <?php }?>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$yonetici['isim']?> <span class="caret"></span></a>
                    <div class="dropdown-menu animated flipInY">
                        <!-- text-->
                        <a style="font-size:13px;" href="pages.php?sayfa=yoneticiler&yonetici_id=<?=$yonetici['id']?>" class="dropdown-item"><i class="ti-user"></i> Profilim</a>
                        <a style="font-size:13px;" href="pages.php?sayfa=sifredegistir" class="dropdown-item"><i class="mdi mdi-key"></i> Şifre Değişikliği</a>
                        <!-- text-->

                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="logout.php" class="dropdown-item"><i class="fa fa-power-off"></i> Çıkış Yap</a>
                        <!-- text-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" style="font-family: 'Open Sans', Arial; ">

                <li class="nav-small-cap" style="background-color:#F8F8F8; text-align: left; border-bottom:1px dashed #EBEBEB;border-top:1px dashed #EBEBEB; padding: 5px 0 5px 0">
                    <a href="../index.html" target="_blank" >
                        <span class="text-dark" style="font-size:13px;">SİTEYİ GÖR
                        <?php if($bakim['durum'] == 1 ){ ?><i class="fa fa-eye-on text-success" style="float:left; margin-top: 3px"></i><?php } else {?>
                            <i class="fa fa-eye text-muted" style="float:left; margin-top: 3px"></i>
                        <?php }?>
                        </span>
                    </a>
                </li>


                <li class="nav-small-cap"><span style="padding-left: 15px;"> SİTE GENEL</span></li>


                <li>
                    <a  class="waves-effect waves-dark" href="index.php" ><i class="icon-speedometer"></i><span class="hide-menu">Gösterge Paneli</span></a>
                </li>


                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Ayarlar</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a style="font-size:13px;" href="pages.php?sayfa=siteayar"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Site Ayarları</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=temaayar"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Tema Ayarları</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=modulsiralama"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Anasayfa Düzeni</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=sosyalmedyalar"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Sosyal Medya</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=headermenu"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Üst Menü</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=footermenu"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Alt Menü</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=iletisimayar"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> İletişim Bilgileri</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=yonetici"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Yöneticiler Ekle Sil</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=kodekle"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Kod Ekleme</a></li>
                    </ul>
                </li>
                
                <li> <a class="waves-effect waves-dark" href="pages.php?sayfa=mesajlar" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Gelen Kutusu

                            <?php if($mesajj->rowCount()>0) {?>
                                <span class="badge badge-pill badge-info text-white ml-auto" style="margin-top: 2px">

                                <?php echo $mesajj->rowCount();?>

                            </span>
                            <?php } else {}?>


                        </span></a>
                </li>

                <!-- Yeni Ekleme Teklif Alanı //TODO  !-->
                <li> <a class="waves-effect waves-dark" href="pages.php?sayfa=teklifler" aria-expanded="false"><i class="mdi mdi-fan"></i><span class="hide-menu">Teklif Bekleyen

                            <?php if($tekliflerCek->rowCount()>0) {?>
                                <span class="badge badge-pill badge-info text-white ml-auto" style="margin-top: 2px">

                                <?php echo $tekliflerCek->rowCount();?>

                            </span>
                            <?php } else {}?>


                        </span></a>
                </li>
                <!-- Yeni Ekleme Teklif Alanı SON !-->

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-menu"></i><span class="hide-menu">Header Menü</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a style="font-size:13px;" href="pages.php?sayfa=headermenu"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Menüleri Gör</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=headermenuayar"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Header Ayarları</a></li>

                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-tag-multiple"></i><span class="hide-menu">Footer Menü</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a style="font-size:13px;" href="pages.php?sayfa=footermenu"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Menüleri Gör</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=footermenuayar"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Footer Ayarları</a></li>

                    </ul>
                </li>

             

               

        

    
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Üyeler</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a style="font-size:13px;" href="pages.php?sayfa=uyeayar"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Üyelik Ayarları</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=uyeler"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Üye Listesi</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=uyeliksozlesmesi"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Üyelik Sözleşmesi</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-tooltip-text"></i><span class="hide-menu">Destek Merkezi</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li>
                            <a style="font-size:13px;" href="pages.php?sayfa=aktifdestek"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Açık Talepler
                                <?php if($destektalepleri->rowCount() > 0  ) {?>
                                    <span class="badge badge-pill badge-info text-white ml-auto" style="margin-top: 2px"><?=$destektalepleri->rowCount()?></span>
                                <?php }else { ?>
                                    <span class="badge badge-pill badge-dark text-white ml-auto" style="margin-top: 2px">0</span>
                                <?php }?>
                            </a>
                        </li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=cevaplanandestek"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Cevaplanan Talepler</a></li>
                    </ul>
                </li>

                <li class="nav-small-cap"><span style="padding-left: 15px;"> ÜRÜN YÖNETİMİ</span></li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-dropbox"></i><span class="hide-menu">Ürünler</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a style="font-size:13px;" href="pages.php?sayfa=urunkategorileri"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Ürün Kategorileri</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=urunmarkalari"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Ürün Markaları</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=urunekle"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Ürün Ekle</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=urunler"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Ürünleri Gör</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=urunmodul"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Ürün Modül Ayarı</a></li>
                    </ul>
                </li>


                <li> <a class="waves-effect waves-dark" href="pages.php?sayfa=siparisler" aria-expanded="false"><i class="icon-basket"></i><span class="hide-menu">Siparişler

                         <?php if($sipariss->rowCount()>0) {?>
                             <span class="badge badge-pill badge-dark text-white ml-auto" style="margin-top: 2px">

                                <?php echo $sipariss->rowCount();?>

                            </span>
                         <?php } else {}?>


                        </span></a>

                </li>
                

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-credit-card"></i><span class="hide-menu"> Ödeme Ayarları</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a style="font-size:13px;" href="pages.php?sayfa=ticariayar"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Ticari Ayarlar</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=posayar"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> POS Ayarları</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=bilgikutulari"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Bilgi Kutuları</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=satissozlesmesi"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Satış Sözleşmesi</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-comment"></i><span class="hide-menu">Ürün Yorumları</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a style="font-size:13px;" href="pages.php?sayfa=onayliyorumlar"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Onaylanan Yorumlar</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=onaybekleyenyorumlar"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Onay Bekleyenler

                                <span class="badge badge-pill badge-dark text-white ml-auto" style="margin-top: 2px"><?=$onaysizyorumsay?></span>
                                <?php
                                //TODO ekleme yapıldı. - yorumlar için menu itemi eklendi ve header alanına onay bekleyenler için sayım kodlaması yapıldı
                                ?>
                            </a></li>
                    </ul>
                </li>


              

                </li>

                

                <li class="nav-small-cap"><span style="padding-left: 15px;"> MODÜLLER</span></li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-slider"></i><span class="hide-menu">Slider</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a style="font-size:13px;" href="pages.php?sayfa=sliderekle"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Slider Ekle</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=sliderlar"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Tüm Sliderlar</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=slidermodul"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Slider Modül Ayarı</a></li>
                    </ul>
                </li>

              

             

            

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-files"></i><span class="hide-menu">Sayfa Yönetimi</span></a>
                    <ul aria-expanded="false" class="collapse" >
                        <li><a style="font-size:13px;" href="pages.php?sayfa=hakkimizdasayfa"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Hakkımızda Sayfası</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=sayfaekle"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Yeni Sayfa Ekle</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=sayfalar"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> HTML Sayfalar</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-pencil"></i><span class="hide-menu">Blog Yazıları</span></a>
                    <ul aria-expanded="false" class="collapse" >
                        <li><a style="font-size:13px;" href="pages.php?sayfa=blogekle"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Yeni Blog Ekle</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=bloglar"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Blog Yazılarını Gör</a></li>
                        <li><a style="font-size:13px;" href="pages.php?sayfa=blogmodul"><i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i> Blog Modül Ayarı</a></li>
                    </ul>
                </li>

               

             

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="icon-bubbles"></i><span class="hide-menu">Müşteri Yorumları</span></a>
                    <ul aria-expanded="false" class="collapse" >
                        <li>
                            <a style="font-size:13px;" href="pages.php?sayfa=yorumekle">
                                <i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i>
                                Yeni Yorum Ekle
                            </a>
                        </li>
                        <li>
                            <a style="font-size:13px;" href="pages.php?sayfa=yorumlar">
                                <i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i>
                                Tüm Yorumlar
                            </a>
                        </li>
                        <li>
                            <a style="font-size:13px;" href="pages.php?sayfa=yorummodul">
                                <i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i>
                                Yorum Modül Ayarı
                            </a>
                        </li>
                    </ul>
                </li>


             


                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-bank"></i><span class="hide-menu">Banka Hesapları</span></a>
                    <ul aria-expanded="false" class="collapse" >
                        <li>
                            <a style="font-size:13px;" href="pages.php?sayfa=bankaekle">
                                <i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i>
                                Yeni Hesap Ekle
                            </a>
                        </li>
                        <li>
                            <a style="font-size:13px;" href="pages.php?sayfa=bankalar">
                                <i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i>
                                Tüm Banka Hesapları
                            </a>
                        </li>

                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-format-list-numbers"></i><span class="hide-menu">Sayaç</span></a>
                    <ul aria-expanded="false" class="collapse" >
                        <li>
                            <a style="font-size:13px;" href="pages.php?sayfa=sayacekle">
                                <i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i>
                                Yeni Sayaç Ekle
                            </a>
                        </li>
                        <li>
                            <a style="font-size:13px;" href="pages.php?sayfa=sayaclar">
                                <i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i>
                                Tüm Sayaçlar
                            </a>
                        </li>
                        <li>
                            <a style="font-size:13px;" href="pages.php?sayfa=sayacmodul">
                                <i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i>
                                Sayaç Modül Ayarı
                            </a>
                        </li>

                    </ul>
                </li>


                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-help-circle"></i><span class="hide-menu">Sık Sorulanlar</span></a>
                    <ul aria-expanded="false" class="collapse" >
                        <li>
                            <a style="font-size:13px;" href="pages.php?sayfa=soruekle">
                                <i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i>
                                Yeni Soru Ekle
                            </a>
                        </li>
                        <li>
                            <a style="font-size:13px;" href="pages.php?sayfa=sorular">
                                <i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i>
                                Tüm Sorular
                            </a>
                        </li>
                        <li>
                            <a style="font-size:13px;" href="pages.php?sayfa=sorumodul">
                                <i class="fa fa-circle-o text-info" style="font-size:9px; margin-top: 6px; margin-right: 5px; float:left; margin-left:-20px"></i>
                                Soru Modül Ayarı
                            </a>
                        </li>
                    </ul>
                </li>


              

             


                <li> <a class="waves-effect waves-dark" href="pages.php?sayfa=insankaynaklari" aria-expanded="false">
                        <i class="mdi mdi-account"></i><span class="hide-menu">Başvurular
                        <?php if($insankaynaklari->rowCount()>0) {?>
                            <span class="badge badge-pill badge-purple text-white ml-auto" style="margin-top: 2px">

                                <?php echo $insankaynaklari->rowCount();?>

                            </span>
                        <?php } else {}?>
                        </span></a>
                </li>


                <li class="nav-small-cap"><span style="padding-left: 15px;"> OTURUM</span></li>

                <li> <a class="waves-effect waves-dark" href="logout.php" aria-expanded="false">
                        <i class="mdi mdi-power"></i><span class="hide-menu">Çıkış Yap</span></a>
                </li>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
