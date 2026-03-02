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
            <h2>Delete stock item</h2>
            <form action="deleteStockItemDisplay.php" id="displayStockForm" method="post">
                <input type="hidden" name="choice">
                <input type="hidden" name="stockItemId">
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
                    <!-- creating confirmation details section -->
                    <div class="confirmation__details">
                        <?php
                        if (isset($_SESSION['stockId'])) {
                            ?>
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
                                    <td class="cnf-i-cell"><?= htmlspecialchars($_SESSION['stockId'] ?? '') ?></td>
                                    <td class="cnf-i-cell"><?= htmlspecialchars($_SESSION['description'] ?? '') ?></td>
                                    <td class="cnf-i-cell"><?= htmlspecialchars($_SESSION['qtyInStock'] ?? '') ?></td>
                                    <td class="cnf-i-cell"><?= htmlspecialchars($_SESSION['reOrderLevel'] ?? '') ?></td>
                                    <td class="cnf-i-cell"><?= htmlspecialchars($_SESSION['reOrderQty'] ?? '') ?></td>
                                    <td class="cnf-i-cell"><?= htmlspecialchars($_SESSION['costPrice'] ?? '') ?></td>
                                    <td class="cnf-i-cell"><?= htmlspecialchars($_SESSION['retailPrice'] ?? '') ?></td>
                                    <td class="cnf-i-cell"><?= htmlspecialchars($_SESSION['supplierName'] ?? '') ?></td>
                                    <td class="cnf-i-cell"><?= htmlspecialchars($_SESSION['stockNumOrder'] ?? '') ?></td>
                                    <td class="cnf-i-cell"><?= htmlspecialchars($_SESSION['delivered'] ?? '') ?></td>
                                </tr>
                            </table>
                            <?php
                        } else {
                            ?>
                            <p>No matches found or more than one result with these details exist</p>
                            <?php
                        }
                        ?>

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

    const stockForm = document.getElementById('stockForm');

    stockForm.addEventListener('submit', (e) => {
        const qtyInStock = <?= isset($_SESSION['qtyInStock']) ? (int)$_SESSION['qtyInStock'] : 0 ?>;

        const isOnOrder = <?=
                (isset($_SESSION['stockNumOrder'], $_SESSION['stockId'], $_SESSION['delivered'])
                        && $_SESSION['stockNumOrder'] == $_SESSION['stockId']
                        && !$_SESSION['delivered'])
                        ? 'true'
                        : 'false'
                ?>;

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
        displayStockForm.choice.value = 'displayListbox';
        const selectStockItem = document.getElementById('stockItem')
        let value = selectStockItem.options[selectStockItem.selectedIndex].value;
        displayStockForm.stockItemId.value = value;
        displayStockForm.submit();
    }

    const stockNum = document.getElementById("stockNum")
    const description = document.getElementById("description")
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