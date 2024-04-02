<?php

require_once(__DIR__ . '/../../app/core/init.php');
require_once(BASE_DIR . 'app/function/f_mahasiswa.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header("Location: .");
  exit;
}

if (!isset($_GET['id'])) {
  $_SESSION['error'] = 'Data tidak ditemukan!';
  header("Location: .");
  exit;
}

$id = $_GET['id'];

if (hapus($id) > 0) {
  $_SESSION['success'] = 'Data berhasil dihapus!';
  header("Location: .");
  exit;
} else {
  $_SESSION['error'] = 'Data gagal dihapus!';
  header("Location: .");
  exit;
}
