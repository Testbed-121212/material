<?php
    // Check if the table "coffee" exists
    $result = $conn->query("SHOW TABLES LIKE 'coffee'");

    if ($result->num_rows == 0) {
    // Table does not exist, so create it
    $sql = "CREATE TABLE coffee (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        origin VARCHAR(255) NOT NULL,
        roast_level INT(1) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        //echo "Table created successfully.\n";
    } else {
        //echo "Error creating table: " . $conn->error . "\n";
    }

    // Insert some test data
    $sql = "INSERT INTO coffee (name, origin, roast_level)
    VALUES
        ('Ethiopian Yirgacheffe', 'Ethiopia', 5),
        ('Colombian Supremo', 'Colombia', 2),
        ('Sumatra Mandheling', 'Indonesia', 5),
        ('Mexican Altura', 'Mexico', 2),
        ('Guatemalan Antigua', 'Guatemala', 3)";

    if ($conn->query($sql) === TRUE) {
        //echo "Test data inserted successfully.\n";
    } else {
        //echo "Error inserting test data: " . $conn->error . "\n";
    }
    } else {
        //echo "Table already exists.\n";
    }

    // Check if the table "users" exists
    $result = $conn->query("SHOW TABLES LIKE 'users'");

    if ($result->num_rows == 0) {
    // Table does not exist, so create it
    $sql = "CREATE TABLE users (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        //echo "Table created successfully.\n";
    } else {
        //echo "Error creating table: " . $conn->error . "\n";
    }

    // Insert some test data
    $sql = "INSERT INTO users (username, password)
    VALUES
        ('admin', 'iLikePasta'),
        ('jeremy', 'jeremyspassword')";

    if ($conn->query($sql) === TRUE) {
        echo "Test data inserted successfully.\n";
    } else {
        //echo "Error inserting test data: " . $conn->error . "\n";
    }
    } else {
        //echo "Table already exists.\n";
    }