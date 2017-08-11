<?php
// access to admin page to manage the information
ob_start();
session_start();

// on click of logout button destroy session and redirect to homepage
if(isset($_POST) && isset($_POST['login']))
{

  $username=$_POST['username'];
  $password=$_POST['password'];

    if($username==="sptpadmin2016" && $password==="sptpadminlogin1888")
    {
      $_SESSION['admin']="logged_to_sptp_as_admin";
      header("Location:sptpadmin.php");
    }
    else
    {
      exit(0);
    }
}
ob_flush();

?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Manage user accounts</title>
</head>
<body>
  <h2 align="center">Welcome to admin page.</h2>
  <div align="center">
    <h3>Login to proceed</h3>
    <form method="post" action="manage.php">
      username : <input type="text" id="username" name="username" maxlength="20"/><br /><br />
      password : <input type="password" id="password" name="password" maxlength="20"/><br /><br />
      <input  type="submit" name="login" value="Login"/>
    </form>
  </div>
</body>

</html>
