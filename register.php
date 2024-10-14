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

$connection->close();
?>
<div class="main-panel">
    <div class="content-wrapper">
        <?php
        // Menampilkan notifikasi jika ada
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
        <div class="page-body-wrapper full-page-wrapper">
            <div class="content-wrapper auth">
                <div class="row flex-grow">
                    <div class="col-lg-8 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <h4>Pembuatan Akun Admin</h4>
                            <form action="api.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Full name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Password" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="togglePasswordVisibility()">
                                                <i class="mdi mdi-eye" id="togglePasswordIcon"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group col-xs-12">
                                        <input type="file" name="profile" class="file-upload-default"/>
                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image"/>
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" name="registerbtn" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
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
    include('includes/footer.php');
    ?>
</div>
