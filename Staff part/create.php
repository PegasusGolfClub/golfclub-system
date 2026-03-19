<!--
Name: Andrii Shyiko
Date: 01/03/2026
Purpose: Completion of the project
Student ID: C00313127
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Process</title>
    <style>
        form
        {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%; /* Adapt form shape */
            max-width: 500px; /* Limit max width */
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            margin: auto;
            padding: 30px;
        }
        body 
        { 
            font-family: 'Segoe UI', Tahoma, sans-serif; 
            display: flex;
            justify-content: center;
            height: 80px;
            background: #f4f7f6; 
        }
        .button
        {
            justify-content: center; 
            height: 30px; 
            border-radius: 8px;
            width: 100px;
            border:3px solid rgb(86, 162, 86); 
        }
        .button:hover
        {
            background-color: rgb(118, 214, 118);
        }
        .button:active
        {
            background-color: goldenrod;
        }
    </style>
</head>
<body>
<?php
    include 'db.inc.php'; //connect to the database, include specified file
    date_default_timezone_set("UTC"); // set the default timezone for all date and time functions in a script

    // If 'managerStatus' is in POST, use its value; otherwise, use 0
    $managerStatus = $_POST['managerStatus'] ?? 0;

    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //echo "The details are being procesed...<br>";

    //prevent SQL injection by separating SQL from user data
    $stmt = mysqli_prepare($con, "INSERT INTO staff (firstName, surname, street, town, county, phoneNum, jobTitle, managerStatus, loginName, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    //treat data as data only, never as executable SQL
    mysqli_stmt_bind_param
    (
        $stmt,"sssssssiss", //all five values are strings
        $_POST['firstname'],
        $_POST['surname'],
        $_POST['street'],
        $_POST['town'],
        $_POST['county'],
        $_POST['phoneNum'],
        $_POST['jobTitle'],
        $managerStatus,
        $_POST['loginName'],
        $hashed_password
    );
     // Execute the prepared statement
    if (!mysqli_stmt_execute($stmt)) 
        {
            // If execution fails, throw an error
            die("An Error in the SQL Query: " . mysqli_stmt_error($stmt));
        }
    //echo "<br>A record has been added for " . $_POST['firstname'] . " " . $_POST['surname'];
    mysqli_close($con); // close connection to database

?>
    <form action = "AddStaff.php" method= "POST" > 
    
    <br>
        <input type="submit" value = "Return" class="button"/> <!--Return to the previous page-->
    </form>
</body>
</html>