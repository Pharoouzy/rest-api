<?php 
	
	// this header allows connections from different origin
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT");
	header("Content-Type: application/json");

	// checking for method
	$method = $_SERVER['REQUEST_METHOD'];

	// echo $method;

	// grab the url and get the type of url we're dealing with
	$request_uri = $_SERVER['REQUEST_URI'];
	// echo $request_uri;

	// list of tables in the database
	$tables = ['posts'];

	// sanitizing the url.
	$url = rtrim($request_uri, '/');
	$url = filter_var($request_uri, FILTER_SANITIZE_URL);
	// getting parameters from url
	$url = explode('/', $url);
	// print_r($url);

	// referencing the url parameters to database
	$table_name = (string) $url[3];
	// print_r($table_name);
	// getting post id from url
	if (isset($url[4]) && $url[4] !== null) {
		$id = (int) $url[4];
	}
	else{
		$id = null;
	}

	// checking to see if the url consist a valid table name
	if (in_array($table_name, $tables)) {
		// include Database class
		include_once './classes/Database.php';
		// include that api route
		include_once './api/posts.php';
	}
	else {
		http_response_code(404);
		echo "Table does not exists!";
	}
?>