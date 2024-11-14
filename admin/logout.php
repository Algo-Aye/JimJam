<?php
//include the database
include("../config/constants.php");

//destroy the session
session_destroy(); //unset $_SESSION['user'];

//Redirect to the login page
header("location:".SITEURL."admin/login.php");
?>