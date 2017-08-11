<?php
// module resets the password

session_start();

// configure server date to asia
date_default_timezone_set("Asia/Kolkata");

// load module that connects to database
require_once("connect.php");

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password reset</title>
    <link rel="stylesheet" type="text/css" href="css/header_footer.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>
<style>

    #about
    {
        margin: 3% 10% 0 10%;
        font-family: "Arial";
    }

    h2
    {
        color:midnightblue;
    }
    p
    {
        margin-left: 20px;
        margin-right: 15px;
        font-size: 20px;
        line-height: 30px;
    }

</style>
<div id="wrapper">
    <header>
        <br />
        <h2 id="title">STUDENT PLACEMENT TRAINING</h2>
        <br />
    </header>
</div>
<body>
  <div align="center" style="margin-top:10%; margin-bottom:10%;">
    <h2>Password Reset</h2>
    <h3 id="status">

    </h3>
    <br />
    <br />
    <form method="post" action="forgotpassword.php">
      <table>
        <tr>
          <td>
            Email Id  :
          </td>
          <td>
            <input type="email" name="email"  />
          </td>
        </tr>
        <tr>
          <td>
            USN :
          </td>
          <td>
            <input type="text" name="usn" />
          </td>
        </tr>
        <tr>
          <td>
          </td>
          <td>
            <input type="submit" value="check" name="check"/>
          </td>
        </tr>
      </table>

    </form>

    <br />
    <br />
    <br />
    <form method="post" action="forgotpassword.php" id="pwd_reset" style="display:none">
      <table>
        <tr>
          <td>
            OTP :
          </td>
          <td>
            <input type="text" name="otp"  />
          </td>
        </tr>
        <tr>
          <td>
            New password  :
          </td>
          <td>
            <input type="password" name="newpassword" />
          </td>
        </tr>
        <tr>
          <td>
          </td>
          <td>
            <input type="submit" value="update password" name="update" />
          </td>
        </tr>
      </table>
    </form>
  </div>
</body>
<footer style="display: inline;">
    <div class="footer" align="center" style="white-space: normal; background-color: #4CAF50;">
        <br /><br />
        &emsp;&emsp;&emsp;&emsp;
        <a href="contact_us.php" style="color: white; ">Contact_us</a>
        &emsp;&emsp;&emsp;&emsp;
        <a href="about.php" style="color: white; ">About</a>
        &emsp;&emsp;&emsp;&emsp;
        <br /><br /><br />
    </div>

</footer>
</html>
<?php


// function to make string safe wrt database
// take string as argument
function makesafe($conn,$var)
{
    $var=htmlentities(trim(stripslashes($var)), ENT_NOQUOTES, "UTF-8"); // convert to uniode-8 format
    $var=mysqli_real_escape_string($conn,$var); // make srting safe
    return $var;
}

//function that sends mail
function send_mail($firstname,$email,$otp)
{
    $headers="X-Priority:1 (Highest)\n";
    $headers .="X-MSMail-Priority : High\n";
    $headers .="Importance : High\n";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    //$from="sptp@noreply.com";
//$headers .= 'From: '.$from."\r\n";


    // the message
    $msg='<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title></title><meta name="viewport" content="width=device-width, initial-scale=1.0"></head><div id="wrapper" style="width: 100%;position: static;"><header style="text-align : center;color: white; margin-top: -1%;border-bottom: solid 2px lightgray;background-color: #4CAF50;"><br /><h2 id="title">STUDENT PLACEMENT TRAINING</h2><br /></header></div><body><div style="margin-left: 10%; margin-right: 10%"><h4>Hey '.$firstname.',</h4><p>you have initiated password recovery procedure . your <b>OTP = '.$otp.'</b></p><br />This OTP is valid only for 3 minutes.<br /><br /><br />Happy coding,<br />By sptp-team.<br /></div></body><footer style="display: inline;border-top: solid 2px lightgray;background-color: #4CAF50;"><div align="center" style="white-space: normal; background-color: #4CAF50;"><p style="font-size: large; color: white"><br />&copy; student placement training program 2017</p><br /></div></footer></html>';

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);

    // send email
     mail($email,"Password Reset",$msg,$headers);
}


if(isset($_POST['check']) && isset($_POST['email']) && $_POST['email']!="" && isset($_POST['usn']) && $_POST['usn']!="" && strlen($_POST['usn'])==10)
{
  $email=$_POST['email'];
  $usn=$_POST['usn'];

  // connect to database
  $myconnect=new connect();
  $myconnect->setconnection();
  $conn=$myconnect->getconnection();

  // make the input values safe
  $email=makesafe($conn, $email);
  $usn=makesafe($conn, $usn);

  $query="select firstname,email from userlogin where email='$email' and usn='$usn' limit 1";
  $result=mysqli_query($conn,$query);
  if($result->num_rows == 1)
  {
    ini_set("session.cookie_lifetime","180"); // set session expire to 3 minutes
    $_SESSION['otp']= uniqid();
    $_SESSION['email']=$email;
    $_SESSION['usn']=$usn;
    $row=mysqli_fetch_array($result);
    $firstname=$row['firstname'];
    send_mail($firstname,$email,$_SESSION['otp']);
    echo "<script>document.getElementById('status').innerHTML='An otp has been sent to your mail , enter otp inorder to complete the process.'</script>";
    echo "<script>document.getElementById('pwd_reset').style='display:block'</script>";
  }
  else {
    echo "<script>document.getElementById('status').innerHTML='No user found with email = ".$email." and usn = ".$usn.", make sure account exists or not'</script>";
  }
  $myconnect->terminate();
}

if(isset($_POST['update']) && isset($_POST['otp']) && $_POST['otp']!="" && isset($_POST['newpassword']) && $_POST['newpassword']!="")
{

  $otp=$_POST['otp'];
  $newpassword=$_POST['newpassword'];
  $email=$_SESSION['email'];
  $usn=$_SESSION['usn'];
  if($_SESSION['otp']==$otp)
  {
    // connect to database
    $myconnect=new connect();
    $myconnect->setconnection();
    $conn=$myconnect->getconnection();

    $newpassword=makesafe($conn, $newpassword);
    $newpassword=password_hash($newpassword,PASSWORD_DEFAULT);
    $query="update userlogin set password='$newpassword' where usn='$usn' and email='$email'";
    if(mysqli_query($conn, $query))
    {
      echo "<script>document.getElementById('status').innerHTML='password reset is successfull.'</script>";
    }
    else {
      echo "<script>document.getElementById('status').innerHTML='unable to reset password.'</script>";

    }
    $myconnect->terminate();
  }
}

?>
