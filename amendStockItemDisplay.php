<!-- creating php document -->
<?php
// Screen Name: Amend/View Stock Item (Display, Search Processing)
// Name: Tymofii Mazurenko
// Student ID: C00325393
// Date: March 2026
// Purpose: This script processes the search request for a stock item using either
// stock number or description, retrieves the matching record from the database,
// and stores the result in session variables. These values are then used to populate
// the amend stock item screen for viewing or editing. If no match is found, session
// variables are cleared before redirecting back to the amend screen.

// defining conn variable
/** @var mysqli $conn */
// including database connection
include 'database.php';

session_start();

// setting the choice variable
if (isset($_POST['choice'])) {
    $choice = $_POST['choice'];
}


$sql = '';
//    getting variables from the form
$description = $_POST['description'];
$stockNum = $_POST['stockNum'];
//    create sql statement for querying the database
if (trim($stockNum) == '' && trim($description) != '') {
    $sql = "SELECT s.stock_id,
                    s.description,
                    s.quantity_in_stock,
                    s.reorder_level,
                    s.reorder_quantity,
                    s.cost_price,
                    s.retail_price,
                    sup.supplier_id,
                    sup.supplier_name,
                    o.order_num,
                    og.delivered FROM stock_item s INNER JOIN supplier sup
                    ON s.supplier_id = sup.supplier_id LEFT JOIN order_item o 
                    ON s.stock_id = o.stock_num LEFT JOIN order_golf og
                    ON og.order_id = o.order_num WHERE s.description = '$description' AND s.deleted = 0";
} else if (trim($stockNum) != '' && trim($description) == '') {
//    sql statement
    $sql = "SELECT s.stock_id,
                    s.description,
                    s.quantity_in_stock,
                    s.reorder_level,
                    s.reorder_quantity,
                    s.cost_price,
                    s.retail_price,
                    sup.supplier_id,
                    sup.supplier_name,
                    o.order_num,
                    og.delivered FROM stock_item s INNER JOIN supplier sup
                    ON s.supplier_id = sup.supplier_id LEFT JOIN order_item o 
                    ON s.stock_id = o.stock_num LEFT JOIN order_golf og
                    ON og.order_id = o.order_num WHERE s.stock_id = $stockNum AND s.deleted = 0";
}

//    function call to get result
if ($sql != '') {
    $row = stockItemDisplay($conn, $sql);
}

function stockItemDisplay($conn, $sql) {
//    getthing the result from query execution
    $result = mysqli_query($conn, $sql);
//    if the query fails
    if (!$result) {
//        throw a message with failed query
        die ('Query failed ' . mysqli_error($conn));
    }

//    checking if number of affected rows is 1
    if (mysqli_num_rows($result) == 1) {
//        getting the row from query
        $row = mysqli_fetch_array($result);

//        save queried info into session variables
        $_SESSION['stockId'] = $row['stock_id'];
        $_SESSION['description'] = $row['description'];
        $_SESSION['qtyInStock'] = $row['quantity_in_stock'];
        $_SESSION['reOrderLevel'] = $row['reorder_level'];
        $_SESSION['reOrderQty'] = $row['reorder_quantity'];
        $_SESSION['costPrice'] = $row['cost_price'];
        $_SESSION['retailPrice'] = $row['retail_price'];
        $_SESSION['supplierId'] = $row['supplier_id'];
        $_SESSION['supplierName'] = $row['supplier_name'];
        $_SESSION['orderNum'] = $row['order_num'];
        $_SESSION['delivered'] = $row['delivered'];
    } else {
//        unset if no matches found
        unset($_SESSION['stockId']);
        unset($_SESSION['description']);
        unset($_SESSION['qtyInStock']);
        unset($_SESSION['reOrderLevel']);
        unset($_SESSION['reOrderQty']);
        unset($_SESSION['costPrice']);
        unset($_SESSION['retailPrice']);
        unset($_SESSION['supplierId']);
        unset($_SESSION['supplierName']);
        unset($_SESSION['orderNum']);
        unset($_SESSION['delivered']);
    }
}

// redirect to the amendStockItem
header('Location: amendStockItem.php');

// close mysqli connection
mysqli_close($conn);