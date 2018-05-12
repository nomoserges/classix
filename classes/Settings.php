<?php
require_once 'Crud.php';

/** Configuration du site */
class Settings extends Crud {

    public $country_code;
    public $country_name;
    public $phone_indicator;
    public $currency;
    public $short_currency;
    /**
     * Settings constructor.
     */
    public function __construct(){
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
    public function getCountryName()
    {
        return $this->country_name;
    }

    /**
     * @param mixed $country_name
     */
    public function setCountryName($country_name)
    {
        $this->country_name = $country_name;
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

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getShortCurrency()
    {
        return $this->short_currency;
    }

    /**
     * @param mixed $short_currency
     */
    public function setShortCurrency($short_currency)
    {
        $this->short_currency = $short_currency;
    }

    /** Insertion
     * @return bool
     */
    public function insert(){
        $query = "INSERT INTO ".TBL_Settings
            ." VALUES( '".$this->getCountryCode()."', '".$this->getCountryName()
            ."', '".$this->getPhoneIndicator()."', '".$this->getCurrency()
            ."', '".$this->getShortCurrency()."')";
        return $this->execute($query);
    }

    public function update(){
        $query = "UPDATE ".TBL_Settings
            ." SET country_code = '".$this->getCountryCode()."',"
            ." country_name = '".$this->getCountryName()."',"
            ." phone_indicator = '".$this->getPhoneIndicator()."',"
            ." currency = '".$this->getCurrency()."',"
            ." short_currency = '".$this->getShortCurrency()."'";
        return $this->execute($query);
    }

    public function getsettings(){
        return $this->getData("SELECT * FROM ".TBL_Settings);
    }
}