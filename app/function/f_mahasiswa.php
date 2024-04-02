<?php

function getMahasiswa()
{
  $query = "SELECT * FROM mahasiswa";
  return query($query);
}

function uploadFoto($fileName)
{
  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  // cek apakah tidak ada gambar yg diupload
  if ($error === 4) {
    return 'default.jpg';
  }

  // cek apakah yg diupload adalah gambar
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = array_reverse(explode('.', strtolower($namaFile)))[0];
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    return false;
  }

  // cek ukuran file - Limit : 1MB
  if ($ukuranFile > 1000000) {
    return false;
  }

  // lolos pengecekan, gambar siap diupload
  move_uploaded_file($tmpName, 'assets/img/' . $fileName . '.' . $ekstensiGambar);
  return $fileName . '.' . $ekstensiGambar;
}


function tambah($data)
{
  global $conn;
  $nim = htmlspecialchars($data['nim']);
  $nama = htmlspecialchars($data['nama']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = uploadFoto($nim);

  $query = "INSERT INTO mahasiswa VALUES (NULL,'$nim','$nama','$email','$jurusan','$gambar')";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function hapus($id)
{
  global $conn;
  $query = "DELETE FROM mahasiswa WHERE id = $id";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  global $conn;

  $id = $data['id'];
  $nim = htmlspecialchars($data['nim']);
  $nama = htmlspecialchars($data['nama']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = uploadFoto($nim);

  $query = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama', email = '$email', jurusan = '$jurusan'"
    . ($gambar !== 'default.jpg' ? ", gambar = '$gambar'" : NULL) .
    "WHERE id = $id";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function cari($keyword)
{
  $query = "SELECT * FROM mahasiswa WHERE
    nama LIKE '%$keyword%' OR
    nrp LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    jurusan LIKE '%$keyword%'";

  return query($query);
}


// Komentar 

function getComments()
{
  $query = "SELECT * FROM komentar";
  return query($query);
}

function addComment($data)
{
  global $conn;
  $nama = $data['nama'];
  $email = $data['email'];
  $komentar = $data['komentar'];

  $query = "INSERT INTO komentar VALUES (NULL,?,?,?)";
  $stmt = mysqli_prepare($conn, $query);

  mysqli_stmt_bind_param($stmt, 'sss', $nama, $email, $komentar);
  mysqli_stmt_execute($stmt);

  return mysqli_affected_rows($conn);
}
