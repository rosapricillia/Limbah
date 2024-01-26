<?php
$SqlPeriode="";
$awalTgl="";
$akhirTgl="";
$tglAwal="";
$tglAkhir="";

if(isset($_POST['btnTampil'])){
	$tglAwal = isset($_POST['txtTglAwal'])?$_POST['txtTglAwal'] : "01-".date('m-Y');
	$tglAkhir = isset($_POST['txtTglAkhir'])?$_POST['txtTglAkhir']: date('d-m-Y');
	$SqlPeriode = "where A.tanggal_keluar BETWEEN '".$tglAwal."'AND'".$tglAkhir."'";
}else{
	$awalTgl = "01-".date('m-Y');
	$akhirTgl = date('d-m-Y');

	$SqlPeriode = "where neraca.tanggal_keluar BETWEEN '".$awalTgl."' AND '".$akhirTgl."'";
}
?>
<div class="card-body">
<div class="table-responsive">
<div id="alert_message"></div>
<p></p>
	<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="form10" target="_self">
		<div class="row">
			<div class="col-lg-3">
				<input name="txtTglAwal" class="form-control datepicker" size="10">
			</div>
			<div class="col-lg-3">
				<input name="txtTglAkhir" class="form-control datepicker" size="10">
			</div>
			<div class="col-lg-3">
				<input name="btnTampil" class="btn btn-success" type="button" value="Lihat">
			</div>
			<h3>Periode Tanggal <b><?php echo ($tglAwal); ?> </b> s/d <b><?php echo ($tglAkhir);?>	</b></h3>
		</div>
	</form>
	<table class="table table-responsive table-striped table-bordered" id="dataTable3">
		<thead>
			<tr style="text-align:center">
				<th>No</th>
				<th>Jenis Limbah B3 Masuk</th>
				<th>Tanggal Masuk Limbah B3</th>
				<th>Jumlah Limbah B3 yang Masuk (Ton)</th>
				<th>Maksimal Penyimpanan</th>
				<th>Sisa LB3 yang ada di TPS</th>
				<th><p>Action</p></th>
			</tr>
		</thead>
		<body>
		<?php 
		include'koneksi.php';
		$no = 0;
		$query = mysqli_query($connect, "SELECT * FROM form_table INNER JOIN jenis_limbah ON form_table.id=jenis_limbah.id INNER JOIN approval ON jenis_limbah.id_limbah=approval.id_limbah INNER JOIN penyimpanan_tps ON approval.id_approval=penyimpanan_tps.id_approval");
			while ($d = mysqli_fetch_array($query)) {
				$ara = $d['id_approval'];
				$no++;
				$tgl1 = $d['tanggal_masuk'];// pendefinisian tanggal awal
				$tgl2 = date('Y-m-d', strtotime('+90 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 90 hari
				?>
				<tr>
					<td><?=$no?></td>
					<td><?=$d['nama_limbah']?></td>
					<td><?=$d['tanggal_masuk']?></td>
					<td><?=$d['jumlah_limbah']?></td>
					<td><?=$tgl2?></td>
					<td></td>
					<td>
						<div class="col-sm-8" align="center">
						<button type="button" class="btn btn-danger btn-sm ibutton" name="save" id="save" data-id="<?php echo $ara; ?>" data-toggle="modal" data-target="#neracamodal" ><i class="fas fa-sign-out-alt"></i></button>	
						<p></p>
						<button type="button" class="btn btn-warning btn-sm ebutton" name="save" id="save" data-id="<?php echo $ara; ?>" data-toggle="modal" data-target="#editneraca" ><i class="fas fa-edit"></i></button>
						</div>
					</form>
					</td>
				</tr>
				<!-- insert neraca -->
				<div class="modal fade" id="neracamodal"  tabindex="-1" role="dialog" aria-labelledby="neracamodal" aria-hidden="true">
				 <div class="modal-dialog">
				  <div class="modal-content">
				   <div class="modal-header">
				    <h4 class="modal-title">Input</h4>
				   </div>
				   <div class="modal-body">
				    <form method="post" id="neraca_form" action="proses.php">
				     <div class="form-group row">
				    <label for="sumber" class="col-sm-4 col-form-label">Sumber Limbah B3 Masuk</label>
				    <div class="col-sm-8">
				      <input class="form-control" type="text" name="sumber" required>
				    </div>
				    </div>
				    <div class="form-group row">
				    <label for="tglk" class="col-sm-4 col-form-label">Tanggal Keluar Limbah</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control datepicker" name="tglk" value="yyyy-mm-dd" required>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="jmlkeluar" class="col-sm-4 col-form-label">Jumlah Limbah B3 Keluar (Ton)</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" name="jmlkeluar" required>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="tujuan" class="col-sm-4 col-form-label">Tujuan Penyerahan</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" name="tujuan" required>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="bukti" class="col-sm-4 col-form-label">Bukti Nomor Dokumen</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" name="bukti" required>
				    </div>
				  </div>
				  <div class="modal-footer">
				   	<button type="submit" name="btnneraca" class="btn btn-success">Submit</button>
				   </div>
				    </form>
				   </div>
				  </div>
				 </div>
				</div>
				<!-- edit -->
				<div class="modal fade" id="editneraca" tabindex="-1" role="dialog">
			        <div class="modal-dialog" role="document">
			            <div class="modal-content">
			                <div class="modal-header">
			                    <h5 class="modal-title">Edit</h5>
			                </div>
			                <div class="modal-body" id="detaileditneraca">
			                </div>
			            </div>
			        </div>
			    </div>
			<?php
			}
			 ?>
		</body>
	</table>
</div>
</div>
<script>
$(document).ready(function() {
$('#dataTable3').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'print'
    ]
} );

$('.ebutton').on('click', function () {
    
	var data_id = $(this).data("id")
	$.ajax({
		url: "edit_neraca.php",
		method: "POST",
		data: {data_id : data_id},
		success: function(data){
			$("#detaileditneraca").html(data)
			$("#editneraca").modal('show')
		}
	})

})
} );

$(function(){
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });

</script>