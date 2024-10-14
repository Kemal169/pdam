<?php
session_start();
include('database/dbconfig.php');

if(isset($_POST['registerbtn'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Meng-hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Periksa apakah file sudah dipilih
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
        $profile = $_FILES['profile']['name'];
        $target_dir = "profile/";
        $target_file = $target_dir . basename($_FILES["profile"]["name"]);

        // Cek apakah file berhasil diupload
        if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {
            $query = "INSERT INTO tb_user (nama, username, password, profile) VALUES ('$name', '$username', '$hashed_password', '$profile')";
            $query_run = mysqli_query($connection, $query);

            if($query_run) {
                $_SESSION['status'] = "Registrasi berhasil!";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            } else {
                $_SESSION['status'] = "Registrasi gagal.";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');
            }
        } else {
            $_SESSION['status'] = "Upload gambar gagal.";
            $_SESSION['status_code'] = "error";
            header('Location: register.php');
        }
    } else {
        $_SESSION['status'] = "Akses tidak valid: File gambar tidak ditemukan atau error.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }
}

if (isset($_POST['submitberita'])) {
    // Ambil data dari form
    $judul = $_POST['judul'];
    $tanggal_input = $_POST['tanggal_input'];
    $deskripsi_berita = $_POST['deskripsi_berita'];

    // Tangani upload file
    $foto = '';
    if ($_FILES["foto"]["name"] != '') {
        $loc = $_FILES['foto']['tmp_name'];
        $des = "uploads/" . $_FILES['foto']['name']; // Pastikan folder 'uploads' ada dan dapat ditulis

        if (move_uploaded_file($loc, $des)) {
            $foto = $_FILES['foto']['name'];
            $_SESSION['status'] = "Berita berhasil ditambahkan. Foto berhasil di-upload.";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Berita berhasil ditambahkan. Namun, foto gagal di-upload.";
            $_SESSION['status_code'] = "warning";
        }
    } else {
        $_SESSION['status'] = "Berita berhasil ditambahkan tanpa foto.";
        $_SESSION['status_code'] = "success";
    }

    // Query untuk menyimpan data ke dalam tabel `tb_berita`
    $query = "INSERT INTO tb_berita (judul, tanggal_input, deskripsi_berita, foto) VALUES ('$judul', '$tanggal_input', '$deskripsi_berita', '$foto')";
    $query_run = mysqli_query($connection, $query);

    if (!$query_run) {
        $_SESSION['status'] = "Gagal menambahkan berita.";
        $_SESSION['status_code'] = "error";
    }
    
    header('Location: berita.php');
    exit();
}


$_SESSION['status'] = "Akses tidak valid.";
$_SESSION['status_code'] = "error";
header('Location: register.php');


if (isset($_POST['update_berita'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $tanggal_input = $_POST['tanggal_input'];
    $deskripsi_berita = $_POST['deskripsi_berita'];

    // Update jika ada file foto yang baru
    if (isset($_FILES['foto']) && $_FILES['foto']['name'] != "") {
        $foto = $_FILES['foto']['name'];
        $path = "uploads/" . basename($foto);
        move_uploaded_file($_FILES['foto']['tmp_name'], $path);

        // Update query termasuk foto
        $query = "UPDATE tb_berita SET judul='$judul', tanggal_input='$tanggal_input', deskripsi_berita='$deskripsi_berita', foto='$foto' WHERE id='$id'";
    } else {
        // Update query tanpa foto
        $query = "UPDATE tb_berita SET judul='$judul', tanggal_input='$tanggal_input', deskripsi_berita='$deskripsi_berita' WHERE id='$id'";
    }

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Berita berhasil diupdate";
        $_SESSION['status_code'] = "success";
        header('Location: tampil_berita.php');
    } else {
        $_SESSION['status'] = "Berita gagal diupdate";
        $_SESSION['status_code'] = "error";
        header('Location: tampil_berita.php');
    }
}

// Menangani proses update profil perusahaan
if (isset($_POST['update_profile'])) {
    $sejarah = mysqli_real_escape_string($connection, $_POST['sejarah_perusahaan']);
    $visi = mysqli_real_escape_string($connection, $_POST['visi_perusahaan']);

    $update_query = "UPDATE tb_profile SET sejarah='$sejarah', visi='$visi' WHERE id=1";
    if (mysqli_query($connection, $update_query)) {
        $_SESSION['status'] = 'Data profil perusahaan berhasil diperbarui.';
        $_SESSION['status_code'] = 'success';
    } else {
        $_SESSION['status'] = 'Gagal memperbarui data profil perusahaan.';
        $_SESSION['status_code'] = 'danger';
    }
    // Redirect untuk menghindari pengiriman ulang form saat refresh
    header('Location: sejarah_perusahaan.php');
    exit();
}

// Menangani proses update misi perusahaan
if (isset($_POST['update_misi'])) {
    $id_misi = mysqli_real_escape_string($connection, $_POST['id_misi']);
    $isi_misi = mysqli_real_escape_string($connection, $_POST['isi_misi']);

    $update_misi_query = "UPDATE tb_misi SET isi='$isi_misi' WHERE id='$id_misi'";
    if (mysqli_query($connection, $update_misi_query)) {
        $_SESSION['status'] = 'Misi perusahaan berhasil diperbarui.';
        $_SESSION['status_code'] = 'success';
    } else {
        $_SESSION['status'] = 'Gagal memperbarui misi perusahaan.';
        $_SESSION['status_code'] = 'danger';
    }
    // Redirect untuk menghindari pengiriman ulang form saat refresh
    header('Location: sejarah_perusahaan.php');
    
}


if (isset($_POST['submitpayment'])) {
    $nama_payment = mysqli_real_escape_string($connection, $_POST['nama_payment']);
    
    // Upload gambar
    $gambar_payment = $_FILES['gambar_payment']['name'];
    $target_dir = "payment/";
    $target_file = $target_dir . basename($gambar_payment);

    if (move_uploaded_file($_FILES['gambar_payment']['tmp_name'], $target_file)) {
        $query = "INSERT INTO tb_payment (nama_payment, gambar_payment) VALUES ('$nama_payment', '$gambar_payment')";
        if (mysqli_query($connection, $query)) {
            $_SESSION['status'] = 'Metode pembayaran berhasil ditambahkan.';
            $_SESSION['status_code'] = 'success';
        } else {
            $_SESSION['status'] = 'Gagal menambahkan metode pembayaran.';
            $_SESSION['status_code'] = 'danger';
        }
    } else {
        $_SESSION['status'] = 'Gagal mengupload gambar.';
        $_SESSION['status_code'] = 'danger';
    }

    header('Location: payment.php');
    exit();
}

// Logika untuk menghapus data payment
if (isset($_POST['delete_payment'])) {
    $delete_id = $_POST['delete_id'];

    // Ambil nama file gambar sebelum data dihapus
    $query = "SELECT gambar_payment FROM tb_payment WHERE id = '$delete_id'";
    $query_run = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($query_run);

    // Nama file gambar yang akan dihapus
    $gambar = $row['gambar_payment'];

    // Path ke gambar
    $file_path = "payment/" . $gambar;  // Ubah "uploads/" sesuai folder tempat file disimpan

    // Cek apakah file gambar ada dan hapus
    if (file_exists($file_path) && !empty($gambar)) {
        unlink($file_path);  // Hapus file gambar
    }

    // Setelah gambar dihapus, lanjutkan penghapusan data dari database
    $query = "DELETE FROM tb_payment WHERE id = '$delete_id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Payment method and its image deleted successfully!";
        $_SESSION['status_code'] = "success";
        header("Location: payment.php");
    } else {
        $_SESSION['status'] = "Error deleting payment method!";
        $_SESSION['status_code'] = "error";
        header("Location: payment.php");
    }
}


// Logika untuk menghapus berita
if (isset($_POST['delete_berita'])) {
    $delete_id = $_POST['delete_id'];

    // Ambil nama gambar sebelum data dihapus
    $query = "SELECT foto FROM tb_berita WHERE id = '$delete_id'";
    $query_run = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($query_run);

    // Nama gambar yang akan dihapus
    $gambar = $row['foto'];

    // Path ke gambar
    $file_path = "uploads/" . $gambar;

    // Cek apakah file gambar ada dan hapus
    if (file_exists($file_path) && !empty($gambar)) {
        unlink($file_path); // Hapus file gambar
    }

    // Setelah gambar dihapus, hapus data dari database
    $query = "DELETE FROM tb_berita WHERE id = '$delete_id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Berita dan gambarnya berhasil dihapus!";
        $_SESSION['status_code'] = "success";
        header("Location: tampil_berita.php");
    } else {
        $_SESSION['status'] = "Error saat menghapus berita!";
        $_SESSION['status_code'] = "error";
        header("Location: tampil_berita.php");
    }
}

if (isset($_POST['submitgambar'])) {
    $judul_pertama = $_POST['judul_pertama'];
    $judul_kedua = $_POST['judul_kedua'];
    $link = $_POST['link'];
    
    // Handling file upload
    $gambar = $_FILES['gambar_hero']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);

    if (move_uploaded_file($_FILES['gambar_hero']['tmp_name'], $target_file)) {
        $query = "INSERT INTO tb_gambar (gambar1, judul_pertama, judul_kedua, link) VALUES ('$gambar', '$judul_pertama', '$judul_kedua', '$link')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            $_SESSION['status'] = "Gambar berhasil diupload";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Gagal mengupload gambar";
            $_SESSION['status_code'] = "error";
        }
    } else {
        $_SESSION['status'] = "Error saat mengupload gambar";
        $_SESSION['status_code'] = "error";
    }
    header('Location: input_gambar.php');
}

// Logika Edit Gambar Hero
if (isset($_POST['updategambar'])) {
    $id = $_POST['id'];
    $judul_pertama = $_POST['judul_pertama'];
    $judul_kedua = $_POST['judul_kedua'];
    $link = $_POST['link'];

    // Cek apakah ada file gambar baru yang diupload
    if ($_FILES['gambar_hero']['name'] != "") {
        $gambar = $_FILES['gambar_hero']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar);

        // Upload gambar baru
        if (move_uploaded_file($_FILES['gambar_hero']['tmp_name'], $target_file)) {
            // Menghapus gambar lama dari direktori
            $query_old = "SELECT gambar1 FROM tb_gambar WHERE id = '$id'";
            $query_old_run = mysqli_query($connection, $query_old);
            $old_data = mysqli_fetch_assoc($query_old_run);
            $old_gambar = $old_data['gambar1'];
            if (file_exists("uploads/" . $old_gambar)) {
                unlink("uploads/" . $old_gambar); // Hapus gambar lama
            }

            // Update database dengan gambar baru
            $query = "UPDATE tb_gambar SET gambar1 = '$gambar', judul_pertama = '$judul_pertama', judul_kedua = '$judul_kedua', link = '$link' WHERE id = '$id'";
        }
    } else {
        // Jika tidak ada gambar baru, hanya update judul dan link
        $query = "UPDATE tb_gambar SET judul_pertama = '$judul_pertama', judul_kedua = '$judul_kedua', link = '$link' WHERE id = '$id'";
    }

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Data berhasil diperbarui";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Gagal memperbarui data";
        $_SESSION['status_code'] = "error";
    }
    header('Location: input_gambar.php');
}

// Logika Delete Gambar Hero
if (isset($_POST['delete_gambar'])) {
    $id = $_POST['delete_id'];

    // Menghapus gambar dari direktori
    $query_old = "SELECT gambar1 FROM tb_gambar WHERE id = '$id'";
    $query_old_run = mysqli_query($connection, $query_old);
    $old_data = mysqli_fetch_assoc($query_old_run);
    $old_gambar = $old_data['gambar1'];
    if (file_exists("uploads/" . $old_gambar)) {
        unlink("uploads/" . $old_gambar); // Hapus gambar dari folder
    }

    // Hapus data dari database
    $query = "DELETE FROM tb_gambar WHERE id = '$id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Gambar berhasil dihapus";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Gagal menghapus gambar";
        $_SESSION['status_code'] = "error";
    }
    header('Location: input_gambar.php');
}

if (isset($_POST['submitkelompokdetail'])) {
    $klasifikasi_id = $_POST['klasifikasi_id'];
    $detail = $_POST['detail'];

    $query = "INSERT INTO kelompok_detail (klasifikasi_id, detail) VALUES ('$klasifikasi_id', '$detail')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Data berhasil ditambahkan";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Data gagal ditambahkan";
        $_SESSION['status_code'] = "error";
    }
    header("Location: kelompok_detail.php");
}

if (isset($_POST['updatekelompokdetail'])) {
    $id = $_POST['id'];
    $klasifikasi_id = $_POST['klasifikasi_id'];
    $detail = $_POST['detail'];

    $query = "UPDATE kelompok_detail SET klasifikasi_id='$klasifikasi_id', detail='$detail' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Data berhasil diupdate";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Data gagal diupdate";
        $_SESSION['status_code'] = "error";
    }
    header("Location: kelompok_detail.php");
}

if (isset($_POST['delete_kelompokdetail'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM kelompok_detail WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Data berhasil dihapus";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Data gagal dihapus";
        $_SESSION['status_code'] = "error";
    }
    header("Location: kelompok_detail.php");
}

?>
