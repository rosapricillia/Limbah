<?php  
 include'koneksi.php';
 $output = '';  
 $sql = "SELECT * FROM form_table INNER JOIN jenis_limbah ON form_table.id=jenis_limbah.id INNER JOIN approval ON jenis_limbah.id_limbah=approval.id_limbah";  
 $result = mysqli_query($connect, $sql);  
 $output .= '  
      <div class="table-responsive" id="live_data">  
           <table class="table table-bordered">  
                <tr>  
                    <th><p>Seksi</p></th>
					<th><p>Nomor Request</p></th>
					<th><p>Tanggal Request</p> </th>
					<th><p>Tanggal Pengiriman</p></th>
					<th><p>Tanggal Masuk Limbah B3</p></th>
					<th> <p>Nama Limbah</p></th>
					<th>Jumlah Limbah (Ton)</th>
					<th><p>Sifat</p></th>
					<th><p>Bentuk</p></th>
					<th><p>Kondisi</p></th>
					<th><p>Keterangan</p></th>
					<th><p> Gudang TPS</p></th>
					<th><p>Action</p></th>  
                </tr>';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr> 
                	<td class="seksi" data-id2="'.$row["id_limbah"].'" contenteditable>'.$row["seksi"].'</td>  
                	<td class="nomor_request" data-id2="'.$row["id_limbah"].'" contenteditable>'.$row["nomor_request"].'</td>  
                	<td class="tanggal_request" data-id2="'.$row["id_limbah"].'" contenteditable>'.$row["tanggal_request"].'</td>  
                	<td class="tanggal_pengiriman" data-id2="'.$row["id_limbah"].'" contenteditable>'.$row["tanggal_pengiriman"].'</td>  
                 	<td class="nama_limbah" data-id1="'.$row["id_limbah"].'" contenteditable>'.$row["nama_limbah"].'</td>  
	                 <td class="jumlah_limbah" data-id2="'.$row["id_limbah"].'" contenteditable>'.$row["jumlah_limbah"].'</td>
	                 <td class="sifat" data-id2="'.$row["id_limbah"].'" contenteditable>'.$row["sifat"].'</td>  
	                 <td class="bentuk" data-id2="'.$row["id_limbah"].'" contenteditable>'.$row["bentuk"].'</td>    
	                 <td class="kondisi" data-id2="'.$row["id_limbah"].'" contenteditable>'.$row["kondisi"].'</td>  
	                 <td class="keterangan" data-id2="'.$row["id_limbah"].'" contenteditable>'.$row["keterangan"].'</td> 
                </tr>  
           ';  
      }  
      $output .= '  
           <tr>  
                <td></td>  
                <td id="nama_limbah" contenteditable></td>  
                <td id="jenis_limbah" contenteditable></td>
                <td id="sifat" contenteditable></td>
                <td id="bentuk" contenteditable></td>
                <td id="kondisi" contenteditable></td>   
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '<tr>  
                          <td colspan="4">Data not Found</td>  
                     </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>