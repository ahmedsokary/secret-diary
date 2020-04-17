<?php
session_start();
/*cookie 
if(array_key_exists("id",$_COOKIE))
{
    $_SESSION['id']=$_COOKIE['id'];
   
}
*/
if(array_key_exists('id',$_SESSION))
{
//echo"Logged-in";
}
else
header("location:secret-diary.php");


$conn=mysqli_connect("localhost","root","","diary");
if(mysqli_connect_error())
{
    echo'<div class="alert alert-danger" role="alert">
    There is an error in connection
    </div>';
}
    else
    {
        $query="select * from diary where id='".$_SESSION['id']."' ";
        $result=mysqli_query($conn,$query);
        $row=mysqli_fetch_array($result);
        $diaryconent=$row['diary'];
        if(isset($_POST['submit']))
      {
        $query="update diary set diary='".$_POST['text']."'  where id='".$_SESSION['id']."' ";
     //hena msh 3aref 22ol lao mafish 7aga mktoba 22ol message
        if($_POST['text']==' ')
       {
         echo "<script>alert('You entered nothing')</script";
       }
       else{
        mysqli_query($conn,$query);
        $diaryconent="";
       }
      }
    }






?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>My Diary</title>
    <style type="text/css">
a{
border-style:solid;
border-radius:6px;
width:70px;
text-align:center;
text-decoration: none
}
a:hover{text-decoration: none}
.navbar{height:50px;}
body { 
  background: url(img.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
button{
    border-radius:6px;
    background:#bf5757;
    border-style:none;
}
   
</style>

  </head>
  <body>
  <nav id="nav" class="navbar fixed-top navbar-expand-xs navbar-light bg-light">
    <h2 class="navbar-brand" >Secret Diary</h2>
    <a style="float:left" href='secret-diary.php'>log out</a >
  </nav>
  <br> <br><br>
  <div style="text-align:center" class="container-fluid">
  <form method="post" action="diary-write.php" >
  <textarea name="text" style="height: 650px; width: 90%;resize:none"><?php echo $diaryconent ?>  </textarea>
  <br>
  <button type="submit" name="submit">Submit</button>
 
</form>
</div>
  
 


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>