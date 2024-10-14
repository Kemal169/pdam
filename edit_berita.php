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


// Ambil data berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tb_berita WHERE id = '$id'";
    $query_run = mysqli_query($connection, $query);
    
    if (mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);
    } else {
        echo "Data tidak ditemukan";
        exit;
    }
}
// $connection->close();
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Berita</h4>
                    <form action="api.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                        <div class="form-group">
                            <label for="judul">Judul Berita</label>
                            <input type="text" class="form-control" name="judul" value="<?php echo $row['judul']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_input">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal_input" value="<?php echo $row['tanggal_input']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_berita">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi_berita" rows="4" required><?php echo $row['deskripsi_berita']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" name="foto">
                            <img src="uploads/<?php echo $row['foto']; ?>" width="300" alt="Foto Berita"/>
                        </div>

                        <!-- Tombol Update dan Batal -->
                        <button type="submit" name="update_berita" class="btn btn-primary">Update</button>
                        <a href="tampil_berita.php" class="btn btn-secondary">Batal</a> <!-- Tombol Batal -->
                    </form>
                </div>
            </div>
        </div>
        <?php
        include('includes/footer.php');
        include('includes/scripts.php');
        ?>
    </div>
</div>
