<!DOCTYPE html>
<html>
<head>
	<title>Data Belanja</title>
</head>
<style>
    .table1 {
    font-family: sans-serif;
    color: #444;
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #f2f5f7;
}
 
.table1 tr th{
    background: #35A9DB;
    color: #fff;
    font-weight: normal;
}
 
.table1, th, td {
    padding: 8px 20px;
    text-align: center;
}
 
.table1 tr:hover {
    background-color: #f5f5f5;
}
 
.table1 tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>
<body>
	<center><h1>Data Belanja Kamu</h1></center>
	<table class="table1">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Jumlah</th>
			<th>Harga</th>
		</tr>
        <?php
          $no =1;
          foreach($belanjas as $data){
        ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $data['nama']; ?></td>
			<td><?php echo number_format($data['jumlah']); ?></td>
			<td><?php echo "Rp.".number_format($data['harga']); ?></td>
		</tr>
	<?php
          }
    ?>
	</table>	
</body>
</html>