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

<!-- include the sidebar stock file -->
<?php include 'sidebar_stock.php' ?>

<!-- Main Content Area -->
<main id="stock__item">
    <div class="main-content">
        <div class="card" id="cardDelete">
            <h2>Delete stock item</h2>
            <form action="deleteStockItemDisplay.php" id="displayStockForm" method="post">
                <input type="hidden" name="stockNum">
                <input type="hidden" name="description">
            </form>
            <form action="deleteStockItemSent.php" class="main-form main-form--large" id="stockForm" method="post">
                <button type="button" name="findStockButton" id="findStockButton" class="primary_btn"
                        onclick="toggleFindOptions()">Find</button>
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

                <h2>Stock item details</h2>
                <div class="container__info">
                    <div id="display" class="display_error">There are no matches found</div>
                    <!-- creating confirmation details section -->
                    <input type="hidden" id="stockIdInput" name="stockIdCell">
                    <input type="hidden" id="descriptionInput" name="descriptionCell">
                    <input type="hidden" id="qtyInput" name="qtyInStockCell">
                    <input type="hidden" id="reOrderLevelInput" name="reOrderLevelCell">
                    <input type="hidden" id="reOrderQtyInput" name="reOrderQtyCell">
                    <input type="hidden" id="costPriceInput" name="costPriceCell">
                    <input type="hidden" id="retailPriceInput" name="retailPriceCell">
                    <input type="hidden" id="supplierNameInput" name="supplierNameCell">
                    <input type="hidden" id="orderNumInput" name="orderNumCell">
                    <input type="hidden" id="deliveredInput" name="deliveredCell">
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
                                <th class="cnf-h-cell">Order number</th>
                                <th class="cnf-h-cell">delivered</th>
                            </tr>
                            <tr>
                                <td class="cnf-i-cell" id="stockIdCell"><?php echo htmlspecialchars($_SESSION['stockId'] ?? '') ?></td>
                                <td class="cnf-i-cell" id="descriptionCell"><?php echo htmlspecialchars($_SESSION['description'] ?? '') ?></td>
                                <td class="cnf-i-cell" id="qtyInStockCell"><?php echo htmlspecialchars($_SESSION['qtyInStock'] ?? '') ?></td>
                                <td class="cnf-i-cell" id="reOrderLevelCell"><?php echo htmlspecialchars($_SESSION['reOrderLevel'] ?? '') ?></td>
                                <td class="cnf-i-cell" id="reOrderQtyCell"><?php echo htmlspecialchars($_SESSION['reOrderQty'] ?? '') ?></td>
                                <td class="cnf-i-cell" id="costPriceCell"><?php echo htmlspecialchars($_SESSION['costPrice'] ?? '') ?></td>
                                <td class="cnf-i-cell" id="retailPriceCell"><?php echo htmlspecialchars($_SESSION['retailPrice'] ?? '') ?></td>
                                <td class="cnf-i-cell" id="supplierNameCell"><?php echo htmlspecialchars($_SESSION['supplierName'] ?? '') ?></td>
                                <td class="cnf-i-cell" id="orderNumCell"><?php echo htmlspecialchars($_SESSION['orderNum'] ?? '') ?></td>
                                <td class="cnf-i-cell" id="deliveredCell"><?php echo htmlspecialchars($_SESSION['delivered'] ?? '') ?></td>
                            </tr>
                        </table>

                    </div>
                </div>

                <!--  button box -->
                <div class="button__box">
                    <!--  input field for submit -->
                    <input type="submit" name="submitDeleteStock" id="submitDeleteStock" value="Delete">
                </div>
            </form>
        </div>
    </div>
    <?php include 'navbar_stock.php' ?>
</main>

<script>
    const submitDeleteStock = document.getElementById("submitDeleteStock");
    const stockForm = document.getElementById('stockForm');

    <?php if (isset($_SESSION['stockId'])) { ?>
    let options = document.querySelectorAll('#stockItem option');
    options.forEach(opt => {
        if (opt.value.startsWith(<?php echo $_SESSION['stockId']?> + "|")) {
            opt.selected = true;
        }
    });

    if (document.getElementById('stockIdCell').innerHTML !== "") {
        submitDeleteStock.classList.add('open');
    } else {
        submitDeleteStock.classList.remove('open')
    }

    document.getElementById('display').style.display = "none";
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
    unset($_SESSION['orderNum']);
    unset($_SESSION['delivered']);

    } else { ?>
        document.getElementById('display').style.display = "block";
    <?php }; ?>

    const selectStockItem = document.getElementById('stockItem')

    stockForm.addEventListener('submit', (e) => {
        let qtyInStock = 0;
        let isOnOrder = 'false';

        let value = selectStockItem.options[selectStockItem.selectedIndex].value;
        let result = value.split('|');
        qtyInStock = result[2];

        let stockNumOrder = result[11];
        let stockId = result[0];
        let delivered = result[10];
        if (!isNaN(stockNumOrder) && !isNaN(stockId) && !isNaN(delivered)) {
            isOnOrder = stockNumOrder === stockId && !delivered;
        }

        let pass = true;

        if (qtyInStock > 0) {
            e.preventDefault();
            alert("You cannot delete a stock item that has more than zero quantity in stock.");
            pass = false;
        }

        if (isOnOrder) {
            e.preventDefault();
            alert("You cannot delete a stock item that is currently placed on order.");
            pass = false;
        }

        if (pass) {
            let confirmMess = confirm("Do you want to delete the form");

            if (!confirmMess) {
                e.preventDefault();
            } else {
                document.getElementById("stockIdInput").value =
                    document.getElementById("stockIdCell").textContent;

                document.getElementById("descriptionInput").value =
                    document.getElementById("descriptionCell").textContent;

                document.getElementById("qtyInput").value =
                    document.getElementById("qtyInStockCell").textContent;

                document.getElementById("reOrderLevelInput").value =
                    document.getElementById("reOrderLevelCell").textContent;

                document.getElementById("reOrderQtyInput").value =
                    document.getElementById("reOrderQtyCell").textContent;

                document.getElementById("costPriceInput").value =
                    document.getElementById("costPriceCell").textContent;

                document.getElementById("retailPriceInput").value =
                    document.getElementById("retailPriceCell").textContent;

                document.getElementById("supplierNameInput").value =
                    document.getElementById("supplierNameCell").textContent;

                document.getElementById("orderNumInput").value =
                    document.getElementById("orderNumCell").textContent;

                document.getElementById("deliveredInput").value =
                    document.getElementById("deliveredCell").textContent;
            }
        }
    });


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
        let value = selectStockItem.options[selectStockItem.selectedIndex].value;
        let result = value.split('|');

        document.getElementById("stockIdCell").innerHTML = result[0];
        document.getElementById("descriptionCell").innerHTML = result[1];
        document.getElementById("qtyInStockCell").innerHTML = result[2];
        document.getElementById("reOrderLevelCell").innerHTML = result[3];
        document.getElementById("reOrderQtyCell").innerHTML = result[4];
        document.getElementById("costPriceCell").innerHTML = result[5];
        document.getElementById("retailPriceCell").innerHTML = result[6];
        document.getElementById("supplierNameCell").innerHTML = result[7];
        document.getElementById("orderNumCell").innerHTML = result[8];
        document.getElementById("deliveredCell").innerHTML = result[9];

        if (!submitDeleteStock.classList.contains('open')) {
            submitDeleteStock.classList.add('open');
        }

        document.getElementById('display').style.display = "none";
    }

    const stockNum = document.getElementById("stockNum")
    const description = document.getElementById("description")
    // creating search function
    function searchStock() {
        let stockNumValue = stockNum.value;
        let descriptionValue = description.value;
        displayStockForm.stockNum.value = stockNumValue;
        displayStockForm.description.value = descriptionValue;

        let stockInt = parseInt(stockNum.value);
        if (isNaN(stockInt) && descriptionValue === "") {
            alert("The stock id is not a number");
            return;
        }

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

</script>
</body>
</html>