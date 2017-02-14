<?
// REMINDER: ALL OF THESE NEED TO BE IN app.yaml too
$direct_redirects = array(
  "/index" => "https://www.stopoint.com/",
  "/index.php" => "https://www.stopoint.com/",
 
); 

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$redirect_url = $direct_redirects[$path];
if(!is_null($redirect_url)) {
  //header("HTTP/1.1 301 Moved Permanently");
  header("Location: https://"."www.stopoint.com");
  header("Connection: close");
  die();  
  
}
?>