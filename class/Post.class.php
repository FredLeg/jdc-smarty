<?php

class Post {

	private $id;
	private $author;
	private $content;
	private $creation_date;

	// Par défaut on défini l'argument $data facultatif et vide par défaut, ce qui permet de continuer à instancier l'objet avec new Movie() en utilisant les setters manuellement
    public function __construct($data = array())    {

        // Pour chaque élément du tableau $data
        foreach ($data as $key => $value) {
            // On défini une variable pour reconstituer le nom d'un setter avec la clé issue du tableau $data
            $method = Utils::getCamelCase('set'.ucfirst($key)); // Ex: setContent

            // Si le setter existe dans la classe
            if (method_exists($this, $method)) {

                // On appelle le setter et on lui passe la valeur issue du tableau $data
                $this->$method($value); // Ex: $this->setContent('Lorem ipsum');
            }
        }
    }

	public function __set($key, $value) {
		$method = Utils::getCamelCase('set'.ucfirst($key)); // Ex: setTitle
		if (method_exists($this, $method)) {
			$this->$method($value);
		}
	}

	public function __get($key) {
		$method = Utils::getCamelCase('get'.ucfirst($key)); // Ex: getTitle
		if (method_exists($this, $method)) {
			return $this->$method();
		}
	}

	public static function get($id) {
		if (empty($id))	{
			return false;
		}
		$query = Db::getInstance()->prepare('SELECT * FROM posts WHERE id = :id');
		$query->bindValue('id', $id, PDO::PARAM_INT);
		$query->execute();
		return new Post($query->fetch());
	}

	// @FIXME
	public static function _getList($result) {
		$posts = array();
		foreach($result as $post) {
			$posts[] = new Post($post);
		}
		return $posts;
	}

	public static function getList($sql) {
		$result = Db::getInstance()->query($sql)->fetchAll();
		return self::_getList($result);
	}

	public static function getRandom($sql) {
		$posts = self::getList($sql);
		return $posts[0];
	}

	public static function displayPost($post, $max_length = 0) {

		$smarty = new Smarty();

		$smarty->assign(
			array(
				'post' => $post,
				'max_length' => $max_length
			)
		);

		return $smarty->fetch('partials/post-list-item.tpl');
	}

	public function insert() {

		if (empty($this->author) || empty($this->content)) {
			return false;
		}

		//$query = $db->prepare('INSERT INTO posts (author, content) VALUES (:author, :content)');
		$query = Db::getInstance()->prepare('INSERT INTO posts SET author = :author, content = :content, creation_date = NOW()');
		$query->bindValue('author', $this->author);
		$query->bindValue('content', $this->content);
		$query->execute();

		return Db::getInstance()->lastInsertId();
	}

	/* Getters */
	public function getId() {
		return $this->id;
	}
	public function getAuthor() {
		return ucfirst($this->author);
	}
	public function getContent() {
		return nl2br(htmlspecialchars($this->content));
	}
	public function getCreationDate($format = 'Y-m-d H:i:s') {
		return date($format, strtotime($this->creation_date));
	}

	/* Setters */
	public function setId($id) {
		if (!is_numeric($id)) {
			throw new Exception('ID must be an integer');
		}
		$this->id = $id;
	}
	public function setAuthor($author) {
		if (empty($author) || strlen($author) > 50) {
			throw new Exception('Author cannot be empty and 50 length max');
		}
		$this->author = $author;
	}
	public function setContent($content) {
		if (empty($content) || strlen($content) > 65536) {
			throw new Exception('Content cannot be empty and 65536 length max');
		}
		$this->content = $content;
	}
	public function setCreationDate($creation_date) {
		if (strtotime($creation_date) === false) {
			throw new Exception('Creation date must be valid');
		}
		$this->creation_date = $creation_date;
	}

	public function __toString() {
		return '<pre>'.print_r($this, true).'</pre>';
	}
}