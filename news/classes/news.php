<?php
	include $_SERVER['DOCUMENT_ROOT'].'/classes/db.php';

	class News extends DBCLass {
		private $curTable;
		function __construct($server,$user,$pass,$dbname,$curTable) {
			$this->curTable = $curTable;
			parent::__construct($server,$user,$pass,$dbname);
		}
		public function getCurTable() {
			return $this->curTable;
		}
		public function getTable($order, $table = null) {
			return parent::getTable($order, $this->curTable);
		}
		public function add($to, $from, $where = null) {
			if(parent::add($to, $from, $this->getCurTable())) {
				return true;
			} else {
				return false;
			}
		}
		public function update($id, $src, $where = null) {  
			if(parent::update($id, $src, $this->getCurTable())) {
				return true;
			} else {
				return false;
			}
		}
		public function delete($id, $where = null) {
			if(parent::delete($id, $this->getCurTable())) {
				return true;
			} else {
				return false;
			}
		}
	}
?>