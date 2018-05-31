<?php
require_once 'lib/Functions.php';
$pageTitle = "Categories";
require_once "_inc/_inc_header.php";
?>
<body>
<?php
include '_inc/_inc_navbar.php';
include '_inc/_inc_search.php';
require_once 'classes/Regions.php';
require_once 'classes/Cities.php';
$regions = new Regions();
$regionsList = $regions->getList();

$cities = new Cities();

?>
<style>
    .category-box .category-header:hover{
        color: #fff !important;
    }
</style>
<section id="categories-homepage">
    <div class="container">
        <div class="row">
            <?php for($i=0; $i<sizeof($regionsList); $i++): ?>
                <div class=" col-md-3 col-sm-6 col-xs-12">
                    <div class="category-box border-1 wow fadeInUpQuick animated"
                         data-wow-delay="0.3s"
                         style="visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                        <div class="category-header">
                            <a href="regions.php?id=<?php echo $regionsList[$i]["regionid"]; ?>">
                                <h6>
                                    <?php echo substr(html_entity_decode($regionsList[$i]["region_name"]), 0, 30); ?>
                                    <?php if (strlen(html_entity_decode($regionsList[$i]["region_name"])) > 30): ?>
                                        &nbsp;...
                                    <?php endif; ?>
                                </h6>
                            </a>
                        </div>
                        <div class="category-content">
                            <ul>
                                <?php
                                $cities->setRegionid($regionsList[$i]["regionid"]);
                                $citiesList = $cities->getRegionCities();
                                //var_dump($citiesList);
                                ?>
                                <?php for($k=0; $k < sizeof($citiesList); $k++): ?>
                                    <?php if($k < 6): ?>
                                        <li>
                                            <a href="cities.php?id=<?php echo $citiesList[$k]["city_name"]; ?>">
                                                <?php $library->outputField($citiesList[$k]["city_name"]); ?>
                                            </a>
                                            <span class="category-counter"><?php echo $citiesList[$k]["NB_ADS"]; ?></span>
                                        </li>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                <?php if(sizeof($subCategories)>6): ?>
                                    <li>
                                        <a href="regions.php?id=<?php echo $regionsList[$i]["regionid"]; ?>">
                                            <strong>Voir plus →</strong>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>

        </div>
    </div>
</section>

<?php include '_inc/_inc_footer.php'; ?>
