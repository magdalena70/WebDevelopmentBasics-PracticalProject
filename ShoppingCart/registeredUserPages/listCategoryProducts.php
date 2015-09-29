<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>
<?php include('../functions/catchErrors.php'); ?>

<?php
if (isset($_SESSION['user'])) :
    ?>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <h2>Products in category <?= $_GET['category'] ?></h2>
            <ul class="list-group">

                <?php
                checkConnectionDb();
                mysql_connect(DB_HOST, DB_USER, DB_PASS);
                mysql_select_db(DB_NAME);

                $categoryId = $_GET['categoryId'];
                $searchSql = "SELECT ProductName, ProductPrice, CategoryId, isSold
                        FROM Products
                        WHERE CategoryId=$categoryId
                        ORDER BY ProductPrice";
                $result = mysql_query($searchSql);

                $row = mysql_fetch_assoc($result);
                if($row){
                    while($row){
                        $productName = htmlentities($row['ProductName']);
                        $productPrice = floatval($row['ProductPrice']);
                        $roundPrice = number_format((float)$productPrice, 2, '.', '');
                        $prCatId = $row['CategoryId'];
                        $isSold = $row['isSold'];
                        if($isSold == 0){
                            ?>

                            <li class='list-group-item'>
                                <?= $productName . " - " . $roundPrice ?>
                                <a href='' class="well well-sm col-sm-offset-1">Buy</a>
                            </li>

                            <?php
                            $row = mysql_fetch_assoc($result);
                        }
                    }
                }else{
                    echo "<li>No products.</li>";
                }
                ?>

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