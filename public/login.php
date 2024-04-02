<?php

require_once(__DIR__ . '/../app/core/init.php');

$title = 'Login';


// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  // ambil username berdasarkan id
  $result = mysqli_query($conn, "SELECT username from user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);

  if ($key === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
  }
}

if (isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}


if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

  // cek username
  if (mysqli_num_rows($result) === 1) {
    // cek password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
      // set session
      $_SESSION['login'] = true;
      $_SESSION['user']['username'] = $row['username'];
      $_SESSION['user']['name'] = $row['name'];
      $_SESSION['user']['email'] = $row['email'];
      $_SESSION['user']['id'] = $row['id'];

      // cek remember me
      if (isset($_POST['remember'])) {
        // buat cookie
        setcookie('id', $row['id'], time() + 60 * 60 * 24 * 1);
        setcookie('key', hash('sha256', $row['username']), time() + 60 * 60 * 24 * 1);
      }

      header("Location: index.php");
      exit;
    }
  }
  $_SESSION['error'] = 'Username / Password Salah!';
}

?>

<?php include_once(BASE_DIR . 'app/template/auth/header.php') ?>
<div class="col-12 col-sm-8 col-md-5 col-lg-4 mx-auto my-5">
  <div class="card">
    <img src="https://cdn.jsdelivr.net/gh/rndio/rndblog@latest/img/icon/icon.webp" class="my-3 rounded-circle align-self-center shadow-sm" alt="Logo" width="90">
    <form action="" method="POST" class="card-body" style="padding:.5rem 1rem 1.5rem 1rem;">
      <h5 class="font-weight-bold mb-2 text-center">CRUDPHP</h5>
      <p class="font-weight-semibold mb-3 text-center">Silahkan Login</p>
      <?php if (isset($_SESSION['error'])) : ?>
        <div class="alert alert-danger text-uppercase small text-center" role="alert">
          <?= $_SESSION['error'] ?>
          <?php unset($_SESSION['error']) ?>
        </div>
      <?php endif; ?>
      <div class="mb-2">
        <input type="text" name="username" placeholder="Username" class="form-control rounded-0" autofocus required>
      </div>
      <div class="mb-3">
        <input type="password" name="password" placeholder="Password" id="password" class="form-control rounded-0" required>
      </div>
      <div class="ms-1 my-3 form-check">
        <input class="form-check-input rounded-0" name="remember" type="checkbox" id="chkbox">
        <label class="form-check-label" for="chkbox">Remember Me</label>
      </div>
      <button class="btn btn-primary rounded-0 w-100 d-inline-flex justify-content-center" type="submit">Login / Masuk</button>
    </form>
  </div>
</div>
<?php include_once(BASE_DIR . 'app/template/auth/footer.php') ?>