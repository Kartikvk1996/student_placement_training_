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

// checks user is logged or not
if(isset($_SESSION['logged']) && isset($_SESSION['user_firstname']) && isset($_SESSION['user_lastname']) && isset($_SESSION['user_email']) && isset($_SESSION['user_usn']))
{

}
else
{
    reload();
}

ob_flush();
?>
