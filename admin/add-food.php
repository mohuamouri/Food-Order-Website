<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
              echo $_SESSION['upload'];
              unset($_SESSION['upload']);
            }
        ?>

        <?php
            // Query to get the total number of foods
            $sql_count = "SELECT COUNT(*) AS total_foods FROM tbl_food";
            $res_count = mysqli_query($conn, $sql_count);
            $row_count = mysqli_fetch_assoc($res_count);
            $total_foods = $row_count['total_foods'];
        ?>

        

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
               <tr>
                  <td>Title: </td>
                  <td>
                    <input type="text" name="title" placeholder="Title of the food">
                  </td>
               </tr>
               
               <tr>
                  <td>Description: </td>
                  <td>
                    <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                  </td>
               </tr>

               <tr>
                   <td>Price</td>
                   <td>
                    <input type="number" name="price">
                   </td>
               </tr>

               <tr>
                   <td>Select Image: </td>
                   <td>
                       <input type="file" name="image" >
                   </td>
               </tr>

               <tr>
                   <td>Category: </td>
                   <td>
                      <select name="category">
                        <?php
                           $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                           $res = mysqli_query($conn, $sql);
                           $count = mysqli_num_rows($res);

                           if($count>0)
                           {
                               while($row=mysqli_fetch_assoc($res))
                               {
                                $id = $row['id'];
                                $title = $row['title'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                               }
                           }
                           else
                           {
                              ?>
                              <option value="0">No Category Found</option>
                              <?php
                           }
                        ?>
                      </select>
                   </td>
               </tr>

               <tr>
                   <td>Featured: </td>
                   <td>
                      <input type="radio" name="featured" value="Yes"> Yes
                      <input type="radio" name="featured" value="No"> No           
                   </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                  <td colspan ="2">
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                  </td>
                </tr>
            </table>
        </form>

        <?php
             if(isset($_POST['submit']))
             {
                // Add food to database

                // 1. Get data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // Check whether radio button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                   $featured = $_POST['featured'];
                }
                else{
                   $featured = "No";
                }

                if(isset($_POST['active']))
                {
                  $active = $_POST['active'];
                }
                else
                {
                  $active = "No";
                }

                // 2. Image select
                if(isset($_FILES['image']['name']))
                {
                   $image_name = $_FILES['image']['name'];

                   if($image_name!="")
                   {
                       $ext = end(explode('.', $image_name));

                       // Create New Name for image
                       $image_name = "Food-Name-".rand(0000,9999).".".$ext;

                       // Upload the image
                       $src = $_FILES['image']['tmp_name'];
                       $dst = "../images/food/".$image_name;

                       $upload = move_uploaded_file($src, $dst);

                       if($upload==false)
                       {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload Image.</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        die();
                       }
                   }
                }
                else{
                   $image_name = "";
                }

                // 3. Insert into database
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                // Execute the query
                $res2 = mysqli_query($conn, $sql2);

                // 4. Redirect with message to manage food page
                if($res2 == true)
                {
                    // Update the number of foods added
                    $sql_count_update = "SELECT COUNT(*) AS total_foods FROM tbl_food";
                    $res_count_update = mysqli_query($conn, $sql_count_update);
                    $row_count_update = mysqli_fetch_assoc($res_count_update);
                    $total_foods = $row_count_update['total_foods'];

                    $_SESSION['add'] = "<div class='success'>Food Added Successfully. Total Foods Added: $total_foods</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else{
                  $_SESSION['add'] = "<div class='error'>Failed to add Food. </div>";
                  header('location:'.SITEURL.'admin/manage-food.php');
                }
             }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>

