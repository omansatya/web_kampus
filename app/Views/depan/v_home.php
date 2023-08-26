
    <!-- hero start -->
    <section>
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
        <?php $count = 0; ?>
        <?php foreach ($galeri as $item): ?>
          <div class="carousel-item <?php echo $count === 0 ? 'active' : ''; ?> c-item">
            <img src="<?php echo base_url(LOKASI_UPLOAD . "/" . $item['gambar']); ?>" class="d-block w-100 c-img" alt="...">
          </div>
          <?php $count++; ?>
          <?php if ($count >= 4) break; ?> <!-- Stop after displaying 4 images -->
        <?php endforeach; ?>
          
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>
    <!-- hero end -->
    <!-- sambutan start -->
    <section id="sambutan">
      <div class="container">
        <h2>PROFIL Universitas Sepuluh Nopember Papua</h2>
        <div class="row">
          <div class="col-md-6">
            <div class="video-wrapper">
              <iframe width="560" height="315" src="https://www.youtube.com/embed/9_htTteP0PE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
          </div>
          <div class="col-md-6">
            <h3>sambutan Rektor USN-Papua</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt quae doloremque deleniti amet accusantium molestiae rem sed aperiam, quidem itaque rerum consequatur impedit quos exercitationem quisquam adipisci obcaecati laboriosam. Officia architecto consectetur dolore natus harum maiores numquam ea ipsam ipsa sint, similique tempora, sit at voluptatibus aliquam. Alias, dolore exercitationem?</p>
            <a href="<?php echo site_url('profil') ?>" class="btn btn-utama">Baca Selengkapnya</a>

          </div>
        </div>
      </div>
    </section>
    <!-- sambutan end -->
    <!-- prestasi start -->
<section id="prestasi">
  <div class="container">
    <div class="section-title">
      <h2>Prestasi Terbaru</h2>
    </div>
    <?php foreach ($prestasi as $item): ?>
      <div class="section-item">
        <div class="row">
          <div class="col-md-6">
            <img src="<?php echo base_url(LOKASI_UPLOAD . "/" . $item['gambar_prestasi']) ?>" class="section-item-thumbnail" alt="">
          </div>
          <div class="col-md-6">
            <div class="section-item-title">
              <h3><?php echo $item['title']; ?></h3>
              <div class="section-item-meta">
                <span><i class="far fa-calendar-alt"></i><?php echo $item['tanggal']; ?></span>
                <span><i class="fas fa-map-marked-alt"></i><?php echo $item['lokasi']; ?></span>
              </div>
            </div>
            <div class="section-item-body">
              <p><?php echo $item['deskripsi']; ?></p>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <div class="tombol-selengkapnya">
      <a href="<?php echo site_url('prestasi') ?>" class="btn btn-more">lihat Prestasi Lainnya</a>
    </div>
  </div>
</section>
<!-- prestasi end -->

    <!-- prodi start -->
    <section id="prodi">
    <div class="container">
        <div class="section-title">
            <h2>Program Studi</h2>
        </div>
        <div id="myCarousel" class="owl-carousel owl-theme my-3">
            <?php foreach ($prodi as $program) : ?>
                <div class="card shadow my-3">
                  <img src="<?php echo base_url(LOKASI_UPLOAD . "/" . $program['gambar']); ?>" class="section-item-thumbnail" alt="">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $program['nama_prodi']; ?></h5>
                        <p class="card-text">
                            <?php echo $program['deskripsi']; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
    <!-- prodi end -->
    <!-- alumni start -->
    <section id="alumni">
  <div class="container testimonial">
    <div class="section-title" style="color: #fff;">
      <h2>Profil Alumni</h2>
    </div>
    <div class="testimonials">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php foreach ($alumni as $index => $item): ?>
            <div class="carousel-item <?php if ($index === 0) echo 'active'; ?>">
              <div class="single-item">
                <div class="row">
                  <div class="col-md-5">
                    <div class="profile">
                      <div class="img-area">
                        <img src="<?php echo base_url('depan') ?>/asset/Image/img/alumni/<?php echo base_url(LOKASI_UPLOAD . "/" . $item['gambar']); ?>" alt="">
                      </div>
                      <div class="bio">
                        <h2><?php echo $item['nama_alumni']; ?></h2>
                        <h4><?php echo $item['pekerjaan']; ?></h4>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="content">
                      <p><span><i class="fa fa-quote-left"></i></span><?php echo $item['deskripsi']; ?></p>
                      <p class="socials">
                        <i class="fa fa-twitter"></i>
                        <i class="fa fa-behance"></i>
                        <i class="fa fa-pinterest"></i>
                        <i class="fa fa-dribbble"></i>
                        <i class="fa fa-vimeo"></i>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>
</section>
    <!-- alumni end -->
    <!-- galeri start -->
  <section id="galeri">
    <div class="container">
      <div class="section-title">
        <h2>Galeri / Dokumentasi</h2>
      </div>
      <div class="row">

      <?php $counter = 0; ?>
      <?php foreach ($galeri as $item): ?>
        <?php if ($counter < 3): ?>
          <div class="col-lg-4 col-sm-12">
            <div class="gallery-item" data-bs-target="#popup<?php echo $item['id_galeri']; ?>" data-bs-toggle="modal">
              <img alt="<?php echo $item['nama_kegiatan']; ?>" src="<?php echo base_url(LOKASI_UPLOAD . "/" . $item['gambar']); ?>">
              <div class="overlay">
                <h3><?php echo $item['nama_kegiatan']; ?></h3>
              </div>
            </div>
          </div>

          <div class="modal fade" id="popup<?php echo $item['id_galeri']; ?>">
            <div class="modal-dialog">
              <div class="modal-content"><img alt="<?php echo $item['nama_kegiatan']; ?>" src="<?php echo base_url(LOKASI_UPLOAD . "/" . $item['gambar']); ?>"></div>
            </div>
          </div>
        <?php endif; ?>
        <?php $counter++; ?>
      <?php endforeach; ?>


      </div>

      <br><br><br>
      <div class="tombol-selengkapnya">
        <a href="<?php echo site_url('galeri') ?>" class="btn btn-more">Selengkapnya</a>
      </div>
    </div>
  </section>

    <!-- galeri end -->
    