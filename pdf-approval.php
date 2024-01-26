<?php
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
include'koneksi.php';
$id = $_GET['id'];
$sql = mysqli_query($connect, "SELECT * FROM form_table INNER JOIN jenis_limbah ON form_table.id=jenis_limbah.id INNER JOIN approval ON jenis_limbah.id_limbah=approval.id_limbah where approval.id_approval = '$id'");

	// $query = mysqli_query($connect, "SELECT * FROM form_table INNER JOIN jenis_limbah ON form_table.id=jenis_limbah.id");
	// while ($d = mysqli_fetch_array($sql)) { 
$d = mysqli_fetch_array($sql)
?>
<style>
	table, th, td{
		font-size: 12px;
		border:1px solid black;
		border-collapse: collapse;
		padding: 5px;
	}
</style>
<img src="images/logoinalum1.png" style="float: left; height: 20px">
<div style="text-align: center;">
	<h3>Fomulir Pengiriman Limbah B3 ke SPL Waste Storage</h3>
	<!-- <div style="font-style: 5px">Fomulir Pengiriman Limbah B3 ke SPL Waste Storage</div> -->
</div>
<!-- <h3>Fomulir Pengiriman Limbah B3 ke SPL Waste Storage</h3> -->
<hr>
<div style="width: 50%; font-weight: bold;">Seksi</div>
<?php echo $d['seksi']?><br><br>
<div style="width: 50%; font-weight: bold;">Nomor Request</div>
<?php echo $d['nomor_request']?><br><br>
<div style="width: 50%; font-weight: bold;">Tanggal Request</div>
<?php echo $d['tanggal_request']?><br><br>
<div style="width: 50%; font-weight: bold;">Tanggal Pengiriman</div>
<?php echo $d['tanggal_pengiriman']?><br><br><br>
<table border="1" style="width: 120%; font-size: 20px;">
	<tr>
		<th> Nama Limbah</th>
		<th>Jumlah (Ton)</th>
		<th>Sifat</th>
		<th>Bentuk</th>
		<th>Kondisi</th>
	</tr>
	<tr>
		<td><?php echo $d['nama_limbah']?></td>
		<td><?php echo $d['jumlah_limbah']?></td>
		<td><?php echo $d['sifat']?></td>
		<td><?php echo $d['bentuk']?></td>
		<td><?php echo $d['kondisi']?></td>
	</tr>
</table>
<br><br>
<div style="width: 50%; font-weight: bold;">Keterangan</div>
<?php echo $d['keterangan']?><br><br>
<br><br><br>
</br>
<!-- <div> -->
	
<!-- </div style="width: 50%; text-align: left; float: left; font-weight: bold;">
<p>Tanda Tangan Pengirim</p>
<hr>
<p>Tanda Tangan Penerima</p>
<hr>
</div>	 -->
<style type="text/css">
	table.table1 tbody{
		border : none;
	}

	table.table1 tr td,
	table.table1 tr {		
		/*border : 0px solid;*/
		font-size: 15px;
		border-collapse: none;
	}
</style>
<table style="width: 100%;border:none" class="table1">
	<tr>
		<td style="width:5%;border: 0px solid #000 !important;"></td>
		<td style="text-align:center;border: 0px solid #000 !important;">Tanda Tangan Pengirim</td>
		<td style="border: 0px solid #000 !important;"></td>
		<td style="text-align:center;border: 0px solid #000 !important;">Tanda Tangan Penerima</td>
		<td style="width:5%;border: 0px solid #000 !important;"></td>
	</tr>
	<tr>
		<td style="padding-top: 120px;border: 0px solid #000 !important"></td>
		<td style="border-top: 1px solid #000 !important;border-left: 0px solid #000 !important;border-right: 0px solid #000 !important"></td>
		<td style="border: 0px solid #000 !important;border-left: 0px solid #000 !important;border-right: 0px solid #000 !important"></td>
		<td style="border-top: 1px solid #000 !important;border-left: 0px solid #000 !important;border-right: 0px solid #000 !important"></td>
		<td style="border: 0px solid #000 !important;"></td>
	</tr>
</table>
<!-- <div style="width: 50%; text-align: left; float: left; font-weight: bold;">Tanda Tangan Pengirim</div>
<div style="width: 50%; text-align: right; float: right; font-weight: bold;">Tanda Tangan Penerima</div><br><br><br><br><br><br> 
<hr style="width: 25%; text-align: right; float: center;">
<hr style="width: 25%; text-align: left; float: left;"> -->
<br> 
<img src="images/approvedd.png" style="float: left; height: 25px">

<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_decode($html));
$mpdf->Output();
exit;
?>