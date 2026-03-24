<!-- initializing html document -->
<!--
Screen Name: Amend/View Stock Item
Name: Tymofii Mazurenko
Student ID: C00325393
Date: March 2026
Purpose: This screen allows the user to search for an existing stock item by stock number
or description, view its details, and amend the stock information. It retrieves stock data,
displays it in editable form fields, and performs client-side validation before submitting
updated data to the system for processing.
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

<!-- importing sidebar stock -->
<?php include 'sidebar_stock.php' ?>

<!-- Main Content Area -->
<main id="stock__item">
    <div class="main-content">
        <div class="card" id="cardDelete">
            <h2>Amend stock item</h2>
            <form action="stockItemDisplay.php" id="displayStockForm" method="post">
                <input type="hidden" name="stockNum">
                <input type="hidden" name="description">
            </form>
            <form action="amendStockItemSent.php" class="main-form" id="stockForm" method="post">
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

                <div id="display" class="display_error">There are no matches found</div>
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
                    <textarea name="descriptionTxt" id="descriptionTxt" placeholder="Enter a description (at least 4 characters)"
                              autofocus title="Enter a description of a stock item" required disabled><?=
                        htmlspecialchars($_SESSION['description'] ?? '')
                        ?></textarea>
                </div>

                <!--                input box for quantity in stock -->
                <div class="input__box">
                    <!--                    label for quantity in stock -->
                    <label for="qtyInStock">Quantity in stock: </label>
                    <!--                    input field for quantity in stock -->
                    <input type="number" id="qtyInStock" name="qtyInStock" min="0" pattern="[0-9]+" placeholder="Enter a quantity of a stock item (must be integer)"
                           title="Enter a quantity of a stock item" value="<?= htmlspecialchars($_SESSION['qtyInStock'] ?? '') ?>" required disabled>
                </div>

                <!--                input box for re-order level -->
                <div class="input__box">
                    <!--                    label for re-order level -->
                    <label for="reOrderLevel">Re-order level: </label>
                    <!--                    input field for re-order level -->
                    <input type="number" id="reOrderLevel" name="reOrderLevel" min="0" pattern="[0-9]+" placeholder="Enter a re-order level (must be integer)"
                           title="Enter re-order level of a stock item" value="<?= htmlspecialchars($_SESSION['reOrderLevel'] ?? '') ?>" required disabled>
                </div>

                <!--                input box for re-order quantity -->
                <div class="input__box">
                    <!--                    level for re-rder quantity -->
                    <label for="reOrderQty">Re-order quantity: </label>
                    <!--                    input field for re-order quantity -->
                    <input type="number" id="reOrderQty" name="reOrderQty" min="0" pattern="[0-9]+" placeholder="Enter re-order quantity (must be integer)"
                           title="Enter re-order quantity of a stock item" value="<?= htmlspecialchars($_SESSION['reOrderQty'] ?? '') ?>" required disabled>
                </div>

                <!--                input box for cost price -->
                <div class="input__box">
                    <!--                    label for cost price -->
                    <label for="costPrice">Cost price: </label>
                    <!--                    input field for cost price -->
                    <input type="number" id="costPrice" name="costPrice" step="0.01" min="0" pattern="[0-9]+" placeholder="Enter cost price (must be decimal)"
                           title="Enter the cost of a stock item" value="<?= htmlspecialchars($_SESSION['costPrice'] ?? '') ?>" required disabled>
                </div>

                <!--                input box for retail price -->
                <div class="input__box">
                    <!--                    label for retail price -->
                    <label for="retailPrice">Retail price: </label>
                    <!--                    input field for retail price -->
                    <input type="number" id="retailPrice" name="retailPrice" step="0.01" min="0" pattern="[0-9]+" placeholder="Enter retail price (must be decimal)"
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

<!-- scripting -->
<script>
// submit amend stock button
    const submitAmendStock = document.getElementById("submitAmendStock");
    // if session is stockId then select it in listbox
    <?php if (isset($_SESSION['stockId'])) { ?>
    let options = document.querySelectorAll('#stockItem option');
    // find the stock in listbox
    options.forEach(opt => {
        if (opt.value.startsWith(<?php echo $_SESSION['stockId']?> + "|")) {
            opt.selected = true;
        }
    });

    // hide the message
    document.getElementById('display').style.display = "none";
    <?php
//  unset session variables
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
    } else { ?>
//  display the message
    document.getElementById('display').style.display = "block";
    <?php }; ?>

//  get the information about the form
    const stockId = document.getElementById("stockId");
    const descriptionTxt = document.getElementById("descriptionTxt");
    const qtyInStock = document.getElementById("qtyInStock");
    const reOrderLevel = document.getElementById("reOrderLevel");
    const reOrderQty = document.getElementById("reOrderQty");
    const supplierName = document.getElementById('supplierName');
    const costPrice = document.getElementById("costPrice");
    const retailPrice = document.getElementById("retailPrice");

    // supplier name is disabled
    supplierName.disabled = true;

    // stock form constant
    const stockForm = document.getElementById('stockForm');
    const amendViewStockBtn = document.getElementById("amendViewStockBtn");

    // submit amend stock style and is it valid
    submitAmendStock.style.display = stockForm.checkValidity() && !descriptionTxt.disabled ? 'block' : 'none';

    // input check validity
    stockForm.addEventListener('input', (e) => {
        submitAmendStock.style.display = stockForm.checkValidity() && !descriptionTxt.disabled ? 'block' : 'none';
    })

    // submit the form
    stockForm.addEventListener('submit', (e) => {
        let pass = true;

        //  checks if description is empty
        if (descriptionTxt.value.length < 4){
            alert("Description has to be more than 4 characters");
            pass = false;
            e.preventDefault()
        }

        // check if the description is a valid text
        if (!/[a-zA-Z]/.test(descriptionTxt.value)){
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

            if (!confirmSubmit) {
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

    // toggle the find input
    function toggleFindOptions() {
        // remove open class if there is one, otherwise add it
        const wrapperBox = document.getElementById("wrapperFind");
        wrapperBox.classList.toggle('open');

        // remove open class if there is one, otherwise add it
        const selectStockItem = document.getElementById("selectStockItem");
        selectStockItem.classList.toggle('open')
    }

    // creating constant indicating the displayForm
    const displayStockForm = document.getElementById("displayStockForm");
    // creating display function
    function displayDetails() {
        const selectStockItem = document.getElementById('stockItem')
        // the value from the listbox
        let value = selectStockItem.options[selectStockItem.selectedIndex].value;
        let result = value.split('|');

        // variables with listbox information
        stockId.value = result[0];
        descriptionTxt.value = result[1];
        qtyInStock.value = result[2];
        reOrderLevel.value = result[3];
        reOrderQty.value = result[4];
        costPrice.value = result[5];
        retailPrice.value = result[6];
        let supValue = [result[10], result[7]].join("|");
        document.querySelector(`#supplierName option[value="${supValue}"]`).selected = true;

        // hide the message
        document.getElementById('display').style.display = "none";
    }

    // stock num form constant
    const stockNum = document.getElementById("stockNum")
    const description = document.getElementById("description");
    // creating search function
    function searchStock() {
        let stockNumValue = stockNum.value;
        let descriptionValue = description.value;
        displayStockForm.stockNum.value = stockNumValue;
        displayStockForm.description.value = descriptionValue;

        // check if the number is valid
        let stockInt = parseInt(stockNum.value);
        if (isNaN(stockInt) && descriptionValue === "") {
            alert("The stock id is not a number");
            return;
        }

        // submit the form
        displayStockForm.submit();
    }

    const stockNumBlock = document.getElementById("stockNumBlock")
    const descriptionBlock = document.getElementById("descriptionBlock")
    //     create function to toggle between description and stockNum
    function toggleDescriptionStockNum() {
        // creating variable searchDescriptionStockNum
        const searchDescriptionStockNum = document.getElementById("searchDescriptionStockNum");

        // switch to description when clicking the button
        if (searchDescriptionStockNum.innerHTML == 'description') {
            searchDescriptionStockNum.innerHTML = 'stock number'
            descriptionBlock.classList.add("open");
            stockNumBlock.classList.remove("open");
            stockNum.value = '';
        // switching to stock number when clicking the button
        } else if (searchDescriptionStockNum.innerHTML == 'stock number') {
            searchDescriptionStockNum.innerHTML = 'description'
            stockNumBlock.classList.add("open");
            descriptionBlock.classList.remove("open");
            description.value = '';
        }
    }

</script>
</body>
</html>