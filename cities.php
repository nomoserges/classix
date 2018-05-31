<?php
require_once 'lib/Functions.php';
$pageTitle = "Recherche";
include "_inc/_inc_header.php";
?>
    <body>
<?php include '_inc/_inc_navbar.php';
include '_inc/_inc_search.php';

require_once "classes/Settings.php";
$parametres = new Settings();
$parametre = $parametres->getsettings();
require_once "classes/Adverts.php";
$advert = new Adverts();
require_once 'classes/Categories.php';
$category = new Categories();

$sqlQuery = "SELECT ads.idadvert, ads.title, ads.description, ads.city_name, ads.nb_views, cat.category_name,"
    ." publish_date, price, "
    ." (SELECT file_name FROM ".TBL_Images." img WHERE img.idadvert=ads.idadvert AND is_default=1 AND "
    ."image_status='online') AS file_name,"
    ." (SELECT count(file_name) FROM ".TBL_Images." img WHERE img.idadvert=ads.idadvert AND "
    ."image_status='online') AS nb_images"
    ." FROM ".TBL_Adverts." ads"
    ." INNER JOIN ".TBL_Categories." cat ON cat.cat_id = ads.cat_id"
    ." INNER JOIN ".TBL_Cities." ct ON ct.city_name = ads.city_name"
    ." WHERE ads.status='online' AND ads.is_deleted=0 AND ct.city_name = '".$_GET['id']."'";
$adsList = $advert->getData($sqlQuery);
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
                            <div class="categories">
                                <div class="widget-title">
                                    <i class="fa fa-align-justify"></i>
                                    <h4>Categories</h4>
                                </div>
                                <div class="categories-list">
                                    <ul>
                                        <?php for ($j=0; $j<sizeof($catGroupees); $j++): ?>
                                            <li>
                                                <a href="main_categorie.php?id=<?php echo $catGroupees[$j]['cat_id']; ?>"
                                                   style="font-size: x-small;">
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
                <div class="col-sm-12 col-lg-9">
                    <?php
                    //var_dump($searchesResult);
                    ?>
                    <div class="adds-wrapper">
                        <?php for ($i=0; $i<sizeof($adsList);$i++): ?>
                            <div class="item-list">
                                <div class="col-sm-2 no-padding photobox">
                                    <div class="add-image">
                                        <a href="details_ads.php?id=<?php echo $adsList[$i]['idadvert']; ?>">
                                            <img src="uploads/<?php echo $adsList[$i]['file_name']; ?>" alt="">
                                        </a>
                                        <span class="photo-count">
                                    <i class="fa fa-camera"></i><?php echo $adsList[$i]['nb_images']; ?>
                                </span>
                                    </div>
                                </div>
                                <div class="col-sm-7 add-desc-box">
                                    <div class="add-details">
                                        <h5 class="add-title">
                                            <a href="details_ads.php?id=<?php echo $adsList[$i]['idadvert'] ?>">
                                                <?php echo $adsList[$i]['title']; ?>
                                            </a>
                                        </h5>
                                        <div class="info">
                                            <span class="add-type">B</span>
                                            <span class="date">
                                        <i class="fa fa-clock"></i>
                                                <?php $advert->mysqlDateToFrench($adsList[$i]['publish_date']); ?>
                                    </span> -
                                            <span class="category">
                                        <?php $library->outputField($adsList[$i]['category_name']); ?></span> -
                                            <span class="item-location">
                                        <i class="fa fa-map-marker"></i>
                                                <?php $library->outputField($adsList[$i]['city_name']); ?>
                                    </span>
                                        </div>
                                        <div class="item_desc">
                                            <?php echo substr($adsList[$i]['description'], 0, 124) ?>&nbsp;...
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 text-right  price-box">
                                    <h6 class="item-price"> $ <?php echo $adsList[$i]['price']; ?> </h6>
                                    <a class="btn btn-danger btn-sm"><i class="fa fa-certificate"></i>
                                        <span>Top Ads</span></a>
                                    <a class="btn btn-common btn-sm">
                                        <i class="fa fa-eye"></i>
                                        <span><?php echo $adsList[$i]['nb_views']; ?></span>
                                    </a>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php include '_inc/_inc_footer.php'; ?>