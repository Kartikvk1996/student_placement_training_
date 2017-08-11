<?php

// check user logged-in or not.
require("is_logged_sub_pages.php");

 ?>
 <html>
 <head>
     <title>Test</title>
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
 <body onload="load_questions();">
   <h2 align="center" id="exam_status"></h2>
 <div style="display:none" id="questions">
     <h2 >Questions</h2>
     <h4  id="warning" style="color:red">Note : Dont refresh or close the tab. You have 10 minutes to complete the test.</h4>
     <p id="q0"></p>
     <label><input type="radio" name="0" value="a" >&nbsp A . &nbsp<code id="0.1"></code></label></br>
     <label><input type="radio" name="0" value="b" >&nbsp B . &nbsp<code id="0.2"></code></label></br>
     <label><input type="radio" name="0" value="c" >&nbsp C . &nbsp<code id="0.3"></code></label></br>
     <label><input type="radio" name="0" value="d" >&nbsp D . &nbsp<code id="0.4"></code></label></br>
     <hr />

   	<br /><br />
   	<p id="q1"></p>
     <label><input type="radio" name="1" value="a" >&nbsp A . &nbsp<code id="1.1"></code></label></br>
     <label><input type="radio" name="1" value="b" >&nbsp B . &nbsp<code id="1.2"></code></label></br>
     <label><input type="radio" name="1" value="c" >&nbsp C . &nbsp<code id="1.3"></code></label></br>
     <label><input type="radio" name="1" value="d" >&nbsp D . &nbsp<code id="1.4"></code></label></br>
     <hr />
   	<br /><br />
   	<p id="q2"></p>
     <label><input type="radio" name="2" value="a" >&nbsp A . &nbsp<code id="2.1"></code></label></br>
     <label><input type="radio" name="2" value="b" >&nbsp B . &nbsp<code id="2.2"></code></label></br>
     <label><input type="radio" name="2" value="c" >&nbsp C . &nbsp<code id="2.3"></code></label></br>
     <label><input type="radio" name="2" value="d" >&nbsp D . &nbsp<code id="2.4"></code></label></br>
     <hr />

   	<br /><br />
   	<p id="q3"></p>
     <label><input type="radio" name="3" value="a" >&nbsp A . &nbsp<code id="3.1"></code></label></br>
     <label><input type="radio" name="3" value="b" >&nbsp B . &nbsp<code id="3.2"></code></label></br>
     <label><input type="radio" name="3" value="c" >&nbsp C . &nbsp<code id="3.3"></code></label></br>
     <label><input type="radio" name="3" value="d" >&nbsp D . &nbsp<code id="3.4"></code></label></br>
     <hr />

   	<br /><br />
   	<p id="q4"></p>
     <label><input type="radio" name="4" value="a" >&nbsp A . &nbsp<code id="4.1"></code></label></br>
     <label><input type="radio" name="4" value="b" >&nbsp B . &nbsp<code id="4.2"></code></label></br>
     <label><input type="radio" name="4" value="c" >&nbsp C . &nbsp<code id="4.3"></code></label></br>
     <label><input type="radio" name="4" value="d" >&nbsp D . &nbsp<code id="4.4"></code></label></br>

     <hr />
   	<br /><br />
   	<p id="q5"></p>
     <label><input type="radio" name="5" value="a" >&nbsp A . &nbsp<code id="5.1"></code></label></br>
     <label><input type="radio" name="5" value="b" >&nbsp B . &nbsp<code id="5.2"></code></label></br>
     <label><input type="radio" name="5" value="c" >&nbsp C . &nbsp<code id="5.3"></code></label></br>
     <label><input type="radio" name="5" value="d" >&nbsp D . &nbsp<code id="5.4"></code></label></br>
     <hr />
   	<br /><br />
   	<p id="q6"></p>
     <label><input type="radio" name="6" value="a" >&nbsp A . &nbsp<code id="6.1"></code></label></br>
     <label><input type="radio" name="6" value="b" >&nbsp B . &nbsp<code id="6.2"></code></label></br>
     <label><input type="radio" name="6" value="c" >&nbsp C . &nbsp<code id="6.3"></code></label></br>
     <label><input type="radio" name="6" value="d" >&nbsp D . &nbsp<code id="6.4"></code></label></br>
     <hr />
   	<br /><br />
   	<p id="q7"></p>
     <label><input type="radio" name="7" value="a" >&nbsp A . &nbsp<code id="7.1"></code></label></br>
     <label><input type="radio" name="7" value="b" >&nbsp B . &nbsp<code id="7.2"></code></label></br>
     <label><input type="radio" name="7" value="c" >&nbsp C . &nbsp<code id="7.3"></code></label></br>
     <label><input type="radio" name="7" value="d" >&nbsp D . &nbsp<code id="7.4"></code></label></br>
     <hr />
   	<br /><br />
   	<p id="q8"></p>
     <label><input type="radio" name="8" value="a" >&nbsp A . &nbsp<code id="8.1"></code></label></br>
     <label><input type="radio" name="8" value="b" >&nbsp B . &nbsp<code id="8.2"></code></label></br>
     <label><input type="radio" name="8" value="c" >&nbsp C . &nbsp<code id="8.3"></code></label></br>
     <label><input type="radio" name="8" value="d" >&nbsp D . &nbsp<code id="8.4"></code></label></br>
     <hr />
   	<br /><br />
   	<p id="q9"></p>
     <label><input type="radio" name="9" value="a" >&nbsp A . &nbsp<code id="9.1"></code></label></br>
     <label><input type="radio" name="9" value="b" >&nbsp B . &nbsp<code id="9.2"></code></label></br>
     <label><input type="radio" name="9" value="c" >&nbsp C . &nbsp<code id="9.3"></code></label></br>
     <label><input type="radio" name="9" value="d" >&nbsp D . &nbsp<code id="9.4"></code></label></br>

     <hr />
     <br />
     <br />
   	<div align="center">
       <input type="button" onclick="submit_answers();" value="submit">
     </div>

 </form>
 </div>
 </body>


 <!-- javascript jquery -->
 <script src="javascript/jquery-3.1.1.min.js"></script>
 <script>




     function load_questions() {

         $.ajax({
           url:"questions.php",
           type:"get",
           contenttype:"application/json",
           datatype:"JSON",
           data:{
           	course:"<?php if(isset($_GET['course'])){ echo  $_GET['course']; }?>"
           },
           success:function(output)
             {
               var status=output.status;

               if(status.indexOf("next test")!=-1)
               {
                 document.getElementById("exam_status").innerHTML=output.status;

                 document.getElementById("exam_status").style="margin-top:15%; margin-bottom:25%; color:green";
               }
               else if(status=="attempted")
               {
                 document.getElementById("exam_status").innerHTML="You have already attempted this test.";
                 document.getElementById("exam_status").style="margin-top:15%; margin-bottom:25%; color:red"

               }
               else if(status.indexOf("no new test")!=-1)
               {
                 document.getElementById("exam_status").innerHTML="Next test is not yet scheduled.";
                 document.getElementById("exam_status").style="margin-top:15%; margin-bottom:25%; color:red"

               }
               else if(status.indexOf("unable to fetch questions")!=-1)
               {
                 document.getElementById("exam_status").innerHTML="Invalid course.";
                 document.getElementById("exam_status").style="margin-top:15%; margin-bottom:25%; color:orange"

               }
               else {
                 document.getElementById("questions").style="display:block; margin-left:15%; margin-top5%; margin-right:15%; margin-bottom:10%;";
                 for (var i = 0; i <10; i++) {
           		document.getElementById("q"+i).innerHTML=(i+1)+" .  "+output.status[i].question;
           		document.getElementById(i+".1").innerHTML=output.status[i].option1;
           		document.getElementById(i+".2").innerHTML=output.status[i].option2;
           		document.getElementById(i+".3").innerHTML=output.status[i].option3;
           		document.getElementById(i+".4").innerHTML=output.status[i].option4;
           	   }
               }
             },
             error: function(){
             document.write("error");
           }
         });
     }

     function submit_answers()
     {
     	var ans=new Array(10);
     	var i=0,j=0;
     	for(i=0;i<10;i++)
     	{
     		var z=i.toString();
     		var temp=document.getElementsByName(z);
        var attempt=0;
     		for(j=0;j<temp.length;j++)
     		{
     			if(temp[j].checked){
            attempt=1;
        		ans[i]=temp[j].value;
    			}
     		}
        if(attempt==0)
        {
          ans[i]="z";
        }
     	}

     	$.ajax({
           url:"answers.php",
           type:"get",
           contenttype:"application/json",
           datatype:"JSON",
           data:{
           	course:"<?php if(isset($_GET['course'])){ echo  $_GET['course']; }?>",
           	answers:"submitted",
            	q0_ans:ans[0],
           	q1_ans:ans[1],
           	q2_ans:ans[2],
           	q3_ans:ans[3],
           	q4_ans:ans[4],
           	q5_ans:ans[5],
           	q6_ans:ans[6],
           	q7_ans:ans[7],
           	q8_ans:ans[8],
           	q9_ans:ans[9]
           },
           success:function(output){
               document.getElementById("questions").style="display:none;";
               document.getElementById("exam_status").innerHTML="Congratulations ,your score is "+output.score;
               document.getElementById("exam_status").style="color:green; margin-top:10%; margin-bottom:15%;"
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
