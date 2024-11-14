<?php

    //include the database.
    include('../config/constants.php');

    //Check whether the id and image_name value is set or not.
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Get the value and delete it.
        $id = $_GET['id'];
        $image_name=$_GET['image_name'];

        //Remove the physical image if its available
        if($image_name != "")
        {
            //Check whether the image is available.
            $path="../images/category/".$image_name;

            //so remove the image.
            $remove= unlink($path);

            //IF FAILED TO REMOVE THE IMAGE THEN ADD AN ERROR MESSAGE AND STOP THE PROCESS.
            if($remove == false)
            {
                //set the session message
                $_SESSION['remove'] = "<div class='error'>Failed To Remove Category Image.</div>";

                //Redirect to Manage Category page.
                header("location:".SITEURL."admin/manage-category.php");

                //stop the process
                die();
            }

        }

        //sql query to Delete data from database.
        $sql ="DELETE FROM tbl_category WHERE id=$id";

        //Execute the query
        $res=mysqli_query($conn,$sql);


        //Check whether the data is deleted from the database.
        if($res==TRUE)
        {
            //Set the success message. and redirect
            $_SESSION['delete'] ="<div class='success'>Category Deleted Successfully.</div>";
            //redirect to manage Category Page
            header("location:".SITEURL."admin/manage-category.php");
        }

        else
        {
            //Set failed message and redirect.
            $_SESSION['delete'] ="<div class='error'>Failed to Delete Category.</div>";
            //redirect to manage Category Page
            header("location:".SITEURL."admin/manage-category.php");
        }

        
    }

    else
    {
        //Redirect to Manage Category Page.
        header("location:".SITEURL."admin/manage-category.php");
    }
?>