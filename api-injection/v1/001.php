<?php
  header("Content-Type: application/json");

  if (isset($_GET['roast'])){
    $roast = $_GET['roast'];
    include_once('../db.php');

    $sql = "SELECT * FROM coffee WHERE roast_level = $roast";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $coffee_data = array();
        while($row = $result->fetch_assoc()) {
            $coffee_data[] = $row;
        }
        http_response_code(200);
        echo json_encode($coffee_data);
    } else {
        http_response_code(401);
        echo json_encode('No coffee found!');
    }
    $conn->close();
  }
