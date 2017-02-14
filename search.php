<?php
include "header.php";

$search =$_POST['search'];

$explode = explode(" ", $search);

for($i=0; $i<= $explode.length; $i++){
	
//	$explode[$i] = ' +'.$explode[$i];
	
	}
	$arr_fruit=implode(" +",$explode);
	$searc = '+'.$arr_fruit;
	
	


 $query = "(SELECT product.id as pid,product.Generation,product.StorageCapacity as StorageCapacity,product.Description as Description,product.Ram as Ram,productcategory.Name as pcname,productbrand.Name as pbname,productfamily.Name as pfname,productfamily.image_url as pfimage,carriers.Name as cname from product 
  LEFT JOIN `carriers` ON carriers.id=product.CarrierId 
  LEFT JOIN `productfamily` ON productfamily.Id=product.FamilyId 
  LEFT JOIN `productbrand` ON productbrand.id=product.BrandId 
  LEFT JOIN `productcategory` ON productcategory.id=product.CategoryId 
    WHERE  MATCH (product.Description) AGAINST ('\"".$search."\"' IN BOOLEAN MODE)  
   OR (product.Description) LIKE '".$search."%'
  OR (productcategory.Name) LIKE '".$search."%'
  order by productfamily.Name)
  ";
$research = mysql_query($query); 
?>
<!-- slider --> 
<div class="container" style="margin-bottom:70px;">

<div class="row text-center">
<h1 class="sub-heading">Searches</h1>
</div><!-- row --> 
<br />
<br />
<!--<h2><? //$search?></h2>
--><?php
while ($wesearch = mysql_fetch_assoc($research)){
?>
<div class="col-lg-12">

<?php
if($wesearch['pcname'] == "Cell Phone"){
 ?>
 <div class="col-sm-1 col-lg-1 col-md-1" style="margin-top:20px;">
<img src="images/products/<?php echo $wesearch['pfimage']; ?>" width="70" height="58" alt="<?=$wesearch['Description']?>">
</div>
<div class="col-sm-10 col-lg-10 col-md-10" style="margin-top:10px;">
        <a href="cellphone?model=<?php echo $wesearch['pid']; ?>" style="text-decoration:none;"><h2 class="Sheading-style1 searchtext"><?=$wesearch['Description']?></h2></a>
        </div>
<?php }

else if($wesearch['pcname'] == "Computers"){
 ?>
 <div class="col-sm-1 col-lg-1 col-md-1" style="margin-top:20px;">

<img src="images/products/<?php echo $wesearch['pfimage']; ?>" width="70" height="58" alt="<?=$wesearch['Description']?>">
</div>
<div class="col-sm-11 col-lg-11 col-md-11" style="margin-top:10px;">
        <a href="computers?model=<?php echo $wesearch['pid']; ?>"><h2 class="Sheading-style1 searchtext"><?=$wesearch['Description']?></h2></a>
        </div>
<?php } 

else if($wesearch['pcname'] == "Tablets"){
 ?>
 <div class="col-sm-1 col-lg-1 col-md-1" style="margin-top:20px;">

<img src="images/products/<?php echo $wesearch['pfimage']; ?>" width="70" height="58" alt="<?=$wesearch['Description']?>">
</div>
<div class="col-sm-11 col-lg-11 col-md-11" style="margin-top:10px;">
        <a href="tablets?model=<?php echo $wesearch['pid']; ?>"><h2 class="Sheading-style1 searchtext"><?=$wesearch['Description']?></h2></a>
        </div>
<?php } 

else if($wesearch['pcname'] == "TV"){
 ?>
 <div class="col-sm-1 col-lg-1 col-md-1" style="margin-top:20px;">

<img src="images/products/<?php echo $wesearch['pfimage']; ?>" width="70" height="58" alt="<?=$wesearch['Description']?>">
</div>
<div class="col-sm-11 col-lg-11 col-md-11" style="margin-top:10px;">
        <a href="Tv?model=<?php echo $wesearch['pid']; ?>"><h2 class="Sheading-style1 searchtext"><?=$wesearch['Description']?></h2></a>
        </div>
<?php } 

else if($wesearch['pcname'] == "Watches"){
 ?>
 <div class="col-sm-1 col-lg-1 col-md-1" style="margin-top:20px;">

<img src="images/products/<?php echo $wesearch['pfimage']; ?>" width="70" height="58" alt="<?=$wesearch['Description']?>">
</div>
<div class="col-sm-11 col-lg-11 col-md-11" style="margin-top:10px;">
       <a href="watch?model=<?php echo $wesearch['pid']; ?>"><h2 class="Sheading-style1 searchtext"><?=$wesearch['Description']?></h2></a>
       </div>
<?php } 

else if($wesearch['pcname'] == "Gadgets"){
 ?>
 <div class="col-sm-1 col-lg-1 col-md-1" style="margin-top:20px;">

<img src="images/products/<?php echo $wesearch['pfimage']; ?>" width="70" height="58" alt="<?=$wesearch['Description']?>">
</div>
<div class="col-sm-11 col-lg-11 col-md-11" style="margin-top:10px;">
        <a href="gadgets?model=<?php echo $wesearch['pid']; ?>"><h2 class="Sheading-style1 searchtext"><?=$wesearch['Description']?></h2></a>
        </div>
<?php } ?>
        <!--<p>Generation: <? //$wesearch['Generation']?></p>
        <p>Storage Capacity: <? //$wesearch['StorageCapacity']?></p>
        <p>RAM: <? //$wesearch['Ram']?></p>
        <p>Category: <? //$wesearch['pcname']?></p>
        <p>Brand: <? //$wesearch['pbname']?></p>
        <p>Carrier: <? //$wesearch['cname']?></p>-->
</div>
<br />
<br />
<?php
}
$numrows = mysql_num_rows($research);
if($numrows == 0){
	?>
    <h2 class="Sheading-style1 searchtext">Records not found</h2>
    <?php
	}
?>

</div><!-- end container --> 
<!-- end slider -->
<?php
include "footer.php";
?>