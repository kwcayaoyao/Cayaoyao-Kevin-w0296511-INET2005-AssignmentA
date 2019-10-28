<?php
require('isLoggedIn.php');
checkIfLoggedIn();

include_once('dbconn.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete employees</title>
</head>
<body>
<?php
if( isset($_GET['del']) )
{
    $conn = getDbConnection();

    $id = $_GET['del'];


    $sql = "DELETE FROM employees WHERE emp_no = $id";

    $stmt = $conn->prepare($sql);

    $result = $stmt->execute();

    if($result){
        echo "<h2>Successfully deleted record</h2>";
    } else {
        echo "Unable to insert record";
    }

//    $sql = "DELETE FROM employees WHERE emp_no = ";
//    $sql .= $id;
//    $sql .= ";";
//
//    $result = mysqli_query($conn, $sql);
//    if(!$result)
//    {
//        die("Unable to delete record: " . mysqli_error($conn));
//    }
//    else
//    {
//        echo "<h2>Successfully deleted " . mysqli_affected_rows($conn)." record(s)</h2>";
//    }
//
//    mysqli_close($conn);
}

?>
<form id="delete" name="delete" method="post" action="employees.php">
    <p><input type="submit" id="submit" value="Back" /></p>
</form>
</body>
</html>
