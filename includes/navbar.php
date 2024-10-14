<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
   <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo" href="index.html">
       <img src="assets/images/logo-pdam.svg" style="width: 75px; height: auto;" />
      </a>
   </div>
   <div class="navbar-menu-wrapper d-flex align-items-stretch">
     <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
       <span class="mdi mdi-menu"></span>
     </button>
     <div class="search-field d-none d-md-block">
       <form class="d-flex align-items-center h-100" action="#">
         <div class="input-group">
           <div class="input-group-prepend bg-transparent">
             <i class="input-group-text border-0 mdi mdi-magnify"></i>
           </div>
           <input type="text" class="form-control bg-transparent border1" placeholder="Search projects">
         </div>
       </form>
     </div>
     <ul class="navbar-nav navbar-nav-right">
       <li class="nav-item nav-profile dropdown">
       <a class="nav-link dropdown-toggle" id="profileDropdown" data-toggle="dropdown" aria-expanded="false">
          <div class="nav-profile-img">
              <?php
              include('database/dbconfig.php');
              // Cek apakah sesi username ada dan profile image tersedia
              if (isset($_SESSION['username'])) {
                  // Lakukan query untuk mengambil data pengguna berdasarkan username dari session
                  $username = $_SESSION['username'];
                  $query = "SELECT profile FROM tb_user WHERE username = '$username'";
                  $query_run = mysqli_query($connection, $query);
                  $user = mysqli_fetch_assoc($query_run);

                  // Tampilkan gambar profil jika ada, jika tidak gunakan gambar default
                  if (!empty($user['profile'])) {
                      echo '<img src="profile/' . htmlspecialchars($user['profile']) . '" alt="Foto Profil">';
                  } else {
                      echo '<img src="assets/images/faces/face1.jpg" alt="image">'; // Gambar default jika profil kosong
                  }
              } else {
                  // Jika tidak ada sesi, tampilkan gambar default
                  echo '<img src="assets/images/faces/face1.jpg" alt="image">';
              }
              ?>
              <span class="availability-status online"></span>
          </div>
          <div class="nav-profile-text">
              <p class="mb-1 text-black">
                  <?php
                  if (isset($_SESSION['username'])) {
                      echo $_SESSION['username'];
                  } else {
                      echo 'Guest';
                  }
                  ?>
              </p>
          </div>
      </a>
          <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="#">
              <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
            <div class="dropdown-divider"></div>
            <form action="signout.php" method="POST" style="margin: 0;">
              <button type="submit" class="dropdown-item" style="border: none; background: none; padding: 0; width: 100%; text-align: left;">
              <a class="dropdown-item"><i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
              </button>
            </form>
          </div>
       </li>
     </ul>
   </div>

 </nav>
 <!-- partial -->
 <div class="container-fluid page-body-wrapper">
   <!-- partial:partials/_sidebar.html -->
   <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
       <li class="nav-item">
         <a class="nav-link" href="index.html">
           <span class="menu-title">Dashboard</span>
           <i class="mdi mdi-home menu-icon"></i>
         </a>
       </li>
       <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
           <span class="menu-title">Basic UI Elements</span>
           <i class="menu-arrow"></i>
           <i class="mdi mdi-crosshairs-gps menu-icon"></i>
         </a>
         <div class="collapse" id="ui-basic">
           <ul class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
             <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
           </ul>
         </div>
       </li>
       <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#ui-basic-register" aria-expanded="false" aria-controls="ui-basic-register">
           <span class="menu-title">Register</span>
           <i class="menu-arrow"></i>
           <i class="mdi mdi-account-card-details menu-icon"></i>
         </a>
         <div class="collapse" id="ui-basic-register">
           <ul class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="register.php">Register</a></li>
             <li class="nav-item"> <a class="nav-link" href="profile.php">Profile</a></li>
           </ul>
         </div>
       </li>
       <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#ui-basic-berita" aria-expanded="false" aria-controls="ui-basic-berita">
           <span class="menu-title">Berita</span>
           <i class="menu-arrow"></i>
           <i class="mdi mdi-newspaper menu-icon"></i>
         </a>
         <div class="collapse" id="ui-basic-berita">
           <ul class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="berita.php">Input Berita</a></li>
             <li class="nav-item"> <a class="nav-link" href="tampil_berita.php">Daftar Berita</a></li>
           </ul>
         </div>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="sejarah_perusahaan.php">
           <span class="menu-title">Sejarah Perusahaan</span>
           <i class="mdi mdi-domain menu-icon"></i>
         </a>
       </li> 
       <li class="nav-item">
         <a class="nav-link" href="payment.php">
           <span class="menu-title">Payment Image</span>
           <i class="mdi mdi-square-inc-cash menu-icon"></i>
         </a>
       </li>   
       <li class="nav-item">
         <a class="nav-link" href="input_gambar.php">
           <span class="menu-title">Slide Index</span>
           <i class="mdi mdi-file-image menu-icon"></i>
         </a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="edit_why-us.php">
           <span class="menu-title">Edit Why Us</span>
           <i class="mdi mdi-comment-question-outline menu-icon"></i>
         </a>
       </li>                
     </ul>
</nav>
