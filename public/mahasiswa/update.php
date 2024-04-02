<?php

require_once(__DIR__ . '/../../app/core/init.php');
require_once(BASE_DIR . 'app/function/f_mahasiswa.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header("Location: .");
  exit;
}

$data = [
  'id' => $_GET['id'],
  'nim' => $_POST['nim'],
  'nama' => $_POST['nama'],
  'email' => $_POST['email'],
  'jurusan' => $_POST['jurusan'],
  'gambar' => $_FILES['gambar']
];

if (ubah($data) > 0) {
  $_SESSION['success'] = 'Data berhasil diubaj!';
  header("Location: .");
  exit;
} else {
  $_SESSION['error'] = 'Data gagal diubah!';
  header("Location: .");
  exit;
}
