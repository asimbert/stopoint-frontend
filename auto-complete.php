<?php
//require('constant.php');
//require('database.php');
//require('database_old.php');

require("inc/config.php");


if (!isset($_GET['keyword'])) {
	die("");
}

$keyword = $_GET['keyword'];
//$data = serachForKeyword($keyword);



$stmt = ("(SELECT product.id as pid,product.FamilyId as FamilyId,product.Generation,product.OrderNumber as OrderNumber,product.StorageCapacity as StorageCapacity,product.ProductModel as ProductModel,product.Description as Description,product.Ram as Ram,productcategory.Name as pcname,productbrand.Name as pbname,productfamily.Name as pfname,productfamily.image_url as pfimage,carriers.Name as cname from product 
  LEFT JOIN `carriers` ON carriers.id=product.CarrierId 
  LEFT JOIN `productfamily` ON productfamily.Id=product.FamilyId 
  LEFT JOIN `productbrand` ON productbrand.id=product.BrandId 
  LEFT JOIN `productcategory` ON productcategory.id=product.CategoryId 
    WHERE (product.Description) LIKE '%".$keyword."%'

   OR (product.OrderNumber) LIKE '".$keyword."%'
  OR (productcategory.Name) LIKE '".$keyword."%'
   OR (productfamily.Name) LIKE '".$keyword."%'
    OR (carriers.Name) LIKE '".$keyword."%'
	OR (product.ProductModel) LIKE '".$keyword."%'
   OR (productbrand.Name) LIKE '%".$keyword."%'
  order by productfamily.Name)");
 // $row =mysql_fetch_assoc($stmt);
  $isQueryOk = mysql_query($stmt);
  
    
	$results = array();
while($row = mysql_fetch_array($isQueryOk)) {
    $results[] = $row;
}
echo json_encode($results, JSON_HEX_APOS);
   