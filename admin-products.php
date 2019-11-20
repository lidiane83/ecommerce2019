<?php
use Hcode\PageAdmin;
use Hcode\Model\User;
use Hcode\Model\Products;

$app->get("/admin/products", function(){
    User::verifyLogin();
    $page = new Hcode\PageAdmin();
    $products= \Hcode\Model\Products::listAll();
    $page->setTpl('products', ['products'=>$products]);
});
$app->get("/admin/products/create", function(){
    User::verifyLogin();
    $page = new Hcode\PageAdmin();
    $products= \Hcode\Model\Products::listAll();
    $page->setTpl('products-create');
});
$app->post("/admin/products/create", function(){
    User::verifyLogin();
    $products= new Products();
    $products->setData($_POST);
    $products->save();
    header("Location:/admin/products");
    exit();
});
$app->get("/admin/products/:idproducts", function($idproducts){
    User::verifyLogin();
    $products= new Products();
    $products->get((int)$idproducts);
    
    $page = new PageAdmin();
    $page->setTpl("products-update",['product'=>$products->getValues()]);
});
$app->post("/admin/products/:idproducts", function($idproducts){
    User::verifyLogin();
    $products= new Products();
    $products->get((int)$idproducts);
    $products->setData($_POST);
    $products->save();
    $products->setPhoto($_FILES['file']);
    
    header('Location:/admin/products');
    exit;
});