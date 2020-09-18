<nav class="navbar navbar-expand-sm    navbar-dark bg-primary">
    <a class="navbar-brand text-light title">DataBus</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <?php
            $linkempleado ="<li class='nav-item'>
                                <a class='nav-link text-light' href='?menu=empleado'><i class='fas fa-users'></i></i>  empleados</a>
                            </li> ";
            $linkcontrato ="<li class='nav-item'>
                                <a class='nav-link text-light' href='?menu=contrato'><i class='fas fa-scroll'></i>  contratos</a>
                            </li>";
            $linkruta ="<li class='nav-item'>
                            <a class='nav-link text-light' href='?menu=ruta'><i class='fas fa-map-marked-alt'></i>  rutas</a>
                        </li>";
            $linkbus = "<li class='nav-item'>
                            <a class='nav-link text-light' href='?menu=bus'><i class='fas fa-user'></i>  buses</a>
                        </li>";
            if ($_SESSION['cargo'] == "administrador") {
                echo $linkempleado . $linkcontrato. $linkbus . $linkruta ;
            }
            if ($_SESSION['cargo'] == "rutas") {
                echo $linkbus.$linkruta;
            }
            if ($_SESSION['cargo'] == "conductor") {
                echo "
                    <li class='nav-item'>
                    <a class='nav-link text-light' href='?menu=misrutas'><i class='fas fa-tags'></i>  rutas</a>
                    </li>
                    ";
            }
            ?>
            <li class='nav-item'>
                <a class='nav-link text-light' href='?menu=perfil'><i class='fas fa-user'></i> perfil</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link text-light' title='Cerrar sesion' data-toggle='popover' data-trigger='hover' href='cerrar.php'><i class='fas fa-power-off'></i> </a>
            </li>
        </div>
    </div>
</nav>