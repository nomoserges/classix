<?php require_once '_inc_header.php'; ?>
<?php
require_once '../classes/Categories.php';
$categories= new Categories();
/*Liste des catégories  */
$categoriesList = $categories->getList();
/*Liste des categories parents */
$parentCategories = $categories->getParentCategories();
/*  Gestion du formulaire   */
$errors = array();
$errorsFound = false;
if( !empty($_POST) ){
    if(empty($_POST['categoryName'])){
        $errors['error'] = "Nom de catégorie invalide";
        $errorsFound = true;
    }
    /*  on verifie si la categorie n'existe pas encore   */
    $categories->setParentCid($_POST['parentCID']);
    $categories->setCategoryName(htmlentities($_POST['categoryName']));
    $categories->setCatId(0);
    if( $categories->getCategory() <> 0 ){
        $errors['error'] = "Informations déjà disponibles.";
        $errorsFound = true;
    }
    /** Insertion   **/
    if( $errorsFound === false ) {
        $resulStatement = $categories->insert();
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
                <div class="col-md-12">
                    <h3 class="section-title">Gestion des catégories d'annonces</h3>
                </div>
                <div class="col-md-12">
                    <?php   $library->debug_errors($errors); ?>
                    <form  role="form" class="login-form" method="post"
                           action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group col-lg-4 col-sm-12">
                            <select name="parentCID">
                                <option value="0">Pas de cat. parent</option>
                                <?php for($j=0;$j<sizeof($parentCategories);$j++): ?>
                                <option value="<?php echo $parentCategories[$j]['cat_id'] ?>">
                                    <?php echo html_entity_decode($parentCategories[$j]['category_name']); ?>
                                </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-sm-12">
                            <input type="text" class="form-control"
                                   value="<?php $library->inputData($_POST['categoryName']); ?>"
                                   name="categoryName" placeholder="Nouvelle catégorie">
                        </div>
                        <div class="form-group col-lg-2 col-sm-12">
                            <button class="btn btn-common log-btn">Enregistrer</button>
                        </div>
                    </form>
                </div>
                <?php if($parentCategories === 0): ?>
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
                    <?php for($i=0; $i<sizeof($parentCategories); $i++): ?>
                        <div class=" col-md-3 col-sm-6 col-xs-12">
                            <div class="category-box border-1 wow fadeInUpQuick animated"
                                 data-wow-delay="0.3s"
                                 style="visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                                <div class="category-header">
                                    <?php
                                        $parentCID = $parentCategories[$i]["cat_id"];
                                        $parentName = $parentCategories[$i]["category_name"];
                                    ?>
                                    <a href="adm_sub_categories.php?parentcid=<?php echo $parentCID; ?>">
                                        <h5><?php echo html_entity_decode($parentCategories[$i]["category_name"]); ?></h5>
                                    </a>
                                </div>
                                <div class="category-content">
                                    <ul>
                                    <?php
                                    $categories->setCatId($parentCategories[$i]["cat_id"]);
                                    $subCategories = $categories->getCatsFromParent();
                                    //var_dump($subCategories);
                                    ?>
                                    <?php for($k=0; $k<sizeof($subCategories); $k++): ?>
                                    <li>
                                        <a href="#"><?php echo $subCategories[$k]["category_name"]; ?></a>
                                    </li>
                                    <?php endfor; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>


<?php require_once '../_inc/_inc_footer.php'; ?>