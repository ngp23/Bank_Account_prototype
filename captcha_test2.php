<?php
session_start();

if(isset($_GET["guess"]))
{
 //gets the value from the session and user.
  $guess= $_GET["guess"];
  $preserved= $_GET["preserved"];
 // $preserved = $_SESSION["preserved"];
  $text=$_SESSION["captcha"];
  if($guess==$text)
  {
    echo "<br><br>Captcha right:redirecting to auth.html";
    header("refresh:3,url=auth_2.php");
    $_SESSION["captchapassed"]=true;
    exit();
  } 
 }
?>

<img src="captcha.php"><br><br> 
<form action = "captcha_test2.php">
<input type="text" size=10 name="guess" autocomplete="off" >Captcha<br>
<input type="text" name="preserved" value="<?php echo $preserved;?>" autocomplete="off" >preserved<br>
<input type="submit"value ="submit">
</form>