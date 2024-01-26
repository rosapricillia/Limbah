<?php

//visitor_action.php

include('vms.php');

$visitor = new vms();

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'fetch')
	{
		$order_column = array('form_table.seksi', 'form_table.nomor_request', 'form_table.tanggal_request', 'form_table.tanggal_pengiriman', 'form_table.keterangan', 'jenis_limbah.nama_limbah', 'jenis_limbah.jumlah_limbah', 'jenis_limbah.sifat', 'jenis_limbah.bentuk', 'jenis_limbah.kondisi');

		$output = array();

		$main_query = "
		SELECT * FROM form_table
		INNER JOIN jenis_limbah 
		ON jenis_limbah.id_limbah = form_table.id 
		";

		if(!$visitor->is_master_user())
		{
			$main_query .= "
			WHERE form_table.id = '".$_SESSION["id_limbah"]."' 
			";

			if($_POST["from_date"] != '')
			{
				$search_query = "
				AND DATE(form_table, y).id) BETWEEN '".$_POST["from_date"]."' AND  '".$_POST["to_date"]."' AND ( 
				";
			}
			else
			{
				$search_query = " AND ( ";	
			}
			
		}
		else
		{
			if($_POST["from_date"] != '')
			{
				$search_query = "WHERE DATE(form_table.id) BETWEEN '".$_POST["from_date"]."' AND  '".$_POST["to_date"]."' AND ( ";
			}
			else
			{
				$search_query = "WHERE ";	
			}
		}
		

		if(isset($_POST["search"]["value"]))
		{
			$search_query .= 'form_table.  LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR visitor_table.visitor_meet_person_name LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR visitor_table.visitor_department LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR visitor_table.visitor_enter_time LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR visitor_table.visitor_out_time LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR visitor_table.visitor_status LIKE "%'.$_POST["search"]["value"].'%" ';
			
			if($visitor->is_master_user())
			{
				$search_query .= 'OR admin_table.admin_name LIKE "%'.$_POST["search"]["value"].'%" ';
				if($_POST["from_date"] != '')
				{
					$search_query .= ') ';
				}
			}
			else
			{
				$search_query .= ') ';
			}
		}

		if(isset($_POST["order"]))
		{
			$order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$order_query = 'ORDER BY visitor_table.visitor_id DESC ';
		}

		$limit_query = '';

		if($_POST["length"] != -1)
		{
			$limit_query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$visitor->query = $main_query . $search_query . $order_query;

		$visitor->execute();

		$filtered_rows = $visitor->row_count();

		$visitor->query .= $limit_query;

		$result = $visitor->get_result();

		$visitor->query = $main_query;

		$visitor->execute();

		$total_rows = $visitor->row_count();

		$data = array();

		foreach($result as $row)
		{
			$sub_array = array();
			$sub_array[] = html_entity_decode($row["visitor_name"]);
			$sub_array[] = html_entity_decode($row["visitor_meet_person_name"]);
			$sub_array[] = $row["visitor_department"];
			$sub_array[] = $row["visitor_enter_time"];
			$sub_array[] = $row["visitor_out_time"];
			$status = '';
			if($row["visitor_status"] == 'In')
			{
				$status = '<span class="badge badge-success">In Premises</span>';
			}
			else
			{
				$status = '<span class="badge badge-danger">Leave</span>';
			}
			$sub_array[] = $status;
			if($visitor->is_master_user())
			{
				$sub_array[] = $row["admin_name"];
			}
			$sub_array[] = '
			<div align="center">
			<button type="button" name="view_button" class="btn btn-primary btn-sm view_button" data-id="'.$row["visitor_id"].'"><i class="fas fa-eye"></i></button>
			&nbsp;
			<button type="button" name="edit_button" class="btn btn-warning btn-sm edit_button" data-id="'.$row["visitor_id"].'"><i class="fas fa-edit"></i></button>
			&nbsp;
			<button type="button" name="delete_button" class="btn btn-danger btn-sm delete_button" data-id="'.$row["visitor_id"].'"><i class="fas fa-times"></i></button>
			</div>
			';
			$data[] = $sub_array;
		}

		$output = array(
			"draw"    			=> 	intval($_POST["draw"]),
			"recordsTotal"  	=>  $total_rows,
			"recordsFiltered" 	=> 	$filtered_rows,
			"data"    			=> 	$data
		);
			
		echo json_encode($output);

	}

	if($_POST["action"] == 'Add')
	{
		$data = array(
			':visitor_name'			=>	$visitor->clean_input($_POST["visitor_name"]),
			':visitor_email'		=>	$_POST["visitor_email"],
			':visitor_mobile_no'	=>	$_POST["visitor_mobile_no"],
			':visitor_address'		=>	$visitor->clean_input($_POST["visitor_address"]),
			':visitor_meet_person_name' =>	$_POST["visitor_meet_person_name"],
			':visitor_department'	=>	$_POST["visitor_department"],
			':visitor_reason_to_meet' =>	$visitor->clean_input($_POST["visitor_reason_to_meet"]),
			':visitor_enter_time'	=>	$visitor->get_datetime(),
			':visitor_outing_remark'=>	'',
			':visitor_out_time'		=>	'',
			':visitor_status'		=>	'In',
			':visitor_enter_by'		=>	$_SESSION["admin_id"]
		);

		$visitor->query = "
		INSERT INTO visitor_table 
		(visitor_name, visitor_email, visitor_mobile_no, visitor_address, visitor_meet_person_name, visitor_department, visitor_reason_to_meet, visitor_enter_time, visitor_outing_remark, visitor_out_time, visitor_status, visitor_enter_by) 
		VALUES (:visitor_name, :visitor_email, :visitor_mobile_no, :visitor_address, :visitor_meet_person_name, :visitor_department, :visitor_reason_to_meet, :visitor_enter_time, :visitor_outing_remark, :visitor_out_time, :visitor_status, :visitor_enter_by)
			";

		$visitor->execute($data);

		echo '<div class="alert alert-success">Department Added</div>';
	}

	if($_POST["action"] == 'fetch_single')
	{
		$visitor->query = "
		SELECT * FROM visitor_table 
		WHERE visitor_id = '".$_POST["visitor_id"]."'
		";

		$result = $visitor->get_result();

		$data = array();

		foreach($result as $row)
		{
			$data['visitor_name'] = $row['visitor_name'];
			$data['visitor_email'] = $row['visitor_email'];
			$data['visitor_mobile_no'] = $row['visitor_mobile_no'];
			$data['visitor_address'] = $row['visitor_address'];
			$data['visitor_meet_person_name'] = $row['visitor_meet_person_name'];
			$data['visitor_department'] = $row['visitor_department'];
			$data['visitor_reason_to_meet'] = $row['visitor_reason_to_meet'];
			$data['visitor_outing_remark'] = $row['visitor_outing_remark'];
		}

		echo json_encode($data);
	}
}

?>