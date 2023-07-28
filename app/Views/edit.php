<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>

<div class="row justify-content-center mt-5">
<div class="col-xl-10"> 
<div class="card">
<div class="card-body">

<form  action="/update/<?php echo $belanja['id'] ?>" method="post">
<div class="mb-3">
<label for="nama" class="form-label">Nama Barang</label>
<input type="text" name="nama" class="form-control" value="<?php echo $belanja['nama'] ?>" id="nama">
</div>
<div class="mb-3">
<label for="jumlah" class="form-label">Jumlah Barang</label>
<input type="number" class="form-control" name="jumlah" value="<?php echo $belanja['jumlah'] ?>" id="jumlah">
</div>
<div class="mb-3">
<label for="harga" class="form-label">Harga Barang</label>
<input type="number" class="form-control" name="harga" value="<?php echo $belanja['harga'] ?>" id="harga">
</div>
<button type="submit" class="btn btn-primary">update</button>
<a href="/" class="btn btn-warning">kembali</a>
</form>

</div>
</div>
</div>
</div>

<?= $this->endSection(); ?>