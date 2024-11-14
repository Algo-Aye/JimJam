<?php include("partials/menu.php");?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>

            <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>

            <br><br>

            <!--BEGIN- Add Category form ---->
            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="category title">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
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
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
            <!--- Add Category form END---->



            <?php
                //check whether the submit button is clicked or not
                if(isset($_POST['submit']))
                {

                    //1: Get the value from category form
                    $title = $_POST['title'];

                    //for radio input, we need to check whether the button is selected or not.
                    if(isset($_POST['featured']))
                    {
                        //Get the value from the form
                        $featured = $_POST['featured'];
                    }

                    else
                    {
                        //Set the default value.
                        $featured ='No';
                    }


                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }

                    else{
                        $active = 'No';
                    }


                    //Check whether the image is selected or not and set the value for image name.
                   // print_r($_FILES['image']);
                    //die();

                    
                    if(isset($_FILES['image']['name']))
                    {
                        //Upload the image
                        //To upload the image, we need image name, source path and destination path.
                         $image_name=$_FILES['image']['name'];

                        //Upload the image only if image is selected.
                        //And if the image is not selected, then do not upload the image.
                        if($image_name != "")
                        {

                        
                         

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
                                header("location:".SITEURL."admin/add-category.php");

                                //STOP THE PROCESS
                                die();
                            }
                        }


                    } 

                    else
                    {
                        //Don't upload the image and set the image name value as blank.
                        $image_name="";
                    }
                        



                    //2: Now create a sql query to enter the above data into the database.
                    $sql ="INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    ";

                    //3: Now execute the query to save in the database.
                    $res = mysqli_query($conn,$sql);

                    //4: Check whether the query executed or not and data added or not.
                    if($res==TRUE)
                    {
                        //Query executed successfully and category added
                        $_SESSION['add'] ="<div class='success'>Category Added Successfully.</div>";
                        
                        //Now redirect it to the manage-category page
                        header("location:".SITEURL."admin/manage-category.php");
                    }

                    else
                    {
                        //Failed to add category
                        $_SESSION['add'] ="<div class='error'>Failed to add category.</div>";
                        
                        //Now redirect it to the manage-category page
                        header("location:".SITEURL."admin/add-category");
                    }
                }
            ?>


        </div>
    </div>


<?php include("partials/footer.php"); ?>