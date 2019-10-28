<?php
require_once ('dbconn.php');
require('isLoggedIn.php');
checkIfLoggedIn();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
    <style>
        table, th, tr, td { border: solid 2px black;}
        li { list-style-type: none; display: inline; padding: 10px; text-align: center;}
        li:hover { background-color: yellow; }

    </style>
</head>
<body>
<form action="<?php $_SERVER['PHP_SELF'] ?>"  method="post" name="searchName">
    <p>Search by First or Last Name:
        <input name="nameInput" type="text" value="<?php echo $searchTarget ?>">
    </p>
    <p>
        <input name="submit" type="submit" value="Search">
    </p>
</form>

<form action="addEmp.html"  method="post" name="addEmp">
    <p><input name="" type="submit" value="Add Employee"></p>
</form>

<table>
    <thead>
    <th>Emp. Number</th>
    <th>Birth Date</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Gender</th>
    <th>Hire Date</th>
    </thead>
    <tbody>
    <?php
    $conn = mysqli_connect("kevincayaoyao.dev", "Kevin", "Password", "employees");
    if(!$conn)
    {
        die("Unable to connect to database: " . mysqli_connect_error());
    }
    $searchTarget = $_POST['nameInput'];

    $res = mysqli_query($conn,"SELECT count(*) FROM employees;");

    $rw = mysqli_fetch_array($res);

    if( !(isset($_GET['page'])) )
        $start = $rw[1] + 25;
    else
        $start = $rw[1] + ($_GET['page'] * 25);

    $result = mysqli_query($conn,"SELECT * FROM employees WHERE first_name LIKE '%$searchTarget%' OR last_name LIKE '%$searchTarget%' LIMIT $start,25");

    if(!$result)
    {
        die("Could not retrieve records from database: " . mysqli_error($conn));
    }

    while($row = mysqli_fetch_assoc($result)):
        ?>
        <tr>
            <td><?php echo $row['emp_no'] ?></td>
            <td><?php echo $row['birth_date'] ?></td>
            <td><?php echo $row['first_name'] ?></td>
            <td><?php echo $row['last_name'] ?></td>
            <td><?php echo $row['gender'] ?></td>
            <td><?php echo $row['hire_date'] ?></td>
            <?php echo "<td><a href='editEmployee.php?edit=$row[emp_no]'>edit</a></td>
                <td><a onClick=\";javascript: return confirm('Please confirm deletion');\" href='delete.php?del=$row[emp_no]'>delete</a></td>";?>
        </tr>

    <?php

    endwhile;

    mysqli_close($conn);
    ?>
    </tbody>
</table>

<ul>
    <li ><a href = "employees.php?page=<?php
        if(isset($_GET['page']) && ($_GET['page']) > 0) {
            $next = $_GET['page'] - 1;
        }else {
            $next = 0;
        }
        echo $next; ?>">previous</a></li >
    <li><a href="employees.php?page=0">1</a></li>
    <li><a href="employees.php" onclick="var page=prompt('Jump to page: (1-12001)', 1); if(page != null) href='employees.php?page='+(page - 1)+''">Jump to Page</a></li>
    <li><a href="employees.php?page=12000">12001</a></li>
    <li><a href="employees.php?page=<?php
        if(isset($_GET['page'])) {
            $next = $_GET['page'] + 1;
        }else {
            $next = 2;
        }
        echo $next; ?>">next</a>
    </li>
</ul>

<form name="LogoutForm" action="logOut.php" method="post">
    <input type="submit" name="logoutButton" value="Log Out" />
</form>
</body>
</html>