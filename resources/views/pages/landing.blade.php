<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Pujas Delivery - Landing Page</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="#hero" class="logo d-flex align-items-center me-auto me-xl-0">
        <h1 class="sitename">Pujas Delivery</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ route('login.form') }}">Login as Admin</a>
    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
              <h2>Melayani Untuk Warga Polban</h2>
              <p>Pelayanan pemesanan makanan dengan berbasis Android untuk mempermudah warga polban memesan makanan pilihan di Pujasera Polban.</p>
              <div class="hero-btns">
                <a href="#consultation" class="btn btn-primary">Unduh Aplikasi</a>
              </div>
              <div class="hero-stats">
                <div class="stat-item">
                  <h1><span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>+</h3>
                  <p>Tenant</p>
                </div>
                <div class="stat-item">
                  <h1><span data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="1" class="purecounter"></span>+</h3>
                  <p>Menu</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
              <img src="assets/img/hero-image.jfif" alt="Consulting Services" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="200">
            <div class="about-image">
              <img src="assets/img/Makan.jfif" alt="About Our Consulting Firm" class="img-fluid main-image">
              <div class="experience-badge">
                <span class="years">15+</span>
                <span class="text">Transaksi Setiap Hari</span>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="about-content">
              <h2>Kami Memberikan Pelayanan Terbaik</h2>
              <p class="lead">Memberikan pelayanan dari banyak tenant dan juga setiap menu yang ada didalamanya.</p>
              <div class="row features-row">
                <div class="col-md-6">
                  <div class="feature-item">
                    <div class="icon">
                      <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h4>Pelayanan Cepat</h4>
                    <p>Pelayanan yang semua akan selalu dimonitoring oleh pihak terkait Pujasera Polban.</p>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="feature-item">
                    <div class="icon">
                      <i class="bi bi-lightbulb"></i>
                    </div>
                    <h4>Innovative Solutions</h4>
                    <p>Inovasi dalam memberikan pelayanan fasilitas dilingkungan Polban.</p>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="feature-item">
                    <div class="icon">
                      <i class="bi bi-people"></i>
                    </div>
                    <h4>Expert Team</h4>
                    <p>Team penanggung jawab yang akan selalu mengantarkan dan mempersiapkan pesanan kamu.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Work Process Section -->
    <section id="services" class="work-process section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <div><span>Pelayanan</span> <span class="description-title">Yang Kami Berikan</span></div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="steps-content">
              <h2>Fitur Berbasis Android</h2>
              <p>Dapat mempermudah pemesanan dimana saja dan kapan saja selama di Polban. Memberikan akses ke setiap gedung yang ada di Politeknik Negeri Bandung untuk dihantarkan dari Pujasera Polban</p>
            </div>
          </div>

          <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="300">
            <div class="steps-list">
              <div class="step-item">
                <div class="step-number">01</div>
                <div class="step-content">
                  <h3>Menu &amp; Tenant</h3>
                  <p>Memberikan banyak pilihan menu dari setiap tenant yang terdaftar.</p>
                </div>
              </div>

              <div class="step-item">
                <div class="step-number">02</div>
                <div class="step-content">
                  <h3>Pengantaran Fleksibel</h3>
                  <p>Pengguna dapat memberikan catatan sesuka hati dan juga memilih tujuan pemesanan ditempat yang disingghi.</p>
                </div>
              </div>

              <div class="step-item">
                <div class="step-number">03</div>
                <div class="step-content">
                  <h3>Pesanan Informatif</h3>
                  <p>Memberikan pelayanan informatif status pesanan yang dipesan oleh pengguna secara terstruktur.</p>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Work Process Section -->

    <!-- Consultation Section -->
    <section id="consultation" class="consultation section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kritik dan Saran</h2>
        <div><span>Berikan Pengalamanmu&nbsp;</span> <span class="description-title">Dengan Pujas Delivery</span></div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="cta-wrapper">
          <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">
              <div class="cta-content">
                <h2>Ada Pengalaman Menarik Selama Menggunakan Pujas Delivery?</h2>
                <p>Berikan segala pengalamanmu menggunakan aplikasi kami. Suaramu Evaluasi Kami!.</p>
              </div>
            </div>
            <div class="col-lg-5" data-aos="fade-up" data-aos-delay="300">
              <div class="cta-form">
                <h3>Tanggapan</h3>
                <p>Berikan tanggapanu disini ya!</p>
                <form action="forms/consultation.php" method="post" class="php-email-form">
                  <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                  </div>
                  <div class="form-group mt-3">
                    <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                  </div>
                  <div class="form-group mt-3">
                    <input type="text" class="form-control" name="phone" placeholder="Your Phone">
                  </div>
                  <div class="form-group mt-3">
                    <select class="form-control" name="service" required="">
                      <option value="" disabled="" selected="">Select Service</option>
                      <option value="Strategic Planning">Strategic Planning</option>
                      <option value="Business Transformation">Business Transformation</option>
                      <option value="Financial Advisory">Financial Advisory</option>
                      <option value="Human Resources">Human Resources</option>
                      <option value="Technology Consulting">Technology Consulting</option>
                    </select>
                  </div>
                  <div class="my-3">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                  </div>
                  <div class="text-center">
                    <button type="submit">Get Started</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Consultation Section -->
  </main>

  <footer id="footer" class="footer light-background">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div class="address">
            <h4>Address</h4>
            <p>Pujasera Politeknik Negeri Bandung</p>
            <p>Politeknik Negeri Bandung, Jl. Gegerkalong Hilir, Ciwaruga, Kec. Parongpong, Kabupaten Bandung Barat, Jawa Barat 40012</p>
            <p></p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Opening Hours</h4>
            <p>
              <strong>Mon-Sat:</strong> <span>07.00 - 17.00</span><br>
              <strong>Sunday</strong>: <span>Closed</span>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Pujas Delivery.</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>