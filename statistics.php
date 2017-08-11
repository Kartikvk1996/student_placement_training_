<?php

require("is_logged_sub_pages.php");
if(isset($_POST['logout']) && $_POST['logout']==="logout_user")
{
    session_unset();
    session_destroy();
    reload();
}

 ?>
<html>
<head>
    <title>Statistics</title>
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
        height: 160%;
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


        #curve_chart
        {
          width: 78%;
          height:500px;
        }

        #usn
        {
          padding: 10px;
          border: 1px solid #4CAF50;
          width: 20%;
          -webkit-transition: width 0.4s ease-in-out;
          transition: width 0.4s ease-in-out;
        }

        #usn:focus
        {
          width: 50%;
        }


        #_search
        {
          padding: 10px;
        }

    @media screen and (max-device-width: 1080px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
        .sidenav {width: 100%;}
        .sidenav {height: 50%;}
        label,p
        {
          font-size: small;
        }
        #curve_chart
        {
          margin-left: 5%;
          width: 100%;
          height:50%;
        }
        #usn
        {
          margin-top: 5%;
          width: 50%;
          padding: inherit;
        }
        #usn:focus
        {
          width: 80%;
        }

        #_search
        {
          padding: inherit;
        }
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


    #user_info
    {
        padding: 15px;
        border: solid grey 1px;
    }


    .button {
        width: 20%;
        padding: 1%;
        background-color:white;
        color: black;
        white-space: nowrap;
        border-radius: 4px;
        border: solid 1px;
    }


    .button:hover{
      transition: 0.5s;
      background-color: #4CAF50;
      color: white;
    }


    input{
      padding: 3px;
      font-size: 13px;
      background-color: #FFFFFF;
    }

    label,p
    {
        font-family: sans-serif;
    }


    td{
      padding: 2px;
      font-size: 15px;
    }

    #user_profile
    {
        box-shadow: grey 4px 4px 7px;
    }

    #extra a
    {
        text-decoration: underline;
        color: blue;
        font-size: medium;
    }

</style>
<body onload="getdata();">
<div  style=" clear: both; float: left"  id="mySidenav" class="sidenav">
  <a href="<?php if(isset($_SESSION['home'])){ echo $_SESSION['home']; }?>" id="__user"><?php if(isset($_SESSION['user_email'])){  echo $_SESSION['user_email']; }?></a><br/><hr /><br/>

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
<div align="center" id="search">
  <br /><br /><br /><br />
  <input id="usn" type="text" minlength="10" maxlength="10" placeholder="Search for your friends with usn"/>
  <input id="_search" type="submit" onclick="getstatistics();" value="search" />
  <p id="search_status">

  </p>
  <br /><br /><br />
</div>

</div>
<div align="center" id="curve_chart" style="float:left"></div>
<div align="center" id="avg_scores">
    <h2>Average Score</h2>
    <p id="ads_avg">

    </p>
    <p id="oop_avg">

    </p>
    <p id="aptitude_avg">

    </p>
</div>
<div align="center" id="total_attempt">
    <h2>Total Attempts</h2>
    <p id="ads">

    </p>
    <p id="oop">

    </p>
    <p id="aptitude">

    </p>
</div>

<!-- javascript jquery -->
<script src="javascript/jquery-3.1.1.min.js"></script>
<script>
var mydata;
var usn="<?php if(isset($_SESSION['user_usn'])){ echo $_SESSION['user_usn'];} ?>";
function getdata()
{
    document.getElementById("search_status").innerHTML="";
    $.ajax({
        url:"statisticsinfo.php",
        type:"get",
        data:{
          usn:usn
        },
        success:function(result){
            console.log(result);
            mydata=result;
            document.getElementById("ads_avg").innerHTML="Algorithm and DataStructure = "+mydata.overall_score.ads_avg;
            document.getElementById("oop_avg").innerHTML="Object oriented programming = "+mydata.overall_score.oop_avg;
            document.getElementById("aptitude_avg").innerHTML="Aptitude = "+mydata.overall_score.aptitude_avg;

            document.getElementById("ads").innerHTML="Algorithm and DataStructure = "+mydata.overall_score.ads;
            document.getElementById("oop").innerHTML="Object oriented programming = "+mydata.overall_score.oop;
            document.getElementById("aptitude").innerHTML="Aptitude = "+mydata.overall_score.aptitude;


            drawChart();
        },
        error:function(){
          document.getElementById("search_status").innerHTML="Oops! No data found on usn you entered."
        }
    });
}

  function getstatistics()
  {

    usn=document.getElementById("usn").value;
    if(usn==null || usn=="")
    {
      document.getElementById("usn").style="border:1px solid red";
        document.getElementById("usn").focus;
    }
    else {
      getdata();
    }


  }

  var click=0;
  $(document).ready(function(){
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
        url:"statistics.php",
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['TEST', 'Algorithm and DS', 'OOP','Aptitude'],
          ['test 1',  parseInt(mydata.statistics.algorithm_datastructure.test_1),parseInt(mydata.statistics.oop.test_1),parseInt(mydata.statistics.aptitude.test_1)],
          ['test 2',  parseInt(mydata.statistics.algorithm_datastructure.test_2),parseInt(mydata.statistics.oop.test_2),parseInt(mydata.statistics.aptitude.test_2)],
          ['test 3', parseInt(mydata.statistics.algorithm_datastructure.test_3),parseInt(mydata.statistics.oop.test_3),parseInt(mydata.statistics.aptitude.test_3)],
          ['test 4',  parseInt(mydata.statistics.algorithm_datastructure.test_4),parseInt(mydata.statistics.oop.test_4),parseInt(mydata.statistics.aptitude.test_4)],
          ['test 5',  parseInt(mydata.statistics.algorithm_datastructure.test_5),parseInt(mydata.statistics.oop.test_5),parseInt(mydata.statistics.aptitude.test_5)]
        ]);

        var options = {
          title: 'Student Performance',
          lineType: 'function',
          legend: { position: 'bottom' },
          "vAxis": { "minValue": "0" }, "hAxis": { "slantedTextAngle": "45", "slantedText": "false" }, "legend": { "position": "bottom" }, "pointSize": "5",
          animation: { duration: 2000 ,  easing: 'in',startup: true}
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
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
