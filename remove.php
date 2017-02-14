<?php
require("inc/config.php");
unset($_SESSION['checkout']);
unset($_SESSION['model']);
unset($_SESSION['price']);
unset($_SESSION['condition']);
unset($_SESSION['computer']);
header('Location: '.$base_url.'/');
?>