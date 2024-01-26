<?php
include 'koneksi.php';
if(isset($_POST["data_id"])){
  $idData = $_POST["data_id"];
  $sql1 = "SELECT * FROM form_table inner join jenis_limbah on form_table.id=jenis_limbah.id inner join approval on approval.id_limbah=jenis_limbah.id_limbah where jenis_limbah.id_limbah = $idData";
  $query  = mysqli_query($connect, $sql1);
  $data= mysqli_fetch_array($query);
  $idForm = $data['id'];
?>
<form action="proses.php" method="POST" id="insert_edit">
  <div class="form-group row">
    <label for="seksi" class="col-sm-4 col-form-label">Seksi</label>
    <div class="col-sm-8">
      <input type="hidden" class="form-control" name="updatepenyimpanan" value="">
       <input type="hidden" class="form-control" name="penyimpananE"value="<?=$data['id_approval']?>">
       <input type="hidden" class="form-control" name="updateID"value="<?=$idForm?>">
       <input type="hidden" class="form-control" name="id_limbahU"value="<?=$idData?>">
      <select class="form-control" name="seksi">
        <option value="<?=$data['seksi']?>"><?=$data['seksi']?></option>
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
    <label for="nor" class="col-sm-4 col-form-label">Nomor Request</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="nor"value="<?=$data['nomor_request']?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="tglr" class="col-sm-4 col-form-label">Tanggal Request</label>
    <div class="col-sm-8">
      <input class="form-control datepicker" type="date" name="tglr" value="<?=$data['tanggal_request']?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="tglp" class="col-sm-4 col-form-label">Tanggal Pengiriman</label>
    <div class="col-sm-8">
      <input  class="form-control datepicker" type="date" name="tglp" value="<?=$data['tanggal_pengiriman']?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="nama_limbah" class="col-sm-4 col-form-label">Nama Limbah</label>
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
    <label for="jumlah_limbah" class="col-sm-4 col-form-label">Jumlah Limbah (Ton)</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="jumlah_limbah" value="<?=$data['jumlah_limbah']?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="sifat" class="col-sm-4 col-form-label">Sifat</label>
    <div class="col-sm-8">
      <select class="form-control" name="sifat">
       <option value="<?=$data['sifat']?>"><?=$data['sifat']?></option>
        <option value='Beracun'>Beracun</option>
        <option value='Tidak Beracun'>Tidak Beracun</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="bentuk" class="col-sm-4 col-form-label">Bentuk</label>
    <div class="col-sm-8">
      <select class="form-control" name="bentuk" >
        <option value="<?=$data['bentuk']?>"><?=$data['bentuk']?></option>
        <option value='Bongkahan'>Bongkahan</option>
        <option value='Curah'>Curah</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="kondisi" class="col-sm-4 col-form-label">Kondisi</label>
    <div class="col-sm-8">
      <select class="form-control" name="kondisi">
        <option value="<?=$data['kondisi']?>"><?=$data['kondisi']?></option>
        <option value='Terkemas'>Terkemas</option>
        <option value='Belum Terkemas'>Belum Terkemas</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="ket" class="col-sm-4 col-form-label">Keterangan</label>
    <div class="col-sm-8">
      <textarea type="textarea" class="form-control" name="ket"><?=$data['keterangan']?></textarea>
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
$(document).ready(function(){
// Begin Aksi Insert
 // $('#insert_form').on("submit", function(event){  
 //  event.preventDefault(); 
 //   $.ajax({  
 //    url:"proses.php",  
 //    method:"POST",  
 //    data:$('#insert_form').serialize(),  
 //    beforeSend:function(){  
 //     $('#insert').val("Inserting");  
 //    },  
 //    success:function(data){  
 //     $('#insert_form')[0].reset();  
 //     $('#binset').modal('hide');  
 //     $('#employee_table').html(data);  
 //    }  
 //   });  
 //  }  

  $('#insert').on('click', function(){
    $.ajax({  
      url:"proses.php",  
      method:"POST",  
      data:$('#insert_edit').serialize(),  
      beforeSend:function(){  
       $('#insert').val("Inserting");  
      },  
      success:function(data){  
        if(data){
        console.log($('#insert_edit').serialize())
       $('#insert_edit')[0].reset();  
       $('#editM').modal('hide');  
       $('#binsert').modal('show');  
       // $('#employee_table').html(data);  
        }
      }  
     }); 
  });
 });
</script>