<?php
require_once 'lib/Functions.php';
$pageTitle = "Categories";
include "_inc/_inc_header.php";
?>
<body>
<?php include '_inc/_inc_navbar.php'; ?>
<?php include '_inc/_inc_search.php'; ?>

<section id="categories-homepage">
<div class="container">
<div class="row">
<div class="col-md-12">
<h3 class="section-title">parcourir depuis 8 Categories</h3>
</div>
<?php for ($i=0; $i < 8; $i++) { ?>
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="category-box border-1 wow fadeInUpQuick animated"
    data-wow-delay="0.3s"
    style="visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
  <div class="category-header">
    <a href="sub_categories.php"><h4>Community</h4></a>
  </div>
  <div class="category-content">
  <ul>
  <li>
  <a href="sub_categories.php">Announcements</a>
  <sapn class="category-counter">3</sapn>
  </li>
  <li>
  <a href="sub_categories.php">Car Pool - Bike Ride</a>
  <sapn class="category-counter">3</sapn>
  </li>
  <li>
  <a href="sub_categories.php">Charity - Donate - NGO</a>
  <sapn class="category-counter">3</sapn>
  </li>
  <li>
  <a href="sub_categories.php">Lost - Found</a>
  <sapn class="category-counter">3</sapn>
  </li>
  <li>
  <a href="sub_categories.php">Tender Notices</a>
  <sapn class="category-counter">3</sapn>
  </li>
  <li>
  <a href="sub_categories.php">General Entertainment</a>
  <sapn class="category-counter">3</sapn>
  </li>
  <li>
  <a href="sub_categories.php">View all subcategories →</a>
  </li>
  </ul>
  </div>
  </div>
</div>
<?php } ?>


</div>
</div>
</section>

<?php include '_inc/_inc_footer.php'; ?>
