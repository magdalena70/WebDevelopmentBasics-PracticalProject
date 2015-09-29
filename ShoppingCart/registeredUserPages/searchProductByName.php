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
        $searchSql = "SELECT ProductName, ProductPrice, IsSold
                FROM Products
                WHERE ProductName
                LIKE '%$searchTerm%'
                ORDER BY ProductPrice";
        $result = mysql_query($searchSql);

        $row = mysql_fetch_assoc($result);
        if ($row) {
            while($row) {
                $productName = htmlentities($row['ProductName']);
                $productPrice = floatval($row['ProductPrice']);
                $isSold = $row['IsSold'];
                if($isSold == 0) {
                    $roundPrice = number_format((float)$productPrice, 2, '.', '');
                    ?>

                    <li class='list-group-item'>
                        <?= $productName ." - ". $roundPrice?><a href='' class='list-group-item well well-sm'>Buy</a>
                        </li>

                    <?php
                    $row = mysql_fetch_assoc($result);
                }
            }
        } else {
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