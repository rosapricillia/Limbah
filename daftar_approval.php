<?php

//visitor.php

include('vms.php');

$visitor = new vms();

if(!$visitor->is_login())
{
	header("location:".$visitor->base_url."");
}

include('header.php');

include('sidebar.php');


?>
	        <div class="col-sm-10 offset-sm-2 py-4">
	        	<span id="message"></span>
	            <div class="card">
	            	<div class="card-header">
	            		<div class="row">
	            			<div class="col-sm-4">
	            				<h2>Daftar Approval</h2>
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
										<th><p>Approval</p></th>
	            					</tr>
	            				</thead>
	            				<body>
	            				<?php 
	            				include'koneksi.php';
	            				$query = mysqli_query($connect, "SELECT * FROM form_table INNER JOIN jenis_limbah ON form_table.id=jenis_limbah.id INNER JOIN approval ON jenis_limbah.id_limbah=approval.id_limbah where jenis_limbah.status='approval'");
	            					while ($d = mysqli_fetch_array($query)) { 
	            						$rosa = $d['id_approval'];
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
	            							<td>
	            								<div align="center">
	            								<a href="pdf-approval.php?id=<?php echo $d['id_approval']; ?>"><i class="far fa-file-pdf" style="font-size:32px;color:black"></i></a>
												&nbsp;
											</div>
	            							</td>
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
    var table = $('#dataTable3').DataTable( {
        responsive: true
    } );
 
    new $.fn.dataTable.FixedHeader( table );
} );

</script>