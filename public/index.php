<?php
include_once(__DIR__ . '/../app/core/init.php');
include_once(BASE_DIR . '/app/function/f_mahasiswa.php');
$title = 'Dashboard';
$comments = getComments();
?>

<?php include_once(BASE_DIR . '/app/template/dashboard/header.php') ?>
<div class="row">
  <div class="col-12 col-lg-8">
    <div class="card card-body">
      <div class="d-flex align-items-center">
        <img class="mr-3" height="75" src="https://em-content.zobj.net/source/microsoft-teams/363/man-raising-hand-light-skin-tone_1f64b-1f3fb-200d-2642-fe0f.png">
        <div>
          <h3 class="mb-1"><span class="font-weight-bold">Hello,</span> <?= $_SESSION['user']['name'] ?? 'Undefined' ?></h3>
          <p class="text-muted mb-0">Welcome to Dashboard!</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-4">
    <div class="card card-body">
      <h6 class="mb-3">Komentar Terbaru</h6>
      <?php foreach ($comments as $comment) : ?>
        <div class="d-flex align-items-center mb-3">
          <img class="mr-3" height="50" src="/assets/img/default.jpg" />
          <div>
            <h6 class="mb-0"><?= $comment['nama'] ?? 'Anonim' ?></h6>
            <p class="text-muted mb-0"><?= $comment['komentar'] ?></p>
          </div>
        </div>
      <?php endforeach; ?>

      <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalKomentar">
        <span>Tambah Komentar</span>
        <i class="fas fa-plus-square ml-1"></i>
      </a>
    </div>
  </div>
</div>


<div class="modal fade" id="modalKomentar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form id="formMahasiswa" method="POST" action="tambahkomentar.php" class="modal-content" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Tambah Komentar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control rounded-1" id="nama" name="nama">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control rounded-1" id="email" name="email">
          </div>
          <div class="mb-3">
            <label for="jurusan" class="form-label">Komentar</label>
            <textarea class="form-control rounded-1" id="komentar" name="komentar" required></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary" id="action">
          <span>Tambah Komentar</span>
          <i class="fas fa-plus-square ml-1"></i>
        </button>
      </div>
    </form>
  </div>
</div>
<?php include_once(BASE_DIR . 'app/template/dashboard/footer.php') ?>