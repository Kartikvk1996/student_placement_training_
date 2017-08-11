<?php

// check user is logged or not
require("is_logged_sub_pages.php");

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
    <title>My profile</title>
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

    @media screen and (max-device-width: 1080px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
        .sidenav {width: 100%;}
        .sidenav {height: 50%;}
        label,p
        {
          font-size: small;
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
        width: auto;
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
<h2 align="center">My profile</h2>
<br/>
<div align="center" id="contents" style=" clear: right; ">

  <table id="user_profile" style="background-color: #f2f2f2;">
      <tr><td><br/></td></tr>
      <tr>
          <td>
              <label>&emsp;Firstname :</label>
          </td>
          <td>
              <p id="fn"></p>
          </td>
      </tr>
      <tr>
          <td>
              <label>&emsp;Lastname :</label>
          </td>
          <td>
              <p id="ln"></p>
          </td>
      </tr>
      <tr>
          <td>
              <label id="sem_label">&emsp;</label>
          </td>
          <td>
              <p id="sem">  </p>
          </td>
      </tr>
      <tr>
          <td>
              <label id="usn_label">&emsp;</label>
          </td>
          <td>
              <p id="usn"></p>
          </td>
      </tr>
      <tr>
          <td>
              <label>&emsp;Email ID :</label>
          </td>
          <td>
              <p id="email"></p>
          </td>
      </tr>
      <tr><td><td></td></td></tr>
      <tr><td><td></td></td></tr>
      <tr><td><td></td></td></tr>
      <tr><td><td></td></td></tr>
      <tr>
        <td>

        </td>
        <td>
          <a href="#" style="color:blue;" id="change_password">change password</a>
        </td>
      </tr>
      <tr id="1" style="display:none;">
          <td>
            <label>&emsp;Old password</label>
          </td>
          <td>
            <input type="password" id="old_password" name="old_password" />
          </td>
      </tr>
      <tr id="2" style="display:none;">
        <td>
          <label>&emsp;New password</label>
        </td>
        <td>
          <input type="password" id="new_password" name="new_password" />
        </td>
      </tr>
      <tr id="3" style="display:none;">
        <td>
        </td>
        <td>
          <input type="button" name="update" id="update" value="update" onclick="update_password()" />
        </td>
      </tr>
      <tr>
        <td>

        </td>
        <td>
          <p id="status">

          </p>
        </td>
      </tr>
      <tr><td><td></td></td></tr>
      <tr><td><td></td></td></tr>
  </table>
  <br /><br /><br /><br />
</div>




<!-- javascript jquery -->
<script src="javascript/jquery-3.1.1.min.js"></script>
<script>

  function getdata()
  {
      $.ajax({
          url:"userdetails.php",
          type:"post",
          data:{
            val:"getdata"
          },
          success:function(result){
              var z=result;
              if(z.error==="true")
              {
                  window.location="welcome.php";
              }
              else
              {
                  $("#fn").html(z.firstname+"&emsp;");
                  $("#ln").html(z.lastname+"&emsp;");
                  $("#email").html(z.email+"&emsp;");
                  if(z.sem!="")
                  {
                    $("#sem_label").html("&emsp;Sem :");
                    $("#sem").html(z.sem+"&emsp;");

                    $("#usn_label").html("&emsp;USN :");
                    $("#usn").html(z.usn+"&emsp;");
                  }
                  else
                  {

                    document.getElementById("sem").style="display:none";
                    document.getElementById("sem_label").style="display:none";
                    $("#usn_label").html("&emsp;Teacher ID :");
                    $("#usn").html(z.usn+"&emsp;");
                  }


                  $("#__user").html(z.email+"&emsp;");
              }
          },
          error:function(){
            document.write("Error in getting data");
          }
      });
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
        url:"myprofile.php",
        type:"post",
        data:{
          logout:"logout_user"
        },
        success:function(data){
              window.location="index.php";
        }
      });
  }

  function update_password()
  {
      var oldpwd=document.getElementById("old_password").value;
      var newpwd=document.getElementById("new_password").value;
      if(oldpwd=="" || newpwd=="")
      {
        alert("Enter the Old and New Password");
        return;
      }

     $.ajax({
       url:"updatepassword.php",
       type:"post",
       data:{
          updatepassword:"true",
          oldpassword:oldpwd,
          newpassword:newpwd
       },
       success:function(data){
        var res=JSON.parse(data);
        if(res.status=="Failed_to_update")
        {
          document.getElementById("status").style="color:red";
          document.getElementById("status").innerHTML="Failed to Update!.";
        }
        else if(res.status=="invalid_oldpassword")
        {
          document.getElementById("status").style="color:red";
          document.getElementById("status").innerHTML="old password incorrect.";
        }
        else if(res.status=="success")
        {
          document.getElementById("status").style="color:green";
            document.getElementById("status").innerHTML="Password updated successfully.";
        }
        else
        {
          document.getElementById("status").style="color:red";
               document.getElementById("status").innerHTML="Error";
        }
       }
     })
  }

  var toogle_password_opt=0;
  $(document).ready(function(){
    $("#change_password").click(function(){
      if(toogle_password_opt%2==0)
      {
        $('#1').show(1000);
        $('#2').show(1000);
        $('#3').show(1000);
        toogle_password_opt++;
      }
      else {
        $('#1').hide(1000);
        $('#2').hide(1000);
        $('#3').hide(1000);
        $('#status').hide(1000);
        toogle_password_opt++;
      }

    });
});

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
