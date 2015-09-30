<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>
<?php include('../functions/catchErrors.php'); ?>

<?php
if (isset($_SESSION['user'])) :
    ?>

    <div class="row">
        <h2>Update Product:</h2>
        <form method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label class="control-label col-sm-2" for="productName">Product Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="productName" name="productName"
                           placeholder="Enter product name" value="<?= $_GET['productName'] ?>" required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="productPrice">Product Price:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="productPrice"  name="productPrice"
                           placeholder="Enter product price" value="<?= $_GET['productPrice'] ?>" required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="categoryId">Category Id:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="categoryId"  name="categoryId"
                           placeholder="Enter categoryId" required="true" value="<?= $_GET['categoryId'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="quantity">Quantity:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="quantity"  name="quantity"
                           placeholder="Enter quantity" value="<?= $_GET['quantity'] ?>" required="true">
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
    if (isset($_POST['productName'])) :
        checkConnectionDb();
        mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);

        $updateSql = "UPDATE Products
              SET ProductName = '" . $_POST['productName'] . "',
              ProductPrice = '". $_POST['productPrice'] . "',
              CategoryId = '" . $_POST['categoryId'] . "',
              Quantity = '" . $_POST['quantity'] . "'
              WHERE Id = '" . $_GET['productId'] . "'";
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