<?php
class Nueva_pelicula extends CI_Controller {
    
    function __construct(){
        
        parent::__construct();
        
        //Carga los helpers
        $this->load->helper(array('form','url'));
        
        //Carga las clases
        $this->load->library('form_validation');
        
        //Carga la base de datos
        
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
        
        //Cambia los caracteres especiales
        function transform_string($string="ALGO"){
            
            $newString = str_replace(
                    array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä', 'é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë', 'í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î', 
                        'ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô', 'ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü', 'ñ', 'Ñ', 'ç', 'Ç',
                         '.', '\\', '¨', 'º', '~', '#', '@', '|', '!', '\'', '·', '$', '%', '&', '/', '(', ')', '?', '\'', '¡', '¿', '[', '^', '`', ']',
                          '+', '}', '{', '¨', '´', '>', '< ', ';', ',', ':'),
                    array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'e', 'e', 'e', 'e', 'E', 'E', 'E', 'E', 'i', 'i', 'i', 'i', 'I', 'I', 'I', 'I', 
                          'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U', 'n', 'N', 'c', 'C', ''),
                    $string);
            
            return $newString;
        }//End transform_string()
    }
    
    function index(){
        
        //Estabece las reglas de control para cada campo y las almacena en un
        //array
        $config = array(
                        array(
                            'field' => 'titulo',
                            'label' => 'Título de la película',
                            'rules' => 'required|max_length[50]'
                        ),
                        array(
                            'field' => 'duracion',
                            'label' => 'Duración de la película (en minutos)',
                            'rules' => 'max_length[6]|numeric'
                        ),
                        array(
                            'field' => 'pais',
                            'label' => 'País de origen',
                            'rules' => ''
                        ),
                        array(
                            'field' => 'anio',
                            'label' => 'Año de publicación',
                            'rules' => 'numeric|max_length[4]'
                        ),
                        array(
                            'field' => 'genero',
                            'label' => 'Género',
                            'rules' => 'required'
                        ),
                        array(
                            'field' => 'idioma',
                            'label' => 'Idioma',
                            'rules' => 'required|max_length[15]'
                        ),
                        array(
                            'field' => 'subs1',
                            'label' => 'Subtítulos',
                            'rules' => 'max_length[15]'
                        ),
                        array(
                            'field' => 'subs2',
                            'label' => 'Subtítulos',
                            'rules' => 'max_lenght[15]'
                        ),
                        array(
                            'field' => 'director',
                            'label' => 'Director',
                            'rules' => ''
                        ),
                        array(
                            'field' => 'actor1',
                            'label' => 'Actor Protagonista',
                            'rules' => ''
                        ),
                        array(
                            'field' => 'actor2',
                            'label' => 'Actor Secundario 1',
                            'rules' => ''
                        ),
                        array(
                            'field' => 'actor3',
                            'label' => 'Actor Secundario 2',
                            'rules' => ''
                        ),
                        array(
                            'field' => 'actor4',
                            'label' => 'Actor Secundario 3',
                            'rules' => ''
                        ),
                        array(
                            'field' => 'actor5',
                            'label' => 'Actor Secundario 4',
                            'rules' => ''
                        ),
                        array(
                            'field' => 'clasificacion',
                            'label' => 'Clasificacion',
                            'rules' => 'max_length[100]'
                        ),
                        array(
                            'field' => 'ubicacion',
                            'label' => 'Ubicación del archivo',
                            'rules' => 'max_length[50]'
                        ),
                        array(
                            'field' => 'sinopsis',
                            'label' => 'Sinopsis de la película',
                            'rules' => 'required'
                        )
                    );
        
        //Establece las reglas de control de campos de acuerdo a lo que establece
        //la variable $config
        $this->form_validation->set_rules($config);
        
        //Establece el mensaje para los campos requeridos que no se han completado
        $this->form_validation->set_message('required','<span class="text-danger bg-danger">Este campo debe ser completado obligatoriamente</span>');
        $this->form_validation->set_message('numeric','<span class="text-danger bg-danger">Este campo solo permite valores num&eacutericos</span>');
         
        //Carga los modelos de los campos que se deben mostrar en forma de dropdown
        //en las vistas
        $modelos = array('Paises_model', 'Generos_model', 'Directores_model', 'Actores_model', 'Clasificaciones_model', 'Premios_model', 'CategoriaPremios_model');
        
        $this->load->model($modelos);
        
        
        //Traigo los datos de las respectivas tablas, formo un array de datos
        //para luego enviar los datos a las vistas
        $paises = $this->Paises_model->getPaises();
        $generos = $this->Generos_model->getGeneros();
        $directores = $this->Directores_model->getDirectores();
        $actores = $this->Actores_model->getActores();
        $clasif = $this->Clasificaciones_model->getClasificaciones();
        $premios = $this->Premios_model->getPremios();
        $catPremios = $this->CategoriaPremios_model->getCategoriaPremios();
        
        $datos_vistas = array(
                            'paises'=> $paises,
                            'generos' => $generos,
                            'directores' => $directores,
                            'actores' => $actores,
                            'clasificaciones' => $clasif,
                            'premios' => $premios,
                            'catPremios' => $catPremios,
                            'errorPortada' => ''
                        );
        
        //Carga el menú en la vista
        $this->load->view('menu.html');
        
        //Verifica si se cumplen las reglas de validacion de los campos.
        //CASO FALSE: muestra nuevamente el formulario
        //CASO TRUE : almacena los datos en la base de datos,
        //            muestra la pagina de exito. 
        if($this->form_validation->run() == FALSE){
            echo $this->form_validation->run();
            $this->load->view('formulario_nueva_pelicula', $datos_vistas);
        }
        else{
            //Se llama a la función que intentará guardar la img de portada, y devolverá si lo hizo exitosamente o no
            if(isset($_FILES['portada']['tmp_name'])){
                $state_upload_portada = $this->uploadPortada();
            }
            
            if($state_upload_portada['error'] == 'FALSE'){
                $this->almacenarDatos();
                $this->load->view('nueva_pelicula_success');
            }else{
                $datos_vistas['errorPortada'] = $state_upload_portada['error'];
                $this->load->view('formulario_nueva_pelicula', $datos_vistas);
            }
        }
        
        //Carga el pie de pagina en la vista
        $this->load->view('foot.html');
    } //Fin funcion index()
    
    //Almacena los datos, recibidos por metodo POST desde el formulario, en
    //un array y luego llama al model peliculas, pasandole los datos como parametros
    function almacenarDatos() {
        
        //recoge los datos obtenidos por POST
        $data['titulo'] = $_POST['titulo'];
        $data['duracion'] = $_POST['duracion'];
        $data['codPais'] = $_POST['pais'];
        $data['anio'] = $_POST['anio'];
        $data['codGenero'] = $_POST['genero'];
        $data['idioma'] = $_POST['idioma'];
        $data['subtitulos1'] = $_POST['subs1'];
        $data['subtitulos2'] = $_POST['subs2'];
        $data['codDirector'] = $_POST['director'];
        $data['codActor1'] = $_POST['actor1'];
        $data['codActor2'] = $_POST['actor2'];
        $data['codActor3'] = $_POST['actor3'];
        $data['codActor4'] = $_POST['actor4'];
        $data['codActor5'] = $_POST['actor5'];
        $data['codClasificacion'] = $_POST['clasificacion'];
        $data['ubicacion'] = $_POST['ubicacion'];
        $data['sinopsis'] = $_POST['sinopsis'];
        
        if(($_FILES['portada']['error']) == 4){ //Error Value: 4; No file was uploaded.
            $imgName = 'no-cover.png';
        }else{
            $imgName = filter_input(INPUT_POST, 'titulo');
            $imgName = transform_string(utf8_decode($imgName));
            $imgName = strtolower(str_replace(' ', '-',$imgName));
            
            $file_path = $_FILES['portada']['name'];
            $extention = pathinfo($file_path, PATHINFO_EXTENSION);
            $imgName .= ".".$extention;
        }
            
        $data['portada'] = 'img/'.$imgName;
        
    
        //Llama a la funcion insertPelicula del model para almacenar los datos
        //en la tabla dentro de la base de datos
        $this->load->model('peliculas_model');
        $this->peliculas_model->insertPelicula($data);
        
        //Consulto el codigo de la pelicula, que es generado automaticamente por la BD
        $codPelicula = $this->peliculas_model->getCodigo('titulo', $data['titulo']);
        //Almaceno el codigo en el array de datos
        $prizes['codPelicula'] = $codPelicula;
        $prizes['codPremio'] = $_POST['premios'];
        $prizes['codCategoria'] = $_POST['categoria'];
        $prizes['anio'] = $_POST['anio'];
        //Inserto los premios de la pelicula
        $this->peliculas_model->insertPremios($prizes);
        
    } //Fin funcion almacenarDatos()

    public function uploadPortada() {
        $upload['error'] = 'FALSE';
         
        $config['upload_path'] = 'C:\wamp\www\tuFilmoteca_v1\img';
        $imgName = filter_input(INPUT_POST, 'titulo');
        $imgName = transform_string(trim(utf8_decode($imgName)));
        $imgName = strtolower(str_replace(' ', '-',$imgName));
        
        $file_path = $_FILES['portada']['name'];
        $extention = pathinfo($file_path, PATHINFO_EXTENSION);
        $imgName .= ".".$extention;
        
        $config['file_name'] = $imgName;
        $config['allowed_types'] = 'jpg|gif|png';
        $config['max_size'] = 1000; //KiloBytes
        
        $this->load->library('upload', $config);
        
        //Se sube el archivo y al mismo tiempo se verifica que se subió con exito
        $inputName = "portada";
        if(!$this->upload->do_upload($inputName)){
            if($_FILES['portada']['error'] != 4){ //Error Value: 4; No file was uploaded.
                $upload['error'] = $this->upload->display_errors('<p class="error_msg">','</p>');
            }
        }else{
            $upload['data'] = $this->upload->data();
        }
        
        return $upload;
    } //End uploadPortada()
    
} //End Class