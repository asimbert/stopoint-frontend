<?php
session_start();
ob_start();

require_once(dirname(__FILE__) . '/admin/inc/core.php');

require_once(dirname(__FILE__) . '/admin/classes/class.table_form.php');

e_reporting(); // error reporting ALL

$category_name = "Cell Phone";
$brand_name = "Apple";
$family_name = "iPhone 7";

$coupon_query = "SELECT * FROM `Coupon` WHERE cat_txt like '%".$category_name."{|}%' AND brand_txt like '%".$brand_name."{|}%' AND family_txt like '%ALL_PRODUCT{|}%' AND status = 1";

echo "$coupon_query <br>";
$coupon_result=mysql_query($coupon_query);
while($coupon_row=mysql_fetch_assoc($coupon_result)){
	$coupon_id = $coupon_row['id'];
	$family_txt = $coupon_row['family_txt'];
	$family_txt .= $family_name . "{|}";
	
	echo $coupon_id . "-" . $family_txt . "<br><br><br>";
	echo "UPDATE Coupon SET family_txt = '$family_txt' WHERE id=$coupon_id <br><br>";
	//Don't uncomment unless you what you are doing
	//mysql_query("UPDATE Coupon SET family_txt = '$family_txt' WHERE id=$coupon_id");
}

?>