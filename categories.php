<?php
require_once 'lib/Functions.php';
$pageTitle = "Categories";
require_once "_inc/_inc_header.php";
?>
<body>
<?php
include '_inc/_inc_navbar.php';
include '_inc/_inc_search.php';
require_once 'classes/Categories.php';

$categories= new Categories();
/*Liste des catégories  */
$categoriesList = $categories->getList();
/*Liste des categories parents */
$parentCategories = $categories->getParentCategories();
?>
<style>
    .category-box .category-header:hover{
        color: #fff !important;
    }
</style>
<section id="categories-homepage">
    <div class="container">
        <div class="row">
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
                        <a href="main_categorie.php?id=<?php echo $parentCategories[$i]["cat_id"] ?>">
                            <h6>
                            <?php echo substr(html_entity_decode($parentCategories[$i]["category_name"]), 0, 30); ?>
                            <?php if (strlen(html_entity_decode($parentCategories[$i]["category_name"])) > 30): ?>
                                &nbsp;...
                            <?php endif; ?>
                            </h6>
                        </a>
                    </div>
                    <div class="category-content">
                        <ul>
                        <?php
                        $categories->setCatId($parentCategories[$i]["cat_id"]);
                        $subCategories = $categories->getCatsFromParent();
                        //var_dump($subCategories);
                        ?>
                        <?php for($k=0; $k < sizeof($subCategories); $k++): ?>
                        <?php if($k < 6): ?>
                            <li>
                                <a href="sub_categories.php?id=<?php echo $subCategories[$k]["cat_id"]; ?>">
                                    <?php $library->outputField($subCategories[$k]["category_name"]); ?>
                                </a>
                                <span class="category-counter"><?php echo $subCategories[$k]["NB_ADS"]; ?></span>
                            </li>
                        <?php endif; ?>
                        <?php endfor; ?>
                        <?php if(sizeof($subCategories)>6): ?>
                            <li>
                                <a href="sub_categories.php">
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
