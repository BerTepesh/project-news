
<?php
	class DBCLass
  {
		private $server,$user,$pass,$dbname,$db, $conn;
		function __construct($server,$user,$pass,$dbname)
    {
      $this->server = $server;
      $this->user = $user;
      $this->pass = $pass;
      $this->dbname = $dbname;
      $this->connect();                 
    }
		public function getConnect() {
			return $this->$conn;
		}
		private function connect()  
    { 
			if(!$this->db)  
			{  
							$connection = mysqli_connect($this->server,$this->user,$this->pass);  
							if($connection)  
							{  
								$selectDB = mysqli_select_db($connection, $this->dbname);  
								if($selectDB)  
								{  
									$this->db = true;
									$this->$conn = $connection;
									return true;  
								} else {  
									return false;  
								}  
							} else {  
								return false;  
							}  
			} else {  
				return true;  
			}  
		}
		public function select($what,$from,$where = null,$order = null)
    {   
			$fetched = array();         
      $sql = 'SELECT '.$what.' FROM '.$from;  
			if($where != null) $sql .= ' WHERE '.$where;  
			if($order != null) $sql .= ' ORDER BY '.$order; 
			$query = mysqli_query($this->$conn, $sql);  
			if($query)  
			{  
				$rows = mysqli_num_rows($query); 
				for($i = 0; $i < $rows; $i++)  
				{  
					$results = mysqli_fetch_assoc($query);  
					$key = array_keys($results);
					$numKeys = count($key);
					for($x = 0; $x < $numKeys; $x++)  
					{ 
						$fetched[$i][$key[$x]] = $results[$key[$x]];                           
					}                                          
				} 
				return $fetched; 
			} else {  
				return false;  
			}   
		}   
		public function add($to, $from, $where) {
			$src = $from;
			$dest = $to;

			array_unshift($dest, 'id');

			$src = array_map(function($v){ return "'$v'"; }, $src);
			array_unshift($src, 'NULL');

			$src = implode (", ", $src);
			$dest = implode (", ", $dest);

			$sql = "INSERT INTO $where ($dest) VALUES ($src)"; 
			if(mysqli_query($this->$conn, $sql)) {
				return true;
			} else {
				return false;
			}
		}    
		public function update($id, $src, $where) {  
			$src = implode (", ", $src);
						
			$sql = "UPDATE $where SET $src WHERE id = '$id'";
			if(mysqli_query($this->$conn, $sql)) {
				return true;
			} else {
				return false;
			}
		}
		public function delete($id, $where) {
			$sql = "DELETE FROM $where WHERE id = '$id'"; 
			if(mysqli_query($this->$conn, $sql)) {
				return true;
			} else {
				return false;
			}
		}
	}
?>