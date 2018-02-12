<?php
class Peliculas_model extends CI_Model{
    
    function __construct(){
        parent::__construct();

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
        
    }
    
    //Devuelve las últimas x películas de la base de datos
    //Return the last x films from the data base
    function getLastFilms($cantidad){
        $this->db->select('codigo,titulo,sinopsis');
        $query = $this->db->get('peliculas', $cantidad);
        
        return ($query->result());
    }
    
    //Almacena los datos que recibe como parametro dentro de la tabla
    function insertPelicula($pelicula) {
        
        $this->db->insert('peliculas', $pelicula);
    }
    
    //Almacena los premios de la pelicula en la tabla 'premiospeliculas'
    function insertPremios($premios) {
        
        $this->db->insert('premiosPeliculas', $premios);
    }
    
    //Busca dentro de la tabla la pelicula segun campo pasado como parametro
    //En caso de encontrar la pelicula, devuelve el codigo
    //En caso de no encontrarla, devuelve false
    function getCodigo($campo, $valor) {
        
        $this->db->select('*');
        $this->db->from('peliculas');
        $this->db->where($campo . " = '" . $valor . "'");
        $peli = $this->db->get();
        $query = $peli->result_array();
        $cantidad = $this->db->count_all_results();
        
        
        
        if($cantidad != 0) {
            return $query[0]['codigo'];
        }else{
            return false;
        }
    } //Fin getCodigo()
    
    //Devuelve el numero total de registros que se encuentran en la tabla peliculas
    //Return the total of rows in the table 'Peliculas'
    function get_total_registros() {

        $totalPeliculas = $this->db->get('peliculas');
        return $totalPeliculas->num_rows();
        
    } //Fin get_total_registros()
    
    //Devuelve los datos de la tabla 'peliculas' ya paginados
    //Return data from table 'peliculas' with pagination
    function get_films_paginados($cantidadPorPagina, $segmento){
        
        if($segmento == 0){
            $segmento--;
        }
        
        $this->db->from('peliculas');
        
        $this->db->select('peliculas.codigo,
                          peliculas.titulo,
                          peliculas.sinopsis,
                          peliculas.codDirector,
                          peliculas.codActor1,
                          peliculas.codPais,
                          peliculas.codGenero,
                          peliculas.portada,
                          directores.nombre as nombDirector,
                          directores.apellido as apeDirector,
                          actores.nombre as nombActor,
                          actores.apellido as apeActor,
                          paises.nombPais as nombPais,
                          generos.descripcion as descGenero');
                          
                          
                          
        
        $this->db->join('directores','directores.codigo = peliculas.codDirector');
        $this->db->join('actores', 'actores.codigo = peliculas.codActor1');
        $this->db->join('paises', 'paises.codPais = peliculas.codPais');
        $this->db->join('generos','generos.codigo = peliculas.codGenero');
        $this->db->limit($cantidadPorPagina, $segmento);
        $query = $this->db->get();
        
          
        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $datos[] = $row; 
            }
        }//Fin if
        
        return $datos;
        
    }//Fin get_films_paginados()
    
    //Devuelve un objeto con las peliculas encontradas en la BD que coinciden con los parametros recibidos
    //Return an array with the films found in the DB that matches with the parameters
    function getPeliculas($criterios) {
        
        //Establece la clausula 'WHERE' de forma condicional
        if(isset($criterios['titulo']) && $criterios['titulo']!=''){
            $this->db->like('peliculas.titulo',$criterios['titulo']);
        }
        if(isset($criterios['pais']) && $criterios['pais']!=0){
            $this->db->where('peliculas.codPais',$criterios['pais']);
        }
        if(isset($criterios['titulo']) && $criterios['genero']!=0){
            $this->db->where('peliculas.codGenero',$criterios['genero']);
        }
        if(isset($criterios['titulo']) && $criterios['director']!=0){
            $this->db->where('peliculas.codDirector',$criterios['director']);
        }
        if(isset($criterios['titulo']) && $criterios['actor']!=0){
            $this->db->where('peliculas.codActor1',$criterios['actor']);
            $this->db->or_where('peliculas.codActor2',$criterios['actor']);
            $this->db->or_where('peliculas.codActor3',$criterios['actor']);
            $this->db->or_where('peliculas.codActor4',$criterios['actor']);
            $this->db->or_where('peliculas.codActor5',$criterios['actor']);
        }
        if(isset($criterios['codigo']) && $criterios['codigo']!=''){
            $this->db->where('peliculas.codigo', $criterios['codigo']);
        }
            
        $this->db->select('peliculas.codigo, titulo, paises.nombPais, generos.descripcion as descGenero, directores.nombre as nombDirector,
                          directores.apellido as apeDirector, actores.nombre as nombActor, actores.apellido as apeActor');
        $this->db->from('peliculas');
        $this->db->join('paises', 'paises.codPais = peliculas.codPais');
        $this->db->join('generos', 'generos.codigo = peliculas.codGenero');
        $this->db->join('directores', 'directores.codigo = peliculas.codDirector');
        $this->db->join('actores', 'actores.codigo = peliculas.codActor1');
        $this->db->order_by('titulo', 'desc');
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    //Funcion que acutaliza los datos de la pelicula con los datos recibidos en el parametro
    function updatePelicula($pelicula) {
        
        $data['titulo'] = $pelicula['titulo'];
        $data['codGenero'] = $pelicula['genero'];
        $data['codPais'] = $pelicula['pais'];
        $data['codDirector'] = $pelicula['director'];
        $data['codActor1'] = $pelicula['actor1'];
        
        $this->db->where('codigo',$pelicula['codigo']);
        $this->db->update('peliculas',$data);
    } //Fin update pelicula
    
    //Funcion que elimina de la BD la pelicula recibida como parametro
    function deletePelicula($codigoPeli) {
        
        $this->db->delete('peliculas', array('codigo' => $codigoPeli));
    }//Ends updatePelicula()
    
    //Gets the image of a film from the appropiate folder
    //@Param: $title, it is the title of the film of which we want the image Cover
    function get_imgFilmCover($title){
        
        //rewrite the text in lowercase
        $title = strtolower($title);
        
        //Replace whitespaces for dashes
        $title = str_replace(" ","-",$title);
        
        //Path where images should be
        $imgPath = base_url('/img/'.$title.'.jpg');
            
        //if the file exists, return the path.
        //If is not, return a string
        if(file_exists($imgPath)) {
            $imgFilm = "<img src='".$imgPath."' alt='portada' />";
        }else{
            $imgFilm = "No image";
        }
        
        return $imgFilm;
        
    }//Ends get_imgFilmCover()
    
    function get_all(){
        $this->db->select('*');
        $this->db->from('peliculas');
        $query = $this->db->get();
        
        return $query->result();
    }//Ends get_all()
}