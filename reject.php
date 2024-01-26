<?php
include 'koneksi.php';
if(isset($_POST["data_id"])){
  $idData = $_POST["data_id"];
  $sql1 = "SELECT * FROM form_table INNER JOIN jenis_limbah ON form_table.id=jenis_limbah.id INNER JOIN reject ON jenis_limbah.id_limbah=reject.id_limbah = $idreject";
  $query  = mysqli_query($connect, $sql1);
  $data= mysqli_fetch_array($query);
?>
<form action="proses.php" method="POST">
  <div class="form-group row">
       <input type="text" class="form-control" name="id_limbahU"value="<?=$idData?>">
    <label for="ketreject" class="col-sm-4 col-form-label">Keterangan</label>
    <div class="col-sm-8">
      <textarea type="textarea" class="form-control" id="ketreject" name="ketreject"></textarea>
    </div>
  </div>
  <button type="submit" name="reject" class="btn btn-primary"> Reject </button>
</form>

<?php
}
?>