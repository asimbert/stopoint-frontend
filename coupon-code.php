<?php
include "header.php";
?>

<!-- slider -->
<div class="container">
    <div class="row text-center">
    	<h1 class="sub-heading" style="  color: #44b749;">Coupon Code</h1>
    </div><!-- row --> 
   
	
	
  
  


<table align="center">
  <thead>
    <tr>
      <th width="30%">Coupon Code</th>
      <th>Description</th>
      <th width="30%">Expiration Date</th>
      
    </tr>
  </thead>
  <tbody>
  
  <?php
mysql_connect("localhost","stopoint_usr432","axvRN~NATFnB");
mysql_select_db("stopoint_db1");
$query = mysql_query("SELECT * FROM coupon_code ");
while($rows = mysql_fetch_array($query))
{

      $copon_code = $rows['copon_code'];
      $Description = $rows['Description'];
      $Expiration_date = $rows['Expiration_date'];
      
       

?>
    <tr>
      <td data-label="Coupon Code"><?php  echo $copon_code; ?></td>
      <td data-label="Description"><?php echo $Description;?></td>
      <td data-label="Expiration Date"><?php echo $Expiration_date;?></td>
    
    </tr>
     <?php }?>
  </tbody>
</table>






		

</div><!-- end container --> 
<!-- end slider -->
<br>
<?php
include "footer.php";
?>
<style>
  table {
    border: 1px solid #ccc;
    width: 100%;
   
    padding:0;
    border-collapse: collapse;
    border-spacing: 0;
	
	
  }

  table tr {
    border: 1px solid #ddd;
    padding: 5px;
  }

  table th, table td {
    padding: 12px;
    text-align: left;
  }

  table th {
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 1px;
  }

  @media screen and (max-width: 600px) {

    table {
      border: 0;
    }

    table thead {
      display: none;
    }

    table tr {
      margin-bottom: 10px;
      display: block;
      border-bottom: 2px solid #ddd;
    }

    table td {
      display: block;
      text-align: right;
      font-size: 13px;
      border-bottom: 1px dotted #ccc;
    }

    table td:last-child {
      border-bottom: 0;
    }

    table td:before {
      content: attr(data-label);
      float: left;
      text-transform: uppercase;
      font-weight: bold;
    }
  }
</style>
