<?php
session_start();
include('security.php');
if (!$_SESSION['username']) {
    header('Location: login.php');
    exit();
}

include('includes/header.php');
include('includes/navbar.php');

$page_title = 'Berita';

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
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Input Berita</h4>
                    <p class="card-description">Masukkan informasi berita yang akan ditampilkan.</p>
                    <form class="forms-sample" action="api.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="judul">Judul Berita</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Berita" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_input">Tanggal Input</label>
                            <input type="date" class="form-control" id="tanggal_input" name="tanggal_input" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_berita">Deskripsi Berita</label>
                            <textarea class="form-control" id="deskripsi_berita" name="deskripsi_berita" rows="4" placeholder="Deskripsi Berita" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>File upload</label>
                            <div class="input-group col-xs-12">
                            <input type="file" name="foto" class="file-upload-default"/>
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image"/>
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" type="button">
                                        Upload
                                    </button>
                                </span>
                            </div>
                        </div>
                        <button type="submit" name="submitberita" class="btn btn-gradient-primary mr-2">Submit</button>
                        <button type="reset" class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php 
    include('includes/footer.php');
    include('includes/scripts.php');
    ?>
</div>
