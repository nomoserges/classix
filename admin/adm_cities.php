<?php require_once '_inc_header.php'; ?>
<?php
require_once '../classes/Regions.php';
require_once '../classes/Cities.php';
$errors = array();
$inputDisabled = "";
if( !isset($_GET['regionid']) || empty($_GET['regionid'])){
    $errors['error'] = "Région introuvable";
    /*  On désactive les champs du formulaire   */
    $inputDisabled = "disabled";
}
/*Informations sur la région*/
$region = new Regions();
$region->setRegionid($_GET['regionid']);
$regionInfos = $region->getRegion();

$regionName = $regionInfos[0]['region_name'];

/*  Gestion des villes  */
$cities = new Cities();
/*  Id de la region */
$cities->setRegionid($_GET['regionid']);
$citiesList = $cities->getRegionCities();
/*  Gestion du formulaire   */
$errorsFound = false;
if( !empty($_POST) ){
    if(empty($_POST['CodePostale'])){
        $errors['error'] = "Code postale invalide.";
        $errorsFound = true;
    }
    if(empty($_POST['CityName'])){
        $errors['error'] = "Nom de ville invalide.";
        $errorsFound = true;
    }
    /*  on verifie si la ville n'existe pas encore   */
    $cities->setCodePostal($_POST['CodePostale']);
    $cities->setCityName($_POST['CityName']);
    if( $cities->getCity() <> 0 ){
        $errors['error'] = "Informations déjà disponibles.";
        $errorsFound = true;
    }
    /** Insertion   **/
    if( $errorsFound === false ) {
        $resulStatement = $cities->insert();
        if( $resulStatement === true ){
            $library->alert("Enregistrement effectué !");
            $_POST = array();
            unset($_POST);
            $library->doReloadPage();
        }else{
            $errors['error'] = $resulStatement;
        }
    }

}
?>
    <style>
        .category-box .category-header:hover{
            background-color: #ff625d;
        }
    </style>

    <section id="categories-homepage">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-offset-4">
                    <h3 class="section-title">Villes de la région:
                        <?php $library->outputField($regionInfos[0]['region_name']); ?>
                    </h3>
                </div>
                <div class="col-md-12">
                    <?php   $library->debug_errors($errors); ?>
                    <form  role="form" class="login-form" method="post"
                           action="<?php echo $_SERVER['PHP_SELF']; ?>?regionid=<?php echo $_GET['regionid']; ?>">
                        <div class="form-group col-lg-2 col-sm-12">
                            <input type="text" class="form-control" autofocus
                                   value="<?php $library->inputData($_POST['CodePostale']); ?>"
                                   name="CodePostale" placeholder="Code postale" <?php echo $inputDisabled ?> >
                        </div>
                        <div class="form-group col-lg-8 col-sm-12">
                            <input type="text" class="form-control"
                                   value="<?php $library->inputData($_POST['CityName']); ?>"
                                   name="CityName" placeholder="Nom de la ville" <?php echo $inputDisabled ?> >
                        </div>
                        <div class="form-group col-lg-2 col-sm-12">
                            <button class="btn btn-common log-btn">Enregistrer</button>
                        </div>
                    </form>
                </div>
                <?php if($citiesList === 0): ?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="category-box border-1 wow fadeInUpQuick animated"
                             data-wow-delay="0.3s"
                             style="height: 200px!important;max-height: 300px!important;visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                            <div class="category-header">
                                <a href="#"><h4>Villes non configurées</h4></a>
                            </div>
                            <div class="category-content"
                                 style="text-align: center;padding-top: 30px;">
                                <h1>0</h1>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php for($i=0; $i<sizeof($citiesList); $i++): ?>
                        <div class=" col-md-3 col-sm-6 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-body center">
                                    <h3>
                                        <?php echo $citiesList[$i]["city_name"]; ?><br>
                                        (<?php echo $citiesList[$i]["code_postal"]; ?>)
                                    </h3>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>


<?php require_once '../_inc/_inc_footer.php'; ?>