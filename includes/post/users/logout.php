<?php
session_start();
ob_start();
unset($_SESSION['user_email_address']);
header('Location:index.html');