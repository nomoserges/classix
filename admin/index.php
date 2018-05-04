<?php require_once '_inc_header.php'; ?>
<style>
    .category-box .category-header:hover{
        background-color: #ff625d;
    }
</style>
<section id="categories-homepage">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title">Tableau de bord</h3>
            </div>
            <?php
            $dashboard = array(
                ["Annonces enligne", "120"],
                ["Annonces en attente", "12"],
                ["Annonceurs", "22"],
                ["Vues sur annonces", "5620"],
                ["Nombre de clicks", "220"],
                ["Images", "1250"],
                ["Gestionnaires", "4"],
                ["Administrateurs", "1"],

            );
            ?>
            <?php for($i=0; $i < sizeof($dashboard); $i++): ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="category-box border-1 wow fadeInUpQuick animated"
                         data-wow-delay="0.3s"
                         style="height: 200px!important;max-height: 300px!important;visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                        <div class="category-header">
                            <a href="#"><h4><?php echo $dashboard[$i][0]; ?></h4></a>
                        </div>
                        <div class="category-content"
                             style="text-align: center;padding-top: 30px;">
                            <h1><?php echo $dashboard[$i][1]; ?></h1>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>


<?php require_once '../_inc/_inc_footer.php'; ?>