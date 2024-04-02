<?php

require_once(__DIR__ . '/../../app/core/init.php');
require_once(BASE_DIR . 'app/function/f_mahasiswa.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header("Location: .");
  exit;
}

$data = [
  'nim' => $_POST['nim'],
  'nama' => $_POST['nama'],
  'email' => $_POST['email'],
  'jurusan' => $_POST['jurusan'],
  'gambar' => $_FILES['gambar']
];

if (tambah($data) > 0) {
  $_SESSION['success'] = 'Data berhasil ditambahkan!';
  header("Location: .");
  exit;
} else {
  $_SESSION['error'] = 'Data gagal ditambahkan!';
  header("Location: .");
  exit;
}
