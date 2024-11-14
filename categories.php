<?php include("partials-frontend/menu.php"); ?>  



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //DISPLAY ALL THE CATEGORIES THAT ARE ACTIVE.
                //SQL QUERY
                $sql ="SELECT * FROM tbl_category WHERE active='Yes'";

                //EXECUTE THE QUERY
                $res = mysqli_query($conn, $sql);

                //Count the rows
                $count = mysqli_num_rows($res);

                //CHECK WHETHER CATEGORY IS AVAILABLE OR NOT
                if($count > 0)
                {
                    //CATEGORY IS AVAILABLE
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //GET THE VALUES LIKE ID, TITLE AND IMAGE_NAME.
                        $id = $row["id"];
                        $title= $row["title"];
                        $image_name = $row["image_name"];

                        //NOW BREAK THE PHP AND ADD HTML CODES IN ORDER TO GET THE CATEGORY FROM DATABASE.
                        ?>
                        <a href="category-foods.html">
                            <div class="box-3 float-container">
                                <?php
                                    //NOW CHECK WHETHER THE IMAGE IS AVAILABLE OR NOT.
                                    if($image_name == "")
                                    {
                                        //Image Not Available.
                                        echo "<div class='error'>Image Not Available</div>";
                                    }

                                    else
                                    {
                                        //Image Available
                                        //NOW BREAK THE PHP AND ADD HTML CODES IN ORDER TO GET THE CATEGORY FROM DATABASE.
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                                        <?php

                                    }
                                

                                ?>
                                
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php

                    } 
                }

                else
                {
                    //CATEGORY NOT AVAILABLE
                    echo "<div class='error'>Category Not Available.</div>";
                }



            ?>

            

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



<?php include("partials-frontend/footer.php"); ?>    