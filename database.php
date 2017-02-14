<?php

// We will use PDO to execute database stuff. 
// This will return the connection to the database and set the parameter
// to tell PDO to raise errors when something bad happens
function getDbConnection() {
  $db = new PDO(DB_DRIVER.":dbname=".DB_DATABASE.";host=".DB_SERVER.";charset=utf8",DB_USER,DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
  return $db;
}

// This is the 'search' function that will return all possible rows starting with the keyword sent by the user
function serachForKeyword($keyword) {
  
    $db = getDbConnection();
    $stmt = $db->prepare("(SELECT product.id as pid,product.FamilyId as FamilyId,product.Generation,product.OrderNumber as OrderNumber,product.StorageCapacity as StorageCapacity,product.ProductModel as ProductModel,product.Description as Description,product.Ram as Ram,productcategory.Name as pcname,productbrand.Name as pbname,productfamily.Name as pfname,productfamily.image_url as pfimage,carriers.Name as cname from product 
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

    /*$keyword = $keyword.'%';*/
    $stmt->bindParam(1, $keyword, PDO::PARAM_STR, 100);

    $isQueryOk = $stmt->execute();
  
    
	$results = array();
/*if ($isQueryOk) {
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($result, $row['OrderNumber'].' '.$row['Description']);
      }
} else {
      trigger_error('Error executing statement.', E_USER_ERROR);
}*/
	
    if ($isQueryOk) {
      $results = $stmt->fetchAll(PDO::FETCH_NAMED);
    } else {
      
      trigger_error('Error executing statement.', E_USER_ERROR);
    }
   $db = null; 

    return $results;
}