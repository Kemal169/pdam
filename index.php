<?php 
include ('includes/header_frontend.php');
include ('includes/navbar_frontend.php');
include('database/dbconfig.php');

$page_title = 'Beranda';

$data = file_exists('why_us_data.txt') ? json_decode(file_get_contents('why_us_data.txt'), true) : [];

$title = isset($data['title']) ? $data['title'] : 'Why Choose Us?';
$content = isset($data['content']) ? $data['content'] : 'Default description.';
$icon1_title = isset($data['icon1_title']) ? $data['icon1_title'] : 'Icon 1 Title';
$icon1_content = isset($data['icon1_content']) ? $data['icon1_content'] : 'Default content for icon 1.';
$icon2_title = isset($data['icon2_title']) ? $data['icon2_title'] : 'Icon 2 Title';
$icon2_content = isset($data['icon2_content']) ? $data['icon2_content'] : 'Default content for icon 2.';
$icon3_title = isset($data['icon3_title']) ? $data['icon3_title'] : 'Icon 3 Title';
$icon3_content = isset($data['icon3_content']) ? $data['icon3_content'] : 'Default content for icon 3.';

// Query untuk mengambil data payment
$query = "SELECT * FROM tb_payment";
$query_run = mysqli_query($connection, $query);
// Query untuk mengambil 3 berita terbaru dari tb_berita
$query_berita = "SELECT * FROM tb_berita ORDER BY tanggal_input DESC LIMIT 3";
$query_berita_run = mysqli_query($connection, $query_berita);
// Query untuk mengambil data dari tabel tb_gambar
$query_gambar_hero = "SELECT * FROM tb_gambar";
$query_gambar_hero_run = mysqli_query($connection, $query_gambar_hero);

// Ambil data event dari file teks
$dataevents = file_exists('events_data.txt') ? json_decode(file_get_contents('events_data.txt'), true) : [];

$event1_title = isset($dataevents['event1_title']) ? $dataevents['event1_title'] : 'Introduction to webdesign';
$event1_date = isset($dataevents['event1_date']) ? $dataevents['event1_date'] : 'Sunday, September 26th at 7:00 pm';
$event1_content = isset($dataevents['event1_content']) ? $dataevents['event1_content'] : 'Lorem ipsum dolor sit amet...';
$event1_image = isset($dataevents['event1_image']) ? $dataevents['event1_image'] : 'assets/img/events-1.jpg';

$event2_title = isset($dataevents['event2_title']) ? $dataevents['event2_title'] : 'Marketing Strategies';
$event2_date = isset($dataevents['event2_date']) ? $dataevents['event2_date'] : 'Sunday, November 15th at 7:00 pm';
$event2_content = isset($dataevents['event2_content']) ? $dataevents['event2_content'] : 'Sed ut perspiciatis unde omnis...';
$event2_image = isset($dataevents['event2_image']) ? $dataevents['event2_image'] : 'assets/img/events-2.jpg';
?>

<body>
    <main id="">
        <section id="hero" class="d-flex justify-content-center align-items-center">
            <div class="swiper hero-slider">
                <div class="swiper-wrapper">
                    <?php
                    // Mengecek apakah data tersedia
                    if (mysqli_num_rows($query_gambar_hero_run) > 0) {
                        while ($hero_image = mysqli_fetch_assoc($query_gambar_hero_run)) {
                            ?>
                            <!-- Menampilkan setiap slide dengan gambar dari database -->
                            <div class="swiper-slide" style="background-image: url('uploads/<?php echo htmlspecialchars($hero_image['gambar1']); ?>');">
                                <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
                                    <h1><?php echo htmlspecialchars($hero_image['judul_pertama']); ?></h1>
                                    <h2><?php echo htmlspecialchars($hero_image['judul_kedua']); ?></h2>
                                    <a href="<?php echo htmlspecialchars($hero_image['link']); ?>" class="btn-get-started">Get Started</a>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<p>No images available for the hero section.</p>';
                    }
                    ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>


        <section id="why-us" class="why-us">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="content">
                            <h3><?php echo htmlspecialchars($title); ?></h3>
                            <p><?php echo htmlspecialchars($content); ?></p>
                            <div class="text-center">
                                <a href="about.php" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-receipt"></i>
                                        <!-- Membungkus h4 dengan a -->
                                        <a href="https://www.pdamsukoharjo.com/"><h4><?php echo htmlspecialchars($icon1_title); ?></h4></a>
                                        <p><?php echo htmlspecialchars($icon1_content); ?></p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-cube-alt"></i>
                                        <!-- Membungkus h4 dengan a -->
                                        <a href="contact.php"><h4><?php echo htmlspecialchars($icon2_title); ?></h4></a>
                                        <p><?php echo htmlspecialchars($icon2_content); ?></p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-images"></i>
                                        <!-- Membungkus h4 dengan a -->
                                        <a href="tarif.php"><h4><?php echo htmlspecialchars($icon3_title); ?></h4></a>
                                        <p><?php echo htmlspecialchars($icon3_content); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="popular-courses" class="courses">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Berita</h2>
                    <p>Berita Terbaru</p>
                </div>

                <div class="row" data-aos="zoom-in" data-aos-delay="100">
                    <?php
                    if (mysqli_num_rows($query_berita_run) > 0) {
                        while ($berita = mysqli_fetch_assoc($query_berita_run)) {
                    ?>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="course-item">
                            <img src="uploads/<?php echo htmlspecialchars($berita['foto']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($berita['judul']); ?>">
                            <div class="course-content">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4><?php echo htmlspecialchars($berita['tanggal_input']); ?></h4>
                                </div>
                                <h3><a href="courses.php"><?php echo htmlspecialchars($berita['judul']); ?></a></h3>
                                <p>
                                    <?php echo htmlspecialchars(substr($berita['deskripsi_berita'], 0, 100)); ?>...
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                        echo '<p>Belum ada berita tersedia.</p>';
                    }
                    ?>
                </div>
            </div>
        </section>

        <!-- ======= Events Section ======= -->
        <section id="events" class="events">
        <div class="container" data-aos="fade-up">
            <div class="row">
            <div class="col-md-6 d-flex align-items-stretch">
                <div class="card">
                <div class="card-img">
                    <img src="assets/img/events-1.jpg" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><a href="">Introduction to webdesign</a></h5>
                    <p class="fst-italic text-center">Sunday, September 26th at 7:00 pm</p>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                </div>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-stretch">
                <div class="card">
                <div class="card-img">
                    <img src="assets/img/events-2.jpg" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><a href="">Marketing Strategies</a></h5>
                    <p class="fst-italic text-center">Sunday, November 15th at 7:00 pm</p>
                    <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo</p>
                </div>
                </div>
            </div>
            <br>
            <div class="col-md-6 d-flex align-items-stretch">
                <div class="card">
                <div class="card-img">
                    <img src="assets/img/events-2.jpg" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><a href="">Marketing Strategies</a></h5>
                    <p class="fst-italic text-center">Sunday, November 15th at 7:00 pm</p>
                    <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo</p>
                </div>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-stretch">
                <div class="card">
                <div class="card-img">
                    <img src="assets/img/events-2.jpg" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><a href="">Marketing Strategies</a></h5>
                    <p class="fst-italic text-center">Sunday, November 15th at 7:00 pm</p>
                    <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo</p>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section><!-- End Events Section -->

        <section id="testimonials" class="testimonials">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Our Partners</h2>
                    <p>Meet our payment partners</p>
                </div>

                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($payment = mysqli_fetch_assoc($query_run)) {
                        ?>
                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="payment/<?php echo htmlspecialchars($payment['gambar_payment']); ?>" class="testimonial-img" alt="<?php echo htmlspecialchars($payment['nama_payment']); ?>">
                                    <h3><?php echo htmlspecialchars($payment['nama_payment']); ?></h3>
                                    <h4>Payment Partner</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Partnered with PDAM Tirta Makmur to provide smooth payment transactions.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->
                        <?php
                            }
                        } else {
                            echo '<p>No payment partners available.</p>';
                        }
                        ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section><!-- End Our Partners Section -->

      </main>
</body>

<?php 
include ('includes/scripts_frontend.php');
include ('includes/footer_frontend.php');
?>