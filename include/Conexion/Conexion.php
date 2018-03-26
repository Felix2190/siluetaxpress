<?php

/*
 * clase de conexión
*/
require 'configuracionBD.php';

class ConexionBD{
    
    protected $dbLink;
    
    public function ConexionBD(){
        $this->dbLink= new mysqli(BD_HOST,BD_USER,BD_PASS,BD_DB);
        if ($this->dbLink->connect_errno){
            echo 'existe un error';
            return ;
        }
        
        $this->dbLink->set_charset(BD_CHARSET);
        echo 'conexión exitosa';
        
    }
}
?>