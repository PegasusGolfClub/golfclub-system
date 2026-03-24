<?php
// Name: Tymofii Mazurenko
// Student ID: C00325393
// Date: March 2026
// Purpose: This script retrieves all non-deleted stock items from the database
// and dynamically generates a HTML select list (listbox). Each option contains
// stock item details encoded in the value attribute, allowing the selected item
// to be displayed or processed in other screens such as amend and delete.

// define variable $conn of mysqli type
/** @var mysqli $conn */

// include the database file
include 'database.php';

// create sql variable with sql statement
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
                    o.stock_num,
                    og.delivered FROM stock_item s INNER JOIN supplier sup
                    ON s.supplier_id = sup.supplier_id LEFT JOIN order_item o 
                    ON s.stock_id = o.stock_num LEFT JOIN order_golf og
                    ON og.order_id = o.order_num WHERE s.deleted = 0 GROUP BY s.stock_id";

// executing the query
$result = mysqli_query($conn, $sql);

// validate the result
if (!$result) {
    // display an error message if connection is failed
    die ('Query failed: ' . mysqli_error($conn));
}

echo "<select name='stockItem' class='listbox' id='stockItem' onchange='displayDetails()'>";

// creating a loop for the query
while ($row = mysqli_fetch_array($result)) {
    // getting information from database
    $stockId = $row['stock_id'];
    $description = $row['description'];
    $quantityInStock = $row['quantity_in_stock'];
    $reorderLevel = $row['reorder_level'];
    $reorderQuantity = $row['reorder_quantity'];
    $costPrice = $row['cost_price'];
    $retailPrice = $row['retail_price'];
    $supplierName = $row['supplier_name'];
    $orderNum = $row['order_num'];
    $delivered = $row['delivered'];
    $supplierId = $row['supplier_id'];
    $stockNumOrder = $row['stock_num'];

//    option for in the select
    echo "<option value='$stockId|$description|$quantityInStock|$reorderLevel|$reorderQuantity|$costPrice|$retailPrice|$supplierName|$orderNum|$delivered|$supplierId|$stockNumOrder'>$stockId, $description</option>";
}

// closing an element
echo "</select>";

// closing connection
mysqli_close($conn);