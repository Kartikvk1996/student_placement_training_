<?php
//require("is_logged_sub_pages.php");
require_once("connect.php");
header('Content-Type: application/json');
if(isset($_GET))
{
  if(isset($_GET['usn']) && strlen($_GET['usn'])==10)
  {

    $usn=$_GET['usn'];
    $myconnect=new connect();
    $myconnect->setconnection();

    $conn=$myconnect->getconnection();
    $usn=makesafe($conn, $usn);


      $course="ads_test_info";
      $res;$output;$output1;$output2;

      $query="select * from user_test_info where usn='$usn'";
      $res=mysqli_query($conn,$query);

      $myout=mysqli_fetch_array($res);
      $ads_test_no=$myout['last_ads_test'];
      $oop_test_no=$myout['last_oop_test'];
      $aptitude_test_no=$myout['last_aptitude_test'];


      $score=array(5);
      $query="select * from $course where usn='$usn'";
      $result=mysqli_query($conn,$query);
      if(mysqli_num_rows($result)>0)
      {
        $i=0;
        while($row=mysqli_fetch_assoc($result))
        {
            $score[$i]=$row['score'];
            $i++;
        }
        $score_aligned=array(5);
        $offset=$ads_test_no%5;
        $offset++;
        for($ittr=0;$ittr<5;$ittr++)
        {
          if($offset>4)
          {
            $offset=0;
          }
          $score_aligned[$ittr]=$score[$offset];
          $offset++;

        }


       $output=["test_1"=>$score_aligned[0],"test_2"=>$score_aligned[1],"test_3"=>$score_aligned[2],"test_4"=>$score_aligned[3],"test_5"=>$score_aligned[4]];
      }

      $course="oop_test_info";
      $query="select * from $course where usn='$usn'";
      $result=mysqli_query($conn,$query);
      if(mysqli_num_rows($result)>0)
      {
        $i=0;
        while($row=mysqli_fetch_assoc($result))
        {
            $score[$i]=$row['score'];
            $i++;
        }
        $score_aligned=array(5);
        $offset=$oop_test_no%5;
        $offset++;
        for($ittr=0;$ittr<5;$ittr++)
        {
          $score_aligned[$ittr]=$score[$offset];
          $offset++;
          if($offset>4)
          {
            $offset=0;
          }
        }


       $output1=["test_1"=>$score_aligned[0],"test_2"=>$score_aligned[1],"test_3"=>$score_aligned[2],"test_4"=>$score_aligned[3],"test_5"=>$score_aligned[4]];
      }

      $course="aptitude_test_info";
      $query="select * from $course where usn='$usn'";
      $result=mysqli_query($conn,$query);
      if(mysqli_num_rows($result)>0)
      {
        $i=0;
        while($row=mysqli_fetch_assoc($result))
        {
            $score[$i]=$row['score'];
            $i++;
        }
        $score_aligned=array(5);
        $offset=$aptitude_test_no%5;
        $offset++;
        for($ittr=0;$ittr<5;$ittr++)
        {
          $score_aligned[$ittr]=$score[$offset];
          $offset++;
          if($offset>4)
          {
            $offset=0;
          }
        }


       $output2=["test_1"=>$score_aligned[0],"test_2"=>$score_aligned[1],"test_3"=>$score_aligned[2],"test_4"=>$score_aligned[3],"test_5"=>$score_aligned[4]];
      }

      $query="select * from user_test_info where usn='$usn'";
      $result=mysqli_query($conn,$query);
      $row=mysqli_fetch_array($result);

      $main_result=["algorithm_datastructure"=>$output,"oop"=>$output1,"aptitude"=>$output2];
      $myscore=["ads"=>$row['ads'],"ads_avg"=>$row['ads_avg'],"oop"=>$row['oop'],"oop_avg"=>$row['oop_avg'],"aptitude"=>$row['aptitude'],"aptitude_avg"=>$row['aptitude_avg']];
      $res=["usn"=>$usn,"statistics"=>$main_result,"overall_score"=>$myscore];
      echo json_encode($res,JSON_PRETTY_PRINT);


  }
}
else
{
  echo "{error:no_usn}";
}


function makesafe($conn,$var)
{
    $var=htmlentities(trim(stripslashes($var)), ENT_NOQUOTES, "UTF-8");
    $var=mysqli_real_escape_string($conn,$var);
    return $var;
}
 ?>
