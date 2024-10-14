<?php 
include('includes/header_frontend.php');
include('includes/navbar_frontend.php');
?>

<div class="breadcrumbs" data-aos="fade-in">
  <div class="container">
    <h2><strong>Hubungi Kami</strong></h2>
    <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
  </div>
</div><!-- End Breadcrumbs -->

<section id="contact" class="contact">
  <div data-aos="fade-up">
    <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126533.47688100643!2d110.68165540695192!3d-7.664740714650837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a3c7cdf2e500f%3A0xd952c1406543010!2sKantor%20Pusat%20PDAM%20Tirta%20Makmur%20Kab%20Sukoharjo!5e0!3m2!1sid!2sid!4v1726039384832!5m2!1sid!2sid" frameborder="0" allowfullscreen></iframe>
  </div>
  <div class="container" data-aos="fade-up">
    <div class="row mt-5">
      <div class="col-lg-4">
        <div class="info">
          <div class="address">
            <i class="bi bi-geo-alt"></i>
            <h4>Kantor Pusat</h4>
            <p>Jl. Abu Tholib Sastrotenoyo No.371, Gabusan, Jombor, Kec. Bendosari, Kabupaten Sukoharjo, Jawa Tengah 57521</p>
          </div>
          <div class="email">
            <i class="bi bi-envelope"></i>
            <h4>Email</h4>
            <p>tirtamakmurpdam5@gmail.com
               pengaduanpdamskh@gmail.com</p>
          </div>
          <div class="phone">
            <i class="bi bi-phone"></i>
            <h4>Telepon</h4>
            <p>082111414111</p>
          </div>
        </div>
      </div>
      <div class="col-lg-8 mt-5 mt-lg-0">
        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
          <div class="row">
            <div class="col-md-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Nama Anda" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <input type="email" class="form-control" name="email" id="email" placeholder="Email Anda" required>
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subjek" required>
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Pesan" required></textarea>
          </div>
          <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your message has been sent. Thank you!</div>
          </div>
          <div class="text-center"><button type="submit">Send Message</button></div>
        </form>
      </div>
    </div>
  </div>
</section><!-- End Contact Section -->

<?php 
include('includes/footer_frontend.php');
include('includes/scripts_frontend.php');
?>