<?php require_once '_inc_header.php'; ?>
<?php
/**/
$parentID = $_GET['parentcid'];
require_once '../classes/Categories.php';
$category= new Categories();
/*  Liste des sous-categories   */
$category->setCatId($parentID);
$subCategories = $category->getCatsFromParent();
/*  Gestion du formulaire   */
$errors = array();
$errorsFound = false;
if( !empty($_POST) ){
    if(empty($_POST['categoryName'])){
        $errors['error'] = "Nom de catégorie invalide";
        $errorsFound = true;
    }
    $category->setParentCid($parentID);
    $category->setCategoryName(htmlentities($_POST['categoryName']));
    $category->setCatId(null);
    if( $category->getCategory() <> 0 ){
        $errors['error'] = "Informations déjà disponibles.";
        $errorsFound = true;
    }
    /** insertion **/
    if( $errorsFound === false ) {
        $resulStatement = $category->insert();
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
/*  Suppression d'une sous-catégorie    */
if( isset($_GET['category_id']) && !empty($_GET['category_id'])){
    //echo "supppression de cat id".$_GET['category_id'];
    $category->setCatId( $_GET['category_id'] );
    $deleteStatement = $category->delete();
    if( $deleteStatement === true ){
        $library->alert("Suppression effectuée !");
        $library->goBack();
    }else{
        $library->alert($resulStatement);
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
                    <h3 class="section-title">Sous-catégories</h3>
                </div>
                <div class="col-md-12 col-lg-offset-2">
                    <?php   $library->debug_errors($errors); ?>
                    <form  role="form" class="login-form" method="post"
                           action="<?php echo $_SERVER['PHP_SELF']; ?>?parentcid=<?php echo $parentID; ?>">
                        <div class="form-group col-lg-6 col-sm-12">
                            <input type="text" class="form-control" autofocus
                                   value="<?php $library->inputData($_POST['categoryName']); ?>"
                                   name="categoryName" placeholder="Nouvelle sous catégorie">
                        </div>
                        <div class="form-group col-lg-2 col-sm-12">
                            <button class="btn btn-common log-btn">Enregistrer</button>
                        </div>
                    </form>
                </div>
                <?php if($subCategories === 0): ?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="category-box border-1 wow fadeInUpQuick animated"
                             data-wow-delay="0.3s"
                             style="height: 200px!important;max-height: 300px!important;visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                            <div class="category-header">
                                <a href="#"><h4>Catégories non configurées</h4></a>
                            </div>
                            <div class="category-content"
                                 style="text-align: center;padding-top: 30px;">
                                <h1>0</h1>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php for($i=0; $i<sizeof($subCategories); $i++): ?>
                        <div class=" col-md-3 col-sm-6 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-body center">
                                    <h5>
                                        <?php $library->outputField($subCategories[$i]["category_name"]); ?>
                                    </h5>
                                </div>
                                <div class="panel-footer center">
                                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?category_id=<?php echo $subCategories[$i]["cat_id"]; ?>"
                                       class="btn btn-sm btn-danger">Suppr.</a>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>


<?php require_once '../_inc/_inc_footer.php'; ?>