<?php
require_once("connect.php");
include("is_logged_sub_pages.php");
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Request_new_feature</title>
    <meta charset="utf-8">
    <meta name="description" content="student placement training program">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css/header_footer.css" rel="stylesheet">
</head>
<script>
    function validate_submission() {
        if (document.getElementById("feature_name_text").value == "") {
            document.getElementById("error").innerHTML = "please enter the feature you would like to see.";
            document.getElementById('feature_name_text').focus();
            return false;
        } else if (document.getElementById("description_text").value == "") {
            document.getElementById("error").innerHTML = "Please describe the feature...";
            document.getElementById('description_text').focus();
            return false;
        } else {
            return true;
        }
    }
</script>
<style>
        button
        {
          background: white;
          border: solid black 1px;
          padding: 5px;
          box-shadow: black 1px 1px 1px;
        }

        button:hover
        {
          background: #4CAF50;
          transition: 0.5s;
        }

        h2,
    h3 {
        text-align: center;
        font-family: Candara;
        font-kerning: auto;
        "}button{font-size: large; padding: 5px; border-radius: 2px; box-shadow: black 2px 2px 2px; background-color: white; border: solid 1px; white-space: nowrap;}button:active{box-shadow: black 0px 0px 0px;}
</style>
<div id="wrapper">
    <header>
        <br/>
        <h2 id="title">STUDENT PLACEMENT TRAINING</h2>
        <br/> </header>
</div>

<body>
    <form method="post" action="request_new_feature.php" onsubmit="return validate_submission()">
        <h2 align=center><?php if(isset($_SESSION['user_email'])){ echo "Hello ".$_SESSION['user_email']." ,";}?> help us to make your experience better </h2>
        <br/><br/>
        <div align="center">
            <p style="color: red; font-family: 'Courier New'; font-weight: bold;" id="error"></p>
        </div>
        <br/>
        <h3 align=center id="new_feature_title">Feature you would like to see:</h3>
        <div id="feature_name" align="center">
            <textarea id="feature_name_text" name="feature" style="font-family: Arial; font-size: large; max-width: 90%" rows="2" cols="50" maxlength="100"></textarea>
        </div>
        <h3 align=center>Description:</h3>
        <div id="description" align="center">
            <textarea id="description_text" name="description" style="font-family: Arial; font-size: large; max-width: 90%" rows="10" cols="100" maxlength="1000"></textarea>
        </div>
        <div align="center">
            <button id="submit_new_fearure" name="submit" style="margin-bottom: 5%;" type="submit" >Submit</button>
        </div>
    </form>

</body>
<footer style="display: inline;">
    <div align="center" style="white-space: normal; background-color: #4CAF50;">
        <br/>
        <br/> &emsp;&emsp;&emsp;&emsp;<a href="request_new_feature.php" style="color: white;">Request_New_Feature</a> &emsp;&emsp;&emsp;&emsp; <a href="contact_us.php" style="color: white; ">Contact_us</a> &emsp;&emsp;&emsp;&emsp; <a href="about.php" style="color: white; ">About</a>
        <br/>
        <br/>
        <br/> </div>
</footer>
</html>
<?php

if(isset($_POST['submit']) && isset($_POST['feature']) && isset($_POST['description']))
{
    $feature=$_POST['feature'];
    $description=$_POST['description'];


    $myconnect=new connect();
    $myconnect->setconnection();
    $conn=$myconnect->getconnection();

    $feature=makesafe($conn, $feature);
    $description=makesafe($conn, $description);
    $usn=$_SESSION['user_usn'];
    $query="insert into newfeature values('$usn','$feature','$description')";
    if(mysqli_query($conn, $query))
    {
        echo '<script>document.getElementById("error").style.color="green";document.getElementById("error").innerHTML="Thank you for spending your precious time with us, we will be looking at this soon,Have a nice time.";</script>';
    }
    else {
      echo '<script>document.getElementById("error").innerHTML="Oops! something went wrong try again."</script>';
    }
}

// make input value as safe value
function makesafe($conn,$var)
{
    $var=htmlentities(trim(stripslashes($var)), ENT_NOQUOTES, "UTF-8");
    $var=mysqli_real_escape_string($conn,$var);
    return $var;
}

?>
