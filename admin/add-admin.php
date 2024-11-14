<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        
        <!--Display the message-->
        <?php if(isset($_SESSION['add']))
        {
            echo$_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="enter your full names">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="enter your usernames">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="enter your password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>


<?php include('partials/footer.php');?>

<?php
//save the data in the database.

//Check whether the submit button is clicked or not 

if(isset($_POST['submit']))
{
    //button clicked
    //echo 'Button clicked';

    //get the data from the form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //md5 for password encryption 

    //SQL query to save the data into database

    $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
    ";

   
    //Executing query and saving data into database.
    $res = mysqli_query($conn, $sql);

    //check whether the (query is executed or not)
    if($res==TRUE)
    {
        //data inserted succesffully
        //echo"Data inserted successfully";

        //create a session variable to display the message
        $_SESSION['add'] = 'Admin added successfully.';

        //redirect the page to Manage admin
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //echo "Failed to insert data";

        //create a session variable to display the message
        $_SESSION['add'] = 'Failed to Add Admin.';

        //redirect the page to Add admin
        header('location:'.SITEURL.'admin/add-admin.php');
    }
    }


?>