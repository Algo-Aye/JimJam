<?php 
//First connect to the database.
include("../config/constants.php");
?>


<html>
    <head>
        <title>Login, Food order Website</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login-body">
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                //This is where the Error login message will be displayed.

                if(isset($_SESSION["login"]))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                //This will display the message of login-check
                //If you try to enter the admin panel without logging in then, it will redirect you to login page with a message.
                if(isset($_SESSION["no-login-message"]))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>

            <br><br>

            <!--BEGIN LOGIN FORM--->
            <form action="" method="POST" class="text-center" class="form">
                Username:
                <br>
                <input type="text" name="username" placeholder="Enter your username">
                <br><br>

                Password:
                <br>
                <input type="password" name="password" placeholder="Enter your password">
                <br><br>
                
                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>

            </form>
            <!--LOGIN FORM-END-->
            
            <p class="text-center">Developed By - <a href="#">Jimjam Enterprise.</a></p>
        </div>
    </body>
</html>


<?php

    //Check whether the submit button is clicked
    if(isset($_POST['submit']))
    {
        //Process for login
        //1: Get the data from the login form
        $username=$_POST['username'];
        $password=md5($_POST['password']);

        //2: Write sql query to check whether the username and password exits or not.
        $sql ="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3: EXecute the query
        $res = mysqli_query($conn, $sql);

        //Count rows to check whether the user exists or not.
        $count=mysqli_num_rows($res);

        if($count==1)
        {
            //User exits
            $_SESSION['login'] ="<div class='success'>User Logged in Successfully.</div>";
            
            //check whether user is logged in or not and logout will unset it.
            $_SESSION["user"] = $username;


            //Redirect it to the Admin home/Dashboard page
            header("location:".SITEURL."admin/index.php");
        }

        else
        {
            //User Not Available
            $_SESSION['login'] ="<div class='error text-center'>Username or Password Did Not match.</div>";

            //Redirect it to the Admin home/Dashboard page
            header("location:".SITEURL."admin/login.php");
        }
    }

?>