<?php

require "../configuracion/co.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['nombre']) && isset($_POST['clave'])) {
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];

        $sql = "SELECT idusuario, nombre, clave, rol, condicion FROM usuario WHERE nombre=? AND condicion='1'";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $num = $resultado->num_rows;

        if ($num > 0) {
            $row = $resultado->fetch_assoc();
            $clave_bd = $row['clave'];

            $pass_c = hash("SHA256", $clave);

            if ($clave_bd == $pass_c) {
                $_SESSION['idusuario'] = $row['idusuario'];
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['clave'] = $row['clave'];

                // Consulta para verificar si el usuario tiene el permiso requerido
                $idusuario = $row['idusuario'];
                $sql = "SELECT idpermiso FROM usuario_permiso WHERE idusuario = ? AND idpermiso IN (1, 2)";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("i", $idusuario);
                $stmt->execute();
                $resultado = $stmt->get_result();

                if ($resultado->num_rows > 0) {
                    $row = $resultado->fetch_assoc();
                    $idpermiso = $row['idpermiso'];

                    // Redirigir según el permiso
                    if ($idpermiso == 1) {
                        header("Location: index.html");
                    } elseif ($idpermiso == 2) {
                        header("Location: usuario.php");
                    }
                    exit;
                } else {
                    echo "Permiso no autorizado";
                }
            } else {
                echo "La contraseña no coincide";
            }
        } else {
            echo "No existe el usuario";
        }
    } else {
        echo "Por favor, complete el formulario";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Page Title - SB Admin</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Usuario</label>
                                            <input class="form-control py-4" id="inputEmailAddress" type="text" name="nombre"
                                                placeholder="Ingresa tu usuario" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Clave</label>
                                            <input class="form-control py-4" id="inputPassword" type="password" name="clave"
                                                placeholder="Enter password" required />
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Forgot Password?</a>
                                            <button class="btn btn-primary" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
