<?php
namespace Hcode;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Model{
    
    private $values = [];
    
    public function __call($name, $arguments) {//metodo que foi chamado
       $method = substr($name, 0,3);
       $fieldname = substr($name,3, strlen($name) );
       switch ($method){
           case "get":
               return (isset($this->values[$fieldname]))?$this->values[$fieldname]:NULL;
           break;
           case "set":
               $this->values[$fieldname] = $arguments[0];
           break;
    }}
 public function setData($data=array()){
     foreach ($data as $key =>$value){
        $this->{"set".$key}($value);
     }
}
public function getValues(){
    return $this->values;
}

        }
