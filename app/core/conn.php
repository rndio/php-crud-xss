<?php

const DB_HOST = 'localhost';
const DB_NAME = 'php_crud';
const DB_PORT = 3306;
const DB_USER = 'root';
const DB_PASS = '';

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}
