<?php
session_start();
unset($_SESSION['dil']);

header("Location: pages.php?sayfa=diller");
exit;
?>