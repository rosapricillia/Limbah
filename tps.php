<div class="card-body">
  <div class="table-responsive">
    <h5>TPS berapa yang ingin anda lihat ?</h5>
    <form action="" method="POST">
      <div class="col-sm-8">
    <div class="input-group">
        <label for="sel1">TPS : </label>
        <select name="nomor_tps">
          <option value="">-------Pilih-------</option>
        <?php
        include 'Koneksi.php';
          $sql="select * from tps";

          $hasil=mysqli_query($connect,$sql);
          $no=0;
          while ($data = mysqli_fetch_array($hasil)) {
          $no++;
         ?>
          <option value="<?php echo $data['id_tps'];?>"><?php echo $data['tps'];?></option>
        <?php 
        }
        ?>
      </select>
      <button type="submit">Lihat</button>
          <!-- <input type="button" value="Lihat" name="lihat" class="btncls"> -->
        </div>
      </div>
    </form>
  </div>
</div>
