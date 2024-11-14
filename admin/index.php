<?php include('partials/menu.php'); ?>
    
    
    <!-- Main Content starts-->
    <div class="main-content">
        <div class="wrapper">
            <h1>DASHBOARD</h1>
            <br><br>

            <?php
                //This is where the Successful login message will be displayed.

                if(isset($_SESSION["login"]))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            
            
            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Categories
            </div>

            <div class="clearfix"></div>

        </div>
     </div>
    <!-- Main Content ends-->
    
    <?php include('partials/footer.php'); ?>