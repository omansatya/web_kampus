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

    
  </div>
</section>
<!-- prestasi end -->

    