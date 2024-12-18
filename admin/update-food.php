<?php include("partials/menu.php"); 
ob_start(); // Start output buffering
?>



<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

<?php
    //Check whether id is set or not.
    if(isset($_GET["id"]))
    {
        //Get all the details 
        $id = $_GET["id"];

        //Sql query to get the selected food
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        //Execute the query 
        $res2 = mysqli_query($conn, $sql2);

        //Get the value based on the query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the individual values of the selected food.
        $title = $row2["title"];
        $description = $row2["description"];
        $price = $row2["price"];
        $current_image = $row2["image_name"];
        $current_category = $row2["category_id"];
        $featured = $row2["featured"];
        $active = $row2["active"];




    }

    else
    {
        //Redirect to Manage Food
        header("location:".SITEURL."admin/manage-food.php");
    }

?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            //Check Whether the image is available or not
                            if($current_image == "")
                            {
                                //Image not Available
                                echo "<div class='error'>Image Not Available</div>";
                            }

                            else
                            {
                                //Image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="80px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                                //Query to get the active category
                                $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                                //Execute the query
                                $res = mysqli_query($conn, $sql);

                                //Count the rows
                                $count = mysqli_num_rows($res);

                                //Check whether category id available or not
                                if($count > 0)
                                {
                                    //Category is available
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];

                                        //SO NO MORE BREAKING PHP. WE SHALL JUST ADD THE HTML CODES IN THE PHP CODES
                                        //<?php if($current_category == $category_id) {echo 'selected';} to select the category id of
                                        //that item. if its chicken, then its id in the options is chicken.
                                       // echo "<option value='$category_id'>$category_title</option>";
                                       ?>
                                       <option <?php if($current_category == $category_id) {echo 'selected';} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                       <?php
                                    }
                                }

                                else
                                {
                                    //Not Category
                                    echo "<option value='0'>Category Not Available.</option>";
                                }
                            ?>
                  
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured == 'Yes') {echo 'checked';} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured == 'No') {echo 'checked';} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active == 'Yes') {echo 'checked';} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active == 'No') {echo 'checked';} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


        <?php
            //1. Lets check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //1. Get all the details from the form
                $id=$_POST['id'];
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $current_image=$_POST['current_image'];
                $category=$_POST['category'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];
                
                
                //2.  Upolad the image if selected
                //Check Whether the upload button is clicked or not
                if(isset($_FILES['image']['name']))
                {
                    //Upload button is clicked
                    $image_name = $_FILES['image']['name']; //the new image name.

                    //Check whether the image is available or not
                    if($image_name !="")
                    {
                        //Image is available
                        //SECTION A: UPLOADING THE NEW IMAGE=======================================================

                        //Now get the extension like jpg, png etc
                        //$image_parts = explode('.', $image_name);
                        //$ext = end($image_parts);

                        $ext = end(explode('.', $image_name));

                        //Now Rename the image
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext;

                        //Now upload the image. and for this we need source path and the destination path.
                        $src_path = $_FILES['image']['tmp_name'];
                        
                        $dst_path = "../images/food/".$image_name;

                        //NOW UPLOAD THE IMAGE
                        $upload = move_uploaded_file($src_path, $dst_path);

                        //Check whether the image is uploaded or not
                        if($upload == false)
                        {
                            //Failed To Upload The New Image
                            //stop the process
                            $_SESSION['upload'] = "<div class='error'>Failed To Upload The New Image.</div>";
                            header("location:".SITEURL."admin/manage-food.php");

                            die();
                        }



                        //SECTION B: REMOVING THE CURRENT IMAGE IF AVAILABLE.=================================================
                        //3. Remove the image if new image is uploaded and current image exists
                        if($current_image != '')
                        {
                            //Current image is available
                            //Remove the Image
                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            if($remove == false)
                            {
                                //Failed to remove the Image
                                //Stop the process.
                                $_SESSION["remove-failed"] = "<div class='error'>Failed To Remove The image.</div>";
                                header("location:".SITEURL."admin/manage-food.php");

                                die();
                            }
                        }





                    }

                    else
                    {
                        $image_name =$current_image;
                    }

                    

                }

                else
                {
                    $image_name = $current_image;
                }

                

                //4. Update the food in database
                $sql3 = "UPDATE tbl_food SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id='$category',
                featured='$featured',
                active='$active'
                WHERE id=$id
                ";

                //Execute the sql query
                $res3 = mysqli_query($conn, $sql3);
                
                //Check whether the query is executed or not.
                if($res3 == TRUE)
                {
                    //Query executed
                    $_SESSION["update"] = "<di class='success'>Food Updated Successfully.</div>";
                    header("location:".SITEURL."admin/manage-food.php");
                }

                else
                {
                    //Failed to update food.
                    $_SESSION["update"] = "<di class='error'>Failed To Update Food.</div>";
                    header("location:".SITEURL."admin/manage-food.php");
                }



            }
            

        ?>

    </div>
</div>

<?php include("partials/footer.php"); 
ob_end_flush(); // End output buffering
?>