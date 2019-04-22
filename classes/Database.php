<?php 
	include_once './libraries/config.php';
	/**
	 * DataBase Class
	 */
	class Database {
		
		private $connection;
		private $last_query;
		private $real_escape_str_exists;
		private $magic_quotes_active;

		function __construct() {
			$this->open_connection();
			$this->magic_quotes_active = get_magic_quotes_gpc();
			$this->real_escape_str_exists = function_exists('mysqli_real_escape_string');// i.e PHP >= v4.3.0
		}

		private function open_connection() {
			$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
			if (!$this->connection) {
				die("Database connection failed: ". mysqli_error());
			} else{
				$db_select = mysqli_select_db($this->connection, DB_NAME);
				if (!$db_select) {
					die("Database selection failed: ".mysqli_error());
				}
			}
		}

		private function close_connection(){
			if (isset($this->connection)) {
				mysqli_close($this->connection);
				unset($this->connection);
			}
		}

		public function query($sql){
			$this->last_query = $sql;
			$result = mysqli_query($this->connection, $sql);
			$this->confirm_query($result);
			$data = mysqli_fetch_assoc($result);
			return $data;
		}

		public function selectAll($sql){
			$this->last_query = $sql;
			$result = mysqli_query($this->connection, $sql);
			$this->confirm_query($result);
			while ($row = mysqli_fetch_assoc($result)) {
				$data[] = $row;
			}

			return $data;
		}

		public function insert($sql){
			$this->last_query = $sql;
			$result = mysqli_query($this->connection, $sql);
			$this->confirm_query($result);
			
			return ($result) ? true : false;
		}

		private function confirm_query($result){
			if (!$result) {
				$output = 'Database query failed: '.mysqli_error($this->connection).'<br>';
				die($output); 
				return false;
			}
			else{
				return true;
			}
		}
	}

	$db = new Database();

?>