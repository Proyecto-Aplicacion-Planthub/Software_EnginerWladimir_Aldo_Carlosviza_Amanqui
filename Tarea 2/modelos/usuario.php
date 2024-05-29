<?php 

require_once "../configuracion/Conexion.php";

class usuario {

    public function __construct() {}

    public function insertar($nombre, $email, $rol, $login, $clave, $imagen, $permisos) {
        $sql = "INSERT INTO usuario (nombre, email, rol, login, clave, imagen, condicion) VALUES ('$nombre', '$email', '$rol', '$login', '$clave', '$imagen', '1')";
        $idusuarionew = ejecutarConsulta_retornarID($sql);

        $num_elementos = 0;
        $sw = true;

        // Verificar que permisos sea un array antes de usar count()
        if (is_array($permisos)) {
            while ($num_elementos < count($permisos)) {
                $sql_detalle = "INSERT INTO usuario_permiso (idusuario, idpermiso) VALUES ('$idusuarionew', '$permisos[$num_elementos]')";
                ejecutarConsulta($sql_detalle) or $sw = false;
                $num_elementos++;
            }
        }

        return $sw;
    }

    public function editar($idusuario, $nombre, $email, $rol, $login, $clave, $imagen, $permisos) {
        $sql = "UPDATE usuario SET nombre='$nombre', email='$email', rol='$rol', login='$login', clave='$clave', imagen='$imagen' WHERE idusuario='$idusuario'";
        ejecutarConsulta($sql);

        $sqldel = "DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";
        ejecutarConsulta($sqldel);

        $num_elementos = 0;
        $sw = true;

        // Verificar que permisos sea un array antes de usar count()
        if (is_array($permisos)) {
            while ($num_elementos < count($permisos)) {
                $sql_detalle = "INSERT INTO usuario_permiso (idusuario, idpermiso) VALUES ('$idusuario', '$permisos[$num_elementos]')";
                ejecutarConsulta($sql_detalle) or $sw = false;
                $num_elementos++;
            }
        }

        return $sw;
    }

    public function desactivar($idusuario) {
        $sql = "UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    public function activar($idusuario) {
        $sql = "UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idusuario) {
        $sql = "SELECT * FROM usuario WHERE idusuario='$idusuario'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar() {
        $sql = "SELECT * FROM usuario";
        return ejecutarConsulta($sql);
    }

    public function listarmarcados($idusuario) {
        $sql = "SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    // Función para verificar el acceso al sistema
    public function verificar($login, $clave) {
        $sql = "SELECT idusuario, nombre, email, rol, imagen, login FROM usuario WHERE login='$login' AND clave='$clave' AND condicion='1'";
        return ejecutarConsulta($sql);
    }
}
?>
