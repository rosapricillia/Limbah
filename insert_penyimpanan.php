<div class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" id="biinsertscrol">Input Data</h4>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
     <div class="form-group row">
    <label for="tglM" class="col-sm-4 col-form-label">Tanggal Masuk Limbah B3</label>
    <div class="col-sm-8">
      <input class="form-control datepicker" type="date" name="tglrM" required>
    </div>
    </div>
    <div class="form-group row">
    <label for="tps" class="col-sm-4 col-form-label">Gudang TPS</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name="tps" required>
    </div>
  </div>
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
 
    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>
<script type="text/javascript">
$(function(){
    $(".datepicker").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });
});
$(document).ready(function(){
// Begin Aksi Insert
 $('#insert_form').on("submit", function(event){  
  event.preventDefault(); 
   $.ajax({  
    url:"proses.php",  
    method:"POST",  
    data:$('#insert_form').serialize(),  
    beforeSend:function(){  
     $('#insert').val("Inserting");  
    },  
    success:function(data){  
     $('#insert_form')[0].reset();  
     $('#binset').modal('hide');  
     $('#employee_table').html(data);  
    }  
   });  
  }) ;
 });
</script>