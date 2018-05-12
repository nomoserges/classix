<?php
/** Require once pour inclure une seule fois ce fichier */
require_once 'Crud.php';

class Cities extends Crud {
    public $regionid;
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
    public function getRegionid()
    {
        return $this->regionid;
    }

    /**
     * @param mixed $regionid
     */
    public function setRegionid($regionid)
    {
        $this->regionid = $regionid;
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
        return $this->execute("INSERT INTO ".TBL_Cities
            ." VALUES('".$this->getRegionid()."', '".$this->getCodePostal()
            ."', '".$this->getCityName()."')" );
    }

    public function getList() {
        return $this->getData("SELECT * FROM ".TBL_Cities);
    }

    public function getCity(){
        $query = "SELECT * FROM ".TBL_Cities
            //." WHERE country_code = '".$this->getCountryCode()."'"
            ." WHERE code_postal = '".$this->getCodePostal()."'"
            ." OR city_name = '".$this->getCityName()."'";
        return $this->getData($query);
    }

    public function getRegionCities(){
        $query = "SELECT * FROM ".TBL_Cities
            ." WHERE regionid = '".$this->getRegionid()."'";
        return $this->getData($query);
    }
}