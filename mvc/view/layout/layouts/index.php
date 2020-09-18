<?php
session_start();
$validacion = '';
require("../../../model/mysql.php");
if (isset($_POST['id'])) {
    $usuario = $_POST['id'];
    $contrasena  = SHA1($_POST['clave']);
    $pdo = new db();
    $cuentas = $pdo->mysql->query("SELECT u.empleado,u.usuario,u.clave , p.nombre 
    from usuario u, perfil p, empleado e where 
    e.id_empleado=u.empleado and
    u.perfil=p.perfil and 
    e.estado=1 and
    usuario='$usuario' and  
    clave='$contrasena'");
    foreach ($cuentas as $cuenta) {
        $_SESSION['empleado'] = $cuenta['empleado'];
        $_SESSION['sesion'] = $usuario;
        $_SESSION['cargo'] =  $cuenta['nombre'];

        header("Location: layout.php");
    }
    $validacion = "<div class='alert alert-danger'><center><strong>Ojo!</strong> el usuario o contraseña es incorrecta.</div>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            font-size: 1em;
            font-weight: bold;
            display: flex;
            min-height: 100vh;
        }

        #left,
        #right {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        h4 {
            font-family: "Avant Garde", Avantgarde, "Century Gothic", CenturyGothic, "AppleGothic", sans-serif;
            font-size: 7vw;

            text-align: center;
            text-transform: uppercase;
            text-rendering: optimizeLegibility;
            border-radius: 10px;
            position: absolute;
        }

        .deepshadow {
            color: #e0dfdc;
            letter-spacing: .1em;
            text-shadow:
                0 -1px 0 #fff,
                0 1px 0 #2e2e2e,
                0 2px 0 #2c2c2c,
                0 3px 0 #2a2a2a,
                0 4px 0 #282828,
                0 5px 0 #262626,
                0 6px 0 #242424,
                0 7px 0 #222,
                0 8px 0 #202020,
                0 9px 0 #1e1e1e,
                0 10px 0 #1c1c1c,
                0 11px 0 #1a1a1a,
                0 12px 0 #181818,
                0 13px 0 #161616,
                0 14px 0 #141414,
                0 15px 0 #121212,
                0 22px 30px rgba(0, 0, 0, 0.9);
        }

        .deepshadow2 {
            color: red;
            background: rgba(0, 0, 0, 0.329);
            letter-spacing: .1em;
            text-shadow:
                0 -1px 0 #fff,
                0 1px 0 #2e2e2e,
                0 2px 0 #2c2c2c,
                0 3px 0 #2a2a2a,
                0 4px 0 #282828,
                0 5px 0 #262626,
                0 6px 0 #242424,
                0 7px 0 #222,
                0 8px 0 #202020,
                0 9px 0 #1e1e1e,

                0 22px 30px rgba(0, 0, 0, 0.9);
        }

        .form-group {
            min-width: 47vw;
            margin-right: 3vw;
        }

        @media screen and (max-width: 1000px) {

            body {
                flex-direction: column;
            }

            #left,
            #right {
                width: 100%;

            }

            #left {

                height: 25vh;

            }

            #right {
                height: 60vh;

            }

            h4 {

                font-size: 60px;

            }

            .form-group {
                min-width: 80vw;
                margin-right: 3vw;
            }
        }
    </style>
</head>

<body background="../img/fondo22.jpg">
    <div id="left">
        <h4 class='deepshadow'>Gestion <br> Buses</h4>
    </div>
    <div id="right">

        <div class="login-box">
            <h1>Login</h1>
            <form action="index.php" method="POST">
                <div class="form-group">
                    <label for="email">Usuario:</label>
                    <input type="text" name="id" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="pwd">Contraseña:</label>
                    <input type="password" class="form-control" id="pwd" name="clave" required>
                </div>
                <?php
                echo $validacion;
                ?>
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>

        </div>
    </div>
</body>

</html>