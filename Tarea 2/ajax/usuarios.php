<?php
session_start();  
require_once "../modelos/usuario.php";

$usuario = new usuario();

$idusuario = isset($_POST["idusuario"]) ? limpiarCadena($_POST["idusuario"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
$rol = isset($_POST["rol"]) ? limpiarCadena($_POST["rol"]) : "";
$login = isset($_POST["login"]) ? limpiarCadena($_POST["login"]) : "";
$clave = isset($_POST["clave"]) ? limpiarCadena($_POST["clave"]) : "";
$imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";

// Verificar permisos antes de usarlos
$permisos = isset($_POST['permiso']) ? $_POST['permiso'] : array();

switch ($_GET["op"]){
    case 'guardaryeditar':

        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
            $imagen = $_POST["imagenactual"];
        } else {
            $ext = explode(".", $_FILES["imagen"]["name"]);
            if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
                $imagen = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
            }
        }

        $clavehash = hash("SHA256", $clave);

        if (empty($idusuario)) {
            $rspta = $usuario->insertar($nombre, $email, $rol, $login, $clavehash, $imagen, $permisos);
            echo $rspta ? "usuario registrado" : "la usuario no se pudo registrar";
        } else {
            $rspta = $usuario->editar($idusuario, $nombre, $email, $rol, $login, $clavehash, $imagen, $permisos);
            echo $rspta ? "usuario actualizado" : "usuario no se pudo actualizar";
        }
        break;

    case 'desactivar':
		$rspta=$usuario->desactivar($idusuario);
 		echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
	break;

	case 'activar':
		$rspta=$usuario->activar($idusuario);
 		echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
	break;

	case 'mostrar':
		$rspta=$usuario->mostrar($idusuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;


	case 'listar':
		$rspta=$usuario->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
 					
 				"1"=>$reg->nombre,
 				"2"=>$reg->email,
 				"3"=>$reg->rol,
                "4"=>$reg->login,
                "5"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px' >",
                "6"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

    case 'permisos':

        require_once "../modelos/permiso.php";

        $permiso = new Permiso();

        $rspta = $permiso->listar();

        $id=$_GET['id'];

        $marcados = $usuario->listarmarcados($id);

        $valores=array();

        while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idpermiso);
			}


            while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idpermiso,$valores)?'checked':'';
					
					echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
				}




    break;

    case 'verificar':

        $login=$_POST['login'];
	    $clave=$_POST['clave'];

        $clavehash=hash("SHA256",$clave);

        $rspta=$usuario->verificar($login, $clavehash);

        $fetch=$rspta->fetch_object();

        if(isset($fetch)){

            $_SESSION['idusuario']=$fetch->idusuario;
	        $_SESSION['nombre']=$fetch->nombre;
	        $_SESSION['imagen']=$fetch->imagen;
	        $_SESSION['login']=$fetch->login;

            $marcados = $usuario->listarmarcados($fetch->idusuario);

            $valores=array();

            	while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->idpermiso);
				}


        }

		// Verifica si $valores está definido y es un array
		if (isset($valores) && is_array($valores)) {
			// Establece las sesiones según los valores en $valores
			$_SESSION['escritorio'] = in_array(1, $valores) ? 1 : 0;
			$_SESSION['compras'] = in_array(2, $valores) ? 1 : 0;
			$_SESSION['almacen'] = in_array(3, $valores) ? 1 : 0;
			$_SESSION['ventas'] = in_array(4, $valores) ? 1 : 0;
			$_SESSION['acceso'] = in_array(5, $valores) ? 1 : 0;
			$_SESSION['consultac'] = in_array(6, $valores) ? 1 : 0;
			$_SESSION['consultav'] = in_array(7, $valores) ? 1 : 0;
		} else {
			// Si $valores no está definido o no es un array, establece todas las sesiones como 0
			$_SESSION['escritorio'] = 0;
			$_SESSION['compras'] = 0;
			$_SESSION['almacen'] = 0;
			$_SESSION['ventas'] = 0;
			$_SESSION['acceso'] = 0;
			$_SESSION['consultac'] = 0;
			$_SESSION['consultav'] = 0;
		}

		// Luego, se imprime el JSON codificado
		echo json_encode($fetch);





    break;



    

 





}
?>