<?php
session_start();
ob_start();  // Tambahkan ini untuk mengaktifkan output buffering
include('security.php');
include('includes/header.php');
include('includes/navbar.php');

// Cek jika user tidak login, redirect ke halaman login

// Cek jika user tidak login, redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Proses penyimpanan form
if (isset($_POST['update_why_us'])) {
    // proses penyimpanan data
    header("Location: index.php");
    exit();
}
ob_end_flush();  // Tambahkan ini untuk mengirim output yang sudah di-buffer

// Proses penyimpanan form
if (isset($_POST['update_why_us'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $icon1_title = $_POST['icon1_title'];
    $icon1_content = $_POST['icon1_content'];
    $icon2_title = $_POST['icon2_title'];
    $icon2_content = $_POST['icon2_content'];
    $icon3_title = $_POST['icon3_title'];
    $icon3_content = $_POST['icon3_content'];

    // Simpan data ke dalam file teks untuk penggunaan di frontend
    file_put_contents('why_us_data.txt', json_encode($_POST));

    // Redirect ke halaman utama setelah berhasil disimpan
    header("Location: index.php");
    exit();
}

// Ambil data dari file teks jika tersedia
$data = file_exists('why_us_data.txt') ? json_decode(file_get_contents('why_us_data.txt'), true) : [];

$title = isset($data['title']) ? $data['title'] : 'Why Choose Us?';
$content = isset($data['content']) ? $data['content'] : 'Default description.';
$icon1_title = isset($data['icon1_title']) ? $data['icon1_title'] : 'Icon 1 Title';
$icon1_content = isset($data['icon1_content']) ? $data['icon1_content'] : 'Default content for icon 1.';
$icon2_title = isset($data['icon2_title']) ? $data['icon2_title'] : 'Icon 2 Title';
$icon2_content = isset($data['icon2_content']) ? $data['icon2_content'] : 'Default content for icon 2.';
$icon3_title = isset($data['icon3_title']) ? $data['icon3_title'] : 'Icon 3 Title';
$icon3_content = isset($data['icon3_content']) ? $data['icon3_content'] : 'Default content for icon 3.';
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Section Why Us</h4>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" rows="4" required><?php echo htmlspecialchars($content); ?></textarea>
                        </div>

                        <h5>Icon 1</h5>
                        <div class="form-group">
                            <label for="icon1_title">Icon 1 Title</label>
                            <input type="text" class="form-control" name="icon1_title" value="<?php echo htmlspecialchars($icon1_title); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="icon1_content">Icon 1 Content</label>
                            <textarea class="form-control" name="icon1_content" rows="2" required><?php echo htmlspecialchars($icon1_content); ?></textarea>
                        </div>

                        <h5>Icon 2</h5>
                        <div class="form-group">
                            <label for="icon2_title">Icon 2 Title</label>
                            <input type="text" class="form-control" name="icon2_title" value="<?php echo htmlspecialchars($icon2_title); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="icon2_content">Icon 2 Content</label>
                            <textarea class="form-control" name="icon2_content" rows="2" required><?php echo htmlspecialchars($icon2_content); ?></textarea>
                        </div>

                        <h5>Icon 3</h5>
                        <div class="form-group">
                            <label for="icon3_title">Icon 3 Title</label>
                            <input type="text" class="form-control" name="icon3_title" value="<?php echo htmlspecialchars($icon3_title); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="icon3_content">Icon 3 Content</label>
                            <textarea class="form-control" name="icon3_content" rows="2" required><?php echo htmlspecialchars($icon3_content); ?></textarea>
                        </div>

                        <!-- Tombol Update dan Batal -->
                        <button type="submit" name="update_why_us" class="btn btn-primary">Update</button>
                        <a href="index.php" class="btn btn-secondary">Batal</a> <!-- Tombol Batal -->
                    </form>
                </div>
            </div>
        </div>
        <?php
        include('includes/footer.php');
        include('includes/scripts.php');
        ?>
    </div>
</div>

