<?php include("partials-frontend/menu.php");

    if(isset($_GET['food_id']))
    {
        $food_id = $_GET['food_id'];
        $sql2 = "SELECT * FROM tbl_food WHERE id='$food_id' LIMIT 1";

    
        $res2 = mysqli_query($conn, $sql2);

        $food_row= mysqli_fetch_row($res2);
    
        $count2 = mysqli_num_rows($res2);

        $food_name = $food_row[1];
        $food_price = $food_row[3];
        $food_image = $food_row[4];
    }
    else{
        $count2 = 0;
    }
    
    
?>

<?php
//save the order in the database.

//Check whether the submit button is clicked or not 

if(isset($_POST['food_id']))
{
    //button clicked
   

    //get the data from the form
    $food_id = $_POST['food_id'];
    $food_qty = $_POST['qty'];
    $order_date = date("Y/m/d");
    
    $customerName = $_POST['full-name'];
    $customerContact =$_POST['contact'];
    $customerEmail = $_POST['email'];
    $customerAddress = $_POST['address'];

    $sql2 = "SELECT * FROM tbl_food WHERE id='$food_id' LIMIT 1";
    $res2 = mysqli_query($conn, $sql2);
    $food_row= mysqli_fetch_row($res2);
    $count2 = mysqli_num_rows($res2);
    $food_name = $food_row[1];
    $food_price = $food_row[3];

    $total_price = $food_qty*$food_price;


    $sql = "INSERT INTO tbl_order SET
        food='$food_id',
        price='$food_price',
        qty='$food_qty',
        total='$total_price',
        order_date='$order_date',
        status='pending',
        customer_name='$customerName',
        customer_contact='$customerContact',
        customer_email='$customerEmail',
        customer_address='$customerAddress'
    ";

   
    //Executing query and saving data into database.
    $res = mysqli_query($conn, $sql);

    //check whether the (query is executed or not)
    if($res==TRUE)
    {
        //data inserted succesffully
        //echo"Data inserted successfully";

        //create a session variable to display the message
        $_SESSION['add'] = 'Order created successfully.';
        echo "<script>alert('Order For $food_name Created Successfully');</script>";
        //redirect the page to Manage admin
        //header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //echo "Failed to insert data";

        //create a session variable to display the message
        $_SESSION['add'] = 'Failed Create Order.';
         echo "<script>alert('Order for $food_name Failed');</script>";
        //redirect the page to Add admin
        //header('location:'.SITEURL.'admin/add-admin.php');
    }
}


?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src=<?php echo ($count2>0)? "images/food/$food_image":"images/menu-pizza.jpg"; ?> alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo ($count2>0)? $food_name:"Food Title"; ?></h3>
                        <p class="food-price"><?php echo ($count2>0)? $food_price:"0.0"; ?></p>
                        <input type="number" id="item_id" name="food_id" class="input-responsive" value=<?php echo ($count2>0)? $food_id:"0"; ?> hidden/>
                        <div class="order-label">Quantity</div>
                        <input type="number" id="item_quantity" oninput="quantityChanged()" name="qty" class="input-responsive" value="1" required/>
                        <div class="order-label">Total Price</div>
                        <input type="number" id="total-food-price" name="qty" class="input-responsive"  value=<?php echo ($count2>0)? $food_price:"0.0"; ?> readonly/>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Jimjam" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 0776594369" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. jimjam@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <script>
        
        function quantityChanged(){
            var x = document.getElementById("item_quantity");
            var qty = x.value;
            var unit_price = <?php echo $food_price; ?>;
            var total_price = qty*unit_price;
            //alert("unit price is: "+total_price);
            document.getElementById("total-food-price").value = total_price;
        }
    </script>
 



<?php include("partials-frontend/footer.php"); ?>      