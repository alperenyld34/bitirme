<?php
ob_start();
session_start();
include "../config/config.php";
date_default_timezone_set( 'Europe/Istanbul' );
$randomUret = rand(0,(int) 9999999999999);

if(isset($_POST["product_code"])) {

    $varyantDurum = $db->prepare("select * from varyant where urun_id='$_POST[product_code]' ");
    $varyantDurum->execute();

    if ($varyantDurum->rowCount() == 0) {
        function sepetKey()
        {
            return md5(serialize([$_POST["product_code"]]));
        }
    }
    if ($varyantDurum->rowCount() == 1) {
        function sepetKey()
        {
            return md5(serialize([$_POST["product_code"] . $_POST["var1"]]));
        }
    }
    if ($varyantDurum->rowCount() == 2) {
        function sepetKey()
        {
            return md5(serialize([$_POST["product_code"] . $_POST["var1"].",". $_POST["var2"]]));
        }
    }
    if ($varyantDurum->rowCount() == 3) {
        function sepetKey()
        {
            return md5(serialize([$_POST["product_code"] . $_POST["var1"].",". $_POST["var2"].",". $_POST["var3"]]));
        }
    }
    if ($varyantDurum->rowCount() == 4) {
        function sepetKey()
        {
            return md5(serialize([$_POST["product_code"] . $_POST["var1"].",". $_POST["var2"].",". $_POST["var3"].",". $_POST["var4"]]));
        }
    }

    if(isset($_SESSION["shopping_cart"]))
    {



        $varyantDurum = $db->prepare("select * from varyant where urun_id='$_POST[product_code]' ");
        $varyantDurum->execute();



        // VARYANT YOK İSE ///
        if ($varyantDurum->rowCount() == 0) {


            $item_array_id = array_column($_SESSION["shopping_cart"], "group_id");
            $search_id = array_search(sepetKey(), $item_array_id);
            if ($search_id === FALSE) {


                // Varyantsız ürün ve aynısından yok alanı //
                $uruncek = $db->prepare("select * from urun where id='$_POST[product_code]'");
                $uruncek->execute();
                $row = $uruncek->fetch(PDO::FETCH_ASSOC);

                if ($row['stok'] >= $_POST["quantity"]) {

                    $count = count($_SESSION["shopping_cart"]);
                    $item_array = array(
                        'group_id'			=>	SepetKey(),
                        'item_id'			=>	$row["id"],
                        'item_name'			=>	$row["baslik"],
                        'item_quantity'		=>	$_POST["quantity"]
                    );

                    $_SESSION["shopping_cart"][SepetKey()] = $item_array;
                    $total_product = count($_SESSION["shopping_cart"]);
                    $cevapverdim = "Success";
                    die(json_encode(array(
                        'cevapver'=>$cevapverdim
                    )));


                }else {}
                // Varyantsız ürün ve aynısından yok alanı ENDING //


            } else {

                // Varyantsız ürün ve aynısından var ise //
                $toplamadet = 0;
                $item_array_id = array_column($_SESSION["shopping_cart"], "group_id");
                $search_id = array_search(sepetKey(), $item_array_id);

                $uruncek = $db->prepare("select * from urun where id='$_POST[product_code]'");
                $uruncek->execute();
                $row = $uruncek->fetch(PDO::FETCH_ASSOC);
                foreach($_SESSION["shopping_cart"] as $adetrows) {

                    if($adetrows['item_id'] == $_POST['product_code']) {

                        $adetler = $adetrows["item_quantity"];

                        $toplamadet = $toplamadet + ($adetler);

                    }
                }

                if($row['stok'] >= $toplamadet+ $_POST['quantity']) {

                    $yeni_miktar = $_POST["quantity"];
                    $toplam_miktar = $_SESSION["shopping_cart"][sepetKey()]['item_quantity'] + $_POST["quantity"];
                    $_SESSION["shopping_cart"][sepetKey()]['item_quantity'] = 	$toplam_miktar;


                    $cevapverdim = "EKLENDİ";
                    die(json_encode(array(
                        'cevapver'=>$cevapverdim
                    )));

                } else {}
                // Varyantsız ürün ve aynısından var ise ENDING //
            }

            // VARYANT YOK İSE ENDING ///

        } else {


            // VARYANT VAR ///////////////////////////////////////
            $toplamadet = 0;
            $item_array_id = array_column($_SESSION["shopping_cart"], "group_id");
            $search_id = array_search(sepetKey(), $item_array_id);
            if ($search_id === FALSE) {
                // Farklı ürünler - Varyant Var //

                $uruncek = $db->prepare("select * from urun where id='$_POST[product_code]'");
                $uruncek->execute();
                $row = $uruncek->fetch(PDO::FETCH_ASSOC);

                $varyantlar = $db->prepare("select * from varyant where urun_id='$_POST[product_code]' ");
                $varyantlar->execute();

                foreach ($_SESSION["shopping_cart"] as $adetrows) {
                    if ($adetrows['item_id'] == $_POST['product_code']) {
                        $adetler = $adetrows["item_quantity"];
                        $toplamadet = $toplamadet + ($adetler);
                    }
                }

                if ($row['stok'] >= $toplamadet + $_POST['quantity']) {

                    $item_array = array(
                        'group_id' => SepetKey(),
                        'item_id' => $row["id"],
                        'item_name' => $row["baslik"],
                        'item_quantity' => $_POST["quantity"],
                    );


                    if ($varyantlar->rowCount() == 1) {
                        array($item_array["var"] = $_POST['var1']);
                    }
                    if ($varyantlar->rowCount() == 2) {
                        array($item_array["var"] = $_POST['var1'] . ',' . $_POST['var2']);
                    }
                    if ($varyantlar->rowCount() == 3) {
                        array($item_array["var"] = $_POST['var1'] . ',' . $_POST['var2'] . ',' . $_POST['var3']);
                    }
                    if ($varyantlar->rowCount() == 4) {
                        array($item_array["var"] = $_POST['var1'] . ',' . $_POST['var2'] . ',' . $_POST['var3'] . ',' . $_POST['var4']);
                    }

                    $_SESSION["shopping_cart"][SepetKey()] = $item_array;

                    $total_product = count($_SESSION["shopping_cart"]);
                    $cevapverdim = "EKLENDİ";
                    die(json_encode(array(
                        'shopping_cart' => $total_product,
                        'cevapver' => $cevapverdim
                    )));

                } else {}
                // Farklı Ürünler - Varyant Var Ending //


            } else {
                $toplamadet = 0;

                // Aynı Ürünler - Varyant var Adet Artttır //

                $item_array_id = array_column($_SESSION["shopping_cart"], "group_id");
                $search_id = array_search(sepetKey(), $item_array_id);

                $varyantlar = $db->prepare("select * from varyant where urun_id='$_POST[product_code]' ");
                $varyantlar->execute();


                /// 1 varyant için //
                if ($varyantlar->rowCount() == 1) {

                    if ($_POST['var1'] == $_SESSION['shopping_cart'][sepetKey()]['var']){

                    $uruncek = $db->prepare("select * from urun where id='$_POST[product_code]'");
                    $uruncek->execute();
                    $row = $uruncek->fetch(PDO::FETCH_ASSOC);
                    foreach ($_SESSION["shopping_cart"] as $adetrows) {

                        if ($adetrows['item_id'] == $_POST['product_code']) {

                            $adetler = $adetrows["item_quantity"];

                            $toplamadet = $toplamadet + ($adetler);

                        }
                    }

                    if ($row['stok'] >= $toplamadet + $_POST['quantity']) {

                        $yeni_miktar = $_POST["quantity"];
                        $toplam_miktar = $_SESSION["shopping_cart"][sepetKey()]['item_quantity'] + $_POST["quantity"];
                        $_SESSION["shopping_cart"][sepetKey()]['item_quantity'] = $toplam_miktar;


                        $cevapverdim = "EKLENDİ";
                        die(json_encode(array(
                            'cevapver' => $cevapverdim
                        )));
                    } else { }

                }


            }
                /// 1 varyant için Ending //



                /// 2 varyant için //
                if ($varyantlar->rowCount() == 2) {

                    if ($_POST['var1'].",".$_POST['var2'] == $_SESSION['shopping_cart'][sepetKey()]['var']){

                        $uruncek = $db->prepare("select * from urun where id='$_POST[product_code]'");
                        $uruncek->execute();
                        $row = $uruncek->fetch(PDO::FETCH_ASSOC);
                        foreach ($_SESSION["shopping_cart"] as $adetrows) {

                            if ($adetrows['item_id'] == $_POST['product_code']) {

                                $adetler = $adetrows["item_quantity"];

                                $toplamadet = $toplamadet + ($adetler);

                            }
                        }

                        if ($row['stok'] >= $toplamadet + $_POST['quantity']) {

                            $yeni_miktar = $_POST["quantity"];
                            $toplam_miktar = $_SESSION["shopping_cart"][sepetKey()]['item_quantity'] + $_POST["quantity"];
                            $_SESSION["shopping_cart"][sepetKey()]['item_quantity'] = $toplam_miktar;


                            $cevapverdim = "EKLENDİ";
                            die(json_encode(array(
                                'cevapver' => $cevapverdim
                            )));
                        } else { }

                    }


                }
                /// 2 varyant için Ending //


                /// 3 varyant için //
                if ($varyantlar->rowCount() == 3) {

                    if ($_POST['var1'].",".$_POST['var2'].",".$_POST['var3'] == $_SESSION['shopping_cart'][sepetKey()]['var']){

                        $uruncek = $db->prepare("select * from urun where id='$_POST[product_code]'");
                        $uruncek->execute();
                        $row = $uruncek->fetch(PDO::FETCH_ASSOC);
                        foreach ($_SESSION["shopping_cart"] as $adetrows) {

                            if ($adetrows['item_id'] == $_POST['product_code']) {

                                $adetler = $adetrows["item_quantity"];

                                $toplamadet = $toplamadet + ($adetler);

                            }
                        }

                        if ($row['stok'] >= $toplamadet + $_POST['quantity']) {

                            $yeni_miktar = $_POST["quantity"];
                            $toplam_miktar = $_SESSION["shopping_cart"][sepetKey()]['item_quantity'] + $_POST["quantity"];
                            $_SESSION["shopping_cart"][sepetKey()]['item_quantity'] = $toplam_miktar;


                            $cevapverdim = "EKLENDİ";
                            die(json_encode(array(
                                'cevapver' => $cevapverdim
                            )));
                        } else { }

                    }


                }
                /// 3 varyant için Ending //


                /// 4 varyant için //
                if ($varyantlar->rowCount() == 4) {

                    if ($_POST['var1'].",".$_POST['var2'].",".$_POST['var3'].",".$_POST['var4'] == $_SESSION['shopping_cart'][sepetKey()]['var']){

                        $uruncek = $db->prepare("select * from urun where id='$_POST[product_code]'");
                        $uruncek->execute();
                        $row = $uruncek->fetch(PDO::FETCH_ASSOC);
                        foreach ($_SESSION["shopping_cart"] as $adetrows) {

                            if ($adetrows['item_id'] == $_POST['product_code']) {

                                $adetler = $adetrows["item_quantity"];

                                $toplamadet = $toplamadet + ($adetler);

                            }
                        }

                        if ($row['stok'] >= $toplamadet + $_POST['quantity']) {

                            $yeni_miktar = $_POST["quantity"];
                            $toplam_miktar = $_SESSION["shopping_cart"][sepetKey()]['item_quantity'] + $_POST["quantity"];
                            $_SESSION["shopping_cart"][sepetKey()]['item_quantity'] = $toplam_miktar;


                            $cevapverdim = "EKLENDİ";
                            die(json_encode(array(
                                'cevapver' => $cevapverdim
                            )));
                        } else { }

                    }


                }
                /// 4 varyant için Ending //

                // Aynı Ürünler - Varyant var Adet Artttır Ending //

            }

            // VARYANT VAR ENDING //


        }









    }
    else {


        /******************** SESSION YOK ISE YENIDEN OLUSTURULUR *************************************/



            $uruncek = $db->prepare("select * from urun where id='$_POST[product_code]'");
            $uruncek->execute();
            $row = $uruncek->fetch(PDO::FETCH_ASSOC);

            $varyantlar = $db->prepare("select * from varyant where urun_id='$_POST[product_code]' ");
            $varyantlar->execute();

            if ($row['stok'] >= $_POST["quantity"]) {
            $item_array = array(
                'group_id' => SepetKey(),
                'item_id' => $row["id"],
                'item_name' => $row["baslik"],
                'item_quantity' => $_POST["quantity"],
            );


            if ($varyantlar->rowCount() == 1) {
                array($item_array["var"] = $_POST['var1']);
            }
            if ($varyantlar->rowCount() == 2) {
                array($item_array["var"] = $_POST['var1'] . ',' . $_POST['var2']);
            }
            if ($varyantlar->rowCount() == 3) {
                array($item_array["var"] = $_POST['var1'] . ',' . $_POST['var2'] . ',' . $_POST['var3']);
            }
            if ($varyantlar->rowCount() == 4) {
                array($item_array["var"] = $_POST['var1'] . ',' . $_POST['var2'] . ',' . $_POST['var3'] . ',' . $_POST['var4']);
            }

            $_SESSION["shopping_cart"][SepetKey()] = $item_array;

            $total_product = count($_SESSION["shopping_cart"]);
            $cevapverdim = "EKLENDİ";
            die(json_encode(array(
                'cevapver' => $cevapverdim
            )));

        } else {}

    }

    /******************** SESSION YOK ISE YENIDEN OLUSTURULUR ENDING *************************************/





}
# Remove products from cart

if(isset($_GET["delete_id"]))
{

    foreach($_SESSION["shopping_cart"] as $keys => $values)
    {
        if($values["group_id"] == $_GET["delete_id"]) {
            unset($_SESSION["shopping_cart"][$keys]);


        }
    }

    die(json_encode(array()));
}



#Eksi yapma

if(isset($_GET["id"]))
{

    foreach ($_SESSION["shopping_cart"] as $sessionKey=>$cart_itm) //loop through session array var
    {
        //echo count($_SESSION['items']);
        if($cart_itm["group_id"] == $_GET["id"]){ //item id is equal

            if($_SESSION["shopping_cart"][$sessionKey]["item_quantity"] > 0) {

                $_SESSION["shopping_cart"][$sessionKey]["item_quantity"] = $_SESSION["shopping_cart"][$sessionKey]["item_quantity"] -1 ;

            }

            if($_SESSION["shopping_cart"][$sessionKey]["item_quantity"] < 1) {
                unset($_SESSION["shopping_cart"][$sessionKey]);

            }

        }
    }


    die(json_encode(array()));

}



#artı yapma

if(isset($_GET["plus_id"]))
{

    foreach ($_SESSION["shopping_cart"] as $sessionKey=>$cart_itm) //loop through session array var
    {
        //echo count($_SESSION['items']);
        if($cart_itm["group_id"] == $_GET["plus_id"]){ //item id is equal

            $stokcek = $db->prepare("select * from urun where id='$cart_itm[item_id]' order by id desc limit 1");
            $stokcek->execute();
            $stok = $stokcek->fetch(PDO::FETCH_ASSOC);
            $stokcount = $stok["stok"];

            $toplamadet = 0;
            foreach($_SESSION["shopping_cart"] as $adetrows) {

                if($adetrows["item_id"] == $stok["id"]) {

                    $adetler = $adetrows["item_quantity"];

                    $toplamadet = $toplamadet + ($adetler);

                }
            }

            if($stokcount > $toplamadet) {

                    $_SESSION["shopping_cart"][$sessionKey]["item_quantity"] = $_SESSION["shopping_cart"][$sessionKey]["item_quantity"] +1 ;

            }
            if($stokcount == $toplamadet) {

                $_SESSION["shopping_cart"][$sessionKey]["item_quantity"];
            }

        }
    }


    die(json_encode(array()));

}
?>