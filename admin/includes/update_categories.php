<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Add Category: </label>

        <?php
            if(isset($_GET['edit'])){
                $edit_cat_id = $_GET['edit'];
                $query = "SELECT * FROM categories WHERE cat_id = $edit_cat_id";
                $select_categories_id = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_categories_id)){
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                ?>
                <input value = "<?php if(isset($cat_title)){echo $cat_title;}?>" type="text" class="form-control" name="cat_title">
                    
                <?php }} ?> 
        <?php
            if(isset($_POST['edit'])){
                $get_cat_title = $_POST['cat_title'];
                $query = "UPDATE categories SET cat_title = '{$get_cat_title}' WHERE cat_id = {$cat_id}";
                $update_query = mysqli_query($connection, $query);
                if(!$update_query){
                    die("Everything failed..." . mysqli_error($connection));
                }
            }
        ?>
        



    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit" value="Update">
    </div>
</form>