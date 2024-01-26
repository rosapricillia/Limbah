<?php
// include'koneksi.php';
// // $sql = mysqli_query($connect, "SELECT * FROM form_table INNER JOIN jenis_limbah ON form_table.id=jenis_limbah.id INNER JOIN approval ON jenis_limbah.id_limbah=approval.id_limbah INNER JOIN penyimpanan_tps ON approval.id_approval=penyimpanan_tps.id_approval");
// $sql = mysqli_query($connect, "SELECT jenis_limbah from approval , (SELECT COUNT(*) FROM jenis_limbah WHERE nama_limbah=A.nama_limbah) AS jumlah FROM approval A ORDER BY A.nama_limbah");
// $no = 1;
// $jum = 1;
// echo '<center>';
// echo '<table cellpadding="5 " border="1">';
// echo '<tr><th>No</th><th>Jenis Limbah B3 Masuk</th><th>Tanggal Limbah B3 Masuk</th><th>Sumber Limbah B3 Masuk</th><th>Jumlah Limbah B3 Masuk (Ton)</th><th>Maksimal Penyimpanan s/d tanggal (t=0 + 90 hr, 180hr)</th><th>Tanggal Limbah B3 Keluar</th><th>Jumlah Limbah B3 keluar</th><th>Tujuan Penyerahan</th><th>Bukti Nomor Dokumen</th><th>Sisa Limbah B3 yang ada di TPS</th></tr>';
// while($row = mysqli_fetch_array($sql)) {       
//     echo '<tr>';
//     if($jum <= 1) {
//         echo '<td align="center" rowspan="'.$row['jumlah'].'">'.$no.'</td>';
//         echo '<td rowspan="'.$row['jumlah'].'">'.$row['nama_limbah'].'</td>';  
//         $jum = $row['jumlah'];       
//         $no++;                     
//     } else {
//         $jum = $jum - 1;
//     }
//     echo '<td>'.$row['tanggal_masuk'].'</td>'; 
//     echo '<td></td>'; 
//     echo '<td>'.$row['jumlah_limbah'].'</td>'; 
//     echo '<td></td>'; 
//     echo '<td></td>'; 
//     echo '<td></td>'; 
//     echo '<td></td>'; 
//     echo '<td></td>'; 
//     echo '<td></td>'; 
//     echo '<td></td>';    
//     echo '</tr>';              
// }
// echo '</table>';
// echo '</center>';
?>

<!DOCTYPE html>
<html>
<head>
	<title>LEMBAR NERACA LIMBAH BAHAN BERBAHAYA DAN BERACUN</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	.h1{
		color: : grey;
	}
	.h3{
		color: white;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
 
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>
 
	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Neraca.xls");
	?>
 
	<center>
		<h1>LEMBAR NERACA LIMBAH BAHAN BERBAHAYA DAN BERACUN</h1>
		<h3>PT INDONESIA ASAHAN ALUMINIUM (Persero)-KUALA TANJUNG</h3>
	</center>
 
	<table border="1">
		<tr style="background: #f5f5f5; text-align: center;">
			<th>No</th>
			<th>Jenis Limbah B3 Masuk</th>
			<th>Tanggal Limbah B3 Masuk</th>
			<th>Sumber Limbah B3 Masuk</th>
			<th>Jumlah Limbah B3 Masuk <br>(Ton)</th>
			<th>Maksimal Penyimpanan s/d tanggal<br>(t=0 + 90 hr, 180hr)</th>
			<th></th>
			<th>Tanggal Limbah B3 Keluar</th>
			<th>Jumlah Limbah B3 keluar<br>(Ton)</th>
			<th>Tujuan Penyerahan</th>
			<th>Bukti Nomor Dokumen</th>
			<th>Sisa Limbah B3 <br>yang ada di TPS</th>
		</tr>
		<?php 
		include'koneksi.php';
		$no = 0;
		$query = mysqli_query($connect, "SELECT * FROM form_table INNER JOIN jenis_limbah ON form_table.id=jenis_limbah.id INNER JOIN approval ON jenis_limbah.id_limbah=approval.id_limbah INNER JOIN penyimpanan_tps ON approval.id_approval=penyimpanan_tps.id_approval");
			while ($d = mysqli_fetch_array($query)) {
		$no++;
		$tgl1 = $d['tanggal_masuk'];// pendefinisian tanggal awal
		$tgl2 = date('Y-m-d', strtotime('+90 days', strtotime($tgl1)));
		?>
		<tr>
			<td><?=$no?></td>
			<td><?=$d['nama_limbah']?></td>
			<td><?=$d['tanggal_masuk']?></td>
			<td></td>
			<td><?=$d['jumlah_limbah']?></td>
			<td><?=$tgl2?></td>
			<td></td> 
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?php 
		}
		?>
	</table>
</body>
</html>