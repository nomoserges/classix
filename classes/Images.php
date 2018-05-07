<?php
/**
 * Created by PhpStorm.
 * User: sean
 * Date: 17/03/2018
 * Time: 22:39
 */

class Images {
public $filename;
public $idadvert;
public $status;

    /**
     * Images constructor.
     */
    public function __construct() {

    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return mixed
     */
    public function getIdadvert()
    {
        return $this->idadvert;
    }

    /**
     * @param mixed $idadvert
     */
    public function setIdadvert($idadvert)
    {
        $this->idadvert = $idadvert;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }



}