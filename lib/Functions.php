<?php
/*init_set('display_errors', 1);
init_set('display_startup_errors', 1);*/
error_reporting("E_ALL ^ E_NOTICE");
session_start();

class Functions {
    protected $server_host;

    public function __construct(){
        $this->server_host = "http://localhost/classix/";
    }

    public function baseurl(){
        echo $this->server_host;
    }

    public function getServerHost(){    return $this->server_host;  }

    public function inputData($inputContent) {
        if( isset($inputContent)){
            echo $inputContent;
        }
    }

    /** Prendre en paramètre un texte, ajouter des slashes,et
     * faire du htmlentities
     * @param $datas
     * @return string
     */
    public function secureField($datas) {
        return addslashes( htmlentities($datas) );
    }
    /** Sortie du contenu des formulaires après htmlentities
     * @param $fieldDatas
     * @return string
     */
    public function outputField($fieldDatas){
        echo html_entity_decode($fieldDatas);
    }
    /** Affichage des erreurs des formulaires
     * @param $variable
     */
    public function debug_errors($variable){
        if( sizeof($variable) > 0 ){
            echo '<blockquote class="red-text darken-1">';
            foreach ($variable as $error) {
                echo $error.'<br/>';
            }
            echo '</blockquote>';
        }
    }

    /**
     * Retourner les initiales d'une phrase
     */
    public function initiales($phrase){
        $initiales = "";
        /* remplacer les doubles espaces par un espace */
        $phrase = str_replace("  ", " ", $phrase);
        /* decouper la phrase en mots suivant les espaces */
        $mots = explode(" ", $phrase);
        /* parcours du tableau des mots*/
        for($i=0;$i<sizeof($mots);$i++){
            /* on extrait les premieres lettres et on concatène */
            $initiales .= strtoupper(substr($mots[$i], 0, 1));
        }
        echo $initiales;
    }

    public function doReloadPage(){
        echo "<meta http-equiv='refresh' content='0'>";
        //echo '<script type="application/javascript">window.location.reload(true);</script>';
    }

    public function openUrl($url){
        echo '<script type="application/javascript">window.open("'.$url.'", "_self");</script>';
    }

    public function alert($message){
        echo '<script type="application/javascript">window.alert("'.$message.'");</script>';
    }

    public function goBack(){
        echo '<script type="application/javascript">window.history.back();</script>';
    }
}

$library = new Functions();
