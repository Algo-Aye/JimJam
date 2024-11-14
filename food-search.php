<?php include("partials-frontend/menu.php"); ?>  

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on Your Search <a href="#" class="text-white">"Momo"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //GET THE SEARCH KEYWORD FROM THE USER
                $search =$_POST['search'];

                //SQL QUERY TO GET FOODS BASED ON SEARCH KEYWORD FROM THE USER.
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //EXECUTE THE QUERY
                $res =mysqli_query($conn, $sql);

                //COUNT THE ROWS
                $count = mysqli_num_rows($res);

                //CHECK WHETHER THE FOOD IS AVAILABLE OR NOT
                if($count > 0)
                {
                    //FOOD IS AVAILABLE
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //Get the details
                        $id = $row["id"];
                        $title =$row["title"];
                        $price =$row['price'];
                        $description =$row["description"];
                        $image_name =$row['image_name'];

                        //NOW BREAK THE PHP AND ADD HTML CODES IN ORDER TO GET THE CATEGORY FROM DATABASE.
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                </div>
                                
                                <div class="food-menu-desc">
                                    <h4>Food Title</h4>
                                    <p class="food-price">$2.3</p>
                                    <p class="food-detail">
                                        Made with Italian Sauce, Chicken, and organice vegetables.
                                    </p>
                                    <br>
                                    
                                    <a href="#" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                        <?php

                    }
                }

                else
                {
                    //FOOD IS NOT AVAILABLE 
                    echo "<div class='error'>Food Is Not Found</div>";
                }

            ?>

           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

 


<?php include("partials-frontend/footer.php"); ?>      
