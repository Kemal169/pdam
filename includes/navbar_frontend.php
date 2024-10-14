<?php 
// Ambil URL saat ini
$current_page = basename($_SERVER['REQUEST_URI']); 
?>

<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <!-- <h1 class="logo me-auto"><a href="index.php"></a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="index.php" class="logo me-auto"><img src="frontend/assets/img/logo-pdam.svg" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">Beranda</a></li>
          <!-- <li><a href="about.php" class="<?php echo $current_page == 'about.php' ? 'active' : ''; ?>">Profile</a></li> -->
          <li class="dropdown"><a href="#"><span>Profile</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="about.php">Profile Perusahaan</a></li>
            <li><a href="cabang.php">Info Cabang</a></li>
          </ul>
          </li>
          <li><a href="courses.php" class="<?php echo $current_page == 'courses.php' ? 'active' : ''; ?>">Berita</a></li>
          <li class="dropdown"><a href="#"><span>Informasi Pelanggan</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="pasang_baru.php">Pasang Baru</a></li>
            <li><a href="tarif.php">Tarif</a></li>
            <li><a href="klasifikasi.php">Klasifikasi Pengguna</a></li>
            <li><a href="https://www.pdamsukoharjo.com/">Info Tagihan</a></li>
          </ul>
          </li>
          <li><a href="contact.php" class="<?php echo $current_page == 'contact.php' ? 'active' : ''; ?>">Hubungi Kami</a>
        <!-- <li><a href="trainers.php" class="<?php echo $current_page == 'trainers.php' ? 'active' : ''; ?>">Informasi Pelanggan</a></li> -->
      </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->
