<?php
	/*
		Manage articles
	*/
require_once("model/classes/Manager.class.php");

class ArticlesManager extends Manager{

	public function __construct(){
		parent::__construct("articles", "Article");
	}

	public function ArticleExist($id){
		parent::elementExist($id);
	}
	public function nameExist($nom){
		$select = $this->_bd->query("SELECT * FROM ".$this->table." WHERE nom = '".$nom."'");
		return ($select->rowCount() > 0);
	}
	public function getArticle($id){
		parent::getElement($id);
	}
	public function getArticles($condition=""){
		parent::getElements($condition)
	}
	
	public function add(Article $article){
		parent::add($article)
	}
	public function update(Article $article){
		parent::update($article);
	}
	public function delete($id){
		parent::delete($id);
	}
}

?>