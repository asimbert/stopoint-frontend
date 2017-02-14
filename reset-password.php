<?php
include "header.php";

require("inc/config.php");
require_once 'inc/Bcrypt.php';

if (isset($_POST['resetpassword']) && isset($_POST['key']) && isset($_POST['id'])) {
	
	$email = base64_decode($_POST['id']);
	$key = $_POST['key'];
	$id = $_POST['id'];
	
	$query =  "SELECT * from user WHERE EmailAddress = '".$email."' AND UserType = 'User' AND SecretKey = '" . $key . "'";

	$resultSet = mysql_query($query);

	$weresultSet = mysql_fetch_assoc($resultSet);

	if(mysql_num_rows($resultSet) > 0){
		$newPassword = $_POST['NewPassword'];
		$hashedNewPassword = Bcrypt::hashPassword($newPassword);
		if (!Bcrypt::checkPassword($_POST['NewConfirmPassword'], $hashedNewPassword)) {
			header('Location: '.$base_url.'/reset-password.php?err_msg=reset_password&step2&password_mismatch&id='.$id.'&key='.$key);
			
		}else {
			mysql_query("UPDATE user SET `PasswordTmp` = '" . $hashedNewPassword . "' WHERE EmailAddress='" . $email . "'") or die(mysql_error());
			
			header('Location: '.$base_url.'/login-test.php?err_msg=reset_password_success');
		}
	}else{
		header('Location: '.$base_url.'/login-test.php?err_msg=reset_password_failed&step2');
	}
}else if (isset($_GET['err_msg']) && $_GET['err_msg'] === "reset_password" && isset($_GET['key']) && isset($_GET['id'])) {
	$email = base64_decode($_GET['id']);
	$key = $_GET['key'];
	$id = $_GET['id'];
	
	$query =  "SELECT * from user WHERE EmailAddress = '".$email."' AND UserType = 'User' AND SecretKey = '" . $key . "'";

	$resultSet = mysql_query($query);

	$weresultSet = mysql_fetch_assoc($resultSet);

	if(mysql_num_rows($resultSet) > 0){
?>
<div class="container">
<br>
<h2>Reset your password</h2>
<br>
<br>
	<div class="row pad">
		<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
			<form role="form" name="resetform" method="post" action="reset-password.php">	
				<input type="hidden" name="key" value="<?php echo "$key"; ?>" />
				<input type="hidden" name="id" value="<?php echo "$id"; ?>" />
				
				<div class="form-group">
					<label class="pass"  for="NewPassword"><img src="<?php echo $base_url; ?>/images/f-icon3.png" alt="Icon"/>New Password *</label>
					<input type="password" name="NewPassword" class="form-control form-c" id="NewPassword" required>
				</div>
				<div class="form-group">
					<label class="pass"  for="NewConfirmPassword"><img src="<?php echo $base_url; ?>/images/f-icon3.png" alt="Icon"/>Confirm Password *</label>
					<input type="password" name="NewConfirmPassword" class="form-control form-c" id="NewConfirmPassword" required>
				</div>

				<input type="submit" name="resetpassword" class="submit-btn" style="margin-top: 30px;" />
			</form>
		</div>
	</div>
		
</div>		
<?php
	}
	else{
		header('Location: '.$base_url.'/login-test.php?err_msg=reset_password_failed');
	}

}

?>