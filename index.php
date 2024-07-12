<?php
require "config.php";

if(isset($_POST['hadir'])){
  $kode_undangan = htmlspecialchars($_POST['kode_undangan']);
  $pass = htmlspecialchars($_POST['password']);

  $result = mysqli_query($conn, "SELECT * FROM tbl_tamu where kode_undangan = '$kode_undangan'");
    // cek username
    if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result);
      if($row['password'] === $pass){
        $id_tamu = $row['id_tamu'];
        $now = date("H:i:s");
        mysqli_query($conn, "UPDATE tbl_tamu SET tanggal_registrasi = '$now' WHERE id_tamu = '$id_tamu'");
        header("Location: welcome.php?id=".$id_tamu);
      } else{
        echo "<script>alert('Password yang anda masukkan salah.');</script>";
      }
    } else {
      echo "<script>alert('Kode undangan anda masukkan salah.');</script>";
    }
}


if (isset($_POST['tambahpesanan'])) {
  $result = tambahPesanan($_POST);
  if ($result > 0) {
      echo "<script>
              alert('Pesanan Berhasil Ditambahkan!');
              window.location.href = 'index.php';
            </script>";
  } else {
      echo "<script>
              alert('Pesanan gagal ditambahkan!');
              window.location.href = 'index.php';
            </script>";
  }
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

  <!-- =======================================================
  * Template Name: Vlava
  * Template URL: https://bootstrapmade.com/vlava-free-bootstrap-one-page-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="index.php">Pink's</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
          <!-- <li><a class="nav-link scrollto" href="#services">Layanan</a></li> -->
          <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto " href="#undangan">Undangan</a></li>
          <li><a class="nav-link scrollto" href="#team">Tamu Hadir</a></li>
          <li><a class="nav-link scrollto" href="#pricing">Harga</a></li>
          <li><a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Registrasi Tamu Undangan</a>
          </li>
          <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
          <li><a class="nav-link scrollto" href="admin/login.php">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <form action="" method="post" class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Registrasi Tamu</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-4">
          <div class="mb-3">
            <label for="kode_undangan" class="form-label">Kode Undangan</label>
            <input type="text" class="form-control" name="kode_undangan" id="kode_undangan" aria-describedby="kuHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="hadir" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <h1>Believe in Pink's Organizer</h1>
      <h2>We are team of talented designers for your intimate event</h2>
      <a href="#team" class="btn-get-started scrollto">Daftar Hadir</a>
    </div>
  </section> 
  <!-- End Hero -->

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
          
          if(COUNT($tamu_hadir) > 0) :
          foreach($tamu_hadir AS $hadir) : ?>
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member w-100">
              <div class="member-img">
                <img src="admin/assets/img/<?= $hadir['foto']; ?>" class="img-fluid" alt=""
                  style="width: 100%; height: 200px; object-fit: cover;">
              </div>
              <div class="member-info">
                <h4 class="text-capitalize"><?= strtolower($hadir['nama_lengkap']); ?></h4>
                <span class="text-capitalize">Alamat : <?= strtolower($hadir['alamat']); ?></span>
                <span>Hadir : <?= $hadir['tanggal_registrasi']; ?></span>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
          <?php else : ?>
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch text-center">
            Belum ada tamu yang datang.
          </div>
          <?php endif; ?>

        </div>

      </div>
    </section>
    <!-- End Team Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row content">
          <div class="col-lg-6">
            <h2>PINK'S ORGANIZER</h2>
            <h3>Bekerja keras mewujudkan acara intimate impianmu</h3>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              Pink’s Event Organizer merupakan usaha yang bergerak
              di bidang penyelenggaraan event baik itu pernikahan intimate,
              ulang tahun dan pertunangan. Usaha ini dibangun pada tahun 2016
              dan menyediakan berbagai paket pilihan untuk customer. Ada 3 paket utama yaitu:
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Paket A (dekorasi, cendramata, hidangan, registrasi tamu, pembawa
                acara, undangan fisik & digital, serta live music accoustic)</li>
              <li><i class="ri-check-double-line"></i> Paket B (dekorasi, hidangan, live music acoustic, undangan
                digital dan pembawa acara)</li>
              <li><i class="ri-check-double-line"></i> Paket C (dekorasi, hidangan dan pembawa acara)</li>
            </ul>
            <p class="fst-italic">
              Mari percayakan acara di tangan kami, dan nikmati hari yang indah
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Services</h2>
          <p>Kami selalu memberikan yang terbaik untuk anda</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 icon-box">
            <div class="icon"><i class="bi bi-briefcase"></i></div>
            <h4 class="title"><a href="">Master of Ceremony</a></h4>
            <p class="description">Pink's Organizer sudah bekerja sama dengan MC senior dengan segudang pengalaman.
              Mereka siap dan sudah terlatih meramaikan suasana acara</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box">
            <div class="icon"><i class="bi bi-card-checklist"></i></div>
            <h4 class="title"><a href="">Live Music</a></h4>
            <p class="description">Musik klasik serta accoustic merupakan pilihan yang tepat untuk mensyahdukan acara
              tak terlupakan anda. Band kami merupakan musisi dengan talenta yang tidak perlu diragukan</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box">
            <div class="icon"><i class="bi bi-bar-chart"></i></div>
            <h4 class="title"><a href="">Catering</a></h4>
            <p class="description">Berbagai macam pilihan makanan kami tawarkan seperti japanese food, korean food,
              western food dan juga makanan khas indonesia. Cita rasa yang tak terlupakan adalah motto kami.</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box">
            <div class="icon"><i class="bi bi-binoculars"></i></div>
            <h4 class="title"><a href="">Decoration</a></h4>
            <p class="description">Mengusung tema klasik, kami menawarkan berbagai pilihan. Punya keinginan sendiri?
              akan kami wujudkan.</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box">
            <div class="icon"><i class="bi bi-brightness-high"></i></div>
            <h4 class="title"><a href="">Cendra Mata</a></h4>
            <p class="description">Request keinginan anda dan akan kami wujudkan!</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box">
            <div class="icon"><i class="bi bi-calendar4-week"></i></div>
            <h4 class="title"><a href="">Invitation Card</a></h4>
            <p class="description">Kami menyediakan layanan Invitation card dengan berbagai pilihan design. Digital card
              adalah tawaran terbaru yang kami miliki.</p>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Featured Section ======= -->
    <section id="featured" class="featured">
      <div class="container">

        <div class="row">
          <?php
          $contens = query("SELECT * FROM tbl_conten");
          foreach($contens AS $conten) : ?>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="card">
              <img src="admin/assets/img/<?= $conten['foto']; ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><a href=""><?= $conten['judul']; ?></a></h5>
                <p class="card-text"><?= $conten['deskripsi']; ?></p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

      </div>
    </section>
    <!-- End Featured Section -->

    <!-- ======= Testimonials Section ======= -->
    
    <!-- End Testimonials Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title">
          <h2>Portfolio</h2>
          <p>Beberapa acara yang telah berhasil kami handle</p>
        </div>

        <div class="row">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Semua</li>
              <li data-filter=".filter-app">Tunangan</li>
              <li data-filter=".filter-card">Pernikahan</li>
              <li data-filter=".filter-web">Ulang Tahun</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="assets/img/portfolio/portofolio-1.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Tunangan</h4>
              <p>Desain Tunangan</p>
              <a href="assets/img/portfolio/portofolio-1.jpeg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="assets/img/portfolio/portofolio-2.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Ulang Tahun</h4>
              <p>Acara Perayaan Ulang Tahun</p>
              <a href="assets/img/portfolio/portofolio-2.jpeg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="assets/img/portfolio/portfolio-3.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Musik</h4>
              <p>Musik Penggiring Acara</p>
              <a href="assets/img/portfolio/portfolio-3.jpeg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="assets/img/portfolio/portfolio-4.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Pernikahan</h4>
              <p>Acara Pernikahan Outdoor (Luar Ruangan)</p>
              <a href="assets/img/portfolio/portfolio-4.jpeg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="assets/img/portfolio/portfolio-5.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Musik</h4>
              <p>Musik Penggiring Acara Luar Ruangan</p>
              <a href="assets/img/portfolio/portfolio-5.jpeg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="assets/img/portfolio/portofolio-6.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Tunangan</h4>
              <p>Acara Tunangan</p>
              <a href="assets/img/portfolio/portofolio-6.jpeg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="assets/img/portfolio/portfolio-7.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Ulang Tahun</h4>
              <p>Acara Ulang Tahun Pernikahan</p>
              <a href="assets/img/portfolio/portfolio-7.jpeg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="assets/img/portfolio/portfolio-8.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Pernikahan</h4>
              <p>Acara Pernikahan Sederhana</p>
              <a href="assets/img/portfolio/portfolio-8.jpeg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="assets/img/portfolio/portfolio-9.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Ulang Tahun</h4>
              <p>Acara Ulang Tahun</p>
              <a href="assets/img/portfolio/portfolio-9.jpeg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- Start Undangan -->
    <section id="undangan" class="undangan">
      <div class="container">

        <div class="section-title">
          <h2>Contoh Undangan</h2>
          <p>Beberapa contoh undangan yang menjadi reverensi</p>
          <p>Kamu juga bisa request kartu undangan impianmu!</p>
        </div>

        <div class="row">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="undangan-filters">
              <li data-filter="filter-und" class="filter-active">Semua</li>
            </ul>
          </div>
        </div>

        <div class="row undangan-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-und">
            <img src="assets/img/undangan/tunangan.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Tunangan</h4>
              <p>Desain Undangan Tunangan</p>
              <a href="assets/img/undangan/tunangan.png" data-gallery="portfolioGallery"
                class="undangan-lightbox preview-link" title="und 1"><i class="bx bx-plus"></i></a>
              <a href="unda-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-und">
            <img src="assets/img/undangan/pernikahan.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Pernikahan</h4>
              <p>Desain Undangan Pernikahan</p>
              <a href="assets/img/undangan/Pernikahan.png" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="und 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-und">
            <img src="assets/img/undangan/ultah.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Ulang Tahun</h4>
              <p>Desain Undangan Ulang Tahun</p>
              <a href="assets/img/undangan/ultah.png" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="und 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
          </div>
          </section><!-- End Undangan Section -->
    
    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Team</h2>
          <p>Beberapa team yang akan membantu mewujudkan acara impianmu</p>
        </div>

        <!-- ini -->
        <div class="row">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/team/kak ros.jpeg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Rose</h4>
                <span>Chief Executive Officer</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/team/mail.jpeg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Ismail</h4>
                <span>Product Manager</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/team/susanti.jpeg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Susanti</h4>
                <span>CTO</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/team/jarjit.jpeg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Jarjit</h4>
                <span>Accountant</span>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section -->

   <!-- Pricing -->
   <section id="pricing" class="pricing">
      <div class="container">

        <div class="section-title">
          <h2>Harga</h2>
          <p>Layanan bintang 5 dengan penawaran terbaik</p>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="box">
              <h3>Paket A</h3>
              <h4><sup>Rp.</sup>125jt<span></span></h4>
              <ul>
                <li>Dekorasi</li>
                <li>Catering</li>
                <li>Surat Undangan</li>
                <li>Live Music</li>
                <li>MC</li>
                <li>Registrasi Tamu</li>
                <li>Cendramata</li>
              </ul>
              <div class="btn-wrap">
              <button type="button" class="btn btn-buy" data-bs-toggle="modal" data-bs-target="#exampleModal1">
               Pesan
              </button>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
            <div class="box featured">
              <h3>Paket B</h3>
              <h4><sup>Rp.</sup>95jt<span></span></h4>
              <ul>
                <li>Dekorasi</li>
                <li>Catering</li>
                <li>Surat Undangan</li>
                <li>Live Music</li>
                <li>MC</li>
                <li class="na">Registrasi Tamu</li>
                <li class="na">Cendramata</li>
              </ul>
              <div class="btn-wrap">
              <button type="button" class="btn btn-buy" data-bs-toggle="modal" data-bs-target="#exampleModal2">
               Pesan
              </button>
              </div>
 </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
            <div class="box">
              <h3>Paket C</h3>
              <h4><sup>Rp</sup>30jt<span></span></h4>
              <ul>
                <li>Dekorasi</li>
                <li>Catering</li>
                <li>MC</li>
                <li class="na">Surat Undangan</li>
                <li class="na">Live Music</li>
                <li class="na">Registrasi Tamu</li>
                <li class="na">Cendramata</li>
              </ul>
              <div class="btn-wrap">
              <button type="button" class="btn btn-buy" data-bs-toggle="modal" data-bs-target="#exampleModal3">
               Pesan
              </button>
              </div>
            </div>
          </div>

<!-- ini pilihan inputan paketnya -->
<!-- input 1 -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pemesanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" enctype="multipart/form-data" action="proses_pesanan.php">
        <div class="modal-body px-4">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama :</label>
            <input type="text" class="form-control" name="nama" id="nama">
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat :</label>
            <input type="text" class="form-control" name="alamat" id="alamat">
          </div>
          <div class="mb-3">
            <label for="no_wa" class="form-label">Nomor WA :</label>
            <input type="text" class="form-control" name="no_wa" id="no_wa">
          </div>
          <div class="mb-3">
            <label for="paket" class="form-label">Pilih Paket :</label>
            <select class="form-select" name="paket" id="paket">
            <option value="Paket C">Paket C</option>
            <option value="Paket A">Paket A</option>
            <option value="Paket B">Paket B</option>
              
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="tambahpesanan" class="btn btn-primary">Pesan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- input 1 -->

<!-- input 2 -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pemesanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" enctype="multipart/form-data" action="proses_pesanan.php">
        <div class="modal-body px-4">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama :</label>
            <input type="text" class="form-control" name="nama" id="nama">
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat :</label>
            <input type="text" class="form-control" name="alamat" id="alamat">
          </div>
          <div class="mb-3">
            <label for="no_wa" class="form-label">Nomor WA :</label>
            <input type="text" class="form-control" name="no_wa" id="no_wa">
          </div>
          <div class="mb-3">
            <label for="paket" class="form-label">Pilih Paket :</label>
            <select class="form-select" name="paket" id="paket">
              <option value="Paket A">Paket A</option>
              <option value="Paket B">Paket B</option>
              <option value="Paket C">Paket C</option>
              <!-- Tambahkan opsi paket lainnya sesuai kebutuhan -->
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="tambahpesanan" class="btn btn-primary">Pesan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- input 2 -->

<!-- input 3 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pemesanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" enctype="multipart/form-data" action="proses_pesanan.php">
        <div class="modal-body px-4">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama :</label>
            <input type="text" class="form-control" name="nama" id="nama">
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat :</label>
            <input type="text" class="form-control" name="alamat" id="alamat">
          </div>
          <div class="mb-3">
            <label for="no_wa" class="form-label">Nomor WA :</label>
            <input type="text" class="form-control" name="no_wa" id="no_wa">
          </div>
          <div class="mb-3">
            <label for="paket" class="form-label">Pilih Paket :</label>
            <select class="form-select" name="paket" id="paket">
            <option value="Paket B">Paket B</option>
              <option value="Paket A">Paket A</option>
              <option value="Paket C">Paket C</option>
              <!-- Tambahkan opsi paket lainnya sesuai kebutuhan -->
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="tambahpesanan" class="btn btn-primary">Pesan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- input 3 -->

        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
      <div class="container">

        <div class="section-title">
          <h2>Pertanyaan</h2>
        </div>

        <div class="row  d-flex align-items-stretch">

          <div class="col-lg-6 faq-item">
            <i class="bx bx-help-circle"></i>
            <h4>Gimana cara untuk booking?</h4>
            <p>
              Kalian bisa menghubungi kontak yang telah kami sediakan di website.
            </p>
          </div>

          <div class="col-lg-6 faq-item">
            <i class="bx bx-help-circle"></i>
            <h4>Apakah tema acara akan sepenuhnya di handle oleh pink's team?</h4>
            <p>
              Untuk kelancaran acara adalah tanggung jawab kami, akan tetapi tema dan pemilihan warna serta konsep
              acara akan kita lakukan meeting bersama pemilik acara tersebut
            </p>
          </div>

          <div class="col-lg-6 faq-item">
            <i class="bx bx-help-circle"></i>
            <h4>Apakah bisa melakukan tawaran harga?</h4>
            <p>
              Harga yang kami sediakan sudah sesuai paket, akan tetapi untuk penambahan ataupun pengurangan
              harga disesuaikan dengan permintaan client.
            </p>
          </div>

          <div class="col-lg-6 faq-item">
            <i class="bx bx-help-circle"></i>
            <h4>Apakah catering bisa di mix?</h4>
            <p>
              Bisa, apabila customer menginginkan semua jenis masakan maka kami akan memberikan 75-500 porsi per
              jenisnya.
            </p>
          </div>

          <div class="col-lg-6 faq-item">
            <i class="bx bx-help-circle"></i>
            <h4>Bahan baju untuk bridesmait apa juga disediakan?</h4>
            <p>
              sayangnya saat ini kami hanya menyediakan untuk bagian dekor dan hal hal lapangan lainnya
            </p>
          </div>

          <div class="col-lg-6 faq-item">
            <i class="bx bx-help-circle"></i>
            <h4>Bangku dan meja serta gedung apa bisa dicarikan juga?</h4>
            <p>
              Hal tersebut opsional tergantung permintaan cutomer.
            </p>
          </div>

        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title">
          <h2>kontak</h2>
          <p>Hubungi kami menggunakan kontak yang disedikan.</p>
        </div>
      </div>
      <div class="map">
        <iframe style="border:0; width: 100%; height: 350px;"
          src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
          frameborder="0" allowfullscreen></iframe>
      </div>
      <div class="container">
        <?php $data = query("SELECT * FROM tbl_admin")[0]; ?>
        <div class="row mt-5 justify-content-center">

          <div class="col-lg-10">

            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-4 info">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Lokasi :</h4>
                  <p><?= $data['alamat']; ?></p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-envelope"></i>
                  <h4>Email/IG :</h4>
                  <p><?= $data['email']; ?></p>
                </div>


                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-phone"></i>
                  <h4>telepon :</h4>
                  <p><?= $data['telepon']; ?></p>
                </div>
              </div>
            </div>

          </div>

        </div>

        <!-- <div class="row mt-5 justify-content-center">
          <div class="col-lg-10">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div> -->

      </div>
    </section><!-- End Contact Section -->

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

</body>

</html>