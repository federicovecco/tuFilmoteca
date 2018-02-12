<?php

class CategoriaPremios_model extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
    }
    
    //Devuelve todas los datos de la tabla categoriaPremios, ordenados alfabeticamente
    function getCategoriaPremios() {
        
        $query = "SELECT * FROM categoriasPremios ORDER BY nombre";
    
        return mysql_query($query);
    }
}