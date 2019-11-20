<?php
use Hcode\PageAdmin;


$app->get('/', function() {
    $products = \Hcode\Model\Products::listAll();
    
$page = new \Hcode\Page();
$page->setTpl('index',['products'=>$products]);
	
});

$app->get("/category/:idcategory", function($idcategory){
    
    $category = new Categories();
    $category->get((int)$idcategory);
    
    $page = new \Hcode\Page();
    $page->setTpl("category",['category'=>$category->getValues(),'products'=>[]]);
   
});