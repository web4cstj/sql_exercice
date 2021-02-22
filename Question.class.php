<?php
class Question {
	const SOLUTION_CACHER = 0;
	const SOLUTION_AFFICHER = 1;
	const SOLUTION_INTERACTIF = 2;
	const SOLUTION_CASES = 3;
	private $_libele;
	private $_solutions = array();
	static public $affichageSolution = self::SOLUTION_INTERACTIF;
	public function __construct($libele, $solution) {
		$this->_libele = $libele;
		for ($i=1, $fin=func_num_args(); $i<$fin; $i++) {
			array_push($this->_solutions, func_get_arg($i));
		}
	}
	public function __get($name) {
		if (method_exists($this, $name)) return $this->$name();
		throw new Exception("La propriété '$name' n'existe pas.");
	}
	public function __set($name, $val) {
		if (method_exists($this, $name)) return $this->$name($val);
		throw new Exception("La propriété '$name' n'existe pas.");
	}
	public function libele() {
		if (func_num_args()==0) return $this->_libele;
		$this->_libele = func_get_arg(0);
		return $this;
	}
	public function solution() {
		if (func_num_args()==0) return $this->_solution;
		$this->_solution = func_get_arg(0);
		return $this;
	}
	public function html() {
		$resultat = '';
		if (self::$affichageSolution == self::SOLUTION_INTERACTIF) $resultat .= '<input type="checkbox" />';
		$resultat .= $this->_libele;
		if (self::$affichageSolution == self::SOLUTION_CASES) $resultat .= '<div class="reponse"></div>';
		if (self::$affichageSolution == self::SOLUTION_INTERACTIF || self::$affichageSolution == self::SOLUTION_AFFICHER) foreach ($this->_solutions as $solution) {
			$resultat .= '<div class="solution">'.$solution.'</div>';
		}
		return $resultat;
	}
	static public function html_groupe($titre, $questions) {
		$resultat = '';
		$resultat .= '<input class="tout" type="checkbox" />';
		$resultat .= '<h3>'.$titre.'</h3>';
		$resultat .= '<ul>';
		foreach ($questions as $question) {
			$resultat .= '<li>'.$question->html().'</li>';		
		}
		$resultat .= '</ul>';
		return $resultat;
	}
	static public function html_questionnaire($groupes) {
		$resultat = '';
		//$resultat .= '<input class="tout" type="checkbox" />';
		foreach ($groupes as $titre=>$groupe) {
			$resultat .= '<div class="groupe">'.$groupe->html().'</div>';		
		}
		return $resultat;
	}
}
class Groupe {
	private $_titre;
	private $_questions = array();
	public function __construct($titre, $solution) {
		$this->_titre = $titre;
		for ($i=1, $fin=func_num_args(); $i<$fin; $i++) {
			$q = func_get_arg($i);
			if (is_array($q)) {
				foreach($q as $qq) {
					array_push($this->_questions, $qq);
				}
			} else {
				array_push($this->_questions, $q);			
			}
		}
	}
	public function __get($name) {
		if (method_exists($this, $name)) return $this->$name();
		throw new Exception("La propriété '$name' n'existe pas.");
	}
	public function __set($name, $val) {
		if (method_exists($this, $name)) return $this->$name($val);
		throw new Exception("La propriété '$name' n'existe pas.");
	}
	public function titre() {
		if (func_num_args()==0) return $this->_titre;
		$this->_titre = func_get_arg(0);
		return $this;
	}
	public function questions() {
		if (func_num_args()==0) return $this->_questions;
		$this->_questions = func_get_arg(0);
		return $this;
	}
	public function html() {
		$resultat = '';
		//$resultat .= '<input class="tout" type="checkbox" />';
		$resultat .= '<h3>'.$this->titre.'</h3>';
		$resultat .= '<ul>';
		foreach ($this->questions as $question) {
			$resultat .= '<li>'.$question->html().'</li>';		
		}
		$resultat .= '</ul>';
		return $resultat;
	}
	static public function html_questionnaire($groupes) {
		$resultat = '';
		//$resultat .= '<input class="tout" type="checkbox" />';
		foreach ($groupes as $titre=>$groupe) {
			$resultat .= '<div class="groupe">'.self::html_groupe($titre, $groupe).'</div>';		
		}
		return $resultat;
	}
}
?>