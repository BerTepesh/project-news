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
		public function showAll($order = null, $from = null) {
			$query = $this->select('*', $this->curTable, null, $order);
			$uploaddir = "/images/";
			foreach ($query as $row){
				echo '<div class="col">';
				echo '<div class="news-item">';
				echo '<div class="news-item__title">'.$row["title"].'</div>';
				echo '<div class="news-item__date">'.$row["date"].'</div>';
				if($row["image"]) {
					echo '<div class="news-item__image"><img src="'.$uploaddir.$row["image"].'" alt="'.$row["title"].'"></div>';
				}
				echo '<div class="news-item__text">'.$row["text"].'</div>';
				echo "<div class='news-item__edit'><a href='edit/?news_id={$row["id"]}'>Изменить</a></div>";
				echo '</div>';
				echo '</div>';
			}
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