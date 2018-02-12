<?php

class Generos_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    //Devuelve todos los generos que se encuentran en la tabla, ordenados
    //alfabeticamente
    function getGeneros() {
        $query = "SELECT * FROM generos ORDER BY descripcion";
        
        return mysql_query($query);
    }
}