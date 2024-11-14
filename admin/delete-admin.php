<?php

//Include constants.php file here
include('../config/constants.php');

//Get the id of the admin to be deleted
echo $id =$_GET['id'];

//create sql query to delete the admin
$sql ="DELETE FROM tbl_admin WHERE id=$id";

//Execute the query
$res =mysqli_query($conn,$sql);

//check whether the query executed successfully.
if($res==TRUE)
{
    //Admin deleted successfully
    //echo "Admin deleted successfully";

    //Create a session 
    $_SESSION['delete'] = "<div class='success'>Admin deleted successfully.</div>";

    //Redirect to manage admin page
    header('location: '.SITEURL.'admin/manage-admin.php');
}

else
{
    //Failed to delete the admin successfully.
    echo "Failed to delete the admin";
    $_SESSION["delete"] = "<div class='error'>Failed to delete the admin.</div>";
    header("location: ".SITEURL."admin/manage-admin.php");

}
//Redirect to manage admin page with a message (success or error)
?>