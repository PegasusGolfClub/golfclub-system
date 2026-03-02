<?php
// Name: Tymofii Mazurenko
// Student ID: C00325393
// Date: 28/02/2026
// Purpose: To complete the group project

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

function active($p, $page){
    return $p === $page ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Golf Club Admin</title>

    <style>
        body
        {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            margin: 0;
            display: flex;
            height: 100vh;
            background: #f4f7f6;
        }
        /* Sidebar Styling */
        .sidebar
        {
            width: 250px;
            background: #02674a; /*#1b4332*/
            color: white;
            display: flex;
            flex-direction: column;
        }
        .sidebar h2
        {
            padding: 20px;
            font-size: 1.2rem;
            border-bottom: 1px solid rgb(62, 152, 112); /*#02674a*/
        }
        .sidebar a
        {
            padding: 15px 20px;
            color: #5ed086;
            text-decoration: none;
            transition: 0.3s;
        }
        .sidebar a:hover, .active
        {
            background: #1a4f36; /*#2d6a4f;*/
            color: white;
        }
        /* Content Area */
        .main-content
        {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }
        .card
        {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        /* Target only the form with the "main-form" class */
        .main-form {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            padding: 30px;
            margin: 20px auto;
        }

        /* Target the button container inside THIS specific form */
        .main-form .button {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

    </style>
</head>

<body>

<!-- Navigation Sidebar -->
<div class="sidebar">
    <h2>🏌️ Golf Club Admin</h2>
    <a href="?page=staff" class="<?php echo $page == 'staff' ? 'active' : ''; ?>">Staff</a>
    <a href="?page=players" class="<?php echo $page == 'players' ? 'active' : ''; ?>">Players</a>
    <a href="?page=competitions" class="<?php echo $page == 'competitions' ? 'active' : ''; ?>">Competitions</a>
    <a href="?page=payments" class="<?php echo $page == 'payments' ? 'active' : ''; ?>">Payments</a>
    <a href="addStockItem.php" class="<?php echo $page == 'stock' ? 'active' : ''; ?>">Stock</a>
</div>

</body>
</html>