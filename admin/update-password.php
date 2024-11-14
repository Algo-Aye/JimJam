<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        //Get the id
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        ?>





        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>




<?php

//Check whether the submit is clicked.
if(isset($_POST['submit']))
{
    //Get the data from the form
    $id = $_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

    //Check whether the user with current id and current password exits or not.
    $sql ="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    if($res==TRUE)
    {
        //check whether data is available or not
        $count=mysqli_num_rows($res);


        if($count==1)
        {
            //User exits and password can changed.
            //echo "user found";

            //Check whether new password and confirm password match
            if($new_password==$confirm_password)
            {
                //update the password
                //Write a sql query to update the password.
                $sql2 = "UPDATE tbl_admin SET 
                password ='$new_password'
                WHERE id =$id
                ";

                $res2 = mysqli_query($conn, $sql2);

                //check whether the query is executed or not.
                if($res2==TRUE)
                {
                    //Display the success message.
                    //redirect to manage-admin page with the success message.
                    $_SESSION['change-pwd'] ="<div class='success'>Password Changed Successfully.</div>";
                    header("location:".SITEURL."admin/manage-admin.php");
                }

                else
                {
                    //Display the error message.
                    //redirect to manage-admin page with the error message.
                    $_SESSION['change-pwd'] ="<div class='error'>Failed To Change Password.</div>";
                    header("location:".SITEURL."admin/manage-admin.php");
                }

            }
            else
            {
                //redirect to manage-admin page with the error message.
                //User does not exist. set the message and redirect
                $_SESSION['pwd-not-match'] ="<div class='error'>Password Does Not Match.</div>";
                header("location:".SITEURL."admin/manage-admin.php");

            }
        }



        else
        {
            //User does not exist. set the message and redirect
            $_SESSION['user-not-found'] ="<div class='error'>User not found.</div>";
            header("location:".SITEURL."admin/manage-admin.php");
        }
        

    }


    //Check whether the new password and confirm password match

    //change password if all above is true.
}

?>



<?php include('partials/footer.php'); ?>