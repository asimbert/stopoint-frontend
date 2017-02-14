<? include("inc/config.php"); 

	/*for($i=0;$i<30;$i++)
	{
		$sel=mysql_query("insert into test_user(email) value('retrodevelopers99@gmail.com') ");
	}*/
	
	$mail_url='http://stopoint.com/';
	$sel_mail=mysql_query("select * from test_user where IsNewsletter=1 limit 50");
	
	while($sel=mysql_fetch_array($sel_mail))
	{
	
		$mail_subject = "It's not too late!";
		$mail_to = $sel['email'];
		$mail_from = 'support@stopoint.com';
		$mail_body= '<table style="margin:0 auto" width="640" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr style="background:#fff;">
				<td align="left" width="50%;">
				   <a href="http://stopoint.com/" target="_blank"><img src="http://stopoint.com/images_mail/logo.jpg" alt="stopoint" /></a>
				</td>
				<td align="right" width="50%" style="text-align:right">
				  <p style="font-family:Open Sans; margin:5px 0;  font-size:18px; color:#333;" >Call us today <br/>
				  <span style="font-size:25px; font-weight:bold; color:#6ca527;">1 (888) 246-4919</span></p>
				</td>
   			</tr>
   			<tr>
       			<td colspan="2" background="http://stopoint.com/images_mail/header-bg.jpg" style="background-repeat:no-repeat" height="330" bgcolor="#797979" width="640" valign="top" class="100p">               		<div>
                    	<table width="640" border="0" cellspacing="0" cellpadding="20" class="100p">
                        	<tr>
                            	<td valign="top">
                                	<table border="0" cellspacing="0" cellpadding="0" width="600" class="100p">                                                    
                                    	<tr>
                                        	<td align="center" style="color:#FFFFFF; font-family:arial; text-transform:uppercase;  font-size:24px;">
                                            	<h2 style="font-size:22px; font-family:arial; margin:90px 0 0 0">Welcome to</h2>
                                                <h1 style="font-size:50px; font-family:arial;  font-weight:bold; line-height:40px; margin:5px 0;">stopoint</h1>
                                                <p style="font-size:15px; margin:0">BEST PLACE TO SELL YOUR USED CELL PHONES AND <br/>ELECTRONICS FOR THE MOST CASH</p>                                           	</td>
                                       	</tr>
                                        <tr>
                                        	<td height="35"></td>
                                      	</tr>
                                  	</table>
                           		</td>
                           	</tr>
                    	</table>
                   	</div>
                    <!--[if gte mso 9]>
                    </v:textbox>
                    </v:rect>
                    <![endif]-->
               	</td>
   			</tr>
   			<tr>
     		<td colspan="2" style="padding:30px 0;">
          		<h3 style="font-size:22px; margin:0; text-align:center; text-transform:uppercase; font-family:Open Sans; color:#454645;">How It Works</h3>
          		<h4 style="font-size:35px; margin:0; line-height:30px; text-align:center; text-transform:uppercase; font-family:Open Sans; font-weight:bold; color:#6ca527;">3 EASY STEPS</h4>
     		</td>
   		</tr>
   		<tr>
     		<td colspan="2" style="padding:20px 0;" valign="top">
        		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          			<tbody>
         				<tr>
              				<td width="33%" align="center">
                				<img src="http://stopoint.com/images_mail/pic1.jpg" alt="" /> 
                				<h2 style="font-size:17px; margin:0 0 10px 0; text-align:center; font-weight:bold; text-transform:uppercase; font-family:Open Sans; color:#333;">GET A FREE OFFER</h2>
                				<p style="font-size:13px; margin:0; text-align:center; font-family:Open Sans; color:#333;">Simply find your gadget and<br/> answer a few <br/>easy questions</p> 
              				</td>
              				<td width="33%" align="center" >         
                				<img src="http://stopoint.com/images_mail/pic2.jpg" alt="" />  
                				<h2 style="font-size:17px; margin:0 0 10px 0; text-align:center; font-weight:bold; text-transform:uppercase; font-family:Open Sans; color:#333;">SHIP IT TO STOPOINT</h2>
                 				<p style="font-size:13px; margin:0; text-align:center; font-family:Open Sans; color:#333;">Print out your pre-paid<br/>shipping label, pack your device <br/>and drop it at any Fedex Store.</p>
              				</td>
              				<td width="33%" align="center">
                				<img src="http://stopoint.com/images_mail/pic3.jpg" alt="" />  
                					<h2 style="font-size:17px; margin:0 0 10px 0; text-align:center; font-weight:bold; text-transform:uppercase; font-family:Open Sans; color:#333;">GET PAID FAST</h2>
                	 				<p style="font-size:13px; margin:0; text-align:center; font-family:Open Sans; color:#333;">Get paid via PayPal within 24 <br/>hours, or receive a check on<br/> your mailbox in 3 days.</p>
              				</td>
            			</tr>
          			</tbody>
        		</table>
		     </td>
   		</tr>
   		<tr>
       		<td colspan="2" align="center" style="padding:10px 0;" valign="top">
           		<a style="font-size:17px; text-transform:uppercase; text-align:center; padding:10px 35px; font-family:Open Sans; border-radius:8px; background:#84bc41; text-decoration:none; color:#fff; display:inline-block" target="_blank" href="https://www.stopoint.com/sell-now">Sell Now</a>
         	</td>
     	</tr>
     	<tr>
         <td colspan="2" align="center" style="padding:30px 0;" valign="top"></td>
      	</tr>
     	<tr style="background:#84bc41;">
        	<td colspan="2" align="center" style="padding:10px 0;" valign="top">
            <img style="float:right; position:relative; margin:-50px 20px 0 0" src="http://stopoint.com/images_mail/ipnone-set.png" alt="" />
            <h3 style="font-size:30px; margin:45px 0 0 30px; text-align:left; font-weight:bold; font-family:Open Sans; color:#fff;">Sell Your Gadgets</h3>
            <h4 style="font-size:25px; margin:5px 0 0 30px; font-style:italic; line-height:30px; text-align:left;font-family:Open Sans; font-weight:bold; color:#131313;">iPhone - iPad- iPod <br/> Macbook-Apple Watch</h4>          
         </td>
     	</tr>
       	<tr style="background:#454645;">
        	<td colspan="2" align="center" style="padding:10px 0;" valign="top">
           		<p style="margin:0; color:#fff;font-family:Open Sans; font-size:15px;"> 
             	<img style="vertical-align:middle; margin:0px 15px 0 0" src="http://stopoint.com/images_mail/shipping.png" alt="" />Free Shipping &nbsp;
             	<img style="vertical-align:middle; margin:0px 15px 0 0" src="http://stopoint.com/images_mail/quote.png" alt="" />30 Day Lock in Price  &nbsp;
             	<img style="vertical-align:middle; margin:0px 15px 0 0" src="http://stopoint.com/images_mail/quote.png" alt="" />Get Paid in 24 Hrs          
           		</p>
          	</td>
     	</tr>
   		<tr>
     		<td colspan="2" style="padding:30px 0;">
          		<h4 style="font-size:25px; margin:0; line-height:30px; text-align:center; text-transform:uppercase; font-family:Open Sans; font-weight:bold; color:#6ca527;">Sell your Gadgets for cash</h4>
          	<h3 style="font-size:20px; margin:0; text-align:center; font-family:Open Sans; color:#454645;">It takes just a few minutes to sell your Gadgets.</h3>
     		</td>
   		</tr>
   		<tr>
     		<td colspan="2" style="padding:10px 0;">
     			<div style="border:2px solid #ccc; width:49%; float:left;" >
         			<a href="https://www.stopoint.com/sell/watch/Apple-Watch" target="_blank"><img src="http://stopoint.com/images_mail/apple-watch.jpg" alt="iphone" /></a>
         			<a  href="https://www.stopoint.com/sell/watch/Apple-Watch" target="_blank" style="text-decoration:none"><h4 style="font-size:25px; margin:0; padding:10px 0; line-height:30px; text-align:center; background:#454645; font-style:italic; font-family:Open Sans; font-weight:bold; color:#fff;">Apple Watch</h4></a>
       			</div>
       			<div style="border:2px solid #ccc; width:49%;  float:right;" >
        			<a href="https://www.stopoint.com/sell/cell-phone/iphone" target="_blank"> <img src="http://stopoint.com/images_mail/iphone.jpg" alt="iphone" /></a>
         			<a style="text-decoration:none" href="https://www.stopoint.com/sell/cell-phone/iphone" target="_blank"><h4 style="font-size:25px; margin:0; padding:10px 0; line-height:30px; text-align:center; background:#454645; font-style:italic; font-family:Open Sans; font-weight:bold; color:#fff;">iPhone</h4></a>
       			</div>
     			<p style="font-style:italic; font-size:14px; color:#333; font-family:arial; clear:both; display:inline-block; margin:10px 0; text-align:center;">Note : As part of our trading process with our customers, we make it clear that we do not accept lost or stolen items.</p>
     		</td>
   		</tr>
   		<tr style="background:#454645;">
     		<td colspan="2" style="padding:20px 0; font-family:Open Sans; text-align:center;">
        		<p style="font-size:16px; color:#fff; margin:0 0 5px 0; text-align:center">Call us today</p>
        		<span style="font-size:35px;color:#fff; font-family:arial; margin:10px 0; font-weight:bold; text-align:center">1 (888) 246-4919</span>
        		<p style="font-size:14px; line-height:25px; color:#fff; font-style:italic; margin:0 0 5px 0; text-align:center">Stopoint HQ , 12795 NE 10th Avenue <br/> Miami, Florida 33161<br/>support@stopoint.com</p>
        		<p>
         			<a href="https://www.facebook.com/stopointtrade" target="_blank"><img src="http://stopoint.com/images_mail/fb.jpg" alt="facebook" /></a>
          			<a href="https://twitter.com/stopointtrade" target="_blank"><img src="http://stopoint.com/images_mail/tw.jpg" alt="twitter" /></a>
           			<a href="https://www.stopoint.com/contact" target="_blank"><img src="http://stopoint.com/images_mail/gp.jpg" alt="google plus" /></a>
        		</p>  
        		<p >
        			<a  style="color:#FFFFFF" href="https://www.stopoint.com/about" target="_blank">About Us</a> |
          			<a  style="color:#FFFFFF" href="https://www.stopoint.com/legal" target="_blank">Legal</a> |
           			<a  style="color:#FFFFFF" href="https://www.stopoint.com/contact" target="_blank">Contact Us</a> |
           			<a  style="color:#FFFFFF" href="https://www.stopoint.com/unsubscribe?id='.$id.'" target="_blank">Unsubscribe</a>
        		</p>   
        		<p style="color:#FFFFFF;font-size:12px">
        			© Copyright 2016 - Stopoint, Inc., All Rights Reserved, Patents Pending. Stopoint is not affiliated with the manufacturers of the items available for trade-in.
        		</p>
     		</td>
    	</tr> 
	</table>';
		
		
			require_once 'PHPMailer-master/PHPMailerAutoload.php';
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->IsHTML(true);
			$mail->CharSet = "text/html; charset=UTF-8;";
			$mail->SMTPAuth = true;
			$mail->SMTPDebug = 0;
			$mail->SMTPSecure = 'ssl';
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465; 
			$mail->Username = "stopoint@stopoint.com";  
			$mail->Password = EMAIL_CREDENTIAL;
			$mail->From = $email_from;
			$mail->FromName = "STOPOINT ";
			$mail->AddAddress($mail_to);
			$mail->Subject = $mail_subject;
			$mail->Body = $mail_body;
			
			$sent = $mail->Send();
	}
	
	
?>