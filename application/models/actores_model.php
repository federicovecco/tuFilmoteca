<?php

class Actores_model extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
    }
    
    //Devuelve todos los datos que se encuentran en la tabla actores, ordenados
    //alfabeticamente por apellido
    function getActores() {
        
        $query = "SELECT * FROM actores ORDER BY apellido";
        
        return mysql_query($query);
    }
}