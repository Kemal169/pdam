<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
include('database/dbconfig.php');
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

        <!-- Form untuk input kelompok_detail -->
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Input Kelompok Detail</h4>
                    <form class="forms-sample" action="api.php" method="POST">
                        <div class="form-group">
                            <label for="klasifikasi_id">Klasifikasi ID</label>
                            <input type="number" class="form-control" id="klasifikasi_id" name="klasifikasi_id" placeholder="Masukkan Klasifikasi ID" required>
                        </div>
                        <div class="form-group">
                            <label for="detail">Detail</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="Masukkan Detail" required>
                        </div>
                        <button type="submit" name="submitkelompokdetail" class="btn btn-gradient-primary mr-2">Submit</button>
                        <button type="reset" class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Menampilkan daftar kelompok_detail dengan layout grid -->
        <div class="row mt-4">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Kelompok Detail</h4>
                        <div class="row">
                            <?php
                            $query = "SELECT * FROM kelompok_detail";
                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($detail = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5><?php echo htmlspecialchars($detail['detail']); ?></h5>
                                                <p>Klasifikasi ID: <?php echo htmlspecialchars($detail['klasifikasi_id']); ?></p>

                                                <!-- Tombol Edit -->
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?php echo $detail['id']; ?>">
                                                    Edit
                                                </button>

                                                <!-- Tombol Delete -->
                                                <form action="api.php" method="POST" style="display:inline-block;" class="mt-2">
                                                    <input type="hidden" name="delete_id" value="<?php echo $detail['id']; ?>">
                                                    <button type="submit" name="delete_kelompokdetail" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus detail ini?');">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal<?php echo $detail['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Kelompok Detail</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="api.php" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $detail['id']; ?>">
                                                        <div class="form-group">
                                                            <label for="klasifikasi_id">Klasifikasi ID</label>
                                                            <input type="number" class="form-control" id="klasifikasi_id" name="klasifikasi_id" value="<?php echo $detail['klasifikasi_id']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="detail">Detail</label>
                                                            <input type="text" class="form-control" id="detail" name="detail" value="<?php echo $detail['detail']; ?>" required>
                                                        </div>
                                                        <button type="submit" name="updatekelompokdetail" class="btn btn-gradient-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="col-12">
                                    <p class="text-center">Tidak ada detail yang tersedia</p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
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
