<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<div class="row justify-content-center mt-5">
<div class="col-xl-10"> 
<?php if (session()->has('success')): ?>
    <div class="alert alert-success">
        <?php echo session('success'); ?>
    </div>
<?php endif; ?>

<!-- Tampilkan pesan error jika ada -->
<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">        
    <?php echo session('errors'); ?>      
    </div>
<?php endif; ?>
<table id="myTable" class="table">
<thead>
        <tr>
            <th>No</th>
            <th>Nama Belanja</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>File</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no=1;
        foreach ($uploadtransaksis as $uploadtransaksi): 
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $uploadtransaksi->nama; ?></td>
            <td><?= $uploadtransaksi->jumlah; ?></td>
            <td><?= $uploadtransaksi->harga; ?></td>
            <td><a href="<?= base_url() . "/uploads/transaksi/" . $uploadtransaksi->file; ?>" data-lightbox="example" class="btn btn-primary btn-sm">lihat</a></td>
            <td><a class="btn btn-danger btn-sm" href="/upload/transaksi/delete/<?= $uploadtransaksi->id; ?>">Hapus</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
    <a href="/upload/transaksi"  class="btn btn-primary btn-sm">Kembali</a>
    
    </div>
    </div>
    <?= $this->endSection(); ?>