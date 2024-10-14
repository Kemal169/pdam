<?php
session_start();
include('security.php');
if (!$_SESSION['username']) {
    header('Location: login.php');
    exit();
}

include('includes/header.php');
include('includes/navbar.php');

if ($connection->connect_error) {
  die("Koneksi gagal: " . $connection->connect_error);
}

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
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Profil Pengguna</h4>

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

                        <!-- Tabel Profil Pengguna -->
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td><?php echo htmlspecialchars($user['nama']); ?></td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                </tr>
                                <tr>
                                    <th>Password</th>
                                    <td>
                                        <div class="input-group">
                                            <input type="password" id="password" class="form-control" value="<?php echo htmlspecialchars($user['password']); ?>" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text" onclick="togglePasswordVisibility()">
                                                    <i class="mdi mdi-eye" id="togglePasswordIcon"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Foto Profil</th>
                                    <td>
                                        <?php if (!empty($user['profile'])): ?>
                                            <img src="profile/<?php echo htmlspecialchars($user['profile']); ?>" alt="Foto Profil" >
                                        <?php else: ?>
                                            <p>Belum ada foto profil.</p>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Opsi untuk mengubah password -->
                        <div class="mt-3">
                            <a href="edit_profile.php" class="btn btn-gradient-primary">Edit Profil</a>
                            <a href="change_password.php" class="btn btn-gradient-info">Ganti Password</a>
                            <a href="signout.php" class="btn btn-gradient-danger">Signout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include('includes/scripts.php');
?>

<script>
function togglePasswordVisibility() {
    var passwordInput = document.getElementById('password');
    var toggleIcon = document.getElementById('togglePasswordIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('mdi-eye');
        toggleIcon.classList.add('mdi-eye-off');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('mdi-eye-off');
        toggleIcon.classList.add('mdi-eye');
    }
}
</script>
