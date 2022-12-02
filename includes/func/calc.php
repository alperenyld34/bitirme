<?php
if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"])> 0) {
    ?>
    <?php
    $total = 0;
    foreach($_SESSION["shopping_cart"] as $product) {

        $uruncek = $db->prepare("select * from urun where id='$product[item_id]' order by id desc limit 1");
        $uruncek->execute();
        $urun = $uruncek->fetch(PDO::FETCH_ASSOC);


        if ($urun['kdv'] == 1)
        {

            $toplamkdvtutar_item = $urun['fiyat'] * $urun['kdv_oran'] / 100 * $product['item_quantity'];
        }
        if ($urun['kdv'] == 0)
        {

            $toplamkdvtutar_item = 0;
        }

        //////////** Sepetin Ara Toplamı */////////
        $aratoplam = $aratoplam + ($product["item_quantity"] * $urun["fiyat"]);

        ////////** KDV'ler Toplamı *///////
        $kdvtoplam = $kdvtoplam + ($toplamkdvtutar_item);

        ////////** Kargo Limiti Sorgusu *///////

        $kargolimiti = $aratoplam + $kdvtoplam ;

        //////////** Kargo Ücretleri Toplamı *///////
        if($odemeayar['kargo_sistemi'] == 1) {

            if($kargolimiti >= $odemeayar['kargo_limit'] && $odemeayar['kargo_limit'] > 0) {

                $kargotoplam = 0;

            } else {

                if($urun['kargo'] == 1  ) {
                    $kargotutar = $urun['kargo_ucret'] ;
                }else{
                    $kargotutar = '0';
                }


                $kargotoplam = $kargotoplam + ($kargotutar);


            }
        } else {
            $kargotoplam = 0;
        }


        //////** Ödenecek Toplam */////////

        $odenecektoplam = $aratoplam + $kdvtoplam + $kargotoplam;


        ////////////////////////** SESSIONLAR */////////////////////////////////

        $_SESSION["ara_tutar"] = $aratoplam;
        $_SESSION["kdv_tutar"] = $kdvtoplam;
        $_SESSION["kargo_tutar"] = $kargotoplam;
        $_SESSION["toplam_odenecek_tutar"] = $odenecektoplam;


    }
    ?>
    <?php

////////////////////////////////** SEPETTEKİ ITEM SESSIONLARI */////////////////////////////////////////////


    foreach ($_SESSION["shopping_cart"] as $sessionKey=>$cart_itm) //loop through session array var
    {
        $urun_session_update = $db->prepare("select * from urun where id='$cart_itm[item_id]' order by id desc limit 1");
        $urun_session_update->execute();
        $urunsession = $urun_session_update->fetch(PDO::FETCH_ASSOC);



        $_SESSION["shopping_cart"][$sessionKey]["item_fiyat"] = $urunsession['fiyat'];


        if($odemeayar['kargo_sistemi'] == 1 && $urunsession['kargo'] == 1) {
            $_SESSION["shopping_cart"][$sessionKey]["item_kargo_tutar"] = $urunsession['kargo_ucret'];
        }
        if($odemeayar['kargo_sistemi'] == 1 && $urunsession['kargo'] == 0) {
            $_SESSION["shopping_cart"][$sessionKey]["item_kargo_tutar"] = 0;
        }

        if($urunsession['kdv'] == 1){
            $_SESSION["shopping_cart"][$sessionKey]["item_kdv_tutar"] = $urunsession['fiyat'] * $urunsession['kdv_oran'] / 100;
        }


    }
    ?>
<?php }?>