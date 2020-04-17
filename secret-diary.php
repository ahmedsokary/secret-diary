<?php
session_start();



$conn=mysqli_connect("localhost","root","","diary");
if(mysqli_connect_error()){
echo"There is an error in connection";
}

if(isset($_POST['sign-up']))
{
    $error="";
if($_POST['email']=='')
echo'<div class="alert alert-danger" role="alert">
The Email field is empty
</div>';
if($_POST['password']=='')
{
    echo'<div class="alert alert-danger" role="alert">
    The password field is empty
    </div>';
}


else{
    $query="select email from diary where email='".$_POST['email']."'";
$result=mysqli_query($conn,$query);

if (mysqli_num_rows($result) > 0) {
echo"This Email is already loged-in";
}
else{
$query="INSERT INTO `diary`(email,password) VALUES('".mysqli_real_escape_string($conn,$_POST['email'])."','".mysqli_real_escape_string($conn,$_POST['password'])."')";
mysqli_query($conn, $query);
$_SESSION['id']=mysqli_insert_id($conn);
if(isset($_POST['check']))
{
setcookie("id",mysqli_insert_id($conn),time()+60*60*4*356);
}
header("location:diary-write.php");
}
}
}




if(isset($_POST['log-in']))
{
if($_POST['email']=='')
echo'<div class="alert alert-danger" role="alert">
The Email field is empty
</div>';
if($_POST['password']=='')
echo'<div class="alert alert-danger" role="alert">
The password field is empty
</div>';
else{
$query="select * from diary where  email='".$_POST['email']."' and password='".$_POST['password']."'";
$result=mysqli_query($conn,$query);
if (mysqli_num_rows($result) > 0) 
{
    $row=mysqli_fetch_array($result);//to get id
    $_SESSION['id']=$row['id'];
    if(isset($_POST['check']))
    {
    setcookie("id",$row['id'] ,time()+60*60*4*356);
    }
    header("location:diary-write.php");
}
else
echo'<div class="alert alert-danger" role="alert">
please check username and password are correct
</div>';

}
}










?>


<!doctype html>
<html lang="en">
  <head>
  <script type="text/javascript" src="jquery-min.js"></script> 
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Diary</title>

    <style type="text/css">
body { 
  background: url(img.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
h1{
    color:white;

}
.container {
     width: 400px;
    margin-right: auto;
    margin-left: auto;
    text-align:center;
    position:relative;
    top:150px;
}
p{color:white;}
</style>


  </head>
  <body>
  <div class="container" >
  
  <h1>Secret Diary</h1>
  <p>Store your thoughts permanently and securely</p>
  <br>
  <p>intrested? Sign uo now.</p>
  <form method="post" action="secret-diary.php" >
  <div class="form-group">
    <input name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email"> 
  </div>
  <div class="form-group">
    <input name="password" type="password" class="form-control" id="exampleInputPassword1"  placeholder="Password">
  </div>
  <div class="form-group form-check">
    <input name="check" type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1" style="color:white">Keep logged in</label>
  </div>
  <button type="submit" name="sign-up" class="btn btn-primary">sign up</button>
  <button type="submit" name="log-in" class="btn btn-primary">log in</button>
</form>


</div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>