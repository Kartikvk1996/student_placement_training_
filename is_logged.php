<?php
ob_start();

// start the session
session_start();

// function unsets and destroys the session and redirects to login page
function reload()
{
  session_unset();
  session_destroy();
  header('Location:index.php');
  exit();
}


//check the live token id;
//ltgt = login time generated token
if(isset($_GET['ltgt']))
{
    $get_logged_id=$_GET['ltgt'];
    $get_logged_id=htmlentities(trim(stripslashes($get_logged_id)), ENT_NOQUOTES, "UTF-8");

    if(!ctype_alnum($get_logged_id) && $_SESSION['logged']!==$get_logged_id)
    {
        reload();
    }

    if(isset($_SESSION['logged']) && isset($_SESSION['user_firstname']) && isset($_SESSION['user_lastname']) && isset($_SESSION['user_email']) && isset($_SESSION['user_usn']) && isset($_SESSION['user_sem']))
    {
      // allow user to access the Content if logged
    }
    else
    {
        reload(); // if not logged redirect to login page
    }
}
else
{
    reload();
}
ob_flush();
?>
