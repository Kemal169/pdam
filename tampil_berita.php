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
                    <h4 class="card-title">Daftar Berita</h4>
                    <p class="card-description">Menampilkan berita yang telah diinput.</p>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Tanggal Input</th>
                                <th>Deskripsi</th>
                                <th>Foto</th>
                                <th>Aksi</th> <!-- Kolom tambahan untuk tombol Edit dan Delete -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Query untuk mengambil data dari tabel tb_berita
                            $query = "SELECT * FROM tb_berita ORDER BY tanggal_input DESC";
                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($row['judul']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['tanggal_input']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['deskripsi_berita']) . '</td>';
                                    if (!empty($row['foto'])) {
                                        echo '<td><img src="uploads/' . htmlspecialchars($row['foto']) . '" width="100" alt="Foto Berita"/></td>';
                                    } else {
                                        echo '<td>—</td>';
                                    }
                                
                                    // Tambahkan tombol Edit dan Delete
                                    echo '<td>';
                                    echo '<a href="edit_berita.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Edit</a>';

                                    // Tombol Delete dengan form
                                    echo '<form action="api.php" method="POST" style="display:inline-block;">';
                                    echo '<input type="hidden" name="delete_id" value="' . $row['id'] . '">';
                                    echo '<button type="submit" name="delete_berita" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus berita ini?\');">Delete</button>';
                                    echo '</form>';

                                    echo '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5">Tidak ada berita yang tersedia.</td></tr>';
                            }
                            ?>
                        </tbody>
                        </table>
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
