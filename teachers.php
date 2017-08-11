<?php

// load module that connects to database
require("connect.php");

// check user is logged or not
require("is_logged_sub_pages.php");

if(isset($_SESSION['teacher_logged']) && $_SESSION['teacher_logged']=="true")
{

}
else {
  reload();
}


if(isset($_POST['logout']) && $_POST['logout']==="logout_user")
{
    session_unset();
    session_destroy();
    reload();
}

?>
<html>
<head>
    <title>Welcome Teachers</title>
    <meta charset="utf-8">
    <meta name="description" content="student placement training program">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/header_footer.css">
</head>
<div id="wrapper">
    <header><br />
        <h2 id="title">STUDENT PLACEMENT TRAINING</h2>
        <br />
    </header>
</div>
<style>
    .sidenav {
        height: 130%;
        width: 250px;
        position: relative;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #f1f1f1;
        overflow-x: hidden;
        transition: 0.7s;
        padding-top: 30px;
    }

    .sidenav a {
        padding: 8px 8px 8px 15px;
        text-decoration: none;
        font-size: 15px;
        color: #818181;
        display: block;
        transition: 0.3s;
        text-align: left;
    }

    #nav_topics
    {
      margin-left: 10%;
      line-height: 10px;
    }

    #__user
    {
      padding: 8px 8px 8px 16px;
      text-decoration: none;
      font-size: 15px;
      color: black;
      display: block;
      text-align: left;
      transition:0.5s;
    }

    #__user:hover
    {
      color: white;
      transition:0.7s;
    }

    .sidenav a:hover, .offcanvas a:focus{
        color: #000000;
        background-color: #4CAF50;
        transition: 0.5s
    }



    #main {
        transition: margin-left .5s;
        padding: 16px;
    }

    @media screen and (max-device-width: 1080px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
        .sidenav {width: 100%;}
        .sidenav {height: 50%;}
        #site_info{ margin-top: 100%;
        margin-left: 0%;}
    }

    #contents a
    {
        padding: 3%;
        transition: 1s;
    }

    #contents a:hover,#contents a:focus
    {
        opacity: 0.6;
        transition: 1s;
    }

    img
    {
        border: solid gray 1px;
        padding: 1%;
        box-shadow: #2e3436 1px 1px 13px;
    }

    #site_info
    {
        border: solid 1px black;
        text-align: center;
        font-family: sans-serif;
        background-color: ;
        box-shadow: black 2px 2px 2px;
        padding: 2%;
        margin-right: 5%;
        margin-left: 21%;
    }


</style>
<body>
<div  style=" clear: both; float: left"  id="mySidenav" class="sidenav">
    <a id="__user"><?php if(isset($_SESSION['user_email'])){  echo $_SESSION['user_email']; }?></a><br/><hr /><br/>

  </br/>
    <a href="myprofile.php">Manage profile</a>
    <a href="statistics.php">My statistics</a>
    <a href="#" id="scoreboard">Scoreboard</a>
    <div id="nav_topics" style="display:none">
      <a href="scoreboard.php?course=ads">DS and Algorithms</a>
      <a href="scoreboard.php?course=oop">O.O.Programming</a>
      <a href="scoreboard.php?course=aptitude">Aptitude Skills</a>
    </div>
    <a href="question_pool.php" id="scoreboard">Question pool</a>
    <a href="#" name="logout" onclick="logout();">logout</a>
</div>

<br />
<br />
<div align="center">
  <h2>Select the semester to see scoreboard</h2>
  <form method="post" action="teachers.php">
    <select id="sem" name="sem">
        <option>Sem</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
    </select>
    <input type="submit" value="set semister" name="set_sem" />
  </form>
  <p id="selected_sem">

  </p>
</div>

<div align="center" style="margin-top:10%">
  <h2 id="status"></h2>
  <h2>Set Algorithm and datasctructure test date</h2>
  <form method="post" action="teachers.php">
    Date :
    <input type="text" placeholder="dd/mm/yyyy"  name="ads_date"/>
    <select id="year" name="year">
        <option>Year</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
    </select>
    <input type="submit" value="conduct test" name="set_ads" />
  </form>

  <h2>Set Object oriented programming test date</h2>
  <form method="post" action="teachers.php">
    Date :
    <input type="text" placeholder="dd/mm/yyyy"  name="oop_date"/>
    <select id="year" name="year">
        <option>Year</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
    </select>
    <input type="submit" value="conduct test" name="set_oop" />
  </form>

  <h2>Set aptitude test date</h2>
  <form method="post" action="teachers.php">
    Date :
    <input type="text" placeholder="dd/mm/yyyy"  name="aptitude_date"/>
    <select id="year" name="year">
        <option>Year</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
    </select>
    <input type="submit" value="conduct test" name="set_aptitude" />
  </form>
</div>
<br />
<br />

<div align="center">
<h3>Test information</h3>
<table id="examinfo" cellpadding="5"  FRAME="box">
  <tr>
    <td>
      Year
    </td>
    <td>
      Algorithm_datastructure test_date
    </td>
    <td>
      Object oriented programming test_date
    </td>
    <td>
      aptitude test_date
    </td>
  </tr>
</table>
<br />
<br />
<br />
<br />
</div>

<!-- javascript jquery -->
<script src="javascript/jquery-3.1.1.min.js"></script>
<script>
  var click=0;
  $(document).ready(function(){

    $("#site_info").click(function(){
        $("#site_info").hide(700);
    });

    $("#scoreboard").click(function(){
      if(click%2==0)
      {
        $("#nav_topics").show(700);
      }
      else
       {
          $("#nav_topics").hide(700);
        }
        click+=1;
    });
  });

  function logout()
  {
      $.ajax({
        url:"teachers.php",
        type:"post",
        data:{
          logout:"logout_user"
        },
        success:function(data){
              window.location="index.php";
        }
      });
  }

</script>
</body>

<footer style="display: inline;">
    <div class="footer" align="center" style="white-space: normal; background-color: #4CAF50; clear: both">
        <br /><br />
        &emsp;&emsp;&emsp;&emsp;
        <a href="request_new_feature.php" style="color: white;">Request_New_Feature</a>
        &emsp;&emsp;&emsp;&emsp;
        <a href="contact_us.php" style="color: white; ">Contact_us</a>
        &emsp;&emsp;&emsp;&emsp;
        <a href="about.php" style="color: white; ">About</a>
        &emsp;&emsp;&emsp;&emsp;
        <br /><br /><br />
    </div>

</footer>
</html>
<?php
// connect to database
$myconnect=new connect();
$myconnect->setconnection();
$conn=$myconnect->getconnection();

$q="select * from track_test";
$date=array();
if($result=mysqli_query($conn,$q))
{
  while($row=mysqli_fetch_array($result))
  {
    $date[]=$row;
    echo "<script>document.getElementById('examinfo').innerHTML+='<tr><td>".$row['year']."</td><td>".$row['2']."</td><td>".$row['4']."</td><td>".$row['6']."</td></tr><br />'</script>";
  }
}


$current_date=date("d/m/Y");
// function to check test is alrady set or not
function check($year,$course)
{
  global $current_date;
  global $date;
  if($course==1)
  {
    if($year==1)
    {
      if($date[0][2]>=$current_date)
      {
        return false;
      }
      else {
        return true;
      }
    }
    else if($year==2)
    {
      if($date[1][2]>=$current_date)
      {
        return false;
      }
      else {
        return true;
      }
    }
    else if($year==3)
    {
      if($date[2][2]>=$current_date)
      {
        return false;
      }
      else {
        return true;
      }
    }
    else
    {
      if($date[3][2]>=$current_date)
      {
        return false;
      }
      else {
        return true;
      }
    }
  }
  else if($course==1)
  {
    if($year==1)
    {
      if($date[0][4]>=$current_date)
      {
        return false;
      }
      else {
        return true;
      }
    }
    else if($year==2)
    {
      if($date[1][4]>=$current_date)
      {
        return false;
      }
      else {
        return true;
      }
    }
    else if($year==3)
    {
      if($date[2][4]>=$current_date)
      {
        return false;
      }
      else {
        return true;
      }
    }
    else
    {
      if($date[3][4]>=$current_date)
      {
        return false;
      }
      else {
        return true;
      }
    }
  }
  else
  {
    if($year==1)
    {
      if($date[0][6]>=$current_date)
      {
        return false;
      }
      else {
        return true;
      }
    }
    else if($year==2)
    {
      if($date[1][6]>=$current_date)
      {
        return false;
      }
      else {
        return true;
      }
    }
    else if($year==3)
    {
      if($date[2][6]>=$current_date)
      {
        return false;
      }
      else {
        return true;
      }
    }
    else
    {
      if($date[3][6]>=$current_date)
      {
        return false;
      }
      else {
        return true;
      }
    }
  }
}


//on select of ads test
if(isset($_POST['set_ads']) && ctype_digit($_POST['year']))
{
  $dt=$_POST['ads_date'];
  $year=$_POST['year'];

  if(!check($year,1))
  {
      echo "<script>document.getElementById('status').style='color:red'; document.getElementById('status').innerHTML='Test date is already set.'</script>";
  }
  else {
    $query="update track_test set ads_test_date='$dt' where year=$year";
    $query1="update track_test set ads_test_no=ads_test_no+1 where year=$year";
    if(mysqli_query($conn,$query) && mysqli_query($conn,$query1))
    {
      send_mail($conn,$year,"ads",$dt);
      echo "<script>document.getElementById('status').style='color:green'; document.getElementById('status').innerHTML='Next date for ADS exam is set.'</script>";
    }
    else {
      echo "<script>document.getElementById('status').style='color:red'; document.getElementById('status').innerHTML='Unable to set next test date.'</script>";
    }
  }


}

//on select of oop test
if(isset($_POST['set_oop']) && ctype_digit($_POST['year']))
{
  $dt=$_POST['oop_date'];
  $year=$_POST['year'];

  if(!check($year,2))
  {
      echo "<script>document.getElementById('status').style='color:red'; document.getElementById('status').innerHTML='Test date is already set.'</script>";
  }
  else {
    $query="update track_test set oop_test_date='$dt' where year=$year";
    $query1="update track_test set oop_test_no=oop_test_no+1 where year=$year";
    if(mysqli_query($conn,$query) && mysqli_query($conn, $query1))
    {
      send_mail($conn,$year,"oop",$dt);
      echo "<script>document.getElementById('status').style='color:green'; document.getElementById('status').innerHTML='Next date for OOP exam is set.'</script>";
    }
    else {
      echo "<script>document.getElementById('status').style='color:red'; document.getElementById('status').innerHTML='Unable to set next test date.'</script>";
    }
  }

}


//on select of aptitude test
if(isset($_POST['set_aptitude']) && ctype_digit($_POST['year']))
{
  $dt=$_POST['aptitude_date'];
  $year=$_POST['year'];

  if(!check($year,3))
  {
      echo "<script>document.getElementById('status').style='color:red'; document.getElementById('status').innerHTML='Test date is already set.'</script>";
  }
  else {
    $query="update track_test set aptitude_test_date='$dt' where year=$year";
    $query1="update track_test set aptitude_test_no=aptitude_test_no+1 where year=$year";
    if(mysqli_query($conn,$query) && mysqli_query($conn, $query1))
    {
      send_mail($conn,$year,"aptitude",$dt);
      echo "<script>document.getElementById('status').style='color:green'; document.getElementById('status').innerHTML='Next date for Aptitude exam is set.'</script>";
    }
    else {
      echo "<script>document.getElementById('status').style='color:red'; document.getElementById('status').innerHTML='Unable to set next test date.'</script>";
    }
  }

}

if(isset($_POST['set_sem']))
{
  $_SESSION['user_sem']=$_POST['sem'];
  echo "<script>document.getElementById('selected_sem').innerHTML='Semester selected';</script>";
}


function send_mail($conn,$year,$course,$date)
{
  $query="select * from track_test where year=$year";
  $result=mysqli_query($conn,$query);
  $row=mysqli_fetch_array($result);
  $output=array();
  if($course=="ads")
  {
    $ads_test=$row['ads_test_no'];
    $query="select * from ads_questions where sl_no>=$ads_test and sl_no<$ads_test+10";
    $result=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($result))
    {
      $output[]=$row;
    }
  }
  else if($course=="oop")
  {
    $oop_test=$row['oop_test_no'];
    $query="select * from oop_questions where sl_no>=$oop_test and sl_no<$oop_test+10";
    $result=mysqli_query($conn,$query);

    while($row=mysqli_fetch_array($result))
    {
      $output[]=$row;
    }
  }
  else if($course=="ads")
  {
    $aptitude_test=$row['aptitude_test_no'];
    $query="select * from aptitude_questions where sl_no>=$aptitude_test and sl_no<$aptitude_test+10";
    $result=mysqli_query($conn,$query);

    while($row=mysqli_fetch_array($result))
    {
      $output[]=$row;
    }
  }
  else {
    exit(0);
  }


  $headers="X-Priority:1 (Highest)\n";
  $headers .="X-MSMail-Priority : High\n";
  $headers .="Importance : High\n";
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  //$from="sptp@noreply.com";
//$headers .= 'From: '.$from."\r\n";


  // the message
  $msg='<!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      </head>
      <div id="wrapper" style="width: 100%;position: static;">
        <header style="text-align : center;color: white; margin-top: -1%;border-bottom: solid 2px lightgray;background-color: #4CAF50;"><br />
        <h2 id="title">STUDENT PLACEMENT TRAINING</h2><br />
        </header>
      </div>
      <body>
        <div style="margin-left: 10%; margin-right: 10%">
          <h3>Next text questions . </h3><br /><br /><br />
          <table>
            <tr><td><h4>2 ) '.$output[1][1].'<br /></h4></td><td><h5>a . '.$output[1][2].'<br /></h5></td><td><h5>b . '.$output[1][3].'<br /></h5></td><td><h5>c . '.$output[1][4].'<br /></h5></td><td><h5>d . '.$output[1][5].'<br /></h5></td><td><h5>ans . '.$output[1][6].'<br /></h5></td></tr>
            <tr><td><h4>1 ) '.$output[0][1].'<br /></h4></td><td><h5>a . '.$output[0][2].'<br /></h5></td><td><h5>b . '.$output[0][3].'<br /></h5></td><td><h5>c . '.$output[0][4].'<br /></h5></td><td><h5>d . '.$output[0][5].'<br /></h5></td><td><h5>ans . '.$output[0][6].'<br /></h5></td></tr>
            <tr><td><h4>3 ) '.$output[2][1].'<br /></h4></td><td><h5>a . '.$output[2][2].'<br /></h5></td><td><h5>b . '.$output[2][3].'<br /></h5></td><td><h5>c . '.$output[2][4].'<br /></h5></td><td><h5>d . '.$output[2][5].'<br /></h5></td><td><h5>ans . '.$output[2][6].'<br /></h5></td></tr>
            <tr><td><h4>4 ) '.$output[3][1].'<br /></h4></td><td><h5>a . '.$output[3][2].'<br /></h5></td><td><h5>b . '.$output[3][3].'<br /></h5></td><td><h5>c . '.$output[3][4].'<br /></h5></td><td><h5>d . '.$output[3][5].'<br /></h5></td><td><h5>ans . '.$output[3][6].'<br /></h5></td></tr>
            <tr><td><h4>5 ) '.$output[4][1].'<br /></h4></td><td><h5>a . '.$output[4][2].'<br /></h5></td><td><h5>b . '.$output[4][3].'<br /></h5></td><td><h5>c . '.$output[4][4].'<br /></h5></td><td><h5>d . '.$output[4][5].'<br /></h5></td><td><h5>ans . '.$output[4][6].'<br /></h5></td></tr>
            <tr><td><h4>6 ) '.$output[5][1].'<br /></h4></td><td><h5>a . '.$output[5][2].'<br /></h5></td><td><h5>b . '.$output[5][3].'<br /></h5></td><td><h5>c . '.$output[5][4].'<br /></h5></td><td><h5>d . '.$output[5][5].'<br /></h5></td><td><h5>ans . '.$output[5][6].'<br /></h5></td></tr>
            <tr><td><h4>7 ) '.$output[6][1].'<br /></h4></td><td><h5>a . '.$output[6][2].'<br /></h5></td><td><h5>b . '.$output[6][3].'<br /></h5></td><td><h5>c . '.$output[6][4].'<br /></h5></td><td><h5>d . '.$output[6][5].'<br /></h5></td><td><h5>ans . '.$output[6][6].'<br /></h5></td></tr>
            <tr><td><h4>8 ) '.$output[7][1].'<br /></h4></td><td><h5>a . '.$output[7][2].'<br /></h5></td><td><h5>b . '.$output[7][3].'<br /></h5></td><td><h5>c . '.$output[7][4].'<br /></h5></td><td><h5>d . '.$output[7][5].'<br /></h5></td><td><h5>ans . '.$output[7][6].'<br /></h5></td></tr>
            <tr><td><h4>9 ) '.$output[8][1].'<br /></h4></td><td><h5>a . '.$output[8][2].'<br /></h5></td><td><h5>b . '.$output[8][3].'<br /></h5></td><td><h5>c . '.$output[8][4].'<br /></h5></td><td><h5>d . '.$output[8][5].'<br /></h5></td><td><h5>ans . '.$output[8][6].'<br /></h5></td></tr>
            <tr><td><h4>10 ) '.$output[9][1].'<br /></h4></td><td><h5>a . '.$output[9][2].'<br /></h5></td><td><h5>b . '.$output[9][3].'<br /></h5></td><td><h5>c . '.$output[9][4].'<br /></h5></td><td><h5>d . '.$output[9][5].'<br /></h5></td><td><h5>ans . '.$output[9][6].'<br /></h5></td></tr>
          </table><br /><br />
          Happy coding,<br />By sptp-team.<br /></div></body><footer style="display: inline;border-top: solid 2px lightgray;background-color: #4CAF50;"><div align="center" style="white-space: normal; background-color: #4CAF50;"><p style="font-size: large; color: white"><br />&copy; student placement training program 2017</p><br /></div></footer></html>
';

  // use wordwrap() if lines are longer than 70 characters
  $msg = wordwrap($msg,70);

  $subject = "Next ".$course." Test on ".$date;
  // send email
  $query='select email from userlogin where sem=""';
  $result=mysqli_query($conn,$query);
  while($row=mysqli_fetch_array($result))
  {
    mail($row['email'],$subject,$msg,$headers);
  }

}

$myconnect->terminate();
 ?>
