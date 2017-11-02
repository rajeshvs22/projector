<?php
	include('db.php');	 
	// initilize all variable
	$params = $columns = $totalRecords = $data = array();

	$params = $_REQUEST;

	//define index of column
	$columns = array( 
		0 =>'_NAME',
		1 =>'_EMAIL', 
		2 => '_MOBILE',
		3 => '_ZIPCODE',
		4 => 'oauth_provider'
	);

	$where = $sqlTot = $sqlRec = "";

	// check search value exist
	if( !empty($params['search']['value']) ) {   
		$where .=" WHERE ";
		$where .=" ( _NAME LIKE '".$params['search']['value']."%' ";    
		$where .=" OR _EMAIL LIKE '".$params['search']['value']."%' ";

		$where .=" OR _MOBILE LIKE '".$params['search']['value']."%' )";
		//$where .=" OR oauth_provider LIKE '".$params['search']['value']."%' )";
	}

	// getting total number records without any search
	$sql = "SELECT * FROM users ";
	$sqlTot .= $sql;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && $where != '') {

		$sqlTot .= $where;
		$sqlRec .= $where;
	}


 	$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";

	$queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));


	$totalRecords = mysqli_num_rows($queryTot);

	$queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch employees data");

	//iterate on results row and create new index array of data
	while( $row = mysqli_fetch_array($queryRecords) ) { 
		//$data[] = $row;
		$data[] = array($row['_NAME'],$row['_EMAIL'],$row['_MOBILE'],$row['_ZIPCODE'],$row['oauth_provider']);
	}	

	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $data,   // total data array
			"nivas" => 'yess'
			);

	echo json_encode($json_data);  // send data as json format
?>
	