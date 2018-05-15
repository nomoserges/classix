<footer class="footer">
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
        /*Afficher l'onglet des images*/
        $("#ads-general-next").click(function (e) {
            e.preventDefault();
            $("#ads-general").css("display", "none");
            $("#ads-images").css("display", "inline-block");
        });
        /*Retourner à l'onglet general*/
        $("#ads-images-previous").click(function (e) {
            e.preventDefault();
            $("#ads-images").css("display", "none");
            $("#ads-general").css("display", "inline-block");
        });
        /*Afficher l'onglet contact*/
        $("#ads-images-next").click(function (e) {
            e.preventDefault();
            $("#ads-images").css("display", "none");
            $("#ads-contact").css("display", "inline-block");
        });
        /*Retourner à l'onglet images*/
        $("#ads-contact-previous").click(function (e) {
            e.preventDefault();
            $("#ads-images").css("display", "inline-block");
            $("#ads-contact").css("display", "none");
        });
    });
</script>

</body>
</html>
