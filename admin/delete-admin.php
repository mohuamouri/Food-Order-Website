<?php 
    include ('../config/constants.php');
    //1. get the id of the admin to be deleted
    $id = $_GET['id'];
    //2. create SQL query to delete admin
    $sql = "DELETE FROM tbl_admin where id=$id";
    //execute the query
    $res = mysqli_query($conn, $sql);
    if($res == true)
    {
        $_SESSION['delete'] = "<div class = 'success'>Admin deleted successfully.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to delete admin</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    //3. redirect to manage admin page with message (Success or error)
?>