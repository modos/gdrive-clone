<?php

require_once('config.php');\


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, OPTIONS, PATCH, DELETE');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Authorization, Content-Type, x-xsrf-token, x_csrftoken, Cache-Control, X-Requested-With');

    // takes raw data from the request
    $json = file_get_contents('php://input');

    // converts sent data into a PHP array
    $data = json_decode($json, true);

    if (empty($data['name']) || empty($data['email']) || empty($data['password'])){
      $response['message'] = "some fields are wrong";
      $response['status'] = 400;
      echo json_encode($response);
      return;
    }

    // response
    $response = [];

    // get values
    $name = $data['name'];
    $pass = $data['password'];
    $email = $data['email'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db_name);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


// sql statement for insert new user
$sql = "INSERT INTO users (name, password, email)
VALUES ('{$name}', '{$pass}', '{$email}')";

// check out prevent to insert empty values
if ($name != "") {

  if ($conn->query($sql) === TRUE) {
    $response['message'] = "user created successfully";
    $response['status'] = 200;
    echo json_encode($response);
  } else {
    $response['message'] = "some fields are wrong";
    $response['status'] = 400;
    echo json_encode($response);
  }
}



$conn->close();
?>