<?php
use Hcode\PageAdmin;
use Hcode\Model\User;
use Hcode\Model\Categories;

$app->get("/admin/categories", function(){
  $categories = Categories::listAll();
  $page = new \Hcode\PageAdmin();
  $page->setTpl('categories',['categories'=>$categories]);
});
$app->get("/admin/categories/create", function(){
  
  $page = new \Hcode\PageAdmin();
  $page->setTpl('categories-create');
});
$app->post("/admin/categories/create", function(){
  $categories = new Categories();
  $categories->setData($_POST);
  $categories->save();
  header('Location:/admin/categories');
  exit();  
});
$app->get("/admin/categories/:idcategory/delete", function($idcategory){
    $category = new Categories();
    $category->get((int)$idcategory);
    $category->delete();
   header('Location:/admin/categories');
  exit(); 
  
});
$app->get("/admin/categories/:idcategory", function($idcategory){
    
    $category = new Categories();
    $category->get((int)$idcategory);
    
    $page = new Hcode\PageAdmin();
    $page->setTpl("categories-update",['category'=>$category->getValues()]);
    
    
});
$app->post("/admin/categories/:idcategory", function($idcategory){
    
    $category = new Categories();
    $category->get((int)$idcategory);
    
    $category->setData($_POST);
    $category->save();
    header('Location:/admin/categories');
  exit();
});


