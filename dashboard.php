<?php

//dashboard.php

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
	            <div class="row">
	            </div>
	        </div>
	    </div>
	</div>

</body>
</html>