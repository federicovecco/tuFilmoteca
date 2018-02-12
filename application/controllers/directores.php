<?php

/*
 * Clase para el manejo de Directores (crear, modificacar, listar o eliminar)
 * 
 * Creada por Federico I. Vecco
 * 
 * Date: 21/02/2014
 */
class Directores extends CI_Controller{
    
    function __construct(){
        
        parent::__Construct();
        
        //Carga las librerías de CodeIgniter que se usarán
        //Load the Codeigniter's libraries
        $this->load->library(array('table', 'pagination'));
        
        //Carga el Helper de URL
        //Load the URL Helper
        $this->load->helper(array('url', 'date'));
        
        //Carga el Modelo de los directores
        //Load the Model of directors
        $this->load->model('Directores_model');
        
        
        $config['hostname'] = "localhost";
        $config['username'] = "vt000156_creator";
        $config['password'] = "Keyboard25";
        $config['database'] = "vt000156_filmtec";
        $config['dbdriver'] = "mysql";
        $config['dbprefix'] = "";
        $config['pconnect'] = FALSE;
        $config['db_debug'] = TRUE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = "";
        $config['char_set'] = "utf8";
        $config['dbcollat'] = "utf8_general_ci";
        $this->load->database($config);
    
    }//End __construct()

    function index(){
        
        $viewData['directors'] = $this->Directores_model->getDirectores();
        
        $this->load->view('menu.html');
        $this->load->view('listado_directores', $viewData);
        $this->load->view('foot.html');
        
    } //End index()
   
}//Ends Class