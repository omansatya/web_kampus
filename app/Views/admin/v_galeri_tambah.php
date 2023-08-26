<div class="card-header">
    <i class="fas fa-table me-1"></i>
    <?= $templateJudul ?>
</div>
<div class="card-body">
    <?php if ($warning = session('warning')) : ?>
        <div class="alert alert-warning">
            <ul>
                <?php foreach ($warning as $val) : ?>
                    <li><?= $val ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if ($success = session('success')) : ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
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
