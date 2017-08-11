`	<?php

ob_start();
session_start();
require_once("connect.php");


// register new user
if(isset($_POST))
{

    // get user data present in json
    $user_info=json_decode(json_encode($_POST),true);


    //check data recieved from user
    if(!isset($user_info['firstname']) || !isset($user_info['lastname']) || !isset($user_info['tid']) || !isset($user_info['email']) || !isset($user_info['password']) || !isset($user_info['confpassword']))
    {
        reload();
    }


    //take the data camefrom user in json format
    $firstname=$user_info['firstname'];
    $lastname=$user_info['lastname'];
    $tid=$user_info['tid'];
    $email=$user_info['email'];
    $password=$user_info['password'];
    $confpassword=$user_info['confpassword'];
 //convert usn to upper characters
    $tid=strtoupper($tid);

    if($firstname!="")
    {
        $myconnect=new connect();
        $myconnect->setconnection();


        if(ctype_alnum($firstname) && (strlen($firstname)<=20) && ctype_alnum($lastname) && (strlen($lastname)<=20) && ctype_alnum($tid) && (strlen($tid)==8) )
        {
            $firstname=makesafe($myconnect->getconnection(),$firstname);
            $lastname=makesafe($myconnect->getconnection(),$lastname);
            $tid=makesafe($myconnect->getconnection(),$tid);
        }
        else
        {
            $myconnect->terminate();
            reg_suspect($firstname,$lastname,$tid,$email);

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
            reg_suspect($firstname,$lastname,$tid,$email);

            reload();
        }
        $conn=$myconnect->getconnection();


        //hash the password
        $hash_password=password_hash($password,PASSWORD_DEFAULT);
        //execute the query
        $query="insert into userlogin (firstname,lastname,usn,email,password,status) values ('$firstname','$lastname','$tid','$email','$hash_password','unblock')";
        echo $query;
        if($result=mysqli_query($conn,$query))
        {
            $row=mysqli_fetch_array($result);
            //send_mail($firstname,$email);
            $login_id=$_SESSION['logged']= md5(uniqid());;
            $_SESSION['user_firstname']=$firstname;
            $_SESSION['user_lastname']=$lastname;
            $_SESSION['user_usn']=$tid;
            $_SESSION['sem']='';
            $_SESSION['user_email']=$email;
            $myconnect->terminate();


            echo "<script>window.location='teachers.php';</script>";

            exit(); // stop executing further script
        }
         else
        {
            $error=mysqli_error($conn);
            if(strpos($error,"Duplicate entry")!==false)
            {
               reg_suspect($firstname,$lastname,$tid,$email);
                echo "<script>alert('Account with same credential already exists.');</script>";
            }
            else
            {
                echo "<script>alert('Oops! something went wrong , please try again.');</script>";
            }
            $myconnect->terminate();
        }


    }

 else
    {
         reg_suspect($firstname,$lastname,$tid,$email);
         echo "error in filling form";
         reload();
    }
}
else
{
    reload();
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

function register_log($filename,$firstname,$lastname,$tid,$email)
{
    $path=$filename;
    date_default_timezone_set("Asia/Kolkata");
    $myfile = fopen($path,"a") or die("Failed");
    $text="[ ".get_client_ip()."    ".$firstname."    ".$lastname."    ".$tid."    ".$email."    ".date('d/m/Y h:i:s a', time())." ]\n";
    fwrite($myfile, $text);
    fclose($myfile);
}

// breaking the code
function reg_suspect($firstname,$lastname,$tid,$email)
{
    register_log('register_log_file.txt',$firstname,$lastname,$tid,$email);
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
