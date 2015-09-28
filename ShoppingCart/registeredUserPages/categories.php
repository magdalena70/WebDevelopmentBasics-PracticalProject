<?php
if (isset($_SESSION['user'])) :
    ?>

<div class="col-sm-5">
    <h3>Categories:</h3>
    <ul class="list-group col-ofset">

        <?php
        $searchSql = "SELECT CategoryName, Id FROM Categories";
        $result = mysql_query($searchSql);

        $row = mysql_fetch_assoc($result);
        if ($row) {
            while($row) {
                $categoryName = htmlentities($row['CategoryName']);
                $categoryId = htmlentities($row['Id']);
                $_SESSION['categoryId'] = $categoryId;
                    echo "<li class='list-group-item'><a href='?category=$categoryName' class='list-group-item'>$categoryName</a>".
                        "<div class='list-group'>";
                    ?>

                    <a href="addProduct.php?user=<?= $_SESSION['user'] ?>&categoryId=<?=$_SESSION['categoryId']?>" class="list-group-item">
                        Add Product
                    </a>

                    <?php
                    echo "</div></li>";
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