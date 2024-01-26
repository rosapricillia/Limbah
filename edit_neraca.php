<?php
include 'koneksi.php';
if(isset($_POST["data_id"])){
  $idData = $_POST["data_id"];
  $sql1 = "SELECT * FROM jenis_limbah inner join approval on jenis_limbah.id_limbah=approval.id_limbah inner join penyimpanan_tps on penyimpanan_tps.id_approval=approval.id_approval inner join neraca on neraca.id_penyimpanan=penyimpanan_tps.id_penyimpanan where jenis_limbah.id_limbah = $idData";
  $query  = mysqli_query($connect, $sql1);
  $data= mysqli_fetch_array($query);
  $idForm = $data['id_neraca'];
?>
<form action="proses.php" method="POST" id="insert_edit">
  <div class="form-group row">
    <label for="nama_limbah" class="col-sm-4 col-form-label">Jenis Limbah B3 Masuk</label>
    <div class="col-sm-8">
      <select class="form-control" name="nama_limbah">
        <option value="<?=$data['nama_limbah']?>"><?=$data['nama_limbah']?></option>
        <option value="Katoda (spent pot lining)">Katoda (spent pot lining)</option>
        <option value="Refraktory">Refraktory</option>
        <option value="Anode scraps">Anode scraps</option>
        <option value="Carbon Mix">Carbon Mix</option>
        <option value="Butt Dust">Butt Dust</option>
        <option value="Baking Filter Dust">Baking Filter Dust</option>
        <option value="Sludge dari IPAL">Sludge dari IPAL</option>
        <option value="Dross Hitam">Dross Hitam</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="tglp" class="col-sm-4 col-form-label">Tanggal Limbah B3 Masuk</label>
    <div class="col-sm-8">
      <input  class="form-control datepicker" type="date" name="tglM" value="<?=$data['tanggal_masuk']?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="jumlah_limbah" class="col-sm-4 col-form-label">Jumlah Limbah B3 Masuk (Ton)</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="jumlah_limbah" value="<?=$data['jumlah_limbah']?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="jumlah_limbah" class="col-sm-4 col-form-label">Sumber Limbah B3 Masuk</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="sumber" value="<?=$data['sumber_limbah']?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="jumlah_limbah" class="col-sm-4 col-form-label">Tanggal Limbah B3 Keluar</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="tglk" value="<?=$data['tanggal_keluar']?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="jumlah_limbah" class="col-sm-4 col-form-label">Jumlah Limbah B3 Keluar (Ton)</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="jlmkeluar" value="<?=$data['jumlah_keluar']?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="jumlah_limbah" class="col-sm-4 col-form-label">Tujuan Penyerahan</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="tujuan" value="<?=$data['tujuan']?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="jumlah_limbah" class="col-sm-4 col-form-label">Bukti Nomor Dokumen</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="bukti" value="<?=$data['bukti_nomor']?>" required>
    </div>
  </div>
  <button type="button" name="updatepenyimpanan" class="btn btn-primary button_insert" id="insert"><i class="fa fa-arrow-right"></i></button>
</form>

<?php
}
?>

<script type="text/javascript">
$(function(){
    $(".datepicker").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });
});