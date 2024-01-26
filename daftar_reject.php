<?php

//visitor.php

include('vms.php');

$visitor = new vms();

if(!$visitor->is_login())
{
	header("location:".$visitor->base_url."");
}

// $visitor->query = "
// SELECT * FROM admin_table 
// WHERE admin_seksi = '".$_SESSION["admin_seksi"]."'
// ";

include('header.php');

include('sidebar.php');


?>
	        <div class="col-sm-10 offset-sm-2 py-4">
	        	<span id="message"></span>
	            <div class="card">
	            	<div class="card-header">
	            		<div class="row">
	            			<div class="col-sm-4">
	            				<h2>Daftar Reject</h2>
	            			</div>
	            		</div>
	            	</div>
	            	<div class="card-body">
	            		<div class="table-responsive">
	            			<table class="table table-responsive table-striped table-bordered" id="dataTable3">
	            				<thead>
	            					<tr style="text-align:center">
	            						<th><p>Seksi</p></th>
										<th><p>Nomor Request</p></th>
										<th><p>Tanggal Request</p> </th>
										<th><p>Tanggal Pengiriman</p></th>
										<th> <p>Nama Limbah</p></th>
										<th>Jumlah Limbah (Ton)</th>
										<th><p>Sifat</p></th>
										<th><p>Bentuk</p></th>
										<th><p>Kondisi</p></th>
										<th><p>Keterangan</p></th>
										<th><p>Keterangan Reject</p></th>
	            					</tr>
	            				</thead>
	            				<body>
	            				<?php 
	            				include'koneksi.php';
	            				$query = mysqli_query($connect, "SELECT * FROM form_table INNER JOIN jenis_limbah ON form_table.id=jenis_limbah.id INNER JOIN reject ON jenis_limbah.id_limbah=reject.id_limbah where jenis_limbah.status ='reject'");
	            					while ($d = mysqli_fetch_array($query)) { 
	            						$rosa = $d['id_limbah'];
	            						?>
	            						<tr>
	            							<td><?=$d['seksi']?></td>
	            							<td><?=$d['nomor_request']?></td>
	            							<td><?=$d['tanggal_request']?></td>
	            							<td><?=$d['tanggal_pengiriman']?></td>
	            							<td><?=$d['nama_limbah']?></td>
	            							<td><?=$d['jumlah_limbah']?></td>
	            							<td><?=$d['sifat']?></td>
	            							<td><?=$d['bentuk']?></td>
	            							<td><?=$d['kondisi']?></td>
	            							<td><?=$d['keterangan']?></td>
	            							<td><?=$d['keterangan_reject']?></td>
	            						</tr>
	            					<?php
	            					}
	            					 ?>
	            				</body>
	            			</table>
	            		</div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>

</body>
</html>

<script>

$(document).ready(function() {
$('#dataTable3').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'print'
    ]
} );
} );

</script>