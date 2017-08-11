<?php

ob_start();
session_start();
require_once("connect.php");
header('Content-Type: application/json');


function initialise_student_stat($usn,$conn,$test_no)
{
  $query="insert into ads_test_info values('$usn',$test_no,0)";
  if(!mysqli_query($conn, $query))
  {
    initialise_student_stat($conn,$test_no);
  }

  $query="insert into oop_test_info values('$usn',$test_no,0)";
  if(!mysqli_query($conn, $query))
  {
    initialise_student_stat($conn,$test_no);
  }

  $query="insert into aptitude_test_info values('$usn',$test_no,0)";
  if(!mysqli_query($conn, $query))
  {
    initialise_student_stat($conn,$test_no);
  }
}

function initialise_user_stat($usn,$conn)
{
  for($i=1;$i<6;$i++)
  {
    initialise_student_stat($usn,$conn,$i);
  }
  $query="insert into user_test_info values('$usn',0,0,0,0,0,0,0,0,0,0,0,0)";
  if(!mysqli_query($conn, $query))
  {
    mysqli_query($conn, $query);
  }

}



//get user ip address
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


function register_log($filename,$firstname,$lastname,$usn,$sem,$email)
{
    $path='../server_status/'.$filename;
    date_default_timezone_set("Asia/Kolkata");
    $myfile = fopen($path,"a") or die("Failed");
    $text="[ ".get_client_ip()."    ".$firstname."    ".$lastname."    ".$usn."    ".$sem."    ".$email."    ".date('d/m/Y h:i:s a', time())." ]\n";
    fwrite($myfile, $text);
    fclose($myfile);
}

// breaking the code
function reg_suspect($firstname,$lastname,$usn,$sem,$email)
{
    register_log('register_log_file.txt',$firstname,$lastname,$usn,$sem,$email);
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

//function that sends mail for new registered user
function send_mail($firstname,$email)
{
    $headers="X-Priority:1 (Highest)\n";
    $headers .="X-MSMail-Priority : High\n";
    $headers .="Importance : High\n";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    //$from="sptp@noreply.com";
//$headers .= 'From: '.$from."\r\n";


    // the message
    $msg='<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title></title><meta name="viewport" content="width=device-width, initial-scale=1.0"></head><div id="wrapper" style="width: 100%;position: static;"><header style="text-align : center;color: white; margin-top: -1%;border-bottom: solid 2px lightgray;background-color: #4CAF50;"><br /><h2 id="title">STUDENT PLACEMENT TRAINING</h2><br /></header></div><body><div style="margin-left: 10%; margin-right: 10%"><h4>Hey '.$firstname.',</h4><p>Thank you for creating new account at <b>student placement training</b>...</p><br /><br /><br />Happy coding,<br />By sptp-team.<br /></div></body><footer style="display: inline;border-top: solid 2px lightgray;background-color: #4CAF50;"><div align="center" style="white-space: normal; background-color: #4CAF50;"><p style="font-size: large; color: white"><br />&copy; student placement training program 2017</p><br /></div></footer></html>
';

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);

    // send email
     mail($email,"New Account",$msg,$headers);
}


// register new user
if(isset($_POST))
{

    // get user data present in json
    $user_info=json_decode(json_encode($_POST),true);

    //check data recieved from user
    if(!isset($user_info['register_token']) || !isset($user_info['firstname']) || !isset($user_info['lastname']) || !isset($user_info['usn']) || !isset($user_info['sem']) || !isset($user_info['email']) || !isset($user_info['password']) || !isset($user_info['confpassword']))
    {
        reload();
    }

    //check token
    if($user_info['register_token']!==$_SESSION['session_token'])
    {
        reload();       // reload if form token doesn't mathes to avoid csrf " cross site remote forgery"
    }


    //take the data camefrom user in json format
    $firstname=$user_info['firstname'];
    $lastname=$user_info['lastname'];
    $usn=$user_info['usn'];
    $sem=$user_info['sem'];
    $email=$user_info['email'];
    $password=$user_info['password'];
    $confpassword=$user_info['confpassword'];

    //convert usn to upper characters
    $usn=strtoupper($usn);

    if($firstname!="" && $lastname!="" && $usn!="" && $sem!="" && $email!="" && $password!="" && $confpassword!="" && $password===$confpassword && (strpos($usn,'2SD')!==false) && ((strpos($email,'@gmail.com')!==false) || (strpos($email,'@yahoo.com')!==false) ))
    {
        $myconnect=new connect();
        $myconnect->setconnection();
        if(ctype_alnum($firstname) && (strlen($firstname)<=20) && ctype_alnum($lastname) && (strlen($lastname)<=20) && ctype_alnum($usn) && (strlen($usn)==10) && ctype_alnum($sem) && (strlen($sem)==1) && $sem<9 && $sem >0)
        {
            $firstname=makesafe($myconnect->getconnection(),$firstname);
            $lastname=makesafe($myconnect->getconnection(),$lastname);
            $usn=makesafe($myconnect->getconnection(),$usn);


            $sem=makesafe($myconnect->getconnection(),$sem);
        }
        else
        {
            $myconnect->terminate();
            reg_suspect($firstname,$lastname,$usn,$sem,$email);
            reload();
        }

        if((filter_var($email,FILTER_VALIDATE_EMAIL)!==false) )
        {
            $email=makesafe($myconnect->getconnection(),$email);
            $password=makesafe($myconnect->getconnection(),$password);
        }
        else
        {
            $myconnect->terminate();
            reg_suspect($firstname,$lastname,$usn,$sem,$email);
            reload();
        }


        $conn=$myconnect->getconnection();


        //create the prepared statement
        $stmt=$conn->prepare("insert into userlogin (firstname,lastname,usn,sem,email,password,status) values (?,?,?,?,?,?,?)");

        //hash the password
        $hash_password=password_hash($password,PASSWORD_DEFAULT);

        $user_status='unblock';
        // bind the obtained parameters
        $stmt->bind_param("sssssss",$firstname,$lastname,$usn,$sem,$email,$hash_password,$user_status);

        //execute the query
        if($stmt->execute())
        {
          //  send_mail($firstname,$email);
            $login_id=$_SESSION['logged']= md5(uniqid());;
            $_SESSION['user_firstname']=$firstname;
            $_SESSION['user_lastname']=$lastname;
            $_SESSION['user_usn']=$usn;
            $_SESSION['user_sem']=$sem;
            $_SESSION['user_email']=$email;
            $_SESSION['user_year']=get_year($fetch_sem);

            initialise_user_stat($usn,$conn);
            // create a array to send status to the ajax script
            $user_info=["mail"=>$_SESSION['user_email'],"redirect"=>"welcome.php?ltgt=".$login_id."&encode=UTF-8&mailid=".$_SESSION['user_email'],"error"=>"false"];
            $_SESSION['home']=$user_info['redirect'];
            //send data in json "javascript object notation format"
            echo json_encode($user_info);
            exit(); // stop executing further script
        }
        else
        {

            $error=$stmt->error;
            if(strpos($error,"Duplicate entry")!==false)
            {
                reg_suspect($firstname,$lastname,$usn,$sem,$email);
                $error=["error"=>"Account with same credentials already exists."];
                echo json_encode($error);
            }
            else
            {
              $error=["error"=>"Oops! something went wrong , please try again."];
              echo json_encode($error);
            }
        }
        $stmt->close();
        $myconnect->terminate();
        exit();


    }
    else
    {
        reg_suspect($firstname,$lastname,$usn,$sem,$email);
        reload();
    }
}
else
{
    reload();
}


ob_flush();
ob_clean();

?>
