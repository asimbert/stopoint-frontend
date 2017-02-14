<?php
//require_once 'printheader.php';
include "header.php";
  //$er=0;
  
 
  
  //STP46837733000
  //echo "select * from `order` where TrackingCode='".$_REQUEST['track']."'";
 
  $in2=mysql_query("select * from `order` where TrackingCode='".$_REQUEST['track']."'");
  
  
	//$in2=mysql_query("select * from finalorder where tid='STP46837733000'");
	$num_rows = mysql_num_rows($in2);
	
	if ($num_rows==0){
		
		 echo '<script type="text/javascript">';
        echo "window.location.href='https://www.stopoint.com'";
        echo '</script>';
	}
        $row2=  mysql_fetch_array($in2);
?>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>

<div id="content">
        
        	<div id="category-breadcrumb">
        		<div class="container">
					<ul class="breadcrumb">
						<!--<li><a href="index.php">Home</a></li>
						<li class="active">Packing Slip</li>-->
                        <li><?php echo $_REQUEST['track'];?></li>
                       <li><a href="pdffile?id=<?php echo $_REQUEST['track'];?>" title="PDF [new window]" target="_blank">Generate PDF</a></li>
					</ul>
        		</div>
        	</div>
        	<div id="print" class="container">
        		<div class="row">
        			<div class="col-md-14">
                     <header class="content-title">
                                <div class="title-bg">
                                    <h2 class="title" id="carrier">Stopoint Packing Slip</h2>
                                    <p class="title-desc">Place this slip inside the box with your device.</p>
                                </div><!-- End .title-bg -->
                             
                            </header>
                            
                            <?php 
							
							$bcode = $_REQUEST['track'];
							//$bcode = str_replace("STP","",$bcode);
							?>
                   
        	<div class="row">
 <!-- <div class="col-sm-8"><img class="imgLogo" src="images/logo.png" alt="Stopoint Commerce Template" width="238" height="76"></div>-->

  <div class="col-sm-4"> <div class="row" style="margin-left:50px;">
      
      <div class="span3"></div>
    </div></div>
</div>


<div class="row">
        <div class="col-xs-12 col-sm-6 col-lg-8"><h2>Packing slip</h2><h3>Place this slip inside the box with your device.</h3>
        
        
        
        
        <div class="row">
        <div class="col-xs-6 col-md-4"><b>ITEM</b></div>
        <div class="col-xs-6 col-md-4"></div>
        <div class="col-xs-6 col-md-4"><b>OFFER</b></div>
      </div>


<div class="row">
        
         <?php
                $inn=mysql_query("select * from `product` where id=".$row2['ProductId']);
                $rownn=  mysql_fetch_array($inn);
                ?>
                
        
        
        <div class="col-xs-6 col-md-4"><h4><?php echo $rownn['Description'];?></h4></div>
        <div class="col-xs-6 col-md-4"> 
        </div>
        <div class="col-xs-6 col-md-4"><h4>$ <?php echo $row2['OrderAmount'];?></h4>
       
         <?php 
	  $add_days = 30;
	  $my_date = date('m/d/y',strtotime($row2['OrderDate']));
	  
	  
	  $my_date = date('Y-m-d',strtotime($my_date.' +'.$add_days.' days'));
	  
	  
	  //$my_date = date("+".$days." days",strtotime($my_date));
	   
	  
	  ?>
        </div>
         <div class="col-xs-6 col-md-12" style="height:10px; border-bottom:2px dashed #000; margin-bottom:5px;"></div>
         <br />
         
         <div class="col-xs-6 col-md-4"></div>
          <div class="col-xs-6 col-md-4" style="text-align:right;"><h4>Total Offer:</h4></div>
           <div class="col-xs-6 col-md-4"><h4>$ <?php echo $row2['OrderAmount'];?></h4></div>
      </div>
        </div>
        
        <div class="col-xs-6 col-lg-4"><div class="InstructionBox">
        
        <h4><i class="fa fa-exclamation-triangle" style="padding:10px;"></i>Disable all location services on device if applicable before sending it to us.</h4>
        </div></div>
        
        <br />
      

        
        <div class="row">
        <h4><i class="fa fa-calendar" style="padding:10px;"></i> You have until <?php echo $my_date;?> to ship your device.</h4>
        
        <h5>
        If you send your device after the expiration date we cannot honor your initial
offer.</h5>

<h5>We will not accept devices that have been reported lost or stolen.
        </h5>
        </div>
      </div>


  
           	<div class="row" style="margin-top:200px !important; margin-bottom:35px !important;">
  <div class="col-sm-12"><div class="col-xs-6 col-md-12"><img src="http://stopoint.com/image?filetype=JPEG&dpi=72&scale=1&rotation=0&font_family=Arial.ttf&font_size=8&text=<?php echo $bcode;?>&thickness=60&code=BCGcode11" width="222" height="60" /></div></div>

</div>
<div class="row" style="margin-top:10px;">
        <div class="col-md-4">
		<h4><i class="fa fa-check-square-o"  style="margin-right:3px;"></i>Unlock your device</h4>
Make sure you have turned off
any password protection from
your device so we can test it.
Leaving it locked could delay
payment.
		</div>
        <div class="col-md-4"><h4><i class="fa fa-check-square-o" style="margin-right:3px;"></i>Save your data</h4>
Save your photos and files. If
your device has an SD card, don't
forget to remove it. We will erase
all the information from your
device.</div>
        <div class="col-md-4"><h4><i class="fa fa-check-square-o" style="margin-right:3px;"></i>Turn off device tracking</h4>
Leaving this on will lock your
device and delay or reduce your
payment.</div>
      </div>
      
      
<div class="row" style="margin-top:20px !important; margin-bottom:200px !important;">
        <div class="col-md-4">
		<h4><i class="fa fa-check-square-o"  style="margin-right:3px;"></i>Send just your device</h4>
Please do not send in any extra
items that you did not submit
online. We cannot pay you for
additional items.
		</div>
        <div class="col-md-4"><h4><i class="fa fa-check-square-o" style="margin-right:3px;"></i>Deactivate your service</h4>
It's very important that you
contact your carrier to terminate
service on the device and pay any
remaining balance on your bill.</div>
        <div class="col-md-4"></div>
</div> 
             <div id="printable"> 
 <img src="shippinglabels/<?php echo str_replace("STP","STP",$_REQUEST['track']); ?>.png" class="labelImage" width="400" height="350" />
 </div>
</div>
</div>
</div>
</div>
           
<?php
include "footer.php";
?>
        		
     