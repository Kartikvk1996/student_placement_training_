<?php
// this module evaluate the answers submitted by user


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
    $var=htmlentities(trim(stripslashes($var)), ENT_NOQUOTES, "UTF-8"); // convert to uniode-8 format
    $var=mysqli_real_escape_string($conn,$var); // make srting safe
    return $var;
}


// on click of submit button
// modules that evaluate the answer and updates to database
if(isset($_GET['answers']))
{
    $year=$_SESSION['user_year'];
    // get course and usn of user stored in session variable
    $course=$_GET['course'];
    $usn=$_SESSION['user_usn'];

    // connect to database
    $myconnect=new connect();
    $myconnect->setconnection();
    $conn=$myconnect->getconnection();

    // make usn safe
    $usn=makesafe($conn, $usn);

    $table="";
    $course_id=0; // to navigate between offered course
    $score=0;     // initialise score variable to 0
    $table_select=null;
    $jump=0;

    $update_avg=null;
    $update_last_test_score=null;

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
    $query="select * from track_test where year=$year";  // get date and test_no of particular course
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
      }
    }
    elseif($course_id==2)
    {

      // if no new test is scheduled by teacher
      if($current_date>$aptitude_next_date)
      {
        $output=["status"=>"no new test"];
        echo json_encode($output,JSON_PRETTY_PRINT);
        $myconnect->terminate();
        exit(0);
      }
      else if($current_date<$aptitude_next_date) // if scheduled test date is not today's date
      {
        $output=["status"=>"next test on $aptitude_next_date"];
        echo json_encode($output,JSON_PRETTY_PRINT);
        $myconnect->terminate();
        exit(0);
      }
      else // if test date and today's date match
      {

        $table_select="aptitude_test_info";
        $jump=$ads_test%5;
        $initial_offset=$aptitude_test*10;
        $final_offset=$initial_offset+10;

      }

    }
    elseif($course_id==3)
    {
      if($current_date>$oop_next_date)   // if no new test is scheduled by teacher
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
        $jump=$ads_test%5;
        $initial_offset=$oop_test*10;
        $final_offset=$initial_offset+10;
      }
    }
    else
    {
        // do nothing
    }

    // fetch the answers for respective questions
    $query="select answer from $table where sl_no>=$initial_offset and sl_no<=$final_offset";

    if($res=mysqli_query($conn,$query))
    {
      $output=array();

      while($row=mysqli_fetch_array($res))
      {
        $output[]=$row;
      }

      // below code checks the standard answer with users answer and increments the score
      $result=$output[0];
      if(isset($_GET['q0_ans']))
      {
       if($result['answer']==$_GET['q0_ans']){ $score++;}
      }

      $result=$output[1];
      if(isset($_GET['q1_ans']))
      {
       if($result['answer']==$_GET['q1_ans']){ $score++;}
      }

      $result=$output[2];
      if(isset($_GET['q2_ans']))
      {
       if($result['answer']==$_GET['q2_ans']){ $score++;}
      }

      $result=$output[3];
      if(isset($_GET['q3_ans']))
      {
       if($result['answer']==$_GET['q3_ans']){ $score++;}
      }

      $result=$output[4];
      if(isset($_GET['q4_ans']))
      {
       if($result['answer']==$_GET['q4_ans']){ $score++;}
      }

      $result=$output[5];
      if(isset($_GET['q5_ans']))
      {
       if($result['answer']==$_GET['q5_ans']){ $score++;}
      }

      $result=$output[6];
      if(isset($_GET['q6_ans']))
      {
       if($result['answer']==$_GET['q6_ans']){ $score++;}
      }

      $result=$output[7];
      if(isset($_GET['q7_ans']))
      {
       if($result['answer']==$_GET['q7_ans']){ $score++;}
      }

      $result=$output[8];
      if(isset($_GET['q8_ans']))
      {
       if($result['answer']==$_GET['q8_ans']){ $score++;}
      }

      $result=$output[9];
      if(isset($_GET['q9_ans']))
      {
       if($result['answer']==$_GET['q9_ans']){ $score++;}
      }


      // update statistics and average values to database
      if($course_id==1)
      {
        $update_avg="update user_test_info set ads_avg=(ads_avg+$score)/$ads_test where usn='$usn'";
        $update_last_test_score="update user_test_info set last_ads_test_score=$score where usn='$usn'";
      }
      else if($course_id==2)
      {
        $update_avg="update user_test_info set aptitude_avg=(aptitude_avg+$score)/$aptitude_test where usn='$usn'";
        $update_last_test_score="update user_test_info set last_aptitude_test_score=$score where usn='$usn'";
      }
      else {
        $update_avg="update user_test_info set oop_avg=(oop_avg+$score)/$oop_test where usn='$usn'";
        $update_last_test_score="update user_test_info set last_oop_test_score=$score where usn='$usn'";
      }


      // update score in scoreboard
      $query="update $table_select set score=$score where test_no=$jump+1 and usn='$usn'";

      // run the above queries , on fail exit with proper message
      if(!mysqli_query($conn,$query))
      {
        echo mysqli_error($conn);
        exit(0);
      }

      if(!mysqli_query($conn,$update_avg))
      {
        echo mysqli_error($conn);
        exit(0);
      }

      if(!mysqli_query($conn,$update_last_test_score))
      {
        echo mysqli_error($conn);
        exit(0);
      }

      $final_result=["score"=>$score];
      echo json_encode($final_result,JSON_PRETTY_PRINT);

    }
    else
    {
      $output=["status"=>"unable to compute result"];
      echo json_encode($output);
    }

    // terminate connection to database
    $myconnect->terminate();
    exit(0);


  }
else
{
  exit(0);
}
