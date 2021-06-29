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

    if (empty($data['email']) || empty($data['password'])){
      $response['message'] = "some fields are wrong";
      $response['status'] = 400;
      echo json_encode($response);
      return;
    }



    // response
    $response = [];

    // get values
    $pass = $data['password'];
    $email = $data['email'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db_name);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


// sql statement for insert new user
$sql = "SELECT * FROM users WHERE email ='{$email}' AND password='{$pass}'";

// check out prevent to insert empty values
if ($email != "") {
    $result = $conn->query($sql);
  if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
      $response['id'] = $row['id'];
      $response['name'] = $row['name'];
      $response['email'] = $row['email'];
      $response['password'] = $row['password'];
    }

    $response['message'] = "user logged in successfully";
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