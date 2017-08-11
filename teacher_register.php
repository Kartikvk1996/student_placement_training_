<html>
<head>
    <title>Teacher Registration</title>
    <meta charset="utf-8">
    <meta name="description" content="student placement training program">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>
<script>

function is_register_form_valid()
    {
        var myform=document.getElementById("register");
        for(var i=0;i<6;i++)
        {
            if(myform[i].value=="")
            {
                document.getElementById(myform[i].id).focus();
                return false;
            }
            else
            {
                document.getElementById(myform[i].id).style.border="solid black 1px";
            }
        }
        for(var i=0;i<6;i++)
        {
            if(i==2)
            {
                if(myform[i].value.indexOf("CSDT")==0 || myform[i].value.indexOf("csdt")==0)
                {

                }
                else
                {
                    alert("Incorrect TeacherID");
                    document.getElementById(myform[i].id).focus();
                    return false;
                }
            }

        }

        if(myform[4].value!=myform[5].value)
        {
            alert("Please enter SAME passwors both times");
            document.getElementById(myform[5].id).focus();
            return false;
        }
        return true;
    }
</script>
<style>
      #fn,#ln,#email,#tid,#passwd,#confpass
    {
        width: 100%;
        border: solid black 1px;
        border-radius: 4px;
        padding: 6px;
        transition: 0.7s;
    }
      #title
    {
        font-size: 30px;
        color: white;
        width: auto;
        text-align: center;

    }
      #fn:hover,#ln:hover,#email:hover,#tid:hover,#passwd:hover,#confpass:hover,#fn:focus,#ln:focus,#email:focus,#tid:focus,#passwd:focus,#confpass:focus
    {
        transition: 0.6s;
        box-shadow: gray 3px 2px 3px;
        padding: 6px;
    }
      #course
    {
        padding: 4px;
        border-radius: 4px;
        border: solid 1px;
    }
     #signup
    {
        padding: 6px;
        border-radius: 4px;
        width: 100%;
        background-color: white;
        border: solid 1px;
        transition: 1s;
        white-space: nowrap;
    }



    #signup:hover,#signup:focus
    {
        background-color: #4CAF50;
        transition: 0.5s;
        color: white;
    }
     body
    {
        background-color: white;
        border-bottom: solid 2px lightgray;

    }

    footer
    {
        border-top: solid 2px lightgray;
        background-color: #4CAF50;
    }
     header
    {
        margin-top: -1%;
        border-bottom: solid 2px lightgray;
        background-color: #4CAF50;
    }
    #wrapper
    {
        width: 100%;
        position: static;
    }
      #description
    {
        float: left;
        margin: 10% 10% 0 10%;
        height: auto;
        text-align: center;
        animation-name: slide;
        animation-duration: 2s;
        animation-iteration-count: 1;
        -moz-animation-name: slide;
        -moz-animation-duration: 2s;
        -moz-animation-iteration-count: 1;
        -webkit-animation-name: slide;
        -webkit-animation-duration: 2s;
        -webkit-animation-iteration-count: 1;
    }


    @keyframes slide{
        0%
        {
            margin-left: -100%;
            margin-right: 100%;
        }
        100%
        {
            margin: 10% 10% 0 10%;
        }

    }
    a
    {
        text-decoration: none;
        font-size: large;
        text-wrap: none;
        text-align: center;
        color: black;

    }


</style>
<div id="wrapper">
    <header>
        <br />
        <h2 id="title">STUDENT PLACEMENT TRAINING</h2>
    </header>
</div>
<body>

<div id="container">
        <div id="description">
            <h2 style="font-family: 'Courier New',serif; " >
                Welcome to Student placement training program<hr />
            </h2>
            <p style="font-size: large;font-family: Arial; text-align: match-parent"> The Online Web based student placement training program educates the student by<br />
                conducting tests and helps them to clear the Aptitude and Technical round conducted  <br />
                by different companies. <br/><br/></p>
        </div>
        <br>
        <br>
        <br>
 <form id="register" method="post" action="teachers_registration_details.php" onsubmit="return is_register_form_valid();">
                <table style="border: dashed gray 1px; padding-right: 15px;" id="regiform" cellspacing="15" align="center">
                    <tr>
                        <td>
                            <h3 align="center ">&nbsp;&nbsp;Registration</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="fn" name="firstname" type="text" placeholder="Firstname" minlength="3" maxlength="20" >
                        </td>
                    </tr>
                    <tr><td>
                            <input id="ln" name="lastname" type="text" placeholder="Lastname" minlength="1" maxlength="20">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="tid" name="tid" type="text" placeholder="TeacherID" minlength="8" maxlength="8">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="email" name="email" type="email" placeholder="Email ID" minlength="9" maxlength="30">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="passwd" name="password" type="password" placeholder="Password" minlength="3" maxlength="20">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="confpass" name="confpassword" type="password" placeholder="Confirm Password" minlength="3" maxlength="20">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button id="signup" type="submit" name="signup">Submit</button>
                        </td>
                    </tr>
                </table>
            </form>
    <br>
        <br>
        <br>
</div>
</body>
<footer style="display: inline;">
    <div align="center" style="white-space: normal; background-color: #4CAF50;">
        <br /><br />
        &emsp;&emsp;&emsp;&emsp;
        <a href="contact_us.php" style="color: white; ">Contact_us</a>
        &emsp;&emsp;&emsp;&emsp;
        <a href="about.php" style="color: white; ">About</a>
        &emsp;&emsp;&emsp;&emsp;
        <br /><br /><br />
    </div>

</footer>
</html>
