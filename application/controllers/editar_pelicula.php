<?php

class Editar_pelicula extends CI_Controller{
    //Clase controlador que gestiona los modelos, vistas y funciones para realizar
    //la edición de peliculas
    
    function __construct(){
        
        parent::__construct();
        
        //Carga los modelos que se utilizarán en la clase
        $this->load->model(array('peliculas_model', 'Paises_model', 'Generos_model', 'Directores_model', 'Actores_model'));
        
        //Carga los helpers que se utilizarán en la clase
        $this->load->helper(array('form','url'));
        
    }//Fin function __construct()
    
    function index($codPeli = "null") {
        //@Param: $codPeli, codigo de la pelicula a editar
        
        //Carga las librería que se utilizarán en la clase
        $this->load->library('form_validation');
        
        //Si no se recibieron parametros, obtener el valor de la variable $_POST
        if($codPeli == "null"){
            $codPeli = $_POST['codigo'];
        }
        
        //Establecer las reglas de control
        $this->form_validation->set_rules('titulo', 'Titulo', 'required');
        
        //Establece el mensaje para aquellos campos que son requeridos y se encuentran vacíos
        $this->form_validation->set_message('required', 'El \'%s\' es un campo obligatorio');
        
        //Carga el menú en la vista
        $this->load->view('menu.html');
        
        if($this->form_validation->run()== FALSE) {
            //Busca los datos de la pelicula a editar
            $buscarPelicula['codigo'] = $codPeli;
            $pelicula['film'] = $this->peliculas_model->getPeliculas($buscarPelicula);
            $pelicula['paises'] = $this->Paises_model->getPaises();
            $pelicula['generos'] = $this->Generos_model->getGeneros();
            $pelicula['directores'] = $this->Directores_model->getDirectores();
            $pelicula['actores'] = $this->Actores_model->getActores();
            $pelicula['titulo_formulario'] = 'Editar Pel&iacutecula';
            
            //Carga la vista, con un formulario que permite editar los datos de la pelicula
            $this->load->view('form_editarPelicula', $pelicula);
        }else{
            $this->guardarModificaciones();
            $this->load->view('vw_pelicula_editada_con_exito');
        }//Fin if
        
        $this->load->view('foot.html');
    }//Fin function index()    
    
    //Recibe los datos desde el formulario a traves de la variable Post y los envia al
    //modulo de peliculas donde son tratados
    function guardarModificaciones(){
        
        //Recoge los datos enviados desde el formulario por medio del metodo post
        $data['codigo'] = $_POST['codigo'];
        $data['titulo'] = $_POST['titulo'];
        $data['pais'] = $_POST['pais'];
        $data['genero'] = $_POST['genero'];
        $data['director'] = $_POST['director'];
        $data['actor1'] = $_POST['actor1'];
        
        $this->peliculas_model->updatePelicula($data);
    } //Fin function guardarModificiones
    
} //Fin Clase Editar_pelicula