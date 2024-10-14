<?php
session_start();
ob_start(); // Start output buffering

include('includes/header.php');
include('includes/navbar.php');
include('database/dbconfig.php');

// Mengambil data pengguna berdasarkan session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query untuk mengambil data pengguna berdasarkan username
    $query = "SELECT * FROM tb_user WHERE username = '$username'";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $user = mysqli_fetch_assoc($query_run);
    } else {
        $_SESSION['status'] = "Pengguna tidak ditemukan";
        $_SESSION['status_code'] = "error";
        header('Location: login.php');
        exit();
    }
} else {
    $_SESSION['status'] = "Anda harus login untuk melihat profil";
    $_SESSION['status_code'] = "error";
    header('Location: login.php');
    exit();
}

// Proses perubahan password
if (isset($_POST['change_password'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Cek password lama
    if (password_verify($old_password, $user['password'])) {
        if ($new_password === $confirm_password) {
            // Hash password baru
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
            
            // Update password di database
            $update_query = "UPDATE tb_user SET password = '$hashed_new_password' WHERE username = '$username'";
            $update_query_run = mysqli_query($connection, $update_query);

            if ($update_query_run) {
                $_SESSION['status'] = "Password berhasil diubah!";
                $_SESSION['status_code'] = "success";
                header('Location: profile.php');
                exit();
            } else {
                $_SESSION['status'] = "Gagal mengubah password.";
                $_SESSION['status_code'] = "error";
            }
        } else {
            $_SESSION['status'] = "Konfirmasi password tidak cocok.";
            $_SESSION['status_code'] = "error";
        }
    } else {
        $_SESSION['status'] = "Password lama salah.";
        $_SESSION['status_code'] = "error";
    }
}
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ganti Password</h4>

                        <!-- Menampilkan notifikasi jika ada -->
                        <?php
                        if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                            $status_code = $_SESSION['status_code'];
                            echo '<div class="alert alert-' . ($status_code == 'success' ? 'success' : 'danger') . ' alert-dismissible fade show" role="alert">';
                            echo $_SESSION['status'];
                            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                            echo '<span aria-hidden="true">&times;</span>';
                            echo '</button>';
                            echo '</div>';
                            unset($_SESSION['status']);
                            unset($_SESSION['status_code']);
                        }
                        ?>

                        <!-- Formulir perubahan password -->
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="old_password">Password Lama</label>
                                <input type="password" name="old_password" class="form-control" id="old_password" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">Password Baru</label>
                                <input type="password" name="new_password" class="form-control" id="new_password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Konfirmasi Password Baru</label>
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                            </div>
                            <button type="submit" name="change_password" class="btn btn-gradient-primary">Ubah Password</button>
                        </form>

                        <div class="mt-3">
                            <a href="profile.php" class="btn btn-gradient-secondary">Kembali ke Profil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include('includes/scripts.php');
ob_end_flush(); // End output buffering and flush output
?>
