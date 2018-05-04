<?php
/** Require once pour inclure une seule fois ce fichier */
require_once 'Crud.php';

class Categories extends Crud {
    public $cat_id;
    public $parent_cid;
    public $category_name;

    /**
     * Categories constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getCatId()
    {
        return $this->cat_id;
    }

    /**
     * @param mixed $cat_id
     */
    public function setCatId($cat_id)
    {
        $this->cat_id = $cat_id;
    }

    /**
     * @return mixed
     */
    public function getParentCid()
    {
        return $this->parent_cid;
    }

    /**
     * @param mixed $parent_cid
     */
    public function setParentCid($parent_cid)
    {
        $this->parent_cid = $parent_cid;
    }

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @param mixed $category
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

    /** Insérer une catégorie
     * @return bool
     */
    public function insert(){
        $sqlQuery = "INSERT INTO ".TBL_Categories
            ." VALUES(null, '".$this->getParentCid()."', '".htmlentities($this->getCategoryName())."')";
        $statement = $this->execute($sqlQuery);
        return $statement;
    }

    public function delete(){
        $sqlQuery = "DELETE FROM ".TBL_Categories
        ." WHERE cat_id=".$this->getCatId();
        $statement = $this->execute($sqlQuery);
        return $statement;
    }

    /** Liste de toutes les catégories.
     * @return array|int|string
     */
    public function getList(){
        $query = "SELECT * FROM ".TBL_Categories." WHERE parent_cid=".$this->getParentCid();
        $statement = $this->getData($query);
        return $statement;
    }

    /** Retourner une catégorie.
     * @return array|int|string
     */
    public function getCategory(){
        $query = "SELECT * FROM ".TBL_Categories
            ." WHERE category_name = '".$this->getCategoryName()."'";
            //." OR cat_id = ".$this->getCatId();
        $statement = $this->getData($query);
        return $statement;
    }

    /**
     * Liste des catégories parent.
     * @return array|int|string
     */
    public function getParentCategories(){
        $query = "SELECT * FROM ".TBL_Categories
            ." WHERE parent_cid = 0";
        $statement = $this->getData($query);
        return $statement;
    }

    public function getCatsFromParent(){
        $query = "SELECT * FROM ".TBL_Categories
            ." WHERE parent_cid = '".$this->getCatId()."' ";
        $statement = $this->getData($query);
        return $statement;
    }

}