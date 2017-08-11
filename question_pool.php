<?php

// check user is logged or not
include("is_logged_sub_pages.php");

// on click of 'logout' button unset and destroy the session and requrect to home page
if(isset($_POST['logout']) && $_POST['logout']==="logout_user")
{
    session_unset();
    session_destroy();
    reload();
}

?>
<html>
<head>
    <title>Question pool</title>
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

    #display {
    border-collapse: collapse;
    width: 70%;
    margin-top: 5%;
    border: 1px solid black;
    margin-left: 3%;
    margin-right: 3%;
    }

    #display:th, #display:td {
        text-align: left;
        padding: 5px;

    }

    #display:tr:nth-child(even){background-color: #f2f2f2}

    #display:th {
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
        #display
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

<table  style=" margin-top:5%; border: solid gray 1px; padding-right: 15px;" id="regiform" cellspacing="15" align="center">
    <tr>
        <td>
            <h3 align="center ">&nbsp;&nbsp;Select the company to filter the questions</h3>
        </td>
    </tr>
      <tr>
        <td>
            <select id="company" name="company">
                <option>Company</option>
                <option>TCS</option>
                <option>ORACLE</option>
                <option>MIND CRAFT</option>
                <option>MIND TREE</option>
                <option>KPIT</option>
                 <option>OTHERS</option>
            </select>
        </td>
    </tr>
     <tr>
        <td>
            <input type="button" id="view" name="view" value="filter" onclick="is_form_valid()"></input>

        </td>
    </tr>

</table>
<br />
<div align="center">
  <a style="color:blue; text-decoration:underline" href="add_poolquestions.php">Add questions to pool.</a>
</div>
<h2 align="center" id="status">

</h2>
<div align="center">
  <table cellpadding=4 id="display">

  </table>
</div>

<script>

function is_form_valid()
{
    if(document.getElementById("company").value=="Company")
    {
            document.getElementById("company").focus();
            return false;
     }

     getquestions(document.getElementById("company").value);
     return true;
}
</script>

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
        url:"question_pool.php",
        type:"post",
        data:{
          logout:"logout_user"
        },
        success:function(data){
              window.location="index.php";
        }
      });
  }



  function getquestions(filtercompany)
  {
      document.getElementById("display").innerHTML="";
        document.getElementById("status").innerHTML="";
      $.ajax({
        url:"poolquestions.php",
        type:"get",
        data:{
          view:"questions",
          company:filtercompany
        },
        success:function(data){
          if(data.status=="ok")
          {
            var i=0;
              document.getElementById("display").innerHTML+="<tr style='background-color: #4CAF50;color: white;'><td>No</td><td>Question</td><td>Answer</td></tr>";
            while(data.questions[i])
            {
                document.getElementById("display").innerHTML+="<tr><td>"+(i+1)+"</td><td>"+data.questions[i].question+"</td><td>"+data.questions[i].answer+"</td></tr>";
                i++;
            }
          }
          else if(data.status=="no questions found")
          {
            document.getElementById("status").innerHTML="No Questions Found."
          }

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
