
   
    <!-- galeri start -->
    <section id="galeri">
    <div class="container">
      <div class="section-title">
        <h2>Galeri / Dokumentasi</h2>
      </div>
      <div class="row">

      <?php foreach ($galeri as $item): ?>
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
      <?php endforeach; ?>

<br><br><br>
      </div>
    </div>
  </section><br><br><br>
    <!-- galeri end -->
    