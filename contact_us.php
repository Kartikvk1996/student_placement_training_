<!DOCTYPE HTML>
<html>
<head>
    <title>Report_Problem</title>
    <meta charset="utf-8">
    <meta name="description" content="student placement training program">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css/header_footer.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>
<script>
    function validate_report()
    {
        document.getElementById("status").innerHTML="";
        {
          if(document.getElementById("e mail").value=="")
            document.getElementById("error").innerHTML="Enter Email Id.";
            return false;
        }

        if(document.getElementById("desc").value=="")
        {
            document.getElementById("error").innerHTML="Describe your problem.";
            return false;
        }
        else
        {
            return true;
        }
    }
</script>
<style>
    #problem_title
    {
        padding: 3%;
        text-align: center;
        font-family: Candara;
        font-kerning: auto;
    }

    #problem
    {
        margin-bottom: 3%;
        font-family: Arial;
    }

    input
    {
      padding: 7px;
      width: 20%;
      font-family: Arial;
    }



    button
    {
        font-size: large;
        padding: 5px;
        border-radius: 2px;
        box-shadow: black 2px 2px 2px;
        background-color: white;
        border: solid 1px;
        white-space: nowrap;
    }

    button:active
    {
        font-size: large;
        padding: 5px;
        border-radius: 2px;
        box-shadow: black 0px 0px 0px;
        background-color: white;
        border: solid 1px;
        white-space: nowrap;
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
    <form method="post" action="contact_us.php" onsubmit="return validate_report();">
        <h2 id="problem_title">Hello ,We are here to help you.</h2>
        <div align="center" id="status">
        </div>
        <br />
        <br />
        <div id="user_mail" align="center">
            <input type="email" id="email" name="user_mail" placeholder="Email Id" />
        </div>
        <br />
        <br />
        <div align="center">
            <p style="color: red; font-family: 'Courier New'; font-weight: bold" id="error"></p>
        </div>
        <div id="description" align="center">
            <textarea placeholder="Description" id="desc" name="desc" style="font-family: Arial; font-size: large; max-width: 90%" rows="10" cols="50" maxlength="200"></textarea>

        </div>
        <div align="center">
            <button style="margin-bottom: 5%;" name="submit" type="submit">report</button>
        </div>
        <div align="center">
            <p id="ack"></p>
        </div>
    </form>



</body>


<footer style="display: inline;">
    <div align="center" style="white-space: normal; background-color: #4CAF50;">
        <br /><br />
        &emsp;&emsp;&emsp;&emsp;
        <a href="contact_us.php" style="color: white; ">Contact_us</a>
        &emsp;&emsp;&emsp;&emsp;
        <a href="about.php" style="color: white; ">About</a>
        <br /><br /><br />
    </div>

</footer>
<?php

require_once("connect.php");
if(isset($_POST['submit']) && isset($_POST['user_mail']) && isset($_POST['desc']) && $_POST['user_mail']!="" && $_POST['desc']!="" && ctype_alnum($_POST['desc']))
{
  $mail=$_POST['user_mail'];
  $desc=$_POST['desc'];

  $myconnect=new connect();
  $myconnect->setconnection();
  $conn=$myconnect->getconnection();

    $mail=makesafe($conn, $mail);
    $desc=makesafe($conn, $desc);

    $query="insert into contact_us values ('$mail','$desc')";
    if(mysqli_query($conn, $query))
    {
      echo "<script>document.getElementById('status').style='color:green';document.getElementById('status').innerHTML='Thank you for contacting us, we will be in touch with you soon'</script>";
    }
    else {
          echo "<script>document.getElementById('status').style='color:red';document.getElementById('status').innerHTML='Opps! something went wrong .Try again.'</script>";
    }

  $myconnect->terminate();
}

function makesafe($conn,$var)
{
    $var=htmlentities(trim(stripslashes($var)), ENT_NOQUOTES, "UTF-8");
    $var=mysqli_real_escape_string($conn,$var);
    return $var;
}

?>
