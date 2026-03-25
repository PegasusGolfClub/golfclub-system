<?php
// Name: Tymofii Mazurenko
// Student ID: C00325393
// Date: March 2026
// Purpose: This script retrieves all supplier records from the database and
// dynamically generates a HTML select list (listbox) of suppliers. It also
// preserves the previously selected supplier using session data, allowing
// consistent selection when adding or amending stock items.

// define variable $conn of mysqli type
/** @var mysqli $conn */

// include the database file
include 'database.php';

// create sql variable with sql statement
$sql = "SELECT * FROM supplier";

// executing the query
$result = mysqli_query($conn, $sql);

// validate the result
if (!$result) {
    // display an error message if connection is failed
    die ('Query failed: ' . mysqli_error($conn));
}

echo "<select name='supplierName' class='listbox' id='supplierName'>";

// creating a loop for the query
while ($row = mysqli_fetch_array($result)) {
    // getting information from database
    $supplierId = $row['supplier_id'];
    $supplierName = htmlspecialchars($row['supplier_name']);

    $selected = (isset($_SESSION['supplierId']) &&
        $_SESSION['supplierId'] == $supplierId)
        ? 'selected'
        : '';

//    echoing out the values in options
    echo "<option value='$supplierId|$supplierName' $selected>$supplierName</option>";
}

// closing an element
echo "</select>";

// closing connection
mysqli_close($conn);