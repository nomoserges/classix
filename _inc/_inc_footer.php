<footer class="footer">

    <section class="footer-Content">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 wow fadeIn" data-wow-delay="0">
                    <div class="widget">
                        <h3 class="block-title">A propos de nous</h3>
                        <div class="textwidget">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lobortis tincidunt est, et euismod purus suscipit quis. Etiam euismod ornare elementum. Sed ex est, consectetur eget facilisis sed, auctor ut purus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 wow fadeIn" data-wow-delay="0.5">
                    <div class="widget">
                        <h3 class="block-title">Liens utiles</h3>
                        <ul class="menu">
                            <li><a href="./">Accueil</a></li>
                            <li><a href="categories.php">Categories</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Table des prix</a></li>
                            <li><a href="#">A propos</a></li>
                            <li><a href="#">Contacts</a></li>
                            <li><a href="#">Conditions d'utilisation</a></li>
                            <li><a href="#">Confidentialité</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 wow fadeIn" data-wow-delay="1s">
                    <div class="widget">
                        <h3 class="block-title">Derniers Tweets</h3>
                        <div class="twitter-content clearfix">
                            <ul class="twitter-list">
                                <li class="clearfix">
                                    <span>
                                    Platform to Download and Submit #Bootstrap Templates via @ProductHunt @GrayGrids
                                    <a href="#">http://t.co/cLo2w7rWOx</a>
                                    </span>
                                </li>
                                <li class="clearfix">
                                    <span>
                                    Introducing Bootstrap 4 Features: What’s new, What’s gone!
                                    <a href="#">http://t.co/cLo2w7rWOx</a>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <div id="copyright">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="site-info center">
            <p>All copyrights reserved © 2018 - Designed &amp; Developed by
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>"
                rel="nofollow">Machoudi & Sean</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>


<a href="http://demo.graygrids.com/themes/classix-demo/login.html#" class="back-to-top">
<i class="fa fa-angle-up"></i>
</a>

<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/jquery-min.js"></script>
<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/material.min.js"></script>
<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/material-kit.js"></script>
<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/jquery.parallax.js"></script>
<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/wow.js"></script>
<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/main.js"></script>
<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/jquery.counterup.min.js"></script>
<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/waypoints.min.js"></script>
<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/jasny-bootstrap.min.js"></script>
<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/form-validator.min.js"></script>
<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/contact-form-script.js"></script>
<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?php $library->baseurl(); ?>assets/bootstrap-select.min.js"></script>
<script type="application/javascript">
    $(document).ready(function () {
        $("#rememberRegister").click(function (e) {
            /*e.preventDefault();*/
            console.log($("#rememberCheckbox").checked);
        });
        $("#btn-form-01").click(function () {
            $('#form-ads-tab li:eq(1) a').tab('show');
        });
        $("#btn-form-04").click(function () {
            $('#form-ads-tab li:eq(1) a').tab('show');
        });
        $("#btn-form-02").click(function () {
            $('#form-ads-tab a:first').tab('show');
        });
        $("#btn-form-03").click(function () {
            $('#form-ads-tab a:last').tab('show');
        });
    });
</script>

</body>
</html>
