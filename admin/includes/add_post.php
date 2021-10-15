<?php
    if(isset($_POST['submit'])){
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
        $post_date = date('d-m-y');
        // $post_comment_count = 4;

        move_uploaded_file($post_image_temp, "../images/$post_image");


        $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
        $query .= "VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
        $new_post = mysqli_query($connection, $query);
        confirm_connection($new_post);

    }

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name = "post_title">
    </div>

    <div class="form-group">
        <label for="post_category">Category</label>
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
        <input type="text" class="form-control" name = "post_author">
    </div>
    <div class="form-group">
        <label for="status">Post Status</label>
        <input type="text" class="form-control" name = "post_status">
    </div>
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" class="form-control" name = "post_image">
    </div>
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name = "post_tags">
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name = "post_content" cols="30" rows="10"></textarea>
    </div>

    <input class = "btn btn-primary" type="submit" value='Submit Post' name = 'submit'>

</form>