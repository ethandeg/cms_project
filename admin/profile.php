<?php 
include "includes/admin_header.php";
session_start(); 
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $get_user_data = mysqli_query($connection, $query);
    confirm_connection($get_user_data);
    $row = mysqli_fetch_assoc($get_user_data);
    $user_firstname = $row['user_firstname']; 
    $user_lastname = $row['user_lastname']; 
    $user_email = $row['user_email']; 
    $user_role = $row['user_role']; 
    $user_password = $row['user_password']; 
    $user_id = $row['user_id']; 
}

if(isset($_POST['edit_user'])){
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];

    // $post_image = $_FILES['post_image']['name'];
    // $post_image_temp = $_FILES['post_image']['tmp_name'];

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    // $post_date = date('d-m-y');

    // move_uploaded_file($post_image_temp, "../images/$post_image");


    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE user_id = {$user_id}";
    $updated_user = mysqli_query($connection, $query);
    confirm_connection($updated_user);
    $_SESSION['username'] = $username;
    $_SESSION['user_firstname'] = $user_firstname;
    $_SESSION['user_lastname'] = $user_lastname;
    $_SESSION['user_role'] = $user_role;
    header("Location: profile.php");
}
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                                Welcome to admin
                                <small>Author</small>
                        </h1>

                        <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];

                        } else {
                            $source = '';
                        }
                        ?>
                        
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                    <label for="user_firstname">First Name</label>
                                    <input type="text" class="form-control" name = "user_firstname" value="<?php echo $user_firstname;?>">
                                </div>

                                <div class="form-group">
                                    <label for="user_lastname">Last Name</label>
                                    <input type="text" class="form-control" name = "user_lastname" value="<?php echo $user_lastname;?>">
                                </div>

                                <div class="form-group">
                                    <label for="user_role">Role</label>
                                    <select name="user_role" id="user_role">
                                        <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
                                        <?php
                                            if($user_role === 'admin'){
                                                echo "<option value='subscriber'>subscriber</option>";
                                            } else {
                                                echo "<option value='admin'>admin</option>";
                                            }
                                        ?>


                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name = "username" value="<?php echo $username;?>">
                                </div>
                                <div class="form-group">
                                    <label for="user_email">Email</label>
                                    <input type="email" name="user_email" class="form-control" value="<?php echo $user_email;?>">
                                </div>

                                <div class="form-group">
                                    <label for="user_password">Password</label>
                                    <input type="password" name="user_password" class="form-control" value="<?php echo $user_password;?>">
                                </div>

                                <input class = "btn btn-primary" type="submit" value='Update Profile' name = 'edit_user'>

                        </form>`
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>