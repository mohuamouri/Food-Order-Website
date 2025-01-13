<?php include('partials/menu.php'); ?>

<!-- Main Content Section Start-->
<div class = "main-content">
            <div class = "wrapper">
                <h1>Add Category</h1>
                <br /><br />

                <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; //displaying session message
                    unset($_SESSION['add']); //removing session  message
                }
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload']; //displaying session message
                    unset($_SESSION['upload']); //removing session  message
                }
                ?>

                <br><br>

                <!-- add category form starts-->

                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-30">
                        <tr>
                            <td>Title:</td>
                            <td>
                                <input type="text" name="title" placeholder="Category Title">
                            </td>
                        </tr>
                        <tr>
                            <td>Select Image: </td>
                            <td>
                                <input type="file" name= "image">
                            </td>
                        </tr>
                        <tr>
                            <td>Featured:</td>
                            <td>
                                <input type="radio" name="featured" value="Yes">Yes 
                                <input type="radio" name="featured" value="Yes">No
                            </td>
                        </tr>

                        <tr>
                            <td>Active:</td>
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
                <!-- add category form ends-->

                <?php
                
                if(isset($_POST['submit']))
                {
                    //echo "Clicked";
                    $title = $_POST['title'];
                    
                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        $featured = "No";
                    }

                    if(isset($_POST['active']))
                    {
                        //echo "Clicked";
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $featured = "No";
                    }
                    

                    if(isset($_FILES['image']['name']))
                    {
                        //echo "Clicked";
                        $image_name = $_FILES['image']['name'];

                        
                        if($image_name != "")
                        {
                            $ext = end(explode('.', $image_name));
                            $image_name ="Food_Category_".rand(000,999).'.'.$ext;

                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/category/".$image_name;
                            $upload = move_uploaded_file($source_path, $destination_path);

                            if($upload ==false)
                            {
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                                header("location:".SITEURL.'admin/add-category.php');
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = "";
                    }

                    $sql = "INSERT INTO tbl_category SET 
                    title ='$title',
                    image_name ='$image_name',
                    featured='$featured',
                    active='$active'
                    ";

                    //3.Executing Query and Saving Data into Database
                    $res = mysqli_query($conn, $sql);

                    //check whether the (Query is Executed)data is inserted on not and display appropriate message
                    if($res ==TRUE){

                        $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                        //Redirect page to manage admin
                        header("location:".SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        ///failed to insert data
                        //echo "Failed to insert data";
                        //create a session variable to display message
                        $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";
                        //Redirect page to add admin
                        header("location:".SITEURL.'admin/add-admin.php');
                    }
                }
                
            
                ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>