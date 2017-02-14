<?php
session_start();
ob_start();

require_once(dirname(__FILE__) . '/stopointsxgdlj123/inc/core.php');

require_once(dirname(__FILE__) . '/stopointsxgdlj123/classes/class.table_form.php');

e_reporting(); // error reporting ALL

$rowsordertest = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
CASE order.OrderStatus
WHEN '9' THEN 'Return Completed'
WHEN '8' THEN 'Expired' 
WHEN '7' THEN 'Cancelled' 
WHEN '6' THEN 'Paid'
WHEN '5' THEN 'Released Payment'
WHEN '4' THEN 'Returned'
WHEN '3' THEN 'Adjusted Price'
WHEN '2' THEN 'Received'
WHEN '1' THEN 'Pending'
ELSE 'Pending'
END as OrderStatus
FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " ORDER BY order.OrderDate desc");
// loop over the rows, outputting them
while ($rowordertest = mysql_fetch_assoc($rowsordertest)) {
	$testimonial_query = mysql_query('select OrderId from testimonial where OrderId="' . $rowordertest['OrderId'] . '"');
									
	$numrowstest = mysql_num_rows($testimonial_query);
   
	if ($numrowstest == '0') {
		if ($rowordertest['OrderStatus'] == 'Paid') {
			$id = $rowordertest['OrderId'];
			$pquery = "SELECT * FROM `order` WHERE id = '" . $id . "'";
			$rpquery = mysql_query($pquery);
			$wpquery = mysql_fetch_assoc($rpquery);

			$uquery = "SELECT * FROM `user` WHERE id = '" . $wpquery['UserId'] . "'";
			$ruquery = mysql_query($uquery);
			$wuquery = mysql_fetch_assoc($ruquery);

			$contents = "TEST";
			$rating = "5.0";

			 $query = 'INSERT INTO testimonial SET UserId = ' . $_SESSION['login_id'] . ', OrderId = ' . $id . ', ProductId = "' . $wpquery['ProductId'] . '", UserName = "' . $wuquery['FirstName'] . ' ' . $wuquery['LastName'] . '", UserCity = "' . $wuquery['S_City'] . '", UserState = "' . $wuquery['S_State'] . '", Contents = "' . $contents . '", Rate = "' . $rating . '", ShowOnHomePage = 0';
			$result = mysql_query($query) or die(mysql_error());
			$id = mysql_insert_id();
		}
	}
}	


?>