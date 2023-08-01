<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>

<div class="row justify-content-center mt-5">
<div class="col-xl-10"> 
  
<div class="card">
<div class="card-body">

<?php if (session()->has('success')): ?>
    <div class="alert alert-success">
        <?php echo session('success'); ?>
    </div>
<?php endif; ?>

<!-- Tampilkan pesan error jika ada -->
<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        
    <?php echo session('errors'); ?>
    
        </ul>
    </div>
<?php endif; ?>

<form  action="/store/transaksi" method="post" enctype="multipart/form-data">
<div class="row">
    <div class="col-xl-6">
    <div class="mb-3">
<label for="nama" class="form-label">Pilih Belanjaan</label>
<select name="belanja_id" class="form-select" aria-label="Default select example">
    <?php foreach ($belanjas as $item): ?>
        <option value="<?= $item['id']; ?>"><?= $item['nama']." (Jumlah-nya ".$item['jumlah'].") (Harga: ".$item['harga'].")"; ?></option>
    <?php endforeach; ?>
</select>
</div>
    </div>
    <div class="col-xl-6">
    <div class="mb-3">
<label for="file" class="form-label">Upload Bukti Pembayaran</label>
<input type="file" name="file" class="form-control" id="file">
</div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
    <a href="/" class="btn btn-primary btn-sm">Kembali</a>
    <button type="submit" class="btn btn-primary btn-sm">Kirim data</button>
    </div>
</div>
</form>

</div>
</div>

</div>
</div>
<?= $this->endSection(); ?>