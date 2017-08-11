<?php
require("is_logged_sub_pages.php");
header('Content-Type: application/json');
if(isset($_POST['val']))
{


    //check request set to get datatype
    if($_POST['val']==="getdata" && (strlen($_POST['val']))==7)
    {
        $arr=["firstname"=>$_SESSION['user_firstname'],"lastname"=>$_SESSION['user_lastname'],"sem"=>$_SESSION['user_sem'],"usn"=>$_SESSION['user_usn'],"email"=>$_SESSION['user_email'],"error"=>"false"];
        echo json_encode($arr);
        exit();
    }
    else
    {
        $arr=["error"=>"true"];
        echo json_encode($arr);
        exit();
    }

}
else
{
    session_unset();
    session_destroy();
    header('Location:https://sptp.000webhostapp.com');
    exit();
}


?>
