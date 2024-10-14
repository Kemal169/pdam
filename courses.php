<?php 
include('includes/header_frontend.php');
include('includes/navbar_frontend.php');

// Menghubungkan ke database
include('database/dbconfig.php'); // Pastikan file ini berisi koneksi ke database Anda

// Query untuk mengambil data berita dari tabel tb_berita
$query = "SELECT * FROM tb_berita ORDER BY tanggal_input DESC";
$query_run = mysqli_query($connection, $query);
?>

<main id="main" data-aos="fade-in">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <h2><strong>Berita</strong></h2>
        <h5>Pada Halaman ini berisi kabar dari PDAM</h5>
      </div>
    </div><!-- End Breadcrumbs -->
    <section id="courses" class="courses">
    <div class="container" data-aos="fade-up">
        <div class="row row-cols-2 row-cols-md-3 g-4" data-aos="zoom-in" data-aos-delay="50">
        <?php
        if (mysqli_num_rows($query_run) > 0) {
            while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
            <div class="col d-flex align-items-stretch">
                <div class="course-item">
                    <?php if (!empty($row['foto'])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($row['foto']); ?>" class="img-fluid news-img" alt="...">
                    <?php endif; ?>
                    <div class="course-content">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="price"><?php echo htmlspecialchars($row['tanggal_input']); ?></p>
                        </div>
                        <h3><a href="course-details.php?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['judul']); ?></a></h3>
                        <p><?php echo htmlspecialchars(substr($row['deskripsi_berita'], 0, 100)) . '...'; ?></p>
                    </div>
                </div>
            </div> <!-- End Course Item-->
            <?php
            }
        } else {
            ?>
            <div class="col-12">
            <p>Tidak ada berita yang tersedia.</p>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
    </section><!-- End Courses Section -->
</main><!-- End #main -->
<?php 
include('includes/footer_frontend.php');
include('includes/scripts_frontend.php');
?>


