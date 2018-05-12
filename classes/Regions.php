<?php
require_once 'Crud.php';
/**
 * Created by PhpStorm.
 * User: sean
 * Date: 10/05/18
 * Time: 11:51
 */

class Regions extends Crud {
    public $region_name;
    public $regionid;

    /**
     * Regions constructor.
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getRegionName()
    {
        return $this->region_name;
    }

    /**
     * @param mixed $region_name
     */
    public function setRegionName($region_name)
    {
        $this->region_name = $region_name;
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

    /** Insertion d'une région
     * @return bool
     */
    public function insert(){
        return $this->execute("INSERT INTO ".TBL_Regions
            ." VALUES(null, '".$this->secureField($this->getRegionName())."')");
    }

    public function getList(){
        return $this->getData("SELECT * FROM ".TBL_Regions);
    }

    public function getRegion(){
        return $this->getData("SELECT region_name FROM ".TBL_Regions
            ." WHERE region_name='".$this->getRegionName()."'"
            ." OR regionid=".$this->getRegionid());
    }
}