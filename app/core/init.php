<?php

const BASE_DIR = __DIR__ . '/../../';
include_once(BASE_DIR . 'app/core/conn.php');

session_start();
if (!isset($_SESSION['login']) && urldecode($_SERVER['REQUEST_URI']) != '/login.php') {
  $_SESSION['error'] = 'Anda harus login terlebih dahulu!';
  header("Location: login.php");
  exit;
}
