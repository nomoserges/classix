<?php
require_once '_inc_header.php';
/**/
require_once '../classes/Categories.php';
$category= new Categories();
/*  Suppression d'une sous-catégorie    */
if( isset($_GET['category_id']) && !empty($_GET['category_id'])){
    //echo "supppression de cat id".$_GET['category_id'];
    $category->setCatId( $_GET['category_id'] );
    $deleteStatement = $category->insert();
    if( $deleteStatement === true ){
        $library->alert("Suppression effectuée !");

    }else{
        $errors['error'] = $resulStatement;
    }
}
