<?php
/** Require once pour inclure une seule fois ce fichier */
require_once 'Crud.php';

class Cities extends Crud {
    public $country_code;
    public $code_postal;
    public $city_name;

    /**
     * Cities constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * @param mixed $country_code
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * @param mixed $code_postal
     */
    public function setCodePostal($code_postal)
    {
        $this->code_postal = $code_postal;
    }

    /**
     * @return mixed
     */
    public function getCityName()
    {
        return $this->city_name;
    }

    /**
     * @param mixed $city_name
     */
    public function setCityName($city_name)
    {
        $this->city_name = $city_name;
    }

    public function insert(){
        $sqlQuery = "INSERT INTO ".TBL_Cities
            ." VALUES('".$this->getCountryCode()."', '".$this->getCodePostal()."', '".$this->getCityName()."')";
        $statement = $this->execute($sqlQuery);
        return $statement;
    }

    public function getList() {
        $query = "SELECT * FROM ".TBL_Cities;
        $statement = $this->getData($query);
        return $statement;
    }

    public function getCity(){
        $query = "SELECT * FROM ".TBL_Cities
            //." WHERE country_code = '".$this->getCountryCode()."'"
            ." WHERE code_postal = '".$this->getCodePostal()."'"
            ." OR city_name = '".$this->getCityName()."'";
        $statement = $this->getData($query);
        return $statement;
    }

    public function getCountryCities(){
        $query = "SELECT * FROM ".TBL_Cities
            ." WHERE country_code = '".$this->getCountryCode()."'";
        $statement = $this->getData($query);
        return $statement;
    }
}