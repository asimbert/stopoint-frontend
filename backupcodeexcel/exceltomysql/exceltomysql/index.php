<?php
ini_set("display_errors",0);
require_once 'excel_reader2.php';
require_once 'db.php';
if(isset($_POST['submit'])){
	$uploaddir = 'folder/';
$uploadfile = $uploaddir . basename($_FILES['excel']['name']);


if (move_uploaded_file($_FILES['excel']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";


$data = new Spreadsheet_Excel_Reader($uploadfile);

echo "Total Sheets in this xls file: ".count($data->sheets)."<br /><br />";

$html="<table border='1'>";
for($i=0;$i<count($data->sheets);$i++) // Loop to get all sheets in a file.
{	
	if(count($data->sheets[$i][cells])>0) // checking sheet not empty
	{
		echo "Sheet $i:<br /><br />Total rows in sheet $i  ".count($data->sheets[$i][cells])."<br />";
		
		for($j=3;$j<=count($data->sheets[$i][cells]);$j++) // loop used to get each row of the sheet
		{ 
			$html.="<tr>";
			for($k=1;$k<=count($data->sheets[$i][cells][$j]);$k++) // This loop is created to get data in a table format.
			{
				$html.="<td>";
				$html.=$data->sheets[$i][cells][$j][$k];
				$html.="</td>";
			}
			$data->sheets[$i][cells][$j][1];
			$ProductCode = $eid = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][1]);
			$Category = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][2]);
			$Brand = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][3]);
			
			$Carrier = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][4]);
			
			$Family = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][5]);
			$ProductModel = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][6]);
			$GoodPrice = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][7]);
			$FlawlessPrice = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][8]);
			$AdjustedPrice = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][9]);
			
			$Generation = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][10]);
			$StorageCapacity = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][11]);
			$CPU = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][12]);
			$ScreenSize = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][13]);
			$RAM = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][14]);
			$Band = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][15]);
			
			$Description = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][16]);
			$SubFamily = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][17]);
			
			
			
			 $query = "insert into products(ProductCode,Category,Brand,Carrier,Family,ProductModel,GoodPrice,FlawlessPrice,AdjustedPrice,Generation,StorageCapacity,CPU,ScreenSize,RAM,Band,Description,SubFamily) values('".$ProductCode."','".$Category."','".$Brand."','".$Carrier."','".$Family."','".$ProductModel."','".$GoodPrice."','".$FlawlessPrice."','".$AdjustedPrice."','".$Generation."','".$StorageCapacity."','".$CPU."','".$ScreenSize."','".$RAM."','".$Band."','".$Description."','".$SubFamily."')";
			
			mysqli_query($connection,$query);
			$html.="</tr>";
		}
	}
	
}

$html.="</table>";
//echo $html;
echo "<br />Data Inserted in dababase";



} else {
    echo "Possible file upload attack!\n";
}

echo 'Here is some more debugging info:';




}
?>

<form action="" method="post" name="excel" enctype="multipart/form-data">
<input type="file" name="excel" id="excel" />
<input type="submit" name="submit" id="submit" />
</form>
