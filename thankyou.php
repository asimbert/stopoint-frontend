<?php
include "header.php";
if(!isset($_SESSION['login_username']) && !isset($_SESSION['model'])){
	header('Location: '.$base_url.'/');
}


 session_start();
 unset($_SESSION['model']);
 unset($_SESSION['checkout']);
 unset($_SESSION['carrier']);
 unset($_SESSION['phone']);
 unset($_SESSION['price']);
 unset($_SESSION['phoneno']);
 unset($_SESSION['id']); 
 unset($_SESSION['condition']);
 unset($_SESSION['address1']);
 unset($_SESSION['address2']);
 unset($_SESSION['city']);
 unset($_SESSION['specification']);
 unset($_SESSION['state']);
 unset($_SESSION['zip']);
 unset($_SESSION['phone']);
 unset($_SESSION['country']);
?>
<!-- slider -->

<!-- Google Code for leads Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 976913846;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "1vutCL75-mYQtovq0QM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/976913846/?label=1vutCL75-mYQtovq0QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<div class="container">
    <div class="row" style="margin-right:0px; margin-left:0px;">
    	<h1 class="sub-heading" style="  color: #44b749;">Thank You!</h1>
        
        <p class="title-desc">We'll send a confirmation email with tracking info, a packing slip, checklist and details about your sale. If you do not receive the confirmation message within a few minutes, please check your spam folder just in case. Email is sent to <b><?php echo $_SESSION['login_email'];?></b></p>
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="panel-title">Transaction Completed</div><!-- End .accordion-title -->
									<span class="pull-right clickable" style="margin-top:-20px;"><i class="glyphicon glyphicon-chevron-up"></i></span>
								</div><!-- End .accordion-header -->
								
								
								  <div class="panel-body">
								 
                                 <div class="row">
                                   <div style="margin: 0px auto;text-align: center;" class="row">
                                   <h4>What Happens Next?</h4>
                                   </div>
								   	
<div class="col-md-12">					  
	<div class="row">
    	<div style="margin: 0px auto;text-align: center;" class="col-md-4">
            <div style="width: 80px;display: inline-table">
                <img width="50" height="80" src="<?php echo $base_url; ?>/images/w1.png" alt="Icon"><br><br>
            </div>
            <div>
                <font style="font-size: 18px ;color:black"><b>1. Prep Your Phone</b></font><br>
                <p>▪ Remove passwords<br>
                    ▪ Deactivate your service<br>
                    ▪ Save your data</p>
            </div>
        </div>
        
        <div style="margin: 0px auto;text-align: center;" class="col-md-4"> 
            <div style="width: 80px;display: inline-table">
                <img src="<?php echo $base_url; ?>/images/w2.png" alt="Icon"><br><br>
            </div>&nbsp;&nbsp;
        	<div>
                <font style="font-size: 18px ;color:black"><b>2. Pack &amp; Send</b></font><br>
                <p>
                    ▪ Check email for pre-paid shipping label<br>
                    ▪ Carefully pack your device in a box<br>
                    ▪ Drop it off at your nearest Fedex post office<br>
                </p>
        	</div>
        </div>
        
        <div style="margin: 0px auto;text-align: center;" class="col-md-4">
            <div style="width: 80px;display: inline-table">
                <img src="<?php echo $base_url; ?>/images/w3.png" alt="Icon"><br><br>
            </div>&nbsp;&nbsp;
            <div>
                <font style="font-size: 18px ;color:black"><b>3. Get Paid</b></font><br>
                <p>Once we receive an item it typically takes about 3 days for your check to arrive.</p>
            </div>
        </div>
     </div>
                                        
										
								   	</div><!-- End .col-md-6 -->
								   	
								   </div>
                              		

                                   <div class="row">
        <div style="margin: 0px auto;text-align: center;" class="col-md-4"> <div>
            <font style="font-size: 18px ;color:black"><b>▸ Remove Passwords</b></font><br>
            <p>Make sure you have turned off any password protection on your device so we can test it. Leaving it locked could delay payment</p>
        </div></div>
        <div style="margin: 0px auto;text-align: center;" class="col-md-4"> <div>
            <font style="font-size: 18px ;color:black"><b>▸ Deactivate your service</b></font><br>
            <p>It is very important that you contact your carrier to terminate service to this phone, and pay any remaining balance.</p>
        </div></div>
        <div style="margin: 0px auto;text-align: center;" class="col-md-4"><div>
            <font style="font-size: 18px ;color:black"><b>▸ Save your data</b></font><br>
            <p>Save your photos and files. If your device has an SD card, don't forget to remove it. We will erase all the information from your device.</p>
        </div></div>
      </div>
								   </div><!-- End.row -->
								</div><!-- End .panel-collapse -->    
    </div><!-- row --> 
    
</div><!-- end container --> 
<!-- end slider -->
<br>
<?php
include "footer.php";
?>