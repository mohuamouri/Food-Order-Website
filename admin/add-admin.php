<?php include ('partials/menu.php'); ?>

<div class="main=content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //displaying session message
                unset($_SESSION['add']); //removing session  message
            }
        ?>
          
          <form action="" method="POST">

           <table class="tbl-30">
               <tr>
                  <td>Full Name</td>
                  <td><input type="text" name="full_name" placeholder="Enter your name"></td>
               </tr>

               <tr>
                <td>Username: </td>
                <td>
                    <input type=" text" name="Username" placeholder="Your Usename">
                </td>
               </tr>

               <tr>
                <td>Password: </td>
                <td>
                    <input type="password" name="password" placeholder="Your Password">
                </td>
               </tr>

               <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
               </tr>
           </table>


          </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
    
   if(isset($_POST['submit']))
   {
    //echo "Button Clicked";

    //1.Get the Data from form

     $full_name = $_POST['full_name'];
     $username = $_POST['Username'];
     $password = md5($_POST['password']);  

     //2.SQL Query to save the data into database
    $sql = "INSERT INTO tbl_admin SET 
        full_name ='$full_name',
        username='$username',
        password='$password'
    ";
    
    
    //3.Executing Query and Saving Data into Database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    
  
    if($res ==TRUE){
     
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully";
    
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
    
        $_SESSION['add'] = "<div class='error'>Failed to add message Successfully";
        //Redirect page to add admin
        header("location:".SITEURL.'admin/add-admin.php');
    }
    }


?>