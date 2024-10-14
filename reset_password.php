<?php
session_start();
include('includes/header.php');
include('database/dbconfig.php'); // Pastikan file ini berisi koneksi ke database Anda

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $token = $_POST['token'];

    // Validasi input kosong
    if (empty($password) || empty($confirm_password)) {
        $error = "Password tidak boleh kosong.";
    } elseif ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok.";
    } else {
        // Verifikasi token
        $query = "SELECT * FROM tb_user WHERE reset_token='$token' AND token_expiry >= NOW()";
        $result = $connection->query($query);

        if ($result->num_rows == 1) {
            // Token valid, update password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $update_query = "UPDATE tb_user SET password='$hashed_password', reset_token=NULL, token_expiry=NULL WHERE reset_token='$token'";
            if ($connection->query($update_query)) {
                $success = "Password berhasil diubah. <a href='login.php'>Login</a>";
            } else {
                $error = "Gagal mengubah password.";
            }
        } else {
            $error = "Token tidak valid atau sudah kedaluwarsa.";
        }
    }
} elseif (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    $error = "Token tidak ditemukan.";
}
?>

<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth">
      <div class="row flex-grow">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left p-5">
            <h4>Ganti Password</h4>
            <?php 
              if (!empty($error)) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
              }
              if (!empty($success)) {
                echo '<div class="alert alert-success" role="alert">' . $success . '</div>';
              }
            ?>
            <form class="pt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
              <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
              <div class="form-group">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Password Baru">
              </div>
              <div class="form-group">
                <input type="password" name="confirm_password" class="form-control form-control-lg" placeholder="Konfirmasi Password">
              </div>
              <div class="mt-3">
                <button type="submit" name="reset_password_btn" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Ganti Password</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
include('includes/scripts.php');
?>
