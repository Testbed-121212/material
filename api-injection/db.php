<?php
  $servername = "db";
  $username = "apiInjection";
  $password = "iAmAWeakPassword";
  $dbname = "api_injection";
  $port = 3306;

  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname, $port);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
