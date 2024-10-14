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

// $connection->close();
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
                    <h4 class="card-title">Input Gambar Hero</h4>
                    <p class="card-description">Masukkan gambar untuk slider hero section beserta judul dan link.</p>
                    <form class="forms-sample" action="api.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Upload Gambar Hero</label>
                            <div class="input-group col-xs-12">
                                <input type="file" name="gambar_hero" class="file-upload-default" required />
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" />
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" type="button">
                                        Upload
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="judul_pertama">Judul Pertama</label>
                            <input type="text" class="form-control" id="judul_pertama" name="judul_pertama" placeholder="Judul utama di gambar" required>
                        </div>
                        <div class="form-group">
                            <label for="judul_kedua">Judul Kedua</label>
                            <input type="text" class="form-control" id="judul_kedua" name="judul_kedua" placeholder="Judul sekunder di gambar" required>
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" name="link" placeholder="Link yang ingin ditautkan pada gambar" required>
                        </div>
                        <button type="submit" name="submitgambar" class="btn btn-gradient-primary mr-2">Submit</button>
                        <button type="reset" class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Menampilkan gambar hero dengan layout grid -->
        <div class="row mt-4">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Gambar Hero</h4>
                        <div class="row">
                            <?php
                            $query = "SELECT * FROM tb_gambar";
                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($gambar = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <div class="col-md-3 mb-4">
                                        <div class="card">
                                            <img src="uploads/<?php echo $gambar['gambar1']; ?>" class="card-img-top" alt="Gambar Hero">
                                            <div class="card-body">
                                                <h5><?php echo htmlspecialchars($gambar['judul_pertama']); ?></h5>
                                                <p><?php echo htmlspecialchars($gambar['judul_kedua']); ?></p>
                                                <a href="<?php echo htmlspecialchars($gambar['link']); ?>" target="_blank" class="btn btn-primary btn-sm">Visit Link</a>
                                                
                                                <!-- Tombol Edit -->
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?php echo $gambar['id']; ?>">
                                                    Edit
                                                </button>

                                                <!-- Tombol Delete -->
                                                <form action="api.php" method="POST" style="display:inline-block;" class="mt-2">
                                                    <input type="hidden" name="delete_id" value="<?php echo $gambar['id']; ?>">
                                                    <button type="submit" name="delete_gambar" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus gambar ini?');">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal<?php echo $gambar['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Gambar Hero</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="api.php" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="id" value="<?php echo $gambar['id']; ?>">
                                                        <div class="form-group">
                                                            <label>Upload Gambar Hero</label>
                                                            <div class="input-group col-xs-12">
                                                                <input type="file" name="gambar_hero" class="file-upload-default" />
                                                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" />
                                                                <span class="input-group-append">
                                                                    <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="judul_pertama">Judul Pertama</label>
                                                            <input type="text" class="form-control" id="judul_pertama" name="judul_pertama" value="<?php echo $gambar['judul_pertama']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="judul_kedua">Judul Kedua</label>
                                                            <input type="text" class="form-control" id="judul_kedua" name="judul_kedua" value="<?php echo $gambar['judul_kedua']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="link">Link</label>
                                                            <input type="text" class="form-control" id="link" name="link" value="<?php echo $gambar['link']; ?>" required>
                                                        </div>
                                                        <button type="submit" name="updategambar" class="btn btn-gradient-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="col-12">
                                    <p class="text-center">Tidak ada gambar hero yang tersedia</p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
    include('includes/footer.php');
    include('includes/scripts.php');
    ?>
</div>
