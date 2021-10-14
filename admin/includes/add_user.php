<?php
    if(isset($_POST['create_user'])){
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


        $query = "INSERT INTO users (username, user_firstname, user_lastname, user_role, user_email, user_password) ";
        $query .= "VALUES ('{$username}', '{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$user_email}', '{$user_password}')";
        $new_post = mysqli_query($connection, $query);
        confirm_connection($new_post);

    }

?>
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name = "user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name = "user_lastname">
    </div>

    <div class="form-group">
        <label for="user_role">Role</label>
        <select name="user_role" id="user_role">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>





    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name = "username">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>

    <input class = "btn btn-primary" type="submit" value='Create User' name = 'create_user'>

</form>