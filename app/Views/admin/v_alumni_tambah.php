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
            <label for="input_nama_alumni" class="form-label">Nama</label>
            <input type="text" class="form-control" id="input_nama_alumni" name="nama_alumni" value="<?php echo (isset($nama_alumni)) ? $nama_alumni : "" ?>">
        </div>
        <?php if (isset($gambar)) : ?>
            <div>
                <img src="<?= base_url(LOKASI_UPLOAD . "/" . $gambar) ?>" class="pb-2 mb-2 img-thumbnail w-50" />
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="input_gambar" class="form-label">foto</label>
            <input type="file" class="form-control" id="input_gambar" name="gambar">
        </div>
        <div class="mb-3">
            <label for="input_pekerjaan" class="form-label">Pekerjaan</label>
            <input type="text" class="form-control" id="input_pekerjaan" name="pekerjaan" value="<?php echo (isset($pekerjaan)) ? $pekerjaan : "" ?>">
        </div>
        <div class="mb-3">
            <label for="input_deskripsi" class="form-label">ucapan</label>
            <textarea rows="2" name="deskripsi" id="input_deskripsi" class="form-control"><?php echo (isset($deskripsi)) ? $deskripsi : '' ?></textarea>
        </div>
        <div>
            <input type="submit" value="Simpan Data" name="submit" class="btn btn-primary">
        </div>
    </form>
</div>
