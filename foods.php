<?php include("partials-frontend/menu.php"); ?>  

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                //DISPLAY ALL THE FOODS THAT ARE ACTIVE ONLY
                //WRITE SQL QUERY TO GET FOODS FROM THE DATABASE.
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                //EXECUTE THE QUERY
                $res =mysqli_query($conn, $sql);

                //COUNT THE ROWS 
                $count = mysqli_num_rows($res);

                //CHECK WHETHER THE FOODS ARE AVAILABLE OR NOT.
                if($count > 0)
                {
                    //FOOD IS AVAILABLE
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //GET THE VALUES LIKE ID, TITLE,
                        $id =$row['id'];
                        $title =$row['title'];
                        $price =$row['price'];
                        $description =$row['description'];
                        $image_name =$row['image_name'];
                        $order_page = "?food_id=$id";
                        //NOW BREAK THE PHP AND ADD HTML CODES IN ORDER TO GET THE CATEGORY FROM DATABASE.
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //CHECK WHETHER THE IMAGE IS AVAILABLE OR NOT
                                    if($image_name == "")
                                    {
                                        //Image Not available 
                                        echo "<div class='error'>Image Not Available</div>";
                                    } 

                                    else
                                    {
                                        //Image Available
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
                                
                                <a href=<?php echo "order.php".$order_page; ?> class="btn btn-primary">Order Now</a>
                            </div>
                        </div>


                        <?php

                    }
                }

                else
                {
                    //FOOD NOT AVAILABLE
                    echo "<div class='error'>Food Not Available.</div>";
                }
            ?>

            

            

           

            

            

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

 


<?php include("partials-frontend/footer.php"); ?>      