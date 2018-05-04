<?php
/** Require once pour inclure une seule fois ce fichier */
require_once 'Crud.php';

class Countries extends Crud {
    public $country_code;
    public $name;
    public $phone_indicator;

    /**
     * Countries constructor.
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPhoneIndicator()
    {
        return $this->phone_indicator;
    }

    /**
     * @param mixed $phone_indicator
     */
    public function setPhoneIndicator($phone_indicator)
    {
        $this->phone_indicator = $phone_indicator;
    }

    public function insert(){
        $sqlQuery = "INSERT INTO ".TBL_Countries
        ." VALUES('".$this->getCountryCode()."', '".$this->getName()."', '".$this->getPhoneIndicator()."')";
        $statement = $this->execute($sqlQuery);
        return $statement;
    }

    public function getList() {
        $query = "SELECT * FROM ".TBL_Countries;
        $statement = $this->getData($query);
        return $statement;
    }

    public function getCountry(){
        $query = "SELECT * FROM ".TBL_Countries
        ." WHERE country_code = '".$this->getCountryCode()."'"
        ." OR name = '".$this->getName()."'"
        ." OR phone_indicator = '".$this->getPhoneIndicator()."'";
        $statement = $this->getData($query);
        return $statement;
    }


}