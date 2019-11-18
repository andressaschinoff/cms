<?php include "includes/header.php"; ?>
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
                    <!-- ADD CATEGORY -->
                    <div class="col-sm-6">
                    <?php addCategories(); ?>
                        <!-- ADD FORM -->
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                                <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>
                        <!-- UPDATE CATEGORY -->
                        <?php
                        if(isset($_GET['edit'])){
                            $cat_id = $_GET['edit'];
                            include "includes/update_categories.php";
                        }
                        ?>   
                    </div>
                    <!-- ADD CATEGORY FORM -->
                    <div class="col-sm-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <!-- FIND ALL CATEGORIES -->
                                <?php findAllCategories(); ?>    
                                <!-- DELETE QUERY -->
                                <?php deleteCategories(); ?>
                            </tbody>
                        </table>   
                    </div>
                    <!-- col-sm-6 -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
<?php include "includes/footer.php"; ?>