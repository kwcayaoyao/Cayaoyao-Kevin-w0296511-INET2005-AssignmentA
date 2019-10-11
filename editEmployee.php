<?php
require('isLoggedIn.php');
checkIfLoggedIn();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update actors</title>
    <script src="validate.js" type="text/javascript"></script>
</head>
<body>
<?php
if( isset($_GET['edit']) )
{
    $conn = mysqli_connect("localhost", "root", "inet2005", "employees");
    if(!$conn)
    {
        die("Unable to connect to database: " . mysqli_connect_error());
    }

    $id = $_GET['edit'];

    $sql = "SELECT * FROM employees WHERE emp_no = ";
    $sql .=$id;
    $sql .=";";

    $result = mysqli_query($conn, $sql);
}

while($row = mysqli_fetch_assoc($result))
{
    echo "<form id='newForm' name='newForm' method='post' action='edit.php' onsubmit='return checkForm()'>";
    echo "<p><label>Birth Date: <input type='text' name='birthDate' id='birthDate' value='".$row['birth_date']."' onchange=\"checkDate(this,'Please enter a valid Date format (YYYY-MM-DD)')\"/></label></p>";
    echo "<p><label>First Name: <input type='text' name='firstName' id='firstName' value='".$row['first_name']."' onchange=\"checkName(this,'Please enter a Name format (Upper case on first letter)')\"/></label></p>";
    echo "<p><label>Last Name: <input type='text' name='lastName' id='lastName' value='".$row['last_name']."' onchange=\"checkName(this,'Please enter a Name format (Upper case on first letter)')\"/></label></p>";
    echo "<p><label>Gender: <input type='text' name='gender' id='gender' value='".$row['gender']."' onchange=\"checkGender(this,'Please enter a gender format (M/F)')\"/></label></p>";
    echo "<p><label>Hire Date: <input type='text' name='hireDate' id='hireDate' value='".$row['hire_date']."' onchange=\"checkDate(this,'Please enter a valid Date format (YYYY-MM-DD)')\"/></label></p>";
    echo "<p><input type='hidden' name='ID' id='ID' value='".$row['emp_no']."' /></p>";
    echo "<p><input type='submit' id='submit' value='submit' /></p>";
    echo "</form>";
}

?>

<form id="back" name="back" method="post" action="employees.php">
    <p><input type="submit" id="submit" value="Back" /></p>
</form>

<form name="LogoutForm" action="logOut.php" method="post">
    <input type="submit" name="logoutButton" value="Log Out" />
</form>
</body>
</html>
