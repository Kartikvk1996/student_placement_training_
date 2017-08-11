<?php
// this module is to login to the system

ob_start();

// start the session
session_start();

// load script that connects to database
require_once("connect.php");

// specify output type in json
header('Content-Type: application/json');


if(isset($_POST))
{

    // get user data present in json
    $user_info=json_decode(json_encode($_POST),true);

    // check login token is set or not
    if(isset($user_info['login_token']))
    {
      // is login token doesnt match reload the login page to prevent session hijack and mim attack
      if($user_info['login_token']!==$_SESSION['session_token'])
      {
          reload();
      }
      else
      {
          // connect to database
          $myconnect = new connect();
          $myconnect->setconnection();

          // save user mailid,password in temporary variables;
          $email=$user_info['mailid'];
          $password=$user_info['password'];

          //string length of inputs should be less
          // than 35 for email and 15 for password
          if($email=="" ||  strlen($email)>35 || $password=="" || strlen($password)>15)
          {
              user_suspect($email);
              reload();
          }

          // check the string
          $email=makesafe($myconnect->getconnection(),$email);
          $password=makesafe($myconnect->getconnection(),$password);

          //create prepared statements
          // prepare and bind
          $conn=$myconnect->getconnection();
          $stmt = $conn->prepare("select firstname,lastname,usn,sem,email,password,status from userlogin where email=? limit 1");
          $stmt->bind_param("s",$email);
          if(!$stmt->execute())
          {
              reload();
          }
          //$stmt->store_result();
          $stmt->bind_result($fetch_firstname,$fetch_lastname,$fetch_usn,$fetch_sem,$fetch_email,$fetch_password,$fetch_status);
          $stmt->fetch();
          $stmt->close();
          if($fetch_email!="" && $fetch_password!="" && $fetch_firstname!="")
          {
              if($email==$fetch_email)
              {
                  if(password_verify($password,$fetch_password))  //verify the password
                  {
                    // check user blocked by admin or not
                    if($fetch_status=="block")
                    {
                      $error=["error"=>"blocked"];
                      echo json_encode($error);
                    }
                    else
                    {
                      $login_id=$_SESSION['logged']= md5(uniqid());;  //generate unique token assign it to logged

                      // copying user information into session variables for further use in subpages

                      $_SESSION['user_firstname']=$fetch_firstname;
                      $_SESSION['user_lastname']=$fetch_lastname;
                      $_SESSION['user_usn']=$fetch_usn;
                      $_SESSION['user_sem']=$fetch_sem;
                      $_SESSION['user_email']=$fetch_email;
                      $_SESSION['user_year']=get_year($fetch_sem);

                      $redirect="welcome.php?ltgt=".$login_id."&encode=UTF-8&mailid=".$_SESSION['user_email'];

                      if($fetch_sem=="")
                      {
                        $_SESSION['teacher_logged']="true";
                        $redirect="teachers.php";
                      }
                      // create a array to send status to the ajax script
                      $user_info=["mail"=>$_SESSION['user_email'],"redirect"=>$redirect,"error"=>"false"];
                      $_SESSION['home']=$user_info['redirect'];
                      //send data in json "javascript object notation format"
                      echo json_encode($user_info);

                    }
                    $myconnect->terminate();
                    exit(); // stop executing further script
                  }
                  else
                  {
                      $myconnect->terminate();  //terminate connection to the database server
                      reload();                 // incorrect password for current email_id submitted by the user
                  }
              }
        }
        else
        {
            $myconnect->terminate();          //terminate connection to the database server
            reload();
        }
    }
  }

  else
   {
    session_unset();
    session_destroy();
    header('Location:index.php');
    exit();
  }
}
else
{
  session_unset();
  session_destroy();
  header('Location:index.php');
  exit();
}


// function to get year from send_mail
function get_year($sem)
{
  if($sem==1 || $sem==2)
  {
    return 1;
  }
  else if($sem==3 || $sem==4)
  {
    return 2;
  }
  else if($sem==5 || $sem==6)
  {
    return 3;
  }
  else {
    return 4;
  }
}


//get user ip address stored in server
function get_client_ip()
{
    $ip = getenv('HTTP_CLIENT_IP')?:
        getenv('HTTP_X_FORWARDED_FOR')?:
            getenv('HTTP_X_FORWARDED')?:
                getenv('HTTP_FORWARDED_FOR')?:
                    getenv('HTTP_FORWARDED')?:
                        getenv('REMOTE_ADDR');
    return $ip;
}

//write userlog
function userlog($filename,$email)
{
    $path='../server_status/'.$filename;
    date_default_timezone_set("Asia/Kolkata");
    $myfile = fopen($path, "a") or die("Failed");
    $text="[ ".get_client_ip()."        ".$email."         ".date('d/m/Y h:i:s a', time())." ]\n";
    fwrite($myfile, $text);
    fclose($myfile);
}

// write log of suspected user
function user_suspect($email)
{
    userlog('user_log_file.txt',$email);
}



// Incorrect data ->  reload the page
function reload()
{
    $error=["error"=>"true"];
    echo json_encode($error);
    exit();
}

// make input value as safe value
function makesafe($conn,$var)
{
    $var=htmlentities(trim(stripslashes($var)), ENT_NOQUOTES, "UTF-8");
    $var=mysqli_real_escape_string($conn,$var);
    return $var;
}

ob_flush();
ob_clean();

?>
