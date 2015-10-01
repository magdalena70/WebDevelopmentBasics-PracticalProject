<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>
<?php include('../functions/catchErrors.php'); ?>

<?php
if (isset($_SESSION['user'])) :
    ?>

    <div class="row">
        <h2>Update Category:</h2>
        <form method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label class="control-label col-sm-2" for="categoryName">Category Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="categoryName" name="categoryName"
                           placeholder="Enter category name" value="<?= $_GET['category'] ?>" required="true">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-default">Update</button>
                </div>
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST['categoryName'])) :
        checkConnectionDb();
        mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);

        $updateSql = "UPDATE Categories
              SET CategoryName = '" . $_POST['categoryName'] . "'
              WHERE Id = '" . $_GET['categoryId'] . "'";
        $result = mysql_query($updateSql);
        if($result) {
            header("Location: main.php?user=" . $_SESSION['user']);
            die;
        }
    endif;
    include('../allUsersPages/footer.php');

else :
    header('Location: ./startPage.php');
    die;
endif;
?>