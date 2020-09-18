<center>
  <div class="card mt-4" style="width: 18rem;">
    <i class="fas fa-user-circle fa-10x fa-lg mt-4"></i>
    <div class="card-body"><br>
      <h5 class="card-title">Usuario</h5>
      <p class="card-text"></p>
    </div>
    <?php
    $empledation = $_SESSION['empleado'];
    $pdo = new db();
    $usuarios = $pdo->mysql->query(" select * , p.nombre as cargation from usuario u, perfil p,
     empleado e where u.perfil=p.perfil and e.id_empleado=u.empleado and id_empleado='$empledation'");
    foreach ($usuarios as $usuario) {
      echo "
            <ul class='list-group list-group-flush'>
              <li class='list-group-item'>usuario: {$usuario['usuario']}</li>
              <li class='list-group-item'>rango: {$usuario['cargation']}</li>
              <li class='list-group-item'><h5>Datos</h5></li>
              <li class='list-group-item'>Cedula: {$usuario['cedula']}</li>
              <li class='list-group-item'>nombre: {$usuario['nombre']} {$usuario['apellido']}</li>
              <li class='list-group-item'>correo: {$usuario['correo']}</li>
              <li class='list-group-item'>telefono: {$usuario['telefono']}</li>
              <li class='list-group-item'>cargo: {$usuario['cargo']}</li>
              <li class='list-group-item'><a href='#' class='card-link'>editar usuario</a></li>
            </ul>";
    }
    ?>
  </div>
</center>