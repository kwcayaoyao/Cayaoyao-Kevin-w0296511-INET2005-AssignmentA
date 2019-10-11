<?php

require('isLoggedIn.php');
checkIfLoggedIn();

$conn = mysqli_connect("localhost", "root", "inet2005", "employees");
if(!$conn)
{
    die("Unable to connect to database: " . mysqli_connect_error());
}

$sql = "UPDATE employees SET first_name='";
$sql .=$_POST['firstName'];
$sql .="',";
$sql .="last_name='";
$sql .=$_POST['lastName'];
$sql .="',";
$sql .="birth_date='";
$sql .=$_POST['birthDate'];
$sql .="',";
$sql .="gender='";
$sql .=$_POST['gender'];
$sql .="',";
$sql .="hire_date='";
$sql .=$_POST['hireDate'];
$sql .="' WHERE emp_no='";
$sql .=$_POST['ID'];
$sql .="';";

$result = mysqli_query($conn, $sql);

if(!$result)
{
    die("Unable to update record: " . mysqli_error($conn));
}
else
{
    echo "<h2>Successfully updated " . mysqli_affected_rows($conn)." record(s)</h2>";
}



mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Validation</title>
</head>
<body>
<form id="back" name="back" method="post" action="employees.php">
    <p><input type="submit" id="submit" value="Back" /></p>
</form>
</body>
</html>

