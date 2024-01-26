<div class="card-body">
<div class="table-responsive">
<div id="alert_message"></div>
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
	<th><p>Action</p></th>
</tr>
</thead>
<body>
<?php 
include'koneksi.php';
$sql = "SELECT * FROM form_table INNER JOIN jenis_limbah ON form_table.id=jenis_limbah.id INNER JOIN approval ON jenis_limbah.id_limbah=approval.id_limbah";
$result = mysqli_query($connect, $sql);
	while ($d = mysqli_fetch_array($result)) { 
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
		<td><div align="center">
			<button type="button" class="btn btn-success btn-sm submit_button" data-toggle="modal" data-target="#editM" data-id="<?php echo $rosa; ?>"><i class="fa fa-arrow-up"></i></button>
			<p></p>
			<button type="button" class="btn btn-danger btn-sm reject" data-toggle="modal" data-target="#rejectM<?=$d['id_approval'];?>" data-id="<?php echo $rosa; ?>"><i class="fas fa-times"></i></button>
			</div>
		</form>
		</td>
	</tr>
	<!-- edit -->
	<div class="modal fade" id="editM" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                </div>
                <div class="modal-body" id="detailEditP">
                </div>
            </div>
        </div>
    </div>
    <!-- reject -->
    <div class="modal fade" id="rejectM<?php echo $d['id_approval']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="proses.php" method="POST" class="form-user">
        	        <input type="hidden" class="form-control" name="rejecttp" value="<?php echo $d['id_approval']; ?>">
                <div class="form-group row">
		            <label for="ketreject" class="col-sm-4 col-form-label">
		              Keterangan
		            </label>
		            <div class="col-sm-8">
		              <textarea type="textarea" class="form-control" id="ket_rejectp" name="ket_rejectp" required></textarea>
		            </div>
		          </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                        <button type="submit" name="rejectP" id="rejectP" class="btn btn-primary"> Reject </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- insert tps -->
<div class="modal fade" id="binsert"  tabindex="-1" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">Input Data</h4>
   </div>
   <div class="modal-body">
    <form method="POST" id="insert_form" action="proses.php">
      <input type="hidden" class="form-control" name="penyimpananE" value="<?php echo $d['id_approval']; ?>">
     <div class="form-group row">
    <label for="tglM" class="col-sm-4 col-form-label">Tanggal Masuk Limbah B3</label>
    <div class="col-sm-8">
      <input class="form-control datepicker" type="text" id="tglM" name="tglM" value="yyyy-mm-dd" required="">
    </div>
    </div>
    <div class="form-group row">
    <label for="tps" class="col-sm-4 col-form-label">Gudang TPS</label>
    <div class="col-sm-8">
      <select class="form-control" name="tps">
      <?php
      include 'Koneksi.php';
        $sql="select * from tps";

        $hasil=mysqli_query($connect,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)) {
        $no++;
       ?>
        <option value="<?php echo $data['id_tps'];?>"><?php echo $data['tps'];?></option>
      <?php 
      }
      ?>
      </select>
    </div>
  </div>
  <div class="modal-footer">
   	<button type="submit" name="inserttps" id="inserttps" class="btn btn-success">Insert</button>
   </div>
    </form>
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
  $(function(){
    $(".datepicker").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });
});

$(document).ready(function () {

  $('#dataTable3').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'print'
    ]
  });

$('.submit_button').on('click', function () {
    
	var data_id = $(this).data("id")
	$.ajax({
		url: "edit_penyimpanan.php",
		method: "POST",
		data: {data_id : data_id},
		success: function(data){
			$("#detailEditP").html(data)
			$("#editM").modal('show')
		}
	})

})
});
</script>