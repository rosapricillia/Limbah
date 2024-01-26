<?php

//visitor.php

include('vms.php');

$visitor = new vms();

include('header.php');

include('sidebar.php');

?>
	        <div class="col-sm-10 offset-sm-2 py-4">
	        	<span id="message"></span>
	            <div class="card">
	            	<div class="card-header">
	            		<div class="row">
	            			<div class="col-sm-4">
	            				<h2>Approval</h2>
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
										<th><p>Action</p></th>
	            					</tr>
	            				</thead>
	            				<tbody>
	            					<?php 
	            				include'koneksi.php';
	            				$sql = "SELECT * FROM form_table inner join jenis_limbah on form_table.id=jenis_limbah.id where jenis_limbah.status='waiting'";
								$result = mysqli_query($connect, $sql);
	            					while ($data = mysqli_fetch_array($result)) { 
	            						$rosa = $data['id_limbah'];
	            						?>
	            						<tr>
	            							<td><?=$data['seksi']?></td>
	            							<td><?=$data['nomor_request']?></td>
	            							<td><?=$data['tanggal_request']?></td>
	            							<td><?=$data['tanggal_pengiriman']?></td>
	            							<td><?=$data['nama_limbah']?></td>
	            							<td><?=$data['jumlah_limbah']?></td>
	            							<td><?=$data['sifat']?></td>
	            							<td><?=$data['bentuk']?></td>
	            							<td><?=$data['kondisi']?></td>
	            							<td><?=$data['keterangan']?></td>
	            							<td>
	            								<div align="center">
	            								<button type="button" class="btn btn-success btn-sm approve_button" data-toggle="modal" data-target="#approvalModal<?=$data['id_limbah'];?>" data-id="<?php echo $rosa; ?>"><i class="fas fa-check"></i></button>
												&nbsp; <p></p>
												<button type="button" class="btn btn-warning btn-sm editBTN" data-toggle="modal" data-target="#editModal" data-id="<?php echo $rosa; ?>"><i class="fas fa-edit"></i></button>
												&nbsp; <p></p>
												<button type="button" class="btn btn-danger btn-sm rejectbtn" data-toggle="modal" data-target="#rejectModal<?=$data['id_limbah'];?>" data-id="<?php echo $rosa; ?>"><i class="fas fa-times"></i></button>
												&nbsp;
											</div>
	            							</td>
	            						</tr>
	            						<!-- edit -->
										<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
									        <div class="modal-dialog" role="document">
									            <div class="modal-content">
									                <div class="modal-header">
									                    <h5 class="modal-title">Edit</h5>
									                </div>
									                <div class="modal-body" id="detailEdit">
									                </div>
									                <div class="modal-footer">
									                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									                </div>
									            </div>
									        </div>
									    </div>
									<!-- reject -->
									    <div class="modal fade" id="rejectModal<?=$data['id_limbah'];?>" tabindex="-1" role="dialog">
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
							                	        <input type="hidden" class="form-control" name="id_limbahU" value="<?php echo $data['id_limbah']; ?>">
									                <div class="form-group row">
											            <label for="ketreject" class="col-sm-4 col-form-label">
											              Keterangan
											            </label>
											        <div class="col-sm-8">
											             <textarea type="textarea" class="form-control" id="ketreject" name="ketreject" required></textarea>
											        </div>
											        </div>
									                </div>
									                <div class="modal-footer">
								                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
								                        <button type="submit" name="reject" class="btn btn-primary"> Reject </button>
								                    </div>
									                </form>
									            </div>
									        </div>
									    </div>
									</div>
									<!-- approval -->
									<div class="modal fade" id="approvalModal<?=$data['id_limbah'];?>" tabindex="-1" role="dialog">
							        <div class="modal-dialog" role="document">
							            <div class="modal-content">
									    <form action="proses.php" method="POST">
                                            <input type="hidden" name="appid" value="<?php echo $data['id_limbah']; ?>">
                                            <button><a href="proses.php?id=<?php echo $data['id_limbah']; ?>"><input type="submit" class="btn btn-sm btn-success" name="verifikasi" value="Verifikasi"></a>
                                        </form>
		                                    </div>
		                                </div>
		                            </div>

	            					<?php
	            					}
	            			
	            					 ?>
	            				</tbody>
	            			</table>
	            		</div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>

</body>
</html>
	
	 <script type="text/javascript">
        $(function(){
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });
	$(document).ready(function() {
	    var table = $('#dataTable3').DataTable( {
	        responsive: true
	    } );
	 
	    new $.fn.dataTable.FixedHeader( table );
	} );

    $(document).ready(function () {

	    $('.editBTN').on('click', function () {
	        
	    	var data_id = $(this).data("id")
	    	$.ajax({
	    		url: "edit_button.php",
	    		method: "POST",
	    		data: {data_id : data_id},
	    		success: function(data){
	    			$("#detailEdit").html(data)
	    			$("#editModal").modal('show')
	    		}
	    	})

	    })

		// $('.rejectbtn').click(function(){
		// 	var data_id = $('.form-user').serialize();
		// 	$.ajax({
		// 		type: 'POST',
		// 		url: "proses.php",
		// 		data: {data_id : data_id},
		// 		success: function() {
		// 			// $("#form-user").html(data)
		// 			$('#form-user').load("daftar_reject.php");
		// 		}
		// 	});
		// });
	});

    </script>