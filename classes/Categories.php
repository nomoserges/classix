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
     * @returnmixed
     */
    public function getCatId()
    {
        return$this->cat_id;
    }

    /**
     * @param mixed $cat_id
     */
    public function setCatId($cat_id)
    {
        $this->cat_id = $cat_id;
    }

    /**
     * @returnmixed
     */
    public function getParentCid()
    {
        return$this->parent_cid;
    }

    /**
     * @param mixed $parent_cid
     */
    public function setParentCid($parent_cid)
    {
        $this->parent_cid = $parent_cid;
    }

    /**
     * @returnmixed
     */
    public function getCategoryName()
    {
        return$this->category_name;
    }

    /**
     * @param mixed $category
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

    /** Insérer une catégorie
     * @returnbool
     */
    public function insert(){
        $sqlQuery = "INSERT INTO ".TBL_Categories
            ." VALUES(null, '".$this->getParentCid()
            ."', '".$this->secureField($this->getCategoryName())."')";
        return $this->execute($sqlQuery);
    }

    public function delete(){
        $sqlQuery = "DELETE FROM ".TBL_Categories
        ." WHERE cat_id=".$this->getCatId();
        return $this->execute($sqlQuery);
    }

    /** Liste de toutes les catégories.
     * @returnarray|int|string
     */
    public function getList(){
        $query = "SELECT * FROM ".TBL_Categories." WHERE parent_cid=".$this->getParentCid();
        return $this->getData($query);
    }

    /** Retourner une catégorie.
     * @returnarray|int|string
     */
    public function getCategory(){
        $query = "SELECT * FROM ".TBL_Categories
            ." WHERE category_name = '".$this->getCategoryName()."'";
            //." OR cat_id = ".$this->getCatId();
        return $this->getData($query);
    }

    /**
     * Liste des catégories parent.
     * @returnarray|int|string
     */
    public function getParentCategories(){
        $query = "SELECT * FROM ".TBL_Categories
            ." WHERE parent_cid = 0";
        return $this->getData($query);
    }

    /** Liste des sous-categories d'une categorie
     * @return array|int|string
     */
    public function getCatsFromParent(){
        $query = "SELECT * FROM ".TBL_Categories
            ." WHERE parent_cid = '".$this->getCatId()."' ";
        return $this->getData($query);
    }

    /** Categorie et categorie parent
     * @return string
     */
    public function detailedCategory(){
        return $this->getData("SELECT c.category_name as cat_name,"
            ." (SELECT d.category_name FROM ".TBL_Categories." d WHERE d.cat_id=c.parent_cid) AS cat_parent"
            ." FROM ".TBL_Categories." c WHERE c.cat_id = '".$this->getCatId()."'");
        //." OR cat_id = ".$this->getCatId();
    }

    /** Liste de toutes les catégories
     * @return array|int|string
     */
    public function allCategories(){
        return $this->getData("SELECT * FROM ".TBL_Categories);
    }


}