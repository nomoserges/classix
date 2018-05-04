<?php
    require_once '_inc_header.php';
    require_once '../classes/Users.php';
    if(isset($_GET['group']) && !empty($_GET['group'])){
        $users = new Users();
        $users->setUserGroup($_GET['group']);
        $usersList = $users->getUsersPerGroup();

    }
?>
<section id="categories-homepage">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title">Liste des utilisateurs "<?php echo $_GET['group']; ?>"</h3>
            </div>
            <?php if($usersList=== 0): ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="category-box">
                    <div class="category-header">
                        <a href="#"><h4>Aucun utilisateurs associés</h4></a>
                    </div>
                    <div class="category-content"
                         style="text-align: center;padding-top: 30px;">
                        <h1>0</h1>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <?php for($i=0; $i<sizeof($usersList); $i++): ?>
            <div class=" col-md-3 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-body center">
                        <h5>
                            <?php echo $usersList[$i]['pseudo']; ?>
                        </h5>
                    </div>
                    <div class="panel-footer">
                        <a href="#"
                           class="btn btn-sm btn-danger col-sm-12 col-lg-6">Désac.</a>
                        <a href="#"
                           class="btn btn-sm btn-danger col-sm-12 col-lg-6">Supp.</a>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once '../_inc/_inc_footer.php'; ?>
