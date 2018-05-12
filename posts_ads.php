<?php
require_once 'lib/Functions.php';
$pageTitle = "Bienvenue";
include "_inc/_inc_header.php";
?>
<body>
<?php include '_inc/_inc_navbar.php'; ?>
<?php
    require_once 'classes/Categories.php';
    $categories = new Categories();
    $parentCat = $categories->getParentCategories();
    require_once 'classes/Regions.php';
    require_once 'classes/Cities.php';
    $regions = new Regions();
    $cities = new Cities();
    $regionsList = $regions->getList();

    var_dump($_POST);
    var_dump($_FILES);

?>
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-8 col-lg-offset-2">
                <form action="" role="form" method="post" enctype="multipart/form-data">
                    <div id="ads-general" class="box" style="display:inline-block;min-height: 450px;">
                        <div class="form-group col-sm-12 col-lg-6">
                            <select name="cat_id">
                                <option value="">Sélectionner une catégorie</option>
                                <?php for($i=0; $i < sizeof($parentCat); $i++): ?>
                                <optgroup label="<?php $library->outputField($parentCat[$i]['category_name']); ?>">
                                    <?php
                                    $categories->setCatId($parentCat[$i]['cat_id']);
                                    $childCat = $categories->getCatsFromParent();
                                    ?>
                                    <?php for($j=0; $j < sizeof($childCat); $j++): ?>
                                    <option value="<?php echo $childCat[$j]['cat_id']; ?>">
                                        <?php $library->outputField($childCat[$j]['category_name']); ?>
                                    </option>
                                    <?php endfor; ?>
                                </optgroup>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-12 col-lg-6">
                            <select name="city_name">
                                <option value="">Choisir une localisation</option>
                            <?php for($i=0; $i < sizeof($regionsList); $i++): ?>
                                <optgroup label="<?php $library->outputField($regionsList[$i]['region_name']); ?>">
                                    <?php
                                    $cities->setRegionid($regionsList[$i]['regionid']);
                                    $citiesList = $cities->getRegionCities();
                                    ?>
                                    <?php if(sizeof($citiesList)>0): ?>
                                    <?php for($j=0; $j < sizeof($citiesList); $j++): ?>
                                        <option value="<?php echo $citiesList[$j]['city_name']; ?>">
                                            <?php $library->outputField($citiesList[$j]['city_name']); ?>
                                        </option>
                                    <?php endfor; ?>
                                    <?php endif; ?>
                                </optgroup>
                            <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="ads_title">Titre</label>
                            <input type="text" id="ads_title" name="ads_title" class="form-control" >
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="ads_description">Description</label>
                            <textarea class="form-control" id="ads_description" name="ads_description"
                                      placeholder="Décrivez votre annonce" rows="4"></textarea>
                        </div>
                        <div class="form-group col-sm-12 col-lg-6">
                            <label for="ads_price">Prix (Optionnel)</label>
                            <input type="text" id="ads_price" name="ads_price" class="form-control" >
                            <span id="helpBlock" class="help-block">Prix hors tarifs du site</span>
                        </div>
                        <div class="form-group col-sm-12 col-lg-6">
                            <label for="ads_tags">Tags (séparer avec de virgules)</label>
                            <input type="text" id="ads_tags" name="ads_tags" class="form-control" >
                            <span id="helpBlock" class="help-block">Aggrémenter votre annonce lors des recherches</span>
                        </div>
                        <div class="form-group col-sm-12">
                            <button type="button" class="btn btn-primary pull-right"
                                    id="ads-general-next">Suivant</button>
                        </div>
                    </div>
                    <!--    Panel pour les images   -->
                    <div id="ads-images" class="box center" style="display:none;min-height: 550px;">
                        <div class="form-group col-sm-12 col-lg-6">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                <div>
                                    <span class="btn btn-primary btn-file">
                                        <span class="fileinput-new">Choisir une image</span>
                                        <span class="fileinput-exists">Changer</span>
                                        <input type="file" name="featured_image">
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Retirer</a>
                                </div>
                            </div>
                        </div>
                        <?php for ($i=0;$i<3;$i++): ?>
                        <div class="form-group col-sm-12 col-lg-6">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                <div>
                                    <span class="btn btn-primary btn-file">
                                        <span class="fileinput-new">Choisir une image</span>
                                        <span class="fileinput-exists">Changer</span>
                                        <input type="file" name="ads_image_<?php echo $i; ?>">
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Retirer</a>
                                </div>
                            </div>
                        </div>
                        <?php endfor; ?>
                        <div class="form-group col-sm-12 col-lg-6">
                            <button type="button" class="btn btn-danger pull-left"
                                    id="ads-images-previous">Précédent</button>
                        </div>
                        <div class="form-group col-sm-12 col-lg-6">
                            <button type="button" class="btn btn-primary pull-right"
                                    id="ads-images-next">Suivant</button>
                        </div>
                    </div>
                    <!--    Informations sur le contact et le mode de paiement  -->
                    <div id="ads-contact" class="box" style="display:none;min-height: 450px;">
                        <div class="form-group col-sm-12 col-lg-6">
                            <label for="ads_contact_name">Nom complet</label>
                            <input type="text" id="ads_contact_name" name="ads_contact_name" class="form-control" >
                            <span id="helpBlock" class="help-block">Personne à contacter</span>
                        </div>
                        <div class="form-group col-sm-12 col-lg-6">
                            <label for="ads_contact_email">Email</label>
                            <input type="text" id="ads_contact_email" name="ads_contact_email" class="form-control" >
                        </div>
                        <div class="form-group col-sm-12 col-lg-6">
                            <label for="ads_contact_phone">Téléphones</label>
                            <input type="text" id="ads_contact_phone" name="ads_contact_phone" class="form-control" >
                        </div>
                        <div class="form-group col-sm-12 col-lg-6">
                            <label for="ads_contact_address">Adresse</label>
                            <input type="text" id="ads_contact_address" name="ads_contact_address" class="form-control" >
                        </div>

                        <div class="form-group col-sm-12 col-lg-6">
                            <button type="button" class="btn btn-danger pull-left"
                                    id="ads-contact-previous">Précédent</button>
                        </div>
                        <div class="form-group col-sm-12 col-lg-6">
                            <button type="submit" class="btn btn-primary pull-right"
                                    >Terminer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



<?php include '_inc/_inc_footer.php'; ?>
