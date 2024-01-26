<?php

//gudang_penyimpanan.php

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
    			<div class="col-sm-6">
    				<h2>Gudang Penyimpanan Limbah B3</h2>
    			</div>
    		</div>
    	</div>
    	<div class="row menu">
		  <div class="col-sm-4"> &nbsp;&nbsp;
		    <div class="card">
		      <div class="card-body">
		        <h5 class="card-title">Form Penyimpanan</h5>
		        <p class="card-text">Menentukan TPS penyimpanan limbah b3</p>
		        <a id="penyimpanan" class="btn btn-primary klik_menu">Go</a>
		      </div>
		    </div>
		  </div>
		  <div class="col-sm-4">&nbsp;&nbsp;
		    <div class="card">
		      <div class="card-body">
		        <h5 class="card-title">TPS Penyimpanan limbah B3</h5>
		        <p class="card-text">Gudang TPS Limbah B3</p>
		        <a id="tps" class="btn btn-primary klik_menu">Lihat</a>
		      </div>
		    </div>
		  </div>
		  <div class="col-sm-4">&nbsp;&nbsp;
		    <div class="card">
		      <div class="card-body">
		        <h5 class="card-title">Neraca</h5>
		        <p class="card-text">Laporan neraca</p>
		        <a id="neraca" class="btn btn-primary klik_menu">Lihat</a>
		      </div>
		    </div>
	  	</div>
</div>
<div class="badan">
</div>
</div>
</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('.klik_menu').click(function(){
			var menu = $(this).attr('id');
			if(menu == "penyimpanan"){
				$('.badan').load('penyimpanan.php');						
			}else if(menu == "tps"){
				$('.badan').load('tps.php');						
			}else if(menu == "neraca"){
				$('.badan').load('neraca.php');						
			}
		});
 
 
		// halaman yang di load default pertama kali
		$('.badan').load('gedung_penyimpanan.php');						
 
	});
</script>
