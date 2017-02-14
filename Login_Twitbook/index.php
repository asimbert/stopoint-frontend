<?php
require 'src/facebook.php';
session_start();  
$facebook = new Facebook(array(
  'appId'  => '879206578783308',
  'secret' => '99f0d4b5d574690c378b18eda71722dc',
  'cookie' => true,
));
 
//2. retrieving session
//$session = $facebook->getSession();
 
//3. requesting 'me' to API
$me = null;
if ($session) {
  try {
    $uid = $facebook->getUser();
    $me = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
  }
}
 
//4. login or logout
if ($me) {
    $logoutUrl = $facebook->getLogoutUrl();
} else {
    $loginUrl = $facebook->getLoginUrl(array(
      'next'=>'http://stopoint.com/Login_Twitbook/index.php'
   ));
}
 
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>php-sdk</title>
  </head>
  <body>
    <?php if ($me): ?>
    <?php echo "Welcome, ".$me['first_name']. ".<br />"; ?>
    <a href="<?php echo $logoutUrl; ?>">
      <img src="http://static.ak.fbcdn.net/rsrc.php/z2Y31/hash/cxrz4k7j.gif">
    </a>
    <?php else: ?>
      <a href="<?php echo $loginUrl; ?>">
        <img src="http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif">
      </a>
    <?php endif ?>
  </body>
</html>