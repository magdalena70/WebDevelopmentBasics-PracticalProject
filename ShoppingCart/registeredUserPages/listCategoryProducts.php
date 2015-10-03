<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>
<?php include('../functions/catchErrors.php'); ?>
<?php include('../functions/Paginator.class.php'); ?>

<?php
// TO DO - problem with paginate $_GET['']
if (isset($_SESSION['user'])):
    ?>

    <div class="row">
        <div class="col-sm-9">
            <h2>Products in <?= $_GET['category'] ?>:</h2>

                <?php
                checkConnectionDb();
                $conn = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );
                $limit = PAGN_LIMIT;
                $page = PAGN_PAGE;
                $links = PAGN_LINKS;

                $categoryId = $_GET['categoryId'];
                $userId = $_SESSION['userId'];
                $query = "SELECT Id, ProductName, ProductPrice, CategoryId, Quantity, Seller_Id
                        FROM Products
                        WHERE CategoryId=$categoryId
                        AND Seller_Id!=$userId
                        AND isSold=false
                        ORDER BY ProductPrice ASC";

                $Paginator = new Paginator( $conn, $query );
                $results = $Paginator->getData( $limit, $page );
                //var_dump($results);
                //var_dump($_SERVER['PHP_SELF']);
            if(isset($results->data)){
            ?>

            <?php echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?>
            <table class="table table-condensed table-bordered table-rounded">
            <thead>
                <tr>
                    <th width="30%">ProductName</th>
                    <th width="30%">ProductPrice</th>
                    <th width="30%">Quantity</th>
                    <th bgcolor="black" width="10%">Buy</th>
                </tr>
            </thead>
            <tbody>

            <?php for( $i = 0; $i < count( $results->data ); $i++ ) :
                $productId = $results->data[$i]['ProductName'];;
                $productName = htmlentities($results->data[$i]['ProductName']);
                $productPrice = $results->data[$i]['ProductPrice'];
                $quantity = $results->data[$i]['Quantity'];
                ?>
                <tr>
                    <td><?= $productName; ?></td>
                    <td><?= $productName; ?></td>
                    <td><?= $quantity; ?></td>
                    <td bgcolor="black">
                        <a href='userCart.php?productName=<?= $productName ?>&productPrice=<?= $productPrice ?>'>
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                        </a>
                    </td>
                </tr>
            <?php endfor; ?>

            </tbody>
            </table>
        </div>

    <?php
    }else {
        echo "no data";
    }
                ?>

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