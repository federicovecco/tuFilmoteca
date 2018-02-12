<!DOCTYPE html>
<html lang="sp">
<head>
    <title>Busqueda de Peliculas - TuFilmoteca</title>
    
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
        <div id="header" class="page-header">
            <h2>Formulario de busqueda</h2>
        </div>
        
    <?php
        //Devuelve mensaje de error enviado por el validador (funcion run() en el controlador)
        validation_errors();
    ?>
    
    <?php
        //Si vuelve de una busqueda en la que no se encontraron resultados, muestra un mensaje
        if($msg_noEncontrado != "False"){
            echo "<div name='msg_noEncontrado'> " . $msg_noEncontrado . "</div>";
        }
    ?>
        <form method="post" role="form" class="form-horizontal" action=" <?php echo site_url('buscar_pelicula'); ?> ">
           
            <div class="form-group">
                <label for="titulo" class="col-sm-2 control-label">T&iacutetulo</label>
                <div class="col-sm-8">
                    <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Titulo" value="<?php echo set_value('titulo'); ?>" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="pais" class="col-sm-2 control-label">Pa&iacutes</label>
                <div class="col-sm-8">
                    <select id="pais" name="pais" class="form-control">
                        <option value="0" selected>Elija un pa&iacutes...<option/>
                        <?php
                        //Ciclo para cargar las opciones a mostrar en el select
                        while($row = mysql_fetch_array($paises)) {
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
            
            <div class="form-group">    
                <label for="genero" class="col-sm-2 control-label">G&eacutenero</label>
                <div class="col-sm-8">
                    <select id="genero" name="genero" class="form-control">
                        <option value="0" selected>Elija el g&eacutenero...</option>
                        <?php
                        //Ciclo para cargar las opciones a mostrar en el select
                        while($row = mysql_fetch_array($generos)) {
                            //Si el form vuelve por un error, trarer la opcion seleccionada con anterioridad por el usuario
                            if($row['codigo'] == set_value('genero')) {
                                echo "<option value='" . $row['codigo'] . "' selected>" . $row['descripcion'] . "</option>";
                            }else{
                                echo "<option value='" . $row['codigo'] . "'>" . $row['descripcion'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
                
            <div class="form-group">
                <label for="director" class="col-sm-2 control-label">Director</label>
                <div class="col-sm-8">
                    <select id="director" name="director" class="form-control">
                        <option value="0" selected>Elija el director...</option>
                        <?php
                        //Ciclo para cargar las opciones a mostrar en el select
                        while($row = mysql_fetch_array($directores)) {
                            //Si el form vuelve por un error, trarer la opcion seleccionada con anterioridad por el usuario
                            if($row['codigo'] == set_value('director')) {
                                echo "<option value='" . $row['codigo'] . "' selected>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }else{
                                echo "<option value='" . $row['codigo'] . "'>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
                
            <div class="form-group">
                <label for="actor" class="col-sm-2 control-label">Actor</label>
                <div class="col-sm-8">
                    <select id="actor" name="actor" class="form-control">
                        <option value="0" selected>Elija el actor...</option>
                        <?php
                        //Ciclo para cargar las opciones a mostrar en el select
                        while($row = mysql_fetch_array($actores)) {
                            //Si el form vuelve por un error, trarer la opcion seleccionada con anterioridad por el usuario
                            if($row['codigo'] == set_value('actor')) {
                                echo "<option value='" . $row['codigo'] . "' selected>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }else{
                                echo "<option value='" . $row['codigo'] . "'>" . $row['apellido'] . ", " . $row['nombre'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
                
            <div class="form-group">
                <div class="col-sm-offset-2">
                    <input type="submit" class="btn btn-primary btn-lg" value="Buscar" />
                </div>
            </div>
        </form>
    </div><!--Fin #wrap-->

    <!--JS CODE-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/js/bootstrap.min.js"></script>
    
</body>
</html>