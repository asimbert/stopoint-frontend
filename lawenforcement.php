<?php
include "header.php";

$query =  "SELECT * from sitepages WHERE Id = 5";
$relaw = mysql_query($query);
$welaw = mysql_fetch_row($relaw);
?>
<!-- slider -->
<div class="container">
    <div class="row text-center">
    	<h1 class="sub-heading" style="  color: #44b749;">Law Enforcement</h1>
    </div><!-- row --> 
    <div class="band col-lg-12"style="font-size:16px; font-family: calibri; color: #454645;">
	<?=$welaw[2]?>
	</div>
</div><!-- end container --> 
<!-- end slider -->
<br>
<?php
include "footer.php";
?>