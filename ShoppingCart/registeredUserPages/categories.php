<?php include('../functions/Paginator.class.php') ?>


<?php
if (isset($_SESSION['user'])) :
    ?>

<div class="col-sm-5">
    <h3>Categories:</h3>
    <ul class="list-group">

        <?php
        $conn = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );
        $limit = PAGN_LIMIT;
        $page = PAGN_PAGE;
        $links = PAGN_LINKS;

        $query = "SELECT CategoryName, Id
                      FROM Categories
                      ORDER BY CategoryName";

        $Paginator = new Paginator( $conn, $query );
        $results = $Paginator->getData( $limit, $page );
        //var_dump($results);
    if(isset($results->data)){
        ?>

        <?php echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?>
        <table class="table table-condensed table-bordered table-rounded">
            <thead>
            <tr>
                <th>Categories</th>
                <th>Products</th>
            </tr>
            </thead>
            <tbody>

            <?php for( $i = 0; $i < count( $results->data ); $i++ ) :
                $categoryId = $results->data[$i]['Id'];
                $categoryName = htmlentities($results->data[$i]['CategoryName']);
                ?>

                <tr>
                    <td width="80%"><?= $results->data[$i]['CategoryName']; ?></td>
                    <td width="20%" bgcolor="black">
                        <a href="listCategoryProducts.php?category=<?= $categoryName; ?>&categoryId=<?= $categoryId?>">
                            <span class="glyphicon glyphicon-info-sign"></span>
                        </a>
                    </td>
                </tr>
            <?php endfor; ?>

            </tbody>
        </table>

    <?php
    }else{
        echo "no data";
    }
    ?>

</div>

<?php
else :
    header('Location: ./startPage.php');
    die;
endif;
?>