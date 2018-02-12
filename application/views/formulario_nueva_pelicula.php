<!DOCTYPE html>
<html lang="sp">
<head>
    <title>Nueva Pel&iacutecula</title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--ensures proper rendering and touch zooming-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!--BOOTSTRAP 3-->
    <link rel="stylesheet" href="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/css/bootstrap.min.css" >
        
    <!--Pie de pagina-->
    <link rel="stylesheet" href="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/css/sticky-footer.css" >
    
    <!--Estilos propios-->
    <style type="text/css">
        #header {
            margin-top: 80px;
        }
        .bg-danger {
            background-color: #F8E0E6;
        }
    </style>
</head>

<body>
    
    <div id="wrap" class="container">
        
        <div id="header" class="page-header">
            <h2>Nueva pel&iacute;cula</h2>
        </div>
    
    <?php
        validation_errors();
        header('Content-Type: text/html; charset=UTF-8');
    ?>
    
<form method="post" class="" role="form" action=" <?php echo site_url('nueva_pelicula'); ?> " enctype="multipart/form-data" >
    
    <div class="row">
        <!--Codigo-->
        <div class="form-group">
            <label for="codigo" class="col-sm-1 control-label">C&oacutedigo</label>
            <div class="col-sm-3">
                <!--<p class="form-control-static"><i>Codigo</i></p>-->
                <input type="text" id="codigo" name="codigo" class="form-control" value="" size="4" placeholder="codigo" readonly="readonly" disabled/>
            </div>
        </div>
    
        <!--Titulo-->
        <div class="form-group">
            <label for="titulo" class="col-sm-1 control-label">T&iacutetulo (original)</label> 
            <?php echo "<p>" . form_error('titulo') . "</p>"; ?>
            <div class="col-sm-7">
                <input type="text" id="titulo" name="titulo" class="form-control" value="<?php echo set_value('titulo'); ?>" size="25" placeholder="Titulo"/>
            </div>
        </div>
    </div> <!--Fin Row-->
        
    <div class="row">
        <!--Duracion-->
        <div class="form-group">
            <label for="duracion" class="col-sm-1 control-label">Duraci&oacuten</label>
            <?php echo "<p class='error_msg'>" . form_error('duracion') . "</p>"; ?>
            <div class="col-sm-3">
                <input type="text" id="duracion" name="duracion" class="form-control" value="<?php echo set_value('duracion'); ?>" size="6" placeholder="Duracion"/>
            </div>
        </div>
        
        <!--Pais origen-->
        <div class="form-group">
            <label for="pais" class="col-sm-1 control-label">Pa&iacutes de Origen</label> 
            <?php echo "<p class='error_msg'>" . form_error('pais') . "</p>"; ?>
            <div class="col-sm-3">
                <select name="pais" id="pais" class="form-control">
                    <option value="0" selected>Elija un pa&iacutes...</option>
                    <?php
                        //Ciclo que carga las opciones del select (dropBox)
                        while($row=mysql_fetch_array($paises)){
                            //Si el formulario vuelve por un error, traer la opcion seleccionada con anterioridad por el usuario
                            if($row['codPais'] == set_value('pais')){
                                echo "<option value='" . $row['codPais'] . "' selected>" . $row['nombPais'] . "</option>";
                            }else{
                                echo "<option value='" . $row['codPais'] . "'>" . $row['nombPais'] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
        
        <!--Año-->
        <div class="form-group">
            <label for="anio" class="col-sm-1 control-label">A&ntildeo</label> 
            <?php echo "<p class='error_msg'>" . form_error('anio') . "</p>"; ?>
            <div class="col-sm-3">
                <input type="text" name="anio" id="anio" class="form-control" value="" size="4" placeholder="A&ntilde;o"/>
            </div>
        </div>
    </div> <!--Fin Row-->
    
    
    
    <div class="row">
        <!--Genero-->
        <label for="genero" class="col-sm-1 label-control">G&eacutenero</label>
        <?php echo "<p class='error_msg'>" . form_error('genero') . "</p>"; ?>
        <div class="col-sm-3">
            <select name="genero" id="genero" class="form-control">
                <option value="9" selected>Elija un g&eacutenero...</option>
                <?php
                    //Ciclo que carga las opciones del select (dropBox)
                    while($row=mysql_fetch_array($generos)){
                        //Si el formulario vuelve por un error, traer la opcion seleccionada con anterioridad por el usuario
                        if($row['codigo'] == set_value('genero')){
                            echo "<option value='" . $row['codigo'] . "' selected>" . $row['descripcion'] . "</option>";
                        }else{
                            echo "<option value='" . $row['codigo'] . "'>" . $row['descripcion'] . "</option>";
                        }
                    }
                ?>
            </select>
        </div>
        
        <!--Clasificacion-->
        <div class="form-group">
            <label for="clasificacion" class="col-sm-1 control-label">Clasificaci&oacuten</label> 
            <?php echo "<p class='error_msg'>" . form_error('clasificacion') . "</p>"; ?>
            <div class="col-sm-3">
                <select name="clasificacion" id="clasificacion" class="form-control">
                    <option value="0" selected>Elija la clasificaci&oacuten...</option>
                    <?php
                        //Ciclo que carga las opciones del select (dropBox)
                        while($row=mysql_fetch_array($clasificaciones)){
                            //Si el formulario vuelve por un error, traer la opcion seleccionada con anterioridad por el usuario
                            if($row['codigo'] == set_value('clasificacion')){
                                echo "<option value='" . $row['codigo'] . "' selected>" . $row['nombre'] . " ( " . $row['codigo'] . ")</option>";
                            }else{
                                echo "<option value='" . $row['codigo'] . "'>" . $row['nombre'] . " ( " . $row['codigo'] . ")</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
        
        <!--Idioma-->
        <div class="form-group">
            <label for="idioma" class="col-sm-1 control-label">Idioma</label>
            <?php echo "<p class='error_msg'>" . form_error('idioma') . "</p>"; ?>
            <div class="col-sm-3">
                <input type="text" name="idioma" id="idioma" class="form-control" value="<?php echo set_value('idioma'); ?>" size="10" placeholder="Idioma" />
            </div>
        </div>
        
    </div> <!--Fin Row-->
    
    <div class="row">
        <!--Director-->
        <div class="form-group">
            <label for="director" class="col-sm-1 control-label">Director</label>
            <?php echo "<p class='error_msg'>" . form_error('director') . "</p>"; ?>
            <div class="col-sm-3">
                <select name="director" id="director" class="form-control">
                    <option value="0" selected>Elija un director...</option>
                    <?php
                        //Ciclo que carga las opciones del select (dropBox)
                        while($row=mysql_fetch_array($directores)){
                            //Si el formulario vuelve por un error, traer la opcion seleccionada con anterioridad por el usuario
                            if($row['codigo'] == set_value('director')){
                                echo "<option value='" . $row['codigo'] . "' selected>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }else{
                                echo "<option value='" . $row['codigo'] . "'>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
        
        <!--Subtitulo 1-->
        <div class="form-group">
            <label for="sub1" class="col-sm-1 control-label">Subt&iacutetulo</label>
            <?php echo "<p class='error_msg'>" . form_error('subs1') . "</p>"; ?>
            <div class="col-sm-3">
                <input type="text" name="subs1" id="sub1" class="form-control" value="<?php echo set_value('subs1'); ?>" size="10" placeholder="Subt&iacute;tulo"/>
            </div>
        </div>
        
        <!--Subtitulo 2-->
        <div class="form-group">
            <label for="sub2" class="col-sm-1 control-label">Subt&iacutetulo</label>
            <?php echo "<p class='error_msg'>" . form_error('subs2') . "</p>"; ?>
            <div class="col-sm-3">
                <input type="text" name="subs2" id="sub2" class="form-control" value="<?php echo set_value('subs2'); ?>" size="10" placeholder="Subt&iacute;tulo"/>
            </div>
        </div>
    </div> <!--Fin Row-->

    <div class="row">
        
        
        <?php
      //Toma todos los datos de la consulta y los guarda en una matriz
        $actors = array();
        while($actors = mysql_fetch_array($actores)){
            $rows[] = $actors;
        }
        ?>
        
        <!--Actor Principal-->
        <div class="form-group">
            <label for="actor1" class="col-sm-1 control-label">Actor Principal</label>
            <?php echo "<p class='error_msg'>" . form_error('actor1') . "</p>"; ?>
            <div class="col-sm-3">
                <select name="actor1" id="actor1" class="form-control">
                    <option value="0" selected>Elija un Actor...</option>
                    <?php
                        //Ciclo que carga las opciones del select (dropBox)
                        foreach($rows as $row){
                            //Si el formulario vuelve por un error, traer la opcion seleccionada con anterioridad por el usuario
                            if($row['codigo'] == set_value('actor1')){
                                echo "<option value='" . $row['codigo'] . "' selected>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }else{
                                echo "<option value='" . $row['codigo'] . "'>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
        
        <!--Actor 2-->
        <div class="form-group">
            <label for="actor2" class="col-sm-1 control-label">Otro Actor</label>
            <?php echo "<p class='error_msg'>" . form_error('actor2') . "</p>"; ?>
            <div class="col-sm-3">
                <select name="actor2" id="actor2" class="form-control">
                    <option value="0" selected>Elija un Actor...</option>
                    <?php
                        //Ciclo que carga las opciones del select (dropBox)
                        foreach($rows as $row){
                            //Si el formulario vuelve por un error, traer la opcion seleccionada con anterioridad por el usuario
                            if($row['codigo'] == set_value('actor2')){
                                echo "<option value='" . $row['codigo'] . "' selected>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }else{
                                echo "<option value='" . $row['codigo'] . "'>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
        
        <!--Actor 3-->
        <div class="form-group">
            <label for="actor3" class="col-sm-1 control-label">Otro Actor</label>
            <?php echo "<p class='error_msg'>" . form_error('actor3') . "</p>"; ?>
            <div class="col-sm-3">
                <select name="actor3" id="actor3" class="form-control">
                    <option value="0" selected>Elija un Actor...</option>
                    <?php
                        //Ciclo que carga las opciones del select (dropBox)
                        foreach($rows as $row){
                            //Si el formulario vuelve por un error, traer la opcion seleccionada con anterioridad por el usuario
                            if($row['codigo'] == set_value('actor3')){
                                echo "<option value='" . $row['codigo'] . "' selected>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }else{
                                echo "<option value='" . $row['codigo'] . "'>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
    </div> <!--Fin Row-->
    
    <div class="row">
        <!--Actor 4-->
        <div class="form-group">
            <label for="actor4" class="col-sm-1 control-label">Otro Actor</label>
            <?php echo "<p class='error_msg'>" . form_error('actor4') . "</p>"; ?>
            <div class="col-sm-3">
                <select name="actor4" id="actor4" class="form-control">
                    <option value="0" selected>Elija un Actor...</option>
                    <?php
                        //Ciclo que carga las opciones del select (dropBox)
                        foreach($rows as $row){
                            //Si el formulario vuelve por un error, traer la opcion seleccionada con anterioridad por el usuario
                            if($row['codigo'] == set_value('actor4')){
                                echo "<option value='" . $row['codigo'] . "' selected>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }else{
                                echo "<option value='" . $row['codigo'] . "'>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
        
        <!--Actor 5-->
        <div class="form-group">
            <label for="actor5" class="col-sm-1 control-label">Otro Actor</label>
            <?php echo "<p class='error_msg'>" . form_error('actor5') . "</p>"; ?>
            <div class="col-sm-3">
                <select name="actor5" id="actor5" class="form-control">
                    <option value="0" selected>Elija un Actor...</option>
                    <?php
                        //Ciclo que carga las opciones del select (dropBox)
                        foreach($rows as $row){
                            //Si el formulario vuelve por un error, traer la opcion seleccionada con anterioridad por el usuario
                            if($row['codigo'] == set_value('actor5')){
                                echo "<option value='" . $row['codigo'] . "' selected>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }else{
                                echo "<option value='" . $row['codigo'] . "'>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
        
        <!-- Portada -->
        <div class="form-group">
            <label for="portada" class="col-sm-1 control-label">Imagen Portada</label>
            <?php echo $errorPortada;?>
            <div class="col-sm-3">
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                <input name="portada" type="file" id="portada" class="form-control" />
            </div>
        </div>
        
    </div> <!--Fin Row-->
    
    <div class="row">
        <!--Premios-->
        <div class="form-group">
            <label for="premios" class="col-sm-1 control-label">Premios</label>
            <?php echo "<p class='error_msg'>" . form_error('premios') . "</p>"; ?>
            <div class="col-sm-3">
                <select name="premios" id="premios" class="form-control">
                    <option value="0" selected>Elija un Premio...</option>
                    <?php
                        //Ciclo que carga las opciones del select (dropBox)
                        while($row=mysql_fetch_array($premios)){
                            //Si el formulario vuelve por un error, traer la opcion seleccionada con anterioridad por el usuario
                            if($row['codigo'] == set_value('premios')){
                                echo "<option value='" . $row['codigo'] . "' selected>" . $row['nombre'] . "IF!</option>";
                            }else{
                                echo "<option value='" . $row['codigo'] . "'>" . $row['nombre'] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
        
        <!--Categoria Premios-->
        <div class="form-group">
            <label for="categoria" class="col-sm-1 control-label">Categor&iacutea</label>
            <?php echo "<p class='error_msg'>" . form_error('categoria') . "</p>"; ?>
            <div class="col-sm-3">
                <select name="categoria" id="categoria" class="form-control">
                    <option value="0" selected>Elija una categor&iacutea...</option>
                    <?php
                        //Ciclo que carga las opciones del select (dropBox)
                        while($row=mysql_fetch_array($catPremios)){
                            //Si el formulario vuelve por un error, traer la opcion seleccionada con anterioridad por el usuario
                            if($row['codigo'] == set_value('categoria')){
                                echo "<option value='" . $row['codigo'] . "' selected>" . $row['nombre'] . "IF!</option>";
                            }else{
                                echo "<option value='" . $row['codigo'] . "'>" . $row['nombre'] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
    </div> <!--Fin Row-->
    
    <div class="row">
        <!--Ubicacion-->
        <div class="form-group">
            <label for="ubicacion" class="col-sm-1 control-label">Ubicaci&oacuten</label>
            <?php echo "<p class='error_msg'>" . form_error('ubicacion') . "</p>"; ?>
            <div class="col-sm-3">
                <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="<?php echo set_value('ubicacion'); ?>" size="50" placeholder="Ubicaci&oacute;n" />
            </div>
        </div>
        
        <!--Sinopsis-->
        <div class="form-group">
            <label for="sinopsis" class="col-sm-1 control-label">Sin&oacutepsis</label>
            <?php echo "<p class='error_msg'>" . form_error('sinopsis') . "</p>"; ?>
            <div class="col-sm-7">
                <textarea name="sinopsis" id="sinopsis" class="form-control" rows="5" value="<?php echo set_value('sinopsis'); ?>"></textarea>
            </div>
        </div>
    </div> <!--Fin Row-->
    
    <div class="row">
        <div><br><br></div>
        <div class="form-group">
            <div class="col-sm-1 pull-right">
                <input type="submit" class="btn btn-primary btn-lg" value="Guardar" />
            </div>
            <div class="col-sm-2 pull-right">
                <?php
                $btn_data = array(
                          'name' => 'btnSalir',
                          'content' => 'Salir sin guardar',
                          'class' => 'btn btn-secondary btn-lg',
                          'onclick' => "document.location.href = '".site_url('')."'");
                echo form_button($btn_data);
                ?>
          <!--      <input type="button" class="btn btn-secondary" value="Salir sin guardar" onclick="document.location.href = '"<?php echo site_url('');?>"'"; "/>-->
            </div>
        </div>
        <div><br><br><br></div>
    </div> <!--Fin Row-->
    
</form>
</div> <!--Fin #wrap-->
    <!--JS CODE-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/js/bootstrap.min.js"></script>



</body>
</html>