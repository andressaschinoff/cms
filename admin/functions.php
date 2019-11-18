<?php
function confirmQuery($result){
    global $connection;
    if(!$result){
        die ("Query Failed " . mysqli_error($connection) . ' ' . mysqli_errno($connection));
    }
}

function addCategories(){
    global $connection;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUES ('$cat_title')";

            $create_category_query = mysqli_query($connection, $query);

            if(!$create_category_query){
                die('QUERY FAILED '. mysqli_error($connection));
            }
        }
    } 
}

function findAllCategories(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a class='btn btn-sm btn-danger' href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a class='btn btn-sm btn-warning' href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function deleteCategories(){
    global $connection;
    if(isset($_GET['delete'])){
        $get_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = $get_cat_id";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}
?>