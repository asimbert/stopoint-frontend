<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(dirname(__FILE__) . '/stopointsxgdlj123/inc/core.php');

require_once(dirname(__FILE__) . '/stopointsxgdlj123/classes/class.table_form.php');

$coupon_code = $_REQUEST['coupon_code'];
$model = $_REQUEST['model'];
$condition = $_REQUEST['condition'];
$index = $_REQUEST['index'];
$cond_column = "";

if($condition === "good"){
	$cond_column = "GoodPrice";
}else if($condition === "Flawless"){
	$cond_column = "FlawessPrice";
}else if($condition === "brokenyes"){
	$cond_column = "brokenyes";
}else if($condition === "brokenno"){
	$cond_column = "brokenno";
}else if($condition === "acceptable"){
	$cond_column = "AcceptablePrice";
}

$coupon=mysql_query("select * from Coupon WHERE CouponCode='$coupon_code' AND status=1") or die(mysql_error());

$status = "";
$message = "";
$amount = "";
$response = "";
$length = mysql_num_rows($coupon);
if($length == 0){
	$status = "INVALID";	
}

if($c=mysql_fetch_array($coupon))
{
	$Coupdis = $c['Coupdis'];
	$coupon_value = $c['Coupdis_value'];
	$CoupType = $c['CoupType'];
	$valid_frm = $c['valid_frm'];
	$valid_to = $c['valid_to'];
	$category_txt = $c['cat_txt'];
	$brand_txt = $c['brand_txt'];
	$family_txt = $c['family_txt'];
	
	if($CoupType === "fixtime"){
		$currentDate = date('m/d/Y');
		$currentDate=date('m/d/Y', strtotime($currentDate));
		$startDate = date('m/d/Y', strtotime($valid_frm));
		$endDate = date('m/d/Y', strtotime($valid_to));

		if (($currentDate >= $startDate) && ($currentDate <= $endDate)){
		  $status = "VALID";
		}else{
		  $status = "INVALID";
		}
	}else{
		$status = "VALID";
	}
	
	if($status === "VALID"){
		
		$p=mysql_fetch_array(mysql_query("SELECT productfamily.Name from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.id=$model"));
		$family_name = $p['Name'];
		
		$family_found = strpos($family_txt, $family_name . "{|}");
		
		if($family_found === false) {
			$status = "INVALID";
		}else{
			if($Coupdis === "per"){
				echo "--"."select $cond_column from product WHERE id='$model'"."--";
				$p=mysql_fetch_array(mysql_query("select $cond_column from product WHERE id='$model'"));
				$actual_amount = $p[$cond_column];
				$amount = ($actual_amount*$coupon_value)/100;
			}else{
				$amount = $coupon_value;
			}		
			
			$_SESSION['coupon_code'] = $coupon_code;
			$_SESSION['coupon_code_index'] = $index;
			$_SESSION['coupon_code_condition'] = $condition;
			
			$message = "Coupon Code applied successfully. <a href=\"javascript:void()\" onclick=\"removeCouponCode('$coupon_code', '$index', '$condition')\">Click here</a> to remove Coupon Code.";
		}		
	}
	
}

if($status === "INVALID"){
	$message = "Coupon Code is either expired or invalid.";
		
	unset($_SESSION['coupon_code']);
	unset($_SESSION['coupon_code_index']);
	unset($_SESSION['coupon_code_condition']);
}
$response = ";".$status.";".$message.";".$amount;
echo $response;


?>