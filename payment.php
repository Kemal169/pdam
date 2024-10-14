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
                    <h4 class="card-title">Input Payment Method</h4>
                    <p class="card-description">Masukkan metode pembayaran beserta logo/gambar.</p>
                    <form class="forms-sample" action="api.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama_payment">Nama Payment</label>
                            <input type="text" class="form-control" id="nama_payment" name="nama_payment" placeholder="Contoh: GoPay, Dana" required>
                        </div>
                        <div class="form-group">
                            <label>Upload Gambar Payment</label>
                            <div class="input-group col-xs-12">
                                <input type="file" name="gambar_payment" class="file-upload-default" required />
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" />
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        <button type="submit" name="submitpayment" class="btn btn-gradient-primary mr-2">Submit</button>
                        <button type="reset" class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Menampilkan daftar payment yang sudah dimasukkan dalam layout grid -->
        <div class="col-12 grid-margin stretch-card mt-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Metode Pembayaran</h4>
                    <div class="row">
                        <?php
                        $query = "SELECT * FROM tb_payment";
                        $query_run = mysqli_query($connection, $query);
                        $no = 1;

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($payment = mysqli_fetch_assoc($query_run)) {
                        ?>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card">
                                    <img src="payment/<?php echo $payment['gambar_payment']; ?>" class="card-img-top" alt="<?php echo $payment['nama_payment']; ?>" style="width: 100%; height: auto;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($payment['nama_payment']); ?></h5>
                                        <form action="api.php" method="POST" style="display:inline-block;">
                                            <input type="hidden" name="delete_id" value="<?php echo $payment['id']; ?>">
                                            <button type="submit" name="delete_payment" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus metode pembayaran ini?');">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        } else {
                        ?>
                            <div class="col-12 text-center">
                                <p>Tidak ada metode pembayaran yang tersedia</p>
                            </div>
                        <?php
                        }
                        ?>
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
