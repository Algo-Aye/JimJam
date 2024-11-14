<?php

//Aunthentication or access control.
//Check whether the user is logged in or not.
//And this is only checked when the user is successfully logged in.

//So, check if user is not set.
if(!isset($_SESSION['user']))
{
    //User is not logged in
    //Redirect to the login page with a message.
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login To Access The Admin Panel.</div>";
    header("location:".SITEURL."admin/login.php");
}



?>