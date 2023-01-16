<?php

include 'db.php';

// CHECK IF USER EXISTS IN DATABASE
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['email']) && !isset($_GET['password'])) {
	// ligaçã base de dados
	$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
	if($db) {


			// criar query numa string (avoid SQL injection)
			$query  = "SELECT id,name,email FROM customers where email='" . mysqli_real_escape_string($db, trim($_GET['email'])) . "'";
			// executar a query
			if(!($result = @ mysqli_query($db, $query)))
					showerror($db);
			// vai buscar o resultado da query
			$user = mysqli_fetch_assoc($result);
		
			// allow cross-origin requests (CORS)
			header('Access-Control-Allow-Origin: *');
			header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
			header("Access-Control-Allow-Headers: Authorization, Origin, User-Token, X-Requested-With, Content-Type");
			// convert to JSON
			$json = json_encode($user);
			echo $json; 
		

		// fechar a ligaçãbase de dados
		mysqli_close($db);

	} // end if db

}

// LOGIN USER (POPULATE SESSION)
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['email']) && isset($_GET['password'])) {

	// ligacao base de dados
	$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);

	$email = mysqli_real_escape_string($db, trim($_GET['email']));
	$password = substr(md5($_GET['password']),0,32);


	if($db) {
		// criar query numa string
		$query  = "SELECT id, name, email FROM customers WHERE email='$email' AND password_digest='$password'";

		// executar a query
		if(!($result = @ mysqli_query($db, $query)))
				showerror($db);

		$user = mysqli_fetch_assoc($result);

		// fechar a ligaço base de dados
		mysqli_close($db);
		
		$json=json_encode($user);

		// allow cross-origin requests (CORS)
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Authorization, Origin, User-Token, X-Requested-With, Content-Type");
		
		echo $json;	
	
	} // end if

}




// REGISTER NEW USER
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $json=file_get_contents('php://input');

    $data = json_decode($json, true);    

	// ligacao base de dados
	$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);

	$name = mysqli_real_escape_string($db, trim($data['name']));
	$email = mysqli_real_escape_string($db, trim($data['email']));
	$password = substr(md5($data['password']),0,32);


	if($db) {
		// criar query numa string
		$query  = "INSERT INTO customers SET name='$name',email='$email',password_digest='$password',created_at=NOW(),updated_at=NOW()";
	
		// executar a query
		if(!($result = @ mysqli_query($db, $query)))
			showerror($db);

		// criar query numa string
		$query  = "SELECT id, name, email FROM customers order by id desc limit 1";

		// executar a query
		if(!($result = @ mysqli_query($db, $query)))
				showerror($db);

		$user = mysqli_fetch_assoc($result);

		// fechar a ligaço base de dados
		mysqli_close($db);
		
		$json=json_encode($user);

		// allow cross-origin requests (CORS)
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Authorization, Origin, User-Token, X-Requested-With, Content-Type");
		echo $json;	
	
	} // end if

}



// allow cross-origin requests (CORS)
if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Access-Control-Allow-Headers: Authorization, Origin, User-Token, X-Requested-With, Content-Type");	
}

?>

