<?php
ob_start();
//require 'dbconfig.php';
require 'functions.php';
session_start();
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '879206578783308','99f0d4b5d574690c378b18eda71722dc' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('http://stopoint.com/signfacebook/fbconfig.php' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
     	 $fuid = $graphObject->getProperty('id');              // To Get Facebook ID
 	     $ffname = $graphObject->getProperty('name'); // To Get Facebook full name
	     $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
	
	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fuid;           
        $_SESSION['login_username'] = $ffname;
	    $_SESSION['EMAIL'] =  $femail;
		$image = $fuid; 
	
    /* ---- header location after session ----*/
  //header("Location: index.php");
  //$checkuser = checkuser($fuid,$fname,$ffemail, $image);
  $fbase_url = "http://stopoint.com";
  
  
	  
  header('Location: '.$fbase_url.'/checkout2');
	  
} else {
  //$fbase_url = "http://unidevphp.com/stopoint";
  $loginUrl = $helper->getLoginUrl(array('scope' => 'email, public_profile,user_friends')); 
  header("Location: ".$loginUrl);
}
?>