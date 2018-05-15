<?php
require_once '_inc_header.php';
require_once '../classes/Regions.php';
$regions = new regions();
$regionsList = $regions->getList();
$errors = array();
$errorsFound = false;
if( !empty($_POST) ){
    if(empty($_POST['region_name'])){
        $errors['error'] = "Nom de pays invalide.";
        $errorsFound = true;
    }
    /*  on verifie si la region n'existe pas encore   */
    $regions->setRegionName($library->secureField($_POST['region_name']));
    if( $regions->getRegion() <> 0 ){
        $errors['error'] = "Informations déjà disponibles.";
        $errorsFound = true;
    }
    /** Insertion   **/
    if( $errorsFound === false ) {
        $resulStatement = $regions->insert();
        if( $resulStatement === true ){
            $library->alert("Enregistrement effectué");
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
                    <h3 class="section-title">Regions pour les annonces</h3>
                </div>
                <div class="col-md-12 col-lg-offset-2">
                    <?php   $library->debug_errors($errors); ?>
                    <form  role="form" class="login-form" method="post"
                           action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group col-lg-6 col-sm-12">
                            <input type="text" class="form-control" autofocus
                                   value="<?php $library->inputData($_POST['region_name']); ?>"
                                   name="region_name" placeholder="Nom la région">
                        </div>
                        <div class="form-group col-lg-4 col-sm-12">
                            <button class="btn btn-common log-btn">Enregistrer</button>
                        </div>
                    </form>
                </div>
                <?php if($regionsList === 0): ?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="category-box border-1 wow fadeInUpQuick animated"
                             data-wow-delay="0.3s"
                             style="height: 200px!important;max-height: 300px!important;visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                            <div class="category-header">
                                <a href="#"><h4>Regions non configurées</h4></a>
                            </div>
                            <div class="category-content"
                                 style="text-align: center;padding-top: 30px;">
                                <h1>0</h1>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php for($i=0; $i<sizeof($regionsList); $i++): ?>
                        <div class=" col-md-3 col-sm-6 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-body center">
                                    <h3>
                                        <a href="adm_cities.php?regionid=<?php echo $regionsList[$i]["regionid"]; ?>">
                                            <?php $library->outputField($regionsList[$i]["region_name"]); ?>
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