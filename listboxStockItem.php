<?php
// Name: Tymofii Mazurenko
// Student ID: C00325393
// Date: 28/02/2026
// Purpose: To complete the group project

// define variable $conn of mysqli type
/** @var mysqli $conn */

// include the database file
include 'database.php';

// create sql variable with sql statement
$sql = "SELECT * FROM stock_item WHERE deleted = 0";

// executing the query
$result = mysqli_query($conn, $sql);

// validate the result
if (!$result) {
    // display an error message if connection is failed
    die ('Query failed: ' . mysqli_error($conn));
}

echo "<select name='stockItem' class='listbox' id='stockItem' size='5' onclick='displayDetails()'>";

// creating a loop for the query
while ($row = mysqli_fetch_array($result)) {
    // getting information from database
    $stockId = $row['stock_id'];
    $description = $row['description'];

//    option for in the select
    echo "<option value='$stockId'>$stockId, $description</option>";
}

// closing an element
echo "</select>";

// closing connection
mysqli_close($conn);