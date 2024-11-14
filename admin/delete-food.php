<?php 
    //include the database.
    include("../config/constants.php");

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Delete the values
        //1. Get id and image
        $id = $_GET['id'];
        $image_name=$_GET['image_name'];

        //2. Remove the image if available
        //Check whether the image is available and delete it if its available.
        If($image_name != "")
        {
            //Image is available
            //Now get the image path
            $path="../images/food/".$image_name;

            //Remove the image file from the folder
            $remove = unlink($path);

            //Check whether the image is removed or not.
            if($remove == false)
            {
                //Failed to remove Image.
                $_SESSION['upload'] ="<div class='error'>Failed To Remove The Image</div>";
                header("location:".SITEURL."admin/manage-food.php");

                //Stop the process because we do not want to remove the image.
                die();
            }
        }


        //3. Delete Food From Database.
        $sql ="DELETE FROM tbl_food WHERE id='$id'";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //Check whether the query was execute successfully.
        //4. Redirect to manage Food page with a message.
        if($res == TRUE)
        {
            //Deleted successfully
            $_SESSION["delete"] = "<div class='success'>Food Deleted Successfully</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }

        else
        {
            //Failed to Delete
            $_SESSION["delete"] = "<div class='error'>Failed To Delete Food.</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }

        
    }

    else
    {
        //Redirect to manage Food Page
        $_SESSION['unauthorize'] ="<div class='error'>Unauthorized Access.</div>";
        header("location:".SITEURL."admin/manage-food.php");
    }
?>