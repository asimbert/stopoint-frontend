<?php
require("inc/config.php");

$location_id = $_POST["location_id"];
$pieces = explode(".", $location_id);
$locationType = $_POST["location_type"];
$types = array('country', 'State', 'City');
$sql = "select * from location where location_type=" . $locationType . " and parent_id = '" . $pieces[0] . "'";
$result = mysql_query($sql);
if ($result) {
    while ($row = mysql_fetch_object($result)) {
        $obj[] = $row;
    }
}
if($types[$locationType] == 'State'){
?>
<option value="">Select State</option>
<?php
foreach ($obj as $value) {
?>
<option 
     <?php
	 if($pieces[0] == $value->location_id){
	 ?>
     selected="selected" 
     <?php
	 }
	 ?>
     value="<?=$value->location_id.'.'.$value->name?>"><?=$value->name?></option>       
<?php
}
}
if($types[$locationType] == 'City'){
?>
<option value="">Select City</option>
<?php
foreach ($obj as $value) {
?>
<option 
     <?php
	 if($pieces[0] == $value->location_id){
	 ?>
     selected="selected" 
     <?php
	 }
	 ?>
     value="<?=$value->location_id.'.'.$value->name?>"><?=$value->name?></option>       
<?php
}
}
?>