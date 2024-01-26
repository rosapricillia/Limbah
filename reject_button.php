<?php
include 'koneksi.php';
if(isset($_POST["data_id"])){
  $idData = $_POST["data_id"];
  $sql1 = "SELECT * FROM form_table inner join jenis_limbah on form_table.id=jenis_limbah.id where jenis_limbah.id_limbah = $idData";
  $query  = mysqli_query($connect, $sql1);
  $data= mysqli_fetch_array($query);
?>
<form action="proses.php" method="POST" id="form-user">
        <input type="hidden" class="form-control" name="id_limbahU"value="<?=$idData?>">
        <div class="form-group row">
    <label for="ketreject" class="col-sm-4 col-form-label">
      Keterangan
    </label>
    <div class="col-sm-8">
      <textarea type="textarea" class="form-control" id="ketreject" name="ketreject" required></textarea>
    </div>
  </div>
        <button type="submit" name="reject" class="btn btn-primary"> Reject </button>
</form>

<div class="tampildata"></div>
</div>
<?php
}
?>