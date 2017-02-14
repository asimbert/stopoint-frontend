<?php
include "header.php";
include_once("signtwitter/config.php");
$upd=mysql_query("update user set IsNewsletter=0 where id='".$_GET['id']."'");
$user=mysql_fetch_array(mysql_query("select * from user where id='".$_GET['id']."'"));

mysql_query("UPDATE tp_review_email_reminder SET status = 0 WHERE user_id=" . $_GET['id']);

?>
<div class="container">
	<div class="row text-center">
	<h1 class="sub-heading">YOU WILL BE MISSED</h1>
	</div>
				
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<?php
if($upd)
{ ?>
<p>YOU HAVE SUCCESSFULLY UNSUBSCRIBED FROM STOPOINT.COM NEWSLETTER. </p>
<?php
}
else
{ ?>
<p>WE WERE UNABLE TO UNSUBSCRIBE YOU FROM THE EMAIL USED.</p><?php
}

?><br><br>
</div>
</div>
<?php
include "footer.php";
if($upd)
{
include_once( 'inc/MCAPI.class.php' );
$api = new MCAPI('1a2e8827797f0ed884437648f8b2ecae-us11');
$retval = $api->listUnsubscribe("5c3f2522ee",$user['EmailAddress']);
}
?>