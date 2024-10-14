<?php
session_start();
include('includes/header.php');
include('security.php');

$error = ""; // Variabel untuk menyimpan pesan error

if (isset($_SESSION['username'])) {
  header("Location: dashboard.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Validasi input kosong
  if (empty($username) || empty($password)) {
    $error = "Username dan password tidak boleh kosong.";
  } else {
    // Query untuk memeriksa keberadaan pengguna berdasarkan username
    $query = "SELECT * FROM tb_user WHERE username='$username'";
    $result = $connection->query($query);

    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();

      // Verifikasi password
      if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
      } else {
        // Jika password salah
        $error = "Username atau password salah.";
      }
    } else {
      // Jika username tidak ditemukan
      $error = "Username atau password salah.";
    }
  }
}
?>

<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth">
      <div class="row flex-grow">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left p-5">
            <h4>Selamat Datang</h4>
            <h6 class="font-weight-light">Login untuk ke halaman selanjutnya.</h6>
            <?php 
              if (!empty($error)) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
              }
              if(isset($_SESSION['status']) && $_SESSION['status']!='')
              {
                  echo '<h2 class="bg-danger text-white">' .$_SESSION['status']. '</h2>';
                  unset($_SESSION['status']);
              }
               ?>
            <form class="pt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
              <div class="form-group">
                <input type="text" name="username" class="form-control form-control-lg" placeholder="Username">
              </div>
              <div class="form-group">
                <div class="input-group">
                  <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Password">
                  <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePasswordVisibility()">
                      <i class="mdi mdi-eye" id="togglePasswordIcon"></i>
                    </span>
                  </div>
                </div>
              </div>
              <div class="mt-3">
                <button type="submit" name="login_btn" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                <!-- <a href="forgot_password.php" class="btn btn-link">Lupa Password?</a> -->
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
<?php 
include('includes/scripts.php');
?>
