<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuracion/Conexion.php";

Class Articulo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idcategoria,$Country_of_Bean_Origin,$nombre,$Specific_Bean_Origin_or_Bar_Name,$descripcion,$Cocoa_Percent,$calificacion,$imagen)
	{
		$sql="INSERT INTO articulo (idcategoria,Country_of_Bean_Origin,nombre,Specific_Bean_Origin_or_Bar_Name,descripcion,Cocoa_Percent,calificacion,imagen,condicion)
		VALUES ('$idcategoria','$Country_of_Bean_Origin','$nombre','$Specific_Bean_Origin_or_Bar_Name','$descripcion','$Cocoa_Percent','$calificacion','$imagen','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idarticulo,$idcategoria,$Country_of_Bean_Origin,$nombre,$Specific_Bean_Origin_or_Bar_Name,$descripcion,$Cocoa_Percent,$calificacion,$imagen)
	{
		$sql="UPDATE articulo SET idcategoria='$idcategoria',Country_of_Bean_Origin='$Country_of_Bean_Origin',nombre='$nombre',Specific_Bean_Origin_or_Bar_Name='$Specific_Bean_Origin_or_Bar_Name',descripcion='$descripcion',Cocoa_Percent='$Cocoa_Percent',calificacion='$calificacion',imagen='$imagen' WHERE idarticulo='$idarticulo'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idarticulo)
	{
		$sql="UPDATE articulo SET condicion='0' WHERE idarticulo='$idarticulo'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idarticulo)
	{
		$sql="UPDATE articulo SET condicion='1' WHERE idarticulo='$idarticulo'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idarticulo)
	{
		$sql="SELECT * FROM articulo WHERE idarticulo='$idarticulo'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.Country_of_Bean_Origin,a.nombre,a.Specific_Bean_Origin_or_Bar_Name,a.descripcion,a.Cocoa_Percent,a.calificacion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria";
		return ejecutarConsulta($sql);		
	}
}

?>