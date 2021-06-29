<?php

require_once('config.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE {$db_name}";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully" . "<br>";
} else {
  echo "Error creating database: " . $conn->error. "<br>";
}

// sql to create table users
$sql_users_table = "CREATE TABLE IF NOT EXISTS users (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  password VARCHAR(30) NOT NULL,
  email VARCHAR(50)
  )";

// sql to create table files
$sql_files_table = "CREATE TABLE IF NOT EXISTS files (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  user_id INT(6) UNSIGNED NOT NULL
  )";  
  
  if ($conn->query($sql_users_table) === TRUE) {
    echo "Table users created successfully" . "<br>";
  } else {
    echo "Error creating table: " . $conn->error . "<br>";
  }

  if ($conn->query($sql_files_table) === TRUE) {
    echo "Table files created successfully" . "<br>";
  } else {
    echo "Error creating table: " . $conn->error . "<br>";
  }

$conn->close();

?>