<?php

require('isLoggedIn.php');
checkIfLoggedIn();
require_once ('dbconn.php');

$conn = getDbConnection();

//get the original data for update


//$sql = "UPDATE employees SET first_name='";
//$sql .=$_POST['firstName'];
//$sql .="',";
//$sql .="last_name='";
//$sql .=$_POST['lastName'];
//$sql .="',";
//$sql .="birth_date='";
//$sql .=$_POST['birthDate'];
//$sql .="',";
//$sql .="gender='";
//$sql .=$_POST['gender'];
//$sql .="',";
//$sql .="hire_date='";
//$sql .=$_POST['hireDate'];
//$sql .="' WHERE emp_no='";
//$sql .=$_POST['ID'];
//$sql .="';";
//
//$result = mysqli_query($conn, $sql);

$empno = $_POST['ID'];
$birthdate = $_POST['birthDate'];
$firstname = $_POST['firstName'];
$lastname = $_POST['lastName'];
$gender = $_POST['gender'];
$hiredate = $_POST['hireDate'];

$command = "CALL EditEmployee(:empno,:birthdate,:firstname,:lastname,:gender,:hiredate);";
$stmt = $conn->prepare($command);
$stmt->bindParam(":empno", $empno, PDO::PARAM_INT);
$stmt->bindParam(":birthdate", $birthdate);
$stmt->bindParam(":firstname", $firstname);
$stmt->bindParam(":lastname", $lastname);
$stmt->bindParam(":gender", $gender);
$stmt->bindParam(":hiredate", $hiredate);

$result = $stmt->execute();

//$result = mysqli_query($conn, $sql);
if(!$result)
{
    die("Unable to update record: "); // . mysqli_error($conn));
}
else
{
    echo "<h2>Success! Record was updated.</h2>";
}

//if(!$result)
//{
//    die("Unable to update record: " . mysqli_error($conn));
//}
//else
//{
//    echo "<h2>Successfully updated " . mysqli_affected_rows($conn)." record(s)</h2>";
//}



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

