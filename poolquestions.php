<?php
//this module fetches the questions from the database w.r.t company selected

ob_start();

// load script that connects to database
require_once("connect.php");

// check user is logged or not
require("is_logged_sub_pages.php");

// tell brower that output data is in json0
header("content-type:application/json");

// below code fetches the question based on selected company
if(ISSET($_GET["view"]))
{
        $company=$_GET['company'];

        // connect to database
        $myconnect=new connect();
        $myconnect->setconnection();

        // check the input data , is alpha-numeric or not
        if(ctype_alnum($company) && $company!="Company")
        {
            // make the input value safe
            $company=makesafe($myconnect->getconnection(),$company);
        }
        else {
          // terminate the connection
          $myconnect->terminate();
          exit(0);
        }

         $conn=$myconnect->getconnection();

         // query that selects the question from db
         $sql="select question,answer,company from question_pool where company='$company'";
         $result=mysqli_query($conn,$sql);
         if ($result->num_rows > 0)
         {

            $i=0;
            $output=array();
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) // fetch all questions
            {
                    $output[]=$row; // store it in array0
            }
            $output=["status"=>"ok","questions"=>$output];
        	  echo json_encode($output,JSON_PRETTY_PRINT); // output the result

          }
          else
          {
             $output=["status"=>"no questions found"];
             echo json_encode($output,JSON_PRETTY_PRINT);
          }
}
else
{
echo "error";
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
