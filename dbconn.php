<?php
    function getDbConnection()
    {
        $conn = mysqli_connect("localhost", "root", "inet2005", "employees");
        if(!$conn)
        {
            die("Unable to connect to database: " . mysqli_connect_error());
        }

        return $conn;
    }