<?php
ob_start();

// check user is logged or not
require("is_logged_sub_pages.php");

// load module that connects to database
require_once("connect.php");

// on click of update password button
if(isset($_POST['updatepassword']) && isset($_POST['oldpassword']) && isset($_POST['newpassword']))
{

    if($_POST['updatepassword']==="true")
    {
        // connect to database
        $myconnect = new connect();
        $myconnect->setconnection();

        // make input string safe
        $oldpassword=makesafe($myconnect->getconnection(),$_POST['oldpassword']);
        $newpassword=makesafe($myconnect->getconnection(),$_POST['newpassword']);

        $email=$_SESSION['user_email'];

        $conn=$myconnect->getconnection();

        // select email and password of respective user
        $stmt = $conn->prepare("select email,password from userlogin where email=?");
        $stmt->bind_param("s",$email);
        if(!$stmt->execute())
        {
            _reload(1);
        }

        //$stmt->store_result();
        $stmt->bind_result($fetch_email,$fetch_password);
        $stmt->fetch();

        // check user exists or not
        if($fetch_email!="" && $fetch_password!="" )
        {
            if($email==$fetch_email)
            {
                if(password_verify($oldpassword,$fetch_password)) // verify old password
                {
                    // below code sets new password is old password is correct
                    $myconnect->terminate();
                    $myconnect->setconnection();
                    $conn=$myconnect->getconnection();
                    $newpassword=password_hash($newpassword,PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("update userlogin set password=? where email=?");
                    $stmt->bind_param("ss",$newpassword,$email);
                    if(!$stmt->execute())
                    {
                        _reload(1);
                    }
                    $user_info=["status"=>"success"];
                    echo json_encode($user_info);
                    exit(); // stop executing further script
                }
                else
                {
                    $myconnect->terminate();  //terminate connection to the database server
                    _reload(2);                 // incorrect password for current email_id submitted by the user
                }
            }
        }
        exit();
    }
    else
    {
        $arr=["error"=>"true"];
        echo json_encode($arr);
        exit();
    }

}
else
{
    session_unset();
    session_destroy();
    header("Location:index.php");
    exit();
}

// function to make string safe wrt database
// take string as argument
function makesafe($conn,$var)
{
    $var=htmlentities(trim(stripslashes($var)), ENT_NOQUOTES, "UTF-8");
    $var=mysqli_real_escape_string($conn,$var);
    return $var;
}

// function reloads tells status of update_process to user
function _reload($var)
{
    if($var==1)
    {
      $error=["status"=>"Failed_to_update"];
      echo json_encode($error);
    }
    elseif ($var==2)
    {
      $error=["status"=>"invalid_oldpassword"];
      echo json_encode($error);
    }

    exit();
}
?>
