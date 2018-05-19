<?php
	require_once '../crud/User.php';
	$response = array();

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (isset($username) and isset($password)) {

			$user = new User();			

			if ($user->loginUser($username, $password)) {

				$result = $user->getUserByUsername($username);

				$respone['error'] = false;
				$respone['username'] = $result['username'];
				$respone['password'] = $result['password'];
				$respone['email'] = $result['email'];

			} else {

				$response['error'] = true;
				$response['pesan'] = "Username atau password tidak cocok!";
			} 		
		} else {
			$response['error'] = true;
			$response['pesan'] = "Field harus diisi!";
		}
		
	} else {
		$response['error'] = true;
		$response['pesan'] = "Request login tidak valid!";
	}
	

	echo json_encode($response);
?>