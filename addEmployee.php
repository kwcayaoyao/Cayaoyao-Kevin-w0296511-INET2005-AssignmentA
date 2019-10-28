<?php
require('isLoggedIn.php');
checkIfLoggedIn();
require_once ('dbconn.php')
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
        $conn = getDbConnection();

        $stmt1 = $conn->prepare("SELECT MAX(emp_no) AS max FROM employees;");
        $stmt1->execute();
//        $stmt = mysqli_query($conn,"SELECT MAX(emp_no) AS max FROM employees;" );
        $num = $stmt1->fetch(PDO::FETCH_ASSOC);
        $latestNumber = $num['max'];

        $empno = ($latestNumber)+1;
        $birthdate = $_POST['birthDate'];
        $firstname = $_POST['firstName'];
        $lastname = $_POST['lastName'];
        $gender = $_POST['gender'];
        $hiredate = $_POST['hireDate'];

        //$sql = "INSERT INTO actor (first_name, last_name) VALUES (?,?)"; //positional
        $sql = "INSERT INTO employees (emp_no, birth_date, first_name, last_name, gender, hire_date) VALUES (:empno,:birthdate,:firstname,:lastname,:gender,:hiredate);";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":empno", $empno);
        $stmt->bindParam(":birthdate", $birthdate);
        $stmt->bindParam(":firstname", $firstname);
        $stmt->bindParam(":lastname", $lastname);
        $stmt->bindParam(":gender", $gender);
        $stmt->bindParam(":hiredate", $hiredate);

        $result = $stmt->execute();

        if($result){
            echo "<h2>Success! Record was entered.</h2>";
            echo "<p>" . $stmt->rowCount() . "row(s) entered: </p>";
        } else {
            echo "Unable to insert record";
        }

//        $sql = "INSERT INTO employees (emp_no, birth_date, first_name, last_name, gender, hire_date) VALUES ('";
//        $sql .= ($latestNumber)+1;
//        $sql .= "','";
//        $sql .= $_POST['birthDate'];
//        $sql .= "','";
//        $sql .= $_POST['firstName'];
//        $sql .= "','";
//        $sql .= $_POST['lastName'];
//        $sql .= "','";
//        $sql .= $_POST['gender'];
//        $sql .= "','";
//        $sql .= $_POST['hireDate'];
//        $sql .= "');";
//
//        $result = mysqli_query($conn, $sql);
//
//        if(!$result)
//        {
//            die("Unable to insert record: " . mysqli_error($conn));
//        }
//        else
//        {
//            echo "<h2>Successfully added " . mysqli_affected_rows($conn)." record(s)</h2>";
//        }

//        mysqli_close($conn);

    }

?>

<form id="back" name="back" method="post" action="employees.php">
    <p><input type="submit" id="submit" value="Back" /></p>
</form>

</body>
</html>