<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>
<?php include('../functions/catchErrors.php'); ?>

<?php
if (isset($_SESSION['user'])) :
    $subtotal = 0.00;
    ?>

    <div class="row">
        <h2>Products for sale:</h2>
        <ul class="list-group">

            <?php
            checkConnectionDb();
            mysql_connect(DB_HOST, DB_USER, DB_PASS);
            mysql_select_db(DB_NAME);

            $userId = $_SESSION['userId'];
            $searchSql = "SELECT Id, ProductName, ProductPrice, Quantity, isSold, CategoryId
                          FROM Products
                          WHERE Seller_Id=$userId
                          AND isSold=false
                          GROUP BY CategoryId
                          ORDER BY ProductPrice";
            $result = mysql_query($searchSql);

            $row = mysql_fetch_assoc($result);
            if($row) {
                while ($row) {
                    $productId = $row['Id'];
                    $productName = htmlentities($row['ProductName']);
                    $productPrice = $row['ProductPrice'];
                    $quantity = $row['Quantity'];
                    $categoryId = $row['CategoryId']
                    ?>

                    <li class='list-group-item'>
                        <?= $productName . " - " . $productPrice ?>
                        <a href="updateProduct.php?categoryId=<?= $categoryId;?>&productId=<?=$productId?>&productName=<?= $productName ?>&productPrice=<?= $productPrice ?>&quantity=<?= $quantity ?>"
                           class="well well-sm col-sm-offset-1">
                            Update
                        </a>
                        <a href="deleteProduct.php?categoryId=<?= $categoryId;?>&productId=<?=$productId?>&productName=<?= $productName ?>&productPrice=<?= $productPrice ?>&quantity=<?= $quantity ?>"
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

<?php
include('../allUsersPages/footer.php');

else :
header('Location: ./startPage.php');
die;
endif;
?>