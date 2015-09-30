<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>
<?php include('../functions/catchErrors.php'); ?>

<?php
if (isset($_SESSION['user'])) :
    ?>

    <div class="row">
        <h2>Add Product:</h2>
        <form method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label class="control-label col-sm-2" for="categoryName">Category Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="categoryName" name="categoryName"
                           placeholder="Enter category name" required="true">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-default">Add</button>
                </div>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['categoryName'])) :
        $categoryName = $_POST['categoryName'];

        checkConnectionDb();
        mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);

        $addCategorySql =
            "INSERT INTO Categories (CategoryName)
                VALUES ('".$categoryName."')";
        $result = mysql_query($addCategorySql);
        $row = @mysql_fetch_assoc($result);
        header('Location: main.php?user=' . $_SESSION['user']);
        die;
    endif;
    include('../allUsersPages/footer.php');

else :
    header('Location: ./startPage.php');
    die;
endif;
?>