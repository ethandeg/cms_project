<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    <?php 
    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($connection,$_POST['username']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);

        if(!empty($username) && !empty($password) && !empty($email)){
            $query = 'SELECT randSalt FROM users LIMIT 1';
            $select_salt = mysqli_query($connection, $query);
            if(!$select_salt){
                die("Query failed..." . mysqli_error($connection));
            }
            $row = mysqli_fetch_array($select_salt);
            $password = crypt($password, $row['randSalt']);
            $query = "INSERT INTO users (username, user_password, user_email, user_role) VALUES ('{$username}', '{$password}', '{$email}', 'subscriber')";
            $insert_user = mysqli_query($connection, $query);
            if(!$insert_user){
                die("Query failed..." . mysqli_error($connection));
            } else {
                $message = "Succesfully submitted";
            }
        } else {
            $message = "All fields are required.";
        }
    } else {
        $message = '';
    }
    
    ?>
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
