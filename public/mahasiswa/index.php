<?php
include_once(__DIR__ . '/../../app/core/init.php');
include_once(BASE_DIR . 'app/function/f_mahasiswa.php');

$title = 'Data Mahasiswa';

$mahasiswa = getMahasiswa();
?>


<?php include_once(BASE_DIR . 'app/template/dashboard/header.php') ?>
<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
    <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
    <button class="btn btn-sm btn-primary" id="create-btn">
      <span>Tambah Data</span>
      <i class="fas fa-plus-square ml-1"></i>
    </button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
            <th>Gambar</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (sizeof($mahasiswa) == 0) : ?>
            <tr>
              <td colspan="7" class="text-center">Data tidak ditemukan!</td>
            </tr>
          <?php endif ?>
          <?php foreach ($mahasiswa as $key => $mhs) : ?>
            <tr id="<?= 'mhs-' . $mhs['id'] ?>">
              <th class="align-middle"><?= $key + 1 ?></th>
              <td class="nim align-middle"><?= $mhs['nim'] ?></td>
              <td class="nama align-middle"><?= $mhs['nama'] ?></td>
              <td class="email align-middle"><?= $mhs['email'] ?></td>
              <td class="jurusan align-middle"><?= $mhs['jurusan'] ?></td>
              <td class="gambar align-middle">
                <img src="<?= '/assets/img/' . $mhs['gambar'] ?>" height="50" alt="">
              </td>
              <td class="align-middle">
                <div class="d-flex">
                  <button data-id="<?= $mhs['id'] ?>" class="btn btn-sm btn-warning mr-1 edit-btn" title="Edit">
                    <i class="fas fa-edit"></i>
                  </button>
                  <form method="POST" action="/mahasiswa/delete.php?id=<?= $mhs['id'] ?>" class="d-inline-block delete-form" title="Delete">
                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="modalMahasiswa" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form id="formMahasiswa" method="POST" action="create.php" class="modal-content" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Tambah Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 col-lg-7">
            <div class="form-group">
              <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="number" class="form-control rounded-1" id="nim" name="nim" required>
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control rounded-1" id="nama" name="nama" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control rounded-1" id="email" name="email" required>
              </div>
              <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan</label>
                <input type="text" class="form-control rounded-1" id="jurusan" name="jurusan" required>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-5">
            <div class="form-group">
              <div class="mb-3">
                <label for="gambar" class="form-label">Photo</label>
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="gambar" id="gambar">
                    <label class="custom-file-label" for="gambar">Choose file</label>
                  </div>
                </div>
                <div class="text-center">
                  <img id="photo-preview" src="/assets/img/default.jpg" height="150">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary" id="action">
          <span>Tambah Mahasiswa</span>
          <i class="fas fa-plus-square ml-1"></i>
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const createBtn = document.getElementById('create-btn');
    const editBtns = document.querySelectorAll('button.edit-btn');
    const deleteForms = document.querySelectorAll('form.delete-form');

    const form = document.getElementById('formMahasiswa');
    const modalMhsEl = document.getElementById('modalMahasiswa');
    const modalMhs = new bootstrap.Modal(modalMhsEl);

    // Preview Photo Action
    form.gambar.addEventListener("change", (function(e) {
      const t = e.target.files[0],
        n = new FileReader;
      n.onload = function(e) {
        document.getElementById("photo-preview").src = e.target.result
      }, n.readAsDataURL(t)
    }));

    function getDataMahasiswa(id) {
      const tr = document.getElementById('mhs-' + id);
      if (!tr) {
        return null;
      }
      const nim = tr.querySelector('.nim').innerText;
      const nama = tr.querySelector('.nama').innerText;
      const email = tr.querySelector('.email').innerText;
      const jurusan = tr.querySelector('.jurusan').innerText;
      const gambar = tr.querySelector('.gambar>img').src;
      return {
        nim,
        nama,
        email,
        jurusan,
        gambar
      };
    }

    createBtn.addEventListener('click', function() {
      form.action = '/mahasiswa/create.php';
      form.querySelector('#title').innerHTML = 'Tambah Mahasiswa';
      form.querySelector('#action').innerHTML = 'Tambah Mahasiswa';
      form.querySelector('#photo-preview').src = '/assets/img/default.jpg';
      form.reset();
      modalMhs.show();
    });

    editBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const id = btn.dataset.id;
        const data = getDataMahasiswa(id);
        if (!data) {
          alert('Data tidak ditemukan!');
          return;
        }
        form.action = '/mahasiswa/update.php?id=' + id;
        form.querySelector('#title').innerHTML = 'Edit Mahasiswa';
        form.querySelector('#action').innerHTML = 'Edit Mahasiswa';
        form.querySelector('#nim').value = data.nim;
        form.querySelector('#nama').value = data.nama;
        form.querySelector('#email').value = data.email;
        form.querySelector('#jurusan').value = data.jurusan;
        form.querySelector('#photo-preview').src = data.gambar;
        modalMhs.show();
      });
    });

    deleteForms.forEach(form => {
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (confirm('Apakah anda yakin?')) {
          e.target.submit();
        }
      });
    });
  });
</script>
<?php include_once(BASE_DIR . 'app/template/dashboard/footer.php') ?>