<!-- initializing html document -->
<!--
Name: Tymofii Mazurenko
Student ID: C00325393
Date: 28/02/2026
Purpose: To complete the group project
-->

<!DOCTYPE html>
<html lang="en">
<head>
<!--    define meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--    define the style sheet location -->
    <link rel="stylesheet" href="stock.css">
<!--    title of the document -->
    <title>Golf Club Admin</title>
</head>

<body>

<?php include 'sidebar_stock.php' ?>

<!-- Main Content Area -->
<main id="stock__item">
    <div class="main-content">
        <div class="card">
            <h2>Add stock item</h2>
            <form action="addStockItemSent.php" class="main-form" id="stockForm" method="post">
<!--                input box for description -->
                <div class="input__box">
<!--                    label for description -->
                    <label for="description">Description: </label>
<!--                    input field for description -->
                    <textarea name="description" id="description"
                              autofocus title="Enter a description of a stock item" required></textarea>
                </div>
                
<!--                input box for quantity in stock -->
                <div class="input__box">
<!--                    label for quantity in stock -->
                    <label for="qtyInStock">Quantity in stock: </label>
<!--                    input field for quantity in stock -->
                    <input type="text" id="qtyInStock" name="qtyInStock"
                    title="Enter a quantity of a stock item" required>
                </div>
                
<!--                input box for re-order level -->
                <div class="input__box">
<!--                    label for re-order level -->
                    <label for="reOrderLevel">Re-order level: </label>
<!--                    input field for re-order level -->
                    <input type="text" id="reOrderLevel" name="reOrderLevel"
                    title="Enter re-order level of a stock item" required>
                </div>
                
<!--                input box for re-order quantity -->
                <div class="input__box">
<!--                    level for re-rder quantity -->
                    <label for="reOrderQty">Re-order quantity: </label>
<!--                    input field for re-order quantity -->
                    <input type="text" id="reOrderQty" name="reOrderQty"
                    title="Enter re-order quantity of a stock item" required>
                </div>
                
<!--                input box for cost price -->
                <div class="input__box">
<!--                    label for cost price -->
                    <label for="costPrice">Cost price: </label>
<!--                    input field for cost price -->
                    <input type="text" id="costPrice" name="costPrice"
                    title="Enter the cost of a stock item" required>
                </div>
                
<!--                input box for retail price -->
                <div class="input__box">
<!--                    label for retail price -->
                    <label for="retailPrice">Retail price: </label>
<!--                    input field for retail price -->
                    <input type="text" id="retailPrice" name="retailPrice"
                    title="Enter the retail price of a stock item" required>
                </div>

<!--                select box for supplier name -->
                <div class="select__box">
<!--                    label for supplier name -->
                    <label for="supplierName">Supplier name: </label>
<!--                    list box for supplier name -->
                        <?php include 'listboxSupplier.php' ?>
                </div>

<!--                button box -->
                <div class="button__box">
<!--                    input field for submit -->
                    <input type="submit" name="submitAddStock" id="submitAddStock" value="Add" style="display: none;">
<!--                    input field for reset -->
                    <input type="reset" name="resetAddStock" id="resetAddStock" value="Clear" onclick="removeSentBtn()">
                </div>
            </form>
        </div>
    </div>
    <?php include 'navbar_stock.php' ?>
</main>

<script>
//    create constants from the form
    const description = document.getElementById("description");
    const qtyInStock = document.getElementById("qtyInStock");
    const reOrderLevel = document.getElementById("reOrderLevel");
    const reOrderQty = document.getElementById("reOrderQty");
    const costPrice = document.getElementById("costPrice");
    const retailPrice = document.getElementById("retailPrice");
    const supplierName = document.getElementById('supplierName');

    const stockForm = document.getElementById("stockForm");
    const buttonSent = document.getElementById("submitAddStock");

    // check form validity and choose between block and none
    buttonSent.style.display = stockForm.checkValidity() ? 'block' : 'none';

    // check the input for validity
    stockForm.addEventListener('input', (e) => {
        buttonSent.style.display = stockForm.checkValidity() ? 'block' : 'none';
    })

    // function that removes button sent
    function removeSentBtn() {
        buttonSent.style.display = 'none';
    }

    // submit function that checks the fields
    stockForm.addEventListener('submit', (e) => {
        // parse item quantity to int to check if it's not null
        let stockQtyCheck = parseInt(qtyInStock.value);
        if (isNaN(stockQtyCheck)) {
            alert("Enter the quantity as an integer");
            e.preventDefault();
        }

        // parse order level to int to check if it's not null
        let orderLevelCheck = parseInt(reOrderLevel.value);
        if (isNaN(orderLevelCheck)) {
            alert("Enter the order level as an integer");
            e.preventDefault();
        }

        // parse order quantity to int to check if it's not null
        let orderQtyCheck = parseInt(reOrderQty.value);
        if (isNaN(orderQtyCheck)) {
            alert("Enter the order quantity as an integer");
            e.preventDefault();
        }

        let supplier = document.getElementById("supplierName");

        // check the supplier value if empty
        if (supplier.value === "") {
            alert("Please select a supplier");
            e.preventDefault();
        }
    })
</script>
</body>
</html>