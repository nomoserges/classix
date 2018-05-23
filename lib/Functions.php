<?php
/*init_set('display_errors', 1);
init_set('display_startup_errors', 1);*/
error_reporting("E_ALL ^ E_NOTICE");
session_start();

class Functions {
    protected $server_host;

    public function __construct(){
        //$this->server_host = "http://localhost/classix/";
        $this->server_host = 'http://'.$_SERVER['SERVER_NAME'].'/classix/';
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

    /** On vérifie que la date est au format jj/mm/aaaa.
     *  On vérifiera par la suite que la date est valide,
     *  ie pas de 31/06/2018.
     *  checkdate valide une date au format mm/jj/aaaa
     * @param $datefield
     * @return bool
     */
    public function checkInputDate($datefield){
        $matches = array();
        $pattern = '/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/';
        if (!preg_match($pattern, $datefield, $matches)){
            return false;
        }elseif (!checkdate($matches[2], $matches[1], $matches[3])){
            return false;
        }else{
            return true;
        }
    }

    /* Calculer la différence entre deux dates au format français*/
    public function dateDiff($date1, $date2){
        $x = explode("/", $date1);
        $y = explode("/", $date2);
        $getDateStart = new DateTime($x[2]."-".$x[1]."-".$x[0]);
        $getDateEnd = new DateTime($y[2]."-".$y[1]."-".$y[0]);
        $interval = $getDateStart->diff($getDateEnd);
        /*echo $interval->format('%R%a days');*/
        return intval($interval->format('%R%a'));
    }

    /* Convertir la date saisie au format français pour le format mysql*/
    public function dateToMysql($date){
        $x = explode("/", $date);
        return $x[2]."-".$x[1]."-".$x[0];
    }

    /* Recharger la page    */
    public function doReloadPage(){
        echo "<meta http-equiv='refresh' content='0'>";
        //echo '<script type="application/javascript">window.location.reload(true);</script>';
    }
    /*   ouvrir une page via le client   */
    public function openUrl($url){
        echo '<script type="application/javascript">window.open("'.$url.'", "_self");</script>';
    }
    /*  afficher une alerte javascript  */
    public function alert($message){
        echo '<script type="application/javascript">window.alert("'.$message.'");</script>';
    }
    /*  retour à la dernière page en javascript     */
    public function goBack(){
        echo '<script type="application/javascript">window.history.back();</script>';
    }
}

$library = new Functions();
