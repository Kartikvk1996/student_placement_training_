<?php
ob_start();

// load module that connects to database
require_once("connect.php");

// check user is logged or not
require("is_logged_sub_pages.php");

// below code insert question and answer to question with user usn
if(isset($_POST['question']) && isset($_POST['answer']))
{
    // store the values in temporary variables
    $question=$_POST['question'];
    $answer=$_POST['answer'];
    $company=$_POST['company'];
    $usn=$_SESSION['user_usn'];

    // check question and answer is not left blank
    if($question!="" && $answer!=""&& $company!="")
    {
        // connect to database
        $myconnect=new connect();
        $myconnect->setconnection();

        // check question and answer contains only alpha-numeric characters
        if(ctype_alnum($question) && (strlen($question)<=75) && ctype_alnum($answer) && (strlen($answer)<=75) &&ctype_alnum($company) && $company!="Company")
        {
            // make the valus safe
            $question=makesafe($myconnect->getconnection(),$question);
            $answer=makesafe($myconnect->getconnection(),$answer);
            $company=makesafe($myconnect->getconnection(),$company);
        }

         $conn=$myconnect->getconnection();

        //create the prepared statement
        $stmt=$conn->prepare("insert into question_pool(usn,question,answer,company) values (?,?,?,?)");
        $stmt->bind_param("ssss",$usn,$question,$answer,$company);

        //execute the query
        if($stmt->execute())
        {
            $myconnect->terminate();
            $status=["status"=>"success"];
            echo json_encode($status,JSON_PRETTY_PRINT);
            exit(); // stop executing further script*/
        }
        else
        {
            $myconnect->terminate();
	          $status=["status"=>"failed"];
            echo json_encode($status,JSON_PRETTY_PRINT);
            $error=$stmt->error;
        }
    }
    else
    {
      $status=["status"=>"empty values"];
      echo json_encode($status,JSON_PRETTY_PRINT);
    }
}
else
{
    $status=["status"=>"error"];
    echo json_encode($status,JSON_PRETTY_PRINT);
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
