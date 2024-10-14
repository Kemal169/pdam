<?php 
include('includes/header_frontend.php');
include('includes/navbar_frontend.php');
include('database/dbconfig.php');

// Query untuk mengambil data dari tabel tarif_air
$query_tarif = "SELECT * FROM tarif_air";
$query_tarif_run = mysqli_query($connection, $query_tarif);
?>

<div class="breadcrumbs" data-aos="fade-in">
  <div class="container">
    <h2><strong>Tarif Air</strong></h2>
    <p>Berikut adalah tarif air berdasarkan kelompok dan klasifikasi.</p>
  </div>
</div><!-- End Breadcrumbs -->

<section id="tarif" class="tarif">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Daftar Tarif Air</h2>
      <p>Tarif Air per Kelompok dan Klasifikasi</p>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Kelompok</th>
          <th>Klasifikasi</th>
          <th>Pemakaian 0-10 m<sup>3</sup></th>
          <th>Pemakaian 11-20 m<sup>3</sup></th>
          <th>Pemakaian 21-30 m<sup>3</sup></th>
          <th>Pemakaian >30 m<sup>3</sup></th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (mysqli_num_rows($query_tarif_run) > 0) {
            while ($tarif = mysqli_fetch_assoc($query_tarif_run)) {
                $kelompok = ($tarif['kelompok'] === 'komersial' || $tarif['kelompok'] === 'non-komersial') ? 'Tarif Kesepakatan' : htmlspecialchars($tarif['kelompok']);
                $pemakaian_0_10 = $tarif['pemakaian_0_10'] === null ? '—' : htmlspecialchars($tarif['pemakaian_0_10']);
                $pemakaian_11_20 = $tarif['pemakaian_11_20'] === null ? '—' : htmlspecialchars($tarif['pemakaian_11_20']);
                $pemakaian_21_30 = $tarif['pemakaian_21_30'] === null ? '—' : htmlspecialchars($tarif['pemakaian_21_30']);
                $pemakaian_gt_30 = $tarif['pemakaian_gt_30'] === null ? '—' : htmlspecialchars($tarif['pemakaian_gt_30']);
        ?>
        <tr>
          <td><?php echo htmlspecialchars($tarif['id']); ?></td>
          <td><?php echo $kelompok; ?></td>
          <td><?php echo htmlspecialchars($tarif['klasifikasi']); ?></td>
          <td><?php echo $pemakaian_0_10; ?></td>
          <td><?php echo $pemakaian_11_20; ?></td>
          <td><?php echo $pemakaian_21_30; ?></td>
          <td><?php echo $pemakaian_gt_30; ?></td>
        </tr>
        <?php
            }
        } else {
            echo '<tr><td colspan="7">Belum ada data tarif air tersedia.</td></tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</section><!-- End Tarif Section -->

<section id="hitung-tarif" class="hitung-tarif">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Hitung Tarif Air</h2>
      <p>Masukkan jumlah pemakaian air untuk menghitung total biaya.</p>
    </div>

    <form method="post" action="">
        <label for="pemakaian">Masukkan Pemakaian Air (m³):</label>
        <input type="number" name="pemakaian" id="pemakaian" required>
        <br><br>

        <!-- Tambahkan dropdown untuk memilih klasifikasi -->
        <label for="klasifikasi">Pilih Klasifikasi Tarif Air:</label>
        <select name="klasifikasi" id="klasifikasi" required>
            <option value="">Pilih Klasifikasi</option>
            <?php
            // Ambil data klasifikasi dari database untuk diisi di dropdown
            $query_klasifikasi = "SELECT DISTINCT klasifikasi FROM tarif_air";
            $query_klasifikasi_run = mysqli_query($connection, $query_klasifikasi);
            if (mysqli_num_rows($query_klasifikasi_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_klasifikasi_run)) {
                    echo '<option value="' . htmlspecialchars($row['klasifikasi']) . '">' . htmlspecialchars($row['klasifikasi']) . '</option>';
                }
            } else {
                echo '<option value="">Tidak ada klasifikasi tersedia</option>';
            }
            ?>
        </select>
        <br><br>

        <input type="submit" name="submit" value="Hitung">
        <!-- Tambahkan tombol reset -->
        <input type="reset" value="Reset" style="margin-left: 10px;">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil input dari form
        $pemakaian = $_POST['pemakaian'];
        $klasifikasi = $_POST['klasifikasi'];
        
        // Query untuk mengambil tarif berdasarkan klasifikasi yang dipilih
        $query_tarif_selected = "SELECT * FROM tarif_air WHERE klasifikasi = '$klasifikasi'";
        $query_tarif_selected_run = mysqli_query($connection, $query_tarif_selected);
        
        if (mysqli_num_rows($query_tarif_selected_run) > 0) {
            $tarif = mysqli_fetch_assoc($query_tarif_selected_run);

            // Hitung tarif sesuai dengan kelompok yang dipilih
            $tarif_0_10 = $tarif['pemakaian_0_10'];
            $tarif_11_20 = $tarif['pemakaian_11_20'];
            $tarif_21_30 = $tarif['pemakaian_21_30'];
            $tarif_gt_30 = $tarif['pemakaian_gt_30'];

            // Definisikan tarif per 10 m³
            $tarif_array = [
                [10, $tarif_0_10],  // 10 m³ pertama
                [10, $tarif_11_20],  // 10 m³ kedua
                [10, $tarif_21_30],  // 10 m³ ketiga
                [null, $tarif_gt_30] // Sisanya (lebih dari 30 m³)
            ];

            // Hitung biaya berdasarkan pemakaian
            $total_biaya = 0;
            $sisa_pemakaian = $pemakaian;

            foreach ($tarif_array as $t) {
                $jumlah_m3 = $t[0];
                $harga_per_m3 = $t[1];
                
                // Jika jumlah_m3 adalah null, itu berarti sisa pemakaian
                if ($jumlah_m3 === null) {
                    $jumlah_m3 = $sisa_pemakaian;
                }

                // Hitung pemakaian yang bisa diambil dari tarif
                $pemakaian_terpakai = min($jumlah_m3, $sisa_pemakaian);
                $biaya = $pemakaian_terpakai * $harga_per_m3;
                $total_biaya += $biaya;

                // Kurangi pemakaian yang sudah dihitung
                $sisa_pemakaian -= $pemakaian_terpakai;
                
                // Jika sisa pemakaian sudah habis, keluar dari loop
                if ($sisa_pemakaian <= 0) {
                    break;
                }
            }

            // Tambahkan biaya administrasi
            $biaya_administrasi = 7500;
            $total_biaya += $biaya_administrasi;

            // Tampilkan hasil
            echo "<h3>Hasil Perhitungan:</h3>";
            echo "Pemakaian air: " . $pemakaian . " m³<br>";
            echo "Klasifikasi: " . htmlspecialchars($klasifikasi) . "<br>";
            echo "Total biaya (termasuk administrasi): Rp " . number_format($total_biaya, 2, ',', '.') . "<br>";
        } else {
            echo "Klasifikasi tidak ditemukan.";
        }
    }
    ?>

  </div>
</section><!-- End Hitung Tarif Section -->


<?php 
include('includes/footer_frontend.php');
include('includes/scripts_frontend.php');
?>
