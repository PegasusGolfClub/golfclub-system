<?php
// Simple router: Get the current 'page' or default to 'dashboard'
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
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
    </style>
</head>
<body>

    <!-- Simple Navigation Sidebar -->
    <div class="sidebar">
        <h2>🏌️ Golf Club Admin</h2>
        <a href="?page=dashboard" class="<?php echo $page == 'dashboard' ? 'active' : ''; ?>">Dashboard</a>
        <a href="?page=members" class="<?php echo $page == 'members' ? 'active' : ''; ?>">Manage Members</a>
        <a href="?page=tees" class="<?php echo $page == 'tees' ? 'active' : ''; ?>">Tee Times</a>
        <a href="?page=settings" class="<?php echo $page == 'settings' ? 'active' : ''; ?>">Club Settings</a>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="card">
            <?php 
                // Display content based on the navigation link clicked
                switch($page) 
                    {
                        case 'members':
                            echo "<h1>Member Directory</h1><p>View and edit club memberships.</p>";
                            break;
                        case 'tees':
                            echo "<h1>Tee Time Bookings</h1><p>Manage today's schedule on the course.</p>";
                            break;
                        case 'settings':
                            echo "<h1>Club Settings</h1><p>Configure course hours and pricing.</p>";
                            break;
                        default:
                            echo "<h1>Welcome back, Admin</h1><p>Total Rounds Today: 12</p>";
                    }
            ?>
        </div>
    </div>
    
</body>
</html>
