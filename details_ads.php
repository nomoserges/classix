<?php
require_once 'lib/Functions.php';
$pageTitle = "Détails annonce";
require_once "_inc/_inc_header.php";
?>

    <body>
<?php
include '_inc/_inc_navbar.php';
include '_inc/_inc_search.php';
require_once "classes/Settings.php";
$parametres = new Settings();
$parametre = $parametres->getsettings();

require_once "classes/Adverts.php";
require_once "classes/Images.php";
$advert = new Adverts();
$annonceImages = new Images();
if( isset($_GET['id']) && $_GET['id']<>'' ){
    $advert->setIdadvert($_GET['id']);
    $annonceImages->setIdadvert($_GET['id']);
}
/*  Mise à jour du nombre de vues */
$advert->execute("UPDATE ".TBL_Adverts." SET nb_views=nb_views+1 WHERE idadvert='".$_GET['id']."'");
/* recupération de l'annonce */
$annonce = $advert->adsDetails();

/* recupération des images */
$images = $annonceImages->getAdsImages();
require_once 'classes/Categories.php';
/*  informations sur la catégorie de l'annonce  */
$category = new Categories();
$category->setCatId($annonce[0]['cat_id']);
$categorie = $category->detailedCategory();
?>
    <div id="content">
        <div class="container">
            <div class="row">
                <!--menu de gauche-->
                <div class="col-sm-12 col-lg-3 page-sidebar">
                    <?php
                    $catGroupees = $category->getData("SELECT cat1.cat_id, cat1.category_name,"
                        ." (SELECT count(cat2.cat_id)"
                        ." FROM categories cat2"
                        ." WHERE cat2.parent_cid=cat1.cat_id) AS sub_cat"
                        ." FROM categories cat1"
                        ." WHERE cat1.parent_cid = 0");
                    ?>

                    <aside>
                        <div class="inner-box">
                            <div class="widget-title">
                                <h4>Plus vues</h4>
                            </div>
                            <div class="advimg">
                                <ul class="featured-list">
                                    <li>
                                        <img alt="" src="assets/img1.jpg">
                                        <div class="hover">
                                            <a href="http://demo.graygrids.com/themes/classix-demo/category.html#"><span>$49</span></a>
                                        </div>
                                    </li>
                                    <li>
                                        <img alt="" src="assets/img2.jpg">
                                        <div class="hover">
                                            <a href="http://demo.graygrids.com/themes/classix-demo/category.html#"><span>$49</span></a>
                                        </div>
                                    </li>
                                    <li>
                                        <img alt="" src="assets/img3.jpg">
                                        <div class="hover">
                                            <a href="http://demo.graygrids.com/themes/classix-demo/category.html#"><span>$49</span></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="inner-box">
                            <div class="categories">
                                <div class="widget-title">
                                    <i class="fa fa-align-justify"></i>
                                    <h4>Categories</h4>
                                </div>
                                <div class="categories-list">
                                    <ul>
                                        <?php for ($j=0; $j<sizeof($catGroupees); $j++): ?>
                                            <li>
                                                <a href="sub_categories.php" style="font-size: x-small;">
                                                    <?php $library->outputField($catGroupees[$j]['category_name']); ?>
                                                    <span class="category-counter">
                                                        <?php echo $catGroupees[$j]['sub_cat']; ?>
                                                    </span>
                                                </a>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
                <!--contenu principal-->
                <div class="col-sm-9">
                    <div class="inner-box ads-details-wrapper" style="padding: 6px;">
                        <h3><?php echo $annonce[0]['title']; ?></h3>
                        <p class="item-intro" style="font-size: x-small;">
                            Publié le <?php $advert->mysqlDateToFrench($annonce[0]['publish_date']); ?>
                            par <?php echo $annonce[0]['contact_fullname']; ?>,&nbsp;
                            depuis <?php echo $annonce[0]['city_name']; ?>
                        </p>
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <?php for($k=0; $k<sizeof($images); $k++): ?>
                                <?php if($images[$k]['is_default'] == "1"): ?>
                                <div class="item active">
                                <?php else: ?>
                                <div class="item">
                                <?php endif; ?>
                                    <img src="uploads/<?php echo $images[$k]['file_name']; ?>">
                                </div>
                                <?php endfor; ?>
                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div style="padding: 0px;">
                        <div class="ads-details-info col-sm-8" style="text-align: justify-all;">
                            <?php echo $annonce[0]['description']; ?>
                        </div>
                        <div class="col-sm-4">
                            <aside class="panel panel-body panel-details">
                                <ul>
                                    <li>
                                        <p class="no-margin " style="font-size: x-small;">
                                            <strong>Prix :</strong>
                                            <?php echo $annonce[0]['price']." ".$parametre[0]['short_currency']; ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="no-margin " style="font-size: x-small;">
                                            <strong>Catégorie :</strong>
                                            <?php $library->outputField($categorie[0]['cat_name']); ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="no-margin" style="font-size: x-small;">
                                            <strong>Type :</strong>
                                            <?php $library->outputField($categorie[0]['cat_parent']); ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="no-margin" style="font-size: x-small;">
                                            <strong>Localisation :</strong>
                                            <?php echo $annonce[0]['city_name']; ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class=" no-margin " style="font-size: x-small;">
                                            <strong>Enreg. le :</strong>
                                            <?php echo $advert->mysqlDateToFrench($annonce[0]['register_date']); ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class=" no-margin " style="font-size: x-small;">
                                            <strong>Nombre de vues :</strong>
                                            <?php echo $annonce[0]['nb_views']; ?>
                                        </p>
                                    </li>
                                </ul>
                                <hr>
                                <ul>
                                    <li>
                                        <p class="no-margin " style="font-size: x-small;">
                                            <strong>Contact :</strong>
                                            <?php echo $annonce[0]['contact_fullname']; ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="no-margin " style="font-size: x-small;">
                                            <strong>Email :</strong>
                                            <?php echo $annonce[0]['contact_email']; ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="no-margin" style="font-size: x-small;">
                                            <strong>Téléphone :</strong>
                                            <?php echo $annonce[0]['contact_phone']; ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="no-margin" style="font-size: x-small;">
                                            <strong>Localisation :</strong>
                                            <?php echo $annonce[0]['contact_address']; ?>
                                        </p>
                                    </li>
                                </ul>
                                <hr>
                                <a href="#" class="btn btn-primary btn-sm">Message</a>
                                <a href="#" class="btn btn-danger btn-sm">Acheter</a>
                            </aside>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include '_inc/_inc_footer.php'; ?>