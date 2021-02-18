<?php
session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors',1);

include("account.php");
include("myfunction.php");

$db = mysqli_connect($hostname, $username, $password, $project);

if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
print "Successfully connected to MySQL.<br><br>";

mysqli_select_db( $db, $project ); 

$pass =$_GET["pass"]; echo "<br>Input password is $pass";
$ucide = $_GET["ucid"]; echo "<br>Input  ucid is $ucid<br>";


$s =  "Select * from users where ucid="$ucid""; echo "<br>SQL:$s<br>";
($t=mysqli_query($db,$s))or die (mysqli_error($db));
$num = mysqli_num_rows($t);
echo "<br>Number of rows for ucid $ucid is: $num<br>";

if($num==0){echo "Bad ucid.";exit();}
$r = mysqli_fetch_array($t,MYSQLI_ASSOC);
$hash = $r['hash'];
echo "<br>Retrieved hashed paassword for $ucid is: $hash<br><br>";
if(password_verify($pass,$hash))
{
  echo "<br>Password valid!";
}else{echo "<br>Password invalid!";}


?>