<?php
$url= $_SERVER["REQUEST_URI"];
if (isset($_GET ['menu'])) {
    if($_GET ['menu'] =='empleado'){ 
        require_once('../../empleado.php'); 
    }
    if($_GET ['menu'] =='ruta'){ 
        require_once('../../ruta.php'); 
    }
    if($_GET ['menu'] =='bus'){ 
        require_once('../../bus.php'); 
    }
    if($_GET ['menu'] =='misrutas'){ 
        require_once('../../misrutas.php'); 
    }
    if($_GET ['menu'] =='perfil'){ 
        require_once('../../perfil.php'); 
    }
    if($_GET ['menu'] =='contrato'){ 
        require_once('../../contrato.php'); 
    }

    if($_GET ['menu'] =='upempleado'){ 
        require_once('../../../controller/empleado/modificar.php'); 
    }
    if($_GET ['menu'] =='upcontrato'){ 
        require_once('../../../controller/contrato/modificar.php'); 
    }
    if($_GET ['menu'] =='ascontrato'){ 
        require_once('../../../controller/contrato/asignar.php'); 
    }
    if($_GET ['menu'] =='recontrato'){ 
        require_once('../../../controller/contrato/renovar.php'); 
    }
    if($_GET ['menu'] =='qucontrato'){ 
        require_once('../../../controller/contrato/quitar.php'); 
    }
    if($_GET ['menu'] =='upruta'){ 
        require_once('../../../controller/ruta/modificar.php'); 
    }
    if($_GET ['menu'] =='asruta'){ 
        require_once('../../../controller/ruta/asignar.php'); 
    }
    if($_GET ['menu'] =='asgruta'){ 
        require_once('../../../controller/ruta/asignarguardar.php'); 
    }
    if($_GET ['menu'] =='upbus'){ 
        require_once('../../../controller/bus/modificar.php'); 
    }
    if($_GET ['menu'] =='asbus'){ 
        require_once('../../../controller/bus/asignar.php'); 
    }
    if($_GET ['menu'] =='qubus'){ 
        require_once('../../../controller/bus/quitar.php'); 
    }
    if($_GET ['menu'] =='quruta'){ 
        require_once('../../../controller/ruta/quitar.php'); 
    }
}else {
    require_once('../../perfil.php'); 
}


?>
