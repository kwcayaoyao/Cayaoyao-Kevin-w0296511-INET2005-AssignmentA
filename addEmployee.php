<?php
require('isLoggedIn.php');
checkIfLoggedIn();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add new employees</title>

</head>
<body>

<?php
    if(!empty($_POST['firstName']) && !empty($_POST['lastName'] ) && !empty($_POST['birthDate'] ) && !empty($_POST['gender'] ) && !empty($_POST['lastName'] ))
    {
        $conn = mysqli_connect("localhost", "root", "inet2005", "employees");
        if(!$conn)
        {
            die("Unable to connect to database: " . mysqli_connect_error());
        }

        $rowSQL = mysqli_query($conn,"SELECT MAX(emp_no) AS max FROM employees;" );
        $num = mysqli_fetch_array( $rowSQL );
        $latestNumber = $num['max'];

        $sql = "INSERT INTO employees (emp_no, birth_date, first_name, last_name, gender, hire_date) VALUES ('";
        $sql .= ($latestNumber)+1;
        $sql .= "','";
        $sql .= $_POST['birthDate'];
        $sql .= "','";
        $sql .= $_POST['firstName'];
        $sql .= "','";
        $sql .= $_POST['lastName'];
        $sql .= "','";
        $sql .= $_POST['gender'];
        $sql .= "','";
        $sql .= $_POST['hireDate'];
        $sql .= "');";

        $result = mysqli_query($conn, $sql);

        if(!$result)
        {
            die("Unable to insert record: " . mysqli_error($conn));
        }
        else
        {
            echo "<h2>Successfully added " . mysqli_affected_rows($conn)." record(s)</h2>";
        }

        mysqli_close($conn);

    }

?>

<form id="back" name="back" method="post" action="employees.php">
    <p><input type="submit" id="submit" value="Back" /></p>
</form>

</body>
</html>