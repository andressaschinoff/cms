<?php include "includes/header.php"; ?>
<?php

?>

<div id="wrapper">
    <!-- Navegation -->
    <?php include "includes/navegation.php"; ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>
                    <?php
                    if(isset($_SESSION['username'])){
                        $username_profile = $_SESSION['username']; 

                        $query = "SELECT * FROM users WHERE username = '{$username_profile}'";
                        $select_users_profile = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_array($select_users_profile)){
                            $user_id = $row['user_id'];
                            $username= $row['username'];
                            $user_password = $row['user_password'];
                            $user_firstname = $row['user_firstname'];
                            $user_lastname = $row['user_lastname'];
                            $user_email = $row['user_email'];
                            $user_role = $row['user_role'];
                        }
                    }

                    if(isset($_POST['update_profile'])){
                        $user_firstname = $_POST['user_firstname'];
                        $user_lastname = $_POST['user_lastname'];
                        $user_role = $_POST['user_role'];
                        $username = $_POST['username'];
                        $user_email = $_POST['user_email'];
                        $user_password = $_POST['user_password'];
    
                        $query = "UPDATE users SET ";
                        $query .= "username = '{$username}', ";
                        $query .= "user_password = '{$user_password}', ";
                        $query .= "user_firstname = '{$user_firstname}', ";
                        $query .= "user_lastname = '{$user_lastname}', ";
                        $query .= "user_email = '{$user_email}', ";
                        $query .= "user_role = '{$user_role}' ";
                        $query .= "WHERE username = '{$username_profile}'";

                        $update_user = mysqli_query($connection, $query);

                        confirmQuery($update_user);
                    }
                    ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="user_firstname">Firstname</label>
                            <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
                        </div>
                        <div class="form-group">
                            <label for="user_lastname">Lastname</label>
                            <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
                        </div>
                        <div class="form-group">
                        <select class="form-group form-control"  name="user_role" id="user_role">

                            <option value='subscriber'><?php echo $user_role; ?></option>

                           <?php 
                            if($user_role == 'admin'){
                                echo "<option value='subscriber'>subscriber</option>";
                            } else {
                                echo "<option value='admin'>admin</option>";
                            }
                            ?>

                        </select>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
                        </div>
                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input value="<?php echo $user_password; ?>" type="password" class="form-control" name="user_password">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_profile" value="Upadete Profile">    
                        </div>

                    </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
<?php include "includes/footer.php"; ?>