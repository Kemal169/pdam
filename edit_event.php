<?php
session_start();
ob_start();  // Output buffering
include('security.php');
include('includes/header.php');
include('includes/navbar.php');

// Cek jika user tidak login, redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Proses penyimpanan form
if (isset($_POST['update_event'])) {
    $event1_title = $_POST['event1_title'];
    $event1_date = $_POST['event1_date'];
    $event1_content = $_POST['event1_content'];
    $event1_image = $_POST['event1_image'];

    $event2_title = $_POST['event2_title'];
    $event2_date = $_POST['event2_date'];
    $event2_content = $_POST['event2_content'];
    $event2_image = $_POST['event2_image'];

    $event3_title = $_POST['event3_title'];
    $event3_date = $_POST['event3_date'];
    $event3_content = $_POST['event3_content'];
    $event3_image = $_POST['event3_image'];

    $event4_title = $_POST['event4_title'];
    $event4_date = $_POST['event4_date'];
    $event4_content = $_POST['event4_content'];
    $event4_image = $_POST['event4_image'];

    // Simpan data ke dalam file teks
    file_put_contents('events_data.txt', json_encode($_POST));

    // Redirect ke halaman utama setelah berhasil disimpan
    header("Location: index.php");
    exit();
}

// Ambil data dari file teks jika tersedia
$data = file_exists('events_data.txt') ? json_decode(file_get_contents('events_data.txt'), true) : [];

// Event 1
$event1_title = isset($data['event1_title']) ? $data['event1_title'] : 'Introduction to webdesign';
$event1_date = isset($data['event1_date']) ? $data['event1_date'] : 'Sunday, September 26th at 7:00 pm';
$event1_content = isset($data['event1_content']) ? $data['event1_content'] : 'Lorem ipsum dolor sit amet...';
$event1_image = isset($data['event1_image']) ? $data['event1_image'] : 'assets/img/events-1.jpg';

// Event 2
$event2_title = isset($data['event2_title']) ? $data['event2_title'] : 'Marketing Strategies';
$event2_date = isset($data['event2_date']) ? $data['event2_date'] : 'Sunday, November 15th at 7:00 pm';
$event2_content = isset($data['event2_content']) ? $data['event2_content'] : 'Sed ut perspiciatis unde omnis...';
$event2_image = isset($data['event2_image']) ? $data['event2_image'] : 'assets/img/events-2.jpg';

// Event 3
$event3_title = isset($data['event3_title']) ? $data['event3_title'] : 'Workshop on AI';
$event3_date = isset($data['event3_date']) ? $data['event3_date'] : 'Sunday, October 10th at 6:00 pm';
$event3_content = isset($data['event3_content']) ? $data['event3_content'] : 'Duis aute irure dolor in reprehenderit...';
$event3_image = isset($data['event3_image']) ? $data['event3_image'] : 'assets/img/events-3.jpg';

// Event 4
$event4_title = isset($data['event4_title']) ? $data['event4_title'] : 'Startup Seminar';
$event4_date = isset($data['event4_date']) ? $data['event4_date'] : 'Sunday, December 20th at 5:00 pm';
$event4_content = isset($data['event4_content']) ? $data['event4_content'] : 'Excepteur sint occaecat cupidatat non proident...';
$event4_image = isset($data['event4_image']) ? $data['event4_image'] : 'assets/img/events-4.jpg';
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Events</h4>
                    <form method="POST" action="">
                        <!-- Event 1 -->
                        <h5>Event 1</h5>
                        <div class="form-group">
                            <label for="event1_title">Title</label>
                            <input type="text" class="form-control" name="event1_title" value="<?php echo htmlspecialchars($event1_title); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="event1_date">Date</label>
                            <input type="text" class="form-control" name="event1_date" value="<?php echo htmlspecialchars($event1_date); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="event1_content">Content</label>
                            <textarea class="form-control" name="event1_content" rows="4" required><?php echo htmlspecialchars($event1_content); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="event1_image">Image URL</label>
                            <input type="text" class="form-control" name="event1_image" value="<?php echo htmlspecialchars($event1_image); ?>" required>
                        </div>

                        <!-- Event 2 -->
                        <h5>Event 2</h5>
                        <div class="form-group">
                            <label for="event2_title">Title</label>
                            <input type="text" class="form-control" name="event2_title" value="<?php echo htmlspecialchars($event2_title); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="event2_date">Date</label>
                            <input type="text" class="form-control" name="event2_date" value="<?php echo htmlspecialchars($event2_date); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="event2_content">Content</label>
                            <textarea class="form-control" name="event2_content" rows="4" required><?php echo htmlspecialchars($event2_content); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="event2_image">Image URL</label>
                            <input type="text" class="form-control" name="event2_image" value="<?php echo htmlspecialchars($event2_image); ?>" required>
                        </div>

                        <!-- Event 3 -->
                        <h5>Event 3</h5>
                        <div class="form-group">
                            <label for="event3_title">Title</label>
                            <input type="text" class="form-control" name="event3_title" value="<?php echo htmlspecialchars($event3_title); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="event3_date">Date</label>
                            <input type="text" class="form-control" name="event3_date" value="<?php echo htmlspecialchars($event3_date); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="event3_content">Content</label>
                            <textarea class="form-control" name="event3_content" rows="4" required><?php echo htmlspecialchars($event3_content); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="event3_image">Image URL</label>
                            <input type="text" class="form-control" name="event3_image" value="<?php echo htmlspecialchars($event3_image); ?>" required>
                        </div>

                        <!-- Event 4 -->
                        <h5>Event 4</h5>
                        <div class="form-group">
                            <label for="event4_title">Title</label>
                            <input type="text" class="form-control" name="event4_title" value="<?php echo htmlspecialchars($event4_title); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="event4_date">Date</label>
                            <input type="text" class="form-control" name="event4_date" value="<?php echo htmlspecialchars($event4_date); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="event4_content">Content</label>
                            <textarea class="form-control" name="event4_content" rows="4" required><?php echo htmlspecialchars($event4_content); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="event4_image">Image URL</label>
                            <input type="text" class="form-control" name="event4_image" value="<?php echo htmlspecialchars($event4_image); ?>" required>
                        </div>

                        <button type="submit" name="update_event" class="btn btn-primary">Update Events</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
