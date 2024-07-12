<?php
require "config.php";

$tamu = NULL;

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $tamu = query("SELECT * FROM tbl_tamu WHERE id_tamu = '$id'")[0];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pink's Organizer - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
  /* CSS */
  .typing {
    white-space: nowrap;
    overflow: hidden;
    border-right: .1em solid white;
    width: max-content;
    animation: typing 2s steps(14), blink .75s step-end infinite;
  }

  @keyframes typing {
    from {
      width: 0
    }

    to {
      width: 14ch
    }
  }

  @keyframes blink {
    50% {
      border-color: transparent
    }
  }
  </style>
</head>

<body>
  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div>
        <h1 class="typing" id="myElement"><?= ($tamu != NULL)? $tamu['nama_lengkap'] : 'NAMA TAMU'; ?></h1>
      </div>
      <h2>Selamat Menikmati Hidangan Yang Telah Disajikan</h2>
      <a href="index.php" class="btn-get-started scrollto">Kembali</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Tamu Yang Hadir</h2>
          <!-- <p>Beberapa team yang akan membantu mewujudkan acara impianmu</p> -->
        </div>

        <!-- ini -->
        <div class="row">

          <?php
          $tamu_hadir = query("SELECT * FROM tbl_tamu WHERE tanggal_registrasi IS NOT NULL ORDER BY tanggal_registrasi DESC");
          
          foreach($tamu_hadir AS $hadir) : ?>
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="admin/assets/img/<?= $hadir['foto']; ?>" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4><?= $hadir['nama_lengkap']; ?></h4>
                <span>Alamat : <?= $hadir['alamat']; ?></span>
                <span>Hadir : <?= $hadir['tanggal_registrasi']; ?></span>
              </div>
            </div>
          </div>
          <?php endforeach; ?>

        </div>

      </div>
    </section><!-- End Team Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">

      <div class="container">

        <div class="row  justify-content-center">
          <div class="col-lg-6">
            <h3>PINK'S EVENT ORGANIZER</h3>
            <p>Percaya kami rayakan hari bahagiamu</p>
          </div>
        </div>



        <div class="row footer-newsletter justify-content-center">
          <div class="col-lg-6">
            <form action="" method="post">
              <input type="email" name="email" placeholder="Enter your Email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>

        <div class="social-links">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>

      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Pink's</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/vlava-free-bootstrap-one-page-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>



  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
  setTimeout(function() {
    window.location.href = 'index.php';
  }, 6000);
  </script>

</body>

</html>