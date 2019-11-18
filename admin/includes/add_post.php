<?php
if(isset($_POST['create_post'])){
    $post_cat_id = $_POST['post_category'];
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_status = $_POST['post_status'];
    $post_date = date('d-m-y');

    
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES({$post_cat_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
    
    $post_query = mysqli_query($connection, $query);
    
    confirmQuery($post_query);
    
    $the_post_id = mysqli_insert_id($connection);
    
    echo "<p class='bg-success'>Post Created: <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit Posts</a></p>";
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
    <label for="post_status">Category</label>
    <select class="form-group form-control"  name="post_category" id="post_category">
        <?php 
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);
               
        confirmQuery($select_categories);
        
        while($row = mysqli_fetch_assoc($select_categories)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            
            echo "<option value='{$cat_id}'>{$cat_title}</option>";
        }
        ?>
    </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select class="form-group form-control" name="post_status" id="">
            <option value="draft">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" id="body" name="post_content" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">    
    </div>
    
</form>