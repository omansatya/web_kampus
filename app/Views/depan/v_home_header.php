<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>USN-Papua</title>
    <link rel="stylesheet" href="<?php echo base_url('depan') ?>/asset/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url('depan') ?>/asset/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <!-- topbar -->
    <section id="topbar">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <ul class="top-contact">
              <li><a href=""><i class="fas fa-phone"></i>082289829777</a></li>
              <li><a href=""><i class="fas fa-envelope"></i>kampus@usn-papua.ac.id</a></li>
              <li><a href=""><i class="fas fa-bullhorn"></i>PMB TA 2023/2024 Telah dibuka!</a></li>
            </ul>
          </div>
          <div class="col-md-3">
            <ul class="sosmed">
              <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
              <li><a href=""><i class="fab fa-instagram"></i></a></li>
              <li><a href=""><i class="fab fa-youtube"></i></a></li>
              <li><a href=""><i class="fab fa-twitter"></i></a></li>
              <li><a href="<?php echo base_url('admin/login') ?>" target="_blank"><i class="fa fa-user"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- topbar end -->
    <!-- header -->
    <header>
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="brand">
              <img src="<?php echo base_url('depan') ?>/asset/Image/img/Logo Universitas.png" alt="" width="64" height="64">
              <div class="brand-name">
                <h1>Universitas Sepuluh Nopember Papua</h1>
                <h3>Pencetak generasi Teladan Dan berprestasi</h3>
              </div>
            </div>
          </div>
          <div class="col-md-4 pembungkus-seacrhbox">
            <div class="searchbox">
              <form action="" method="get">
                <div class="input-group">
                  <input type="text" name="cari" class="form-control" placeholder="Masukkan text" aria-label="tombol cari" aria-describedby="tombol cari" >
                  <div class="input-group-append">
                    <button class="btn btn-utama" id="Tombol cari">Cari</>
                  </div>

                </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- header END -->
    <!-- section menu -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-biru">
      <div class="container">
        <ul class="nav justify-content-center  ">
            <li class="nav-item">
                <a class="nav-link text-light" href="<?php echo site_url('/') ?>" aria-current="page">Beranda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="<?php echo site_url('profil') ?>" aria-current="page">Profil</a>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Sarana Prasarana
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="https://perpustakaan.usn-papua.ac.id/" target="_blank">Perpustakaan</a></li>
                <li><a class="dropdown-item" href="#">Laboratorium</a></li>
                
                <li><a class="dropdown-item" href="http://student.stimik-sepuluh-nopember-jayapura.edufecta.com/" target="_blank">SIMAK</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Program Studi
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="https://ti.stimiksepnop.ac.id/" target="_blank">Teknik Informatika</a></li>
                <li><a class="dropdown-item" href="#">Sistem Informasi</a></li>
                <li><a class="dropdown-item" href="#">Hukum</a></li>
                <li><a class="dropdown-item" href="#">Manajement</a></li>
                <li><a class="dropdown-item" href="#">teknologi Pangan Dan Hasil Pertanian</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="<?php echo site_url('prestasi') ?>">Prestasi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="<?php echo site_url('galeri') ?>">Galeri</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="<?php echo site_url('kontak') ?>">Kontak</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="#">daftar</a>
            </li>
        </ul>
      </div>
    </nav>
    <!-- menu end -->
    