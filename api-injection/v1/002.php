<?php
    header("Content-Type: application/json");

    // grab data
    $data = json_decode(file_get_contents('php://input'), true);
    $requestUsername = $data['username'];
    $requestPassword = $data['password'];

    if (isset($requestUsername) && isset($requestPassword)) {
        include_once('../db.php');

        $sql = "SELECT * FROM users WHERE username = '$requestUsername' AND password = '$requestPassword'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            http_response_code(200);
            $responseMessage = '<div class="alert alert-success" role="alert">You were logged in as: ' . $row['username'] . '</div>';
            echo json_encode($responseMessage);
        } else {
            http_response_code(401);
            echo json_encode('<div class="alert alert-danger" role="alert">Sorry, incorrect credentials</div>');
        }
        $conn->close();
    }
