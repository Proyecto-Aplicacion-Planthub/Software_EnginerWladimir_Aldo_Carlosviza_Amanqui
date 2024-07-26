<?php 
require_once "../modelos/articulos.php";

$articulo=new Articulo();

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$Country_of_Bean_Origin=isset($_POST["Country_of_Bean_Origin"])? limpiarCadena($_POST["Country_of_Bean_Origin"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$Specific_Bean_Origin_or_Bar_Name=isset($_POST["Specific_Bean_Origin_or_Bar_Name"])? limpiarCadena($_POST["Specific_Bean_Origin_or_Bar_Name"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$Cocoa_Percent=isset($_POST["Cocoa_Percent"])? limpiarCadena($_POST["Cocoa_Percent"]):"";
$calificacion=isset($_POST["calificacion"])? limpiarCadena($_POST["calificacion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/articulos/" . $imagen);
			}
		}
        
		if (empty($idarticulo)){
			$rspta=$articulo->insertar($idcategoria,$Country_of_Bean_Origin,$nombre,$Specific_Bean_Origin_or_Bar_Name,$descripcion,$Cocoa_Percent,$calificacion,$imagen);
			echo $rspta ? "Artículo registrado" : "Artículo no se pudo registrar";
		}
		else {
			$rspta=$articulo->editar($idarticulo,$idcategoria,$Country_of_Bean_Origin,$nombre,$Specific_Bean_Origin_or_Bar_Name,$descripcion,$Cocoa_Percent,$calificacion,$imagen);
			echo $rspta ? "Artículo actualizado" : "Artículo no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$articulo->desactivar($idarticulo);
 		echo $rspta ? "Artículo Desactivado" : "Artículo no se puede desactivar";
 		break;
	break;

	case 'activar':
		$rspta=$articulo->activar($idarticulo);
 		echo $rspta ? "Artículo activado" : "Artículo no se puede activar";
 		break;
	break;

	case 'mostrar':
		$rspta=$articulo->mostrar($idarticulo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$articulo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idarticulo.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idarticulo.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->categoria,
 				"3"=>$reg->Country_of_Bean_Origin,
 				"4"=>$reg->Specific_Bean_Origin_or_Bar_Name,
				"5"=>$reg->Cocoa_Percent,
				"6"=>$reg->calificacion,
 				"7"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px' >",
 				"8"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
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

    case 'selectCategoria':

        require_once "../modelos/categoria.php";

        $categoria = new Categoria();

        $rspta = $categoria->select();

        	while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcategoria . '>' . $reg->nombre . '</option>';
				}


    break;





}
?>