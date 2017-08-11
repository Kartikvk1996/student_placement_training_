<?php
// this module loads the answer to questions

// check user logged-in or not.
require("is_logged_sub_pages.php");
?>
<html>
<head>
    <title>Test Answers</title>
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
<body onload="load_test_answer();">
  <h2 align="center" id="exam_status"></h2>
<div style="display:none" id="questions">
    <h2 >Questions</h2>
    <h4  id="warning" style="color:red"></h4>
    <p id="q0"></p>
    <label>&nbsp A . &nbsp<code id="0.1"></code></label></br>
    <label>&nbsp B . &nbsp<code id="0.2"></code></label></br>
    <label>&nbsp C . &nbsp<code id="0.3"></code></label></br>
    <label>&nbsp D . &nbsp<code id="0.4"></code></label></br>
    <label>&nbsp ans . &nbsp<code id="0.5"></code></label></br>
    <hr />

   <br /><br />
   <p id="q1"></p>
    <label>&nbsp A . &nbsp<code id="1.1"></code></label></br>
    <label>&nbsp B . &nbsp<code id="1.2"></code></label></br>
    <label>&nbsp C . &nbsp<code id="1.3"></code></label></br>
    <label>&nbsp D . &nbsp<code id="1.4"></code></label></br>
    <label>&nbsp ans . &nbsp<code id="1.5"></code></label></br>
    <hr />
   <br /><br />
   <p id="q2"></p>
    <label>&nbsp A . &nbsp<code id="2.1"></code></label></br>
    <label>&nbsp B . &nbsp<code id="2.2"></code></label></br>
    <label>&nbsp C . &nbsp<code id="2.3"></code></label></br>
    <label>&nbsp D . &nbsp<code id="2.4"></code></label></br>
    <label>&nbsp ans . &nbsp<code id="2.5"></code></label></br>
    <hr />

   <br /><br />
   <p id="q3"></p>
    <label>&nbsp A . &nbsp<code id="3.1"></code></label></br>
    <label>&nbsp B . &nbsp<code id="3.2"></code></label></br>
    <label>&nbsp C . &nbsp<code id="3.3"></code></label></br>
    <label>&nbsp D . &nbsp<code id="3.4"></code></label></br>
    <label>&nbsp ans . &nbsp<code id="3.5"></code></label></br>
    <hr />

   <br /><br />
   <p id="q4"></p>
    <label>&nbsp A . &nbsp<code id="4.1"></code></label></br>
    <label>&nbsp B . &nbsp<code id="4.2"></code></label></br>
    <label>&nbsp C . &nbsp<code id="4.3"></code></label></br>
    <label>&nbsp D . &nbsp<code id="4.4"></code></label></br>
    <label>&nbsp ans . &nbsp<code id="4.5"></code></label></br>

    <hr />
   <br /><br />
   <p id="q5"></p>
    <label>&nbsp A . &nbsp<code id="5.1"></code></label></br>
    <label>&nbsp B . &nbsp<code id="5.2"></code></label></br>
    <label>&nbsp C . &nbsp<code id="5.3"></code></label></br>
    <label>&nbsp D . &nbsp<code id="5.4"></code></label></br>
    <label>&nbsp ans . &nbsp<code id="5.5"></code></label></br>
    <hr />
   <br /><br />
   <p id="q6"></p>
    <label>&nbsp A . &nbsp<code id="6.1"></code></label></br>
    <label>&nbsp B . &nbsp<code id="6.2"></code></label></br>
    <label>&nbsp C . &nbsp<code id="6.3"></code></label></br>
    <label>&nbsp D . &nbsp<code id="6.4"></code></label></br>
    <label>&nbsp ans . &nbsp<code id="6.5"></code></label></br>
    <hr />
   <br /><br />
   <p id="q7"></p>
    <label>&nbsp A . &nbsp<code id="7.1"></code></label></br>
    <label>&nbsp B . &nbsp<code id="7.2"></code></label></br>
    <label>&nbsp C . &nbsp<code id="7.3"></code></label></br>
    <label>&nbsp D . &nbsp<code id="7.4"></code></label></br>
    <label>&nbsp ans . &nbsp<code id="7.5"></code></label></br>
    <hr />
   <br /><br />
   <p id="q8"></p>
    <label>&nbsp A . &nbsp<code id="8.1"></code></label></br>
    <label>&nbsp B . &nbsp<code id="8.2"></code></label></br>
    <label>&nbsp C . &nbsp<code id="8.3"></code></label></br>
    <label>&nbsp D . &nbsp<code id="8.4"></code></label></br>
    <label>&nbsp ans . &nbsp<code id="8.5"></code></label></br>
    <hr />
   <br /><br />
   <p id="q9"></p>
    <label>&nbsp A . &nbsp<code id="9.1"></code></label></br>
    <label>&nbsp B . &nbsp<code id="9.2"></code></label></br>
    <label>&nbsp C . &nbsp<code id="9.3"></code></label></br>
    <label>&nbsp D . &nbsp<code id="9.4"></code></label></br>
    <label>&nbsp ans . &nbsp<code id="9.5"></code></label></br>

    <hr />
    <br />
    <br />
   

</form>
</div>
</body>


<!-- javascript jquery -->
<script src="javascript/jquery-3.1.1.min.js"></script>
<script>



    function load_test_answer() {

        $.ajax({
          url:"view_answers.php",
          type:"post",
          contenttype:"application/json",
          datatype:"JSON",
          data:{
           get_answers:"yes",
           course:"<?php if(isset($_GET['course'])){ echo  $_GET['course']; }?>"
          },
          success:function(output)
            {
              var status=output.status;
              if(status.indexOf("unable to fetch answers")!=-1)
              {
                document.getElementById("exam_status").innerHTML="Error occured in fetching answer, Try again";

                document.getElementById("exam_status").style="margin-top:15%; margin-bottom:25%; color:green";
              }
              else if(status=="you cannot view answer")
              {
                document.getElementById("exam_status").innerHTML="Test is still running, You can view answers tomorrow.";
                document.getElementById("exam_status").style="margin-top:15%; margin-bottom:25%; color:red"

              }
              else {
                document.getElementById("questions").style="display:block; margin-left:15%; margin-top5%; margin-right:15%; margin-bottom:10%;";
                for (var i = 0; i <10; i++) {
             document.getElementById("q"+i).innerHTML=(i+1)+" .  "+output.status[i].question;
             document.getElementById(i+".1").innerHTML=output.status[i].option1;
             document.getElementById(i+".2").innerHTML=output.status[i].option2;
             document.getElementById(i+".3").innerHTML=output.status[i].option3;
             document.getElementById(i+".4").innerHTML=output.status[i].option4;
             document.getElementById(i+".5").innerHTML=output.status[i].answer;
              }
              }
            },
          error: function(){
            document.write("error");
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
