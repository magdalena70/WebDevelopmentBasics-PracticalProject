    <span class="date">
<?php
echo date('d-m-Y');
    ?>
    </span>
    <button type="submit" name="promotions" class="btn btn-warning" data-toggle="collapse" data-target="#promotions">
        <span class="glyphicon glyphicon-icon-alarm"></span>Current Promotion
    </button>
    <div id="promotions" class="collapse">

        <?php
        $searchSql = "SELECT * FROM CurrentPromotion";
        $result = mysql_query($searchSql);

        $row = mysql_fetch_assoc($result);
        if($row) {
            while ($row) {
                $content = htmlentities($row['Content']);
                $discount = $row['Discount'];
                $_SESSION['discount'] = $discount;
                $fromDate = date($row['FromDate']);
                $toDate = date($row['ToDate']);
                $promoType = htmlentities($row['PromoType']);
                    ?>

                    <h4>
                        <em><?= $content . " - discount ". $discount . "%, from <b>" . $fromDate . "</b> to <b>" . $toDate . "</b>" ?></em>
                    </h4>

                    <?php
                    $row = mysql_fetch_assoc($result);
            }
        }else {
            echo "No current promotion";
        }
        ?>

    </div>