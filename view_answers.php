<?php
// this module displays the answer to the questions

// check user is logged or not
require("is_logged_sub_pages.php");

// configure server date to asia
date_default_timezone_set("Asia/Kolkata");

// load module that connects to database
require_once("connect.php");

// output the data in JSON format
header('Content-Type: application/json');

if(isset($_POST['get_answers']))
{
  // connect to database
  $myconnect=new connect();
  $myconnect->setconnection();
  $conn=$myconnect->getconnection();

  $course_id=0;
  $course=$_POST['course'];
  $usn=$_SESSION['user_usn'];
  $query="";
  if($course=="ads")
  {
    $course_id=1;
    $query="select * from user_test_info ur,track_test t where ur.last_ads_test=t.ads_test_no and ur.usn='$usn'";
  }
  else if($course=="oop")
  {
    $course_id=2;
    $query="select * from user_test_info ur,track_test t where ur.last_oop_test=t.oop_test_no and ur.usn='$usn'";
  }
  else if($course=="aptitude")
  {
    $course_id=3;
    $query="select * from user_test_info ur,track_test t where ur.last_aptitude_test=t.aptitude_test_no and ur.usn='$usn'";
  }

  if($course_id>0 && $result=mysqli_query($conn,$query))
  {
    if($result->num_rows > 0)
    {
      $output=["status"=>"you cannot view answer"];
      $myconnect->terminate();
      echo json_encode($output ,JSON_PRETTY_PRINT);
      exit(0);
    }
    else
    {
        $query="select * from user_test_info where usn='$usn' limit 1";
        $result=mysqli_query($conn,$query);
        $row=mysqli_fetch_array($result);
        $ads_test=$row['last_ads_test'];
        $oop_test=$row['last_oop_test'];
        $aptitude_test=$row['last_aptitude_test'];

        if($course_id==1)
        {
          $query="select question,option1,option2,option3,option4,answer from ads_questions where sl_no>=$ads_test and sl_no<=$ads_test+10";
        }
        else if($course_id==2)
        {
          $query="select question,option1,option2,option3,option4,answer from oop_questions where sl_no>=$oop_test and sl_no<=$oop_test+10";
        }
        else if($course_id==3)
        {
          $query="select question,option1,option2,option3,option4,answer from aptitude_questions where sl_no>=$aptitude_test and sl_no<=$aptitude_test+10";
        }

        $output=array();
        if($result=mysqli_query($conn,$query))
        {
          while($row=mysqli_fetch_assoc($result))
          {
            $output[]=$row;
          }
          $result=["status"=>$output];
          $myconnect->terminate();
          echo json_encode($result ,JSON_PRETTY_PRINT);
          exit();
        }
        else {
          $result=["status"=>"unable to fetch answers for the questions"];
          $myconnect->terminate();
          echo json_encode($result ,JSON_PRETTY_PRINT);
          exit();
        }
    }
  }
  else {
    $result=["status"=>"error"];
    $myconnect->terminate();
    echo json_encode($result ,JSON_PRETTY_PRINT);
    exit();
  }

}


 ?>
