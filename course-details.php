<?php
include('includes/header_frontend.php');
include('includes/navbar_frontend.php');
include('database/dbconfig.php');

// Ambil ID dari parameter URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']);

    // Query untuk mendapatkan detail berita berdasarkan ID
    $query = "SELECT * FROM tb_berita WHERE id = '$id'";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);
    } else {
        echo "<p>Detail berita tidak ditemukan.</p>";
    }
} else {
    echo "<p>ID berita tidak ada di URL.</p>";
}
?>

<main id="main" data-aos="fade-in">
    <div class="breadcrumbs">
      <div class="container">
        <h2><strong><?php echo htmlspecialchars($row['judul']); ?></strong></h2>
      </div>
    </div>
    
    <section id="course-details" class="course-details">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-8">
                    <img src="uploads/<?php echo htmlspecialchars($row['foto']); ?>" class="img-fluid" alt="">
                    <h3><?php echo htmlspecialchars($row['judul']); ?></h3>
                    <p><?php echo htmlspecialchars($row['deskripsi_berita']); ?></p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php 
include('includes/scripts_frontend.php');
include('includes/footer_frontend.php');
?>
