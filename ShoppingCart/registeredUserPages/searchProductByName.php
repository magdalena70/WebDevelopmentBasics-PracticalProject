<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>
<?php include('../functions/catchErrors.php'); ?>
<?php include('../functions/Paginator.class.php') ?>

<?php
if (isset($_SESSION['user'])) :
?>

<div class="col-sm-10 col-sm-offset-1">
    <div class="col-sm-6 col-sm-offset-6">
        <h4>Search product by name:</h4>
        <form action="searchProductByName.php" method="get" class="form-horizontal" role="form">
        <div class="form-group">
            <div class="col-sm-8">
                <input type="text" class="form-control" id="search" name="search" placeholder="Enter word">
            </div>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>Search
                </button>
            </div>
        </div>
    </form>
    </div>

    <?php if(isset($_GET['search'])) :
        // TO DO -> there is a problem with pagination
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $limit = PAGN_LIMIT;
        $page = PAGN_PAGE;
        $links = PAGN_LINKS;

        $sellerId = $_SESSION['userId'];
        $escapeStr = $_GET['search'];
        $searchWord = mysqli_real_escape_string($conn, $escapeStr);
        $query = "SELECT ProductName, ProductPrice, Quantity FROM Products
                      WHERE ProductName LIKE '%$searchWord%'
                      AND Seller_Id!=$sellerId
                      AND isSold = false
                      ORDER BY ProductPrice ASC";

        $Paginator = new Paginator($conn, $query);
        $results = $Paginator->getData($limit, $page);
        //var_dump($results);
        if(!isset($results->data)) {
            echo "No data";
        }else {
            ?>

            <?php echo $Paginator->createLinks($links, 'pagination pagination-sm'); ?>
            <table class="table table-condensed table-bordered table-rounded">
                <thead>
                <tr>
                    <th>ProductName</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Buy</th>
                </tr>
                </thead>
                <tbody>

                <?php for ($i = 0; $i < count($results->data); $i++) : ?>
                    <tr>

                        <?php
                        $productName = htmlentities($results->data[$i]['ProductName']);
                        $productPrice = $results->data[$i]['ProductPrice'];
                        $quantity = $results->data[$i]['Quantity'];
                        ?>

                        <td><?= $productName; ?></td>
                        <td><?= $productPrice; ?></td>
                        <td><?= $quantity; ?></td>
                        <td><a href='userCart.php?productName=<?= $productName ?>&productPrice=<?= $productPrice ?>'>
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                            </a></td>
                    </tr>
                <?php endfor; ?>

                </tbody>
            </table>

            <?php
        }
?>
<?php endif; ?>

</div>

    <?php include('../allUsersPages/footer.php'); ?>
<?php
else :
    header('Location: ./startPage.php');
    die;
endif;
?>