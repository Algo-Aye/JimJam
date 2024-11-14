<?php include("partials-frontend/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->




    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //Create sql query to display Categories from database.
                //YOU CAN ALSO SET THE LIMIT IN THE QUERY (DISPLAY 3 IMAGES IN ONE ROW.)
                $sql ="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                
                //EXECUTE THE QUERY
                $res = mysqli_query($conn, $sql);

                //Count the rows to check whether the category is available.
                $count = mysqli_num_rows($res);

                if($count > 0)
                {
                    //CATEGORY IS AVAILABLE
                    while($row =mysqli_fetch_assoc($res))
                    {
                        //GET THE VALUES LIKE ID, TITLE, IMAGE_NAME.
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        //NOW BREAK THE PHP AND WRITE HTML CODES TO GET CATEGORY FROM THE DATABASE.
                        //AND THEN CLOSE PHP.
                        ?>
                        <a href="category-foods.php">
                            <div class="box-3 float-container">
                                <?php
                                //CHCK WHETHER THE IMAGE IS AVAILABLE OR NOT.
                                if($image_name == '')
                                {
                                    //DISPLAY MESSAGE
                                    echo "<div class='error'>Image Not Available.</div>";
                                }

                                else
                                {
                                    //Image Available
                                    //NOW DISPLAY THE CATEGORY.
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
                    //CATEGORY IS NOT AVAILABLE.
                    echo "<div class='error'>Category Not Available.</div>";
                }

            ?>

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->








    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                //Write sql query to get food from the database.
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                //EXECUTE THE QUERY
                $res2 = mysqli_query($conn, $sql2);

                
                //COUNT THE ROWS
                $count2 = mysqli_num_rows($res2);

                //CHECK WHETHER THE FOOD IS AVAILABLE OR NOT.
                if($count2 > 0)
                {
                    //FOOD IS AVAILABLE
                    while($row2 = mysqli_fetch_assoc($res2))
                    {
                        $id = $row2["id"];
                        $title = $row2["title"];
                        $price =$row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2["image_name"];
                        $order_page = "?food_id=$id";
                        //NOW BREAK THE PHP AND WRITE HTML CODES TO GET CATEGORY FROM THE DATABASE.
                        //AND THEN CLOSE PHP.
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //CHECK WHETHER THE IMAGE IS AVAILABLE OR NOT
                                    if($image_name == "")
                                    {
                                        //Image Not available
                                        echo "<div class='error'>Image Not Available.</div>";
                                    }

                                    else
                                    {
                                        //Imaga Available
                                        //NOW BREAK THE PHP AND WRITE HTML CODES TO GET CATEGORY FROM THE DATABASE.
                                        //AND THEN CLOSE PHP.
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                        <?php
                                    }
                                ?>
                                
                            </div>
                            
                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">ugx<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                
                                <br>
                                
                                <a href=<?php echo "order.php".$order_page; ?> class="btn btn-primary">Order Now</a>'
                            
                            </div>
                        </div>


                        <?php


                    }
                }

                else
                {
                    echo "<div class='error'>Food Not Available.</div>";
                }
            ?>

            
            

            

           
            

           


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->



<?php include("partials-frontend/footer.php"); ?>    