<!-- initializing html document -->
<!--
Name: Tymofii Mazurenko
Student ID: C00325393
Date: 28/02/2026
Purpose: To complete the group project
-->

<!-- set session start -->
<?php session_start(); ?>

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
        <div class="card" id="cardDelete">
            <h2>Amend stock item</h2>
            <form action="amendStockItemDisplay.php" id="displayStockForm" method="post">
                <input type="hidden" name="choice">
                <input type="hidden" name="stockItemId">
                <input type="hidden" name="stockNum">
                <input type="hidden" name="description">
            </form>
            <form action="amendStockItemSent.php" class="main-form main-form--large" id="stockForm" method="post">
                <div class="search__button-box search__button-box--left">
                    <button type="button" name="findStockButton" id="findStockButton" class="primary_btn"
                            onclick="toggleFindOptions()">Find</button>
                    <button type="button" name="amendViewStockBtn" id="amendViewStockBtn" class="primary_btn primary_btn--large"
                            onclick="toggleViewAmend()">Amend Stock</button>
                </div>
                <div class="wrapper__find" id="wrapperFind">
                    <!--  input box for stock number -->
                    <div class="input__box input__box--medium open" id="stockNumBlock">
                        <!--   label for stock number -->
                        <label for="stockNum">Stock number: </label>
                        <!--  input field for stock number -->
                        <input type="text" id="stockNum" name="stockNum"
                               autofocus title="Enter a stock number of a stock item">
                    </div>

                    <!-- input box for description -->
                    <div class="input__box input__box--medium" id="descriptionBlock">
                        <!-- label for description -->
                        <label for="description">Description: </label>
                        <!-- input field for description -->
                        <textarea name="description" id="description"
                                  autofocus title="Enter a description of a stock item"></textarea>
                    </div>

                    <div class="search__button-box">
                        <button type="button" name="searchDescriptionStockNum" id="searchDescriptionStockNum" class="primary_btn primary_btn--large"
                                onclick="toggleDescriptionStockNum()">description</button>
                        <button type="button" name="searchStockItem" id="searchStockItem" class="primary_btn"
                                onclick="searchStock()">search</button>
                    </div>
                </div>

                <!-- select box for stock item -->
                <div class="select__box open select__box--medium" id="selectStockItem">
                    <h3>List box of stock items</h3>
                    <!-- list box for stock item -->
                    <?php include 'listboxStockItem.php' ?>
                </div>

                <h2>Details of added item</h2>
                <!--                input box for stock id -->
                <div class="input__box">
                    <!--                    label for stock id -->
                    <label for="stockId">Stock Id: </label>
                    <!--                    input field for stock id -->
                    <input type="text" id="stockId" name="stockId" disabled
                           value="<?= htmlspecialchars($_SESSION['stockId'] ?? '') ?>">
                </div>

                <!--                input box for description -->
                <div class="input__box">
                    <!--                    label for description -->
                    <label for="description">Description: </label>
                    <!--                    input field for description -->
                    <textarea name="descriptionTxt" id="descriptionTxt"
                              autofocus title="Enter a description of a stock item" required disabled><?=
                        htmlspecialchars($_SESSION['description'] ?? '')
                        ?></textarea>
                </div>

                <!--                input box for quantity in stock -->
                <div class="input__box">
                    <!--                    label for quantity in stock -->
                    <label for="qtyInStock">Quantity in stock: </label>
                    <!--                    input field for quantity in stock -->
                    <input type="text" id="qtyInStock" name="qtyInStock"
                           title="Enter a quantity of a stock item" value="<?= htmlspecialchars($_SESSION['qtyInStock'] ?? '') ?>" required disabled>
                </div>

                <!--                input box for re-order level -->
                <div class="input__box">
                    <!--                    label for re-order level -->
                    <label for="reOrderLevel">Re-order level: </label>
                    <!--                    input field for re-order level -->
                    <input type="text" id="reOrderLevel" name="reOrderLevel"
                           title="Enter re-order level of a stock item" value="<?= htmlspecialchars($_SESSION['reOrderLevel'] ?? '') ?>" required disabled>
                </div>

                <!--                input box for re-order quantity -->
                <div class="input__box">
                    <!--                    level for re-rder quantity -->
                    <label for="reOrderQty">Re-order quantity: </label>
                    <!--                    input field for re-order quantity -->
                    <input type="text" id="reOrderQty" name="reOrderQty"
                           title="Enter re-order quantity of a stock item" value="<?= htmlspecialchars($_SESSION['reOrderQty'] ?? '') ?>" required disabled>
                </div>

                <!--                input box for cost price -->
                <div class="input__box">
                    <!--                    label for cost price -->
                    <label for="costPrice">Cost price: </label>
                    <!--                    input field for cost price -->
                    <input type="text" id="costPrice" name="costPrice"
                           title="Enter the cost of a stock item" value="<?= htmlspecialchars($_SESSION['costPrice'] ?? '') ?>" required disabled>
                </div>

                <!--                input box for retail price -->
                <div class="input__box">
                    <!--                    label for retail price -->
                    <label for="retailPrice">Retail price: </label>
                    <!--                    input field for retail price -->
                    <input type="text" id="retailPrice" name="retailPrice"
                           title="Enter the retail price of a stock item" value="<?= htmlspecialchars($_SESSION['retailPrice'] ?? '') ?>" required disabled>
                </div>

                <!--                select box for supplier name -->
                <div class="select__box">
                    <!--                    label for supplier name -->
                    <label for="supplierName">Supplier name: </label>
                    <!--                    list box for supplier name -->
                    <?php include 'listboxSupplier.php' ?>
                </div>

                <!--  button box -->
                <div class="button__box">
                    <!--  input field for submit -->
                    <input type="submit" name="submitAmendStock" id="submitAmendStock" value="Amend">
                </div>
            </form>
        </div>
    </div>
    <?php include 'navbar_stock.php' ?>
</main>

<script>
    const stockId = document.getElementById("stockId");
    const descriptionTxt = document.getElementById("descriptionTxt");
    const qtyInStock = document.getElementById("qtyInStock");
    const reOrderLevel = document.getElementById("reOrderLevel");
    const reOrderQty = document.getElementById("reOrderQty");
    const costPrice = document.getElementById("costPrice");
    const retailPrice = document.getElementById("retailPrice");
    const supplierName = document.getElementById('supplierName');

    supplierName.disabled = true;

    const stockForm = document.getElementById('stockForm');
    const submitAmendStock = document.getElementById("submitAmendStock");
    const amendViewStockBtn = document.getElementById("amendViewStockBtn");

    submitAmendStock.style.display = stockForm.checkValidity() && !descriptionTxt.disabled ? 'block' : 'none';

    stockForm.addEventListener('input', (e) => {
        submitAmendStock.style.display = stockForm.checkValidity() && !descriptionTxt.disabled ? 'block' : 'none';
    })

    stockForm.addEventListener('submit', (e) => {
        let stockQtyCheck = parseInt(qtyInStock.value);
        if (isNaN(stockQtyCheck)) {
            alert("Enter the quantity as an integer");
            e.preventDefault();
        }

        let orderLevelCheck = parseInt(reOrderLevel.value);
        if (isNaN(orderLevelCheck)) {
            alert("Enter the order level as an integer");
            e.preventDefault();
        }

        let orderQtyCheck = parseInt(reOrderQty.value);
        if (isNaN(orderQtyCheck)) {
            alert("Enter the order quantity as an integer");
            e.preventDefault();
        }

        let supplier = document.getElementById("supplierName");

        if (supplier.value === "") {
            alert("Please select a supplier");
            e.preventDefault();
        }

        let confAmend = confirm("Do you confirm the amendment?");

        if (!confAmend) {
            e.preventDefault();
        } else {
            // disable the fields before sending the result in order to get them
            stockId.disabled = false;
            descriptionTxt.disabled = false;
            qtyInStock.disabled = false;
            reOrderLevel.disabled = false;
            reOrderQty.disabled = false;
            costPrice.disabled = false;
            retailPrice.disabled = false;
            supplierName.disabled = false;
        }
    });

    // function to amendView
    function toggleViewAmend() {
        if (amendViewStockBtn.innerHTML == "Amend Stock") {
            // change the value to false
            amendViewStockBtn.innerHTML = "View Stock";
            descriptionTxt.disabled = false;
            qtyInStock.disabled = false;
            reOrderLevel.disabled = false;
            reOrderQty.disabled = false;
            costPrice.disabled = false;
            retailPrice.disabled = false;
            supplierName.disabled = false;
            submitAmendStock.style.display = 'block';
        } else {
            // change the values to true
            amendViewStockBtn.innerHTML = "Amend Stock";
            descriptionTxt.disabled = true;
            qtyInStock.disabled = true;
            reOrderLevel.disabled = true;
            reOrderQty.disabled = true;
            costPrice.disabled = true;
            retailPrice.disabled = true;
            supplierName.disabled = true;
            submitAmendStock.style.display = 'none';
        }
    }

    function toggleFindOptions() {
        const wrapperBox = document.getElementById("wrapperFind");
        wrapperBox.classList.toggle('open');

        const selectStockItem = document.getElementById("selectStockItem");
        if (!wrapperBox.classList.contains('open')) {
            selectStockItem.classList.add('open');
        } else {
            selectStockItem.classList.remove('open');
        }
    }

    // creating constant indicating the displayForm
    const displayStockForm = document.getElementById("displayStockForm");
    // creating display function
    function displayDetails() {
        displayStockForm.choice.value = 'displayListbox';
        const selectStockItem = document.getElementById('stockItem')
        let value = selectStockItem.options[selectStockItem.selectedIndex].value;
        displayStockForm.stockItemId.value = value;
        displayStockForm.submit();
    }

    const stockNum = document.getElementById("stockNum")
    const description = document.getElementById("description");
    // creating search function
    function searchStock() {
        displayStockForm.choice.value = 'searchStockItem'
        let stockNumValue = stockNum.value;
        let descriptionValue = description.value;
        displayStockForm.stockNum.value = stockNumValue;
        displayStockForm.description.value = descriptionValue;
        displayStockForm.submit();
    }

    const stockNumBlock = document.getElementById("stockNumBlock")
    const descriptionBlock = document.getElementById("descriptionBlock")
    //     create function to toggle between description and stockNum
    function toggleDescriptionStockNum() {
        // creating variable searchDescriptionStockNum
        const searchDescriptionStockNum = document.getElementById("searchDescriptionStockNum");

        if (searchDescriptionStockNum.innerHTML == 'description') {
            searchDescriptionStockNum.innerHTML = 'stock number'
            descriptionBlock.classList.add("open");
            stockNumBlock.classList.remove("open");
            stockNum.value = '';
        } else if (searchDescriptionStockNum.innerHTML == 'stock number') {
            searchDescriptionStockNum.innerHTML = 'description'
            stockNumBlock.classList.add("open");
            descriptionBlock.classList.remove("open");
            description.value = '';
        }
    }

    <?php
    if (isset($_SESSION['stockId'])) {
    ?>
    const submitDeleteStock = document.getElementById("submitDeleteStock");
    submitDeleteStock.classList.add('open');
    <?php
    } else {
    ?>
    submitDeleteStock.classList.remove('open')
    <?php } ?>

</script>
</body>
</html>