<div class="card-header">
    <i class="fas fa-table me-1"></i>
    <?= $templateJudul ?>
</div>
<div class="card-body">
    <?php
    $session = \Config\Services::session();
    if ($session->getFlashdata('warning')) {
    ?>
        <div class="alert alert-warning">
            <ul>
                <?php
                foreach ($session->getFlashdata('warning') as $val) {
                ?>
                    <li><?php echo $val ?></li>
                <?php
                }
                ?>
            </ul>
        </div>
    <?php
    }
    if ($session->getFlashdata('success')) {
    ?>
        <div class="alert alert-success"><?php echo $session->getFlashdata('success') ?></div>
    <?php
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="input_nama_kegiatan" class="form-label">Nama Kegiatan</label>
            <input type="text" class="form-control" id="input_nama_kegiatan" name="nama_kegiatan" value="<?php echo (isset($nama_kegiatan)) ? $nama_kegiatan : "" ?>">
        </div>
        <div class="mb-3">
            <label for="input_gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="input_gambar" name="gambar">
        </div>
        <div>
            <input type="submit" value="Simpan Data" name="submit" class="btn btn-primary">
        </div>
    </form>
</div>