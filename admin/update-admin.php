<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Upate admin</h1>

        <br><br>
        <?php
        //Get the id of the selected admin
        $id=$_GET['id'];

        //create sql query to get the detials
        $sql= "SELECT * FROM tbl_admin WHERE id=$id";

        //Execute the query
        $res=mysqli_query($conn,$sql);

        //Check whether the query is executed or not.
        if($res==TRUE)
        {
            //Check whether the data is available or not.
            $count = mysqli_num_rows($res);

            //check whether we have admin data or not.
            if($count ==1)
            {
                //Get the details
                $row =mysqli_fetch_assoc($res);
                $full_name =$row['full_name'];
                $username =$row['username'];
            }

            else
            {
                //Redirect to Manage Admin page.
                header('location: '.SITEURL.'admin/manage-admin.php');
            }

        }


        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
    

        </form>
        

    </div>
</div>




<?php 

//CHeck whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    $id=$_POST['id'];
$full_name=$_POST['full_name'];
$username=$_POST['username'];

//Create a sql query to update the Admin
$sql= "UPDATE tbl_admin SET
full_name='$full_name',
username='$username'
WHERE id='$id'
";


//Execute the query
$res=mysqli_query($conn,$sql);

//check whether the query executed successfully.
if($res==TRUE)
{
    //query executed and admin update successfully
    $_SESSION['update'] ="<div class='success'>Admin updated successfully.</div>";
    header("location: ".SITEURL."admin/manage-admin.php");
}

else
{
    //Failed to update admin
    $_SESSION['update'] ="<div class='error'>Failed to update Admin.</div>";
    header("location: ".SITEURL."admin/manage-admin.php");

}
}


?>


<?php include('partials/footer.php'); ?>