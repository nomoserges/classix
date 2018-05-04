<?php
require_once 'lib/Functions.php';
$pageTitle = "Sous-categories";
include "_inc/_inc_header.php";
?>
<body>
<?php include '_inc/_inc_navbar.php'; ?>
<?php include '_inc/_inc_search.php'; ?>

<div class="main-container">
<div class="container">
<div class="row">
<div class="col-sm-3 page-sidebar">
<aside>
  <div class="inner-box">
    <div class="categories">
      <div class="widget-title">
      <h4>Toutes Categories</h4>
      </div>
    <div class="categories-list">
      <ul>
        <?php for ($i=0; $i < 8; $i++) { ?>
        <li>
          <a href="http://demo.graygrids.com/themes/classix-demo/category.html#">
          Electronics <span class="category-counter">(<?php echo rand(0, 10); ?>)</span>
          </a>
        </li>
        <?php } ?>
      </ul>
    </div>
    </div>
  </div>
</aside>
</div>

<div class="col-sm-9 page-content">

<div class="adds-wrapper">
  <?php for ($i=0; $i < 10; $i++) { ?>
  <div class="item-list">
    <div class="col-sm-2 no-padding photobox">
      <div class="add-image">
        <a href="#"><img src="assets/img4.jpg" alt=""></a>
        <span class="photo-count"><?php echo rand(0, 5); ?></span>
      </div>
    </div>
    <div class="col-sm-7 add-desc-box">
      <div class="add-details">
        <h5 class="add-title">
          <a href="ads_details.php">Brand New All about iPhones</a>
        </h5>
        <div class="info">
          <span class="add-type">B</span>
          <span class="date">16:22:13 2017-02-29</span> -
          <span class="category">Electronics</span> -
          <span class="item-location">London</span>
        </div>
        <div class="item_desc">
          Donec ut quam felis. Cras egestas, quam in plac erat dictum,
          erat mauris inte rdum est nec.
        </div>
      </div>
    </div>
    <div class="col-sm-3 text-right  price-box">
      <h2 class="item-price"> $ <?php echo rand(50, 2000); ?> </h2>
      <a class="btn btn-danger btn-sm">
        <span>Message</span>
      </a>
      <a class="btn btn-common btn-sm"> Vues <span><?php echo rand(50, 350); ?></span> </a>
    </div>
  </div>
  <?php } ?>
</div>


<?php include '_inc/_inc_footer.php'; ?>
