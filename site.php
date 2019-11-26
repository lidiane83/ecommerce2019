<?php
use Hcode\PageAdmin;
use Hcode\Model\Products;

$app->get('/', function() {
    $products = Products::listAll();
    
$page = new \Hcode\Page();
$page->setTpl('index',['products'=> Products::checkList($products)]);
	
});

$app->get("/category/:idcategory", function($idcategory){
    
    $category = new Categories();
    $category->get((int)$idcategory);
    
    $page = new \Hcode\Page();
    $page->setTpl("category",['category'=>$category->getValues(),'products'=>[]]);
   
});