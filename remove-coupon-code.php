<?php
session_start();
ob_start();

$coupon_code = $_REQUEST['coupon_code'];
$model = $_REQUEST['model'];
$condition = $_REQUEST['condition'];
$index = $_REQUEST['index'];


unset($_SESSION['coupon_code']);
unset($_SESSION['coupon_code_index']);
unset($_SESSION['coupon_code_condition']);

?>