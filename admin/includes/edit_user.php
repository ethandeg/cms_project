<?php

if(isset($_GET['edit_user'])){
    $the_user_id = $_GET['edit_user'];
    $query = "SELECT * FROM users WHERE user_id = {$the_user_id}";
    $user_query = mysqli_query($connection, $query);
    confirm_connection($user_query);
    $row = mysqli_fetch_assoc($user_query);
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];
    $username = $row['username'];
    $user_email = $row['user_email'];
    $user_password = $row['user_password'];
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
        $query = "SELECT randSalt from USERS WHERE username = '$username'";
        $select_randsalt = mysqli_query($connection, $query);
        if(!$select_randsalt){
            die("Query failed...." . mysqli_error($connection));
        }
        $row = mysqli_fetch_array($select_randsalt);
        $salt = $row['randSalt'];
        $hashed_password = crypt($user_password, $salt);

        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$hashed_password}' ";
        $query .= "WHERE user_id = {$the_user_id}";
        $updated_user = mysqli_query($connection, $query);
        confirm_connection($updated_user);
        header("Location: users.php");

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

    <input class = "btn btn-primary" type="submit" value='Edit User' name = 'edit_user'>

</form>