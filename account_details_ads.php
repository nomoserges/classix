<?php
require_once 'lib/Functions.php';
?>
<body>
<?php
include '_inc/_inc_navbar.php';
if(!isset($_SESSION['user'])||empty($_SESSION['user']['pseudo'])){
    $library->openUrl($library->getServerHost()."login.php");
}
$pageTitle = "Détails annonce";
require_once "_inc/_inc_header.php";
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
                <?php include '_inc/_inc_account_menu.php'; ?>
                <div class="col-sm-9">
                    <div class="inner-box ads-details-wrapper" style="padding: 6px;">
                        <h3><?php echo $annonce[0]['title']; ?></h3>
                        <p class="item-intro">
                            Publié le <?php $advert->mysqlDateToFrench($annonce[0]['publish_date']); ?>
                        </p>
                    </div>
                    <div style="padding: 0px;">
                        <div class="ads-details-info col-sm-7" style="text-align: justify-all;">
                            <?php echo $annonce[0]['description']; ?>
                        </div>
                        <div class="col-sm-5">
                            <aside class="panel panel-body panel-details">
                                <ul>
                                    <li>
                                        <p class="no-margin ">
                                            <strong>Prix :</strong>
                                            <?php echo $annonce[0]['price']." ".$parametre[0]['short_currency']; ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="no-margin ">
                                            <strong>Catégorie :</strong>
                                            <?php $library->outputField($categorie[0]['cat_name']); ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="no-margin">
                                            <strong>Type :</strong>
                                            <?php $library->outputField($categorie[0]['cat_parent']); ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="no-margin">
                                            <strong>Localisation :</strong>
                                            <?php echo $annonce[0]['city_name']; ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class=" no-margin ">
                                            <strong>Enreg. le :</strong>
                                            <?php echo $advert->mysqlDateToFrench($annonce[0]['register_date']); ?>
                                        </p>
                                    </li>
                                </ul>
                                <div class="clearfix">&nbsp;</div>
                                <div class="center">
                                    <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
                                </div>
                            </aside>
                        </div>
                        <hr>
                    </div>
                    <div class="box col-sm-12">

                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include '_inc/_inc_footer.php'; ?>