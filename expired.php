<?php
	require("inc/config.php");
$vasexpired = "SELECT * FROM `order`";
$reexpired=mysql_query($vasexpired);
while($weexpired=mysql_fetch_array($reexpired)){

$today =  date("D M j G:i:s T Y");
$subdate= $weexpired['OrderDate'];
 $days = strtotime($today) - strtotime($subdate);
$days = floor($days/(60*60*24));
 
if($days >=30 && ($weexpired['OrderStatus'] == 1)){
	
	
	$rowsexpired = mysql_query("UPDATE `order` SET `OrderStatus` = 8 WHERE id=".$weexpired['id']) or die(mysql_error());
	
	}
	
}