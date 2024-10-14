<?php 
include ('includes/header_frontend.php');
include ('includes/navbar_frontend.php');
include('database/dbconfig.php'); 
?>

<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2><strong>Persyaratan Teknis Pemasangan Baru Sambungan Air Minum</strong></h2>
        <p>Berikut adalah persyaratan yang harus dipenuhi oleh pelanggan PDAM Tirta Makmur Sukoharjo untuk pemasangan baru sambungan air minum.</p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/about.jpg" class="img-fluid" alt="Gambar Persyaratan Pemasangan">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>Persyaratan Teknis Pemasangan Baru Sambungan Air Minum</h3>
            <!-- Membuat list berurutan sesuai format di gambar -->
            <ol>
              <li>
                <strong>Pengisian Formulir Pendaftaran</strong><br>
                Pelanggan yang mengajukan permohonan pemasangan baru wajib mengisi formulir pendaftaran yang telah disediakan.
              </li>
              <li>
                <strong>Dokumen Pendukung</strong><br>
                Pelanggan wajib menyerahkan dokumen pendukung sebagai berikut:
                <ul class="custom-bullet">
                  <li>Fotocopy Kartu Tanda Penduduk (KTP) yang masih berlaku</li>
                  <li>Materai Rp10.000,00</li>
                </ul>
              </li>
              <li>
                <strong>Pembayaran Biaya</strong><br>
                Pelanggan wajib melakukan pembayaran biaya sebagai berikut:
                <ul class="custom-bullet">
                  <li>Biaya pendaftaran sebesar Rp125.000,00</li>
                  <li>Biaya pemasangan akan ditentukan berdasarkan hasil survei lapangan dan golongan tarif yang berlaku.</li>
                </ul>
              </li>
            </ol>
            <p>
              Pastikan semua persyaratan di atas telah dipenuhi sebelum mendaftar untuk pemasangan baru. Jika Anda memiliki pertanyaan lebih lanjut, silakan hubungi layanan pelanggan kami.
            </p>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->
</main><!-- End #main -->


<?php 
include ('includes/scripts_frontend.php');
include ('includes/footer_frontend.php');
?>
