<?php 
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $checkBoxValue){
            $bulk_options = $_POST['bulk_options'];
            switch($bulk_options){
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}";
                    $update_to_publish = mysqli_query($connection, $query);
                    confirm_connection($update_to_publish);
                    break;
                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}";
                    $update_to_draft = mysqli_query($connection, $query);
                    confirm_connection($update_to_draft);
                    break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = {$checkBoxValue}";
                    $delete_post = mysqli_query($connection, $query);
                    confirm_connection($delete_post);
                    break;
                default:
                    header("Location: posts.php");
                
            }
        }
    }

?>

<form action="" method = "post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class='col-xs-4' style='padding-left: 0px; padding-bottom: 10px;'>
            <select name="bulk_options" class="form-control" id="">
                <option value="">Select Option</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            

            <?php
            $query = "SELECT * FROM posts";
            $posts = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($posts)){
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                

                echo "<tr>";
                echo "<td><input type='checkbox' id='selectAllBoxes' class='checkBoxes' name='checkBoxArray[]' value='{$post_id}'></td>";
                echo  "<td>{$post_id}</td>";
                echo  "<td>{$post_author}</td>";
                echo  "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";

                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                $cats = mysqli_query($connection, $query);
                $cat_row = mysqli_fetch_assoc($cats);
                $cat_id = $cat_row['cat_id'];
                $cat_title = $cat_row['cat_title'];
                echo "<td>{$cat_title}</td>";

                echo  "<td>{$post_status}</td>";
                echo  "<td><img width='100' src='../images/{$post_image}'</td>";
                echo  "<td>{$post_tags}</td>";
                echo  "<td>{$post_comment_count}</td>";
                echo  "<td>{$post_date}</td>";
                echo  "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo  "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo  "</tr>";
            }
            
            ?>

            
        </tbody>
    </table>
</form>

<?php
if(isset($_GET['delete'])){
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_query = mysqli_query($connection, $query);
    confirm_connection($delete_query);
    header("Location: posts.php");
}


?>