<?php
if (isset($_SESSION['user'])) :
?>

<div class="col-sm-4">
    <h4>Search product by name:</h4>
    <form action="" method="get" class="form-horizontal" role="form">
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

    <?php if(isset($_GET['search'])) : ?>

    <ul class="list-group">

        <?php
        $searchTerm = mysql_real_escape_string($_GET['search']);
        $searchSql = "SELECT * FROM ProductsFromOtherSellers
                WHERE ProductName
                LIKE '%$searchTerm%'
                AND isSold = false";
        $result = mysql_query($searchSql);

        $row = mysql_fetch_assoc($result);
        if ($row) {
            while($row) {
                $productName = htmlentities($row['ProductName']);
                $productPrice = $row['ProductPrice'];
                $quantity = $row['Quantity'];
                ?>

                <li class='list-group-item'>
                    <?= $productName ." - ". $productPrice ." quantity: ". $quantity?>
                    <a href='userCart.php?productName=<?= $productName ?>&productPrice=<?= $productPrice ?>' class='list-group-item'">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                    </a>
                </li>

                    <?php
                    $row = mysql_fetch_assoc($result);
            }
        } else{
            echo "<li>No products.</li>";
        }
        ?>

    </ul>

<?php endif; ?>

</div>

<?php
else :
    header('Location: ./startPage.php');
    die;
endif;
?>