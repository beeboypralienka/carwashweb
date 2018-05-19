<?php
	class User{
		private $con;

		function __construct(){
			require_once dirname(__FILE__).'/DbConnect.php';
			$db = new DbConnect();
			$this->con = $db->connect();
		}
		
		public function registrasiUser($username, $password, $email){
			if ($this->isUserExist($username,$email)) {
				return 0;
			} else {
				$statement = $this->con->prepare("INSERT INTO user(username, password, email) VALUES (?,?,?)");
				$statement->bind_param("upe", $username, $password, $email);
				if ($statement->execute()) {
					return 1;
				} else {
					return 2;
				}				
			}
		}

		public function loginUser($username, $password){
			$statement = $this->con->prepare("SELECT username FROM user WHERE username = ? AND password = ?");
			$statement->bind_param("up", $username, $password);
			$statement->execute();
			$statement->store_result();
			return $statement->num_rows > 0;
		}

		public function getUserByUsername($username){
			$statement = $this->con->prepare("SELECT * FROM user WHERE username = ?");
			$statement->bind_param("u",$username);
			$statement->execute();
			return $statement->get_result()->fetch_assoc();
		}

		public function isUserExist($username, $email){
			$statement = $this->con->prepare("SELECT username FROM user WHERE username = ? OR email = ?");
			$statement->bind_param("ue",$username,$email);
			$statement->execute();
			$statement->store_result();
			return $statement->num_rows > 0;
		}
	}
?>