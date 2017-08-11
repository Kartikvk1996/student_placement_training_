<?php

// check user is logged or not
require("is_logged_sub_pages.php");

// configure server date to asia
date_default_timezone_set("Asia/Kolkata");

// load module that connects to database
require_once("connect.php");

// output the data in JSON format
header('Content-Type: application/json');

// function to make string safe wrt database
// take string as argument
function makesafe($conn,$var)
{
    $var=htmlentities(trim(stripslashes($var)), ENT_NOQUOTES, "UTF-8");
    $var=mysqli_real_escape_string($conn,$var);
    return $var;
}

// on click of course button
// modules that gets questions from database
if(isset($_GET))
{
  $year=$_SESSION['user_year'];
  if(isset($_GET['course']))
  {
    $course=$_GET['course'];
    $usn=$_SESSION['user_usn'];

    // connect to database
    $myconnect=new connect();
    $myconnect->setconnection();
    $conn=$myconnect->getconnection();

    // make course safe
    $course=makesafe($conn, $course);


    $table="";
    $course_id=0; // to navigate between offered course
    if($course=="ads")
    {
      $course_id=1;
      $table="ads_questions";
    }
    elseif($course=="aptitude")
    {
      $course_id=2;
      $table="aptitude_questions";
    }
    elseif($course=="oop")
    {
      $course_id=3;
      $table="oop_questions";
    }
    else
    {

    }
    $row=NULL;

    $query="select * from track_test where year=$year"; // get date and test_no of particular course
    if($res=mysqli_query($conn,$query))
    {
      $row=mysqli_fetch_array($res);
    }
    $aptitude_test=$row['aptitude_test_no'];
    $oop_test=$row['oop_test_no'];
    $ads_test=$row['ads_test_no'];

    $ads_next_date=$row['ads_test_date'];
    $oop_next_date=$row['oop_test_date'];
    $aptitude_next_date=$row['aptitude_test_date'];

    $current_date=date("d/m/Y");
    $initial_offset=-1;
    $final_offset=-1;

    $jump=0;
    $table_select=null;
    $update_query=null;
    $update_query1=null;


    $check_access=null;


    if($course_id==1)
    {
      if($current_date>$ads_next_date)  // if no new test is scheduled by teacher
      {
        $output=["status"=>"no new test"];
        echo json_encode($output,JSON_PRETTY_PRINT);
        $myconnect->terminate();
        exit(0);
      }

      else if($current_date<$ads_next_date) // if scheduled test date is not today's date
      {
        $output=["status"=>"next test on $ads_next_date"];
        echo json_encode($output,JSON_PRETTY_PRINT);
        $myconnect->terminate();
        exit(0);
      }

      else // if test date and today's date match
      {
        $table_select="ads_test_info";
        $jump=$ads_test%5;
        $initial_offset=$ads_test*10;
        $final_offset=$initial_offset+10;
        $update_query="update user_test_info set last_ads_test=$ads_test where usn='$usn'";
        $update_query1="update user_test_info set ads=ads+1 where usn='$usn'";

        $check_access="select usn from user_test_info where last_ads_test=$ads_test and usn='$usn'";

      }
    }
    elseif($course_id==2)
    {

      if($current_date>$aptitude_next_date) // if no new test is scheduled by teacher
      {
        $output=["status"=>"no new test"];
        echo json_encode($output,JSON_PRETTY_PRINT);
        $myconnect->terminate();
        exit(0);
      }
      else if($current_date<$aptitude_next_date)  // if scheduled test date is not today's date
      {
        $output=["status"=>"next test on $aptitude_next_date"];
        echo json_encode($output,JSON_PRETTY_PRINT);
        $myconnect->terminate();
        exit(0);
      }
      else// if test date and today's date match
      {
        $table_select="aptitude_test_info";
        $jump=$aptitude_test%5;
        $initial_offset=$aptitude_test*10;
        $final_offset=$initial_offset+10;
        $update_query="update user_test_info set last_aptitude_test=$aptitude_test where usn='$usn'";
        $update_query1="update user_test_info set aptitude=aptitude+1 where usn='$usn'";

        $check_access="select usn from user_test_info where last_aptitude_test=$aptitude_test and usn='$usn'";
      }

    }
    elseif($course_id==3)
    {
      if($current_date>$oop_next_date)  // if no new test is scheduled by teacher
      {
        $output=["status"=>"no new test"];
        echo json_encode($output,JSON_PRETTY_PRINT);
        $myconnect->terminate();
        exit(0);
      }
      else if($current_date<$oop_next_date) // if scheduled test date is not today's date
      {
        $output=["status"=>"next test on $oop_next_date"];
        echo json_encode($output,JSON_PRETTY_PRINT);
        $myconnect->terminate();
        exit(0);
      }
      else // if test date and today's date match
      {
        $table_select="oop_test_info";
        $jump=$oop_test%5;
        $initial_offset=$oop_test*10;
        $final_offset=$initial_offset+10;
        $update_query="update user_test_info set last_oop_test=$oop_test where usn='$usn'";
        $update_query1="update user_test_info set oop=oop+1 where usn='$usn'";

        $check_access="select usn from user_test_info where last_oop_test=$oop_test and usn='$usn'";
      }
    }
    else
    {

    }

    // check user already attempted the test or not
    if($course_id!=0 && $res=mysqli_query($conn,$check_access))
    {
      if(mysqli_num_rows($res)>0)
      {
        $output=["status"=>"attempted"];
        echo json_encode($output);
        $myconnect->terminate();
        exit(0);
      }

    }


    // if not attempted set score to this test to 0 indicating that user has attempted the test
    $query="update $table_select set score=0 where test_no=$jump+1";
    if($course_id!=0 && !mysqli_query($conn,$query))
    {
      exit(0);
    }

    if($course_id!=0 && !mysqli_query($conn,$update_query))
    {
      exit(0);
    }

    if($course_id!=0 && !mysqli_query($conn,$update_query1))
    {
      exit(0);
    }

    // fetch the question from respective course
    $query="select sl_no,question,option1,option2,option3,option4 from $table where sl_no>=$initial_offset and sl_no<=$final_offset";

    if($course_id!=0 && $res=mysqli_query($conn,$query))
    {
      $output=array();

      while($row=mysqli_fetch_assoc($res))
      {
        $output[]=$row;
      }
    //  shuffle($output);
      $out=["status"=>$output];
      echo json_encode($out,JSON_PRETTY_PRINT); // output the question

    }
    else
    {
      $output=["status"=>"unable to fetch questions invalid course"];
      echo json_encode($output);
    }


    $myconnect->terminate();
    exit(0);


  }
}
else
{
  exit(0);
}


?>
