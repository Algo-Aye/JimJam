<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>



        <?php
            //Check whether the id is set or nor.
            if(isset($_GET['id']))
            {
                //Get the id and other details
                //echo "Getting data";
                $id = $_GET['id'];

                //Create sql query to get all other details.
                $sql ="SELECT * FROM tbl_category WHERE id=$id";

                //Execute the query
                $res =mysqli_query($conn,$sql);

                //Count the rows to check whether the id id valid or not.
                $count=mysqli_num_rows($res);

                if($count == 1)
                {
                    //Get all the data.
                    $row =mysqli_fetch_assoc($res);

                    $title=$row["title"];
                    $current_image=$row["image_name"];
                    $featured=$row["featured"];
                    $active=$row['active'];

                }

                else
                {
                    //Redirect to Manage Category Page with a message.
                    $_SESSION['no-category-found'] ="<div class='error'>Category Not Found.</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                }
            }
            
            else
            {
                //Redirect to Manage Category
                header("location:".SITEURL."admin/manage-category.php");
            }

        ?>



        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Ttile: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                //Display the image.

                                ?>

                                <!--Now Display the image-->
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="80px" height="80px">

                                <?php

                            }

                            else
                            {
                                //Display the message.
                                echo "<div class='error'>Image Not Added.</div>";
                            }

                        ?>


                    </td>
                </tr>
                
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes

                        <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes

                        <input <?php if($active == "No"){echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>

                        <!-- We shall use this values id and current_image when checking whether the submit button is clicked or not.-->

                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>


        <?php
            //Check whether the submit button clicked or not
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //1:Get all the values from our form.
                $id = $_POST['id'];
                $title= $_POST['title'];
                $current_image= $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2: Updating the new image if selected
                //Check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //Get the image details
                    $image_name=$_FILES['image']['name'];

                    //Check whether the image is available or not.
                    if($image_name != "")
                    {
                        //Image is available
                        //SECTION: Upload the new image.

                        //Auto rename the images that will be uploaded to avoid storage of the same image with the same name.
                            //Get the extension of our image(jpg, gif, etc) e.g 'burger1.jpg'
                            //the purpose of the end to is to get the .jpg or png etc.
                            //ext means extension
                            $ext = end(explode('.', $image_name));

                            //Now Rename the image, add the minimum and maximum values and a random value.
                            //Food_Category will be the name added to the database like this (e.g Food_Category_1412.jpg)
                            $image_name ="Food_Category_".rand(000, 999).".".$ext;



                            $source_path=$_FILES['image']['tmp_name']; //this should be the same as $image_name.

                            $destination_path="../images/category/".$image_name;

                            //Upload the image.
                            $upload=move_uploaded_file($source_path,$destination_path);

                            //Check whether the image is uploaded or not.
                            // and if the image is not uploaded thenwe will stop the process and redirect with error message.
                            if($upload==false)
                            {
                                //set the message
                                $_SESSION['upload'] ="<div class='error'>Failed To Upload Image.</div>";

                                //Redirect to Add category page
                                header("location:".SITEURL."admin/manage-category.php");

                                //STOP THE PROCESS
                                die();
                            }



                        //SECTION B: Remove the current image if available.
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            //Check whether the image is removed or not
                            //If failed to remove then display a message and stop the process.
                            if($remove==false)
                            {
                                //Failed to remove Image.
                                $_SESSION["failed-remove"] ="<div class='error'>Failed To Remove The Current Image.</div>";
                                header("location:".SITEURL."admin/manage-category.php");

                                die(); // stop the process.
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
                    $image_name =$current_image;
                }


                //3:Update the database.
                $sql2 ="UPDATE tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                WHERE id=$id
                ";

                //Execute the qury
                $res2 =mysqli_query($conn,$sql2);

                //4. Redirect to Manage Category with a message.
                //check whether the query was executed or not
                if($res2 ==TRUE)
                {
                    //Category updated
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                }

                else
                {
                    //Failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed To Update Category.</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                }


            }
        
        
        
        
        
        ?>


    </div>
</div>


<?php include("partials/footer.php"); ?>