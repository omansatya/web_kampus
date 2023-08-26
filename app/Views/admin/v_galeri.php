<div class="card-header">
    <i class="fas fa-table me-1"></i>
    <?= $templateJudul ?>
</div>
<div class="card-body">
    <div class="row mb-3">
        <div class="col-lg-3 pt-1 pb-1">
            
        </div>
        <div class="col-lg-9 pt-1 pb-1 text-end">
            <a href="<?= site_url('admin/galeri/tambah') ?>" class="btn btn-xl btn-primary">+ Tambah Galeri</a>
        </div>
    </div>
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
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="col-1">No.</th>
                <th class="col-6">Nama Kegiatan</th>
                
                <th class="col-1 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($record as $value) : ?>
                <tr>
                    <td><?= $nomor ?></td>
                    <td><?= $value['nama_kegiatan'] ?></td>
                    <td>
                        <a href="<?= site_url("admin/galeri/edit/{$value['id_galeri']}") ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?= site_url("admin/galeri/delete/{$value['id_galeri']}") ?>" onclick="return confirm('Yakin ingin menghapus ini?')" class="btn btn-sm btn-danger">Del</a>
                    </td>
                </tr>
                <?php $nomor++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links('dt', 'datatable') ?>
</div>
