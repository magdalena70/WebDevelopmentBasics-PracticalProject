<?php
if (isset($_SESSION['user'])) :
?>

<div class="col-sm-7">
    <h4>Search product by name:</h4>
    <form action="" method="get" class="form-horizontal" role="form">
        <div class="form-group">
            <div class="col-sm-9">
                <input type="text" class="form-control" id="search" name="search" placeholder="Enter word">
            </div>
            <div class="col-sm-3">
                <button type="submit" class="btn btn-default">Search</button>
            </div>
        </div>
    </form>

    <?php if(isset($_GET['search'])) : ?>

    <ul class="list-group">

        <?php
        $searchTerm = mysql_real_escape_string($_GET['search']);
        $searchSql = "SELECT ProductName, ProductPrice, IsSold FROM Products WHERE ProductName LIKE '%$searchTerm%'";
        $result = mysql_query($searchSql);

        $row = mysql_fetch_assoc($result);
        if ($row) {
            while($row) {
                $productName = htmlentities($row['ProductName']);
                $productPrice = htmlentities($row['ProductPrice']);
                $isSold = $row['IsSold'];
                if($isSold == 0) {
                    $roundPrice = number_format((float)$productPrice, 2, '.', '');
                    echo "<li class='list-group-item'>
                        $productName - $roundPrice <a href='' class='list-group-item'>Buy</a>
                        </li>";
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