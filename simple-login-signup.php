<?php
// Create connection
$conn = mysqli_connect("localhost","root","","users");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['login']))
{
if($_POST["name"]=='')
{
  echo"please enter a name";
}
else if($_POST["password"]=='')
{
echo"please enter a password";

}

else{

$password=$_POST["password"];
$name=mysqli_real_escape_string($conn,$_POST["name"])  ;
$query="select id from users where password='".$password."' and name='".$name."'";
$result=mysqli_query($conn,$query);
if (mysqli_num_rows($result) > 0)
{
 echo"you loged in correctly";
}
else
{
  echo"username or password is incorrect";
}
}
}
if(isset($_POST['sign-up']))
{
if($_POST["name"]=='')
{
  echo"please enter a name";
}
else if($_POST["password"]=='')
{
echo"please enter a password";

}

else{
  $name=$_POST['name'];
  $password=$_POST['password'];
$query2="select id from users where name='".$name."'";
$result2=mysqli_query($conn,$query2);
if(mysqli_num_rows($result2)>0)
echo"The name is taken";
else{
$sign="insert into users(name,password) values('".$name."','".$password."')";
mysqli_query($conn,$sign);
echo"you have signed in successfully";
}

}

}


?>


<html>
<form method="post" action="index.php" style="text-align: center">
<p>please enter name </p>
<input name="name" type="text">
<p>please enter password </p>
<input name="password" type="text">
<br> 
<br> 
<button name="login" type="submit">login</button>
<button name="sign-up" type="submit">sign-up</button>
</form>
</html>