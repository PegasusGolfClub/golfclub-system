<!-- initializing html document -->
<!--
Screen Name: Payments Report
Name: Tymofii Mazurenko
Student ID: C00325393
Date: March 2026
Purpose: This screen generates a payments report displaying all player payments,
including payment number, player name, payment date, and amount. It allows the
user to sort the report by payment number, player name, or payment date, and
calculates the total payment amount dynamically.
-->

<?php
// start the session
session_start();
/** @var mysqli $conn */
// include the database
include 'database.php';

// default choice
$choice = "paymentNumber";

// check if choice is set
if (isset($_POST['choice'])) {
    $choice = $_POST['choice'];
}
?>

<!-- initializing the html document -->
<!DOCTYPE html>
<html lang="en">
<head>
<!--    meta settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--    title of the document -->
    <title>Golf Club Admin</title>
<!--    link the stylesheet to the document -->
    <link rel="stylesheet" href="stock.css">
</head>

<body>

<!-- include the sidebar stock -->
<?php include 'sidebar_stock.php'; ?>

<!-- the main section -->
<main id="stock__item">

<!--    main content section -->
    <div class="main-content">
        <div class="card">

<!--            payment title -->
            <h2>Payments Report</h2>

<!--            main payment form -->
            <form action="paymentReport.php" id="displayStockForm" method="post">
                <input type="hidden" name="choice">
            </form>

<!--            button box for selecting different ordering -->
            <div class="button__box button__box--report">

                <!-- payment Number button -->
                <button type="button"
                        class="primary_btn primary_btn--xxl"
                        id="paymentNumberBtn"
                        onclick="paymentNumberOrder()">
                    Payment number
                </button>

                <!-- player Name button -->
                <button type="button"
                        class="primary_btn primary_btn--xxl"
                        id="playerNameBtn"
                        onclick="playerNameOrder()">
                    Player's name
                </button>

                <!-- payment Date button -->
                <button type="button"
                        class="primary_btn primary_btn--xxl"
                        id="paymentDateBtn"
                        onclick="paymentDateOrder()">
                    Date of payment
                </button>

            </div>

            <!-- table container -->
            <div class="container__info">
                <div class="confirmation__details">
                    <table>
                        <tr class="cnf-h-row">
                            <th class="cnf-h-cell">Payment #</th>
                            <th class="cnf-h-cell">Player Name</th>
                            <th class="cnf-h-cell">Date</th>
                            <th class="cnf-h-cell">Amount (€)</th>
                        </tr>

                        <?php

//                        player name choice ordering
                        if ($choice == "playerName") {
                            ?>
<!--                                switching the disabled buttons -->
                            <script>
                                document.getElementById("paymentNumberBtn").disabled = false;
                                document.getElementById("playerNameBtn").disabled = true;
                                document.getElementById("paymentDateBtn").disabled = false;
                            </script>
                        <?php
//                        sql statement for ordering by payment name
                        $sql = "SELECT
                pay.payment_id AS paymentNumber,
                p.name AS playerName,
                pay.payment_date,
                pay.amount
            FROM payment pay
            INNER JOIN player p
                ON pay.player_num = p.player_id
            WHERE p.deleted = 0
            ORDER BY p.name ASC";

//                        produce report function
                        produceReport($conn, $sql);

//                        payment date choice ordering
                        } else if ($choice == "paymentDate") {
                        ?>
<!--                            switching the disabled buttons -->
                            <script>
                                document.getElementById("paymentNumberBtn").disabled = false;
                                document.getElementById("playerNameBtn").disabled = false;
                                document.getElementById("paymentDateBtn").disabled = true;
                            </script>
<!--                            sql statement for ordering by payment date -->
                        <?php
                        $sql = "SELECT
                pay.payment_id AS paymentNumber,
                p.name AS playerName,
                pay.payment_date,
                pay.amount
            FROM payment pay
            INNER JOIN player p
                ON pay.player_num = p.player_id
            WHERE p.deleted = 0
            ORDER BY pay.payment_date ASC";

//                        produce report function
                        produceReport($conn, $sql);

//                        default: payment number choice ordering
                        } else {
                        ?>
<!--                            switching the disabled buttons -->
                            <script>
                                document.getElementById("paymentNumberBtn").disabled = true;
                                document.getElementById("playerNameBtn").disabled = false;
                                document.getElementById("paymentDateBtn").disabled = false;
                            </script>
                            <?php
//                            sql statement for ordering by payment number
                            $sql = "SELECT
                pay.payment_id AS paymentNumber,
                p.name AS playerName,
                pay.payment_date,
                pay.amount
            FROM payment pay
            INNER JOIN player p
                ON pay.player_num = p.player_id
            WHERE p.deleted = 0
            ORDER BY pay.payment_id ASC";

//                            produce report function
                            produceReport($conn, $sql);
                        }

//                        Produce report function
                        function produceReport($con, $sql)
                        {
//                            get the result from the query
                            $result = mysqli_query($con, $sql);

//                            check if the result is valid
                            if (!$result) {
                                die("Query failed: " . mysqli_error($con));
                            }

//                            total amount count
                            $total = 0;

//                            while loop to showcase the data in the database
                            while ($row = mysqli_fetch_assoc($result)) {

//                                date with format dd/mm/yyyy
                                $date = date("d/m/Y", strtotime($row['payment_date']));
//                                amount from one transaction
                                $amount = $row['amount'];
                                $total += $row['amount'];

//                                table with data
                                echo "<tr>
                <td class='cnf-i-cell'>{$row['paymentNumber']}</td>
                <td class='cnf-i-cell'>{$row['playerName']}</td>
                <td class='cnf-i-cell'>{$date}</td>
                <td class='cnf-i-cell amount-cell'>€{$amount}</td>
              </tr>";
                            }

//                            total row
                            echo "<tr class='total-row'>
            <td colspan='3'><strong>Total</strong></td>
            <td class='amount-cell'><strong>€" . $total . "</strong></td>
          </tr>";
                        }
                        ?>

                    </table>
                </div>
            </div>

        </div>
    </div>

<!--    include navbar stock -->
    <?php include 'navbar_stock.php'; ?>

</main>

<script>
//    get the display stock form
    stockForm = document.getElementById("displayStockForm");
    // order by payment number
    function paymentNumberOrder() {
        // store paymentNumber in the stockForm choice variable
        stockForm.choice.value = "paymentNumber";
        stockForm.submit();
    }

    // order by player name
    function playerNameOrder() {
        // store playerName in the stockForm choice variable
        stockForm.choice.value = "playerName";
        stockForm.submit();
    }

    // order by payment date
    function paymentDateOrder() {
        // store paymentDate in the stockForm choice variable
        stockForm.choice.value = "paymentDate";
        stockForm.submit();
    }
</script>

</body>
</html>