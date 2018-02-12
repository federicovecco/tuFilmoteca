<?php

class Clasificaciones_model extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
    }
    
    //Devuelve todas los datos de la tabla clasificaciones, ordenados alfabeticamente
    function getClasificaciones() {
        
        $query = "SELECT * FROM clasificaciones ORDER BY nombre";
        
        return mysql_query($query);
    }
}