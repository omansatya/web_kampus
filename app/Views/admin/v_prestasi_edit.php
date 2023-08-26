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
            <label for="input_post_title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="input_post_judul" name="title" value="<?php echo (isset($title)) ? $title : "" ?>">
        </div>
        <div class="mb-3">
            <label for="input_post_status" class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="active" <?php echo (isset($status) && $status == 'active') ? "selected" : "" ?>>Aktif</option>
                <option value="inactive" <?php echo (isset($status) && $status == 'inactive') ? "selected" : "" ?>>Tidak Aktif</option>
            </select>
        </div>
        <?php if (isset($gambar)) { ?>
            <div>
                <img src="<?php echo base_url(LOKASI_UPLOAD . "/" . $gambar) ?>" class="pb-2 mb-2 img-thumbnail w-50" />
            </div>
        <?php } ?>
        <div class="mb-3">
            <label for="input_gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="input_gambar" name="gambar">
        </div>
        <div class="mb-3">
            <label for="input_lokasi" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="input_lokasi" name="lokasi" value="<?php echo (isset($lokasi)) ? $lokasi : "" ?>">
        </div>
        <div class="mb-3">
            <label for="input_deskripsi" class="form-label">Deskripsi</label>
            <textarea rows="2" name="deskripsi" id="input_deskripsi" class="form-control"><?php echo (isset($deskripsi)) ? $deskripsi : '' ?></textarea>
        </div>
        <div class="mb-3">
            <label for="input_tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="input_tanggal" name="tanggal" value="<?php echo (isset($tanggal)) ? $tanggal : "" ?>">
        </div>
        <div>
            <input type="submit" value="Simpan Data" name="submit" class="btn btn-primary">
        </div>
    </form>
</div>
