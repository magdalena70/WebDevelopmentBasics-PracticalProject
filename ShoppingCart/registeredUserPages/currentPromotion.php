<?php
echo date('d-m-Y');
//if (isset($_SESSION['user'])) :
    ?>

    <button type="submit" name="promotions" class="btn btn-warning" data-toggle="collapse" data-target="#promotions">Promotions</button>
    <div id="promotions" class="collapse">

        <?php
        $searchSql = "SELECT Content, Discount, PromoType, FromDate, ToDate
                        FROM Promotions
                        ORDER BY FromDate ASC
                        LIMIT 2";
        $result = mysql_query($searchSql);

        $row = mysql_fetch_assoc($result);
        if($row) {
            $count = 1;
            while ($row) {
                $content = htmlentities($row['Content']);
                $discount = floatval($row['Discount']);
                $fromDate = date($row['FromDate']);
                $toDate = date($row['ToDate']);
                $promoType = htmlentities($row['PromoType']);
                ?>

                <p>
                    Promotion# <?= $count . "." . $content . " - " . " from <b>" . $fromDate . "</b> to <b>" . $toDate ."</b>"?></p>

                <?php
                $row = mysql_fetch_assoc($result);
                $count++;
            }
        }else {
            echo "No current promotion";
        }
        ?>

    </div>

<?php
//else:
    //header("Location: ./startPage.php");
    //die;
//endif;
?>