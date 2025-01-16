<?php include('partials/menu.php'); ?>

<!-- Main Content Section Start-->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php 
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; // Displaying session message
            unset($_SESSION['add']); // Removing session message
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload']; // Displaying session message
            unset($_SESSION['upload']); // Removing session message
        }
        ?>

        <br><br>

        <!-- Add category form starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title" required>
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
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
        <!-- Add category form ends -->

        <?php
        if (isset($_POST['submit'])) {
            // Get form data
            $title = $_POST['title'];

            // Handle featured
            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";

            // Handle active
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            // Handle image upload
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];

                // Rename the image
                $ext = end(explode('.', $image_name));
                $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/" . $image_name;

                $upload = move_uploaded_file($source_path, $destination_path);

                if ($upload == false) {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                    header("location:" . SITEURL . 'admin/add-category.php');
                    die();
                }
            } else {
                $image_name = ""; // No image uploaded
            }

            // SQL query to insert category
            $sql = "INSERT INTO tbl_category SET 
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'";

            // Execute query
            $res = mysqli_query($conn, $sql);

            // Check if data was inserted
            if ($res == true) {
                $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";
                header("location:" . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
