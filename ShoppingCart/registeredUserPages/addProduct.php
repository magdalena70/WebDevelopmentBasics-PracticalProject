<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>

<?php
if (isset($_SESSION['user'])) :
    ?>

    <div class="row">
        <h2>Add Product:</h2>
        <form method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label class="control-label col-sm-2" for="productName">Product Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="productPrice">Product Price:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="productPrice"  name="productPrice" placeholder="Enter product price" required="true">
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
    if (isset($_POST['productName'])) :
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $roundPrice = number_format((float)$productPrice, 2, '.', '');
        $categoryId = $_SESSION['categoryId'];
        $userId = $_SESSION['userId'];

        mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);

        $addProductSql =
                "INSERT INTO Products (ProductName,ProductPrice,CategoryId,UserId)
                VALUES ('".$productName."', '".$roundPrice."', '".$categoryId."', '".$userId."')";
        $result = mysql_query($addProductSql);
        $row = @mysql_fetch_assoc($result);
        header('Location: main.php');
    endif;
    include('../allUsersPages/footer.php');
    ?>

<?php
else :
    header('Location: ./startPage.php');
    die;
endif;
?>