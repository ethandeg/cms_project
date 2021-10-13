<?php
        if(isset($_GET['p_id'])){
            $p_id = $_GET['p_id'];
        }
        $query = "SELECT * FROM posts WHERE post_id = '{$p_id}'";
        $post = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($post);

        if(isset($_POST['update_post'])){
            $post_title = $_POST['post_title'];
            $post_author = $_POST['post_author'];
            $post_category_id = $_POST['post_category'];
            $post_status = $_POST['post_status'];
    
            $post_image = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];
    
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];

            move_uploaded_file($post_image_temp, "../images/$post_image");
            if(empty($post_image)){
                $query = "SELECT post_image FROM posts WHERE post_id = {$p_id}";
                $select_image = mysqli_query($connection, $query);
                $row = mysqli_fetch_assoc($select_image);
                $post_image = $row['post_image'];
            }
            $query = "UPDATE posts SET ";
            $query .= "post_title = '{$post_title}', ";
            $query .= "post_category_id = '{$post_category_id}', ";
            $query .= "post_date = now(), ";
            $query .= "post_author = '{$post_author}', ";
            $query .= "post_status = '{$post_status}', ";
            $query .= "post_tags = '{$post_tags}', ";
            $query .= "post_content = '{$post_content}', ";
            $query .= "post_image = '{$post_image}' ";
            $query .= "WHERE post_id = {$p_id}";
            $updated_post = mysqli_query($connection, $query);
            confirm_connection($updated_post);
            header("Location: posts.php");
        }

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name = "post_title" value='<?php echo $row['post_title'] ;?>'>
    </div>

    <div class="form-group">
        <select name="post_category" id="post_category">
            <?php 
            $query_cats = "SELECT * FROM categories";
            $categories = mysqli_query($connection, $query_cats);
            confirm_connection($categories);
            while($row2 = mysqli_fetch_assoc($categories)){
                $cat_title = $row2['cat_title'];
                $cat_id = $row2['cat_id'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name = "post_author" value='<?php echo $row['post_author'] ;?>'>
    </div>
    <div class="form-group">
        <label for="status">Post Status</label>
        <input type="text" class="form-control" name = "post_status" value='<?php echo $row['post_status'] ;?>'>
    </div>
    <div class="form-group">
        <img width = "100" src="../images/<?php echo $row['post_image']; ?>" alt="">
        <label for="post_image">Post Image</label>
        <input type="file" class='form-control' name="post_image" value='../images<?php echo $row['post_image']; ?>'>
    </div>
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name = "post_tags" value='<?php echo $row['post_tags'] ;?>'>
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name = "post_content" cols="30" rows="10"><?php echo $row['post_content'] ;?></textarea>
    </div>

    <input class = "btn btn-primary" type="submit" value='Submit Post' name = 'update_post'>

</form>