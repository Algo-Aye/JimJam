<?php  include('partials/menu.php');?>
    
    
    <!-- Main Content starts-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            <br /> 

            <!--Display the message here-->
            <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']); // Display the message once and remove it.
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']); // Display the message once and remove it.
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']); // Display the message once and remove it.
            }

            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']); // Display the message once and remove it.
            }

            
            if(isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']); // Display the message once and remove it.
            }

            if(isset($_SESSION['change-pwd']))
            {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']); // Display the message once and remove it.
            }

            ?>
            
            <br><br> <br>
            
            <!--BUTTON TO ADD ADMIN-->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br /> <br /> <br />

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full  Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                
                <!--DISPLAY ALL THE DATA (ADMINS IN THE DATA IN THE DATA)-->
                <?php
                $sql = "SELECT * FROM tbl_admin";
                $res= mysqli_query($conn, $sql);

                /*Lets solve(when you delete data 5 or 4 in the table or database, the sequence will
                yet i want them to fill in that gap. so thats why i will assign the id to sn. ) */
                $sn =1; 
                
                //check whether the query is executed
                if($res==TRUE)
                {
                    //count the rows to check whether we have data in the database or not.
                    $count = mysqli_num_rows($res);

                    //Check the nnumber of rows
                    if($count > 0)
                    {
                        //we have data in the database.
                        while($rows =mysqli_fetch_assoc($res))
                        {
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];

                            //Display the values in the table

                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></php></td>
                                <td><?php echo $full_name;?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">update Admin</a>
                                    <a href="<?php  echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>
                            
                            
                            
                            <?php

                        }
                    }
                    else
                    {
                        //We dont have data in the database.

                    }
                }
                ?>
                

              

                
            </table>
            
            
        </div>
     </div>
    <!-- Main Content ends-->
    
    <?php include('partials/footer.php'); ?>