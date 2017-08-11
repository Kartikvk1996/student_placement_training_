<?php

ob_start();
header("Content-Type:application/json");
require_once("connect.php");
session_start();
if(isset($_GET['filter']) && isset($_GET['course']))
{
  $myconnect=new connect();
  $myconnect->setconnection();
  $conn=$myconnect->getconnection();
  $recent=$_GET['filter'];
  $course=$_GET['course'];
  $sem=$_SESSION['user_sem'];
  $year=$_SESSION['user_year'];
  if($recent=="off")
  {
    $check=1;
    if($course=="ads")
    {
      $query="select u.firstname,u.lastname,u.usn,ur.ads_avg from user_test_info ur, userlogin u where u.usn=ur.usn and u.sem='$sem' order by ur.ads_avg desc";
    }
    else if($course=="oop")
    {
          $query="select u.firstname,u.lastname,u.usn,ur.oop_avg from user_test_info ur, userlogin u where u.usn=ur.usn and u.sem='$sem' order by ur.oop_avg desc";
    }
    else if($course=="aptitude")
    {
      $query="select u.firstname,u.lastname,u.usn,ur.aptitude_avg from user_test_info ur, userlogin u where u.usn=ur.usn and u.sem='$sem' order by ur.aptitude_avg desc";
    }
    else
    {
      $check=0;
    }

    if($check==1)
    {
      $output=array();
      if($res=mysqli_query($conn,$query))
      {
        while($row=mysqli_fetch_assoc($res))
        {
          $output[]=$row;
        }
        $out=["status"=>"ok","error"=>"null","filter"=>"yes","result"=>$output];
        echo json_encode($out,JSON_PRETTY_PRINT);
      }
      else
      {
        $out=["status"=>"false","error"=>"unable to fetch questions","filter"=>"yes","result"=>"null"];
        echo json_encode($out,JSON_PRETTY_PRINT);
      }
    }
  }
  else if($recent=="on")
  {
    $check=1;
    if($course=="ads")
    {
      $query="select u.firstname,u.lastname,u.usn,ur.last_ads_test_score from userlogin u,user_test_info ur,track_test t where t.year=$year and u.usn=ur.usn and t.ads_test_no-1=ur.last_ads_test and u.sem='$sem' order by ur.last_ads_test_score desc";
    }
    else if($course=="oop")
    {
      $query="select u.firstname,u.lastname,u.usn,ur.last_oop_test_score from userlogin u,user_test_info ur,track_test t where t.year=$year and u.usn=ur.usn and t.oop_test_no-1=ur.last_oop_test and u.sem='$sem' order by ur.last_oop_test_score desc";

    }
    else if($course=="aptitude")
    {
      $query="select u.firstname,u.lastname,u.usn,ur.last_aptitude_test_score from userlogin u,user_test_info ur,track_test t where t.year=$year and u.usn=ur.usn and t.aptitude_test_no-1=ur.last_aptitude_test and u.sem='$sem' order by ur.last_aptitude_test_score desc";

    }
    else {
      $check=0;

    }

    if($check==1)
    {
      $output1=array();
      if($res=mysqli_query($conn,$query))
      {
        while($row=mysqli_fetch_assoc($res))
        {
          $output1[]=$row;
        }
        $out=["status"=>"ok","error"=>"null","filter"=>"no","result"=>$output1];
        echo json_encode($out,JSON_PRETTY_PRINT);
      }
      else
      {
        $out=["status"=>"connection error","error"=>"unable to fetch questions","filter"=>"no","result"=>"null"];
        echo json_encode($out,JSON_PRETTY_PRINT);
      }
    }
    else
    {
      $out=["status"=>"course error","error"=>"choose proper course","filter"=>"no","result"=>"null"];
      echo json_encode($out,JSON_PRETTY_PRINT);
    }
  }
  else
  {
    $out=["status"=>"false","error"=>"choose proper course","filter"=>"yes","result"=>"null"];
    echo json_encode($out,JSON_PRETTY_PRINT);
  }
    $myconnect->terminate();
    exit(0);
}
else
{
  $out=["status"=>"course error","error"=>"choose proper course","filter"=>"null","result"=>"null"];
  echo json_encode($out,JSON_PRETTY_PRINT);
}

?>
