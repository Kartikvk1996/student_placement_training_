<?php

require("is_logged_sub_pages.php");
require("connect.php");
if(isset($_POST['logout']) && $_POST['logout']==="logout_user")
{
    session_unset();
    session_destroy();
    reload();
}

?>
<html>
<head>
    <title>scoreboard</title>
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
        height: 100%;
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

    table {
    border-collapse: collapse;
    width: 70%;
    margin-top: 5%;
    border: 1px solid black;
    margin-left: 3%;
    margin-right: 3%;
    }

    th, td {
        text-align: left;
        padding: 5px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
        background-color: #4CAF50;
        color: white;
    }

    @media screen and (max-device-width: 1080px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
        .sidenav {width: 100%;}
        .sidenav {height: 50%;}
        #site_info{ margin-top: 100%;
        margin-left: 0%;}
        table
        {
          margin-left: 0%;
          margin-right: 0%;
          margin-bottom: 10%;
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


</style>
<body>
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
<div align="center" id="ranklist_info">
<h2 id="__title"></h2>
<a  id="toogle_ranklist" onclick="getranklist();" style="text-decoration:underline;color:blue" href="#">Get previous test ranklist</a><br /><br />
<a  id="get_ans" style="text-decoration:underline;color:blue" href="test_answer.php?course=<?php if(isset($_GET['course'])){ echo $_GET['course'];}?>">view previous test answers</a>

<table id="list">

</table>
</div>
</body>

<!-- javascript jquery -->
<script src="javascript/jquery-3.1.1.min.js"></script>
<script>

  window.onload=function(){
    getranklist();
  }


  var jump=0;
  function getranklist()
  {
    var selected_course="<?php if(isset($_GET['course'])){ echo $_GET['course'];}?>";
    if(selected_course=="ads")
    {
      document.getElementById("__title").innerHTML="Algoritms and DataStructures Scoreboard";
    }
    else if(selected_course=="oop")
    {
      document.getElementById("__title").innerHTML="Object Oriented Programming Scoreboard";
    }
    else if(selected_course=="aptitude")
    {
      document.getElementById("__title").innerHTML="Aptitude Scoreboard";
    }
    else {

    }

    var t_filter="";
    if(jump%2==0)
    {
      t_filter="off";
      document.getElementById("toogle_ranklist").innerHTML="Get previous test ranklist";
    }
    else {
      t_filter="on";
      document.getElementById("toogle_ranklist").innerHTML="Get overall ranklist";
    }
    jump+=1;
    document.getElementById("list").innerHTML="";
    var i=0;
    $.ajax({
      url:"ranklist.php",
      type:"get",
      data:{
        course:selected_course,
        filter:t_filter
      },
      success:function(data)
      {
        document.getElementById("list").innerHTML+="<tr style='background-color: #4CAF50;color: white;'><td>No</td><td>Name</td><td>USN</td><td>Test_Average</td></tr>";
        while(data.result[i])
        {
          if(t_filter=="off")
          {
            if(selected_course=="ads")
            {
              document.getElementById("list").innerHTML+="<tr><td>"+(i+1)+"</td><td>"+data.result[i].firstname+"</td><td>"+data.result[i].usn+"</td><td>"+data.result[i].ads_avg+"</td></tr>";
            }
            else if(selected_course=="oop")
            {
              document.getElementById("list").innerHTML+="<tr><td>"+(i+1)+"</td><td>"+data.result[i].firstname+"</td><td>"+data.result[i].usn+"</td><td>"+data.result[i].oop_avg+"</td></tr>";
            }
            else if(selected_course=="aptitude")
            {
              document.getElementById("list").innerHTML+="<tr><td>"+(i+1)+"</td><td>"+data.result[i].firstname+"</td><td>"+data.result[i].usn+"</td><td>"+data.result[i].aptitude_avg+"</td></tr>";
            }
            else {

            }
          }
          else
          {
            if(selected_course=="ads")
            {
              document.getElementById("list").innerHTML+="<tr><td>"+(i+1)+"</td><td>"+data.result[i].firstname+"</td><td>"+data.result[i].usn+"</td><td>"+data.result[i].last_ads_test_score+"</td></tr>";
            }
            else if(selected_course=="oop")
            {
              document.getElementById("list").innerHTML+="<tr><td>"+(i+1)+"</td><td>"+data.result[i].firstname+"</td><td>"+data.result[i].usn+"</td><td>"+data.result[i].last_oop_test_score+"</td></tr>";
            }
            else if(selected_course=="aptitude")
            {
              document.getElementById("list").innerHTML+="<tr><td>"+(i+1)+"</td><td>"+data.result[i].firstname+"</td><td>"+data.result[i].usn+"</td><td>"+data.result[i].last_aptitude_test_score+"</td></tr>";
            }
            else {

            }
          }

          i++;
        }
      }
    });
  }


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
        url:"scoreboard.php",
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

if(isset($_POST['view_answers']))
{
  // connect to database
  $myconnect=new connect();
  $myconnect->setconnection();
  $conn=$myconnect->getconnection();


}

 ?>
