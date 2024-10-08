
<?php 


ob_start();
session_start();

if(!isset($_SESSION['nombre'])){

    header("Location: login.php");

}else{

require 'header.php';


if (isset($_SESSION['Ventas']) && $_SESSION['Ventas'] == 1) {

?>
<!DOCTYPE html>
<html lang="en">

<?php require_once "header.php" ?>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo $ruta; ?>dist/img/AdminLTELogo.png" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->

        <?php require_once "nav.php"; ?>

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require_once "menu.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">


            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h1 class="box-title">chocolates <button class="btn btn-success" id="btnagregar"
                                        onclick="mostrarelformulario(true)"><i class="fa fa-plus-circle"></i>
                                        Agregar</button>
                                </h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- centro -->
                            <div class="panel-body table-responsive" id="listadoregistros">
                                <table id="tablalistado"
                                    class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                        <th>Opciones</th>
                                        <th>Nombre</th>
                                        <th>Categoría</th>
                                        <th>Pais de Origen</th>
                                        <th>Origen Especifico</th>
                                        <th>Porcentaje de Cacao</th>
                                        <th>calificacion</th>
                                        <th>Imagen</th>
                                        <th>Estado</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <th>Opciones</th>
                                        <th>Nombre</th>
                                        <th>Categoría</th>
                                        <th>Pais de Origen</th>
                                        <th>Origen Especifico</th>
                                        <th>Porcentaje de Cacao</th>
                                        <th>calificacion</th>
                                        <th>Imagen</th>
                                        <th>Estado</th>
                                    </tfoot>
                                </table>
                            </div>


                            <div class="card-body" id="formularioregistros">
                                <form name="formulario" id="formulario" method="POST">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>nombre</label>
                                                <input type="hidden" name="idarticulo" id="idarticulo">
                                                <input type="text" class="form-control" name="nombre" id="nombre"
                                                    placeholder="escribir nombre" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>categoria</label>
                                                <select name="idcategoria" class="form-control"
                                                    id="idcategoria"></select>

                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Origen Especifico</label>
                                                <input type="text" class="form-control" name="Specific_Bean_Origin_or_Bar_Name" id="Specific_Bean_Origin_or_Bar_Name"
                                                    placeholder="escribir nombre" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>descripcion</label>
                                                <input type="text" class="form-control" name="descripcion"
                                                    id="descripcion" placeholder="escribir descripcion" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>imagen</label>
                                                <input type="file" class="form-control" name="imagen" id="imagen">
                                                <input type="hidden" name="imagenactual" id="imagenactual"><br>
                                                <img src="" width="150px" height="120px" id="imagenmuestra">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Porcentaje de Cacao</label>
                                                <input type="text" class="form-control" name="Cocoa_Percent" id="Cocoa_Percent"
                                                    placeholder="escribir nombre" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>calificacion</label>
                                                <input type="text" class="form-control" name="calificacion" id="calificacion"
                                                    placeholder="escribir nombre" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Pais de Origen</label>
                                                <input type="text" class="form-control" name="Country_of_Bean_Origin" id="Country_of_Bean_Origin"
                                                    placeholder="escribir descripcion" required><br>
                                                <button class="btn btn-success" type="button"
                                                    onclick="generarbarcode()">Generar</button>

                                                <div id="print">
                                                    <svg id="barcode"></svg>
                                                </div>


                                            </div>
                                        </div>


                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn btn-primary" type="submit" id="btnGuardar"><i
                                                class="fa fa-save"></i> Guardar</button>

                                        <button class="btn btn-danger" onclick="cancelarformulario()" type="button"><i
                                                class="fa fa-arrow-circle-left"></i> Cancelar</button>
                                    </div>




                                </form>
                            </div>






                            <!--Fin centro -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->




        </div>


        <?php
        
        require_once "footer.php";
        
        ?>


    </div>


    <script type="text/javascript" src="../vistas/codigosjs/articulos.js"></script>






</body>

</html>

<?php
    } else {
        require 'noaccesso.php';
    }
    require_once "footer.php";
}
ob_end_flush();
?>
