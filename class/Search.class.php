<?php

class Search {

	public $input = '';
	public $results = array();
	public $count = 0;

	public function __construct($input) {

		if (empty($input)) {
			return false;
		}

		$this->input = strip_tags($input);

		return $this->getResults();
	}

	private function getResults() {
		$query = Db::getInstance()->prepare('SELECT * FROM posts WHERE author LIKE :search OR content LIKE :search');
		$query->bindValue('search', '%'.$this->input.'%');
		$query->execute();
		$this->results = Post::_getList($query->fetchAll());
		$this->count = $query->rowCount();
		return true;
	}

}