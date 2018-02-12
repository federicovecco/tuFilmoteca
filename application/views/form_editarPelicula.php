<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//SP" http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title><?php echo "Editar '" . $film[0]->titulo ."'" ?></title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--ensures proper rendering and touch zooming-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--BOOTSTRAP 3-->
    <link rel="stylesheet" href="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/css/bootstrap.min.css" >
    
    <!--Pie de pagina-->
    <link rel="stylesheet" href="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/css/sticky-footer.css">
        
    <!--Estilos propios-->
    <style type="text/css">
    #header {
        margin-top: 80px;
    }
    </style>
</head>

<body>
    <div id="wrap" class="container">
        <?php header('Content-type: text/html; charset=UTF-8');
        
        echo '<h1 id="header" class="page-header">'.$titulo_formulario.'</h1>';
        
        echo validation_errors();
        ?>
        <div id="form_Edicion">
        
        <?php
            //Creación del formulario
            $hidden = array('codigo' => $film[0]->codigo);
            $url_form = site_url('editar_pelicula/index');
            $attr = array('class'=>'form-horizontal', 'role'=>'form');
            echo form_open($url_form,$attr,$hidden);
            
            //***Campo Titulo***
            
            echo "<div class='form-group'>";
                $attr_lbl = array('class'=>'col-sm-1 control-label', 'for' => 'titulo');
                echo form_label('Titulo','titulo', $attr_lbl);
                //echo "<p>" . form_error('titulo') . "</p>";
                echo "<div class='col-sm-5'>";
                    $valor = $film[0]->titulo;
                    $attr_titulo = array('name'=>'titulo','id'=>'titulo','class'=>'form-control','value'=>$valor);
                    echo form_input($attr_titulo);
                    echo "<br>";
                echo "</div>";
            echo "</div>";
            
            //***Campo Pais***
            
            echo "<div class='form-group'>";
                $attr_lbl = array('class'=>'col-sm-1 control-label', 'for'=>'pais');
                echo form_label('Pa&iacutes', 'pais', $attr_lbl);
                echo "<div class='col-sm-5'>";
                    echo "<select name='pais' id='pais' class='form-control'>";
                        //Ciclo que carga las opciones del select (dropBox)
                        while($row=mysql_fetch_array($paises)){
                            //Muestra preseleccionada el país que está registrado en la BD
                            if($row['nombPais'] == $film[0]->nombPais){
                                echo "<option value='" . $row['codPais'] . "' selected>" . $row['nombPais'] . "</option>";
                            }else{
                                echo "<option value='" . $row['codPais'] . "'>" . $row['nombPais'] . "</option>";
                            }
                        }
                    echo "</select>";
                    echo "<br>";
                echo "</div>";
            echo '</div>';
            
            //***Campo Genero***
            
            echo "<div class='form-group'>";
                $attr_lbl = array('class'=>'col-sm-1 control-label', 'for'=>'genero');
                echo form_label('G&eacutenero', 'genero', $attr_lbl);
                //echo "<p>" . form_error('genero') . "</p>";
                echo "<div class='col-sm-5'>";
                    echo "<select name='genero' id='genero' class='form-control'>";
                        //Ciclo que carga las opciones del select (dropBox)
                        while($row = mysql_fetch_array($generos)){
                            //Muestra preseleccionado el país que está registrado en la BD
                            if($row['descripcion'] == $film[0]->descGenero){
                                echo "<option value='" . $row['codigo'] . "' selected>" . $row['descripcion'] . "</option>";
                            }else{
                                echo "<option value='" . $row['codigo'] . "'>" . $row['descripcion'] . "</option>";
                            }
                        }
                    echo "</select>";
                    echo "<br>";
                echo "</div>";
            echo "</div>";
            
            //***Campo Director***
            
            echo "<div class='form-group'>";
                $attr_lbl = array('class'=>'col-sm-1 control-label', 'for'=>'director');
                echo form_label('Director', 'director', $attr_lbl);
                echo "<div class='col-sm-5'>";
                    echo "<select name='director' id='director' class='form-control'>";
                        //Ciclo que carga las opciones del select (dropBox)
                        while($row = mysql_fetch_array($directores)){
                            //Muestra preseleccionado el director que está registrado en la BD
                            if(($row['nombre'] == $film[0]->nombDirector) && ($row['apellido'] == $film[0]->apeDirector)){
                                echo "<option value='" . $row['codigo'] . "' selected>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }else{
                                echo "<option value='" . $row['codigo'] . "'>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }
                        }
                    echo "</select>";
                    echo "<br>";
                echo "</div>";
            echo "</div>";
            
            //***Campo Actor Protagonista***
            
            echo "<div class='form-group'>";
                $attr_lbl = array('class'=>'col-sm-1 control-label','for'=>'actor1');
                echo form_label('Actor Protagonista', 'actor1', $attr_lbl);
                //echo "<p>" . form_error('actor1') . "</p>";
                echo "<div class='col-sm-5'>";
                    echo "<select name='actor1' id='actor1' class='form-control'>";
                        //Ciclo que carga las opciones del select (dropBox)
                        while($row = mysql_fetch_array($actores)){
                            //Muestra preseleccionado el actor que está registrado en la BD
                            if(($row['nombre'] == $film[0]->nombActor) && ($row['apellido'] == $film[0]->apeActor)){
                                echo "<option value='" . $row['codigo'] . "' selected>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }else{
                                echo "<option value='" . $row['codigo'] . "'>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }
                        }
                    echo "</select>";
                    echo "<br>";
                echo "</div>";
            echo "</div>";
            
            //***Botones***
            
            echo "<div class='form-group'>";
                echo "<div class='col-sm-1 pull-right'>";
                    $attr_btn_guardar = array(
                                              'name'=>'guardar',
                                              'id'=>'guardar',
                                              'value'=>'Guardar',
                                              'class'=>'btn btn-primary btn-lg');
                    echo form_submit($attr_btn_guardar);
                echo "</div>";
                
                echo "<div class='col-sm-2 pull-right'>";
                    $btn_data = array(
                                      'name' => 'btnSalir',
                                      'id' => 'btnSalir',
                                      'content' => 'Salir sin guardar',
                                      'class' => 'btn btn-secondary btn-lg',
                                      'onclick' => "document.location.href = '".site_url('')."'");
                    echo form_button($btn_data);
                echo "</div>";
            echo "</div>";
            
            echo form_close();
        ?>        
        </div><!--Fin div "form_edicion"-->
    </div> <!--Fin #wrap-->
    
    <!--JS CODE-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/js/bootstrap.min.js"></script>
    
    
</body>
</html>