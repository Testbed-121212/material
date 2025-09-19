<?php
  header("Content-Type: application/json");

  $request = json_decode(file_get_contents('php://input'), true);
  $email = $request['email'];
  $password = $request['password'];

  function getRandomChars($len) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($characters), 0, $len);
  }

  function writeToFile($filename, $string) {
    $handle = fopen($filename, 'w');
    fwrite($handle, $string);
    fclose($handle);
  }

  if ($email == "admin" && $password == "ramirez") {
    http_response_code(200);

    $randomString = getRandomChars(3);
    $accessToken = $email . '-' . date('H:i:s') . '-' .$randomString;
    $accessToken = base64_encode($accessToken);
    writeToFile($email, $accessToken);
  
    $randomString2 = getRandomChars(3);
    $accessToken2 = 'jeremy' . '-' . date('H:i:s') . '-' .$randomString2;
    $accessToken2 = base64_encode($accessToken2);
    writeToFile('jeremy', $accessToken2);

    echo json_encode(array("message" => "You successfully logged in!", "token" => $accessToken));
  } else {
    http_response_code(401);
    echo json_encode(array("message" => "Invalid credentials"));
  }