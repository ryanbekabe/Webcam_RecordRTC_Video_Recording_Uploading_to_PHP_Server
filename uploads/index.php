<?php
//Default PHP 7
$servername = "localhost:3306";
$username = "root";
$password = "bismillah";
$dbname = "hanyajasa";
date_default_timezone_set('Asia/Jakarta');
$waktu=date('Y-m-d H:i:s'); 
$ipserver=$_SERVER['SERVER_ADDR']; 
$ip=$_SERVER['REMOTE_ADDR']; 
$ua=$_SERVER['HTTP_USER_AGENT']; 
$targetFile = './dumprequest7.txt'; 
global $protocol; 
global $ref; 
global $URI; 
$protocol = ""; 
$ref = ""; 
$URI = ""; 
$postdata = ""; 
if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') { 
    $protocol = 'https://'; 
} 
else 
{ 
    $protocol = 'http://'; 
} 
//if($ref==1){ 
    $ref=$_SERVER['HTTP_REFERER']; 
//}else{ 
//    $ref=''; 
//} 
if($postdata != ''){ 
    $postdata = $_POST['postdata']; 
    //echo $postdata; 
}else{ 
    $postdata=''; 
} 
if($postdata != ''){ 
    $URI=$protocol.$_SERVER['HTTP_CLIENT_IP'].$_SERVER['HTTP_X_FORWARDED_FOR'].$_SERVER['HTTP_X_FORWARDED'].$_SERVER['HTTP_FORWARDED_FOR'].$_SERVER['HTTP_FORWARDED'].$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    //echo $URI; 
}else{ 
    $URI=''; 
} 
$VarHeader = "HTTP headers:\n".$_SERVER['REQUEST_METHOD']."\n".$_SERVER['REQUEST_URI']."\n".$_SERVER['SERVER_PROTOCOL']."\n"; 
//echo $VarHeader; 
$headerList = ""; 
foreach($_SERVER as $key_name => $key_value) { 
    $key_name . " = " . $key_value . "</br>"; 
    $headerList = $headerList . $key_name . " = " . $key_value . "\n"; 
} 
//echo $headerList; 
$requestbody = "\nRequest body:\n" . file_get_contents('php://input') . "\n"; 
//echo $requestbody; 
file_put_contents($targetFile, $VarHeader . $headerList. $requestbody); 
//echo("Done!\n\n"); 
//mysql_query("INSERT INTO ryanlog(id, ip, waktu, ref, ua, uri) VALUES(NULL,'$ip','$waktu','$ref','$ua', '$URI')");

//--PHP7--

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    #die("Connection failed: " . mysqli_connect_error());
}

//$sql = "INSERT INTO MyGuests (firstname, lastname, email)
//VALUES ('John', 'Doe', 'john@example.com')";

$sql = "INSERT INTO ryanlog (id, ip, waktu, ref, ua, uri) VALUES (NULL,'$ip','$waktu','$ref','$ua', '$ipserver.$postdata.$URI.$VarHeader.$headerList.$requestbody')";
#mysql_query("INSERT INTO ryanlog(id, ip, waktu, ref, ua, uri) VALUES(NULL,'$ip','$waktu','$ref','$ua', '$URI')");

if (mysqli_query($conn, $sql)) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
/* 
CREATE TABLE `ryanlog` (
  `id` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `waktu` varchar(50) NOT NULL,
  `ref` varchar(500) NOT NULL,
  `ua` varchar(500) NOT NULL,
  `uri` mediumtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `ryanlog` 
  ADD PRIMARY KEY (`id`); 
ALTER TABLE `ryanlog` 
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2; 
COMMIT; 

<frameset width='100%' height='100%'><frame noresize='noresize' src='https://hanyajasa.com/' /></frameset>
<link rel="shortcut icon" href="https://img.icons8.com/carbon-copy/100/888888/share.png" />
<link rel="shortcut icon" href="https://img.icons8.com/clouds/100/888888/share.png" />
*/

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL was not found on this server.</p>
<hr>
<address>Apache/2.4.18 (Ubuntu) Server at 13.67.62.139 Port 80</address>
</body></html>
