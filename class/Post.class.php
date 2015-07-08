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

	public static function getList($sql) {
		$result = Db::getInstance()->query($sql)->fetchAll();

		$posts = array();
		foreach($result as $post) {
			$posts[] = new Post($post);
		}
		return $posts;
	}

	public static function getRandom($sql) {
		$posts = self::getList($sql);
		return $posts[0];
	}

	public static function displayPost($post, $max_length = 0) {

		$html = '
		<div class="post">
		    <p>'.date('d-m-Y H:i:s', strtotime($post->creation_date)).' par <a href="#">'.$post->author.'</a></p>
		    <blockquote>
		      <p>';

		if ($max_length > 0) {
			$html .= Utils::cutString($post->content, $max_length, '... <a href="post.php?id='.$post->id.'">Lire la suite</a>');
		} else {
			$html .= nl2br($post->content);
		}

		$html .= '
		      </p>
		    </blockquote>
		</div>
		';

		return $html;
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
	public function getCreationDate($format = 'd-m-Y H:i:s') {
		if (empty($format)) {
			$format = 'Y-m-d H:i:s';
		}
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