<?php
// input
include 'koneksi.php';
if(isset($_POST['submit'])){
  $seksi = $_POST['seksi'];   
  $nomor_request = $_POST['nor'];
  $tanggal_request = $_POST['tglr'];
  $tanggal_pengiriman = $_POST['tglp'];
  $keterangan = $_POST['ket'];
  $nama_limbah   =$_POST['nama_limbah'];
  $jumlah_limbah   = $_POST['jumlah_limbah'];
  $sifat     =$_POST['sifat'];
  $bentuk     =$_POST['bentuk'];
  $kondisi     =$_POST['kondisi'];

  $total = count($nama_limbah);

  $query = mysqli_query($connect,"INSERT INTO form_table VALUES ('','$seksi', '$nomor_request', '$tanggal_request', '$tanggal_pengiriman', '$keterangan')");

  if($query){
      $query1 = mysqli_query($connect, "SELECT id FROM form_table order by id desc");
      while ($d = mysqli_fetch_array($query1)){
          $idB = $d['id'];
          break;
      }
      for($i=0; $i<$total; $i++){
          $input = mysqli_query($connect, "INSERT INTO jenis_limbah VALUES('',$idB,'$nama_limbah[$i]', $jumlah_limbah[$i], '$sifat[$i]', '$bentuk[$i]', '$kondisi[$i]', 'waiting')");
      }

      
      echo '<script type="text/javascript">
          document.location= "approval.php";
      </script>';
  }else{
      
      echo '<script type="text/javascript">
          document.location= "form.php";
      </script>';
  }
}

// edit

if(isset($_POST['updatedata'])){
    $sql = "UPDATE form_table SET seksi='{$_POST['seksi']}', nomor_request='{$_POST['nor']}', tanggal_request='{$_POST['tglr']}', tanggal_pengiriman='{$_POST['tglp']}', keterangan='{$_POST['ket']}' WHERE id ='{$_POST['updateID']}'";
    $query = mysqli_query($connect, $sql);
    $sql = "UPDATE jenis_limbah SET nama_limbah='{$_POST['nama_limbah']}', jumlah_limbah='{$_POST['jumlah_limbah']}', sifat='{$_POST['sifat']}', bentuk='{$_POST['bentuk']}', kondisi='{$_POST['kondisi']}' WHERE id_limbah ='{$_POST['id_limbahU']}'";
    $query= mysqli_query($connect, $sql);
    if($query){
      echo "Data berhasil diubah";
      header('Location: approval.php');
    } else{
      echo "Data gagal diubah: ". mysqli_error();
    }
}

// reject

if(isset($_POST['reject'])){
  $keterangan_reject = $_POST['ketreject'];  
  $idL = $_POST['id_limbahU'];
  $simpan = mysqli_query($connect, "INSERT INTO reject VAlUES ('NULL','$idL', '$keterangan_reject')");
  $updatereject = mysqli_query($connect, "update jenis_limbah set status = 'reject' where id_limbah = '$idL'");
 if ($updatereject){
?>
    <script type="text/javascript">
        document.location= "daftar_reject.php";
    </script>
  <?php
  }
    else{

  echo '<script type="text/javascript">
      document.location= "approval.php";
  </script>';
}
}

// approval
if (isset($_POST['verifikasi'])) {
  $idU = $_POST['appid'];
  $ara = mysqli_query($connect, "INSERT INTO approval VAlUES ('NULL','$idU')");
  $updateapproval = mysqli_query($connect, "update jenis_limbah set status = 'approval' where id_limbah = '$idU'");
  if ($updateapproval){
  
    echo '<script type="text/javascript">
          document.location= "daftar_approval.php";
      </script>';
    
    }
      else{

    echo '<script type="text/javascript">
        document.location= "approval.php";
    </script>';
  }
  }
// editpenyimpanan

  if(isset($_POST['updatepenyimpanan'])){
    $sql = "UPDATE form_table SET seksi='{$_POST['seksi']}', nomor_request='{$_POST['nor']}', tanggal_request='{$_POST['tglr']}', tanggal_pengiriman='{$_POST['tglp']}', keterangan='{$_POST['ket']}' WHERE id ='{$_POST['updateID']}'";
    $query = mysqli_query($connect, $sql);
    // $data_1 = mysqli_fetch_assoc($query);
    $sql = "UPDATE jenis_limbah SET nama_limbah='{$_POST['nama_limbah']}', jumlah_limbah='{$_POST['jumlah_limbah']}', sifat='{$_POST['sifat']}', bentuk='{$_POST['bentuk']}', kondisi='{$_POST['kondisi']}' WHERE id_limbah ='{$_POST['id_limbahU']}'";
    $query= mysqli_query($connect, $sql);
    if ($query !== false){
      echo true;
    }else{
      echo 'false';
    }
  }

// insertpenyimpanan
if(isset($_POST['inserttps'])){
$idA = $_POST['penyimpananE'];
$tps = $_POST['tps'];
$tanggal_masuk = $_POST['tglM'];   
// $id_approval = mysqli_real_escape_string($connect, $_POST["id_approval"]);
// $tps = mysqli_real_escape_string($connect, $_POST["tps"]);
$butar = mysqli_query($connect,"INSERT INTO penyimpanan_tps VALUES('', '$idA', '$tps', '$tanggal_masuk')");
// $updateinsert = mysqli_query($connect, "update approval set status = 'approval' where id_approval = '$idA'");
if ($butar){
    echo '<script type="text/javascript">
          document.location= "tps.php";
      </script>';
    
    }
      else{

    echo '<script type="text/javascript">
        document.location= "penyimpanan.php";
    </script>';
  }
}

// rejectpenyimpanan

if(isset($_POST['rejectP'])){

  $ket_rejectp = $_POST['ket_rejectp'];
  $idR = $_POST['rejecttp']; 
  $parulian = mysqli_query($connect, "INSERT INTO reject_penyimpanan VALUES (NULL, '$idR', '$ket_rejectp')");


  // mysqli_query($connect, "insert into reject_penyimpanan set
  //   ket_rejectp = '$_POST[ket_rejectp]',
  //   id_approval = '$_POST[id_approval]'") or die(mysqli_error($connect));
  // $ket_rejectp = $_POST["ket_rejectp"];  
  // $idp = $_POST["rejecttp"];
  // $simpan = mysqli_query($connect, "INSERT INTO reject_penyimpanan set '$idp', '$ket_rejectp'");
  // $updatereject = mysqli_query($connect, "update approval set status = 'reject' where id_approval = '$idp'");
  // $sql = mysqli_query($connect, "SELECT *  FROM reject WHERE status = '1' ORDER BY id_rejectp DESC ");

}


// insertneraca
if(isset($_POST['btnneraca'])){
  $sumber_limbah = $_POST['sumber'];
  $tanggal_keluar = $_POST['tglk'];
  $jumlah_keluar = $_POST['jmlkeluar'];
  $tujuan = $_POST['tujuan'];
  $bukti_nomor = $_POST['bukti'];
  $par = mysqli_query($connect, "INSERT into neraca VAlUES ('$sumber_limbah', '$tanggal_keluar', '$jumlah_keluar', '$tujuan', '$bukti_nomor', '')");
}

?>  