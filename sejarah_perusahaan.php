<?php 
session_start();
include('includes/navbar.php');
include('includes/header.php');
include('security.php');
if (!$_SESSION['username']) {
    header('Location: login.php');
    exit();
}


// Query untuk mengambil data profile dari tb_profile
$query = "SELECT * FROM tb_profile LIMIT 1";  // Mengambil satu data (karena biasanya hanya ada satu profile perusahaan)
$query_run = mysqli_query($connection, $query);
$profile = mysqli_fetch_assoc($query_run);  // Menyimpan data yang diambil ke dalam array

// Query untuk mengambil data misi dari tb_misi
$misi_query = "SELECT * FROM tb_misi";  // Mengambil semua misi dari tb_misi
$misi_query_run = mysqli_query($connection, $misi_query);
?>

<div class="content-wrapper">
  <div class="container-fluid">
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

    <div class="row">
      <div class="col-md-11">
        <h1 class="mt-4">Profile Perusahaan</h1>
        <ol class="breadcrumb mb-4">
          <!-- <li class="breadcrumb-item active">Profile Perusahaan</li> -->
        </ol>
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-10 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Data Profile Perusahaan</h4>
            <p class="card-description">
              Tabel Ini Menampilkan Data Profil Perusahaan
            </p>
            <div class="table-responsive">
              <!-- Menampilkan data dari tabel tb_profile secara vertikal -->
              <?php if ($profile): ?>
              <table class="table table-bordered" style="width: 700px;">
                <tbody>
                  <tr>
                    <th>#</th>
                    <td>1</td>
                  </tr>
                  <tr>
                    <th>Sejarah Perusahaan</th>
                    <td><?php echo nl2br(htmlspecialchars($profile['sejarah'])); ?></td>
                  </tr>
                  <tr>
                    <th>Visi Perusahaan</th>
                    <td><?php echo nl2br(htmlspecialchars($profile['visi'])); ?></td>
                  </tr>
                  <tr>
                    <th>Misi Perusahaan</th>
                      <td>
                        <ol>
                          <!-- Loop untuk menampilkan semua misi perusahaan dengan angka -->
                          <?php while ($misi = mysqli_fetch_assoc($misi_query_run)): ?>
                            <li>
                              <?php echo htmlspecialchars($misi['isi']); ?>
                              <!-- Tombol untuk Edit Misi -->
                              <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editMisiModal<?php echo $misi['id']; ?>">Edit Misi</a>
                            </li>
                            <!-- Modal untuk Edit Misi -->
                            <div class="modal fade" id="editMisiModal<?php echo $misi['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editMisiModalLabel<?php echo $misi['id']; ?>" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editMisiModalLabel<?php echo $misi['id']; ?>">Edit Misi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="api.php" method="POST">
                                      <div class="form-group">
                                        <label for="isi_misi">Misi</label>
                                        <textarea class="form-control" id="isi_misi" name="isi_misi" rows="3" required><?php echo htmlspecialchars($misi['isi']); ?></textarea>
                                      </div>
                                      <input type="hidden" name="id_misi" value="<?php echo $misi['id']; ?>">
                                      <button type="submit" class="btn btn-primary" name="update_misi">Update Misi</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php endwhile; ?>
                        </ol>
                    </td>
                  </tr>
                </tbody>
              </table>
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">Edit</a>
              <?php else: ?>
              <p>Tidak ada data profil perusahaan yang tersedia.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Edit Profile -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editProfileModalLabel">Edit Profile Perusahaan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="api.php" method="POST">
              <div class="form-group">
                <label for="sejarah_perusahaan">Sejarah Perusahaan</label>
                <textarea class="form-control" id="sejarah_perusahaan" name="sejarah_perusahaan" rows="3" required><?php echo htmlspecialchars($profile['sejarah']); ?></textarea>
              </div>
              <div class="form-group">
                <label for="visi_perusahaan">Visi Perusahaan</label>
                <textarea class="form-control" id="visi_perusahaan" name="visi_perusahaan" rows="3" required><?php echo htmlspecialchars($profile['visi']); ?></textarea>
              </div>
              <button type="submit" class="btn btn-primary" name="update_profile">Update</button>
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
</div>
