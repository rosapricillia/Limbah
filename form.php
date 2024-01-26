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
	<script type="text/javascript" src="jquery-1.8.2.min.js"></script>
	<script language="javascript">
    function tambahLimbah() {
            var idf = document.getElementById("idf").value;
            var stre;
            stre="<p id='srow" + idf + "'><select name='nama_limbah[]' id='nama_limbah'><option>--------Jenis Limbah--------</option><option value='Katoda (spent pot lining)'>Katoda (spent pot lining)</option><option value='Refraktory'>Refraktory</option><option value='Anode scraps'>Anode scraps</option><option value='Carbon Mix'>Carbon Mix</option><option value='Butt Dust'>Butt Dust</option><option value='Baking Filter Dust'>Baking Filter Dust</option><option value='Sludge dari IPAL'>Sludge dari IPAL</option><option value='Dross Hitam'>Dross Hitam</option></select>   <input type='text' id='jumlah_limbah' name='jumlah_limbah[]' placeholder='Jumlah Limbah (Ton)'>   <select id='sifat' name='sifat[]'><option>--------Sifat--------</option><option value='Beracun'>Beracun</option><option value='Tidak Beracun'>Tidak Beracun</option></select>   <select id='bentuk' name='bentuk[]'><option>--------Bentuk--------</option><option value='Bongkahan'>Bongkahan</option><option value='Curah'>Curah</option></select>   <select id='kondisi' name='kondisi[]'><option>--------Kondisi--------</option><option value='Terkemas'>Terkemas</option><option value='Belum Terkemas'>Belum Terkemas</option></select>  <a href='#' style=\"color:#3399FD;\" onclick='hapusElemen(\"#srow" + idf + "\"); return false;'>Hapus</a></p>";
            $("#divLimbah").append(stre); 
            idf = (idf-1) + 2;
            document.getElementById("idf").value = idf;
        }
    function hapusElemen(idf) {
            $(idf).remove();
        }
	</script>
	
	        <div class="col-sm-10 offset-sm-2 py-4">
	        	<span id="message"></span>
	            <div class="card">
	            	<div class="card-header">
	            		<div class="row">
	            			<div class="col-sm-4">
	            				<h2>Form</h2>
	            			</div>
	            		</div>
	            	</div>
	            <form method="post" action="proses.php">
		        <div class="modal-body">
		          <div class="form-group row">
		            <label for="seksi" class="col-sm-4 col-form-label">
		              Seksi</label>
		            <div class="col-sm-8">
		              <select class="form-control" id="seksi" name="seksi">
		              	<option>----Pilihan Seksi----</option>
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
		              </select>
		            </div>
		          </div>
		          <div class="form-group row">
		            <label for="nor" class="col-sm-4 col-form-label">
		              Nomor Request
		            </label>
		            <div class="col-sm-8">
		              <input type="text" class="form-control" id="nor" name="nor" placeholder="Seksi-Bulan-Berapa kali pengiriman ditahun ini" required>
		            </div>
		          </div>
		          <div class="form-group row">
		            <label for="tglr" class="col-sm-4 col-form-label">
		              Tanggal Request
		            </label>
		            <div class="col-sm-8	">
		              <input class="form-control datepicker" id="tglr" type="date" name="tglr" required>
		            </div>
		          </div>
		          <div class="form-group row">
		            <label for="tglp" class="col-sm-4 col-form-label">
		              Tanggal Pengiriman
		            </label>
		            <div class="col-sm-8	">
		              <input  class="form-control datepicker" id="tglp" type="date" name="tglp" required>
		            </div>
		          </div>
		          <input id="idf" value="1" type="hidden" />
		          <button type="button" onclick="tambahLimbah(); return false;">Tambah limbah</button>
    				<div id="divLimbah"></div>
    			<div class="form-group row">
		            <label for="ket" class="col-sm-4 col-form-label">
		              Keterangan
		            </label>
		            <div class="col-sm-8">
		              <textarea type="textarea" class="form-control" id="ket" name="ket"></textarea>
		            </div>
		          </div>	
		        </div>
		        <div class="modal-footer">
		          <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
		        </div>
		      </form>
	            </div>
	        </div>
	    </div>
	</div>
	<div id="notif"></div>
	 <script type="text/javascript">
	 $(function() {
  	  function notif() {
  	  	$('#notif').html('');
	    $.ajax({
	      url: 'proses.php',
	      success: function(data) {
	        if (data.length > 0) {
	        	$('#notif').html(data);
	        }
	      }
	    });
	  }
	  
	  // Update friends list every 5 seconds.
	  setInterval(notif, 5000);
	  
	});

    $(function(){
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });

    </script>