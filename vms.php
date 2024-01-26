<?php

//vms.php

class vms
{
	public $base_url = 'http://localhost/limbah/';
	public $connect;
	public $query;
	public $statement;

	function vms()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=visitor_managment_system", "root", "");
		session_start();
	}

	function execute($data = null)
	{
		$this->statement = $this->connect->prepare($this->query);
		if($data)
		{
			$this->statement->execute($data);
		}
		else
		{
			$this->statement->execute();
		}		
	}

	function row_count()
	{
		return $this->statement->rowCount();
	}

	function statement_result()
	{
		return $this->statement->fetchAll();
	}

	function get_result()
	{
		return $this->connect->query($this->query, PDO::FETCH_ASSOC);
	}

	function is_login()
	{
		if(isset($_SESSION['admin_id']))
		{
			return true;
		}
		return false;
	}

	function is_master_user()
	{
		if(isset($_SESSION['admin_type']))
		{
			if($_SESSION["admin_type"] == 'Master')
			{
				return true;
			}
			return false;
		}
		return false;
	}

	function is_sep_user()
	{
		if(isset($_SESSION['admin_type']))
		{
			if($_SESSION["admin_type"] == 'Sep')
			{
				return true;
			}
			return false;
		}
		return false;
	}

	function is_petugas_user()
	{
		if(isset($_SESSION['admin_type']))
		{
			if($_SESSION["admin_type"] == 'Petugas')
			{
				return true;
			}
			return false;
		}
		return false;
	}

	function clean_input($string)
	{
	  	$string = trim($string);
	  	$string = stripslashes($string);
	  	$string = htmlspecialchars($string);
	  	return $string;
	}

	function get_datetime()
	{
		return date("Y-m-d H:i:s",  STRTOTIME(date('h:i:sa')));
	}

	function load_seksi()
	{
		$this->query = "
		SELECT * FROM seksi_table 
		ORDER BY seksi_name ASC
		";
		$result = $this->get_result();
		$output = '';
		foreach($result as $row)
		{
			$output .= '<option value="'.$row["seksi_name"].'" data-person="'.$row["seksi_contact_person"].'">'.$row["seksi_name"].'</option>';
		}
		return $output;
	}

	function Get_profile_image()
	{
		$this->query = "
		SELECT admin_profile FROM admin_table 
		WHERE admin_id = '".$_SESSION["admin_id"]."'
		";

		$result = $this->get_result();

		foreach($result as $row)
		{
			return $row['admin_profile'];
		}
	}

	function Get_total_today_visitor()
	{
		$this->query = "
		SELECT * FROM visitor_table 
		WHERE DATE(visitor_enter_time) = DATE(NOW())
		";

		if(!$this->is_master_user())
		{
			$this->query .= " AND visitor_enter_by ='".$_SESSION["admin_id"]."'";
		}

		$this->execute();
		return $this->row_count();
	}

	function Get_total_yesterday_visitor()
	{
		$this->query = "
		SELECT * FROM visitor_table 
		WHERE DATE(visitor_enter_time) = DATE(NOW()) - INTERVAL 1 DAY
		";
		if(!$this->is_master_user())
		{
			$this->query .= " AND visitor_enter_by ='".$_SESSION["admin_id"]."'";
		}
		$this->execute();
		return $this->row_count();
	}

	function Get_last_seven_day_total_visitor()
	{
		$this->query = "
		SELECT * FROM visitor_table 
		WHERE DATE(visitor_enter_time) >= DATE(NOW()) - INTERVAL 7 DAY
		";
		if(!$this->is_master_user())
		{
			$this->query .= " AND visitor_enter_by ='".$_SESSION["admin_id"]."'";
		}
		$this->execute();
		return $this->row_count();
	}

	function Get_total_visitor()
	{
		$this->query = "
		SELECT * FROM visitor_table 
		";
		if(!$this->is_master_user())
		{
			$this->query .= " WHERE visitor_enter_by ='".$_SESSION["admin_id"]."'";
		}
		$this->execute();
		return $this->row_count();
	}

}


?>