<?php include('partials/menu.php'); ?>


 <!-- Main Content starts-->
 <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>

            <br /> <br />
            <!--BUTTON TO ADD ADMIN-->
            <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

            <br /> <br /> <br />

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }


                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                

                if(isset($_SESSION['unauthorize']))
                {
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>


            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    //Creat sql query to get all the good
                    $sql="SELECT * FROM tbl_food";

                    //Execute the query
                    $res =mysqli_query($conn,$sql);

                    //Count the rows to check whether we have food or not
                    $count =mysqli_num_rows($res);


                    //create a serial Number 
                    $sn =1;

                    if ($count > 0)
                    {
                        //We have food in the data.
                        while($row =mysqli_fetch_assoc($res))
                        {
                            //Get the values from individual columns
                            $id=$row['id'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $image_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];

                            //NOW BREAK THE PHP AND OPEN IT AGAIN AND THEN ADD THE ROWS IN HMTL

                            ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>ugx<?php echo $price; ?></td>
                                <td>
                                    <?php
                                        //Check whether we have image or not 
                                        if($image_name =="")
                                        {
                                            //We do not have an image. Display an error message.
                                            echo "<div class='error'>Image Not Added.</div>";
                                        }
                                        else
                                        {
                                            //We have the Image 
                                            //SO, BREAK THE PHP CODES AND ADD THE HTML (SOURCE PATH FOR THE IMAGE.) AND THEN OPEN THE PHP AGAIN.
                                            ?>

                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="80px" height="80px">
                                            <?php
                                        }
                                    ?>

                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                        
                                </td>
                            </tr>

                            <?PHP


                        }
                    }

                    else
                    {
                        //There is no food in the database.
                        //SO INSTEAD OF BRAKING PHP AND WRITING HTML CODED ALONE, YOU CAN PUT HTML CODES IN PHP LIKE THIS.
                        echo "<tr> <td colspan='7' class='error'>There Is No Food Added Yet.</td> </tr>";
                    }


                ?>

                

               
            </table>
            
            
        </div>
     </div>
    <!-- Main Content ends-->

<?php include('partials/footer.php'); ?>