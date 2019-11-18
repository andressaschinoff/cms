<?php
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $checkbox_post_id){
        $bulk_options = $_POST['bulk_options'];
        
        switch($bulk_options){
                case 'published';
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkbox_post_id}";
                
                $update_to_published_status = mysqli_query($connection, $query);
                confirmQuery($update_to_published_status);
                
                break;
                
                case 'draft';
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkbox_post_id}";
                
                $update_to_draft_status = mysqli_query($connection, $query);
                confirmQuery($update_to_draft_status);
                
                break;
                
                case 'delete';
                
                $query = "DELETE FROM posts WHERE post_id = {$checkbox_post_id}";
                $delete_post = mysqli_query($connection, $query);
                confirmQuery($delete_post);
                break;
                
        }
    }
}
?>
<form action="" method="post">
   <table class="table table-bordered table-hover">
      <div class="container">
        <div style="padding-bottom: 2em"  class="col-sm-4">
           <select class="form-control" name="bulk_options" id="">
               <option value="">Select Options</option>
               <option value="published">Publish</option>
               <option value="draft">Draft</option>
               <option value="delete">Delete</option>
           </select>
       </div>
       <div style="padding-bottom: 2em"  class="col-sm-4">
       <input type="submit" name="submit" class="btn btn-success" value="Apply">
       <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
    </div>
    </div>
    <thead>
        <tr>
           <th><input id="selectAllBoxes" type="checkbox"></th>
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
            $select_posts = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_posts)){
                $post_id = $row['post_id'];
                $post_cat_id = $row['post_category_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment = $row['post_comment_count'];
                $post_status = $row['post_status'];

                echo "<tr>";
                ?>
                <td><input class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id ?>' type='checkbox'></td>
                <?php
                echo "<td>$post_id</td>";
                echo "<td>$post_author</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";
                
                $query = "SELECT * FROM categories WHERE cat_id = $post_cat_id";
                $select_categories_edit = mysqli_query($connection, $query);
            
                while($row = mysqli_fetch_assoc($select_categories_edit)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    
                    echo "<td>{$cat_title}</td>";
                }
                
                
                echo "<td>$post_status</td>";
                echo "<td><img width='100' src='images/$post_image' alt='image'></td>";
                echo "<td>$post_tags</td>";
                echo "<td><a href='./comments.php'>$post_comment</a></td>";
                echo "<td>$post_date</td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
            
            

        </tbody>
    </table>
</form>


<?php
if(isset($_GET['delete'])){
    $delete_post_id = $_GET['delete'];
    
    $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
}
?>