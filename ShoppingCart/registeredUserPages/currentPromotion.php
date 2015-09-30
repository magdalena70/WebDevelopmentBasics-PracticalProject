<?php
echo date('d-m-Y');
    ?>

    <button type="submit" name="promotions" class="btn btn-warning" data-toggle="collapse" data-target="#promotions">
        Current Promotion
    </button>
    <div id="promotions" class="collapse">

        <?php
        $searchSql = "SELECT Content, Discount, FromDate, ToDate, PromoType
                  FROM Promotions
                  WHERE FromDate <= CURRENT_DATE()
                  AND ToDate >= CURRENT_DATE()
                  ORDER BY Discount DESC LIMIT 1";
        $result = mysql_query($searchSql);

        $row = mysql_fetch_assoc($result);
        if($row) {
            while ($row) {
                $content = htmlentities($row['Content']);
                $discount = $row['Discount'];
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