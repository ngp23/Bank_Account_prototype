 <?php
//Session start.
session_start();
if(!isset($_SESSION["captchapassed"])) {
  echo"Please Pass the captcha";
  header("refresh: 4; url=captcha_test2.php");
  exit();
 }
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors',1);

setlocale(LC_MONETARY, 'en_US');
//gets information from the account.php and myfunctions.php
include ( "account.php" ) ;
include("myfunctions.php");
//connects to the mysql.

$db = mysqli_connect($hostname, $username, $password, $project);

if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
print "Successfully connected to MySQL.<br><br>";

mysqli_select_db( $db, $project ); 

// Gets the data from the user
$ucid = safe("ucid");     
$password = safe( "password");      

$delay=4;

if (!authenticate($ucid,$password,$db)){
  //redirect to the login page
  echo"Invalid. Redirecting to the form";
  header("refresh: 3; url=auth_2.php");
  exit();
}else{
  //redirect  to the next page
  $_SESSION["logged"]=true;
  $_SESSION["ucid"]=$ucid;
  echo"Valid. Redirecting to pincreate.php";
  header("refresh: 3; url=pincreate.php");
  exit();
;}

?>

<!DOCTYPE html>
<meta charset="UTF-8">
<style>
   #F2{border: 2px solid red;padding:25px; width:20%;
    margin:200px 400px 65px; text-align:center;}

</style>
<!--Gets the data from the user-->
<form action = "auth.php" id="F2">

<!--Gives an access to user to input the UCID.-->
<label for = "ucid">Ucid:</label>
	<input 	type		 		=	text 	
			name 		 		= "ucid"    
			autocomplete 	=  "off"
      required
			pattern 	 		=	"^[a-z]{2,3}[0-9]{0,3}$" >


<!--Gives an access to user to input the Password.-->
<label for = "password"><br>Password:</label>
	<input 	type		 		=	text 	
			name 		 		= "password"    
			autocomplete 	=  "off"
      required
			pattern 	 		=	"^[a-z]{2,3}[0-9]{0,3}$" >

<br>
<!--Gives and submit button.-->
<input type = submit >


</form>

</html>