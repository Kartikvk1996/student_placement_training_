<?php
ob_start();
session_start();
if(isset($_SESSION) && isset($_SESSION['admin']) && $_SESSION['admin']==="logged_to_sptp_as_admin")
{
    require_once("connect.php");
    $myconnect=new connect();
    $myconnect->setconnection();
    $conn=$myconnect->getconnection();
    if(isset($_POST['block']) && isset($_POST['usn']) && ctype_alnum($_POST['usn']) && strlen($_POST['usn'])==10)
    {
      $usn=$_POST['usn'];
      $usn=makesafe($conn, $usn);
      $usn=strtoupper($usn);
      $query="update userlogin set status='block' where usn='$usn'";
      if(mysqli_query($conn, $query))
      {
        echo "<script>alert('user successfully blocked');</script>";
      }
      else {
        echo "<script>alert('error in blocking');</script>";
        echo mysqli_error($conn);
      }
      $myconnect->terminate();
    }



    if(isset($_POST['unblock']) && isset($_POST['ub_usn']) && ctype_alnum($_POST['ub_usn']) && strlen($_POST['ub_usn'])==10)
    {
      $usn=$_POST['ub_usn'];
      $usn=makesafe($conn, $usn);
      $usn=strtoupper($usn);
      $query="update userlogin set status='unblock' where usn='$usn'";
      if(mysqli_query($conn, $query))
      {
        echo "<script>alert('user successfully unblocked');</script>";
      }
      else {
        echo "<script>alert('error in unblocking');</script>";
        echo mysqli_error($conn);
      }
      $myconnect->terminate();
    }


    if(isset($_POST['incr_sem']))
    {
      $query1="update userlogin set sem=8 where sem=7";
      $query2="update userlogin set sem=7 where sem=6";
      $query3="update userlogin set sem=6 where sem=5";
      $query4="update userlogin set sem=5 where sem=4";
      $query5="update userlogin set sem=4 where sem=3";
      $query6="update userlogin set sem=3 where sem=2";
      $query7="update userlogin set sem=2 where sem=1";
      if(mysqli_query($conn, $query1) && mysqli_query($conn, $query2) && mysqli_query($conn, $query3) && mysqli_query($conn, $query4) && mysqli_query($conn, $query5) && mysqli_query($conn, $query6) && mysqli_query($conn, $query7))
      {
        echo "<script>alert('semister value updated');</script>";
      }
      else {
        echo "<script>alert('error in updating');</script>";
      }
      $myconnect->terminate();
    }

    if(isset($_POST['logout']))
    {
      $myconnect->terminate();
      session_unset();
      session_destroy();
      header("Location:manage.php");
      exit(0);
    }
}
else {
  session_destroy();
  exit(0);
}


// make input value as safe value
function makesafe($conn,$var)
{
    $var=htmlentities(trim(stripslashes($var)), ENT_NOQUOTES, "UTF-8");
    $var=mysqli_real_escape_string($conn,$var);
    return $var;
}

?>


<!DOCTYPE HTML>
<html>
<head>
  <title>Admin</title>
</head>
<body>
  <div align="center" id="block_user">
    <h2>Block the user.</h2>
    <form method="post" action="sptpadmin.php">
      USN : <input type="text" id="usn" maxlength="10" minlength="10" name="usn"/>
      <input type="submit" id="block_usn" name="block" value="block_user"/>
    </form>
  </div>
  <div align="center" id="unblock_user">
    <h2>UnBlock the user.</h2>
    <form method="post" action="sptpadmin.php">
      USN : <input type="text" id="ub_usn" maxlength="10" minlength="10" name="ub_usn"/>
      <input type="submit" id="unblock_usn" name="unblock" value="unblock_user"/>
    </form>
  </div>
  <div align="center" id="increment_sem">
    <h2>Increment the semister.</h2>
    <form method="post" action="sptpadmin.php">
      <input type="submit" id="incr_sem" name="incr_sem" value="increment_semister"/>
    </form>

  </div>

  <div id="logout">
    <form method="post" action="sptpadmin.php">
      <input type="submit" id="logout" name="logout" value="logout"/>
    </form>

  </div>
</body>
</html>
