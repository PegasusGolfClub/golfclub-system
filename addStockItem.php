<!-- initializing html document -->
<!--
Screen Name: Add Stock Item
Name: Tymofii Mazurenko
Student ID: C00325393
Date: February 2026
Purpose: This screen allows the user to add a new stock item to the system by entering
a description, quantity in stock, reorder level, reorder quantity, cost price,
retail price, and selecting a supplier. It includes client-side validation to ensure
data accuracy and completeness before submitting the form to the server for processing.
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
                    <textarea name="description" id="description" maxlength="100"
                              autofocus title="Enter a description of a stock item" placeholder="Enter a description (at least 4 characters)" required></textarea>
                </div>
                
<!--                input box for quantity in stock -->
                <div class="input__box">
<!--                    label for quantity in stock -->
                    <label for="qtyInStock">Quantity in stock: </label>
<!--                    input field for quantity in stock -->
                    <input type="number" id="qtyInStock" name="qtyInStock" placeholder="Enter a quantity of a stock item (must be integer)" min="0" pattern="[0-9]+"
                    title="Enter a quantity of a stock item" required>
                </div>
                
<!--                input box for re-order level -->
                <div class="input__box">
<!--                    label for re-order level -->
                    <label for="reOrderLevel">Re-order level: </label>
<!--                    input field for re-order level -->
                    <input type="number" id="reOrderLevel" name="reOrderLevel" placeholder="Enter a re-order level (must be integer)" min="0" pattern="[0-9]+"
                    title="Enter re-order level of a stock item" required>
                </div>
                
<!--                input box for re-order quantity -->
                <div class="input__box">
<!--                    level for re-rder quantity -->
                    <label for="reOrderQty">Re-order quantity: </label>
<!--                    input field for re-order quantity -->
                    <input type="number" id="reOrderQty" name="reOrderQty" placeholder="Enter re-order quantity (must be integer)" min="0" pattern="[0-9]+"
                    title="Enter re-order quantity of a stock item" required>
                </div>
                
<!--                input box for cost price -->
                <div class="input__box">
<!--                    label for cost price -->
                    <label for="costPrice">Cost price: </label>
<!--                    input field for cost price -->
                    <input type="number" id="costPrice" name="costPrice" placeholder="Enter cost price (must be decimal)" step="0.01" min="0" pattern="[0-9]+"
                    title="Enter the cost of a stock item" required>
                </div>
                
<!--                input box for retail price -->
                <div class="input__box">
<!--                    label for retail price -->
                    <label for="retailPrice">Retail price: </label>
<!--                    input field for retail price -->
                    <input type="number" id="retailPrice" name="retailPrice" placeholder="Enter retail price (must be decimal)" step="0.01" min="0" pattern="[0-9]+"
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
    const supplierName = document.getElementById('supplierName');
    const stockForm = document.getElementById("stockForm");
    const buttonSent = document.getElementById("submitAddStock");
    const costPrice = document.getElementById("costPrice");
    const retailPrice = document.getElementById("retailPrice");

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
        let pass = true;

        //  checks if description is empty
        if (description.value.length < 4){
            alert("Description has to be more than 4 characters");
            pass = false;
            e.preventDefault()
        }

        // check if the description is a valid text
        if (!/[a-zA-Z]/.test(description.value)){
            alert("Description must contain text and not only numbers.");
            pass = false;
            e.preventDefault()
        }

        //  check if the cost price is higher than retail price
        if (parseFloat(costPrice.value) > parseFloat(retailPrice.value)) {
            alert("The cost price can't be higher than the retail price.");
            pass = false;
            e.preventDefault();
        }

        // supplier name value check
        if (supplierName.value === "") {
            alert("The supplier name is not provided.");
            pass = false;
            e.preventDefault()
        }

        // if pass then confirm message
        if (pass) {
            // confirm message with
            let confirmSubmit = confirm("Are you sure the stock item details are correct?");

            if(!confirmSubmit){
                e.preventDefault();
            }
        }

    })
</script>
</body>
</html>