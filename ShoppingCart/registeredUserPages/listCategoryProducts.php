<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>
<?php include('../functions/catchErrors.php'); ?>

<?php
if (isset($_SESSION['user'])) :
    ?>

    <div class="row">
        <div class="col-sm-9">
            <h2>Products in category <?= $_GET['category'] ?></h2>
            <ul class="list-group">

                <?php
                checkConnectionDb();
                mysql_connect(DB_HOST, DB_USER, DB_PASS);
                mysql_select_db(DB_NAME);

                $categoryId = $_GET['categoryId'];
                $userId = $_SESSION['userId'];
                $searchSql = "SELECT Id, ProductName, ProductPrice, CategoryId, Quantity, Seller_Id
                        FROM Products
                        WHERE CategoryId=$categoryId
                        AND Seller_Id!=$userId
                        AND isSold=false
                        ORDER BY ProductPrice ASC";
                $result = mysql_query($searchSql);

                $row = mysql_fetch_assoc($result);
                if($row){
                    while($row){
                        $productId = $row['Id'];
                        $productName = htmlentities($row['ProductName']);
                        $productPrice = $row['ProductPrice'];
                        $quantity = $row['Quantity'];
                            ?>

                            <li class='list-group-item'>
                                <?= $productName . " - " . $productPrice ?>
                                <a href='userCart.php?productName=<?= $productName ?>&productPrice=<?= $productPrice ?>' class="well well-sm col-sm-offset-1">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                </a>
                                <a href="updateProduct.php?categoryId=<?=$_GET['categoryId']?>&productId=<?=$productId?>&productName=<?= $productName ?>&productPrice=<?= $productPrice ?>&quantity=<?= $quantity ?>"
                                   class="well well-sm col-sm-offset-1">
                                    Update
                                </a>
                                <a href="deleteProduct.php?categoryId=<?=$_GET['categoryId']?>&productId=<?=$productId?>&productName=<?= $productName ?>&productPrice=<?= $productPrice ?>&quantity=<?= $quantity ?>"
                                   class="well well-sm col-sm-offset-1">
                                    Delete
                                </a>
                            </li>

                            <?php
                            $row = mysql_fetch_assoc($result);
                    }
                }else{
                    echo "<li>No products.</li>";
                }
                ?>

            </ul>
        </div>
        <div class="col-sm-3">
            <ul class="list-group">
                <li class='list-group-item'>
                    <a href="addProduct.php?user=<?= $_SESSION['user'] ?>&categoryId=<?=$_GET['categoryId']?>" class="list-group-item well well-sm">
                        Add Product in this category
                    </a>
                </li>
                <li class='list-group-item'>
                    <a href="updateCategory.php?user=<?= $_SESSION['user'] ?>&category=<?=$_GET['category']?>&categoryId=<?=$_GET['categoryId']?>" class="list-group-item well well-sm">
                        Update this category
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <?php include('../allUsersPages/footer.php'); ?>
<?php
else:
    header("Location: ./startPage.php");
    die;
endif;
?>