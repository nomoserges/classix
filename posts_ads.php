<?php
require_once 'lib/Functions.php';
if(!isset($_SESSION['user'])||empty($_SESSION['user']['pseudo'])){
    $library->openUrl($library->getServerHost()."login.php");
}
/*  Les membres du personnel ne publient pas avec
    leurs comptes du panel */
if( $_SESSION['user']['user_group']=="gestionnaire" || $_SESSION['user']['user_group']=="admin" ){
    $library->openUrl($library->getServerHost());
}
$pageTitle = "Bienvenue";
include "_inc/_inc_header.php";
?>
<body>
<?php include '_inc/_inc_navbar.php'; ?>
<?php
    require_once "classes/Settingprices.php";
    $paramTarifs = new Settingprices();
    require_once 'classes/Adverts.php';
    require_once 'classes/Images.php';
    require_once 'classes/Categories.php';
    $categories = new Categories();
    $parentCat = $categories->getParentCategories();
    require_once 'classes/Regions.php';
    require_once 'classes/Cities.php';
    $regions = new Regions();
    $cities = new Cities();
    $regionsList = $regions->getList();
    $fieldStatus = true;
    $annonceID = null;

    /*  On initialise les infos du contacts avec la session */
    $contact = array(
        "fullname" => $_SESSION['user']['prenoms']." ".$_SESSION['user']['nom'],
        "email" => $_SESSION['user']['email'],
        "address" => $_SESSION['user']['adresse'],
        "phones" => $_SESSION['user']['telephones']
    );

    /*  GESTION des champs classiques du formulaire     */
    if( !empty($_POST) ){
        /* Gestion des informations du contact avec les variables $_SESSION et $_POST */
        $contact = array(
            "fullname" => $_POST['ads_contact_name'],
            "email" => $_POST['ads_contact_email'],
            "address" => $_POST['ads_contact_address'],
            "phones" => $_POST['ads_contact_phone']
        );
        if( empty($_POST['cat_id']) || $_POST['cat_id'] == null ){
            $errors['error'] = "Sélectionner une catégorie valide!";
            $fieldStatus = false;
        }elseif( empty($_POST['city_name']) || $_POST['city_name'] == null ) {
            $errors['error'] = "Sélectionner une ville valide!";
            $fieldStatus = false;
        }elseif( empty($_POST['ads_title']) || $_POST['ads_title'] == null ) {
            $errors['error'] = "Le titre n'est pas valide !";
            $fieldStatus = false;
        }elseif( empty($_POST['ads_description']) || $_POST['ads_description'] == null ) {
            $errors['error'] = "Fournissez une description !";
            $fieldStatus = false;
        }elseif( !empty($_POST['ads_price']) && ctype_digit($_POST['ads_price']) == false ) {
            $errors['error'] = "Le prix n'est pas valide !";
            $fieldStatus = false;
        }elseif( empty($_POST['ads_validity'])||ctype_digit($_POST['ads_validity']) == false||intval($_POST['ads_validity'])<1){
            /*  Si la date de fin est inférieur à la date de début  */
            $errors['error'] = "Période invalide !";
            $fieldStatus = false;
        }elseif ( empty($_POST['ads_contact_name']) ){
            $errors['error'] = "Nom de contact invalide !";
            $fieldStatus = false;
        }elseif ( empty($_POST['ads_contact_email']) ){
            $errors['error'] = "Email invalide !";
            $fieldStatus = false;
        }elseif ( empty($_POST['ads_contact_address']) ){
            $errors['error'] = "Adresse invalide !";
            $fieldStatus = false;
        }elseif ( empty($_POST['ads_contact_phone']) ){
            $errors['error'] = "Téléphone invalide !";
            $fieldStatus = false;
        }

        if( true === $fieldStatus ){
            $annonce = new Adverts();
            $annonce->setPseudo($_SESSION['user']['pseudo']);
            $annonce->setCatId($_POST['cat_id']);
            $annonce->setCityName($_POST['city_name']);
            $annonce->setTitle($_POST['ads_title']);
            $annonce->setDescription($_POST['ads_description']);
            $annonce->setValidity($_POST['ads_validity']);
            $annonce->setInitialPrice($_POST['ads_price']);
            /*  Calcul des prix   */
            /*$paramTarifs->setCategory("texte");
            $annonce->setPriceText($paramTarifs->calculatePrice(strlen($_POST['ads_description'])));
            $paramTarifs->setCategory("duree");
            $annonce->setPriceValidity($paramTarifs->calculatePrice(intval($_POST['ads_validity'])));*/
            $annonce->setPriceText(0);
            $annonce->setPriceValidity(0);
            $annonce->setPriceImages(0);
            $annonce->setPrice(0);
            /*  Fin calcul des prix     */
            $annonce->setTags($_POST['ads_tags']);
            $annonce->setContactFullname($_POST['ads_contact_name']);
            $annonce->setContactEmail($_POST['ads_contact_email']);
            $annonce->setContactPhone($_POST['ads_contact_phone']);
            $annonce->setContactAddress($_POST['ads_contact_address']);
            $annonce->setPaymentVisa($_POST['ads_visa']);
            $annonce->setPaymentPaypal($_POST['ads_paypal']);
            $annonce->setPaymentBank($_POST['ads_bank']);
            $annonce->setPaymentCashier($_POST['ads_cashier']);
            $resultStmt = $annonce->insert();
            if ( $resultStmt == true ){
                $annonceID = $annonce->getIdadvert();
                if( isset($_FILES)){
                    $imageToUpload = new Images();
                    $i = 0;
                    while ( $i<count($_FILES['ads_image']['name']) ){
                        if($_FILES['ads_image']['name'][$i]<>''||$_FILES['ads_image']['name'][$i]<>null){
                            $imageToUpload->setIdadvert($annonceID);
                            $imageToUpload->setFileName($imageToUpload->renameOriginalFile($_FILES['ads_image']['name'][$i]));
                            $imageToUpload->setImageStatus("online");
                            if ($i==0){ $imageToUpload->setIsDefault(1); }
                            else{ $imageToUpload->setIsDefault(0); }
                            $storeInDbStatus = $imageToUpload->insert();
                            if($storeInDbStatus==true){
                                if(move_uploaded_file($_FILES['ads_image']['tmp_name'][$i],
                                    "./uploads/".$imageToUpload->getFileName())){

                                }else{ $fieldStatus = false; }
                            }else{ $fieldStatus = false; }
                        }
                        $i++;
                    }
                }
                /*Mise à jour des prix */
                $paramTarifs->setCategory("texte");
                $annonce->setPriceText($paramTarifs->calculatePrice(strlen($_POST['ads_description'])));
                $paramTarifs->setCategory("duree");
                $annonce->setPriceValidity($paramTarifs->calculatePrice(intval($_POST['ads_validity'])));

                $imageToUpload->setIdadvert($annonceID);
                $images = $imageToUpload->getAdsImages();
                $paramTarifs->setCategory("image");
                $annonce->setPriceImages($paramTarifs->calculatePrice( sizeof($images) ));
                $annonce->setPrice(intval($annonce->getInitialPrice())
                    +intval($annonce->getPriceText())
                    +intval($annonce->getPriceValidity())
                    +intval($annonce->getPriceImages()));
                //var_dump($annonce);
                $annonce->updatePrices();
                $_POST = array();
                unset($_POST);
                $library->alert("Annonce enregistrée!");
                $library->doReloadPage();
            }else{
                $errors['error'] = "Erreur d'enregistrement !".$resultStmt;
            }
        }
    }

?>
<section id="content">
    <div class="container">
        <div class="row">
            <?php include '_inc/_inc_account_menu.php'; ?>
            <div class="col-sm-12 col-lg-9 page-content">
                <?php $library->debug_errors( $errors); ?>
                <form action="" role="form" method="post" enctype="multipart/form-data">
                    <!--    Informations générales  -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group col-sm-12 col-lg-6">
                                <select name="cat_id" class="col-sm-12">
                                    <option value="">Sélectionner une catégorie</option>
                                    <?php for($i=0; $i < sizeof($parentCat); $i++): ?>
                                        <optgroup label="<?php $library->outputField($parentCat[$i]['category_name']); ?>">
                                            <?php
                                            $categories->setCatId($parentCat[$i]['cat_id']);
                                            $childCat = $categories->getCatsFromParent();
                                            ?>
                                            <?php for($j=0; $j < sizeof($childCat); $j++): ?>
                                                <option value="<?php echo $childCat[$j]['cat_id']; ?>"
                                                    <?php if(isset($_POST['cat_id'])&&$_POST['cat_id']==$childCat[$j]['cat_id']) echo 'selected="selected"' ?>>
                                                    <?php $library->outputField($childCat[$j]['category_name']); ?>
                                                </option>
                                            <?php endfor; ?>
                                        </optgroup>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-12 col-lg-6">
                                <select name="city_name" class="col-sm-12">
                                    <option value="">Choisir une localisation</option>
                                    <?php for($i=0; $i < sizeof($regionsList); $i++): ?>
                                        <optgroup label="<?php $library->outputField($regionsList[$i]['region_name']); ?>">
                                            <?php
                                            $cities->setRegionid($regionsList[$i]['regionid']);
                                            $citiesList = $cities->getRegionCities();
                                            ?>
                                            <?php if(sizeof($citiesList)>0): ?>
                                                <?php for($j=0; $j < sizeof($citiesList); $j++): ?>
                                                    <option value="<?php echo $citiesList[$j]['city_name']; ?>"
                                                        <?php if(isset($_POST['city_name'])&&$_POST['city_name']==$citiesList[$j]['city_name']) echo 'selected="selected"' ?>>
                                                        <?php $library->outputField($citiesList[$j]['city_name']); ?>
                                                    </option>
                                                <?php endfor; ?>
                                            <?php endif; ?>
                                        </optgroup>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="ads_title">Titre <span class="text-danger">*</span></label>
                                <input type="text" id="ads_title" name="ads_title" class="form-control"
                                       value="<?php $library->inputData($_POST['ads_title']); ?>" />
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="ads_description">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="ads_description" name="ads_description"
                                          placeholder="Décrivez votre annonce" rows="2"><?php $library->inputData($_POST['ads_description']); ?></textarea>
                            </div>
                            <div class="form-group col-sm-12 col-lg-3">
                                <label for="ads_price">Validité (Jrs)</label>
                                <input type="number" id="ads_validity" name="ads_validity" class="form-control"
                                       value="<?php $library->inputData($_POST['ads_validity']); ?>" />
                            </div>
                            <div class="form-group col-sm-12 col-lg-3">
                                <label for="ads_price">Prix (Optionnel)</label>
                                <input type="number" id="ads_price" name="ads_price" class="form-control"
                                       value="<?php $library->inputData($_POST['ads_price']); ?>" />
                                <span id="helpBlock" class="help-block">Prix hors tarifs du site</span>
                            </div>
                            <div class="form-group col-sm-12 col-lg-6">
                                <label for="ads_tags">Tags (Optionnels)</label>
                                <input type="text" id="ads_tags" name="ads_tags" class="form-control"
                                       value="<?php $library->inputData($_POST['ads_tags']); ?>" />
                                <span id="helpBlock" class="help-block">séparer avec de virgules</span>
                            </div>

                        </div>
                    </div>
                    <!--    Validité, contact et modes de paiement  -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <!--contact-->
                            <div class="form-group col-sm-12 col-lg-6">
                                <label for="ads_contact_name">Nom complet <span class="text-danger">*</span></label>
                                <input type="text" id="ads_contact_name" name="ads_contact_name" class="form-control"
                                       value="<?php $library->inputData($contact['fullname']); ?>" />
                                <span id="helpBlock" class="help-block">Personne à contacter</span>
                            </div>
                            <div class="form-group col-sm-12 col-lg-6">
                                <label for="ads_contact_email">Email <span class="text-danger">*</span></label>
                                <input type="text" id="ads_contact_email" name="ads_contact_email" class="form-control"
                                       value="<?php $library->inputData($contact['email']); ?>" />
                            </div>
                            <div class="form-group col-sm-12 col-lg-6">
                                <label for="ads_contact_phone">Téléphones <span class="text-danger">*</span></label>
                                <input type="text" id="ads_contact_phone" name="ads_contact_phone" class="form-control"
                                       value="<?php $library->inputData($contact['phones']); ?>" />
                            </div>
                            <div class="form-group col-sm-12 col-lg-6">
                                <label for="ads_contact_address">Adresse <span class="text-danger">*</span></label>
                                <input type="text" id="ads_contact_address" name="ads_contact_address" class="form-control"
                                       value="<?php $library->inputData($contact['address']); ?>" />
                            </div>
                            <div class="form-group col-sm-12 col-lg-3">
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="ads_visa" value="1"
                                            <?php if(isset($_POST['ads_visa'])&&$_POST['ads_visa']=="1") echo 'checked'; ?>> Visa
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-sm-12 col-lg-3">
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="ads_paypal" value="1"
                                            <?php if(isset($_POST['ads_paypal'])&&$_POST['ads_paypal']=="1") echo 'checked'; ?>> Paypal
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-sm-12 col-lg-3">
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="ads_bank" value="1"
                                            <?php if(isset($_POST['ads_bank'])&&$_POST['ads_bank']=="1") echo 'checked'; ?>> Virement bancaire
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-sm-12 col-lg-3">
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="ads_cashier" value="1"
                                            <?php if(isset($_POST['ads_cashier'])&&$_POST['ads_cashier']=="1") echo 'checked'; ?>> En espèces
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--    Images à uploader  -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php for ($i=0;$i<4;$i++): ?>
                                <div class="form-group col-sm-12 col-lg-6 center">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                             style="width: 200px; height: 150px;"></div>
                                        <div>
                                    <span class="btn btn-primary btn-file">
                                        <span class="fileinput-new">Choisir une image</span>
                                        <span class="fileinput-exists">Changer</span>
                                        <input type="file" name="ads_image[]">
                                    </span>
                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Retirer</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div class="form-group col-sm-12 col-lg-6 col-lg-offset-3">
                        <button type="submit" class="btn btn-primary pull-right">Enregistrer l'annonce</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



<?php include '_inc/_inc_footer.php'; ?>
