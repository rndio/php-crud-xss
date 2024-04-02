<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Ordinary CRUD APP with Native PHP">
  <meta name="author" content="rndio">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">

  <title><?= $title ?? 'Untitled' ?> - CRUDPHP</title>

  <!-- Custom fonts for this template-->
  <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css" integrity="sha256-BPD8yzhbXHEWVBJ9+YX5nQj/Jeike/1yCRiI/esUUeg=" crossorigin="anonymous">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php include_once(__DIR__ . '/sidebar.php') ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include_once(__DIR__ . '/topbar.php') ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php if (isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger text-uppercase small text-center" role="alert">
              <?= $_SESSION['error'] ?>
              <?php unset($_SESSION['error']) ?>
            </div>
          <?php endif; ?>
          <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-success">
              <?= $_SESSION['success'] ?>
              <?php unset($_SESSION['success']) ?>
            </div>
          <?php endif; ?>