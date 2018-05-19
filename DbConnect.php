<?php
	class DbConnect{
		private $con;	

		function __construct(){

		}

		function connect(){			
			include_once dirname(__FILE__).'/DbSettings.php';
			$this->con = new mysqli(db_host, db_user, db_password, db_name);

			if (mysqli_connect_errno()) {
				echo "Koneksi database gagal: ".mysqli_connect_err();
			} else {						
				return $this->con;				
			}

		}
	}
