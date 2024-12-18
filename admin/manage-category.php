<?php include('partials/menu.php'); ?>


 <!-- Main Content starts-->
 <div class="main-content">
        <div class="wrapper">
            <h1>Manage Category</h1>

            <br /> <br />

            <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }

            ?>

            <br><br>
            
            <!--BUTTON TO ADD ADMIN-->
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

            <br /> <br /> <br />

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                //FETCH ALL CATEGORY DATA FROM DATABASE.
                $sql ="SELECT * FROM tbl_category";

                //Execute the query.
                $res=mysqli_query($conn,$sql);


                //Count the rows
                $count =mysqli_num_rows($res);

                //Create serial number variable. and later increment it by (echo $sn++) in the table.
                $sn = 1;

                //Check whether we have data in the database.
                if($count > 0)
                {
                    //we have data in the database.
                    //Get data and display it
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];

                        ?>

                        <tr>
                            <td><?php echo $sn++; ?>.</td>
                            <td><?php echo $title; ?></td>

                            <td>
                                <?php 
                                    //Check Whether image name is available or not.
                                    //So, if image is not empty,(image_name!="") then display the image.
                                    if($image_name!="")
                                    {
                                        //Display the message.
                                        ?>

                                        <!--So, if the image is not empty, then enter into the SITEURL(WHICH IS FOOD-ORDER), images/category. and then display the image.---->
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="80px" height="80px">



                                        <?php
                                    }
                                    
                                    else
                                    {
                                        //Display the message.
                                        echo "<div class='error'>Image Not Added.</div>";
                                    }
                                
                                ?>
                            </td>

                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">update Category</a>
                                
                                <!--THIS WILL DELETE THE ADDED CATEGORY AND ITS IMAGE WILL ALSO BE DELETED FROM THE FOLDER.-->
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;  ?>" class="btn-danger">Delete Category</a>
                        
                            </td>

                        </tr>


                        <?php
                    }
                }

                else
                {
                    //There is no data in the database.
                    //we will display the message inside the table.
                    ?>

                    <tr>
                        <td colspan="6"><div class="error">No Category Added.</div></td>
                    </tr>

                    <?php
                }

                ?>


                
            </table>
            
            
        </div>
     </div>
    <!-- Main Content ends-->

<?php include('partials/footer.php'); ?>