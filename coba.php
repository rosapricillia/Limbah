<?php
include('vms.php');

$visitor = new vms();

if(!$visitor->is_login())
{
	header("location:".$visitor->base_url."");
}

include('header.php');


echo "
<div class = 'row'>
<div class = 'col-4'>

<?php include('sidebar.php'); ?>
";


echo "</div>";

?>

<div class="col-8">
	
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
</div>

</div>