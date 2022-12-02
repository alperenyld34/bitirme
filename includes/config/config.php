<?php
try {
    $db=new PDO("mysql:host=localhost;dbname=eticaret;charset=utf8",'root','');
    $rewurlbase="/";
}
catch (PDOExpception $e) {
    echo $e->getMessage();
}
?>
