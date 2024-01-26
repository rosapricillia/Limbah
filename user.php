<?php

//user.php

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
	            			<div class="col">
	            				<h2>User Management</h2>
	            			</div>
	            			<div class="col text-right">
	            				<button type="button" name="add_user" id="add_user" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button>
	            			</div>
	            		</div>
	            	</div>
	            	<div class="card-body">
	            		<div class="table-responsive">
	            			<table class="table table-striped table-bordered" id="user_table">
	            				<thead>
	            					<tr>
	            						<th>Image</th>
	            						<th>User Name</th>
										<th>User Contact No.</th>
										<th>User Email</th>
										<th>Created On</th>					
										<th>Action</th>
	            					</tr>
	            				</thead>
	            			</table>
	            		</div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>

</body>
</html>

<div id="userModal" class="modal fade">
  	<div class="modal-dialog">
    	<form method="post" id="user_form" enctype="multipart/form-data">
      		<div class="modal-content">
        		<div class="modal-header">
          			<h4 class="modal-title" id="modal_title">Add User</h4>
          			<button type="button" class="close" data-dismiss="modal">&times;</button>
        		</div>
        		<div class="modal-body">
		          	<div class="form-group">
		          		<div class="row">
			            	<label class="col-md-4 text-right">User Name <span class="text-danger">*</span></label>
			            	<div class="col-md-8">
			            		<input type="text" name="admin_name" id="admin_name" class="form-control" required data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-maxlength="150" data-parsley-trigger="keyup" />
			            	</div>
			            </div>
		          	</div>
		          	<div class="form-group">
		          		<div class="row">
			            	<label class="col-md-4 text-right">Seksi <span class="text-danger">*</span></label>
			            	<div class="col-md-8">
			            		<select class="form-control" id="admin_seksi" name="admin_seksi" equired data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-maxlength="150" data-parsley-trigger="keyup">
				              	<option>----------Pilihan Seksi----------</option>
				                <option value="SQA">SQA</option>
				                <option value="SES">SES</option>
				                <option value="SCP">SCP</option>
				                <option value="SMB">SMB</option>
				                <option value="SWH">SWH</option>
				                <option value="SGA-MO">SGA-MO</option>
				                <option value="SGA-TO">SGA-TO</option>
				                <option value="SCO">SCO</option>
				                <option value="SCA">SCA</option>
				                <option value="SMT">SMT</option>
				                <option>-</option>
				              </select>
			            	</div>
			            </div>
		          	</div>
		          	<div class="form-group">
		          		<div class="row">
			            	<label class="col-md-4 text-right">User Contact No. <span class="text-danger">*</span></label>
			            	<div class="col-md-8">
			            		<input type="text" name="admin_contact_no" id="admin_contact_no" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" />
			            	</div>
			            </div>
		          	</div>
		          	<div class="form-group">
		          		<div class="row">
			            	<label class="col-md-4 text-right">User Email <span class="text-danger">*</span></label>
			            	<div class="col-md-8">
			            		<input type="text" name="admin_email" id="admin_email" class="form-control" required data-parsley-type="email" data-parsley-maxlength="150" data-parsley-trigger="keyup" />
			            	</div>
			            </div>
		          	</div>

		          	<div class="form-group">
		          		<div class="row">
			            	<label class="col-md-4 text-right">User Password <span class="text-danger">*</span></label>
			            	<div class="col-md-8">
			            		<input type="password" name="admin_password" id="admin_password" class="form-control" required data-parsley-minlength="6" data-parsley-maxlength="16" data-parsley-trigger="keyup" />
			            	</div>
			            </div>
		          	</div>
		          	
		          	<div class="form-group">
		          		<div class="row">
			            	<label class="col-md-4 text-right">User Profile</label>
			            	<div class="col-md-8">
			            		<input type="file" name="user_image" id="user_image" />
								<span id="user_uploaded_image"></span>
			            	</div>
			            </div>
		          	</div>
        		</div>
        		<div class="modal-footer">
          			<input type="hidden" name="hidden_id" id="hidden_id" />
          			<input type="hidden" name="action" id="action" value="Add" />
          			<input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Add" />
          			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        		</div>
      		</div>
    	</form>
  	</div>
</div>

<script>

$(document).ready(function(){

	var dataTable = $('#user_table').DataTable({
		"processing" : true,
		"serverSide" : true,
		"order" : [],
		"ajax" : {
			url:"user_action.php",
			type:"POST",
			data:{action:'fetch'}
		},
		"columnDefs":[
			{
				"targets":[0, 5],
				"orderable":false,
			},
		],
	});

	$('#add_user').click(function(){		
		$('#user_form')[0].reset();
		$('#user_form').parsley().reset();
    	$('#modal_title').text('Add User');
    	$('#action').val('Add');
    	$('#submit_button').val('Add');
    	$('#userModal').modal('show');

    	$('#admin_password').attr('required', true);

	    $('#admin_password').attr('data-parsley-minlength', '6');

	    $('#admin_password').attr('data-parsley-maxlength', '16');

	    $('#admin_password').attr('data-parsley-trigger', 'keyup');
	});

	$('#user_image').change(function(){
		var extension = $('#user_image').val().split('.').pop().toLowerCase();
		if(extension != '')
		{
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
			{
				alert("Invalid Image File");
				$('#user_image').val('');
				return false;
			}
		}
	});

	$('#user_form').parsley();

	$('#user_form').on('submit', function(event){
		event.preventDefault();
		if($('#user_form').parsley().isValid())
		{		
			var extension = $('#user_image').val().split('.').pop().toLowerCase();
			if(extension != '')
			{
				if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
				{
					alert("Invalid Image File");
					$('#user_image').val('');
					return false;
				}
			}
			$.ajax({
				url:"user_action.php",
				method:"POST",
				data:new FormData(this),
				contentType:false,
				processData:false,
				beforeSend:function()
				{
					$('#submit_button').attr('disabled', 'disabled');
					$('#submit_button').val('wait...');
				},
				success:function(data)
				{
					$('#submit_button').attr('disabled', false);
					$('#userModal').modal('hide');
					$('#message').html(data);
					dataTable.ajax.reload();
					setTimeout(function(){
						$('#message').html('');
					}, 5000);
				}
			})
		}
	});

	$(document).on('click', '.edit_button', function(){
		var admin_id = $(this).data('id');
		$('#user_form').parsley().reset();
		$.ajax({
	      	url:"user_action.php",
	      	method:"POST",
	      	data:{admin_id:admin_id, action:'fetch_single'},
	      	dataType:'JSON',
	      	success:function(data)
	      	{
	        	$('#admin_name').val(data.admin_name);
	        	$('#visitor_email').val(data.visitor_email);
	        	$('#admin_contact_no').val(data.admin_contact_no);
	        	$('#admin_email').val(data.admin_email);

	        	$('#user_uploaded_image').html('<img src="'+data.admin_profile+'" class="img-fluid img-thumbnail" width="75" height="75" /><input type="hidden" name="hidden_user_image" value="'+data.admin_profile+'" />');

	        	$('#admin_password').attr('required', false);

	        	$('#admin_password').attr('data-parsley-minlength', '');

	        	$('#admin_password').attr('data-parsley-maxlength', '');

	        	$('#admin_password').attr('data-parsley-trigger', '');
	        	
	        	$('#modal_title').text('Edit Data');
	        	$('#action').val('Edit');
	        	$('#submit_button').val('Edit');
	        	$('#userModal').modal('show');
	        	$('#hidden_id').val(admin_id);

	      	}
	    })
	});

  	$('#visitor_details_form').parsley();

  	$('#visitor_details_form').on('submit', function(event){
  		event.preventDefault();
  		if($('#visitor_details_form').parsley().isValid())
		{		
			$.ajax({
				url:"visitor_action.php",
				method:"POST",
				data:$(this).serialize(),
				beforeSend:function()
				{
					$('#detail_submit_button').attr('disabled', 'disabled');
					$('#detail_submit_button').val('wait...');
				},
				success:function(data)
				{
					$('#detail_submit_button').attr('disabled', false);
					$('#detail_submit_button').val('Save');
					$('#visitordetailModal').modal('hide');
					$('#message').html(data);
					dataTable.ajax.reload();
					setTimeout(function(){
						$('#message').html('');
					}, 5000);
				}
			});
		}
  	});

});

</script>