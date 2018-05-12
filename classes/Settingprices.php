<?php
require_once 'Crud.php';
/**
 * Tarifs associées aux durées et quantitée du texte
 * de l'annonce
 */

class Settingprices extends Crud {
    public $idprice;
    public $category;
    public $min_value;
    public $max_value;
    public $price;
    private $table;

    /**
    * Settingprices constructor.
    */
    public function __construct() {
        parent::__construct();
        $this->table = TBL_Settings_Prices;
    }

    /**
     * @return mixed
     */
    public function getIdprice()
    {
        return $this->idprice;
    }/**
     * @param mixed $idprice
     */
    public function setIdprice($idprice)
    {
        $this->idprice = $idprice;
    }/**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }/**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }/**
     * @return mixed
     */
    public function getMinValue()
    {
        return $this->min_value;
    }/**
     * @param mixed $min_value
     */
    public function setMinValue($min_value)
    {
        $this->min_value = $min_value;
    }/**
     * @return mixed
     */
    public function getMaxValue()
    {
        return $this->max_value;
    }/**
     * @param mixed $max_value
     */
    public function setMaxValue($max_value)
    {
        $this->max_value = $max_value;
    }/**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }/**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Ajout d'un tarif
     */
    public function insert(){
        return $this->execute("INSERT INTO ".TBL_Settings_Prices
        ." VALUES(null, '".$this->getCategory()."', ".$this->getMinValue()
        .", ".$this->getMaxValue().", ".$this->getPrice().")");
    }

    public function getPricesPerCategory(){
        return $this->getData("SELECT * FROM ".$this->table
        ." WHERE category='".$this->getCategory()."'");
    }

}