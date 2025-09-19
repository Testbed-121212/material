<?php
  //header("Content-Type: application/json");
  include_once('../mdb.php');

  $db = $connection->api_injection;
  $collection = $db->coffee;

  var_dump($db);
  
  try {
    $cursor = $collection->find();
  } catch (Throwable $e) {
    echo $e->getMessage();
  }

  $dataArray = $cursor->toArray();
  

  echo 'ok';

  // iterate cursor to display title of documents
  foreach ($query as $item) {
    var_dump($item);
  }

  // var_dump($collection);

  // $itemsArray = array();

  // foreach ($items as $item) {
  //   array_push($itemsArray, $item);
  // }

  //http_response_code(200);
  //echo json_encode($itemsArray);
