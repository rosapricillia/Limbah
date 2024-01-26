<?php

//seksi_action.php

include('vms.php');

$visitor = new vms();

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'fetch')
	{
		$order_column = array('seksi_name', 'seksi_contact_person');

		$output = array();

		$main_query = "
		SELECT * FROM seksi_table ";

		$search_query = '';

		if(isset($_POST["search"]["value"]))
		{
			$search_query .= 'WHERE seksi_name LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR seksi_contact_person LIKE "%'.$_POST["search"]["value"].'%" ';
		}

		if(isset($_POST["order"]))
		{
			$order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$order_query = 'ORDER BY seksi_id DESC ';
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
			$sub_array[] = html_entity_decode($row["seksi_name"]);
			$sub_array[] = html_entity_decode($row["seksi_contact_person"]);
			$sub_array[] = '
			<div align="center">
			<button type="button" name="edit_button" class="btn btn-warning btn-sm edit_button" data-id="'.$row["seksi_id"].'"><i class="fas fa-edit"></i></button>
			&nbsp;
			<button type="button" name="delete_button" class="btn btn-danger btn-sm delete_button" data-id="'.$row["seksi_id"].'"><i class="fas fa-times"></i></button>
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
		$error = '';

		$success = '';

		$data = array(
			':seksi_name'	=>	$_POST["seksi_name"]
		);

		$visitor->query = "
		SELECT * FROM seksi_table 
		WHERE seksi_name = :seksi_name
		";

		$visitor->execute($data);

		if($visitor->row_count() > 0)
		{
			$error = '<div class="alert alert-danger">seksi Already Exists</div>';
		}
		else
		{
			$seksi_contact_person = implode(", ", $_POST["seksi_contact_person"]);

			$data = array(
				':seksi_name'		=>	$visitor->clean_input($_POST["seksi_name"]),
				':seksi_contact_person'	=>	$visitor->clean_input($seksi_contact_person),
				':seksi_created_on'	=>	$visitor->get_datetime()
			);

			$visitor->query = "
			INSERT INTO seksi_table 
			(seksi_name, seksi_contact_person, seksi_created_on) 
			VALUES (:seksi_name, :seksi_contact_person, :seksi_created_on)
			";

			$visitor->execute($data);

			$success = '<div class="alert alert-success">Seksi Added</div>';
		}

		$output = array(
			'error'		=>	$error,
			'success'	=>	$success
		);

		echo json_encode($output);

	}

	if($_POST["action"] == 'fetch_single')
	{
		$visitor->query = "
		SELECT * FROM seksi_table 
		WHERE seksi_id = '".$_POST["seksi_id"]."'
		";

		$result = $visitor->get_result();

		$data = array();

		foreach($result as $row)
		{
			$data['seksi_name'] = $row['seksi_name'];
			$data['seksi_contact_person'] = $row['seksi_contact_person'];
		}

		echo json_encode($data);
	}

	if($_POST["action"] == 'Edit')
	{
		$error = '';

		$success = '';

		$data = array(
			':seksi_name'	=>	$_POST["seksi_name"],
			':seksi_id'	=>	$_POST['hidden_id']
		);

		$visitor->query = "
		SELECT * FROM seksi_table 
		WHERE seksi_name = :seksi_name 
		AND seksi_id != :seksi_id
		";

		$visitor->execute($data);

		if($visitor->row_count() > 0)
		{
			$error = '<div class="alert alert-danger">Seksi Already Exists</div>';
		}
		else
		{
			$seksi_contact_person = implode(", ", $_POST["seksi_contact_person"]);

			$data = array(
				':seksi_name'		=>	$visitor->clean_input($_POST["seksi_name"]),
				':seksi_contact_person'	=>	$visitor->clean_input($seksi_contact_person)
			);

			$visitor->query = "
			UPDATE seksi_table 
			SET seksi_name = :seksi_name, 
			seksi_contact_person = :seksi_contact_person  
			WHERE seksi_id = '".$_POST['hidden_id']."'
			";

			$visitor->execute($data);

			$success = '<div class="alert alert-success">seksi Updated</div>';
		}

		$output = array(
			'error'		=>	$error,
			'success'	=>	$success
		);

		echo json_encode($output);

	}

	if($_POST["action"] == 'delete')
	{
		$visitor->query ="DELETE FROM seksi_table WHERE seksi_id = '".$_POST["id"]."'";

		$visitor->execute();

		echo '<div class="alert alert-success">Seksi Deleted</div>';
	}
}

?>