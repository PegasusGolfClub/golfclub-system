<?php
// Name: Tymofii Mazurenko
// Student ID: C00325393
// Date: 28/02/2026
// Purpose: To complete the group project

// define variable $conn of mysqli type
/** @var mysqli $conn */

// importing database
include 'database.php';

session_start();

// create variables from the form
$stockId = $_POST['stockId'];
$description = $_POST['descriptionTxt'];
$qtyInStock = $_POST['qtyInStock'];
$reOrderLevel = $_POST['reOrderLevel'];
$reOrderQty = $_POST['reOrderQty'];
$costPrice = $_POST['costPrice'];
$retailPrice = $_POST['retailPrice'];
$supplierValue = $_POST['supplierName'];

// Split supplier value (format: id|name)
$parts = explode("|", $supplierValue);
$supplierNameId = $parts[0];
$supplierName   = $parts[1];

// UPDATE query
$sql = "UPDATE stock_item SET
            description = '$description',
            quantity_in_stock = $qtyInStock,
            reorder_level = $reOrderLevel,
            reorder_quantity = $reOrderQty,
            cost_price = '$costPrice',
            retail_price = '$retailPrice',
            supplier_id = $supplierNameId
        WHERE stock_id = $stockId";

// Execute query
if (!mysqli_query($conn, $sql)) {
    die('Query failed: ' . mysqli_error($conn));
}

mysqli_close($conn);

// closing the php content
?>

    <!-- initializing an html document -->
    <!DOCTYPE html>
    <!-- define the html tag with lang attribute -->
    <html lang="en">
    <head>
        <!--    define the meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--    define the style sheet location -->
        <link rel="stylesheet" type='text/css' href="stock.css">
    </head>
    <body>

    <?php include 'sidebar_stock.php' ?>

    <!-- creating main section -->
    <main id="stock__item_sent">
        <!--    main content -->
        <div class="main-content">
            <!--        creating class card for self-contained ui -->
            <div class="card">
                <!--        defining h2 element -->
                <h2>Details of amended item</h2>
                <div class="container__info">
                    <!-- creating confirmation details section -->
                    <div class="confirmation__details">
                        <table>
                            <tr class="cnf-h-row">
                                <th class="cnf-h-cell">Stock Id</th>
                                <th class="cnf-h-cell">Description</th>
                                <th class="cnf-h-cell">Quantity in stock</th>
                                <th class="cnf-h-cell">Re-order Level</th>
                                <th class="cnf-h-cell">Re-order quantity</th>
                                <th class="cnf-h-cell">Cost price</th>
                                <th class="cnf-h-cell">Retail price</th>
                                <th class="cnf-h-cell">Supplier Name</th>
                            </tr>
                            <tr>
                                <td class="cnf-i-cell"><?= htmlspecialchars($stockId) ?></td>
                                <td class="cnf-i-cell"><?= htmlspecialchars($description) ?></td>
                                <td class="cnf-i-cell"><?= htmlspecialchars($qtyInStock) ?></td>
                                <td class="cnf-i-cell"><?= htmlspecialchars($reOrderLevel) ?></td>
                                <td class="cnf-i-cell"><?= htmlspecialchars($reOrderQty) ?></td>
                                <td class="cnf-i-cell"><?= htmlspecialchars($costPrice) ?></td>
                                <td class="cnf-i-cell"><?= htmlspecialchars($retailPrice) ?></td>
                                <td class="cnf-i-cell"><?= htmlspecialchars($supplierName) ?></td>
                            </tr>
                        </table>
                    </div>

                    <div class="button__links">
                        <a href="amendStockItem.php" class="button__link-item button__link-item--large" id="returnToStockAmend">amend stock</a>
                        <a href="index.php" class="button__link-item button__link-item--large" id="returnToDashboard">dashboard</a>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'navbar_stock.php' ?>
    </main>
    </body>
    </html>

<?php
unset($_SESSION['stockId']);
unset($_SESSION['description']);
unset($_SESSION['qtyInStock']);
unset($_SESSION['reOrderLevel']);
unset($_SESSION['reOrderQty']);
unset($_SESSION['costPrice']);
unset($_SESSION['retailPrice']);
unset($_SESSION['supplierId']);
unset($_SESSION['supplierName']);
unset($_SESSION['stockNumOrder']);
unset($_SESSION['delivered']);
?>