<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Make Admin</th>
            <th>Make Subscriber</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        

        <?php
        $query = "SELECT * FROM users";
        $users = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($users)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_password = $row['user_password'];
            

            echo "<tr>";
            echo  "<td>{$user_id}</td>";
            echo  "<td>{$username}</td>";
            echo  "<td>{$user_firstname}</td>";
            echo  "<td>{$user_lastname}</td>";
            echo  "<td>{$user_email}</td>";
            echo  "<td>{$user_role}</td>";
            echo  "<td><a href='users.php?change_to_admin={$user_id}'>Make Admin</a></td>";
            echo  "<td><a href='users.php?change_to_sub={$user_id}'>Make Subscriber</a></td>";
            echo  "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo  "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo  "</tr>";
        }
        
        ?>

        
    </tbody>
</table>

<?php
if(isset($_GET['delete'])){
    $the_user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
    $delete_query = mysqli_query($connection, $query);
    confirm_connection($delete_query);
    header("Location: users.php");
}



if(isset($_GET['change_to_admin'])){
    $the_user_id = $_GET['change_to_admin'];
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$the_user_id}";
    $admin_query = mysqli_query($connection, $query);
    confirm_connection($admin_query);
    header("Location: users.php");
}
if(isset($_GET['change_to_sub'])){
    $the_user_id = $_GET['change_to_sub'];
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$the_user_id}";
    $sub_query = mysqli_query($connection, $query);
    confirm_connection($sub_query);
    header("Location: users.php");
}



?>