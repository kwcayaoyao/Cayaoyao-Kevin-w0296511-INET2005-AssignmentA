<?php
    function getDbConnection()
    {
        $dsn = "mysql:hostname=localhost;dbname=employees";
        $conn = new PDO($dsn,"Kevin", "Password");

//        $conn = mysqli_connect("localhost", "Kevin", "Password", "employees");
//        if(!$conn)
//        {
//            die("Unable to connect to database: " . mysqli_connect_error());
//        }

        return $conn;
    }