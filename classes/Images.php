<?php
require_once 'Crud.php';


class Images extends Crud {
    public $idadvert;
    public $file_name;
    public $is_default;
    public $images_status;

    /**
     * Images constructor.
     */
    public function __construct(){
        parent::__construct();
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
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * @param mixed $file_name
     */
    public function setFileName($file_name)
    {
        $this->file_name = $file_name;
    }

    /**
     * @return mixed
     */
    public function getisDefault()
    {
        return $this->is_default;
    }

    /**
     * @param mixed $is_default
     */
    public function setIsDefault($is_default)
    {
        $this->is_default = $is_default;
    }

    /**
     * @return mixed
     */
    public function getImageStatus()
    {
        return $this->images_status;
    }

    /**
     * @param mixed $images_status
     */
    public function setImageStatus($images_status)
    {
        $this->images_status = $images_status;
    }

    public function generateFilename(){
        $newFilename = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789");
        $isFind = true;
        while ($isFind) {
            # Search the generate's ID in the table
            $sql = "SELECT file_name FROM ".TBL_Images
                ." WHERE file_name LIKE '".$newFilename."%'";
            $num_rows = $this->getRows( $sql );

            /** Test de la valeur isFind */
            if( $num_rows > 0 ) {
                /* le fichier existe*/
                $isFind = true;
            }else {
                /* ce fichier n'existe pas*/
                $isFind = false;
                break;
            }
        }
        return $newFilename;
    }

    /** Insérer une image dans la base de données
     * @return bool
     */
    public function insert(){
        return $this->execute("INSERT INTO ".TBL_Images
            ." VALUES('".$this->getIdadvert()."', '".$this->getFileName()
            ."', '".$this->getisDefault()."', 'online', null)");
    }

    /** Changer le nom initial d'une image
     * afin d'éviter les doublures de nom de fichier
     * @param $oldFilename
     * @return string
     */
    public function renameOriginalFile($oldFilename){
        $tab = explode(".", $oldFilename);
        $newfilename = $this->generateFilename();
        return $newfilename.".".$tab[1];
    }

    /** Convertir une date mysql au format dd/mm/aaaa à hh:mm:ss
     * @return array|int|string
     */
    public function getAdsImages(){
        return $this->getData("SELECT * FROM "
            .TBL_Images." WHERE idadvert='".$this->getIdadvert()
            ."' AND image_status='online'");
    }

}