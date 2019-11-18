<?php
if(isset($_GET['p_id'])){
    $the_post_id = $_GET['p_id'];
}

$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
$select_posts_byId = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_posts_byId)){
    $post_id = $row['post_id'];
    $post_cat_id = $row['post_category_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment = $row['post_comment_count'];
    $post_status = $row['post_status'];
    $post_content = $row['post_content'];
}

if(isset($_POST['update_post'])){
    $post_cat_id = $_POST['post_category'];
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_status = $_POST['post_status'];
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    if(empty($post_image)){
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
        $select_image = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($select_image)){
            $post_image = $row['post_image'];
        }
    }
    
    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_date = now(), ";
    $query .= "post_category_id = '{$post_cat_id}' ";
    $query .= "WHERE post_id = {$the_post_id}";
    
    $update_post = mysqli_query($connection, $query);
    
    confirmQuery($update_post);
    
    echo "<p class='bg-success'>Post Updated: <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title ?>" type="text" class="form-control" name="post_title">
    </div>
    <label for="post_category">Categories</label>
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
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author ?>" type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
       <label for="post_status">Post Status</label>
        <select class="form-group form-control" name="post_status" id="post_status">
           <option value='<?php $post_status; ?>'><?php echo $post_status; ?></option>
            <?php
            if($post_status == 'published'){
                echo "<option value='draft'>draft</option>";
            } else {
                echo "<option value='published'>publish</option>";
            }
            ?>      
        </select>
    </div>
    <div class="form-group">
        <label for="image">Post Image</label><br><br>
        <img width="100" src="../images/<?php echo $post_image ?>" alt="image"><br><br>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10" id="body"><?php echo $post_content ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Edit Post">    
    </div>
</form>