<?php
namespace Hcode\Model;
use Hcode\Mailer;
use Hcode\DB\Sql;
use Hcode\Model;

class Categories extends Model{
    public static function listAll(){
        $sql = new Sql();
       return $sql->select("select * from tb_categories order by descategory");
    }
    public  function save(){
    $sql = new Sql();
    $results =   $sql->select("CALL sp_categories_save(:idcategory, :descategory)",
            array(":idcategory"=>$this->getidcategory(),
                  ":descategory"=>$this->getdescategory()
            ));
    $this->setData($results[0]);
   Categories::updateFile();
    }
    
    public function get($idcategory){
        $sql = new Sql();
      $results =  $sql->select("select * from tb_categories where idcategory = :idcategory",[":idcategory"=>$idcategory]);
      $this->setData($results[0]);
    }
    public  function delete(){
        $sql = new Sql();
        
        $sql->query("delete from tb_categories where idcategory=:idcategory",[":idcategory"=> $this->getidcategory()]);
        Categories::updateFile();
    }
public static function updateFile(){
    $categories =  Categories::listAll();
    $html = [];
foreach ($categories as $row) {
   array_push($html,'<li><a href="/category/'.$row['idcategory'].'">'.$row['descategory'].'</a></li>');
    }
    var_dump($html);
file_put_contents($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR."categories-menu.html",implode('',$html));
   
}
}