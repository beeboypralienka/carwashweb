<?php
	require_once '../crud/User.php';
	$response = array();

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['email'])) {
			
			$user = new User();
			$result = $user->registrasiUser($_POST['username'], $_POST['password'], $_POST['email']);
			if ($result == 1) {
				$respone['error'] = false;
				$respone['pesan'] = "User berhasil registrasi";
			} elseif($result == 2) {
				$response['error'] = true;
				$response['pesan'] = "Terjadi kesalahan, silakan coba lagi";
			} elseif(result == 3){
				$response['error'] = true;
				$response['pesan'] = "Username atau email sudah digunakan";
			}			
		} else {
			$response['error'] = true;
			$response['pesan'] = "Field harus diisi!";
		}
		
	} else {
		$response['error'] = true;
		$response['pesan'] = "Request registrasi tidak valid!";
	}
	
	echo jason_encode($response);
?>