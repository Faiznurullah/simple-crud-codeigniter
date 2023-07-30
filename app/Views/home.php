<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<div class="row justify-content-center mt-5">
<div class="col-xl-10"> 
<?php if (session()->has('success')): ?>
    <div class="alert alert-success">
        <?php echo session('success'); ?>
    </div>
<?php endif; ?>

<h3>Hai,  <?php echo $_SESSION['name']; ?> </h3>
<a class="btn btn-success" href="/create">Tambah</a>
<a class="btn btn-danger" href="/logout">Logout</a>
<a class="btn btn-info" href="/exportpdf">Export PDF</a> 
<table id="myTable" class="table">
<thead>
<tr>
<th scope="col">No</th>
<th scope="col">Nama</th>
<th scope="col">Jumlah</th>
<th scope="col">Harga</th>
<th scope="col">Aksi</th>
</tr>
</thead>
<tbody>

<?php 
$no = 1;
foreach ($belanjas as $belanja): 
?>
<tr>
<th scope="row"><?php echo $no++; ?></th>
<td><?php echo $belanja['nama']; ?></td>
<td><?php echo $belanja['jumlah']; ?></td>
<td><?php echo "Rp.".number_format($belanja['harga']); ?></td>
<td>
<a href="/edit/<?php echo $belanja['id']; ?>" type="button" class="btn btn-primary">Edit</a>
<a href="/delete/<?php echo $belanja['id']; ?>" onclick="return confirm('are you sure?')" type="button" class="btn btn-danger">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
<?= $this->endSection(); ?>