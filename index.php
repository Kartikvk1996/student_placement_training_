<?php

//start object input buffer
ob_start();
session_start();
// generate new session token for every form
generateSessionToken();

// generate the form token to prevent  CSRF attacks and hijacking
function generateSessionToken()
{  // Generate a brand new (CSRF) token
    if(isset( $_SESSION[ 'session_token' ] ) ) {
        destroySessionToken();
    }
    $_SESSION[ 'session_token' ] = md5( uniqid() );
}

function destroySessionToken()
{
    unset($_SESSION['session_token']);
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Welcome</title>
    <meta charset="utf-8">
    <meta name="description" content="student placement training program">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>
<script>
    function invalid()
    {
        document.getElementById("wp").style.display="block";
    }


    function validate_login()
    {
        var myform=document.getElementById("login_form");
        for(var i=0;i<2;i++)
        {
            if(myform[i].value=="")
            {
                document.getElementById(myform[i].id).style.border="solid red 1px";
                blur_button();
                return false;
            }
            else
            {
                document.getElementById(myform[i].id).style.border="solid black 1px";
            }
        }
        login_user();
    }



    function is_register_form_valid()
    {
        var myform=document.getElementById("register");
        for(var i=0;i<7;i++)
        {
            if(myform[i].value=="" || myform[i].value=="Sem")
            {
                document.getElementById(myform[i].id).style.border="solid red 1px";
                blur_button();
                return false;
            }
            else
            {
                document.getElementById(myform[i].id).style.border="solid black 1px";
            }
        }
        for(var i=0;i<7;i++)
        {
            if(i==2)
            {
                if(myform[i].value.indexOf("2SD")==0 || myform[i].value.indexOf("2sd")==0)
                {
                  var usn=myform[i].value;
                  var res = usn.substring(3, 5);
                  var d = new Date();
                  var n = d.getYear();
                  n--;
                  n=n.toString().slice(1);

                  if(res>n)
                  {
                    document.getElementById(myform[i].id).style.border="solid red 1px";
                    return false;
                  }
                }
                else
                {
                    document.getElementById(myform[i].id).style.border="solid red 1px";
                    return false;
                }
            }
            if(i==2)
            {
                var str=myform[i].value;
                if(str.length!=10)
                {
                    document.getElementById(myform[i].id).style.border="solid red 1px";
                    return false;
                }
            }

            if(i==3)
            {
                var str=myform[i].value;
                if(str.length!=1 && str<9 && str >0)
                {
                    document.getElementById(myform[i].id).style.border="solid red 1px";
                    return false;
                }
            }
        }
        register_user();
        return true;
    }
</script>

<style>


    #title
    {
        font-size: 17px;
        color: white;
        width: auto;
        text-align: center;

    }

    #error_login,#error_register
    {
        display: none;
    }

    #mailid,#password
    {
        width: 100%;
        border: solid black 1px;
        border-radius: 4px;
        padding: 4px;
        transition: 0.7s;
    }

    #mailid:hover,#password:hover,#mailid:focus,#password:focus
    {
        transition: 0.8s;
        box-shadow: gray 3px 3px 3px;
    }

    #container
    {

    }

    #login
    {
        padding: 4px;
        border-radius: 4px;
        width: 50%;
        background-color: white;
        border: solid black 1px;
        transition: 1s;
        white-space: nowrap;
    }

    #login:hover,#login:focus
    {
        background-color: #4CAF50;
        transition: 0.5s;
        color: white;
        box-shadow: grey 2px 2px 3px;
    }


    #fn,#ln,#email,#usn,#passwd,#confpass
    {
        width: 100%;
        border: solid black 1px;
        border-radius: 4px;
        padding: 4px;
        transition: 0.7s;
    }

    #fn:hover,#ln:hover,#email:hover,#usn:hover,#passwd:hover,#confpass:hover,#fn:focus,#ln:focus,#email:focus,#usn:focus,#passwd:focus,#confpass:focus
    {
        transition: 0.6s;
        box-shadow: gray 3px 2px 3px;
    }

    #signup
    {
        padding: 4px;
        border-radius: 4px;
        width: 107%;
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

    #sem
    {
        padding: 3px;
        border-radius: 4px;
        border: solid 1px;
        background-color: white;
    }
    a
    {
        text-decoration: none;
        font-size: large;
        text-wrap: none;
        text-align: center;
        color: black;

    }


    #forgorpassword
    {
        text-align: center;
        transition: 1s;
        font-size: 13px;
        white-space: nowrap;
    }

    #forgorpassword:hover
    {
        transition: 0.51s;
        color: red;
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

    #form
    {

    }


    #wrapper
    {
        width: 100%;
        position: static;
    }

    header
    {
        margin-top: -1%;
        border-bottom: solid 2px lightgray;
        background-color: #4CAF50;
    }

    body
    {


        background: white;
        border-bottom: solid 2px lightgray;

    }

    footer
    {
        border-top: solid 2px lightgray;
        background-color: #4CAF50;
    }

    .footer a
    {
      font-size:15px;
    }


</style>
<div id="wrapper">
    <header><br />
        <h2 id="title">STUDENT PLACEMENT TRAINING</h2>
        <br />
    </header>
</div>
<body >
    <div id="container">
        <div id="description">
            <h2 style="font-family: 'Courier New',serif; " >
                Welcome to Student placement training program<hr />
            </h2>
            <p style="font-size: 1em;font-family: Arial; text-align: match-parent"> The Online Web based student placement training program educates the student by<br />
                conducting tests and helps them to clear the Aptitude and Technical round conducted  <br />
                by different companies. <br/><br/></p>
        </div>
        <div id="form">
            <br />
            <br />
            <br />
            <form id="login_form" style="display: inline; white-space: nowrap; ">
                <table style="border: dashed gray 1px; padding-right: 15px" cellspacing="15" align="center" onsubmit="validate_login()">
                    <tr>
                        <td>
                            <p id="error_login" style="text-align: center; font-size: small; color: red"></p><br />
                            <input id="mailid" type="email" name="mailid" placeholder="Email ID" maxlength="55" minlength="9">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="password" type="password" name="password" placeholder="Password" maxlength="25" minlength="3">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button id="login" type="button" name="login">Log in</button>&nbsp;
                            <a id="forgorpassword" href="forgotpassword.php">Forgot password</a>
                            <input id="form_token1" type="hidden" name="login_token" value="<?php if(isset($_SESSION['session_token'])){ echo $_SESSION['session_token']; }    ?>">
                        </td>
                    </tr>
                </table>
            </form>
            <br />
            <form id="register">
                <table style="border: dashed gray 1px; padding-right: 15px;" id="regiform" cellspacing="15" align="center">
                    <tr>
                        <td>
                            <h3 align="center ">&nbsp;&nbsp;Create new account</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p id="error_register" style="text-align: center; font-size: small; color: red"></p><br />
                            <input id="fn" name="firstname" type="text" placeholder="Firstname" minlength="3" maxlength="20" >
                        </td>
                    </tr>
                    <tr><td>
                            <input id="ln" name="lastname" type="text" placeholder="Lastname" minlength="3" maxlength="20">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="usn" name="usn" type="text" placeholder="USN" minlength="10" maxlength="10">
                        </td>
                    </tr>
                    <tr>
                        <td>
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
                            <button id="signup" type="button" name="signup">Sign up</button>
                            <input id="form_token2" type="hidden" name="register_token" value="<?php if(isset($_SESSION['session_token'])){ echo $_SESSION['session_token']; } ?>">
                        </td>
                    </tr>
                </table>
            </form>
            <br /><br /><br />
        </div>
    </div>



<script src="javascript/jquery-3.1.1.min.js"></script>
<script>

    function blur_button()
    {
        $("#login").blur();
        $("#signup").blur();
    }

    $(document).ready(function(){
        $("#login").click(function(){
          validate_login();
        });

        $("#signup").click(function(){
          is_register_form_valid();
        });
    });


    var error_count_login=0;
    function login_user()
    {
      if(error_count_login>2)
      {
        window.location="index.php";
      }
      else
      {
        $.ajax({
          url:"login.php",
          type:"POST",
          contenttype:"application/json",
          datatype:"JSON",
          data:$("#login_form input").serialize(),
          success:function(output){
            var res=output;
            if(res.error==="true")
            {
                $("#error_login").html("Incorrect Email-ID/Password");
                $("#error_login").show();
                error_count_login++;
            }
            else if(res.error=="blocked")
            {
              $("#error_login").html("Blocked by admin");
              $("#error_login").show();
            }
            else
            {
                window.location=res.redirect;
            }
          },
          error: function(){
            document.write("error");
          }
        });
      }
    }

    var error_count_register=0;
    function register_user()
    {
      if(error_count_register>2)
      {
        window.location="index.php";
      }
      else
      {
          $.ajax({
            url:"register.php",
            type:"POST",
            contenttype:"application/json",
            datatype:"JSON",
            data:$("#register input,select").serialize(),
            success:function(output){
              var res=output;
              if(res.error==="true")
              {
                  $("#error_register").html("Incorrect Data entered");
                  $("#error_register").show();
                  error_count_register++;
              }
              else if(res.error=="Oops! something went wrong , please try again.")
              {
                $("#error_register").html("Oops! something went wrong , please try again.");
                $("#error_register").show();
              }
              else if(res.error=="Account with same credentials already exists.")
              {
                $("#error_register").html("Account with same credentials <br />already exists.");
                $("#error_register").show();
              }
              else
              {
                  window.location=res.redirect;
              }
            },
            error: function(){
              document.write("error");
            }
          });
      }
    }

</script>


</body>
<footer style="display: inline;">
    <div class="footer" align="center" style="white-space: normal; background-color: #4CAF50;">
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
