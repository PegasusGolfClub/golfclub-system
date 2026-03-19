<!--
Name: Andrii Shyiko
Date: 01/03/2026
Purpose: Completion of the project
Student ID: C00313127
-->
<?php 
    session_start();
include 'db.inc.php';

$sql = "UPDATE staff SET deleted = true WHERE ID = '$_POST[ID]'";
//alternatively, if you want to actually delete the record, not just set the flag.
//$sql = "delete from persons where personid = '$_POST[delid]'";

if (! mysqli_query($con, $sql))
{
    echo "Error " . mysqli_error($con);
}

// Set session variables
$_SESSION["personid"] = $_POST['delid'];
$_SESSION["firstname"] = $_POST['delfirstname'];
$_SESSION["lastname"] = $_POST['dellastname'];

mysqli_close($con);
?>

<script>
window.location = "DeleteStaff.php"
</script>