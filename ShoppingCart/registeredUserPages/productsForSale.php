<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>
<?php include('../functions/catchErrors.php'); ?>
<?php include('../functions/Paginator.class.php') ?>

<?php
if (isset($_SESSION['user'])) :
    $subtotal = 0.00;
    ?>

    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
        <h2>Products for sale:</h2>

        <?php
        checkConnectionDb();
        $conn = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );
        $limit = PAGN_LIMIT;
        $page = PAGN_PAGE;
        $links = PAGN_LINKS;

        $userId = $_SESSION['userId'];
        $query = "SELECT Products.Id, Products.ProductName,
                          Products.ProductPrice, Products.Quantity,
                          Products.CategoryId, Categories.CategoryName
                  AS Id, ProductName, ProductPrice, Quantity, CategoryId, CategoryName
                  FROM Products, Categories
                  WHERE Seller_Id=$userId
                  AND isSold=false
                  AND Products.CategoryId=Categories.Id
                  ORDER BY ProductPrice";

        $Paginator = new Paginator( $conn, $query );
        $results = $Paginator->getData( $limit, $page );
        //var_dump($results);
        if(isset($results->data)):
        ?>
            <?php echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?>
            <table class="table table-condensed table-bordered table-rounded">
                <thead>
                    <tr>
                        <th width="40%">ProductName</th>
                        <th width="15%">Price</th>
                        <th width="15%">Quantity</th>
                        <th width="20%">Category</th>
                        <th width="5%" bgcolor="black">Update</th>
                        <th width="5%" bgcolor="black">Delete</th>
                    </tr>
                </thead>
                <tbody>

            <?php for( $i = 0; $i < count( $results->data ); $i++ ) :
                $categoryId = $results->data[$i]['CategoryId'];
                $productId = $results->data[$i]['Id'];
                $productName = $results->data[$i]['ProductName'];
                $productPrice = $results->data[$i]['ProductPrice'];
                $quantity = $results->data[$i]['Quantity'];
                ?>

                <tr>
                    <td><?php echo $results->data[$i]['ProductName']; ?></td>
                    <td><?php echo $results->data[$i]['ProductPrice']; ?></td>
                    <td><?php echo $results->data[$i]['Quantity']; ?></td>
                    <td><?php echo $results->data[$i]['CategoryName']; ?></td>
                    <td bgcolor="black"><a href="updateProduct.php?categoryId=<?=$categoryId;?>&productId=<?=$productId?>&productName=<?= $productName ?>&productPrice=<?= $productPrice ?>&quantity=<?= $quantity ?>">
                        <span class="glyphicon glyphicon-cog"></span>
                    </a></td>
                    <td bgcolor="black"><a href="deleteProduct.php?categoryId=<?= $categoryId;?>&productId=<?=$productId?>&productName=<?= $productName ?>&productPrice=<?= $productPrice ?>&quantity=<?= $quantity ?>">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a></td>
                </tr>

            <?php endfor; ?>

            </tbody>
        </table>

        <?php else: echo "no data"; endif;;?>

        </div>
    </div>

<?php
include('../allUsersPages/footer.php');

else :
header('Location: ./startPage.php');
die;
endif;
?>