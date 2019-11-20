<?php
use Hcode\PageAdmin;
use Hcode\Model\User;

$app->get("/admin/users", function (){
    User::verifyLogin();
    $users = User::listAll();
    $page = new \Hcode\PageAdmin();
    $page->setTpl("users" ,array("users"=>$users));
});
$app->get("/admin/users/create", function (){
    User::verifyLogin();
    $page = new \Hcode\PageAdmin();
    $page->setTpl("users-create");
});
$app->get("/admin/users/:iduser", function ($iduser){
    User::verifyLogin();
    $user=new Hcode\Model\User();
    $user->get((int)$iduser);
    $page = new \Hcode\PageAdmin();
    $page->setTpl("users-update", array("user"=>$user->getValues()));
});
$app->post("/admin/users/create", function(){
    $user = new User();
    $_POST["inadmin"]=(isset($_POST["inadmin"]))?1:0;
    $user->setData($_POST);
    $user->save();
    header("Location:/admin/users");
    exit();
    User::verifyLogin();
});
$app->post("/admin/users/:iduser", function($iduser){
    User::verifyLogin();
    $user = new User();
     $_POST["inadmin"]=(isset($_POST["inadmin"]))?1:0;
     $user->get((int)$iduser);
     $user->setData($_REQUEST);
     $user->update();
     header("Location:/admin/users");
    exit();
     
});
$app->delete("/admin/users/:iduser", function($iduser){
    User::verifyLogin();
    $user = new User();
     $user->get((int)$iduser);
     $user->delete();
      header("Location:/admin/users");
       exit();
});
$app->get("/admin/forgot", function(){
   $page = new \Hcode\PageAdmin(["header"=>false,"footer"=>false]);
$page->setTpl('forgot');
	
});
$app->post("/admin/forgot", function(){
   $_REQUEST['email'];
           User::getForgot($_REQUEST['email']);
            header("Location:/admin/forgot/sent");
	
});
$app->get("/admin/forgot/sent", function(){
  $page = new \Hcode\PageAdmin(["header"=>false,"footer"=>false]);
$page->setTpl('sent');
	
});
$app->get("/admin/forgot/reset", function(){
  $user = User::validForgotDecrypt($code);
    $page = new \Hcode\PageAdmin(["header"=>false,"footer"=>false]);
  $page->setTpl('forgot-reset', array("name"=>$user["desperson"],"code"=>$GET["code"]));
	
});
$app->post("/admin/forgot/reset", function(){
  $user = User::validForgotDecrypt($_POST["code"]);
    User::setForgotUsed($idrecovery);
    $user->get((int)$forgot["iduser"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT,["cost"=>12]);
    $user->setPassword($password);
  $page = new \Hcode\PageAdmin(["header"=>false,"footer"=>false]);
  $page->setTpl('forgot-reset-success', array("name"=>$user["desperson"],"code"=>$GET["code"]));

});

