<?php 
include('includes/header_frontend.php');
include('includes/navbar_frontend.php'); 
include('database/dbconfig.php'); // tambahkan koneksi database

$page_title = 'Tentang Perusahaan';

// Query untuk mengambil data dari tb_profile dan tb_misi
$profile_query = "SELECT * FROM tb_profile WHERE id = 1";
$profile_result = mysqli_query($connection, $profile_query);
$profile_data = mysqli_fetch_assoc($profile_result);

$misi_query = "SELECT * FROM tb_misi";
$misi_result = mysqli_query($connection, $misi_query);
?>

<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2><strong>Profile Perusahaan</strong></h2>
        <h4>Perusahaan Daerah Air Minum Tirta Makmur Sukoharjo</h4>
      </div>
    </div><!-- End Breadcrumbs -->

    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3><?php echo htmlspecialchars($profile_data['sejarah']); ?></h3>
            <p class="fst-italic">
              <?php echo nl2br(htmlspecialchars($profile_data['sejarah'])); ?>
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
              <li><i class="bi bi-check-circle"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
              <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
            </ul>
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            </p>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Visi dan Misi Section ======= -->
    <section id="cource-details-tabs" class="cource-details-tabs">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <strong><a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Visi</a></strong>
              </li>
              <li class="nav-item">
                <strong><a class="nav-link" data-bs-toggle="tab" href="#tab-2">Misi</a></strong>
              </li>
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Visi Perusahaan</h3>
                    <p><?php echo nl2br(htmlspecialchars($profile_data['visi'])); ?></p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/course-details-tab-1.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-2">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Misi Perusahaan</h3>
                    <ol>
                      <?php 
                      while($misi_data = mysqli_fetch_assoc($misi_result)) {
                          echo '<li>' . htmlspecialchars($misi_data['isi']) . '</li>';
                      }
                      ?>
                    </ol>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/course-details-tab-2.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Visi dan Misi Section -->

    <!-- ======= Struktur Organisasi Section ======= -->
    <section id="struktur-organisasi" class="struktur-organisasi">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <h3>STRUKTUR ORGANISASI PERUMDA TIRTA MAKMUR KABUPATEN SUKOHARJO</h3>
            <div class="col-lg-12 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
              <img src="uploads/Struktur organisasi.png" class="img-fluid" alt="Struktur Organisasi">
            </div>
        </div>
      </div>
    </section><!-- End Struktur Organisasi Section -->
</main>

<?php 
include('includes/scripts_frontend.php');
include('includes/footer_frontend.php');
?>
