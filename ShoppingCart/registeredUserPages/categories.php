<?php
if (isset($_SESSION['user'])) :
    ?>

<div class="col-sm-4">
    <h3>Categories:</h3>
    <ul class="list-group">

        <?php
        $searchSql = "SELECT CategoryName, Id
                FROM Categories
                ORDER BY CategoryName";
        $result = mysql_query($searchSql);

        $row = mysql_fetch_assoc($result);
        if ($row) {
            while($row) {
                $categoryName = htmlentities($row['CategoryName']);
                $categoryId = htmlentities($row['Id']);
                $_SESSION['categoryId'] = $categoryId;
                ?>

                    <li class='list-group-item'>
                        <a href="listCategoryProducts.php?category=<?=$categoryName?>&categoryId=<?=$_SESSION['categoryId']?>" class="list-group-item">
                            <?= $categoryName ?>
                        </a>
                        <a href="addProduct.php?user=<?= $_SESSION['user'] ?>&categoryId=<?=$_SESSION['categoryId']?>" class="list-group-item well well-sm">
                            Add Product
                        </a>
                    </li>

                <?php
                $row = mysql_fetch_assoc($result);
            }
        } else {
            echo "<li>No categories.</li>";
        }
        ?>

    </ul>
</div>

<?php
else :
    header('Location: ./startPage.php');
    die;
endif;
?>