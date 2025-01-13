<?php include('partials/menu.php') ?>
        <!-- Main Content Section Start-->
        <div class = "main-content">
            <div class = "wrapper">
                <h1>Dashboard</h1>
                <br><br>
                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset ($_SESSION['login']);
                    }
                ?>
                <br><br>
                <div class="col-4 img1 text-center">
                    <br />
                   <p> Snacks </p>
                </div>

                <div class="col-4 img2 text-center">
                    <br />
                    <p>Lunch</p>
                </div>

                <div class="col-4 img3 text-center">
                    <br />
                   <p> Drinks</p>
                </div>

                <div class="col-4 img4 text-center">
                    <br />
                   <p> Dessert</p>
                </div>
               <div class="clearfix"></div> 
            </div>    
        </div>

        <!-- Main Content Section End-->

        
<?php include('partials/footer.php') ?>