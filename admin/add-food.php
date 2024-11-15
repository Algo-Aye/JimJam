<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        
        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                //Unset means delete the session once displayed.
                unset($_SESSION['upload']);
            } 
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                //create php code to display categories from database.
                                //1. Create  sql to get all active categories from database.
                                //2.Display on a dropdown.
                                $sql ="SELECT * FROM tbl_category WHERE active='Yes'";  

                                //Execute the query
                                $res = mysqli_query($conn, $sql);

                                //Count rows to check whether we have catogies or not.
                                $count=mysqli_num_rows($res);

                                //if count is greater then zero, we have categories else we dont 
                                if($count > 0)
                                {
                                    //we have categories
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        //Get the details of Category.
                                        $id=$row['id'];
                                        $title=$row['title'];

                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }

                                else
                                {
                                    //We do not have categoris
                                    ?>

                                    <option value="0">No Category found</option>

                                    <?php

                                }
                            

                            ?>
                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            //Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the food.
                //echo "clicked";
                //1: Get data from the form
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $category=$_POST['category'];

                //Check whether radio button for featured and active are checked or not.
                //checking for featured
                if(isset($_POST['featured']))
                {
                    $featured =$_POST['featured'];
                }

                else
                {
                    $featured="No"; //Setting it to the defualt value.
                }

                //Checking for Active
                if(isset($_POST["active"]))
                {
                    $active=$_POST["active"];
                }

                else
                {
                    $active= "No";  //Setting it to the defualt value.
                }

                //2: Upload the image if selected--------------------------------------------------
                //Check whether the select image is clicked and upload the image if only its clicked.
                //The name of the image in this form is (image) and in the database its image_name
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of the selected image.-------------------------------------------------
                    $image_name=$_FILES['image']['name'];

                    //Now check whether the image is selected and upload it if its selected.
                    if($image_name != '')
                    {
                        //Image is selected.-------------------------------------------------------------
                        //Section A: Rename the image.
                        //Get the extension of the image(like jpg, png, gif etc)
                        //Food_Name17401.jpg
                        $ext =end(explode('.', $image_name));

                        //NOW CREATE THE NEW NAME FOR THE IMAGE.
                        $image_name="Food-Name-".rand(0000,9999).".".$ext;


                        //Section B: uplaod the image.
                        //Get the source path and destination path.

                        //Get the source path (This is the current location of the image.)
                        //if it says (Image failed to upload here(tmp_name) and source path of the image. and see if its correct.)
                        $src =$_FILES["image"]["tmp_name"];
                        
                        //Get the destination path(where the image be uploaded. which is images/food).
                        $dst="../images/food/".$image_name;

                        //Now Upload the Food image.
                        $upload =move_uploaded_file($src,$dst);

                        //Now Check whether the image is uploaded or not
                        if($upload ==false)
                        {
                            //Failed to upload the image and Redirec to add food page
                            $_SESSION['upload'] ="<div class='error'>Failed To Upload The Image.</div>";
                            header("location:".SITEURL."admin/add-food.php");

                            //stop the process because we don't want it in our database.
                            die();
                        }

                    }
                }
                else
                {
                    $image_name=""; //Setting its default value as blank.
                }

                //3: Insert data into database.
                //Create sql query to save or add data into the database.
                $sql2 ="INSERT INTO tbl_food SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
                ";

                //Execute the query.
                $res2=mysqli_query($conn,$sql2);

                //Check whether the data is inserted into database.
                //4: Redirect with message to Manage food page
                if($res2 ==TRUE)
                {
                    $food_id = mysqli_insert_id($conn);
                    //Data is inserted successfully
                    /*$_SESSION["add"] = "<div class='success'>Food Added Successfully.</di>";*/
                    echo "<script>sendGetRequest('$food_id', '$title');</script>";
                    /*header("location:".SITEURL."admin/manage-food.php");*/
                }

                else
                {
                    //Failed To insert data.
                    $_SESSION["add"] = "<div class='error'>Failed to Add Food.</di>";
                    header("location:".SITEURL."admin/manage-food.php");
                }

                
            }

        ?>
    </div>
</div>




<?php include('partials/footer.php'); ?>