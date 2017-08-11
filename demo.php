<?php

require("connect.php");
$myconnect=new connect();
$myconnect->setconnection();

$conn=$myconnect->getconnection();

$file = fopen('DSA1.csv', 'r');
$i=1;
$question="";
$op1="";
$op2="";
$op3="";
$op4="";
$ans="";
$j=1;


function makesafe($conn,$var)
{
    $var=htmlentities(trim(stripslashes($var)), ENT_NOQUOTES, "UTF-8");
    $var=mysqli_real_escape_string($conn,$var);
    return $var;
}

while (($line = fgetcsv($file)) !== FALSE) {

      if($i==7)
      {

        $question = substr($question, 3);
        $op1 = substr($op1, 3);
        $op2 = substr($op2, 3);
        $op3 = substr($op3, 3);
        $op4 = substr($op4, 3);
        $ans=strtolower($ans);

        $question=makesafe($conn, $question);
        $op1=makesafe($conn, $op1);
        $op2=makesafe($conn, $op2);
        $op3=makesafe($conn, $op3);
        $op4=makesafe($conn, $op4);
        $ans=makesafe($conn, $ans);





        $query="insert into ads_questions values ($j,'$question','$op1','$op2','$op3','$op4','$ans')";
        if(!mysqli_query($conn,$query))
        {
          echo mysqli_error($conn)."<br />";
        }
        $i=1;
        $j++;
      }



      if($i==1)
      {
        $question =$line[0];
      }
      else if($i==2)
      {
        $op1 =$line[0];
      }
      else if($i==3)
      {
        $op2 =$line[0];
      }
      else if($i==4)
      {
        $op3 =$line[0];
      }
      else if($i==5)
      {
        $op4 =$line[0];
      }
      else if($i==6)
      {
        $ans =$line[0];
      }

      $i++;

}
echo "completed";
fclose($file);


 ?>
