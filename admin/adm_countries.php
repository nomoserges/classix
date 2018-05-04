<?php
require_once '_inc_header.php';
require_once '../classes/Countries.php';
$countries = new Countries();
$countriesList = $countries->getList();
$errors = array();
$errorsFound = false;
if( !empty($_POST) ){
    if(empty($_POST['countryCode'])){
        $errors['error'] = "Le code pays n'est pas valide.";
        $errorsFound = true;
    }
    if(empty($_POST['countryName'])){
        $errors['error'] = "Nom de pays invalide.";
        $errorsFound = true;
    }
    if(empty($_POST['countryIndicator'])){
        $errors['error'] = "indicateur pays invalide.";
        $errorsFound = true;
    }
    /*  on verifie si le pays n'existe pas encore   */
    $countries->setCountryCode($_POST['countryCode']);
    $countries->setName($_POST['countryName']);
    $countries->setPhoneIndicator($_POST['countryIndicator']);
    if( $countries->getCountry() <> 0 ){
        $errors['error'] = "Informations déjà disponibles.";
        $errorsFound = true;
    }
    /** Insertion   **/
    if( $errorsFound === false ) {
        $resulStatement = $countries->insert();
        if( $resulStatement === true ){
            $_POST = array();
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
                    <h3 class="section-title">Pays pour les annonces</h3>
                </div>
                <div class="col-md-12">
                    <?php   $library->debug_errors($errors); ?>
                    <form  role="form" class="login-form" method="post"
                           action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group col-lg-2 col-sm-12">
                            <input type="text" class="form-control"
                                   value="<?php $library->inputData($_POST['countryCode']); ?>"
                                   name="countryCode" placeholder="Code pays">
                        </div>
                        <div class="form-group col-lg-6 col-sm-12">
                            <input type="text" class="form-control"
                                   value="<?php $library->inputData($_POST['countryName']); ?>"
                                   name="countryName" placeholder="Nom pays">
                        </div>
                        <div class="form-group col-lg-2 col-sm-12">
                            <input type="text" class="form-control"
                                   value="<?php $library->inputData($_POST['countryIndicator']); ?>"
                                   name="countryIndicator" placeholder="Indicateur">
                        </div>
                        <div class="form-group col-lg-2 col-sm-12">
                            <button class="btn btn-common log-btn">Enregistrer</button>
                        </div>
                    </form>
                </div>
                <?php if($countriesList === 0): ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="category-box border-1 wow fadeInUpQuick animated"
                         data-wow-delay="0.3s"
                         style="height: 200px!important;max-height: 300px!important;visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                        <div class="category-header">
                            <a href="#"><h4>Pays non configurés</h4></a>
                        </div>
                        <div class="category-content"
                             style="text-align: center;padding-top: 30px;">
                            <h1>0</h1>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <?php for($i=0; $i<sizeof($countriesList); $i++): ?>
                <div class=" col-md-3 col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body center">
                            <h3>
                                <a href="adm_cities.php?country=<?php echo $countriesList[$i]["country_code"]; ?>">
                                    <?php echo $countriesList[$i]["name"]; ?><br>
                                    <?php echo $countriesList[$i]["country_code"]; ?>
                                    (<?php echo $countriesList[$i]["phone_indicator"]; ?>)
                                </a>
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