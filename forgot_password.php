<?php
session_start();
include('includes/header.php');
include('database/dbconfig.php'); // Pastikan file ini berisi koneksi ke database Anda

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    // Validasi input kosong
    if (empty($username)) {
        $error = "Username tidak boleh kosong.";
    } else {
        // Query untuk memeriksa keberadaan pengguna berdasarkan username
        $query = "SELECT * FROM tb_user WHERE username='$username'";
        $result = $connection->query($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $email = $row['email']; // Misalnya, Anda menyimpan email di database

            // Kirim email reset password
            $reset_token = bin2hex(random_bytes(50)); // Token untuk reset password
            $expiry = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token berlaku selama 1 jam

            // Simpan token dan expiry di database
            $update_query = "UPDATE tb_user SET reset_token='$reset_token', token_expiry='$expiry' WHERE username='$username'";
            $connection->query($update_query);

            // Kirim email (gunakan mailer library seperti PHPMailer untuk email sebenarnya)
            $reset_link = "http://yourdomain.com/reset_password.php?token=$reset_token";
            $subject = "Reset Password";
            $message = "Klik link berikut untuk mereset password Anda: $reset_link";
            $headers = "From: no-reply@yourdomain.com";

            if (mail($email, $subject, $message, $headers)) {
                $success = "Link reset password telah dikirim ke email Anda.";
            } else {
                $error = "Gagal mengirim email reset password.";
            }
        } else {
            $error = "Username tidak ditemukan.";
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
            <h4>Reset Password</h4>
            <h6 class="font-weight-light">Masukkan username Anda untuk menerima link reset password.</h6>
            <?php 
              if (!empty($error)) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
              }
              if (!empty($success)) {
                echo '<div class="alert alert-success" role="alert">' . $success . '</div>';
              }
            ?>
            <form class="pt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
              <div class="form-group">
                <input type="text" name="username" class="form-control form-control-lg" placeholder="Username">
              </div>
              <div class="mt-3">
                <button type="submit" name="reset_btn" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Kirim Link Reset</button>
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
