<?php include ('partials/menu.php')?>

<div class = "main-content">
    <div class = "wrapper">
        <h1>Manage Category</h1>

        <br /><br /><br/>
        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //displaying session message
                unset($_SESSION['add']); //removing session  message
            }
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove']; //displaying session message
                unset($_SESSION['remove']); //removing session  message
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete']; //displaying session message
                unset($_SESSION['delete']); //removing session  message
            }
            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found']; //displaying session message
                unset($_SESSION['no-category-found']); //removing session  message
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update']; //displaying session message
                unset($_SESSION['update']); //removing session  message
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload']; //displaying session message
                unset($_SESSION['upload']); //removing session  message
            }
            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove']; //displaying session message
                unset($_SESSION['failed-remove']); //removing session  message
            }



        ?>
        <br><br>
                <!-- Button to add admin -->
                <a href="<?php echo SITEURL;?>admin/add-category.php" class = "btn-primary">Add Category</a>

                <br /><br /><br />

                <table class = "tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>


                    <?php 
                    
                    //Query to gate all category
                    $sql = "SELECT * FROM tbl_category";
                    //Execute the query
                    $res = mysqli_query($conn, $sql);

                    //count rows to vheck where we have data in database or not
                    $counts = mysqli_num_rows($res);

                    $sn=1;

                    if($counts>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id= $row['id'];
                            $title= $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>

                        <tr>
                            <td><?php echo $sn++; ?> </td>
                            <td><?php echo $title;?> </td>

                            <td>
                                <?php 
                                if($image_name!="")
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name?>" width="100px" >

                                    <?php
                                }
                                else
                                {
                                    echo "<div class='error'>No image added</div>";
                                }
                                ?>

                            </td>

                            <td><?php echo $featured;?></td>
                            <td><?php echo $active;?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Category</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                            </td>

                        </tr>
                            <?php
                            
                        }
                    }
                    else
                    {
                        //will display the message inside the table
                        ?>
                        <!-- broke the php to write html code here -->
                        <tr>
                            <td colspan="6"><div class='error'>No Category added yet.</div></td>
                        </tr>
                        <?php
                        
                        
                    }


                    ?>
                    

                    
                </table>
     </div>
    

</div>

<?php include ('partials/footer.php')?>